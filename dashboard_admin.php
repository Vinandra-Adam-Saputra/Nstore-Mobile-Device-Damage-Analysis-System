<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NST STORE Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #1F1F1F;
            color: #FFFFFF;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .logo {
        font-size: 28px;
        font-weight: bold;
        font-style: italic;
        margin-bottom: 40px;
        text-align: center;
        color: #FFFFFF;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        letter-spacing: 2px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            margin-bottom: 15px;
        }

        nav ul li a {
            color: #FFFFFF;
            text-decoration: none;
            font-size: 18px;
            display: flex;
            align-items: center;
            padding: 10px;
        }

        nav ul li.active a {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }

        .logout-btn {
            background-color: #CA5252;
            color: #FFFFFF;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: auto;
        }

        .logout-btn .icon-logout {
            margin-right: 10px;
            width: 20px;
            height: 20px;
        }

        .main-content {
            flex-grow: 1;
            padding: 40px;
            overflow-y: auto;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        header h1 {
            font-size: 32px;
            margin: 0;
        }

        .user-profile {
            width: 50px;
            height: 50px;
            background-image: url('assets/profile.png');
            background-size: cover;
            border-radius: 50%;
        }

        .welcome {
        text-align: center;
        margin-bottom: 40px;
        }

        .welcome h2 {
        font-size: 36px;
        font-weight: 500;
        }

        .quick-access h3 {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 30px;
        color: #333;
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: #FFFFFF;
            border-radius: 15px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card h4 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 14px;
            color: #8F8F8F;
        }

        .icon-dashboard, .icon-gejala, .icon-kerusakan, .icon-saran, .icon-akurasi {
            width: 40px;
            height: 40px;
            background-size: cover;
            margin-right: 15px;
        }

        .icon-dashboard {
            background-image: url('assets/home.png');
        }

        .icon-gejala {
            background-image: url('assets/edit.png');
        }

        .icon-kerusakan {
            background-image: url('assets/container_x2.svg');
        }

        .icon-akurasi {
            background-image: url('assets/pie-chart.png');
        }

        .icon-saran {
            background-image: url('assets/ballot_box.png');
        }

        .icon-logout {
            background-image: url('assets/inner_plugin_iframe_x2.svg');
            width: 32px;
            height: 35px;
            background-size: cover;
        }

        .icon-pemeriksaan-gejala, .icon-cek-kerusakan, .icon-saran-evaluasi, .icon-cek-akurasi {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background-size: cover;
        }

        .icon-pemeriksaan-gejala {
            background-image: url('assets/edit.png');
        }

        .icon-cek-kerusakan {
            background-image: url('assets/container_x3.png');
        }

        .icon-saran-evaluasi {
            background-image: url('assets/ballot_box.png');
        }

        .icon-cek-akurasi{
            background-image: url('assets/pie-chart.png');
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div>
            <div class="logo">NST STORE</div>
            <nav>
            <ul>
                    <li class="active"><a href="dashboard_admin.php"><i class="icon-dashboard"></i> Dashboard</a></li>
                    <li><a href="gejala.php"><i class="icon-gejala"></i> Gejala</a></li>
                    <li><a href="kerusakan.php"><i class="icon-kerusakan"></i> Kerusakan</a></li>
                    <li><a href="test_accuracy.php"><i class="icon-akurasi"></i> Akurasi</a></li>
                    <li><a href="saran.php"><i class="icon-saran"></i> Saran</a></li>
                </ul>
            </nav>
        </div>
        <form action="logout.php" method="post">
            <button type="submit" class="logout-btn">
                <i class="icon-logout"></i>
                <span>Log out</span>
            </button>
        </form>
    </aside>
    
    <main class="main-content">
        <header>
            <h1>Dashboard</h1>
            <div class="user-profile"></div>
        </header>
        
        <section class="welcome">
            <h2>Welcome back, Admin.</h2>
        </section>
        
        <section class="quick-access">
            <h3>Quick Access</h3>
            <div class="card-container">
                <div class="card">
                    <div class="icon-pemeriksaan-gejala"></div>
                    <h4>Manajemen Gejala</h4>
                    <p>Tambah, Edit, Hapus Data Gejala</p>
                </div>

                <div class="card">
                    <div class="icon-cek-kerusakan"></div>
                    <h4>Manajemen Kerusakan</h4>
                    <p>Tambah, Edit, Hapus Data Kerusakan</p>
                </div>

                <div class="card">
                    <div class="icon-cek-akurasi"></div>
                    <h4>Cek Akurasi Sistem</h4>
                    <p>Akurasi Sistem dan Manajemen Dataset </p>
                </div>

                <div class="card">
                    <div class="icon-saran-evaluasi"></div>
                    <h4>Saran & Evaluasi</h4>
                    <p>Suara pengguna adalah hal terpenting dalam mengembangkan Aplikasi</p>
                </div>  
            </div>
        </section>
    </main>
</body>
</html>