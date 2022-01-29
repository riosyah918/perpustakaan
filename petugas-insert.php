<?php


//Proses insert data
if (isset($_POST['simpanpetugas'])) {
$nama       = $_POST['nama'];
$jabatan    = $_POST['jabatan'];
$tlp        = $_POST['nomor_telepon'];
$alamat     = $_POST['alamat'];
$username   = $_POST['username'];
$password   = $_POST['password'];

//////////////////////////////////
$options = [
    'cost' => 12,
];
$password_encrypt = password_hash( $password, PASSWORD_BCRYPT, $options);
//////////////////////////////////
$query_insert = mysqli_query($koneksi, "INSERT INTO petugas VALUES('','$nama','$jabatan','$tlp','$alamat','$username','$password_encrypt')");

//Membuat notifikasi jika berhasil/tidak disimpan datanya
    if($query_insert)
    {
        ?>
            <div class="alert alert-success">
                Data Berhasil Disimpan
            </div>
        <?php
        header('Refresh:2; http://localhost/Perpustakaan1/admin.php?page=petugas');
    }
    else
    {
        ?>
            <div class="alert alert-danger">
                Data GAGAL Disimpan !!!!!!!!!
            </div>
        <?php
        header('Refresh:2; URL=http://Perpustakaan1/admin.php?page=petugas');
    }
}
//// End of proses insert /////////////////////////////////////////////////////////
?>