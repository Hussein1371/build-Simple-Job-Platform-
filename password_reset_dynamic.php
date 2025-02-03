<?php
// password_reset_dynamic.php

// Set the timezone (adjust as needed)
date_default_timezone_set('UTC');

include 'db.php';

// Handle AJAX requests using the same file as endpoint
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    
    // ACTION 1: Send the reset code to the user's email (or display for testing)
    if ($_POST['action'] === 'send_code') {
        // Trim email input to remove extra spaces
        $email = trim($_POST['email']);
        
        // Check if the email exists in the users table
        $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();
        
        if ($result->num_rows > 0) {
            // Generate a 6-digit random reset code and set an expiration time (1 hour later)
            $reset_code = rand(100000, 999999);
            $expires_at = date("Y-m-d H:i:s", strtotime("+1 hour"));
            
            // Debug: Log the generated values
            error_log("Sending reset code for {$email}: code={$reset_code}, expires_at={$expires_at}");
            
            // Insert or update the reset code in the password_reset table
            $insert = $conn->prepare(
                "INSERT INTO password_reset (email, reset_code, expires_at) 
                 VALUES (?, ?, ?) 
                 ON DUPLICATE KEY UPDATE reset_code = VALUES(reset_code), expires_at = VALUES(expires_at)"
            );
            if (!$insert) {
                echo json_encode([
                    'status'  => 'error',
                    'message' => "SQL error: " . $conn->error
                ]);
                exit;
            }
            $insert->bind_param("sss", $email, $reset_code, $expires_at);
            $insert->execute();

            // For offline testing, return the reset code in the response.
            // In production, you would email the reset code to the user.
            echo json_encode([
                'status'  => 'success',
                'message' => 'Reset code sent. (For testing, your code is: ' . $reset_code . ')'
            ]);
        } else {
            echo json_encode([
                'status'  => 'error',
                'message' => 'No account found with that email.'
            ]);
        }
        exit;
    }

    // ACTION 2: Reset the password (verify the reset code and update the user's password)
    if ($_POST['action'] === 'reset_password') {
        // Trim inputs to ensure consistency
        $email        = trim($_POST['email']);
        $reset_code   = trim($_POST['reset_code']);
        $new_password = $_POST['new_password'];  // Plain text password

        // Debug: Log the reset attempt details
        error_log("Reset password attempt for email: {$email} with code: {$reset_code}");
        
        // First, check if the verification code exists in the password_reset table
        $query = $conn->prepare("SELECT * FROM password_reset WHERE email = ? AND reset_code = ?");
        $query->bind_param("ss", $email, $reset_code);
        $query->execute();
        $result = $query->get_result();
        
        if ($result->num_rows > 0) {
            // Verification code exists—update the password in the users table without hashing.
            $update = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            $update->bind_param("ss", $new_password, $email);
            $update->execute();

            // Remove the reset code from the password_reset table after a successful update
            $delete = $conn->prepare("DELETE FROM password_reset WHERE email = ?");
            $delete->bind_param("s", $email);
            $delete->execute();

            error_log("Password successfully reset for email: {$email}");
            
            echo json_encode([
                'status'  => 'success',
                'message' => 'Password has been successfully reset.'
            ]);
        } else {
            // Log an error if no matching record is found
            error_log("No matching reset record found for email: {$email} with code: {$reset_code}");
            
            echo json_encode([
                'status'  => 'error',
                'message' => 'Invalid verification code.'
            ]);
        }
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styles.css">
  <title>Password Reset</title>
  <script>
    // Function to send the reset code request via AJAX
    function sendResetCode() {
      var email = document.getElementById('email').value;
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          alert(response.message);
          if (response.status === 'success') {
            // Reveal the section for entering the verification code and new password
            document.getElementById('codeSection').style.display = 'block';
          }
        }
      };
      xhr.send('action=send_code&email=' + encodeURIComponent(email));
      return false; // Prevent default form submission
    }

    // Function to send the reset password request via AJAX
    function resetPassword() {
      var email = document.getElementById('email').value;
      var reset_code = document.getElementById('reset_code').value;
      var new_password = document.getElementById('new_password').value;
      
      console.log("Resetting password for:", email, reset_code, new_password);
      
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          alert(response.message);
          if (response.status === 'success') {
            // Redirect to the login page after a successful password reset
            window.location.href = 'login.php';
          }
        }
      };
      xhr.send('action=reset_password&email=' + encodeURIComponent(email) +
               '&reset_code=' + encodeURIComponent(reset_code) +
               '&new_password=' + encodeURIComponent(new_password));
      return false; // Prevent default form submission
    }
  </script>
</head>
<body>
  <h2>Password Reset</h2>

  <!-- Form to request the reset code -->
  <form onsubmit="return sendResetCode();">
    <label for="email">Enter your email:</label>
    <input type="email" id="email" name="email" required>
    <button type="submit">Send Reset Code</button>
  </form>

  <!-- Hidden section: After the reset code is sent, this section appears -->
  <div id="codeSection" style="display:none; margin-top:20px;">
    <form onsubmit="return resetPassword();">
      <label for="reset_code">Reset Code:</label>
      <input type="text" id="reset_code" name="reset_code" required>
      <br><br>
      <label for="new_password">New Password:</label>
      <input type="password" id="new_password" name="new_password" required>
      <br><br>
      <button type="submit">Reset Password</button>
    </form>
  </div>
</body>
</html>
