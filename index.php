<?php

include 'fungsi.php';

requireLogin();

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $koneksi->query("DELETE FROM barang WHERE id = $id");
    header("Location: index.php");
    exit();
}

$items = $koneksi->query("SELECT * FROM barang")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Barang</title>
    <link rel="stylesheet" href="yo.css">
</head>

<body>
    <div>
        <nav style="display: flex; gap: 15px;">
            <a href="index.php">Barang</a>
            <a href="transaksi.php">Transaksi</a>
            <?php if (isSuperAdmin()): ?>
                <a href="users.php">Users</a>
            <?php endif; ?>
            <a href="logout.php" style="color: red;">Logout</a>
        </nav>

        <div style="display: flex; justify-content: space-between; margin: 20px 0;">
            <h2>Daftar Barang</h2>
            <a href="form_barang.php">+ Tambah Barang</a>
        </div>

        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th>Stok Saat Ini</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['nama'] ?></td>
                        <td><?= $item['kode'] ?></td>
                        <td><?= $item['deskripsi'] ?></td>
                        <td><?= $item['jumlah_tersedia'] ?></td>
                        <td><?= $item['lokasi'] ?></td>
                        <td>
                            <a href="form_barang.php?id=<?= $item['id'] ?>">Edit</a> |
                            <a href="peminjaman.php?action=pinjam&id=<?= $item['id'] ?>">Pinjam</a> |
                            <?php if ($item['jumlah_tersedia'] < $item['jumlah']): ?>
                                <a href="peminjaman.php?action=kembali&id=<?= $item['id'] ?>">Kembalikan</a> |
                            <?php endif; ?>
                            <a href="index.php?delete_id=<?= $item['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>