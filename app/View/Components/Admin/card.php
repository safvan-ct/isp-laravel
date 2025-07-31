<?php
namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class card extends Component
{
    public $title    = '';
    public $subTitle = '';

    public function __construct($title, $subTitle)
    {
        $this->title    = $title;
        $this->subTitle = $subTitle;
    }

    public function render(): View | Closure | string
    {
        return view('components.admin.card');
    }
}
