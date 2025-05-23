<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

       <!-- icon -->
   <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('background.jpg') no-repeat center center/cover;
            font-family: Arial, sans-serif;
        }
        .login-container {
            background: rgba(0, 24, 56, 0.8);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.3);
            color: white;
            width: 350px;
        }
        .login-container img {
            width: 50px;
            margin-bottom: 10px;
        }
        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
            outline: none;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .login-container button:hover {
            background: #0056b3;
        }
        .checkbox-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 14px;
        }
        .checkbox-container input {
            margin-right: 5px;
        }
        .forgot-password {
            color: #00aaff;
            text-decoration: none;
            font-size: 14px;
        }
        .forgot-password:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="logo.png" alt="Logo">
        <h2>Sign in to Kumoyo</h2>
        <input type="text" placeholder="Username or email">
        <input type="password" placeholder="Password">
        <div class="checkbox-container">
            <label><input type="checkbox"> Remember me</label>
            <a href="#" class="forgot-password">Forgot password?</a>
        </div>
        <button>Sign In</button>
    </div>
</body>
</html>
