<?php
include("header.php");
session_start();
include("./connect/config.php");

if (isset($_POST['submit'])) {
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $password = $_POST['password'];
    $address  = $_POST['address'];
    $mobile   = $_POST['mobile'];

    $profile = $_FILES['profile']['name'];
    $tmp     = $_FILES['profile']['tmp_name'];
    $folder  = "uploads/" . $profile;

    move_uploaded_file($tmp, $folder);

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $query = "INSERT INTO customer (name, email, password, address, mobile, profile) 
              VALUES ('$name', '$email', '$hashed_password', '$address', '$mobile', '$folder')";
    
    if (mysqli_query($con, $query)) {
       
        $_SESSION['user_name']    = $name;
        $_SESSION['user_email']   = $email;
        $_SESSION['user_address'] = $address;
        $_SESSION['user_mobile']  = $mobile;
        $_SESSION['user_profile'] = $folder;

    
        header("Location: signin.php");
        exit();
    } else {
        $error = "Email already exists or invalid input.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
    <link rel="stylesheet" href="signin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <div class="signin-container">
        <?php if (isset($_SESSION['user_email'])): ?>
            
            <h2>Your Profile Info</h2>
            <div class="user-info">
                <div class="profile-img">
                    <img src="<?php echo htmlspecialchars($_SESSION['user_profile']); ?>" alt="User Profile">
                </div>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($_SESSION['user_address']); ?></p>
                <p><strong>Mobile:</strong> <?php echo htmlspecialchars($_SESSION['user_mobile']); ?></p>
                <a href="logout.php" class="btn-submit" >Logout</a>
            </div>
        <?php else: ?>
           
            <h2>Sign In</h2>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            <form method="POST" enctype="multipart/form-data">
                <label>Name:</label>
                <input type="text" name="name" required>

                <label>Email:</label>
                <input type="email" name="email" required>

                <label>Password:</label>
                <input type="password" name="password" required>

                <label>Address:</label>
                <input type="text" name="address" required>

                <label>Mobile:</label>
                <input type="text" name="mobile" required>

                <label>Profile Picture:</label>
                <input type="file" name="profile" required>

                <button type="submit" name="submit" class="btn-submit">Sign In</button>
            </form>
        <?php endif; ?>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>
