<?php 

use Slim\Http\Request; 
use Slim\Http\Response;

//read table products
$app->get('/hello/{name}', function (Request $request, Response $response, 
array $arg){
    $name = $arg['name'];
    $response->getBody() -> write ("Hello there, $name");
    return $response;
});