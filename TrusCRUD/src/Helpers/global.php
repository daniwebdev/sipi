<?php

use App\Helpers\Role;
use TrusCRUD\Core\Models\UserProvider;
use Illuminate\Support\Facades\Log;

//Role Allowed
function is_allow($action_name) {

    return Role::isAllow($action_name);
}

//Get Image Avatar
function avatar_image($user) {
    return isset($user->get_avatar->url) == '' ? url('data/images/default.png') :$user->get_avatar->url;
}

//Count Notification Unread
function count_notify($user) {
    // dd($user);
    $notify = $user->notifications()->where('read_at', NULL)->count();
    return $notify;
}

//Check Socialite Connected
function has_provider($user_id, $provider) {
    $provider = UserProvider::where('user_id', $user_id)->where('provider', $provider)->count();

    return $provider;
}

function is_super() {
    return auth()->user()->isSuper();
}

//TrusLabs Config
function conf($name) {
    return config('truslabs.'.$name);
}

function write_log($label, $data=null) {
    return Log::channel('all')->info($label);
}