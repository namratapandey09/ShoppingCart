<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['add'])) {
    include("connect/config.php");
    $id = $_GET['add'];
    $product_query = mysqli_query($con, "SELECT * FROM products WHERE id='$id'");
    if ($row = mysqli_fetch_assoc($product_query)) {
        $found = false;
        
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['name'] === $row['name']) {
                $item['quantity']++;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $_SESSION['cart'][] = [
                'name' => $row['name'],
                'price' => $row['price'],
                'image' => 'upload/'.$row['image'],
                'quantity' => 1
            ];
        }
    }
    header("Location: cart.php");
    exit();
}
if (isset($_POST['add_to_cart'])) {
    $name = $_POST['product_name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $found = false;

    foreach ($_SESSION['cart'] as &$item) {
        if ($item['name'] === $name) {
            $item['quantity']++;
            $found = true;
            break;
        }
    }
    if (!$found) {
        $_SESSION['cart'][] = [
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'quantity' => 1
        ];
    }
    header("Location: explore.php?msg=added");
    exit();
}


if (isset($_GET['remove'])) {
    $removeName = $_GET['remove'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['name'] === $removeName) {
            unset($_SESSION['cart'][$key]);
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']); 
    header("Location: cart.php");
    exit();
}


if (isset($_GET['action']) && isset($_GET['name'])) {
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['name'] === $_GET['name']) {
            if ($_GET['action'] === "increase") {
                $item['quantity']++;
            } elseif ($_GET['action'] === "decrease" && $item['quantity'] > 1) {
                $item['quantity']--;
            }
            break;
        }
    }
    header("Location: cart.php");
    exit();
}

include("header.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="cart.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
  <div class="container">
    <h1>Your Shopping Cart</h1>

    <?php if (!empty($_SESSION['cart'])): ?>
      <table class="cart-table">
        <thead>
          <tr>
            <th>Product</th>
            <th>Image</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $total = 0;
          foreach ($_SESSION['cart'] as $item): 
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
          ?>
          <tr>
            <td><?php echo htmlspecialchars($item['name']); ?></td>
            <td><img src="<?php echo htmlspecialchars($item['image']); ?>" alt="" class="cart-img"></td>
            <td>$<?php echo $item['price']; ?></td>
            <td>
              <a href="cart.php?action=decrease&name=<?php echo urlencode($item['name']); ?>" class="qty-btn">-</a>
              <?php echo $item['quantity']; ?>
              <a href="cart.php?action=increase&name=<?php echo urlencode($item['name']); ?>" class="qty-btn">+</a>
            </td>
            <td>$<?php echo $subtotal; ?></td>
            <td><a href="cart.php?remove=<?php echo urlencode($item['name']); ?>" class="remove-btn">Remove</a></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div class="cart-total">
        <h2>Total: $<?php echo $total; ?></h2>
        <a href="cart.php" class="checkout-btn">Proceed to Checkout</a>
        <a href="shopping.php" class="continue-btn">Continue Shopping</a>
      </div>

    <?php else: ?>
      <p class="empty">Your cart is empty. <a href="shopping.php">Go shopping</a>!</p>
    <?php endif; ?>
  </div>

  <?php include("footer.php"); ?>
</body>
</html>
