<?php
require_once __DIR__ . '/Lowongan.php';

interface KontrakModelLowongan {
    /**
     * Mengambil seluruh data lowongan sebagai array objek Lowongan.
     * @return Lowongan[]
     */
    public function getAllLowongan(): array;

    /**
     * Mengambil satu data lowongan berdasarkan ID.
     */
    public function getLowonganById(int $id): ?Lowongan;

    public function addLowongan(string $namaLowongan, string $departemen, string $tipePekerjaan, int $kuota, string $status): void;
    public function updateLowongan(int $id, string $namaLowongan, string $departemen, string $tipePekerjaan, int $kuota, string $status): void;
    public function deleteLowongan(int $id): void;
}
?>
