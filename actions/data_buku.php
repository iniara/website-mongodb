<?php
require_once '../vendor/autoload.php';

use MongoDB\Client;

$mongoClient = new MongoDB\Client;
$database = $mongoClient->perpustakaan;
$collection = $database->buku;

$nama_buku = "";
$penulis = "";
$tahun_terbit = "";
$penerbit = "";
$kategori = "";
$jumlah_halaman = "";
$sukses = "";

// Proses penambahan data baru atau pengeditan data yang ada
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['simpan'])) {
    if (isset($_GET['id'])) {
        // Jika ID ada, ini adalah proses edit data yang ada
        $id = $_GET['id'];
        $document = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);

        if ($document) {
            $updateResult = $collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectID($id)],
                ['$set' => [
                    'nama_buku' => $_POST['nama_buku'],
                    'penulis' => $_POST['penulis'],
                    'tahun_terbit' => $_POST['tahun_terbit'],
                    'penerbit' => $_POST['penerbit'],
                    'kategori' => $_POST['kategori'],
                    'jumlah_halaman' => $_POST['jumlah_halaman']
                ]]
            );

            if ($updateResult->getModifiedCount() > 0) {
                $sukses = "Data buku berhasil diperbarui!";
            } else {
                $sukses = "Gagal memperbarui data buku!";
            }
        } else {
            // Penanganan jika data dengan ID yang diberikan tidak ditemukan
            echo "Data buku tidak ditemukan.";
            exit;
        }
    } else {
        // Jika tidak ada ID, ini adalah proses tambah data baru
        $nama_buku = $_POST['nama_buku'];
        $penulis = $_POST['penulis'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $penerbit = $_POST['penerbit'];
        $kategori = $_POST['kategori'];
        $jumlah_halaman = $_POST['jumlah_halaman'];

        $result = $collection->insertOne([
            'nama_buku' => $nama_buku,
            'penulis' => $penulis,
            'tahun_terbit' => $tahun_terbit,
            'penerbit' => $penerbit,
            'kategori' => $kategori,
            'jumlah_halaman' => $jumlah_halaman
        ]);

        if ($result->getInsertedCount() > 0) {
            $sukses = "Data buku berhasil disimpan!";
        } else {
            $sukses = "Gagal menyimpan data buku!";
        }
    }
}

// Proses pengeditan data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $document = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);

    if ($document) {
        $nama_buku = $document['nama_buku'];
        $penulis = $document['penulis'];
        $tahun_terbit = $document['tahun_terbit'];
        $penerbit = $document['penerbit'];
        $kategori = $document['kategori'];
        $jumlah_halaman = $document['jumlah_halaman'];
    } else {
        // Penanganan jika data dengan ID yang diberikan tidak ditemukan
        echo "Data buku tidak ditemukan.";
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Input Data Buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">
        <h1>Input Data Buku</h1>

        <?php if ($sukses) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo $sukses; ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <!-- Form input untuk data buku -->
            <!-- Sesuaikan dengan kebutuhan Anda -->
            <div class="form-group row">
                <label for="nama_buku" class="col-sm-2 col-form-label">Nama Buku</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_buku" name="nama_buku" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="penulis" name="penulis" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="penerbit" name="penerbit" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kategori" name="kategori" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="jumlah_halaman" class="col-sm-2 col-form-label">Jumlah Halaman</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="jumlah_halaman" name="jumlah_halaman" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="../buku.php" class="btn btn-secondary">Kembali</a>
                </div>
            </div>

        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>