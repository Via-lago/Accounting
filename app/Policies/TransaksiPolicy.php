<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransaksiPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function isAdmin(User $user)
    {
        return $user->level === 'admin';
    }

    public function isAdminOrBendahara(User $user)
    {
        if ($user->level === 'admin' || $user->level === 'bendahara' ) {
            return true;
        }
    }
}
