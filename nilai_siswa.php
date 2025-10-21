<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tugas 1 - Rata-Rata Nilai Siswa</title>
<style>
body {
    font-family: Arial;
    background: #f8f8f8;
    padding: 20px;
}
h2 {
    background:#ff7043;
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
    background:#ffccbc;
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
    background:#ff7043;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
}
.hasil {
    background:#fff8dc;
    padding:10px;
    margin-top:10px;
    border-radius:8px;
}
</style>
</head>
<body>
<h2>Tugas 1 – Menghitung Rata-Rata Nilai Siswa</h2>

<form method="post">
<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NISN</th>
        <th>Kelas</th>
        <th>Pelajaran</th>
        <th>Nilai</th>
    </tr>
    <?php 
    $pelajaran_list = ["Matematika", "Bahasa Indonesia", "Bahasa Inggris", "IPA", "IPS"];
    for($i=1;$i<=5;$i++){ ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><input type="text" name="nama[]" placeholder="Nama Siswa"></td>
        <td><input type="text" name="nisn[]" placeholder="NISN"></td>
        <td><input type="text" name="kelas[]" placeholder="Kelas"></td>
        <td>
            <select name="pelajaran[]">
                <option value="">-- Pilih Pelajaran --</option>
                <?php 
                foreach($pelajaran_list as $p){
                    echo "<option value='$p'>$p</option>";
                }
                ?>
            </select>
        </td>
        <td><input type="text" name="nilai[]" placeholder="contoh: 70,80,90"></td>
    </tr>
    <?php } ?>
</table>
<button type="submit" name="proses">Hitung Rata-Rata</button>
</form>

<?php
if(isset($_POST['proses'])){
    echo "<div class='hasil'><h3>Hasil Perhitungan</h3>";
    $total_semua = 0;
    $jumlah_siswa = 0;

    for($i=0; $i<count($_POST['nama']); $i++){
        $nama = $_POST['nama'][$i];
        $nisn = $_POST['nisn'][$i];
        $kelas = $_POST['kelas'][$i];
        $pelajaran = $_POST['pelajaran'][$i];
        $nilai = $_POST['nilai'][$i];

        if(!empty($nama) && !empty($nilai)){
            $nilai_array = explode(",", $nilai);
            $total = 0;
            foreach($nilai_array as $n){ $total += (int)$n; }
            $rata = $total / count($nilai_array);
            $status = ($rata >= 75) ? "Lulus" : "Tidak Lulus";
            echo "Nama: <b>$nama</b> | NISN: $nisn | Kelas: $kelas | Pelajaran: $pelajaran<br>
                  Rata-rata: <b>".round($rata,2)."</b> - Status: <b>$status</b><br><br>";
            $total_semua += $rata;
            $jumlah_siswa++;
        }
    }

    if($jumlah_siswa > 0){
        $rata_keseluruhan = $total_semua / $jumlah_siswa;
        echo "<hr><b>Rata-rata Keseluruhan:</b> ".round($rata_keseluruhan,2);
    }
    echo "</div>";
}
?>
</body>
</html>