<?php require_once 'db.php';

// Ambil data mahasiswa & matkul
$mahasiswa = $conn->query("SELECT * FROM mahasiswa");
$matakuliah = $conn->query("SELECT * FROM matakuliah");

// Simpan KRS
if (isset($_POST['simpan'])) {
    $npm = $_POST['mahasiswa_npm'];
    $kodemk = $_POST['matakuliah_kodemk'];
    $conn->query("INSERT INTO krs(mahasiswa_npm, matakuliah_kodemk) VALUES ('$npm', '$kodemk')");
    header("Location: krs.php");
}

// Tampilkan Data Gabungan
$sql = "SELECT m.nama AS nama_mhs, mk.nama AS nama_mk, mk.jumlah_sks
         FROM krs k
        JOIN mahasiswa m ON k.mahasiswa_npm = m.npm
        JOIN matakuliah mk ON k.matakuliah_kodemk = mk.kodemk";
$data = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Rencana Studi</title>
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

        h2, h3 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
        }

        h2 {
            font-size: 28px;
        }

        h3 {
            font-size: 22px;
            margin-top: 30px;
        }

        h2:after, h3:after {
            content: '';
            position: absolute;
            width: 80px;
            height: 3px;
            background-color: #27ae60;
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

        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
            box-sizing: border-box;
            transition: border-color 0.3s;
            font-size: 15px;
        }

        select:focus {
            border-color: #27ae60;
            outline: none;
            box-shadow: 0 0 5px rgba(39, 174, 96, 0.5);
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #219653;
        }

        /* Table Styling */
        table {
            width: 100%;
            max-width: 1000px;
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
            background-color: #27ae60;
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

        /* Numbered rows */
        td:first-child {
            text-align: center;
            font-weight: 500;
            color: #555;
            width: 50px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            form, table {
                width: 95%;
            }
            
            th, td {
                padding: 10px;
            }
            
            td:nth-child(4) {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <h2>Input KRS</h2>
    <form method="post">
        <select name="mahasiswa_npm">
            <?php while ($m = $mahasiswa->fetch_assoc()) : ?>
                <option value="<?= $m['npm'] ?>"><?= $m['nama'] ?></option>
            <?php endwhile; ?>
        </select>
        
        <select name="matakuliah_kodemk">
            <?php while ($mk = $matakuliah->fetch_assoc()) : ?>
                <option value="<?= $mk['kodemk'] ?>"><?= $mk['nama'] ?></option>
            <?php endwhile; ?>
        </select>
        
        <button type="submit" name="simpan">Simpan</button>
    </form>

    <h3>Data KRS</h3>
    <table>
        <tr><th>No</th><th>Nama Lengkap</th><th>Mata Kuliah</th><th>Keterangan</th></tr>
        <?php $no = 1; while ($row = $data->fetch_assoc()) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nama_mhs'] ?></td>
                <td><?= $row['nama_mk'] ?></td>
                <td><?= $row['nama_mhs'] ?> Mengambil Mata Kuliah <?= $row['nama_mk'] ?> (<?= $row['jumlah_sks'] ?> SKS)</td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>