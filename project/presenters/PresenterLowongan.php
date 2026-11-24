<?php
require_once __DIR__ . '/KontrakPresenterLowongan.php';
require_once __DIR__ . '/../models/KontrakModelLowongan.php';
require_once __DIR__ . '/../views/KontrakViewLowongan.php';

class PresenterLowongan implements KontrakPresenterLowongan {
    private KontrakModelLowongan $model;
    private KontrakViewLowongan $view;

    public function __construct(KontrakModelLowongan $model, KontrakViewLowongan $view) {
        $this->model = $model;
        $this->view = $view;
    }

    /**
     * Helper untuk merakit 1 baris HTML tabel lowongan.
     * Panggil dari dalam tampilkanLowongan() saat melakukan foreach.
     */
    private function buildRowHtml(int $no, Lowongan $lowongan): string {
        $id = (int)$lowongan->getId();
        $namaLowongan = htmlspecialchars($lowongan->getNamaLowongan());
        $departemen = htmlspecialchars($lowongan->getDepartemen());
        $tipePekerjaan = htmlspecialchars($lowongan->getTipePekerjaan());
        $kuota = number_format($lowongan->getKuota()) . ' Orang';
        $statusRaw = $lowongan->getStatus();
        $statusText = htmlspecialchars($statusRaw);

        $badgeClass = ($statusRaw === 'Dibuka') ? 'badge-success' : 'badge-danger';
        $statusBadge = "<span class='badge {$badgeClass}'>{$statusText}</span>";

        return "<tr>
            <td class='col-id'>{$no}</td>
            <td><strong>{$namaLowongan}</strong></td>
            <td>{$departemen}</td>
            <td>{$tipePekerjaan}</td>
            <td>{$kuota}</td>
            <td>{$statusBadge}</td>
            <td class='col-actions'>
                <a href='lowongan.php?screen=edit&id={$id}' class='btn btn-edit'>Edit</a>
                <form method='post' action='lowongan.php' style='display:inline;' onsubmit=\"return confirm('Hapus lowongan ini?')\">
                    <input type='hidden' name='action' value='hapus'>
                    <input type='hidden' name='id' value='{$id}'>
                    <button type='submit' class='btn btn-delete'>Hapus</button>
                </form>
            </td>
        </tr>";
    }

    public function tampilkanLowongan(): string {
        $listLowongan = $this->model->getAllLowongan();
        $totalLowongan = count($listLowongan);
        $rowsHtml = '';
        if (empty($listLowongan)) {
            $rowsHtml = '<tr><td colspan="7" style="text-align:center;color:#6b7280;padding:24px;">Belum ada data lowongan pekerjaan.</td></tr>';
        } else {
            $no = 1;
            foreach ($listLowongan as $lowongan) {
                $rowsHtml .= $this->buildRowHtml($no, $lowongan);
                $no++;
            }
        }
        return $this->view->renderDaftar($rowsHtml, $totalLowongan);
    }

    public function tampilkanFormLowongan(?int $id = null): string {
        if ($id !== null) {
            $lowongan = $this->model->getLowonganById($id);
            if ($lowongan === null) {
                header("Location: lowongan.php");
                exit();
            }
            $formData = [
                'id'            => $lowongan->getId(),
                'namaLowongan'  => $lowongan->getNamaLowongan(),
                'departemen'    => $lowongan->getDepartemen(),
                'tipePekerjaan' => $lowongan->getTipePekerjaan(),
                'kuota'         => $lowongan->getKuota(),
                'status'        => $lowongan->getStatus(),
            ];
            return $this->view->renderForm("Ubah Data Lowongan", "ubah", $formData);
        }
        return $this->view->renderForm("Tambah Lowongan Baru", "tambah", []);
    }

    public function tambahLowongan(string $namaLowongan, string $departemen, string $tipePekerjaan, int $kuota, string $status): void {
        $this->model->addLowongan($namaLowongan, $departemen, $tipePekerjaan, $kuota, $status);
        header("Location: lowongan.php");
        exit();
    }

    public function ubahLowongan(int $id, string $namaLowongan, string $departemen, string $tipePekerjaan, int $kuota, string $status): void {
        $this->model->updateLowongan($id, $namaLowongan, $departemen, $tipePekerjaan, $kuota, $status);
        header("Location: lowongan.php");
        exit();
    }

    public function hapusLowongan(int $id): void {
        $this->model->deleteLowongan($id);
        header("Location: lowongan.php");
        exit();
    }
}
?>
