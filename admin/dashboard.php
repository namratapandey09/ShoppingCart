<?php
session_start();
include("../connect/config.php");

if(isset($_GET['delete'])){
    $del_id = $_GET['delete'];

    $res = mysqli_query($con, "SELECT image FROM products WHERE id='$del_id'");
    $row = mysqli_fetch_assoc($res);
    if($row['image'] && file_exists('../upload/'.$row['image'])){
        unlink('../upload/'.$row['image']);
    }

    mysqli_query($con, "DELETE FROM products WHERE id='$del_id'");
    echo "<script>window.location.href='/shoppingcart/admin/dashboard.php#product-list';</script>";
    exit();
}

$edit_product = null;
if(isset($_GET['edit'])){
    $edit_id = intval($_GET['edit']);
    $res = mysqli_query($con, "SELECT * FROM products WHERE id='$edit_id'");
    if(mysqli_num_rows($res) > 0){
        $edit_product = mysqli_fetch_assoc($res);
    } else {
        echo "<script>alert('Product not found'); window.location.href='/shoppingcart/admin/dashboard.php#product-list';</script>";
        exit();
    }
}


if(isset($_POST['update_product'])){
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $category = mysqli_real_escape_string($con, $_POST['category']);

    $img_query = "";
    if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
        $image = time().'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../upload/'.$image);
        $img_query = ", image='$image'";
    }

    mysqli_query($con, "UPDATE products SET name='$name', price='$price', category='$category' $img_query WHERE id='$id'");
    echo "<script>window.location.href='/shoppingcart/admin/dashboard.php';</script>";
    exit();
}


if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $category = mysqli_real_escape_string($con, $_POST['category']);

    $image = time().'_'.$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], '../upload/'.$image);

    mysqli_query($con, "INSERT INTO products(name, price, category, image) VALUES('$name','$price','$category','$image')");
    echo "<script>window.location.href='/shoppingcart/admin/dashboard.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" href="../header.css">
<link rel="stylesheet" href="../footer.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<style>
html { scroll-behavior: smooth; }
table { width:100%; border-collapse: collapse; margin-top:40px; padding: 20px; }
table, th, td { border:1px solid #ccc; }
th, td { padding:10px; text-align:center; }
.edit-btn, .delete-btn { padding:5px 10px; border:none; border-radius:4px; cursor:pointer; color:#fff; text-decoration:none; }
.edit-btn { background-color:#ff6600; }
.delete-btn { background-color:#cc0000; }
.edit-btn:hover, .delete-btn:hover { opacity:0.8; }
form input, form select, form button { padding:8px; margin:5px 0; width:100%; max-width:300px; }
img.table-img { width:60px; height:auto; }
.edit-form{
   background: white;
  max-width: 500px;
  height: 420px;
  margin: 60px auto;
  padding: 60px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
</style>
</head>
<body>

<?php include("../header.php"); ?>

<div class="container">

    <div class="section-header" id="upload-section">
        <h1>Upload Product</h1>
    </div>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Product Name" required><br>
        <input type="number" name="price" placeholder="Price" required><br>
        <select name="category" required>
            <option value="" disabled selected hidden>Select Category</option>
            <option value="men">Men</option>
            <option value="women">Women</option>
        </select><br>
        <input type="file" name="image" required><br>
        <button type="submit" name="submit">Upload Product</button>
    </form>

    <div class="section-header" id="product-list">
        <h1>All Products</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $res = mysqli_query($con,"SELECT * FROM products ORDER BY id DESC");
            while($row = mysqli_fetch_assoc($res)){
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>".htmlspecialchars($row['name'])."</td>
                    <td>\${$row['price']}</td>
                    <td>{$row['category']}</td>
                    <td><img src='upload/{$row['image']}' class='table-img'></td>
                    <td>
                        <a href='/shoppingcart/admin/dashboard.php?edit={$row['id']}#edit-section' class='edit-btn'>Edit</a>
                        <a href='/shoppingcart/admin/dashboard.php?delete={$row['id']}#product-list' class='delete-btn' onclick=\"return confirm('Are you sure?')\">Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
<?php if($edit_product): ?>
    <div class="section-header" id="edit-section">
        <h1>Edit Product</h1>
    </div>

    <form action="/shoppingcart/admin/dashboard.php#edit-section" method="POST" enctype="multipart/form-data" class="edit-form">
        <input type="hidden" name="id" value="<?php echo $edit_product['id']; ?>">
        <input type="text" name="name" value="<?php echo htmlspecialchars($edit_product['name']); ?>" required><br>
        <input type="number" name="price" value="<?php echo $edit_product['price']; ?>" required><br>
        <select name="category" required>
            <option value="men" <?php if($edit_product['category']=='men') echo 'selected'; ?>>Men</option>
            <option value="women" <?php if($edit_product['category']=='women') echo 'selected'; ?>>Women</option>
        </select><br>
        <input type="file" name="image"><br>
        <img src="upload/<?php echo $edit_product['image']; ?>" width="80"><br>
        <button type="submit" name="update_product" style="background-color: #ffc600; border: 2px solid gray; border-radius: 5px;">Update Product</button>
    </form>
<?php endif; ?>


</div>

<?php include("../footer.php"); ?>

</body>
</html>
