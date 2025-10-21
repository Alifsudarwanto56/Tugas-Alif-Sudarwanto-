<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tugas 1 - Penilaian Kinerja Karyawan</title>
<style>
body {
    font-family: Arial;
    background: #f8f8f8;
    padding: 20px;
}
h2 {
    background:#4caf50;
    color:white;
    padding:10px;
    border-radius:8px;
}
form {
    background:white;
    padding:15px;
    border-radius:8px;
}
table {
    width:100%;
    border-collapse: collapse;
    margin-top:10px;
}
th, td {
    border:1px solid #ccc;
    padding:8px;
    text-align:center;
}
th {
    background:#c8e6c9;
}
input, select {
    padding:6px;
    width:95%;
    border:1px solid #ccc;
    border-radius:5px;
}
button {
    margin-top:10px;
    padding:10px;
    background:#4caf50;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
}
.hasil {
    background:#e8f5e9;
    padding:10px;
    margin-top:10px;
    border-radius:8px;
}
</style>
</head>
<body>
<h2>Tugas 4 – Penilaian Kinerja Karyawan</h2>

<form method="post">
<table>
    <tr>
        <th>No</th>
        <th>Nama Karyawan</th>
        <th>NIK</th>
        <th>Divisi</th>
        <th>Aspek Penilaian</th>
        <th>Nilai</th>
    </tr>
    <?php 
    $divisi_list = ["HRD", "Keuangan", "Produksi", "Marketing", "IT"];
    $aspek_list = ["Disiplin", "Kerja Sama", "Kinerja", "Inisiatif", "Kehadiran"];
    for($i=1;$i<=5;$i++){ ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><input type="text" name="nama[]" placeholder="Nama Karyawan"></td>
        <td><input type="text" name="nik[]" placeholder="NIK"></td>
        <td>
            <select name="divisi[]">
                <option value="">-- Pilih Divisi --</option>
                <?php 
                foreach($divisi_list as $d){
                    echo "<option value='$d'>$d</option>";
                }
                ?>
            </select>
        </td>
        <td>
            <select name="aspek[]">
                <option value="">-- Pilih Aspek --</option>
                <?php 
                foreach($aspek_list as $a){
                    echo "<option value='$a'>$a</option>";
                }
                ?>
            </select>
        </td>
        <td><input type="text" name="nilai[]" placeholder="contoh: 70,80,90"></td>
    </tr>
    <?php } ?>
</table>
<button type="submit" name="proses">Hitung Nilai Akhir</button>
</form>

<?php
if(isset($_POST['proses'])){
    echo "<div class='hasil'><h3>Hasil Penilaian</h3>";
    $total_semua = 0;
    $jumlah_karyawan = 0;

    for($i=0; $i<count($_POST['nama']); $i++){
        $nama = $_POST['nama'][$i];
        $nik = $_POST['nik'][$i];
        $divisi = $_POST['divisi'][$i];
        $aspek = $_POST['aspek'][$i];
        $nilai = $_POST['nilai'][$i];

        if(!empty($nama) && !empty($nilai)){
            $nilai_array = explode(",", $nilai);
            $total = 0;
            foreach($nilai_array as $n){ $total += (int)$n; }
            $rata = $total / count($nilai_array);

            // Konversi nilai ke huruf
            if($rata > 85) {
                $huruf = "A";
            } elseif($rata >= 70) {
                $huruf = "B";
            } elseif($rata >= 60) {
                $huruf = "C";
            } else {
                $huruf = "D";
            }

            // Keterangan hasil
            $status = ($rata >= 70) ? "Baik" : "Perlu Peningkatan";

            echo "Nama: <b>$nama</b> | NIK: $nik | Divisi: $divisi | Aspek: $aspek<br>
                  Nilai Rata-rata: <b>".round($rata,2)."</b> | Huruf: <b>$huruf</b> | Status: <b>$status</b><br><br>";

            $total_semua += $rata;
            $jumlah_karyawan++;
        }
    }

    if($jumlah_karyawan > 0){
        $rata_keseluruhan = $total_semua / $jumlah_karyawan;
        echo "<hr><b>Rata-rata Kinerja Keseluruhan:</b> ".round($rata_keseluruhan,2);
    }
    echo "</div>";
}
?>
</bod<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tugas 1 - Penilaian Kinerja Karyawan</title>
<style>
body {
    font-family: Arial;
    background: #f8f8f8;
    padding: 20px;
}
h2 {
    background:#4caf50;
    color:white;
    padding:10px;
    border-radius:8px;
}
form {
    background:white;
    padding:15px;
    border-radius:8px;
}
table {
    width:100%;
    border-collapse: collapse;
    margin-top:10px;
}
th, td {
    border:1px solid #ccc;
    padding:8px;
    text-align:center;
}
th {
    background:#c8e6c9;
}
input, select {
    padding:6px;
    width:95%;
    border:1px solid #ccc;
    border-radius:5px;
}
button {
    margin-top:10px;
    padding:10px;
    background:#4caf50;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
}
.hasil {
    background:#e8f5e9;
    padding:10px;
    margin-top:10px;
    border-radius:8px;
}
</style>
</head>
<body>
<h2>Tugas 1 – Penilaian Kinerja Karyawan</h2>

