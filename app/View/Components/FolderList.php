<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FolderList extends Component
{
    public $folders;

    /**
     * Create a new component instance.
     */
    public function __construct($folders)
    {
        $this->folders = $folders;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.folder-list');
    }
}
