<?php 
session_start(); 
include("header.php"); 

$showMessage = false;
$userName = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
        $userName = htmlspecialchars($_POST['name']);
        $userEmail = htmlspecialchars($_POST['email']);
        $userMsg = htmlspecialchars($_POST['message']);
        $showMessage = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us - Shopping Cart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="contact.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>

  <section class="contact-section">
    <h2>Get in Touch</h2>
    <p>If you have any questions, feedback, or suggestions, feel free to contact us using the form below.</p>

    <form method="POST" oninput="checkFields()">
      <label for="name">Your Name</label>
      <input type="text" name="name" id="name" required>

      <label for="email">Your Email</label>
      <input type="email" name="email" id="email" required>

      <label for="message">Message</label>
      <textarea name="message" id="message" rows="5" required></textarea>

      <button type="submit">Send Message</button>
    </form>

    <?php if ($showMessage): ?>
    <div class="popup-message" id="popup">
      <p>Thank you, <strong><?php echo $userName; ?></strong>! Your message has been sent.</p>
      <span class="close-btn" onclick="hidePopup()">&times;</span>
    </div>
    <?php endif; ?>
  </section>

  <?php include("footer.php"); ?>

  <script>
    function hidePopup() {
      const popup = document.getElementById('popup');
      if (popup) popup.style.display = 'none';
    }

    window.onload = function () {
      const popup = document.getElementById('popup');
      if (popup) {
        popup.style.display = 'block';
        setTimeout(hidePopup, 3000);
      }
    }

    function checkFields() {
      const name = document.getElementById("name").value.trim();
      const email = document.getElementById("email").value.trim();
      const message = document.getElementById("message").value.trim();
      const submitBtn = document.querySelector("form button");

      submitBtn.disabled = !(name && email && message);
    }
  </script>

</body>
</html>
