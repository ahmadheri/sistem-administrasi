<?php 

class Resident 
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllResidents()
    {
        $this->db->query('SELECT * FROM residents');

        $result = $this->db->resultSet();

        return $result;
    }

    public function createResident($data)
    {
        $this->db->query('INSERT INTO residents (user_id, no_identitas, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat)
        VALUES (:user_id, :no_identitas, :nama, :tempat_lahir, :tanggal_lahir, :jenis_kelamin, :alamat)');

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':no_identitas', $data['no_identitas']);
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':tempat_lahir', $data['tempat_lahir']);
        $this->db->bind(':tanggal_lahir', $data['tanggal_lahir']);
        $this->db->bind(':jenis_kelamin', $data['jenis_kelamin']);
        $this->db->bind(':alamat', $data['alamat']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findResidentById($id)
    {
        $this->db->query('SELECT * FROM residents WHERE id = :id');
        $this->db->bind(':id', $id);
        $rowResult = $this->db->single();

        return $rowResult;
    }

    public function updateResident($data)
    {
        $this->db->query('UPDATE residents SET user_id = :user_id, no_identitas = :no_identitas, nama = :nama, 
        tempat_lahir = :tempat_lahir, tanggal_lahir = :tanggal_lahir, jenis_kelamin = :jenis_kelamin,
        alamat = :alamat WHERE id = :id');

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':no_identitas', $data['no_identitas']);
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':tempat_lahir', $data['tempat_lahir']);
        $this->db->bind(':tanggal_lahir', $data['tanggal_lahir']);
        $this->db->bind(':jenis_kelamin', $data['jenis_kelamin']);
        $this->db->bind(':alamat', $data['alamat']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function deleteResident($id)
    {
        $this->db->query('DELETE FROM residents WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Count how many resident registered
    public function countResident()
    {
        $this->db->query('SELECT COUNT(id) as count_residents FROM residents');
        
        $result = $this->db->fetchColumn();

        return $result;
    }

}

?>