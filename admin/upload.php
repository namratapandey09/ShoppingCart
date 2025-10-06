<?php
include_once("../connect/config.php"); // Adjust path if needed

if (isset($_POST['submit'])) {
    $name     = $_POST['name'];
    $price    = $_POST['price'];
    $category = $_POST['category'];

    // Check if file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image = $_FILES['image']['name'];
        $temp  = $_FILES['image']['tmp_name'];

        // Move file to the upload folder
        if (move_uploaded_file($temp, "../upload/" . $image)) {
            // Save info to DB
            $query = "INSERT INTO products (name, price, category, image) 
                      VALUES ('$name', '$price', '$category', '$image')";

            if (mysqli_query($con, $query)) {
                header("Location: ../shopping.php");
                exit();
            } else {
                echo "❌ Failed to insert data into database.";
            }
        } else {
            echo "❌ Failed to upload image.";
        }
    } else {
        echo "❌ No image uploaded or error occurred.";
    }
}
?>
