<?php
session_start();

if (!isset($_SESSION['products']) || !is_array($_SESSION['products'])) {
    $_SESSION['products'] = [];
}


if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode([]);
    exit;
}


$availableProducts = [];

foreach ($_SESSION['products'] as $product) {


    if (
        isset($product['name']) &&
        isset($product['type']) &&
        isset($product['price'])
    ) {
        $availableProducts[] = $product;
    }
}

header("Content-Type: application/json");
echo json_encode($availableProducts);
exit;
