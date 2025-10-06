<?php 
session_start(); 
include("header.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About Us - Shopping Cart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="about.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

<section class="about-section">
  <h2>Welcome to Our Shopping World!</h2>
  <p>
    We're passionate about fashion and affordability. Our Shopping Cart offers trendy and premium-quality outfits for men and women. Whether you're looking for a comfy everyday style or something bold and new, we are here to serve your fashion cravings!
  </p>
  <p>
    Our vision is to make online shopping fun, smooth, and budget-friendly. With secure checkout, fast delivery, and a wide range of collections, your next favorite outfit is just a click away!
  </p>
</section>

<section class="photo-showcase">
  <h2>Our Style Gallery</h2>
  <div class="gallery">
  <div class="gallery-item">
    <img src="./images/sustainablefashion.jpg" alt="Fashion 1">
    <p class="caption">Sustainable Fashion Styles</p>
  </div>
  <div class="gallery-item">
    <img src="./images/celebritylook.jpg" alt="Fashion 2">
    <p class="caption">Celebrity-Inspired Looks</p>
  </div>
  <div class="gallery-item">
    <img src="./images/galleryimg.jpg" alt="Fashion 3">
    <p class="caption">Formal Vibe Trend</p>
  </div>
  <div class="gallery-item">
    <img src="./images/galleryimg2.jpg" alt="Fashion 4">
    <p class="caption">Elegant Evening Styles</p>
  </div>
</div>

</section>



<?php include("footer.php"); ?>
</body>
</html>
