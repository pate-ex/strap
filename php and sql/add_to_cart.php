<?php
include 'config.php';

if (!is_logged_in()) {
    redirect('login.php');
}

if (isset($_GET['id'])) {
    $product_id = (int)$_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Check if product exists
    $product_sql = "SELECT id FROM products WHERE id = $product_id";
    $product_result = $conn->query($product_sql);

    if ($product_result->num_rows > 0) {
        // Check if already in cart
        $check_sql = "SELECT id, quantity FROM cart WHERE user_id = $user_id AND product_id = $product_id";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows > 0) {
            // Update quantity
            $cart_item = $check_result->fetch_assoc();
            $new_quantity = $cart_item['quantity'] + 1;
            $update_sql = "UPDATE cart SET quantity = $new_quantity WHERE id = " . $cart_item['id'];
            $conn->query($update_sql);
        } else {
            // Add to cart
            $insert_sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, 1)";
            $conn->query($insert_sql);
        }
    }
}

redirect('view_cart.php');
?>