<?php require_once 'db.php';

// Create
if (isset($_POST['simpan'])) {
    $kodemk = $_POST['kodemk'];
    $nama = $_POST['nama'];
    $sks = $_POST['jumlah_sks'];
    
    $sql = "INSERT INTO matakuliah VALUES ('$kodemk', '$nama', $sks)";
    $conn->query($sql);
    header("Location: matakuliah.php");
}

// Delete
if (isset($_GET['hapus'])) {
    $kodemk = $_GET['hapus'];
    $conn->query("DELETE FROM matakuliah WHERE kodemk='$kodemk'");
    header("Location: matakuliah.php");
}

// Read
$data = $conn->query("SELECT * FROM matakuliah");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mata Kuliah</title>
    <style>
        /* General Page Styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.6;
        }

        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 25px;
            font-size: 28px;
            position: relative;
            padding-bottom: 10px;
        }

        h2:after {
            content: '';
            position: absolute;
            width: 80px;
            height: 3px;
            background-color: #9b59b6;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        /* Form Styling */
        form {
            max-width: 600px;
            margin: 0 auto 30px auto;
            padding: a25px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus, input[type="number"]:focus, select:focus {
            border-color: #9b59b6;
            outline: none;
            box-shadow: 0 0 5px rgba(155, 89, 182, 0.5);
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #9b59b6;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #8e44ad;
        }

        /* Table Styling */
        table {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #9b59b6;
            color: white;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 14px;
        }

        tr:hover {
            background-color: #f5f7fa;
        }

        tr:last-child td {
            border-bottom: none;
        }

        /* Action Links */
        a {
            display: inline-block;
            padding: 5px 10px;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #c0392b;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            form, table {
                width: 95%;
            }
            
            th, td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <h2>Data Mata Kuliah</h2>
    <form method="post">
        <input type="text" name="kodemk" placeholder="Kode MK" required>
        <input type="text" name="nama" placeholder="Nama MK" required>
        <input type="number" name="jumlah_sks" placeholder="SKS" required>
        <button type="submit" name="simpan">Simpan</button>
    </form>

    <table>
        <tr><th>Kode</th><th>Nama</th><th>SKS</th><th>Aksi</th></tr>
        <?php while ($row = $data->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['kodemk'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['jumlah_sks'] ?></td>
                <td><a href="?hapus=<?= $row['kodemk'] ?>">Hapus</a></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>