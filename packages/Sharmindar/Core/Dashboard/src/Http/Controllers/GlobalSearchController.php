<?php

namespace Sharmindar\Core\Dashboard\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Sharmindar\Core\Admin\Http\Controllers\Controller;
use Sharmindar\Core\User\Models\User;

class GlobalSearchController extends Controller
{
    /**
     * Search users by name or email.
     */
    public function searchUsers(): JsonResponse
    {
        $query = request()->input('search', '');

        if (strlen($query) < 2) {
            return response()->json(['data' => []]);
        }

        $users = User::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->limit(10)
            ->get(['id', 'name', 'email', 'status']);

        return response()->json(['data' => $users]);
    }

    /**
     * Search projects by name or description.
     */
    public function searchProjects(): JsonResponse
    {
        $query = request()->input('search', '');

        if (strlen($query) < 2) {
            return response()->json(['data' => []]);
        }

        $projects = \Sharmindar\Core\Admin\Models\Project::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->limit(10)
            ->get(['id', 'name', 'description', 'status']);

        return response()->json(['data' => $projects]);
    }

    /**
     * Search tasks by title, description, or status.
     */
    public function searchTasks(): JsonResponse
    {
        $query = request()->input('search', '');

        if (strlen($query) < 2) {
            return response()->json(['data' => []]);
        }

        $tasks = \Sharmindar\Core\Admin\Models\Task::where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->limit(10)
            ->get(['id', 'title', 'description', 'status', 'priority']);

        return response()->json(['data' => $tasks]);
    }

    /**
     * Search clients (organizations/contacts) by name or address.
     */
    public function searchClients(): JsonResponse
    {
        $query = request()->input('search', '');

        if (strlen($query) < 2) {
            return response()->json(['data' => []]);
        }

        $clients = \Sharmindar\Core\Contact\Models\Organization::where('name', 'like', "%{$query}%")
            ->orWhere('address', 'like', "%{$query}%")
            ->limit(10)
            ->get(['id', 'name', 'address']);

        return response()->json(['data' => $clients]);
    }
}
