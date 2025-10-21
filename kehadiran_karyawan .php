<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas 3 - Kehadiran Karyawan</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #3f51b5, #5c6bc0);
            color: #333;
            padding: 40px;
        }
        h2 {
            text-align: center;
            background: #283593;
            color: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.3);
        }
        form {
            width: 65%;
            margin: 20px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.3);
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #bbb;
            border-radius: 5px;
        }
        button {
            background: #3949ab;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
        }
        button:hover {
            background: #303f9f;
        }
        table {
            width: 85%;
            margin: 30px auto;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #3949ab;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        tr:hover {
            background: #f1f1f1;
        }
        .hadir {
            color: green;
            font-weight: bold;
        }
        .izin {
            color: red;
            font-weight: bold;
        }
        .sakit {
            color: orange;
            font-weight: bold;
        }
        footer {
            text-align: center;
            margin-top: 30px;
            color: white;
        }
    </style>
    <script>
        // Script untuk menampilkan input alasan jika status = izin
        function tampilkanAlasan(index) {
            const select = document.getElementById('status' + index);
            const alasanInput = document.getElementById('alasan' + index);
            if (select.value === 'Izin') {
                alasanInput.style.display = 'block';
            } else {
                alasanInput.style.display = 'none';
            }
        }
    </script>
</head>
<body>

<h2>Tugas 3 - Menentukan Status Kehadiran Karyawan</h2>

<form method="post">
    <label for="jumlah">Masukkan Jumlah Karyawan:</label>
    <input type="number" id="jumlah" name="jumlah" min="1" required>
    <button type="submit" name="buat">Buat Form Input Nama</button>
</form>

<?php
// Tahap 1: buat form input nama & status
if (isset($_POST['buat'])) {
    $jumlah = $_POST['jumlah'];
    echo "<form method='post' style='width:65%;margin:auto;background:white;padding:25px;border-radius:10px;box-shadow:0 3px 6px rgba(0,0,0,0.3);'>";
    echo "<input type='hidden' name='jumlah' value='$jumlah'>";
    echo "<h3>Masukkan Data Kehadiran Karyawan</h3>";

    for ($i = 1; $i <= $jumlah; $i++) {
        echo "<label>Nama Karyawan $i:</label>";
        echo "<input type='text' name='karyawan[]' placeholder='Masukkan nama karyawan ke-$i' required>";

        echo "<label>Status Kehadiran:</label>";
        echo "<select name='status[]' id='status$i' onchange='tampilkanAlasan($i)' required>
                <option value='' hidden>Pilih Status</option>
                <option value='Hadir'>Hadir</option>
                <option value='Izin'>Izin</option>
                <option value='Sakit'>Sakit</option>
              </select>";

        echo "<input type='text' name='alasan[]' id='alasan$i' placeholder='Alasan izin...' style='display:none;'>";
        echo "<hr>";
    }

    echo "<button type='submit' name='tampilkan'>Tampilkan Hasil Kehadiran</button>";
    echo "</form>";
}

// Tahap 2: tampilkan hasil tabel
if (isset($_POST['tampilkan'])) {
    $karyawan = $_POST['karyawan'];
    $status = $_POST['status'];
    $alasan = $_POST['alasan'];

    echo "<table>";
    echo "<tr><th>No</th><th>Nama Karyawan</th><th>Status Kehadiran</th><th>Alasan (jika izin)</th></tr>";

    for ($i = 0; $i < count($karyawan); $i++) {
        $no = $i + 1;
        $stat = $status[$i];

        if ($stat == "Hadir") {
            $statusTampil = "<span class='hadir'>Hadir</span>";
            $alasanTampil = "-";
        } elseif ($stat == "Sakit") {
            $statusTampil = "<span class='sakit'>Sakit</span>";
            $alasanTampil = "-";
        } else {
            $statusTampil = "<span class='izin'>Izin</span>";
            $alasanTampil = htmlspecialchars($alasan[$i]) ?: "-";
        }

        echo "<tr>
                <td>$no</td>
                <td>{$karyawan[$i]}</td>
                <td>$statusTampil</td>
                <td>$alasanTampil</td>
              </tr>";
    }

    echo "</table>";
}
?>



</body>
</html>