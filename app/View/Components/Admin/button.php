<?php
namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class button extends Component
{
    public $class;
    public $type;

    public function __construct($class = 'btn btn-secondary', $type = 'submit')
    {
        $this->class = $class;
        $this->type  = $type;
    }

    public function render(): View | Closure | string
    {
        return view('components.admin.button');
    }
}
