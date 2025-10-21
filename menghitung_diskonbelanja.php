<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tugas 2 - Total Belanja dan Diskon</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: #f8f8f8;
    padding: 20px;
}
h2 {
    background: #009688;
    color: white;
    padding: 10px;
    border-radius: 8px;
}
form {
    background: white;
    padding: 15px;
    border-radius: 8px;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}
th, td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: center;
}
th {
    background-color: #009688;
    color: white;
}
select, input {
    padding: 5px;
    width: 90%;
    border-radius: 5px;
    border: 1px solid #ccc;
}
input[readonly] {
    background-color: #e9ecef;
}
button {
    margin-top: 10px;
    padding: 10px;
    width: 100%;
    background: #009688;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
button:hover {
    background: #00796b;
}
.hasil {
    background: #e0f2f1;
    padding: 10px;
    margin-top: 15px;
    border-radius: 8px;
}
</style>
</head>
<body>
<h2>Tugas 2 – Menghitung Total Harga Belanja dan Diskon</h2>

<form method="post">
<table>
    <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Harga Satuan</th>
        <th>Jumlah</th>
    </tr>
    <?php
    // Daftar barang dan harga
    $barangList = [
        "Sabun Mandi" => 5000,
        "Shampoo" => 10000,
        "Pasta Gigi" => 8000,
        "Sikat Gigi" => 4000,
        "Tisu" => 6000,
        "Minuman Botol" => 7000,
        "Roti" => 12000,
        "Mie Instan" => 4000,
        "Kopi Sachet" => 3000,
        "Gula Pasir" => 15000
    ];

    // Buat tabel input
    for($i=1; $i<=5; $i++){
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td><select name='barang[]' onchange='updateHarga(this, $i)'>
                <option value=''>-- Pilih Barang --</option>";
        foreach($barangList as $nama => $harga){
            echo "<option value='$nama' data-harga='$harga'>$nama</option>";
        }
        echo "</select></td>";
        echo "<td><input type='text' name='harga[]' id='harga_$i' value='' readonly></td>";
        echo "<td><input type='number' name='jumlah[]' min='1' value='1'></td>";
        echo "</tr>";
    }
    ?>
</table>
<button type="submit" name="proses">Hitung Total Belanja</button>
</form>

<script>
// Script untuk mengubah harga otomatis sesuai barang
function updateHarga(select, index) {
    let harga = select.options[select.selectedIndex].getAttribute('data-harga');
    document.getElementById('harga_' + index).value = harga ? harga : '';
}
</script>

<?php
// Proses perhitungan total
if(isset($_POST['proses'])){
    $barang = $_POST['barang'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    echo "<div class='hasil'>";
    echo "<h3>Rincian Belanja</h3>";
    echo "<table>
            <tr>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>";
    $total = 0;
    for($i=0; $i<count($barang); $i++){
        if($barang[$i] == "") continue; // Lewati baris kosong
        $subtotal = (int)$harga[$i] * (int)$jumlah[$i];
        $total += $subtotal;
        echo "<tr>
                <td>{$barang[$i]}</td>
                <td>Rp{$harga[$i]}</td>
                <td>{$jumlah[$i]}</td>
                <td>Rp$subtotal</td>
              </tr>";
    }

    // Logika diskon
    $diskon = ($total > 50000) ? $total * 0.1 : (($total > 30000) ? $total * 0.05 : 0);
    $bayar = $total - $diskon;

    echo "</table>";
    echo "<p><strong>Total Belanja:</strong> Rp$total</p>";
    echo "<p><strong>Diskon:</strong> Rp$diskon</p>";
    echo "<p><strong>Total Bayar:</strong> Rp$bayar</p>";
    echo "</div>";
}
?>
</body>
</html>