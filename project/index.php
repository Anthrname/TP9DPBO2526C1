<?php
require_once __DIR__ . '/models/TabelKandidat.php';
require_once __DIR__ . '/views/ViewKandidat.php';
require_once __DIR__ . '/presenters/PresenterKandidat.php';

$model = new TabelKandidat('localhost', 'mvp_kandidat_db', 'root', '');
$view = new ViewKandidat();
$presenter = new PresenterKandidat($model, $view);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'tambah') {
        $nama = $_POST['nama'] ?? '';
        $posisi = $_POST['posisi'] ?? '';
        $domisili = $_POST['domisili'] ?? '';
        $skorTes = (int)($_POST['skorTes'] ?? 0);
        $pengalamanTahun = (int)($_POST['pengalamanTahun'] ?? 0);
        $presenter->tambahKandidat($nama, $posisi, $domisili, $skorTes, $pengalamanTahun);
    } elseif ($action === 'ubah') {
        $id = (int)($_POST['id'] ?? 0);
        $nama = $_POST['nama'] ?? '';
        $posisi = $_POST['posisi'] ?? '';
        $domisili = $_POST['domisili'] ?? '';
        $skorTes = (int)($_POST['skorTes'] ?? 0);
        $pengalamanTahun = (int)($_POST['pengalamanTahun'] ?? 0);
        $presenter->ubahKandidat($id, $nama, $posisi, $domisili, $skorTes, $pengalamanTahun);
    } elseif ($action === 'hapus') {
        $id = (int)($_POST['id'] ?? 0);
        $presenter->hapusKandidat($id);
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    $screen = $_GET['screen'] ?? 'list';
    if ($screen === 'add') {
        echo $presenter->tampilkanFormKandidat();
    } elseif ($screen === 'edit' && isset($_GET['id'])) {
        echo $presenter->tampilkanFormKandidat((int)$_GET['id']);
    } else {
        echo $presenter->tampilkanKandidat();
    }
}
?>
