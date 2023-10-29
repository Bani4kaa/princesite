<?php
$ip_address = gethostbyname('api.stripe.com');
if ($ip_address === 'api.stripe.com' || !filter_var($ip_address, FILTER_VALIDATE_IP)) {
    die("Error: Could not resolve host: api.stripe.com");
}
require_once 'stripe-php-master/init.php'; // Replace with the actual path to the Stripe library
\Stripe\Stripe::setApiKey('sk_test_NUH UH');

if (isset($_POST['search']) && !empty($_POST['search'])) {
    $search = $_POST['search'];

    try {
        $products = \Stripe\Product::all(['limit' => 10]);

        foreach ($products->data as $product) {
            if (stripos($product->name, $search) !== false) {
                echo '<li><a href="#">Product Name: ' . $product->name . ' (ID: ' . $product->id . ')</a></li>';
            }
        }
    } catch (\Stripe\Exception\AuthenticationException $e) {
        echo 'Error: Authentication error. Check your API key.';
    } catch (\Stripe\Exception\ApiErrorException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    try {
        $products = \Stripe\Product::all(['limit' => 10]);

        foreach ($products->data as $product) {
            echo '<li><a href="#">Product Name: ' . $product->name . ' (ID: ' . $product->id . ')</a></li>';
        }
    } catch (\Stripe\Exception\AuthenticationException $e) {
        echo 'Error: Authentication error. Check your API key.';
    } catch (\Stripe\Exception\ApiErrorException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}