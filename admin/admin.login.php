<?php
session_start();
include_once("../connect/config.php");

$error = "";
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $run = mysqli_query($con, $query);

    if (!$run) {
        die("Query failed: " . mysqli_error($con));
    }

    if (mysqli_num_rows($run) > 0) {
        $_SESSION['admin'] = $email;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="admin.login.css">
  <link rel="stylesheet" href="../header.css">
  <link rel="stylesheet" href="../footer.css">

</head>
<body>
  <div class="page-wrapper">
      <?php include("../header.php"); ?>

      <main class="content">
          <div class="login-container">
              <div class="login-card">
                  <h2>Admin Login</h2>
                  <form method="POST">

                            <?php if (!empty($error)): ?>
    <div class="error-message"><?php echo $error; ?></div>
<?php endif; ?>

                      <input type="email" name="email" placeholder="Admin Email" required>
                      <input type="password" name="password" placeholder="Password" required>
                      <button type="submit" name="login">Login</button>
                  </form>
         

              </div>
          </div>
      </main>

      <?php include("../footer.php"); ?>
  </div>


  <script>
document.addEventListener("DOMContentLoaded", function () {
    const errorMsg = document.querySelector(".error-message");
    if (errorMsg) {
        setTimeout(() => {
            errorMsg.classList.add("fade-out");

            // Wait for fade-out, then remove and reset URL
            setTimeout(() => {
                errorMsg.remove();

                // Reset URL without reloading (removes query params if any)
                if (window.history.replaceState) {
                    const cleanUrl = window.location.origin + window.location.pathname;
                    window.history.replaceState({}, document.title, cleanUrl);
                }
            }, 600); // matches fadeOut animation duration
        }, 3000); // show for 3 seconds
    }
});
</script>

</body>

</html>
