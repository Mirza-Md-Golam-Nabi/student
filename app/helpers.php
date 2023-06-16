<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Integer;

if (!function_exists('authUser')) {
    function authUser():  ? User
    {
        if (Auth::check()) {
            return Auth::user();
        }

        return null;
    }
}

if (!function_exists('rootId')) {
    function rootId():  ? int
    {
        return auth()->user()->parent_id ?? auth()->user()->id;
    }
}

