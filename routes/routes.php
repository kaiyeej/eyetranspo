<?php

$request = $_SERVER['REQUEST_URI'];

/** SET ROUTES HERE */
// insert routes alphabetically
$routes = array(
    "homepage" => array(
        'class_name' => 'Homepage',
        'has_detail' => 0
    ),
    "users" => array(
        'class_name' => 'Users',
        'has_detail' => 0
    ),
    "buses" => array(
        'class_name' => 'Buses',
        'has_detail' => 0
    ),
    "drivers" => array(
        'class_name' => 'Drivers',
        'has_detail' => 0
    ),
    "bus-routes" => array(
        'class_name' => 'BusRoutes',
        'has_detail' => 0
    ),
    "trips" => array(
        'class_name' => 'Trips',
        'has_detail' => 0
    ),
    "trip-schedule" => array(
        'class_name' => 'TripSchedule',
        'has_detail' => 0
    ),
    "transactions" => array(
        'class_name' => 'Transactions',
        'has_detail' => 0
    ),
    "bus-history" => array(
        'class_name' => 'BusHistory',
        'has_detail' => 0
    ),
    "passenger-complaints" => array(
        'class_name' => 'BusHistory',
        'has_detail' => 0
    ),
    "daily-passengers" => array(
        'class_name' => 'BusHistory',
        'has_detail' => 0
    ),
    "profile" => array(
        'class_name' => 'Profile',
        'has_detail' => 0
    ),
);
/** END SET ROUTES */


$base_folder = "pages/";
$page = str_replace("/", "", $request);

// chec if has parameters
if (substr_count($page, "?") > 0) {
    $url_params = explode("?", $page);
    $dir = $base_folder . $url_params[0] . '/index.php';
    //$param = $url_params[1];
    $page = $url_params[0];
} else {

    if ($page == "" || $page == null) {
        $page = "homepage";
    }
    $dir = $base_folder . $page . '/index.php';
}

if (array_key_exists($page, $routes)) {
    require_once $dir;
    $route_settings = json_encode($routes[$page]);
} else {
    require_once '404.php';
    $route_settings = json_encode([]);
}