<form method="post">
<table>
    <tr>
        <th>No</th>
        <th>Nama Karyawan</th>
        <th>NIK</th>
        <th>Divisi</th>
        <th>Aspek Penilaian</th>
        <th>Nilai</th>
    </tr>
    <?php 
    $divisi_list = ["HRD", "Keuangan", "Produksi", "Marketing", "IT"];
    $aspek_list = ["Disiplin", "Kerja Sama", "Kinerja", "Inisiatif", "Kehadiran"];
    for($i=1;$i<=5;$i++){ ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><input type="text" name="nama[]" placeholder="Nama Karyawan"></td>
        <td><input type="text" name="nik[]" placeholder="NIK"></td>
        <td>
            <select name="divisi[]">
                <option value="">-- Pilih Divisi --</option>
                <?php 
                foreach($divisi_list as $d){
                    echo "<option value='$d'>$d</option>";
                }
                ?>
            </select>
        </td>
        <td>
            <select name="aspek[]">
                <option value="">-- Pilih Aspek --</option>
                <?php 
                foreach($aspek_list as $a){
                    echo "<option value='$a'>$a</option>";
                }
                ?>
            </select>
        </td>
        <td><input type="text" name="nilai[]" placeholder="contoh: 70,80,90"></td>
    </tr>
    <?php } ?>
</table>
<button type="submit" name="proses">Hitung Nilai Akhir</button>
</form>

<?php
if(isset($_POST['proses'])){
    echo "<div class='hasil'><h3>Hasil Penilaian</h3>";
    $total_semua = 0;
    $jumlah_karyawan = 0;

    for($i=0; $i<count($_POST['nama']); $i++){
        $nama = $_POST['nama'][$i];
        $nik = $_POST['nik'][$i];
        $divisi = $_POST['divisi'][$i];
        $aspek = $_POST['aspek'][$i];
        $nilai = $_POST['nilai'][$i];

        if(!empty($nama) && !empty($nilai)){
            $nilai_array = explode(",", $nilai);
            $total = 0;
            foreach($nilai_array as $n){ $total += (int)$n; }
            $rata = $total / count($nilai_array);

            // Konversi nilai ke huruf
            if($rata > 85) {
                $huruf = "A";
            } elseif($rata >= 70) {
                $huruf = "B";
            } elseif($rata >= 60) {
                $huruf = "C";
            } else {
                $huruf = "D";
            }

            // Keterangan hasil
            $status = ($rata >= 70) ? "Baik" : "Perlu Peningkatan";

            echo "Nama: <b>$nama</b> | NIK: $nik | Divisi: $divisi | Aspek: $aspek<br>
                  Nilai Rata-rata: <b>".round($rata,2)."</b> | Huruf: <b>$huruf</b> | Status: <b>$status</b><br><br>";

            $total_semua += $rata;
            $jumlah_karyawan++;
        }
    }

    if($jumlah_karyawan > 0){
        $rata_keseluruhan = $total_semua / $jumlah_karyawan;
        echo "<hr><b>Rata-rata Kinerja Keseluruhan:</b> ".round($rata_keseluruhan,2);
    }
    echo "</div>";
}
?>
</body>
</html>y>
</html>