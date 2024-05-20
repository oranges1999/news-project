<?php

namespace App\Helper;

use App\Enums\UserRole;
use App\ModelFilters\PostFilter;

class RoleHelper
{
    public static function roleCheck($user, $data=null)
    {
        switch ($user->role) 
        {
            case UserRole::Admin:
                return true;
                break;
            case UserRole::Writer:
                return $user->id==$data->user_id;
                break;
            default:
                return false;
        }
    }

    public static function permissionForData($user, $model)
    {
        
        switch ($user->role) {
            case UserRole::Admin:
                return $model::all();
                break;
            default:
                return $model::where('user_id',$user->id)->get();
        }
    }
}

