<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public $titleHeader;
    public $userName;

    public function __construct($titleHeader, $userName)
    {
        $this->titleHeader = $titleHeader;
        $this->userName = $userName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}
