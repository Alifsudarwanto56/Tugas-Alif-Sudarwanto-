<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tugas - Menghitung Gaji dan Lembur Karyawan</title>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #42a5f5, #478ed1);
        padding: 40px;
        color: #333;
    }
    h2 {
        text-align: center;
        background: #1976D2;
        color: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
    form {
        background: white;
        width: 80%;
        margin: 20px auto;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.15);
    }
    label {
        font-weight: bold;
        display: block;
        margin: 10px 0 5px;
    }
    select, input[type=number] {
        width: 100%;
        padding: 8px;
        border-radius: 6px;
        border: 1px solid #ccc;
        margin-bottom: 15px;
        font-size: 15px;
    }
    button {
        display: block;
        margin: 0 auto;
        background: #1976D2;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
    }
    button:hover {
        background: #0D47A1;
        transform: scale(1.05);
    }
    table {
        width: 85%;
        margin: 25px auto;
        border-collapse: collapse;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    }
    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
        font-size: 15px;
    }
    th {
        background: #1976D2;
        color: white;
    }
    tr:nth-child(even) {
        background: #f9f9f9;
    }
    .footer {
        text-align: center;
        font-size: 14px;
        margin-top: 40px;
        color: white;
    }
</style>
</head>
<body>
    <h2>💼 Menghitung Gaji dan Lembur Karyawan</h2>

    <form method="post">
        <h3 style="text-align:center; color:#1976D2;">Masukkan Jam Kerja Karyawan</h3>
        <?php
        for ($i = 1; $i <= 4; $i++) {
            echo "
            <label for='jam$i'>Karyawan $i</label>
            <select name='jam$i' id='jam$i' required>
                <option value=''>-- Pilih Jam Kerja --</option>";
            for ($j = 30; $j <= 60; $j++) {
                echo "<option value='$j'>$j jam</option>";
            }
            echo "</select>";
        }
        ?>
        <button type="submit" name="hitung">💰 Hitung Gaji</button>
    </form>

    <?php
    if (isset($_POST['hitung'])) {
        $tarif_normal = 20000;
        $tarif_lembur = 25000;

        echo "<table>";
        echo "<tr><th>No</th><th>Jam Kerja</th><th>Jam Normal</th><th>Jam Lembur</th><th>Total Gaji (Rp)</th></tr>";

        // Loop menghitung gaji tiap karyawan
        for ($i = 1; $i <= 4; $i++) {
            $jam = $_POST["jam$i"];

            if ($jam > 40) {
                $jam_normal = 40;
                $jam_lembur = $jam - 40;
            } else {
                $jam_normal = $jam;
                $jam_lembur = 0;
            }

            $gaji_normal = $jam_normal * $tarif_normal;
            $gaji_lembur = $jam_lembur * $tarif_lembur;
            $total = $gaji_normal + $gaji_lembur;

            echo "<tr>
                    <td>$i</td>
                    <td>{$jam}</td>
                    <td>{$jam_normal}</td>
                    <td>{$jam_lembur}</td>
                    <td><b>" . number_format($total, 0, ',', '.') . "</b></td>
                  </tr>";
        }

        echo "</table>";
    }
    ?>
</body>
</html>