<?php
namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class modal extends Component
{
    public $id;
    public $title;

    public function __construct($id = 'modal', $title = 'Create')
    {
        $this->id    = $id;
        $this->title = $title;
    }

    public function render(): View | Closure | string
    {
        return view('components.admin.modal');
    }
}
