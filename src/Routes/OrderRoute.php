<?php

use Slim\Http\Request;
use Slim\Http\Response;

//include productTProc.php file
include __DIR__ . '/../Controllers/OrderController.php';

//read table products
$app->get('/orders', function (Request $request, Response $response, 
array $arg){
    $data = getOrders($this->db);
    return $this->response->withJson($data, 200);
});



//code to apply method POST (add product into order)
$app->post('/order/add', function ($request, $response, $args) {
    $form_data = $request->getParsedBody();
    $user = addCustomer ($this->db, $form_data);
    $data = addOrder($this->db, $form_data);
// if ($data <= 0) {
//     return $this->response->withJson(array('error' => 'add order fail'), 500);
// }
    return $this->response->withJson(array('add order' => 'success'), 201);
});