<?php
session_start();
include 'config.php';

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
    <title>Saran Pengguna - NST STORE</title>
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


        .saran-container {
            background-color: #FFFFFF;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .saran {
            background-color: #e8f4fd;
            border-left: 4px solid #3498db;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .saran p {
            margin: 0;
        }

        .no-saran {
            text-align: center;
            color: #7f8c8d;
            font-style: italic;
        }

        /* Icon styles */
        .icon-dashboard, .icon-gejala, .icon-kerusakan, .icon-saran, .icon-logout {
            width: 40px;
            height: 40px;
            background-size: cover;
            margin-right: 15px;
        }

        .icon-dashboard { background-image: url('assets/home.png'); }
        .icon-gejala { background-image: url('assets/edit.png'); }
        .icon-kerusakan { background-image: url('assets/container_x2.svg'); }
        .icon-saran { background-image: url('assets/ballot_box.png'); }
        .icon-logout { background-image: url('assets/inner_plugin_iframe_x2.svg'); }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div>
            <div class="logo">NST STORE</div>
            <nav>
                <ul>
                    <li><a href="dashboard_admin.php"><i class="icon-dashboard"></i> Dashboard</a></li>
                    <li><a href="gejala.php"><i class="icon-gejala"></i> Gejala</a></li>
                    <li><a href="kerusakan.php"><i class="icon-kerusakan"></i> Kerusakan</a></li>
                    <li><a href="test_accuracy.php"><i class="icon-kerusakan"></i> Akurasi</a></li>
                    <li class="active"><a href="saran.php"><i class="icon-saran"></i> Saran</a></li>
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
            <h1>Saran Pengguna</h1>
        </header>
        
        <div class="saran-container">
            <?php
            $sql = "SELECT * FROM saran ORDER BY id_saran DESC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='saran'>";
                    echo "<p>{$row['isi_saran']}</p>";
                    echo "</div>";
                }
            } else {
                echo "<p class='no-saran'>Belum ada saran dari pengguna.</p>";
            }
            ?>
        </div>
    </main>
</body>
</html>