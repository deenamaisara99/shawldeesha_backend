<?php 

//get all products
function getCustomers($db)
{
    $sql = 'Select * from customers';
    $stmt = $db->prepare ($sql);
    $stmt ->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addCustomer($db, $form_data) 
{
    $sql = 'Insert into customers (name, phone, address)';
    $sql .= 'values (:name, :phone, :address) ';
    $stmt = $db->prepare ($sql);
    $stmt->bindParam(':name', $form_data['name']); 
    $stmt->bindParam(':phone', $form_data['phone']);
    $stmt->bindParam(':address', $form_data['address']);
    $stmt->execute();
}