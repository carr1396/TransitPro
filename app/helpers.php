<?php
if (!function_exists('theme') || !function_exists('isActiveRoute') || !function_exists('areActiveRoutes')) {
  function theme($path){
    $config = app('config')->get('pro.theme');
    return url($config['folder'].'/'.$config['active'].'/assets/'.$path);
  }
}
  /*
|--------------------------------------------------------------------------
| Detect Active Route
|--------------------------------------------------------------------------
|
| Compare given route with current route and return output if they match.
| Very useful for navigation, marking if the link is active.
|
*/
if (!function_exists('isActiveRoute')) {
function isActiveRoute($route, $output = "active")
{
    if (Route::currentRouteName() == $route) return $output;
}
}


/*
|--------------------------------------------------------------------------
| Detect Active Routes
|--------------------------------------------------------------------------
|
| Compare given routes with current route and return output if they match.
| Very useful for navigation, marking if the link is active.
|
*/
if ( !function_exists('areActiveRoutes')) {
function areActiveRoutes(Array $routes, $output = "active")
{
    foreach ($routes as $route)
    {
        if (Route::currentRouteName() == $route) return $output;
    }

}
}

if (!function_exists('get_featured_transit')) {

  function get_featured_transit(){
    return TransitPro\Vehicle::with('vehicle_type')->latest()->limit(4)->get();
  }
}
