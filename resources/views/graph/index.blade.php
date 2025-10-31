<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Graph View') }}
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #191919;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Info Card -->
            <div class="overflow-hidden shadow-lg sm:rounded-xl mb-6" style="background: rgba(31, 31, 31, 0.95); border: 1px solid rgba(255, 255, 255, 0.06);">
                <div class="p-6">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-lg flex items-center justify-center" style="background: rgba(96, 165, 250, 0.15);">
                            <svg class="w-5 h-5" style="color: #60A5FA;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div style="color: #B4B4B4; font-size: 14px; line-height: 1.7;">
                            <p>This graph view provides a visual representation of your notes and their connections. Each box represents a note, and lines show the links between notes. Click on a note to navigate to its page. Use the filter to show notes with a specific tag.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graph Card -->
            <div class="overflow-hidden shadow-lg sm:rounded-xl" style="background: rgba(31, 31, 31, 0.95); border: 1px solid rgba(255, 255, 255, 0.06);">
                <div class="p-6">
                    @if($message)
                        <div class="mb-6 p-4 rounded-lg" style="background: rgba(96, 165, 250, 0.1); border: 1px solid rgba(96, 165, 250, 0.2); color: #93C5FD;">
                            <p style="font-size: 14px;">{{ $message }}</p>
                        </div>
                    @endif

                    <!-- Controls -->
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-6">
                        <!-- Legend -->
                        <div class="w-full lg:flex-1">
                            <div class="text-xs font-semibold uppercase tracking-wider mb-3" style="color: #6B7280;">Tags</div>
                            <div id="legend" class="flex flex-wrap items-center gap-2.5 max-h-40 overflow-y-auto mt-2" style="color: #B4B4B4; font-size: 13px;"></div>
                        </div>

                        <!-- Filter & Fullscreen -->
                        <div class="flex items-center gap-3 w-full lg:w-auto">
                            <div class="flex items-center gap-2 flex-1 lg:flex-initial" style="color: #B4B4B4; font-size: 13px;">
                                <label for="tag-filter" class="text-xs font-medium whitespace-nowrap">Filter:</label>
                                <select id="tag-filter" class="rounded-lg flex-1 lg:w-auto" style="background: rgba(47, 47, 47, 0.6); border: 1px solid rgba(255, 255, 255, 0.08); color: #E3E3E3; padding: 8px 12px; font-size: 13px; min-width: 140px;">
                                    <option value="all">All Tags</option>
                                </select>
                            </div>
                            <button id="reset-view-btn" class="px-4 py-2 rounded-lg flex items-center gap-2 whitespace-nowrap" style="background: rgba(96, 165, 250, 0.12); color: #93C5FD; border: 1px solid rgba(96, 165, 250, 0.2); font-size: 13px;">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                <span>Reset View</span>
                            </button>
                            <button id="fullscreen-btn" class="px-4 py-2 rounded-lg flex items-center gap-2 whitespace-nowrap" style="background: rgba(96, 165, 250, 0.12); color: #93C5FD; border: 1px solid rgba(96, 165, 250, 0.2); font-size: 13px;">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                                </svg>
                                <span>Fullscreen</span>
                            </button>
                        </div>
                    </div>

                    <!-- Graph Container -->
                    <div id="graph" style="height: 600px; background: rgba(25, 25, 25, 0.8); border-radius: 12px; border: 1px solid rgba(255, 255, 255, 0.05);"></div>
                    
                    <!-- Graph Info Panel -->
                    <div id="graph-info" class="mt-4 p-4 rounded-lg" style="background: rgba(47, 47, 47, 0.4); border: 1px solid rgba(255, 255, 255, 0.05); color: #B4B4B4; font-size: 13px; display: none;">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="font-medium" id="selected-node-title">Node Information</span>
                                <p id="selected-node-details" class="mt-1"></p>
                            </div>
                            <button id="close-info" class="p-1 rounded hover:bg-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
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
            background: rgba(25, 25, 25, 0.98);
            border-radius: 0;
            border: none;
        }
        
        /* Legend Tag Pills */
        .legend-tag-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 20px;
            background: rgba(47, 47, 47, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.05);
            cursor: pointer;
        }

        .legend-tag-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .legend-tag-text {
            font-size: 12px;
            color: #D1D5DB;
        }

        /* Node tooltip styling */
        .vis-tooltip {
            background-color: rgba(31, 31, 31, 0.95) !important;
            border: 1px solid rgba(96, 165, 250, 0.3) !important;
            border-radius: 8px !important;
            color: #E3E3E3 !important;
            padding: 8px 12px !important;
        }
    </style>
    <script type="text/javascript" src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            var notes_data = JSON.parse('{!! $notes_json !!}');
            var edges_data = JSON.parse('{!! $edges_json !!}');
            var all_tags_data = JSON.parse('{!! $all_tags_json !!}');

            // Color palette for tags
            const colorPalette = [
                '#60A5FA', '#34D399', '#F472B6', '#A78BFA', '#FBBF24',
                '#F87171', '#2DD4BF', '#FB923C', '#C084FC', '#4ADE80',
                '#818CF8', '#FB7185', '#10B981', '#8B5CF6', '#F59E0B',
                '#EF4444', '#06B6D4', '#EC4899', '#6366F1', '#14B8A6'
            ];
            
            const tagColors = {};
            all_tags_data.forEach((tag, index) => {
                tagColors[tag.name] = colorPalette[index % colorPalette.length];
            });

            // Detect isolated (unconnected) nodes
            const connectedNodeIds = new Set();
            edges_data.forEach(edge => {
                connectedNodeIds.add(edge.from);
                connectedNodeIds.add(edge.to);
            });

            notes_data.forEach(note => {
                const isIsolated = !connectedNodeIds.has(note.id);
                const baseOpacity = isIsolated ? 0.5 : 0.9;
                
                if (note.tags && note.tags.length > 0) {
                    const tagColor = tagColors[note.tags[0]];
                    note.color = {
                        background: isIsolated ? 'rgba(25, 25, 25, 0.7)' : 'rgba(31, 31, 31, 0.9)',
                        border: tagColor,
                        highlight: {
                            background: 'rgba(45, 45, 45, 0.95)',
                            border: tagColor
                        },
                        hover: {
                            background: 'rgba(96, 165, 250, 0.3)', // A blueish tint
                            border: '#93C5FD' // A brighter blue
                        }
                    };
                    note.opacity = baseOpacity;
                    note.borderWidth = isIsolated ? 1.5 : 2;
                    note.borderWidthSelected = 3;
                    note.font = {
                        color: isIsolated ? '#A0A0A0' : '#E3E3E3',
                        size: 14
                    };
                } else {
                    note.color = {
                        background: isIsolated ? 'rgba(25, 25, 25, 0.7)' : 'rgba(31, 31, 31, 0.9)',
                        border: isIsolated ? '#3a3a3a' : '#4f4f4f',
                        highlight: {
                            background: 'rgba(45, 45, 45, 0.95)',
                            border: '#6f6f6f'
                        },
                        hover: {
                            background: 'rgba(40, 40, 40, 0.95)',
                            border: '#6f6f6f'
                        }
                    };
                    note.opacity = baseOpacity;
                    note.borderWidth = isIsolated ? 1.5 : 2;
                    note.borderWidthSelected = 3;
                    note.font = {
                        color: isIsolated ? '#A0A0A0' : '#E3E3E3',
                        size: 14
                    };
                }
            });

            const legendContainer = document.getElementById('legend');
            const filterSelect = document.getElementById('tag-filter');

            // Create legend
            for (const tag in tagColors) {
                const legendItem = document.createElement('div');
                legendItem.className = 'legend-tag-pill';
                legendItem.innerHTML = `
                    <div class="legend-tag-dot" style="background-color: ${tagColors[tag]};"></div>
                    <span class="legend-tag-text">${tag}</span>
                `;
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
                        background: 'rgba(31, 31, 31, 0.9)',
                        border: '#4f4f4f',
                        highlight: {
                            background: 'rgba(45, 45, 45, 0.95)',
                            border: '#6f6f6f'
                        },
                        hover: {
                            background: 'rgba(40, 40, 40, 0.95)',
                            border: '#6f6f6f'
                        }
                    },
                    font: {
                        color: '#E3E3E3',
                        size: 14
                    },
                    borderWidth: 2,
                    borderWidthSelected: 3,
                    margin: 12,
                    shapeProperties: {
                        borderRadius: 8
                    }
                },
                edges: {
                    color: {
                        color: 'rgba(79, 79, 79, 0.4)',
                        highlight: 'rgba(96, 165, 250, 0.7)',
                        hover: 'rgba(96, 165, 250, 0.5)'
                    },
                    width: 1.5,
                    smooth: {
                        enabled: true,
                        type: 'continuous',
                        roundness: 0.5
                    }
                },
                physics: {
                    solver: 'forceAtlas2Based',
                    forceAtlas2Based: {
                        gravitationalConstant: -150, // Further reduced repulsion to bring networks closer
                        centralGravity: 0.015, // Increased central gravity to make the graph denser
                        springConstant: 0.08,
                        springLength: 80, // Reduced spring length to pull connected nodes closer
                        damping: 0.4,
                        avoidOverlap: 1 // Actively avoid node overlap
                    },
                    stabilization: {
                        enabled: true,
                        iterations: 1000,
                        updateInterval: 25,
                        fit: true
                    }
                },
                interaction: {
                    hover: true,
                    dragNodes: true,
                    tooltipDelay: 200,
                    hideEdgesOnDrag: false,
                    hideEdgesOnZoom: false
                }
            };
            var network = new vis.Network(container, data, options);

            // Store original node colors for highlighting
            const originalNodeColors = {};
            nodes.forEach(node => {
                originalNodeColors[node.id] = {
                    background: node.color.background,
                    border: node.color.border
                };
            });

            // Disable physics after stabilization
            network.once("stabilizationIterationsDone", function() {
                network.setOptions({ physics: false });
            });

            // Dragging a node and its connected nodes
            let draggedNodeAndConnections = [];

            network.on("dragStart", function (params) {
                if (params.nodes.length > 0) {
                    network.setOptions({ physics: true });
                    const nodeId = params.nodes[0];
                    const connectedNodes = network.getConnectedNodes(nodeId);
                    draggedNodeAndConnections = [...connectedNodes, nodeId];
                }
            });

            network.on("dragEnd", function (params) {
                draggedNodeAndConnections = [];
                network.setOptions({ physics: false });
            });

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

            // Node hover event - show connected nodes
            network.on("hoverNode", function (params) {
                const nodeId = params.node;
                const connectedNodes = network.getConnectedNodes(nodeId);
                
                // Highlight connected nodes
                const updateArray = [];
                nodes.forEach(node => {
                    if (connectedNodes.includes(node.id) || node.id === nodeId) {
                        updateArray.push({
                            id: node.id,
                            color: {
                                background: 'rgba(96, 165, 250, 0.2)',
                                border: node.color.border
                            }
                        });
                    }
                });
                nodes.update(updateArray);
            });

            // Node blur event - restore original colors
            network.on("blurNode", function () {
                const updateArray = [];
                nodes.forEach(node => {
                    updateArray.push({
                        id: node.id,
                        color: {
                            background: originalNodeColors[node.id].background,
                            border: originalNodeColors[node.id].border
                        }
                    });
                });
                nodes.update(updateArray);
            });

            // Node click event - show node details
            network.on("click", function (params) {
                if (params.nodes.length > 0) {
                    var nodeId = params.nodes[0];
                    var node = nodes.get(nodeId);

                    // Redirect to the note's show page
                    window.location.href = `/notes/${node.id}`;

                    // Show node info panel (existing functionality, will keep)
                    const infoPanel = document.getElementById('graph-info');
                    const nodeTitle = document.getElementById('selected-node-title');
                    const nodeDetails = document.getElementById('selected-node-details');
                    
                    nodeTitle.textContent = node.label || 'Untitled Note';
                    
                    let details = '';
                    if (node.tags && node.tags.length > 0) {
                        details += `<strong>Tags:</strong> ${node.tags.join(', ')}<br>`;
                    }
                    
                    // Count connections
                    const connectedNodes = network.getConnectedNodes(nodeId);
                    details += `<strong>Connections:</strong> ${connectedNodes.length}<br>`;
                    
                    // Add preview if available
                    if (node.title) {
                        details += `<strong>Preview:</strong> ${node.title.substring(0, 100)}${node.title.length > 100 ? '...' : ''}`;
                    }
                    
                    nodeDetails.innerHTML = details;
                    infoPanel.style.display = 'block';
                } else {
                    // Clicked on empty space, hide info panel
                    document.getElementById('graph-info').style.display = 'none';
                }
            });

            // Close info panel
            document.getElementById('close-info').addEventListener('click', function() {
                document.getElementById('graph-info').style.display = 'none';
            });

            // Reset view button
            document.getElementById('reset-view-btn').addEventListener('click', function() {
                network.fit({
                    animation: {
                        duration: 1000,
                        easingFunction: 'easeInOutQuad'
                    }
                });
            });

            // Legend tag click - filter by tag
            document.querySelectorAll('.legend-tag-pill').forEach(pill => {
                pill.addEventListener('click', function() {
                    const tagText = this.querySelector('.legend-tag-text').textContent;
                    filterSelect.value = tagText;
                    filterSelect.dispatchEvent(new Event('change'));
                });
            });

            const fullscreenBtn = document.getElementById('fullscreen-btn');
            const graphContainer = document.getElementById('graph');
            fullscreenBtn.addEventListener('click', () => {
                if (!document.fullscreenElement) {
                    graphContainer.requestFullscreen();
                    graphContainer.classList.add('fullscreen');
                    setTimeout(() => {
                        network.fit();
                    }, 100);
                } else {
                    document.exitFullscreen();
                }
            });

            document.addEventListener('fullscreenchange', () => {
                if (!document.fullscreenElement) {
                    graphContainer.classList.remove('fullscreen');
                    setTimeout(() => {
                        network.redraw();
                        network.fit();
                    }, 100);
                }
            });

            // Initial fit
            setTimeout(() => {
                network.fit();
            }, 500);
        });
    </script>
    @endpush
</x-app-layout>