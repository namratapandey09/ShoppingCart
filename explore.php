<?php 
session_start(); 
include("header.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Explore Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="explore.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

<div class="container">

  <div class="section-header">
    <h1>Explore Our Collection</h1>
  </div>

  <h2 class="section-heading">Trending Men's Collection</h2>
  <div class="dress-grid">
<div class="dress-card">
    <span class="tag">New</span>
    <img src="./images/classicshirt.jpg" alt="Classic Shirt">
    <div class="text">
        <p>Classic Shirt</p>
        <div class="stars">★★★★☆</div>
        <h2>Starting at $25</h2>
         <a href="explore.php" class="explore-btn">Explore More</a>
    </div>
</div>

<div class="dress-card">
    <img src="./images/mensjacket.jpg" alt="Winter Jacket">
    <div class="text">
        <p>Winter Jacket</p>
        <div class="stars">★★★★★</div>
        <h2>Starting at $40</h2>
         <a href="explore.php" class="explore-btn">Explore More</a>
    </div>
</div>
</div>


      <h2 class="section-heading">Trending Women's Collection</h2>
<div class="dress-grid">
<div class="dress-card">
    <img src="./images/floraldress.jpg" alt="Floral Dress">
    <div class="text">
        <p>Floral Dress</p>
        <div class="stars">★★★★☆</div>
        <h2>Starting at $30</h2>
         <a href="explore.php" class="explore-btn">Explore More</a>
    </div>
</div>

<div class="dress-card">
    <span class="tag">New</span>
    <img src="./images/stylishtop.jpg" alt="Stylish Top">
    <div class="text">
        <p>Stylish Top</p>
        <div class="stars">★★★☆☆</div>
        <h2>Starting at $20</h2>
        <a href="explore.php" class="explore-btn">Explore More</a>
    </div>
</div>
</div>

<!-- Reviews Section -->
<section class="reviews">
  <h2>Customer Reviews</h2>
  <div class="review-box">
    <p>"Absolutely loved the fit and quality! The product exceeded my expectations."</p>
    <h4>- Priya Sharma</h4>
  </div>
  <div class="review-box">
    <p>"Delivery was fast and the customer support was helpful. Highly recommended!"</p>
    <h4>- Rahul Verma</h4>
  </div>
</section>

<?php include("footer.php"); ?>

</body>
</html>
