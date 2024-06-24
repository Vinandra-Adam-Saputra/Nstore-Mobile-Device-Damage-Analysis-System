<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['tambah_gejala'])) {
        $nama_gejala = $_POST['nama_gejala'];
        $sql = "INSERT INTO gejala (nama_gejala) VALUES ('$nama_gejala')";
        $conn->query($sql);
    } elseif (isset($_POST['tambah_opsi'])) {
        $id_gejala = $_POST['id_gejala'];
        $nama_opsi = $_POST['nama_opsi'];
        $sql = "INSERT INTO opsi_gejala (id_gejala, nama_opsi) VALUES ('$id_gejala', '$nama_opsi')";
        $conn->query($sql);
    } elseif (isset($_POST['edit_gejala'])) {
        $id_gejala = $_POST['id_gejala'];
        $nama_gejala = $_POST['nama_gejala'];
        $sql = "UPDATE gejala SET nama_gejala = '$nama_gejala' WHERE id_gejala = $id_gejala";
        $conn->query($sql);
    } elseif (isset($_POST['hapus_gejala'])) {
        $id_gejala = $_POST['id_gejala'];
        $sql = "DELETE FROM gejala WHERE id_gejala = $id_gejala";
        $conn->query($sql);
        $sql = "DELETE FROM opsi_gejala WHERE id_gejala = $id_gejala";
        $conn->query($sql);
    } elseif (isset($_POST['edit_opsi'])) {
        $id_opsi = $_POST['id_opsi'];
        $nama_opsi = $_POST['nama_opsi'];
        $sql = "UPDATE opsi_gejala SET nama_opsi = '$nama_opsi' WHERE id_opsi = $id_opsi";
        $conn->query($sql);
    } elseif (isset($_POST['hapus_opsi'])) {
        $id_opsi = $_POST['id_opsi'];
        $sql = "DELETE FROM opsi_gejala WHERE id_opsi = $id_opsi";
        $conn->query($sql);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Gejala - NST STORE</title>
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

        h1 {
            font-size: 32px;
            margin-bottom: 30px;
            color: #333;
        }

        .user-profile {
            width: 50px;
            height: 50px;
            background-image: url('assets/profile.png');
            background-size: cover;
            border-radius: 50%;
        }
        
        .card {
            background-color: #FFFFFF;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #3498db;
            color: #FFFFFF;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        .gejala-list {
            list-style-type: none;
            padding: 0;
        }

        .gejala-item {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .gejala-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .gejala-header h3 {
            margin: 0;
            font-size: 20px;
        }

        .gejala-actions {
            display: flex;
            align-items: center;
        }

        .opsi-list {
            list-style-type: none;
            padding-left: 20px;
            margin-top: 15px;
        }

        .opsi-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #eee;
            border-radius: 5px;
        }

        .opsi-name {
            font-weight: 500;
        }

        .opsi-actions {
            display: flex;
            align-items: center;
        }

        .edit-form {
            display: flex;
            align-items: center;
        }

        .edit-form input[type="text"] {
            margin-right: 10px;
            padding: 5px 10px;
        }

        button {
            margin-left: 5px;
        }

        .delete-btn {
            background-color: #e74c3c;
        }

        .delete-btn:hover {
            background-color: #c0392b;
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
    </style>
</head>
<body>
    <aside class="sidebar">
        <div>
            <div class="logo">NST STORE</div>
            <nav>
                <ul>
                    <li><a href="dashboard_admin.php"><i class="icon-dashboard"></i> Dashboard</a></li>
                    <li class="active"><a href="gejala.php"><i class="icon-gejala"></i> Gejala</a></li>
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

    <div class="main-content">
        <h1>Manajemen Gejala</h1>
        
        <div class="card">
            <div class="card-header">Tambah Gejala Baru</div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <input type="text" name="nama_gejala" required placeholder="Nama Gejala">
                    </div>
                    <button type="submit" name="tambah_gejala">Tambah Gejala</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Tambah Opsi Gejala</div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <select name="id_gejala" required>
                            <option value="">Pilih Gejala</option>
                            <?php
                            $sql = "SELECT * FROM gejala";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['id_gejala']}'>{$row['nama_gejala']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="nama_opsi" required placeholder="Nama Opsi">
                    </div>
                    <button type="submit" name="tambah_opsi">Tambah Opsi</button>
                </form>
            </div>
        </div>

        <div class="card">
    <div class="card-header">Daftar Gejala dan Opsi</div>
    <div class="card-body">
        <ul class="gejala-list">
            <?php
            $sql = "SELECT * FROM gejala";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<li class='gejala-item'>";
                echo "<div class='gejala-header'>";
                echo "<h3>{$row['nama_gejala']}</h3>";
                echo "<div class='gejala-actions'>";
                echo "<form method='post' class='edit-form'>";
                echo "<input type='hidden' name='id_gejala' value='{$row['id_gejala']}'>";
                echo "<input type='text' name='nama_gejala' value='{$row['nama_gejala']}' required>";
                echo "<button type='submit' name='edit_gejala'>Edit</button>";
                echo "<button type='submit' name='hapus_gejala' class='delete-btn'>Hapus</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                
                $sql_opsi = "SELECT * FROM opsi_gejala WHERE id_gejala = {$row['id_gejala']}";
                $result_opsi = $conn->query($sql_opsi);
                echo "<ul class='opsi-list'>";
                while ($opsi = $result_opsi->fetch_assoc()) {
                    echo "<li class='opsi-item'>";
                    echo "<span class='opsi-name'>{$opsi['nama_opsi']}</span>";
                    echo "<div class='opsi-actions'>";
                    echo "<form method='post' class='edit-form'>";
                    echo "<input type='hidden' name='id_opsi' value='{$opsi['id_opsi']}'>";
                    echo "<input type='text' name='nama_opsi' value='{$opsi['nama_opsi']}' required>";
                    echo "<button type='submit' name='edit_opsi'>Edit</button>";
                    echo "<button type='submit' name='hapus_opsi' class='delete-btn'>Hapus</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</li>";
                }
                echo "</ul>";
                echo "</li>";
            }
            ?>
        </ul>
    </div>
</div>
    </div>
</body>
</html>