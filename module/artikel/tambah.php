<?php
$db = new Database();
$form = new Form("", "Simpan Data");

if ($_POST) {
    $hobi = '';
    if (isset($_POST['hobi'])) {
        if (is_array($_POST['hobi'])) {
            $hobi = implode(',', $_POST['hobi']);
        } else {
            $hobi = $_POST['hobi'];
        }
    }

    $data = [
        'nama' => $_POST['nama'],
        'email' => $_POST['email'],
        'pass' => $_POST['pass'],
        'jenis_kelamin' => $_POST['jenis_kelamin'],
        'agama' => $_POST['agama'],
        'hobi' => $hobi,
        'alamat' => $_POST['alamat'],
    ];
    $simpan = $db->insert('users', $data);
    if ($simpan) {
        header('Location: /lab11_php_oop/index.php/artikel/index');
        exit;
    } else {
        echo "<div style='color:red'>Gagal menyimpan data.</div>";
    }
}
?>
<div class="card">
    <h3>Form Tambah User</h3>
    <?php
    $form->addField("nama", "Nama Lengkap");
    $form->addField("email", "Email");
    $form->addField("pass", "Password", "password");
    $form->addField("jenis_kelamin", "Jenis Kelamin", "radio", [
        'L' => 'Laki-laki',
        'P' => 'Perempuan'
    ]);
    $form->addField("agama", "Agama", "select", [
        'Islam' => 'Islam',
        'Kristen' => 'Kristen',
        'Katolik' => 'Katolik',
        'Hindu' => 'Hindu',
        'Budha' => 'Budha'
    ]);
    $form->addField("hobi", "Hobi", "checkbox", [
        'Membaca' => 'Membaca',
        'Coding' => 'Coding',
        'Traveling' => 'Traveling'
    ]);
    $form->addField("alamat", "Alamat Lengkap", "textarea");
    $form->displayForm();
    ?>
</div>
