<?php
require_once __DIR__ . '/models/TabelLowongan.php';
require_once __DIR__ . '/views/ViewLowongan.php';
require_once __DIR__ . '/presenters/PresenterLowongan.php';

$model = new TabelLowongan('localhost', 'mvp_kandidat_db', 'root', '');
$view = new ViewLowongan();
$presenter = new PresenterLowongan($model, $view);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'tambah') {
        $namaLowongan  = $_POST['namaLowongan'] ?? '';
        $departemen    = $_POST['departemen'] ?? '';
        $tipePekerjaan = $_POST['tipePekerjaan'] ?? 'Full-time';
        $kuota         = (int)($_POST['kuota'] ?? 1);
        $status        = $_POST['status'] ?? 'Dibuka';
        $presenter->tambahLowongan($namaLowongan, $departemen, $tipePekerjaan, $kuota, $status);
    } elseif ($action === 'ubah') {
        $id            = (int)($_POST['id'] ?? 0);
        $namaLowongan  = $_POST['namaLowongan'] ?? '';
        $departemen    = $_POST['departemen'] ?? '';
        $tipePekerjaan = $_POST['tipePekerjaan'] ?? 'Full-time';
        $kuota         = (int)($_POST['kuota'] ?? 1);
        $status        = $_POST['status'] ?? 'Dibuka';
        $presenter->ubahLowongan($id, $namaLowongan, $departemen, $tipePekerjaan, $kuota, $status);
    } elseif ($action === 'hapus') {
        $id = (int)($_POST['id'] ?? 0);
        $presenter->hapusLowongan($id);
    } else {
        header("Location: lowongan.php");
        exit();
    }
} else {
    $screen = $_GET['screen'] ?? 'list';
    if ($screen === 'add') {
        echo $presenter->tampilkanFormLowongan();
    } elseif ($screen === 'edit' && isset($_GET['id'])) {
        echo $presenter->tampilkanFormLowongan((int)$_GET['id']);
    } else {
        echo $presenter->tampilkanLowongan();
    }
}
?>
