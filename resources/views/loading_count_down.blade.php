<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Next Launch</title>

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">

     <!-- CSS Scripts -->
   @vite(['resources/css/loading.css'])
</head>
<body>
    <div class="container">
        <img src="{{ asset('uploads/pics/logo1.png') }}" alt="Future Tech Logo" class="logo">
        <h1>Next Launch</h1>
        
        <div class="countdown">
            <div class="countdown-item"><div class="countdown-value" id="days">00</div><div class="countdown-label">Days</div></div>
            <div class="countdown-item"><div class="countdown-value" id="hours">00</div><div class="countdown-label">Hours</div></div>
            <div class="countdown-item"><div class="countdown-value" id="minutes">00</div><div class="countdown-label">Minutes</div></div>
            <div class="countdown-item"><div class="countdown-value" id="seconds">00</div><div class="countdown-label">Seconds</div></div>
        </div>
        
        <button class="notify-btn" id="notify-btn">Notify Me</button>
    </div>

    <script>
        const launchDate = new Date("april 12, 2025 00:00:00").getTime();
        
        setInterval(() => {
            const now = new Date().getTime();
            const distance = launchDate - now;
            
            if (distance < 0) {
                document.querySelector("h1").textContent = "We Have Launched!";
                return;
            }
            
            document.getElementById("days").textContent = String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, '0');
            document.getElementById("hours").textContent = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
            document.getElementById("minutes").textContent = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
            document.getElementById("seconds").textContent = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
        }, 1000);

        document.getElementById('notify-btn').addEventListener('click', () => {
            alert("You'll be notified when we launch  works!");
        });
    </script>
</body>
</html>
