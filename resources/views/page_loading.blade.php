<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Next Launch</title>

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/loading.css']) <!-- Or use the CSS below directly -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Orbitron', sans-serif;
            background: #000;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .logo {
            width: 200px;
            animation: fadeInOut 2s infinite ease-in-out;
        }

        h1 {
            margin-top: 20px;
            font-size: 2rem;
            color: #00ffcc;
        }

        @keyframes fadeInOut {
            0%, 100% { opacity: 0.1; }
            50% { opacity: 1; }
        }

        .notify-btn {
            margin-top: 30px;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #00ffcc;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .notify-btn:hover {
            background-color: #00cca8;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('uploads/pics/logo2.png') }}" alt="Future Tech Logo" class="logo">
        <h1>Loading...</h1>
        <h1>Next Launch</h1>
        <button class="notify-btn" id="notify-btn">Notify Me</button>
    </div>

    <script>
        document.getElementById('notify-btn').addEventListener('click', () => {
            alert("You'll be notified when we launch!");
        });
    </script>
</body>
</html>
