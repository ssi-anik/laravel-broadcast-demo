<?php

use Illuminate\Support\Facades\Cache;

if (!function_exists('active_user_count')) {
    function active_user_count () {
        return Cache::get('active-user', collect())->count();
    }
}

if (!function_exists('increase_active_user')) {
    function increase_active_user ($uid) {
        $users = Cache::get('active-user', collect());
        if (!$users->contains($uid)) {
            $users->push($uid);
            Cache::forever('active-user', $users);
        }
    }
}

if (!function_exists('decrease_active_user')) {
    function decrease_active_user ($uid) {
        $users = Cache::get('active-user', collect());
        if ($users->contains($uid)) {
            $users = $users->reject(function ($item) use ($uid) {
                return $item == $uid;
            })->values();
            Cache::forever('active-user', $users);
        }
    }
}