<?php
require_once 'config.php'; // File koneksi database

function getDataset() {
    global $conn;
    $sql = "SELECT * FROM dataset";
    $result = $conn->query($sql);
    $dataset = [];
    while ($row = $result->fetch_assoc()) {
        $dataset[] = $row;
    }
    return $dataset;
}

// Fungsi untuk menambah data
function addData($data) {
    global $conn;
    $columns = implode(", ", array_keys($data));
    $values = "'" . implode("', '", $data) . "'";
    $sql = "INSERT INTO dataset ($columns) VALUES ($values)";
    return $conn->query($sql);
}

// Fungsi untuk mengedit data
function editData($id, $data) {
    global $conn;
    $set = [];
    foreach ($data as $key => $value) {
        $set[] = "$key = '$value'";
    }
    $set = implode(", ", $set);
    $sql = "UPDATE dataset SET $set WHERE id = $id";
    return $conn->query($sql);
}

// Fungsi untuk menghapus data
function deleteData($id) {
    global $conn;
    $sql = "DELETE FROM dataset WHERE id = $id";
    return $conn->query($sql);
}

// Proses form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        addData($_POST);
    } elseif (isset($_POST['edit'])) {
        $id = $_POST['id'];
        unset($_POST['id']);
        unset($_POST['edit']);
        editData($id, $_POST);
    } elseif (isset($_POST['delete'])) {
        deleteData($_POST['id']);
    }
}

function kFoldCrossValidation($dataset, $k = 5) {
    $folds = array_chunk($dataset, ceil(count($dataset) / $k));
    $totalAccuracy = 0;

    for ($i = 0; $i < $k; $i++) {
        $testSet = $folds[$i];
        $trainingSet = array_merge(...array_filter($folds, function($key) use ($i) {
            return $key !== $i;
        }, ARRAY_FILTER_USE_KEY));

        $model = trainNaiveBayes($trainingSet);
        $accuracy = testAccuracy($testSet, $model);
        $totalAccuracy += $accuracy;
    }

    return $totalAccuracy / $k;
}

function trainNaiveBayes($trainingSet) {
    $model = [
        'class_probabilities' => [],
        'feature_probabilities' => []
    ];

    $totalSamples = count($trainingSet);
    $classCounts = [];

    // Hitung probabilitas kelas
    foreach ($trainingSet as $data) {
        $class = $data['jenis_kerusakan'];
        $classCounts[$class] = ($classCounts[$class] ?? 0) + 1;
    }

    foreach ($classCounts as $class => $count) {
        $model['class_probabilities'][$class] = $count / $totalSamples;
    }

    // Hitung probabilitas fitur
    $features = ['lcd_touchscreen', 'getaran', 'signal', 'suara', 'baterai', 'port_cas', 'mesin', 'housing', 'tombol_tombol', 'mic'];
    foreach ($features as $feature) {
        foreach ($trainingSet as $data) {
            $class = $data['jenis_kerusakan'];
            $value = $data[$feature];
            $model['feature_probabilities'][$feature][$value][$class] = ($model['feature_probabilities'][$feature][$value][$class] ?? 0) + 1;
        }
    }

    // Laplace smoothing
    foreach ($features as $feature) {
        $uniqueValues = array_unique(array_column($trainingSet, $feature));
        foreach ($uniqueValues as $value) {
            foreach ($classCounts as $class => $count) {
                $model['feature_probabilities'][$feature][$value][$class] = 
                    ($model['feature_probabilities'][$feature][$value][$class] ?? 0 + 1) / ($count + count($uniqueValues));
            }
        }
    }

    return $model;
}

function predictClass($data, $model) {
    $features = ['lcd_touchscreen', 'getaran', 'signal', 'suara', 'baterai', 'port_cas', 'mesin', 'housing', 'tombol_tombol', 'mic'];
    $maxProb = -INF;
    $predictedClass = null;

    foreach ($model['class_probabilities'] as $class => $classProbability) {
        $probability = log($classProbability);
        foreach ($features as $feature) {
            $value = $data[$feature];
            $probability += log($model['feature_probabilities'][$feature][$value][$class] ?? 1e-10);
        }
        if ($probability > $maxProb) {
            $maxProb = $probability;
            $predictedClass = $class;
        }
    }

    return $predictedClass;
}

function testAccuracy($testSet, $model) {
    $correct = 0;
    foreach ($testSet as $data) {
        $predictedClass = predictClass($data, $model);
        if ($predictedClass == $data['jenis_kerusakan']) {
            $correct++;
        }
    }
    return $correct / count($testSet);
}

$dataset = getDataset();
$accuracy = kFoldCrossValidation($dataset);

