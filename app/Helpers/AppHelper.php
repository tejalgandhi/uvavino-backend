<?php
if (! function_exists('example')) {
    function example()
    {
        return 'example';
    }
}
if (!function_exists('getUser')) {
    function getUser()
    {
        return backpack_auth()->user();
    }
}
if (!function_exists('getSelectedAdmin')) {
    function getSelectedAdmin()
    {
        return \Session::get('selected_admin');
    }
}
