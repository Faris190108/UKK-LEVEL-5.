<?php

include 'db.php';
include 'fungsi.php';

requireLogin();

$transaksi = $koneksi->query("SELECT t.*, b.nama FROM transaksi t JOIN barang b ON t.id_barang = b.id ORDER BY t.tanggal DESC")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Riwayat Transaksi</title>
    <link rel="stylesheet" href="style.css">
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

        <h2 style="margin: 20px 0;">Riwayat Transaksi</h2>

        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Waktu</th>
                    <th>Nama Barang</th>
                    <th>Status</th>
                    <th>Jumlah</th>
                    <th>Petugas</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transaksi as $t): ?>
                    <tr>
                        <td><?= $t['id'] ?></td>
                         <td><?= $t['tanggal'] ?></td>
                        <td><?= $t['nama'] ?></td>
                        <td style="color: <?= $t['kategori'] == 'pinjam' ? 'green' : 'red' ?>">
                            <?= ucfirst($t['kategori']) ?>
                        </td>
                        <td><?= $t['jumlah'] ?></td>
                        <td><?= $t['peminjam'] ?></td>
                        <td><?= $t['catatan'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>