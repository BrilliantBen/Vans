<?php
session_start();

define('DS', DIRECTORY_SEPARATOR);
define('WWW_ROOT', __DIR__ . DS);

$routes = array(
    'home' => array(
    	'controller' => 'Overviews',
    	'action' => 'home'
		),
    'design' => array(
   	'controller' => 'Overviews',
    'action' => 'design'
		),
    'gallery' => array(
   	'controller' => 'Shoes',
    'action' => 'gallery'
		),
    'save' => array(
    'controller' => 'Overviews',
    'action' => 'save'
    )
);

if(empty($_GET['page'])) {
    $_GET['page'] = 'home';
}

if(empty($routes[$_GET['page']])) {
    header('Location: index.php?page=home');
    exit();
}

$route = $routes[$_GET['page']];
$controllerName = $route['controller'] . 'Controller';

require_once WWW_ROOT . 'controller' . DS . $controllerName . ".php";

$controllerObj = new $controllerName();
$controllerObj->route = $route;
$controllerObj->filter();
$controllerObj->render();
