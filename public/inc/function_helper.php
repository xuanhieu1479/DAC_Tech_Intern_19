<?php

function get_csrf_token()
{
    return '<input type="hidden" name="_token" value=' . csrf_token() . '>';
}

function return_first_group($current_group = null)
{
    if ($current_group != null) return DB::table('groups')->where('group_name', $current_group)->first();
    else return DB::table('groups')->first();
}

function hidden_if_unauthorized() {
    if (!Auth::check()) {
        return ' hidden';                
    }
    else if (Auth::user()->isAdmin != 1) {
        return ' hidden';
    }
    return '';
}

function disable_if_unauthorized() {
    if (!Auth::check()) {
        return ' disabled';                
    }
    else if (Auth::user()->isAdmin != 1) {
        return ' disabled';
    }
    return '';
}

function get_error_message($from = 'status') {
    if (Session::has($from)) {
        return Session::get($from);
    }
}