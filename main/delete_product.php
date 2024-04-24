<?php
// Check if the server can resolve the host "api.stripe.com" to an IP address.
$ip_address = gethostbyname('api.stripe.com');
if ($ip_address === 'api.stripe.com' || !filter_var($ip_address, FILTER_VALIDATE_IP)) {
    die("Error: Could not resolve host: api.stripe.com");
}
require_once 'stripe-php-master/init.php';
\Stripe\Stripe::setApiKey('sk_test_NUH UH');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['product_id'])) {
        $product_id = $_POST['product_id'];

        try {
            // Retrieve the product from Stripe using the provided product ID
            $product = \Stripe\Product::retrieve($product_id);

            if ($product) {
                // Archive the product (make it inactive)
                $product->active = false;
                $product->save();
                echo "Product with ID '$product_id' has been archived in Stripe.";
            } else {
                echo "Error: Product with ID '$product_id' not found in Stripe.";
            }
        } catch (\Stripe\Exception\AuthenticationException $e) {
            echo 'Error: Authentication error. Check your API key.';
        } catch (\Stripe\Exception\ApiErrorException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo 'Product ID is required to archive a product.';
    }
}
