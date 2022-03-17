<?php

namespace App\Helper;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserHelper
{
    public static function getARandomUser()
    {
        try {
            return User::inRandomOrder()->first();
        }catch (ModelNotFoundException $exception){
            throw new ModelNotFoundException('User not found.', $exception->getMessage());
        }catch (Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }
}
