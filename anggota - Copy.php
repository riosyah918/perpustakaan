<?php
// membuat update data

// End update

// Proses Delete Data

// end of proses delete

// Proses Insert Tambah Data

//
?>
<center><h4 style ="color:white;" class="mt-4 mb-3">Data Anggota</h4></center>
<div class="container">
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah Data
</button>
<!-- =========================================================================================== -->
<table class="table table-primary">
    <tr>
        <th>No</th>
        <th>NIS</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Jurusan</th>
        <th>Tempat Lahir</th>
        <th>Tgl Lahir</th>
        <th>Tlp</td>
        <th>Alamat</th>
        <th>Jenis Kelamin</th>
        <th>--Action--</th>
    </tr>
    <?php
        $query = mysqli_query($koneksi,"SELECT * FROM anggota");
        $no = 1;
        foreach ($query as $row) {
    ?>
    <tr>
        <td valign="center" valign="middle"><?php echo $no; ?></td>
        <td valign="middle"><?php echo $row['nis']; ?></td>
        <td valign="middle"><?php echo $row['nama']; ?></td>
        <td valign="middle"><?php echo $row['id_kelas']; ?></td>
        <td valign="middle">
        <?php
            if ($row['id_jurusan']=='1') {
                echo "Rekayasa Perangkat Lunak";
            }elseif($row['id_jurusan']=='2'){
                echo "Teknik Kendaraan Ringan";
            }elseif($row['id_jurusan']=='3'){
                echo "Teknik Kelistrikan";
            }else{
                echo "Audio Video";
            }
        ?>
            <?php echo $row['id_jurusan']; ?>
        </td>
        <td valign="middle"><?php echo $row['tempat_lahir']; ?></td>
        <td valign="middle"><?php echo $row['tgl_lahir']; ?></td>
        <td valign="middle"><?php echo $row['no_telepon']; ?></td>
        <td valign="middle"><?php echo $row['alamat']; ?></td>
        <td valign="center" valign="middle"><?php echo $row['jk']; ?></td>
        <td valign="middle">
        <a href="?page=anggota-delete&delete&id=<?php echo $row['id_anggota'];?>">
                <button class="btn btn-danger">Hapus</i></button>
            </a>
        <a  href="?page=anggota-edit&edit&id=<?php echo $row['id_anggota'];?>">
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit-modal">Edit</i></button>
           </a>
        </td>
    </tr>
    <?php
    $no++;
    }
    ?>
</table>
<!-- ============================================================================ -->


<!-- Modal Input Data -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Anggota</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <!-- Form Input Anggota ======================================================= -->
            <form action="?page=anggota-insert" method="post">
                <div class="form-group">
                    <input class="form-control" type="text" name="nis" placeholder="NIS" required>
                </div>
                <div class="form-group mt-2">
                    <input class="form-control" type="text" name="nama" placeholder="Nama Siswa" required>
                </div>
                <div class="form-group mt-2">
                    <select class="form-control" name="id_kelas" required="">
                        <option value="">---Pilih Kelas---</option>
                        <?php 
                         $query_kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
                         foreach ($query_kelas as $kelas) {
                             ?>
                             <option value="<?php echo $kelas['id_kelas'] ?>"><?php echo $kelas['nama_kelas']?></option>
                             <?php
                         }
                        ?>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <select class="form-control" name="id_jurusan" required="">
                        <option value="">---Pilih Jurusan---</option>
                        <?php 
                         $query_jurusan = mysqli_query($koneksi, "SELECT * FROM jurusan");
                         foreach ($query_jurusan as $jurusan) {
                             ?>
                             <option value="<?php echo $jurusan['id_jurusan'] ?>"><?php echo $jurusan['nama_jurusan']?></option>
                             <?php
                         }
                        ?>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <input class="form-control" type="text" name="tempat_lahir" placeholder="tempat_lahir">
                </div>
                <div class="form-group mt-2">
                    <div class="input-group">
                        <span class="input-group-text" >Tanggal Lahir</span>
                        <input class="form-control" type="date" name="tgl_lahir">
                    </div>
                </div>
                <div class="form-group mt-2">
                    <input class="form-control" type="text" name="no_telepon" placeholder="No Telepon">
                </div>
                <div class="form-group mt-2">
                    <textarea class="form-control" name="alamat" placeholder="Alamat Lengkap"></textarea>
                </div>
                <div class="form-group mt-2">
                    <select class="form-control" name="jk">
                        <option value="">--Pilih Jenis Kelamin--</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
        <!-- ====================================================================================== -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-success mt-2" type="submit" name="simpan">Simpan</button>
        </div>
            <!-- tag tutup formnya pinda ke sini -->
            </form>
            <!-- ================================================================================= -->
        </div>
    </div>
