<?php include("header.php"); ?>


<?php
require_once 'vendor/autoload.php';

// Proses koneksi ke MongoDB
$mongoClient = new MongoDB\Client;
$database = $mongoClient->perpustakaan; // Nama database MongoDB
$collection = $database->anggota; // Nama collection MongoDB

// Mendapatkan semua data buku dari MongoDB
$books = $collection->find();

$sukses = "";
$katakunci = (isset($_GET['katakunci'])) ? $_GET['katakunci'] : "";
$op = (isset($_GET['op'])) ? $_GET['op'] : ""; // Mendefinisikan $op di sini sebelum digunakan

if ($op == "delete" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus dokumen dari koleksi berdasarkan ID
    $deleteResult = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($id)]);

    if ($deleteResult->getDeletedCount() > 0) {
        $sukses = "Data anggota berhasil dihapus!";
    } else {
        $error = "Gagal menghapus data anggota!";
    }
}

?>

<h1>Data Anggota Perpustakaan</h1>
<p>
    <a href="actions/data_anggota.php">
        <input type="button" class="btn btn-primary" value="Masukkan Anggota Perpustakaan Baru" />
    </a>
</p>
<form class="row g-3" method="get">
    <div class="col-auto">
        <input type="text" class="form-control" placeholder="Masukkan Kata Kunci" name="katakunci" value="<?php echo $katakunci ?>" />
    </div>
    <div class="col-auto">
        <input type="submit" name="cari" value="Cari Tulisan" class="btn btn-secondary" />
    </div>
</form>
<table class="table table-stripped">
    <thead>
        <tr>
            <th class="col-1">#</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Tahun Bergabung</th>
            <th>Pekerjaan</th>
            <th>Status Keanggotaan</th>
            <th>Riwayat Peminjaman</th>
            <th class="col-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($books as $key => $book) : ?>
            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $book->nama; ?></td>
                <td><?php echo $book->jenis_kelamin; ?></td>
                <td><?php echo $book->tahun_bergabung; ?></td>
                <td><?php echo $book->pekerjaan; ?></td>
                <td><?php echo $book->status; ?></td>
                <td><?php echo $book->riwayat; ?></td>
                <td>
                    <a href="actions/data_anggota.php?id=<?php echo $book['_id']; ?>">
                        <span class="badge bg-warning text-dark">Edit</span>
                    </a>

                    <a href="anggota.php?op=delete&id=<?php echo $book['_id']; ?>" onclick="return confirm('Hapus Data?')">
                        <span class="badge bg-danger">Delete</span>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>

<?php include("footer.php"); ?>