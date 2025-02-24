<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh; /* Ensure body takes up full viewport height */
        background-color: #f4f4f4;
        padding: 20px; /* Add some padding around the content */
    }

    .login-container {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 100%; /* Occupy full width within its parent */
        max-width: 400px; /* Set a maximum width */
        margin: 0 auto; /* Center the container horizontally */
    }

    .login-container h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .input-group {
        margin-bottom: 15px;
    }

    .input-group label {
        display: block;
        margin-bottom: 5px;
    }

    .input-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .login-btn {
        width: 100%;
        padding: 10px;
        background: #28a745;
        border: none;
        color: white;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
    }

    .login-btn:hover {
        background: #218838;
    }

    .error {
        color: red;
        text-align: center;
        margin-top: 10px;
    }

    /* Media query for smaller screens */
    @media (max-width: 450px) {
        .login-container {
            max-width: 90%; /* Adjust width on smaller screens */
            padding: 15px;
        }
        .login-container h2 {
            font-size: 1.5em; /* Slightly reduce heading size */
        }
    }
</style>

<div class="login-container">
    <h2>Login</h2>
    <div class="input-group">
        <label for="username">Username</label>
        <input type="text" id="username" placeholder="Enter Username">
    </div>
    <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Enter Password">
    </div>
    <button class="login-btn" onclick="login()">Login</button>
    <p class="error" id="error-message"></p>
</div>

<script>
    function login() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        var errorMessage = document.getElementById("error-message");

        if (username === "admin" && password === "admin") {
            window.location.href = "<?= base_url('food-list'); ?>";
        } else {
            errorMessage.textContent = "Invalid username or password";
        }
    }
</script>