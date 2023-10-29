<?php

$ip_address = gethostbyname('api.stripe.com');
if ($ip_address === 'api.stripe.com' || !filter_var($ip_address, FILTER_VALIDATE_IP)) {
    die("Error: Could not resolve host: api.stripe.com");
}

require_once 'stripe-php-master/init.php'; // Replace with the actual path to the Stripe library
\Stripe\Stripe::setApiKey('sk_test_NUH UH');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['product_name']) && !empty($_POST['product_price'])) {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];

        try {
            $product = \Stripe\Product::create([
                'name' => $product_name,
            ]);

            \Stripe\Price::create([
                'product' => $product->id,
                'unit_amount' => $product_price, 
                'currency' => 'usd', 
            ]);

            // Display the product ID
            echo "Product '$product_name' with price $product_price has been created in Stripe.<br>";
            echo "Product ID: " . $product->id;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            echo 'Error: Authentication error. Check your API key.';
        } catch (\Stripe\Exception\ApiErrorException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo 'Product name and price are required.';
    }
}