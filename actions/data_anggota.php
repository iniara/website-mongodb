<?php
require_once '../vendor/autoload.php';

use MongoDB\Client;

$mongoClient = new Client;
$database = $mongoClient->perpustakaan;
$collection = $database->anggota;

$sukses = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['simpan'])) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $document = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);

        if ($document) {
            $collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectID($id)],
                ['$set' => [
                    'nama' => $_POST['nama'],
                    'jenis_kelamin' => $_POST['jenis_kelamin'],
                    'tahun_bergabung' => $_POST['tahun_bergabung'],
                    'pekerjaan' => $_POST['pekerjaan'],
                    'status' => $_POST['status'],
                    'riwayat' => $_POST['riwayat']
                ]]
            );

            $sukses = "Data anggota berhasil diperbarui!";
        } else {
            echo "Data anggota tidak ditemukan.";
            exit;
        }
    } else {
        $result = $collection->insertOne([
            'nama' => $_POST['nama'],
            'jenis_kelamin' => $_POST['jenis_kelamin'],
            'tahun_bergabung' => $_POST['tahun_bergabung'],
            'pekerjaan' => $_POST['pekerjaan'],
            'status' => $_POST['status'],
            'riwayat' => $_POST['riwayat']
        ]);

        if ($result->getInsertedCount() > 0) {
            $sukses = "Data anggota berhasil disimpan!";
        } else {
            $sukses = "Gagal menyimpan data anggota!";
        }
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $document = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);

    if ($document) {
        $nama = $document['nama'];
        $jenis_kelamin = $document['jenis_kelamin'];
        $tahun_bergabung = $document['tahun_bergabung'];
        $pekerjaan = $document['pekerjaan'];
        $status = $document['status'];
        $riwayat = $document['riwayat'];
    } else {
        echo "Data anggota tidak ditemukan.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Input Data Anggota Perpustakaan</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">
        <h1>Input Data Anggota Perpustakaan</h1>

        <?php if ($sukses) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo $sukses; ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <!-- Form input untuk data buku -->
            <!-- Sesuaikan dengan kebutuhan Anda -->
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="tahun_bergabung" class="col-sm-2 col-form-label">Tahun Bergabung</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tahun_bergabung" name="tahun_bergabung" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label">Status Keanggotaan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="status" name="status" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="riwayat" class="col-sm-2 col-form-label">Riwayat Peminjaman</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="riwayat" name="riwayat" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="../anggota.php" class="btn btn-secondary">Kembali</a>
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