</div>
<!-- End of modal input data -->


<!-- Modal Edit Data -->

<?php 
if (isset($_GET['edit'])) {
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id_anggota = '$id'"); }//Digunakan untuk auto menampilkan data dari kolom yang ingin di ubah
    foreach ($query as $row) {

?>
<script>
    $(document).ready(function(){
        $("#edit-modal").modal('show');
    });
</script>
<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Data Anggota</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        <!-- Form Edit Anggota ======================================================================= -->

            <form action="" method="get"> <!-- form action kosong agar data tetap di halaman sendiri -->
                <div class="form-group">
                    <input value="<?php echo $row['nis']; ?>" class="form-control" type="text" name="nis" placeholder="NIS" required>
                </div>
                <div class="form-group mt-2">
                    <input value="<?php echo $row['nama']; ?>" class="form-control" type="text" name="nama" placeholder="Nama Siswa" required>
                </div>
                <div class="form-group mt-2">
                    <select  class="form-control" name="kelas">
                        <option value="<?php echo $row['kelas']; ?>">
                            <?php
                if ($row['kelas']=='XIIRPL1') {
                   echo "XII RPL 1";
                }elseif($row['kelas']=='XIIRPL2'){
                    echo "XII RPL 2";
                }else{
                    echo "XII RPL 3";
                }
                            ?>
                        </option>
                        <option value="XIIRPL1">XII RPL 1</option>
                        <option value="XIIRPL2">XII RPL 2</option>
                        <option value="XIIRPL3">XII RPL 3</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <select value="<?php echo $row['nama']; ?>" class="form-control" name="jurusan">
                        <option value="<?php echo $row['jurusan']; ?>">
                            <?php
                if ($row['jurusan']=='RPL') {
                   echo "Rekayasa Perangkat Lunak";
                }elseif($row['jurusan']=='TAV'){
                    echo "Teknik Audio Video";
                }elseif($row['jurusan']=='TKR'){
                    echo "Teknik Kendaraan Ringan";
                }else{
                    echo "Teknik Instalasi Tenaga Listrik";
                }
                            ?>
                        </option>
                        <option value="RPL">Rekayasa Perangkat Lunak</option>
                        <option value="TAV">Teknik Audio Video</option>
                        <option value="TKR">Teknik Kendaraan Ringan</option>
                        <option value="TITL">Teknik Instalasi Tenaga Listrik</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <div class="input-group">
                        <span class="input-group-text" >Tanggal Lahir</span>
                        <input value="<?php echo $row['tgl_lahir']; ?>" class="form-control" type="date" name="tanggal_lahir">
                    </div>
                </div>
                <div class="form-group mt-2">
                    <input value="<?php echo $row['no_telp']; ?>" class="form-control" type="text" name="no_telp" placeholder="No Telepon">
                </div>
                <div class="form-group mt-2">
                    <textarea class="form-control" name="alamat" placeholder="Alamat Lengkap"><?php echo $row['alamat']; ?></textarea>
                </div>
                <div class="form-group mt-2">
                    <select class="form-control" name="jk">
                        <option value="">--Pilih Jenis Kelamin--</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
        <!-- =====================================================================================- -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-success mt-2" type="submit" name="edit">Edit Data</button>
        </div>
            <!-- tag tutup formnya pinda ke sini -->
            </form>
            <!-- =========================================================- -->
        </div>
    </div>
</div>
</div>
<?php
}
?>