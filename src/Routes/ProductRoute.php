<?php

use Slim\Http\Request;
use Slim\Http\Response;

//include productProc.php file
include __DIR__ . '/../Controllers/ProductController.php';

//read table products
$app->get('/products', function (Request $request, Response $response, 
array $arg){
    $data = getAllProduct($this->db);
    return $this->response->withJson($data, 200);
});

//request table products by condition
$app->get('/products/[{id}]', function ($request, $response, $args){

    $productId = $args['id'];
    if (!is_numeric($productId)) {
        return $this->response->withJson(array('error' => 'numeric parameter required'), 422);
    }
    $data = getProducts($this->db, $productId);
    if (empty($data)) {
        return $this->response->withJson(array('error' => 'no data'), 404);
    }

        return $this->response->withJson(array('data' => $data), 200);
});

//code to apply method POST (add)
$app->post('/products/add', function ($request, $response, $args) {
    $form_data = $request->getParsedBody();
    $data = createProducts($this->db, $form_data);
if ($data <= 0) {
    return $this->response->withJson(array('error' => 'add data fail'), 500);
}
return $this->response->withJson(array('add data' => 'success'), 201);
});

//code to apply method PUT (update)
$app->put('/products/update/[{id}]', function ($request, $response, $args) {
    $productId = $args['id'];
    if (!is_numeric($productId)) {
        return $this->response->withJson(array('error' => 'numeric parameter required'), 422);
    }
    $form_data = $request->getParsedBody();
    $data = updateProducts($this->db, $productId, $form_data);
    if ($data <= 0) {
        return $this->response->withJson(array('error' => 'update data fail'), 500);
    }
    return $this->response->withJson(array('update data' => 'success'), 201);
});

//code to apply method DELETE
$app->delete('/products/del/[{id}]', function ($request, $response, $args) {
    $productId = $args['id'];
    $data = deleteProducts($this->db, $productId);
    if (!is_numeric($productId)) {
        return $this->response->withJson(array('error' => 'numeric parameter required'), 422);
    }
    $data = deleteProducts($this->db, $productId);
    if (empty($data)) {
        return $this->response->withJson(array('delete' => 'success'), 200);
    }
    return $this->response->withJson(array('delete' => 'fail'), 404);
});