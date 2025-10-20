<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Graph View') }}
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #191919;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg mb-6" style="background-color: #1f1f1f; border: 1px solid #2f2f2f;">
                <div class="p-6" style="color: #9b9b9b;">
                    <p style="font-size: 14px; line-height: 1.6;">
                        This graph view provides a visual representation of your notes and their connections. Each box in the graph represents a note, and the lines connecting them represent the links between your notes. You can click on a note to navigate to its page. Use the filter to show notes with a specific tag, and click the fullscreen button to expand the graph.
                    </p>
                </div>
            </div>
            <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background-color: #1f1f1f; border: 1px solid #2f2f2f;">
                <div class="p-6">
                    @if($message)
                        <p class="mb-4" style="color: #e3e3e3;">{{ $message }}</p>
                    @endif
                    <div class="flex justify-between items-center mb-4">
                        <div id="legend" class="flex items-center space-x-4" style="color: #9b9b9b; font-size: 13px;">
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full" style="background-color: #2f2f2f; border: 1px solid #4f4f4f"></div>
                                <span class="ml-2">Note</span>
                            </div>
                        </div>
                        <div class="flex items-center" style="color: #9b9b9b; font-size: 13px;">
                            <label for="tag-filter" class="mr-2">Filter by tag:</label>
                            <select id="tag-filter" class="rounded-md" style="background-color: #2f2f2f; border: 1px solid #404040; color: #e3e3e3; padding: 6px 12px; font-size: 13px;">
                                <option value="all">All</option>
                            </select>
                            <button id="fullscreen-btn" class="ml-4 px-4 py-2 rounded-md transition-colors" style="background-color: #2f2f2f; color: #e3e3e3; border: 1px solid #404040; font-size: 13px;">
                                Fullscreen
                            </button>
                        </div>
                    </div>
                    <div id="graph" style="height: 500px; background-color: #191919; border-radius: 6px;"></div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <style>
        #graph.fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 9999;
            background-color: #191919;
        }
        
        #fullscreen-btn:hover {
            background-color: #3a3a3a !important;
        }
        
        #tag-filter:focus {
            outline: none;
            border-color: #505050;
        }
    </style>
    <script type="text/javascript" src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            var notes_data = JSON.parse('{!! $notes_json !!}');
            var edges_data = JSON.parse('{!! $edges_json !!}');
            var all_tags_data = JSON.parse('{!! $all_tags_json !!}');

            const colorPalette = ['#F87171', '#60A5FA', '#34D399', '#FBBF24', '#A78BFA', '#F472B6'];
            const tagColors = {};
            all_tags_data.forEach((tag, index) => {
                tagColors[tag.name] = colorPalette[index % colorPalette.length];
            });

            notes_data.forEach(note => {
                if (note.tags && note.tags.length > 0) {
                    note.color = {
                        background: 'rgba(31, 31, 31, 0.6)',
                        border: tagColors[note.tags[0]]
                    };
                    note.borderWidth = 2;
                }
            });

            const legendContainer = document.getElementById('legend');
            const filterSelect = document.getElementById('tag-filter');

            for (const tag in tagColors) {
                const legendItem = document.createElement('div');
                legendItem.className = 'flex items-center';
                legendItem.innerHTML = `<div class="w-3 h-3 rounded-full" style="background-color: ${tagColors[tag]}"></div><span class="ml-2">${tag}</span>`;
                legendContainer.appendChild(legendItem);

                const filterOption = document.createElement('option');
                filterOption.value = tag;
                filterOption.textContent = tag;
                filterSelect.appendChild(filterOption);
            }

            var nodes = new vis.DataSet(notes_data);
            var edges = new vis.DataSet(edges_data);

            var container = document.getElementById('graph');
            var data = {
                nodes: nodes,
                edges: edges
            };
            var options = {
                nodes: {
                    shape: 'box',
                    color: {
                        background: 'rgba(31, 31, 31, 0.6)',
                        border: '#4f4f4f',
                        highlight: {
                            background: 'rgba(58, 58, 58, 0.8)',
                            border: '#606060'
                        }
                    },
                    font: {
                        color: '#e3e3e3',
                        size: 14
                    },
                    borderWidth: 2,
                    margin: 10
                },
                edges: {
                    color: {
                        color: '#4f4f4f',
                        highlight: '#606060'
                    },
                    width: 1
                },
                physics: {
                    solver: 'forceAtlas2Based',
                    forceAtlas2Based: {
                        gravitationalConstant: -50,
                        centralGravity: 0.01,
                        springConstant: 0.08,
                        springLength: 100,
                        damping: 0.4,
                        avoidOverlap: 0
                    }
                }
            };
            var network = new vis.Network(container, data, options);

            filterSelect.addEventListener('change', (event) => {
                const selectedTag = event.target.value;
                if (selectedTag === 'all') {
                    network.setData(data);
                } else {
                    const filteredNodes = new vis.DataSet(
                        nodes.get({ filter: (node) => node.tags && node.tags.includes(selectedTag) })
                    );
                    const filteredEdges = new vis.DataSet(
                        edges.get({ filter: (edge) => filteredNodes.get(edge.from) && filteredNodes.get(edge.to) })
                    );
                    network.setData({ nodes: filteredNodes, edges: filteredEdges });
                }
            });

            network.on("click", function (params) {
                if (params.nodes.length > 0) {
                    var nodeId = params.nodes[0];
                    var url = "{{ route('notes.show', ':id') }}";
                    url = url.replace(':id', nodeId);
                    window.location.href = url;
                }
            });

            const fullscreenBtn = document.getElementById('fullscreen-btn');
            const graphContainer = document.getElementById('graph');
            fullscreenBtn.addEventListener('click', () => {
                if (!document.fullscreenElement) {
                    graphContainer.requestFullscreen();
                    graphContainer.classList.add('fullscreen');
                } else {
                    document.exitFullscreen();
                }
            });

            document.addEventListener('fullscreenchange', () => {
                if (!document.fullscreenElement) {
                    graphContainer.classList.remove('fullscreen');
                    network.redraw();
                }
            });
        });
    </script>
    @endpush
</x-app-layout>