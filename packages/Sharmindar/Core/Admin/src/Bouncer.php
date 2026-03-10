<?php

namespace Sharmindar\Core\Admin;

use Sharmindar\Core\User\Repositories\UserRepository;

class Bouncer
{
    /**
     * Checks if user allowed or not for certain action
     *
     * @param  string  $permission
     * @return void
     */
    public function hasPermission($permission)
    {
        if (auth()->guard('user')->check() && auth()->guard('user')->user()->role->permission_type == 'all') {
            return true;
        }
        else {
            if (!auth()->guard('user')->check() || !auth()->guard('user')->user()->hasPermission($permission)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Checks if user allowed or not for certain action
     *
     * @param  string  $permission
     * @return void
     */
    public static function allow($permission)
    {
        if (!auth()->guard('user')->check() || !auth()->guard('user')->user()->hasPermission($permission)) {
            abort(401, 'This action is unauthorized');
        }
    }

    /**
     * This function will return user ids of current user's groups
     *
     * @return array|null
     */
    public function getAuthorizedUserIds()
    {
        $user = auth()->guard('user')->user();

        if ($user->view_permission == 'global') {
            return null;
        }

        if ($user->view_permission == 'group') {
            return app(UserRepository::class)->getCurrentUserGroupsUserIds();
        }
        elseif ($user->view_permission == 'department') {
            $profile = \Sharmindar\Core\User\Models\EmployeeProfile::where('user_id', $user->id)->first();
            if ($profile && $profile->department_id) {
                return \Sharmindar\Core\User\Models\EmployeeProfile::where('department_id', $profile->department_id)->pluck('user_id')->toArray();
            }
            return [$user->id];
        }
        else {
            return [$user->id];
        }
    }
}
