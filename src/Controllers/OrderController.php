<?php 

//get all products
function getOrders($db)
{
    $sql = "SELECT products.name, orders.quantity, customers.name as customer, customers.address as address FROM orders ";
    $sql .= "INNER JOIN products on products.id = orders.productID ";
    $sql .= "INNER JOIN customers ON customers.id = orders.orderID";
    $stmt = $db->prepare ($sql);
    $stmt ->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//add new order (buy button)
function addOrder ($db, $form_data) {
    $qty = (int) $form_data['quantity'];
    $productID = (int) $form_data['product_id'];

    $sql = 'Insert into orders (quantity, productID) ';
    $sql .= 'values (:quantity, :productID)';
    $stmt = $db->prepare ($sql);
    $stmt->bindParam(':quantity', $form_data['quantity'], PDO::PARAM_INT);
    $stmt->bindParam(':productID', $form_data['product_id'], PDO::PARAM_INT);
    $stmt->execute();

    // Call function to deduct stock from products table
    deductStock($db,$qty, $productID);

    return $db->lastInsertID(); //insert last number.. continue
}

function deductStock($db, $quantity, $productID)
{
    $query = 'UPDATE products SET stock=stock - :stock WHERE id=:id';
    $statement = $db->prepare($query);
    $statement->bindParam(':stock', $quantity);
    $statement->bindParam(':id', $productID);
    $statement->execute();
}
