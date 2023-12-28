<?php include("header.php"); ?>


<?php
require_once 'vendor/autoload.php';

// Proses koneksi ke MongoDB
$mongoClient = new MongoDB\Client;
$database = $mongoClient->perpustakaan; // Nama database MongoDB
$collection = $database->buku; // Nama collection MongoDB


// Mendapatkan semua data buku dari MongoDB
$books = $collection->find();
$nama_buku = "";
$penulis = "";
$tahun_terbit = "";
$penerbit = "";
$kategori = "";
$jumlah_halaman = "";
$error = "";
$sukses = "";

$katakunci = (isset($_GET['katakunci'])) ? $_GET['katakunci'] : "";
$op = (isset($_GET['op'])) ? $_GET['op'] : ""; // Mendefinisikan $op di sini sebelum digunakan

if ($op == "delete" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus dokumen dari koleksi berdasarkan ID
    $deleteResult = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($id)]);

    if ($deleteResult->getDeletedCount() > 0) {
        $sukses = "Data buku berhasil dihapus!";
    } else {
        $error = "Gagal menghapus data buku!";
    }
}

?>


<h1>Data Buku</h1>
<p>
    <a href="actions/data_buku.php">
        <input type="button" class="btn btn-primary" value="Masukkan Buku Baru" />
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
            <th>Nama Buku</th>
            <th>Penulis</th>
            <th>Tahun Terbit</th>
            <th>Penerbit</th>
            <th>Kategori</th>
            <th>Jumlah Halaman</th>
            <th class="col-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($books as $key => $book) : ?>
            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $book->nama_buku; ?></td>
                <td><?php echo $book->penulis; ?></td>
                <td><?php echo $book->tahun_terbit; ?></td>
                <td><?php echo $book->penerbit; ?></td>
                <td><?php echo $book->kategori; ?></td>
                <td><?php echo $book->jumlah_halaman; ?></td>
                <td>
                    <a href="actions/data_buku.php?id=<?php echo $book['_id']; ?>">
                        <span class="badge bg-warning text-dark">Edit</span>
                    </a>

                    <a href="buku.php?op=delete&id=<?php echo $book['_id']; ?>" onclick="return confirm('Hapus Data?')">
                        <span class="badge bg-danger">Delete</span>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>

<?php include("footer.php"); ?>