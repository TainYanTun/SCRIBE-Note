<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TextInput extends Component
{
    /**
     * The input's value.
     *
     * @var string
     */
    public $value;

    /**
     * Create a new component instance.
     *
     * @param  string  $value
     * @return void
     */
    public function __construct($value = '')
    {
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.text-input');
    }
}
