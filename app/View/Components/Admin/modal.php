<?php
namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class modal extends Component
{
    public $id;
    public $title;
    public $size;

    public function __construct($id = 'modal', $title = 'Create', $size = '')
    {
        $this->id    = $id;
        $this->title = $title;
        $this->size  = $size;
    }

    public function render(): View | Closure | string
    {
        return view('components.admin.modal');
    }
}
