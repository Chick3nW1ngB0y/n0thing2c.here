<?php
include "header.php";
include "navbar.php";
?>

<div class="card mt-2">
    <div class="card-body">
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah-data">
            Tambah Data
        </button>
    </div>
    <div class="card-body">
        <?php
        if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "simpan") { ?>
                <div class="alert alert-success" role="alert">
                    Data Berhasil Di Simpan
                </div>
            <?php }
            if ($_GET['pesan'] == "update") { ?>
                <div class="alert alert-success" role="alert">
                    Data Berhasil Di Update
                </div>
            <?php }
            if ($_GET['pesan'] == "hapus") { ?>
                <div class="alert alert-success" role="alert">
                    Data Berhasil Di Hapus
                </div>
            <?php }
        }
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Petugas</th>
                    <th>Username</th>
                    <th>Akses Petugas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../koneksi.php';
                $no = 1;
                $data = mysqli_query($koneksi, "SELECT * FROM petugas");
                while ($d = mysqli_fetch_array($data)) {
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $d['nama_petugas']; ?></td>
                        <td><?php echo $d['username']; ?></td>
                        <td>
                            <?php
                            if ($d['level'] == '1') { ?>
                                Administrator
                            <?php } else { ?>
                                Petugas
                            <?php } ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?php echo $d['id_petugas']; ?>">
                                Edit
                            </button>
                            <?php if ($d['level'] != $_SESSION['level']) { ?>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?php echo $d['id_petugas']; ?>">
                                    Hapus
                                </button>
                            <?php } ?>
                        </td>
                    </tr>

                    <div class="modal fade" id="edit-data<?php echo $d['id_petugas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="proses_update_petugas.php" method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Nama Petugas</label>
                                            <input type="hidden" name="id_petugas" value="<?php echo $d['id_petugas']; ?>">
                                            <input type="text" name="nama_petugas" class="form-control" value="<?php echo $d['nama_petugas']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" name="username" class="form-control" value="<?php echo $d['username']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="text" name="password" class="form-control">
                                            <small class="text-danger text-sm">* Kosongkan jika tidak merubah password</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Akses Petugas</label>
                                            <select name="level" class="form-control">
                                                <option>--- Pilih Akses ---</option>
                                                <option value="1" <?php if ($d['level'] == '1') { echo "selected"; } ?>>Administrator</option>
                                                <option value="2" <?php if ($d['level'] == '2') { echo "selected"; } ?>>Petugas</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="hapus-data<?php echo $d['id_petugas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="proses_hapus_petugas.php">
                                    <div class="modal-body">
                                        <input type="hidden" name="id_petugas" value="<?php echo $d['id_petugas']; ?>">
                                        Apakah anda yakin akan menghapus data <b><?php echo $d['nama_petugas']; ?></b>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="proses_simpan_petugas.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Petugas</label>
                        <input type="text" name="nama_petugas" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Akses Petugas</label>
                        <select name="level" class="form-control">
                            <option>--- Akses Petugas ---</option>
                            <option value="1">Administrator</option>
                            <option value="2">Petugas</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<?php
include "footer.php";
?>
