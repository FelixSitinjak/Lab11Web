<?php
$db = new Database();
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$data_lama = $db->get('users', "id=" . $id);

$form = new Form("", "Update Data");

if ($_POST) {
    $hobi = '';
    if (isset($_POST['hobi'])) {
        if (is_array($_POST['hobi'])) {
            $hobi = implode(',', $_POST['hobi']);
        } else {
            $hobi = $_POST['hobi'];
        }
    }

    $data_update = [
        'nama' => $_POST['nama'],
        'email' => $_POST['email'],
        'pass' => $_POST['pass'],
        'jenis_kelamin' => $_POST['jenis_kelamin'],
        'agama' => $_POST['agama'],
        'hobi' => $hobi,
        'alamat' => $_POST['alamat'],
    ];
    $update = $db->update('users', $data_update, "id=" . $id);
    if ($update) {
        header('Location: /lab11_php_oop/index.php/artikel/index');
        exit;
    } else {
        echo "<div style='color:red'>Gagal mengupdate data.</div>";
    }
}
?>
<h3>Form Ubah User</h3>
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
