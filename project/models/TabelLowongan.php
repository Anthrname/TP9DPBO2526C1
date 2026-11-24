<?php
require_once __DIR__ . '/DB.php';
require_once __DIR__ . '/KontrakModelLowongan.php';
require_once __DIR__ . '/Lowongan.php';

class TabelLowongan extends DB implements KontrakModelLowongan {

    public function __construct(
        string $host = "localhost",
        string $db_name = "mvp_kandidat_db",
        string $username = "root",
        string $password = ""
    ) {
        parent::__construct($host, $db_name, $username, $password);
    }

    private function mapRowToLowongan(array $row): Lowongan {
        return new Lowongan(
            (int)$row['id'],
            $row['namaLowongan'],
            $row['departemen'],
            $row['tipePekerjaan'],
            (int)$row['kuota'],
            $row['status']
        );
    }

    public function getAllLowongan(): array {
        $query = "SELECT * FROM lowongan ORDER BY status ASC, id ASC";
        $this->executeQuery($query);
        $rows = $this->getAllResult();
        $list = [];
        foreach ($rows as $row) {
            $list[] = $this->mapRowToLowongan($row);
        }
        return $list;
    }

    public function getLowonganById(int $id): ?Lowongan {
        $query = "SELECT * FROM lowongan WHERE id = :id LIMIT 1";
        $this->executeQuery($query, [':id' => $id]);
        $rows = $this->getAllResult();
        if (empty($rows)) {
            return null;
        }
        return $this->mapRowToLowongan($rows[0]);
    }

    public function addLowongan(string $namaLowongan, string $departemen, string $tipePekerjaan, int $kuota, string $status): void {
        $query = "INSERT INTO lowongan (namaLowongan, departemen, tipePekerjaan, kuota, status) 
                  VALUES (:namaLowongan, :departemen, :tipePekerjaan, :kuota, :status)";
        $this->executeQuery($query, [
            ':namaLowongan' => $namaLowongan,
            ':departemen'   => $departemen,
            ':tipePekerjaan'=> $tipePekerjaan,
            ':kuota'        => $kuota,
            ':status'       => $status
        ]);
    }

    public function updateLowongan(int $id, string $namaLowongan, string $departemen, string $tipePekerjaan, int $kuota, string $status): void {
        $query = "UPDATE lowongan 
                  SET namaLowongan = :namaLowongan, 
                      departemen = :departemen, 
                      tipePekerjaan = :tipePekerjaan, 
                      kuota = :kuota, 
                      status = :status 
                  WHERE id = :id";
        $this->executeQuery($query, [
            ':id'           => $id,
            ':namaLowongan' => $namaLowongan,
            ':departemen'   => $departemen,
            ':tipePekerjaan'=> $tipePekerjaan,
            ':kuota'        => $kuota,
            ':status'       => $status
        ]);
    }

    public function deleteLowongan(int $id): void {
        $query = "DELETE FROM lowongan WHERE id = :id";
        $this->executeQuery($query, [':id' => $id]);
    }
}
?>
