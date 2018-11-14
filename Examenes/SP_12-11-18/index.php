<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';

include_once './API/TokenAPI.php';
include_once './API/CompraAPI.php';
include_once './MDW/TokenMiddleware.php';
include_once './MDW/HistorialMiddleware.php';
include_once './MDW/MWparaCORS.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);


$app->post('/usuario[/]', \TokenAPI::class . ':AltaUsuario')
    ->add(\HistorialMiddleware::class . ':GenerarHistorial');

$app->post('/login[/]', \TokenAPI::class . ':GenerarToken')
    ->add(\HistorialMiddleware::class . ':GenerarHistorial');

$app->get('/usuario[/]', \TokenAPI::class . ':ListaUsuarios')
    ->add(\HistorialMiddleware::class . ':GenerarHistorial')
    ->add(\TokenMiddleware::class . ':ValidarAdmin')
    ->add(\TokenMiddleware::class . ':ValidarToken');

$app->post('/compra[/]', \CompraAPI::class . ':AltaCompra')
    ->add(\HistorialMiddleware::class . ':GenerarHistorial')
    ->add(\TokenMiddleware::class . ':ValidarToken');

$app->get('/compra[/]', \CompraAPI::class . ':TraerComprasUsuario')
    ->add(\HistorialMiddleware::class . ':GenerarHistorial')
    ->add(\TokenMiddleware::class . ':ValidarToken');

$app->get('/compra/{marca}[/]', \CompraAPI::class . ':TraerMarcas')
    ->add(\HistorialMiddleware::class . ':GenerarHistorial')
    ->add(\TokenMiddleware::class . ':ValidarAdmin')
    ->add(\TokenMiddleware::class . ':ValidarToken');

$app->get('/productos[/]', \CompraAPI::class . ':TraerVentas')
    ->add(\HistorialMiddleware::class . ':GenerarHistorial')
    ->add(\TokenMiddleware::class . ':ValidarToken');

$app->run();

?>