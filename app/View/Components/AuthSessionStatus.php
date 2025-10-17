<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AuthSessionStatus extends Component
{
    /**
     * The session status message.
     *
     * @var string
     */
    public $status;

    /**
     * Create a new component instance.
     *
     * @param  string  $status
     * @return void
     */
    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.auth-session-status');
    }
}
