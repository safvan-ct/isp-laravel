<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;
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

    public function activityLog($logName = null, $eventName = null, $causerId = null, $subjectId = null)
    {
        // $this->authorizeAction('activity-log', 'view');

        $logs      = Activity::selectRaw('log_name, event, MAX(id) as id')->whereNotNull('causer_id')->groupBy('log_name', 'event')->get();
        $logTables = $logs->pluck('log_name')->unique()->toArray();
        $logEvents = $logs->pluck('event')->unique()->toArray();

        $logUsers = Activity::with('causer:id,first_name,last_name')
            ->when(! empty($logName), fn($query) => $query->where('log_name', $logName))
            ->when(! empty($eventName), fn($query) => $query->where('event', $eventName))
            ->when(! empty($subjectId), fn($query) => $query->where('subject_id', $subjectId))
            ->whereNotNull('causer_id')
            ->get()
            ->pluck('causer')
            ->unique();

        $logSubjects = Activity::selectRaw('subject_id, MAX(id) as id')
            ->when(! empty($logName), fn($query) => $query->where('log_name', $logName))
            ->when(! empty($eventName), fn($query) => $query->where('event', $eventName))
            ->whereNotNull('causer_id')
            ->whereNotNull('subject_id')
            ->groupBy('subject_id')
            ->pluck('subject_id')
            ->unique()
            ->toArray();

        if (empty($logName) && empty($eventName) && empty($causerId) && empty($subjectId)) {
            $activityLogs = [];
        } else {
            $activityLogs = Activity::select(['log_name', 'event', 'causer_id', 'subject_id', 'id', 'properties'])
                ->when(! empty($logName), fn($query) => $query->where('log_name', $logName))
                ->when(! empty($eventName), fn($query) => $query->where('event', $eventName))
                ->when(! empty($causerId), fn($query) => $query->where('causer_id', $causerId))
                ->when(! empty($subjectId), fn($query) => $query->where('subject_id', $subjectId))
                ->whereNotNull('causer_id')
                ->get();
        }

        return view('admin.activity-log',
            compact('activityLogs', 'logTables', 'logEvents', 'logUsers', 'logSubjects', 'logName', 'eventName', 'causerId', 'subjectId')
        );
    }
}
