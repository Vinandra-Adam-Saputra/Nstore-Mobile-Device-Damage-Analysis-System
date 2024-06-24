<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['tambah_kerusakan'])) {
        $nama_kerusakan = $_POST['nama_kerusakan'];
        $deskripsi = $_POST['deskripsi'];
        $sql = "INSERT INTO kerusakan (nama_kerusakan, deskripsi) VALUES ('$nama_kerusakan', '$deskripsi')";
        $conn->query($sql);
    } elseif (isset($_POST['edit_kerusakan'])) {
        $id_kerusakan = $_POST['id_kerusakan'];
        $nama_kerusakan = $_POST['nama_kerusakan'];
        $deskripsi = $_POST['deskripsi'];
        $sql = "UPDATE kerusakan SET nama_kerusakan = '$nama_kerusakan', deskripsi = '$deskripsi' WHERE id_kerusakan = $id_kerusakan";
        $conn->query($sql);
    } elseif (isset($_POST['hapus_kerusakan'])) {
        $id_kerusakan = $_POST['id_kerusakan'];
        $sql = "DELETE FROM kerusakan WHERE id_kerusakan = $id_kerusakan";
        $conn->query($sql);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kerusakan - NST STORE</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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

        .user-profile {
            width: 50px;
            height: 50px;
            background-image: url('assets/profile.png');
            background-size: cover;
            border-radius: 50%;
        }

        .main-content {
            flex-grow: 1;
            padding: 40px;
            overflow-y: auto;
        }

        .icon-dashboard, .icon-gejala, .icon-kerusakan, .icon-saran, .icon-akurasi, .icon-logout {
            width: 40px;
            height: 40px;
            background-size: cover;
            margin-right: 15px;
        }

        .icon-dashboard { background-image: url('assets/home.png'); }
        .icon-gejala { background-image: url('assets/edit.png'); }
        .icon-kerusakan { background-image: url('assets/container_x2.svg'); }
        .icon-akurasi { background-image: url('assets/pie-chart.png'); }
        .icon-saran { background-image: url('assets/ballot_box.png'); }
        .icon-logout { background-image: url('assets/inner_plugin_iframe_x2.svg'); }

        .form-group { margin-bottom: 15px; }
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
                    <li class="active"><a href="kerusakan.php"><i class="icon-kerusakan"></i> Kerusakan</a></li>
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
        <h1 class="mb-4">Manajemen Kerusakan</h1>
        <div class="card mb-4">
            <div class="card-header">Tambah Kerusakan Baru</div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nama_kerusakan" required placeholder="Nama Kerusakan">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="deskripsi" required placeholder="Deskripsi Kerusakan" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="tambah_kerusakan">Tambah Kerusakan</button>
                </form>
            </div>
        </div>

        <h2 class="mb-3">Daftar Kerusakan</h2>
        <?php
        $sql = "SELECT * FROM kerusakan";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<div class='card mb-3'>";
            echo "<div class='card-header'>{$row['nama_kerusakan']}</div>";
            echo "<div class='card-body'>";
            echo "<p>{$row['deskripsi']}</p>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='id_kerusakan' value='{$row['id_kerusakan']}'>";
            echo "<div class='form-group'>";
            echo "<input type='text' class='form-control' name='nama_kerusakan' value='{$row['nama_kerusakan']}' required>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<textarea class='form-control' name='deskripsi' required rows='3'>{$row['deskripsi']}</textarea>";
            echo "</div>";
            echo "<button type='submit' class='btn btn-warning' name='edit_kerusakan'>Edit</button>";
            echo "<button type='submit' class='btn btn-danger ml-2' name='hapus_kerusakan'>Hapus</button>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>