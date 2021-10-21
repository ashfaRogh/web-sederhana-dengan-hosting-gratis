<?php include("inc_header.php") ?>
<?php
$sukses = "";
$password = (isset($_GET['password'])) ? $_GET['password'] : "";
if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1   = "select foto from microcontroller where id = '$id'";
    $q1     = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    @unlink("../gambar/".$r1['foto']);
 
    $sql1   = "delete from microcontroller where id = '$id'";
    $q1     = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses     = "Berhasil hapus data";
    }
}
?>
<h1>Halaman Admin Microcontroller</h1>
<p>
    <a href="microcontroller_input.php">
        <input type="button" class="btn btn-primary" value="Buat Microcontroller Baru" />
    </a>
</p>
<?php
if ($sukses) {
?>
    <div class="alert alert-primary" role="alert">
        <?php echo $sukses ?>
    </div>
<?php
}
?>
<form class="row g-3" method="get">
    <div class="col-auto">
        <input type="text" class="form-control" placeholder="Masukkan Kata Kunci" name="password" value="<?php echo $password ?>" />
    </div>
    <div class="col-auto">
        <input type="submit" name="cari" value="Cari Tulisan" class="btn btn-secondary" />
    </div>
</form>
<table class="table table-striped">
    <thead>
        <tr>
            <th class="col-1">#</th>
            <th class="col-2">Foto</th>
            <th>Nama</th>
            <th class="col-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sqltambahan = "";
        $per_halaman = 5;
        if ($password != '') {
            $array_password = explode(" ", $password);
            for ($x = 0; $x < count($array_password); $x++) {
                $sqlcari[] = "(nama like '%" . $array_password[$x] . "%' or isi like '%" . $array_password[$x] . "%')";
            }
            $sqltambahan    = " where " . implode(" or ", $sqlcari);
        }
        $sql1   = "select * from microcontroller $sqltambahan";
        $page   = isset($_GET['page'])?(int)$_GET['page']:1;
        $mulai  = ($page > 1) ? ($page * $per_halaman) - $per_halaman : 0;
        $q1     = mysqli_query($koneksi,$sql1);
        $total  = mysqli_num_rows($q1);
        $pages  = ceil($total / $per_halaman);
        $nomor  = $mulai + 1;
        $sql1   = $sql1." order by id desc limit $mulai,$per_halaman";

        $q1     = mysqli_query($koneksi, $sql1);
      
        while ($r1 = mysqli_fetch_array($q1)) {
        ?>
            <tr>
                <td><?php echo $nomor++ ?></td>
                <td><img src="../gambar/<?php echo microcontroller_foto($r1['id'])?>" style="max-height:100px;max-width:100px"/></td>
                <td><?php echo $r1['nama'] ?></td>
                <td>
                    <a href="microcontroller_input.php?id=<?php echo $r1['id']?>">
                        <span class="badge bg-warning text-dark">Edit</span>
                    </a>

                    <a href="microcontroller.php?op=delete&id=<?php echo $r1['id'] ?>" onclick="return confirm('Apakah yakin mau hapus data ?')">
                        <span class="badge bg-danger">Delete</span>
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>

    </tbody>
</table>

<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php 
        $cari = isset($_GET['cari'])? $_GET['cari'] : "";

        for($i=1; $i <= $pages; $i++){
            ?>
            <li class="page-item">
                <a class="page-link" href="microcontroller.php?password=<?php echo $password?>&cari=<?php echo $cari?>&page=<?php echo $i ?>"><?php echo $i ?></a>
            </li>
            <?php
        }
        ?>
    </ul>
</nav>
<?php include("inc_footer.php") ?>