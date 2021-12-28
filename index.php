<?php

declare(strict_types=1);

namespace App;

use App\Exception\AppException;
use App\Exception\ConfigurationException;
use Throwable;

require_once("src/Utils/debug.php");
require_once("src/Controller.php");
require_once("src/Exception/AppException.php");

$configuration = require_once("config/config.php");

$request = [
  'get' => $_GET,
  'post' => $_POST
];

try {
    //$controller = new Controller($request);
    //$controller->run();

    Controller::initConfiguration($configuration);
    (new Controller($request))->run();
} catch (ConfigurationException $e) {
    echo "Wystąpił błąd w aplikacji";
    echo "Błąd w konfiugracji";
} catch (AppException $e) {
    echo "Wystąpił błąd w aplikacji";
    echo $e->getMessage();
} catch (Throwable $e) {
    echo "Wystąpił błąd w aplikacji";
}