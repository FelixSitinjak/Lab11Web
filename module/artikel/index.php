<?php
// Menampilkan data artikel / user (contoh sederhana)
$db = new Database();
$result = $db->query("SELECT * FROM users ORDER BY id DESC");
?>

<div class="card">
    <h3>Data User</h3>
    <div style="margin-top: 10px; margin-bottom: 6px;">
        <a href="/lab11_php_oop/index.php/artikel/tambah" class="btn btn-primary btn-sm">Tambah Data</a>
    </div>

    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td class="actions">
                            <a href="/lab11_php_oop/index.php/artikel/ubah?id=<?= $row['id']; ?>" class="btn btn-secondary btn-sm">Ubah</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4">Belum ada data.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
