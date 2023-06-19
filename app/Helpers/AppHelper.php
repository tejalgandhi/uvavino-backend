<?php
if (! function_exists('example')) {
    function example()
    {
        return 'example';
    }
}
if (!function_exists('getUserName')) {
    function getUser()
    {
        return \Auth::user();
    }
}
if (!function_exists('getSelectedAdmin')) {
    function getSelectedAdmin()
    {
        return \Session::get('selected_admin');
    }
}
