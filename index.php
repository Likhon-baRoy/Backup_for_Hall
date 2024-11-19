<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        /* Basic styles */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding-top: 60px; /* Add padding to prevent content from hiding behind the welcome message */
        }
        .header {
            display: flex;
            justify-content: flex-end;
            width: 100%;
            padding: 10px;
            position: relative;
            z-index: 1;
        }
        .profile-container {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }
        .profile-icon {
            background-color: #4CAF50;
            color: white;
            border-radius: 50%;
          padding: 10px;
        }
        /* Tooltip dropdown */
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            overflow: hidden;
            min-width: 180px;
            z-index: 2;
        }
        .dropdown-menu a {
            color: black;
            padding: 10px;
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }
        .dropdown-menu .icon {
            margin-right: 10px;
            font-size: 1.2em;
        }
        /* Welcome message styles */
        .welcome-message {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 15px 0;
            font-size: 18px;
            opacity: 1;
            transition: opacity 1s ease-out;
            z-index: 1000;
        }
        .hidden {
            opacity: 0;
        }

.tnb-right-section .tnb-signup-btn {
  position: relative;
  width: 93px;
  height: 40px;
  top: 50%;
  margin-top: -20px;
  border-radius: 25px;
  margin-right: -39px;
  font-size: 16px;
  line-height: 1.5;
  z-index: 5;
}
   </style>
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdownMenu');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }
        window.onclick = function(event) {
            if (!event.target.matches('.profile-icon')) {
                const dropdown = document.getElementById('dropdownMenu');
                if (dropdown) dropdown.style.display = 'none';
            }
        }
        function hideWelcomeMessage() {
            const message = document.getElementById('welcomeMessage');
            if (message) {
                setTimeout(() => {
                    message.classList.add('hidden');
                }, 2000);
            }
        }
        window.onload = hideWelcomeMessage;
    </script>
</head>
<body>

<?php if (isset($_SESSION['user_id'])): ?>
    <div id="welcomeMessage" class="welcome-message">
        Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!
    </div>
<?php endif; ?>

<div class="header">
        <!-- Login/Signup link for guests -->
        <a href="https://profile.w3schools.com/log-in?redirect_url=https%3A%2F%2Fwww.w3schools.com%2F" class="user-anonymous tnb-login-btn w3-bar-item w3-btn bar-item-hover w3-right ws-light-green ga-top ga-top-login" title="Login to your account" aria-label="Login to your account">
        Log in
      </a>
        <a href="https://profile.w3schools.com/sign-up?redirect_url=https%3A%2F%2Fwww.w3schools.com%2F" class="user-anonymous tnb-signup-btn w3-bar-item w3-button w3-right ws-green ws-hover-green ga-top ga-top-signup" title="Sign Up to Improve Your Learning Experience" aria-label="Sign Up to Improve Your Learning Experience">
        Sign Up
      </a>
</div>

<div class="content">
    <h1>Welcome<?php echo isset($_SESSION['username']) ? ', ' . htmlspecialchars($_SESSION['username']) : ''; ?>!</h1>
    <p>This is your dashboard.</p>
</div>

</body>
</html>
