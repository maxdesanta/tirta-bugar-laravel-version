<?php

namespace App\View\Components\Member;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardAmount extends Component {
    // property
    public $image;
    public $title;
    public $amount;

    public function __construct($image, $title, $amount)
    {
        $this->image = $image;
        $this->title = $title;
        $this->amount = $amount;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.member.card-amount');
    }
}
