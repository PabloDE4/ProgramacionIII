<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';

include_once './API/TokenAPI.php';
include_once './MDW/TokenMiddleware.php';
include_once './MDW/MWparaCORS.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

$app->group('/usuario', function () {
    $this->post('/login', \TokenAPI::class . ':GenerarToken');
    $this->get('/', \TokenAPI::class . ':ListaUsuarios')
        ->add(\TokenMiddleware::class . ':ValidarAdmin')
        ->add(\TokenMiddleware::class . ':ValidarToken');
});

$app->run();

?>