<?php

use Slim\Http\Request;
use Slim\Http\Response;

//include productProc.php file
include __DIR__ . '/../Controllers/CustomerController.php';

//read table products
$app->get('/customers', function (Request $request, Response $response, 
array $arg){
    $data = getCustomers($this->db);
    return $this->response->withJson($data, 200);
});