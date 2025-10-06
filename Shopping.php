<?php
include_once("connect/config.php");
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="shopping.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

<?php include("header.php"); ?>


<div class="main">
    <div class="maintext">
        <h1>Great deals and exciting offers</h1>
        <h2>Save upto 30%</h2>
        <p>We bring the best quality and trending cloths to you in a pocket-friendly budget for you to explore fashion and style the best version of you.</p>
    </div>
    <img src="images/dress.jpg" alt="Main Fashion Image" />
</div>


<div class="cloth">
    <div class="head">
        <h1>Trending Men <span>Fashion</span></h1>
    </div>
    <div class="card">
        <?php
        $men = mysqli_query($con, "SELECT * FROM products WHERE category='men'");
        while ($row = mysqli_fetch_assoc($men)) {
            echo "<div class='trend'>
                <img src='upload/{$row['image']}' />
                <div class='text'>
                    <p>{$row['name']}</p>
                    <h2>\${$row['price']} 
                        <a href='cart.php?add={$row['id']}' class='add-cart-btn'>Add to Cart</a>
                    </h2>
                </div>
            </div>";
        }
        ?>
    </div>
</div>

<div class="cloth">
    <div class="head">
        <h1>Trending Women <span>Fashion</span></h1>
    </div>
    <div class="card">
        <?php
        $women = mysqli_query($con, "SELECT * FROM products WHERE category='women'");
        while ($row = mysqli_fetch_assoc($women)) {
            echo "<div class='trend'>
                <img src='upload/{$row['image']}' />
                <div class='text'>
                    <p>{$row['name']}</p>
                    <h2>\${$row['price']} 
                        <a href='cart.php?add={$row['id']}' class='add-cart-btn'>Add to Cart</a>
                    </h2>
                </div>
            </div>";
        }
        ?>
    </div>
</div>

<?php include("footer.php"); ?>

</body>
</html>
