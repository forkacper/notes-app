<?php

declare(strict_types=1);

namespace App;

require_once("src/Utils/debug.php");
require_once("src/Controller.php");

$request = [
    'get' => $_GET,
    'post' => $_POST
];

//$controller->run();
//$controller = new Controller($request);

(new Controller($request))->run();



