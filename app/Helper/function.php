<?php


use Illuminate\Support\Facades\Session;

function has_role($permission,$permissionArray = [] ){

    if (Session::get('user_role')==='admin'){
        return true;
    }

    if (empty($permissionArray) || !is_array($permissionArray)){
        return false;
    }

    if (in_array($permission,$permissionArray)){
        return true;
    }

    return false;
}