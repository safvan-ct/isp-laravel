<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount  = User::whereHas('roles', fn($q) => $q->whereIn('name', ['User']))->count();
        $staffCount = User::whereHas('roles', fn($q) => $q->whereNotIn('name', ['User']))->count();
        $rolesCount = Role::count();

        return view('admin.dashboard', compact('userCount', 'staffCount', 'rolesCount'));
    }
}
