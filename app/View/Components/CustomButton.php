<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomButton extends Component
{
    /**
     * Create a new component instance.
     */
    public $px;
    public $py;
    public $text;
    public $route;
    public $class;

    public function __construct($px = 'px-6', $py = 'py-2.5', $text, $route, $class = '')
    {
        $this->px = $px;
        $this->py = $py;
        $this->text = $text;
        $this->route = $route;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom-button');
    }
}
