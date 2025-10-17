<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputError extends Component
{
    /**
     * The error messages.
     *
     * @var \Illuminate\Support\ViewErrorBag
     */
    public $messages;

    /**
     * Create a new component instance.
     *
     * @param  \Illuminate\Support\ViewErrorBag  $messages
     * @return void
     */
    public function __construct($messages = [])
    {
        $this->messages = $messages;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.input-error');
    }
}
