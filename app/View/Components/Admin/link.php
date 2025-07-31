<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class link extends Component
{
    public $url;
    public $class;

    public function __construct($url, $class = 'text-secondary')
    {
        $this->url = $url;
        $this->class = $class;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.link');
    }
}
