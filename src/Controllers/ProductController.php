<?php 

//get all products
function getAllProduct($db)
{
    $sql = 'Select * from products';
    $stmt = $db->prepare ($sql);
    $stmt ->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//get product by id
function getProducts($db, $productId)
{
    $sql = 'Select p.id, p.name, p.price, p.stock, p.image, p.description, p.material, p.measurement, p.packaging from products p ';
    $sql .= 'where p.id = :id';
    $stmt = $db->prepare ($sql);
    $id = (int) $productId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//add new product
function createProducts ($db, $form_data) {
    $sql = 'Insert into products (price, name, stock, image, description, material, measurement, packaging) ';
    $sql .= 'values (:price, :name, :stock, :image, :description, :mat, :measurement, :packaging) ';
    $stmt = $db->prepare ($sql);
    $stmt->bindParam(':price', $form_data['price']);
    $stmt->bindParam(':name', $form_data['name']);
    $stmt->bindParam(':stock', $form_data['stock'], PDO::PARAM_INT);
    $stmt->bindParam(':image', $form_data['image']);
    $stmt->bindParam(':description', $form_data['description']);
    $stmt->bindParam(':mat', $form_data['material']);
    $stmt->bindParam(':measurement', $form_data['measurement']);
    $stmt->bindParam(':packaging', $form_data['packaging']);
    $stmt->execute();
    return $db->lastInsertID(); //insert last number.. continue
}

//update existing record - insert ID by url
function updateProducts($db, $productId, $form_data) {
    $sql = "UPDATE products SET price=:price, name=:name, stock=:stock, description=:description, 
    material=:material, measurement=:measurement, packaging=:packaging WHERE id=:id";

    //echo $sql
    $stmt = $db->prepare ($sql);
    $id = (int)$productId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':price', $form_data['price']);
    $stmt->bindParam(':name', $form_data['name']);
    $stmt->bindParam(':stock', $form_data['stock']);
    $stmt->bindParam(':description', $form_data['description']);
    $stmt->bindParam(':material', $form_data['material']);
    $stmt->bindParam(':measurement', $form_data['measurement']);
    $stmt->bindParam(':packaging', $form_data['packaging']);
    $stmt->execute();
    return $stmt->rowCount();
}

//delete existing record
function deleteProducts($db, $productId) {
    $sql = 'DELETE FROM products WHERE id = :id';
    $stmt = $db->prepare ($sql);
    $id = (int) $productId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

