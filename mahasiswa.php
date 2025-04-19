<?php
require_once 'db.php';

// Create
if (isset($_POST['simpan'])) {
    $npm = $_POST['npm'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];

    $sql = "INSERT INTO mahasiswa VALUES ('$npm', '$nama', '$jurusan', '$alamat')";
    $conn->query($sql);
    header("Location: mahasiswa.php");
}

// Delete
if (isset($_GET['hapus'])) {
    $npm = $_GET['hapus'];
    $conn->query("DELETE FROM mahasiswa WHERE npm='$npm'");
    header("Location: mahasiswa.php");
}

// Read
$data = $conn->query("SELECT * FROM mahasiswa");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
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
            background-color: #3498db;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        /* Form Styling */
        form {
            max-width: 600px;
            margin: 0 auto 30px auto;
            padding: 25px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus, select:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
        }

        select {
            background-color: white;
            cursor: pointer;
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
            font-weight: 500;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
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
            background-color: #3498db;
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
    <h2>Data Mahasiswa</h2>
    <form method="post">
        <input type="text" name="npm" placeholder="NPM" required>
        <input type="text" name="nama" placeholder="Nama" required>
        <select name="jurusan">
            <option>Teknik Informatika</option>
            <option>Sistem Operasi</option>
        </select>
        <input type="text" name="alamat" placeholder="Alamat">
        <button type="submit" name="simpan">Simpan</button>
    </form>

    <table>
        <tr><th>NPM</th><th>Nama</th><th>Jurusan</th><th>Alamat</th><th>Aksi</th></tr>
        <?php while ($row = $data->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['npm'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['jurusan'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td><a href="?hapus=<?= $row['npm'] ?>">Hapus</a></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>