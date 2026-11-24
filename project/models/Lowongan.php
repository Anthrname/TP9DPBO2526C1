<?php
class Lowongan {
    private ?int $id;
    private string $namaLowongan;
    private string $departemen;
    private string $tipePekerjaan;
    private int $kuota;
    private string $status;

    public function __construct(
        ?int $id,
        string $namaLowongan,
        string $departemen,
        string $tipePekerjaan,
        int $kuota,
        string $status
    ) {
        $this->id = $id;
        $this->namaLowongan = $namaLowongan;
        $this->departemen = $departemen;
        $this->tipePekerjaan = $tipePekerjaan;
        $this->kuota = $kuota;
        $this->status = $status;
    }

    public function getId(): ?int { return $this->id; }
    public function getNamaLowongan(): string { return $this->namaLowongan; }
    public function getDepartemen(): string { return $this->departemen; }
    public function getTipePekerjaan(): string { return $this->tipePekerjaan; }
    public function getKuota(): int { return $this->kuota; }
    public function getStatus(): string { return $this->status; }

    public function setNamaLowongan(string $namaLowongan): void { $this->namaLowongan = $namaLowongan; }
    public function setDepartemen(string $departemen): void { $this->departemen = $departemen; }
    public function setTipePekerjaan(string $tipePekerjaan): void { $this->tipePekerjaan = $tipePekerjaan; }
    public function setKuota(int $kuota): void { $this->kuota = $kuota; }
    public function setStatus(string $status): void { $this->status = $status; }
}
?>
