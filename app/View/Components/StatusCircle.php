<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusCircle extends Component
{
    public string $color;
    public string $label;
    
    /**
     * Create a new component instance.
     */
    public function __construct(string $color, string $label)
    {
        $this->color = $color;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.status-circle');
    }
}
