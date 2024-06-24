<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['saran'])) {
    $saran = $conn->real_escape_string($_POST['saran']);
    $sql = "INSERT INTO saran (isi_saran) VALUES ('$saran')";
    if ($conn->query($sql) === TRUE) {
        $saran_message = "Terima kasih atas saran Anda!";
    } else {
        $saran_message = "Maaf, terjadi kesalahan saat menyimpan saran.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analisis Kerusakan Smartphone</title>
    <script src="https://cdn.jsdelivr.net/npm/papaparse@5.3.0/papaparse.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        h1, h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }
        select, textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #2980b9;
        }
        #result {
            margin-top: 30px;
            font-weight: bold;
            text-align: center;
            font-size: 18px;
            padding: 15px;
            background-color: #e8f4fd;
            border-radius: 4px;
        }
        #description {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 4px;
            font-size: 16px;
            line-height: 1.6;
        }
        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #2ecc71;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .back-button:hover {
            background-color: #27ae60;
        }
        .saran-form {
            margin-top: 30px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        .saran-message {
            margin-top: 10px;
            padding: 10px;
            background-color: #d4edda;
            border-radius: 4px;
            color: #155724;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Analisis Kerusakan Smartphone</h1>
        <form id="analysisForm">
            <?php
            $sql = "SELECT * FROM gejala";
            $result = $conn->query($sql);
            
            while ($row = $result->fetch_assoc()) {
                echo "<select id='{$row['nama_gejala']}' name='{$row['nama_gejala']}' required>";
                echo "<option value='' disabled selected>Pilih {$row['nama_gejala']}</option>";
                
                $sql_opsi = "SELECT * FROM opsi_gejala WHERE id_gejala = {$row['id_gejala']}";
                $result_opsi = $conn->query($sql_opsi);
                
                while ($opsi = $result_opsi->fetch_assoc()) {
                    echo "<option value='{$opsi['nama_opsi']}'>{$opsi['nama_opsi']}</option>";
                }
                
                echo "</select>";
            }
            ?>

            <button type="submit">Analisis</button>
        </form>
        <div id="result"></div>
        <div id="description"></div>
        
        <div class="saran-form">
            <h2>Berikan Saran</h2>
            <form method="POST" action="">
                <textarea name="saran" rows="4" placeholder="Tulis saran Anda di sini..." required></textarea>
                <button type="submit">Kirim Saran</button>
            </form>
            <?php
            if (isset($saran_message)) {
                echo "<div class='saran-message'>$saran_message</div>";
            }
            ?>
        </div>
        
        <a href="dashboard_user.php" class="back-button">Kembali ke Dashboard</a>
    </div>
    
    <script>
        let dataset;
        let features;
        let labels;
        let uniqueLabels;
        let labelCounts;
        let featureProbabilities;

        // Load and parse CSV
        Papa.parse("nstore-dataset.csv", {
            download: true,
            header: true,
            complete: function(results) {
                dataset = results.data;
                prepareData();
            }
        });

        function prepareData() {
            features = dataset.map(row => {
                let feature = {};
                for (let key in row) {
                    if (key !== 'Jenis Kerusakan') {
                        feature[key] = row[key];
                    }
                }
                return feature;
            });

            labels = dataset.map(row => row['Jenis Kerusakan']);
            uniqueLabels = [...new Set(labels)];
            
            labelCounts = {};
            uniqueLabels.forEach(label => {
                labelCounts[label] = labels.filter(l => l === label).length;
            });

            featureProbabilities = {};
            Object.keys(features[0]).forEach(feature => {
                featureProbabilities[feature] = {};
                uniqueLabels.forEach(label => {
                    featureProbabilities[feature][label] = {};
                    let featureValues = [...new Set(features.map(f => f[feature]))];
                    featureValues.forEach(value => {
                        let count = features.filter((f, i) => f[feature] === value && labels[i] === label).length;
                        featureProbabilities[feature][label][value] = (count + 1) / (labelCounts[label] + featureValues.length); // Laplace smoothing
                    });
                });
            });

            console.log('Dataset prepared');
        }

        function naiveBayes(input) {
            let probabilities = {};
            uniqueLabels.forEach(label => {
                let probability = Math.log(labelCounts[label] / labels.length);
                Object.keys(input).forEach(feature => {
                    if (featureProbabilities[feature] && featureProbabilities[feature][label]) {
                        probability += Math.log(featureProbabilities[feature][label][input[feature]] || 0.01);
                    }
                });
                probabilities[label] = probability;
            });
            return Object.keys(probabilities).reduce((a, b) => probabilities[a] > probabilities[b] ? a : b);
        }

        document.getElementById('analysisForm').addEventListener('submit', function(e) {
            e.preventDefault();
            if (validateForm()) {
                analyze();
            }
        });

        function validateForm() {
            let form = document.getElementById('analysisForm');
            let selects = form.getElementsByTagName('select');
            for (let i = 0; i < selects.length; i++) {
                if (selects[i].value === '') {
                    alert('Mohon lengkapi semua field sebelum melakukan analisis.');
                    return false;
                }
            }
            return true;
        }

        function analyze() {
            let form = document.getElementById('analysisForm');
            let formData = new FormData(form);
            let input = {};
            for (let [key, value] of formData.entries()) {
                input[key] = value;
            }

            console.log('Input:', input);

            if (dataset && features && labels) {
                let result = naiveBayes(input);
                document.getElementById('result').innerText = "Jenis Kerusakan: " + result;
                
                // Fetch description from the server
                fetch(`get_description.php?kerusakan=${encodeURIComponent(result)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.description) {
                            document.getElementById('description').innerText = "Deskripsi: " + data.description;
                        } else {
                            document.getElementById('description').innerText = "Deskripsi tidak tersedia.";
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById('description').innerText = "Gagal memuat deskripsi.";
                    });
            } else {
                console.error('Dataset not ready');
                document.getElementById('result').innerText = "Error: Dataset not ready. Please try again later.";
            }
        }
    </script>
</body>
</html>