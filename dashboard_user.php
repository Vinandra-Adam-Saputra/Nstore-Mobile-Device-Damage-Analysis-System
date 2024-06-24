<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
    body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background: url('assets/bg2.jpg') no-repeat center center fixed;
        background-size: cover;
    }

    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        /* Adjust the opacity as needed */
        z-index: 0;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 22px 28px;
        width: 100%;
        height: 100vh;
        box-sizing: border-box;
        position: relative;
    }

    .header {
        display: flex;
        justify-content: flex-end;
        width: 100%;
        max-width: 1440px;
        box-sizing: border-box;
        position: absolute;
        top: 20px;
        right: 20px;
    }

    .header div {
        margin: 5px 13.5px;
        font-size: 18px;
        font-weight: bold;
        color: white;
        cursor: pointer;
    }

    .login-btn {
        background-color: #4E5AC2;
        border-radius: 50px;
        padding: 5px 17px;
        color: white;
        text-decoration: underline;
        font-weight: bold;
    }

    .title {
        margin-top: 200px;
        font-size: 40px;
        font-weight: bold;
        color: white;
        text-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
        text-align: center;
    }

    .start-analysis {
        background-color: #000000;
        border-radius: 50px;
        padding: 8px 20px;
        display: flex;
        align-items: center;
        color: white;
        font-weight: bold;
        text-decoration: underline;
        margin-top: 20px;
        cursor: pointer;
    }

    .start-analysis img {
        transform: rotate(-179.378deg);
        width: 29px;
        height: 29.4px;
        margin-left: 10px;
    }
    </style>
    <script>
    function navigateTo(page) {
        location.href = page;
    }
    </script>
</head>

<body>
    <div class="container">
        <div class="header">
            <div onclick="navigateTo('index.php')">Home</div>
            <div onclick="navigateTo('about.html')">About us</div>
            <div class="login-btn" onclick="navigateTo('index.php')">Login</div>
        </div>
        <div class="title">ANALISIS KERUSAKAN HP ANDA DI WEBSITE KAMI</div>
        <div class="start-analysis" onclick="navigateTo('analysis.php')">
            Start Analysis
            <img src="assets/vector_4_x2.svg" alt="arrow" />
        </div>
    </div>
</body>

</html>