$accuracyPercentage = number_format($accuracy * 100, 2);
$remainingPercentage = 100 - $accuracyPercentage;


// HTML untuk menampilkan hasil
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uji Akurasi Sistem - NST STORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .main-content {
            flex-grow: 1;
            padding: 40px;
            overflow-y: auto;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        .result {
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        .chart-container {
            width: 300px;
            margin: 20px auto;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        
        th {
            background-color: #f2f2f2;
        }
        
        form {
            margin-top: 20px;
        }
        
        input[type="text"], input[type="submit"] {
            margin: 5px 0;
            padding: 5px;
        }

        .content-section {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .content-section h2 {
            color: #333;
            margin-bottom: 20px;
        }

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
                    <li class="active"><a href="test_accuracy.php"><i class="icon-akurasi"></i> Akurasi</a></li>
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
        <h1>Uji Akurasi Sistem Analisis Kerusakan Perangkat Mobile</h1>
        
        <div class="content-section">
            <h2>Visualisasi Akurasi</h2>
            <div class="result">
                Akurasi rata-rata: <?php echo $accuracyPercentage; ?>%
            </div>
            <div class="chart-container">
                <canvas id="accuracyChart"></canvas>
            </div>
        </div>

        <div class="content-section">
            <h2>Manajemen Dataset</h2>
            <table>
            <tr>
                <th>ID</th>
                <th>LCD Touchscreen</th>
                <th>Getaran</th>
                <th>Signal</th>
                <th>Suara</th>
                <th>Baterai</th>
                <th>Port Cas</th>
                <th>Mesin</th>
                <th>Housing</th>
                <th>Tombol-tombol</th>
                <th>Mic</th>
                <th>Jenis Kerusakan</th>
                <th>Aksi</th>
            </tr>
            <?php foreach ($dataset as $data): ?>
            <tr>
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['lcd_touchscreen']; ?></td>
                <td><?php echo $data['getaran']; ?></td>
                <td><?php echo $data['signal']; ?></td>
                <td><?php echo $data['suara']; ?></td>
                <td><?php echo $data['baterai']; ?></td>
                <td><?php echo $data['port_cas']; ?></td>
                <td><?php echo $data['mesin']; ?></td>
                <td><?php echo $data['housing']; ?></td>
                <td><?php echo $data['tombol_tombol']; ?></td>
                <td><?php echo $data['mic']; ?></td>
                <td><?php echo $data['jenis_kerusakan']; ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                        <input type="submit" name="delete" value="Hapus">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <h2>Tambah Data</h2>
        <form method="post">
            <input type="text" name="lcd_touchscreen" placeholder="LCD Touchscreen" required>
            <input type="text" name="getaran" placeholder="Getaran" required>
            <input type="text" name="signal" placeholder="Signal" required>
            <input type="text" name="suara" placeholder="Suara" required>
            <input type="text" name="baterai" placeholder="Baterai" required>
            <input type="text" name="port_cas" placeholder="Port Cas" required>
            <input type="text" name="mesin" placeholder="Mesin" required>
            <input type="text" name="housing" placeholder="Housing" required>
            <input type="text" name="tombol_tombol" placeholder="Tombol-tombol" required>
            <input type="text" name="mic" placeholder="Mic" required>
            <input type="text" name="jenis_kerusakan" placeholder="Jenis Kerusakan" required>
            <input type="submit" name="add" value="Tambah">
        </form>

        <h2>Edit Data</h2>
        <form method="post">
            <input type="text" name="id" placeholder="ID" required>
            <input type="text" name="lcd_touchscreen" placeholder="LCD Touchscreen">
            <input type="text" name="getaran" placeholder="Getaran">
            <input type="text" name="signal" placeholder="Signal">
            <input type="text" name="suara" placeholder="Suara">
            <input type="text" name="baterai" placeholder="Baterai">
            <input type="text" name="port_cas" placeholder="Port Cas">
            <input type="text" name="mesin" placeholder="Mesin">
            <input type="text" name="housing" placeholder="Housing">
            <input type="text" name="tombol_tombol" placeholder="Tombol-tombol">
            <input type="text" name="mic" placeholder="Mic">
            <input type="text" name="jenis_kerusakan" placeholder="Jenis Kerusakan">
            <input type="submit" name="edit" value="Edit">
        </form>
    </div>

    <script>
        var ctx = document.getElementById('accuracyChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Akurasi', 'Sisa'],
                datasets: [{
                    data: [<?php echo $accuracyPercentage; ?>, <?php echo $remainingPercentage; ?>],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(255, 99, 132, 0.8)'
                    ]
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Akurasi Sistem'
                }
            }
        });
    </script>
</body>
</html>