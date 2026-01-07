<?php
class MobilModel extends Model {
    
    public function getAllMobil($limit = null, $offset = null, $search = null) {
        $sql = "SELECT * FROM mobil WHERE 1=1";
        
        if (!empty($search)) {
            $sql .= " AND (merk LIKE :search OR model LIKE :search OR plat_nomor LIKE :search OR deskripsi LIKE :search)";
        }
        
        $sql .= " ORDER BY created_at DESC";
        
        if ($limit !== null) {
            $sql .= " LIMIT :limit OFFSET :offset";
        }
        
        $this->db->query($sql);
        
        if (!empty($search)) {
            $this->db->bind(':search', '%' . $search . '%');
        }
        
        if ($limit !== null) {
            $this->db->bind(':limit', $limit, PDO::PARAM_INT);
            $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        }
        
        return $this->db->resultSet();
    }
    
    public function getMobilById($id) {
        $this->db->query('SELECT * FROM mobil WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function create($data) {
        $this->db->query('INSERT INTO mobil (merk, model, tahun, warna, plat_nomor, harga_per_hari, transmisi, bahan_bakar, kapasitas, deskripsi, gambar, status) 
                         VALUES (:merk, :model, :tahun, :warna, :plat_nomor, :harga_per_hari, :transmisi, :bahan_bakar, :kapasitas, :deskripsi, :gambar, :status)');
        
        $this->db->bind(':merk', $data['merk']);
        $this->db->bind(':model', $data['model']);
        $this->db->bind(':tahun', $data['tahun']);
        $this->db->bind(':warna', $data['warna']);
        $this->db->bind(':plat_nomor', $data['plat_nomor']);
        $this->db->bind(':harga_per_hari', $data['harga_per_hari']);
        $this->db->bind(':transmisi', $data['transmisi']);
        $this->db->bind(':bahan_bakar', $data['bahan_bakar']);
        $this->db->bind(':kapasitas', $data['kapasitas']);
        $this->db->bind(':deskripsi', $data['deskripsi']);
        $this->db->bind(':gambar', $data['gambar']);
        $this->db->bind(':status', $data['status']);
        
        return $this->db->execute();
    }
    
    public function update($id, $data) {
        $sql = "UPDATE mobil SET ";
        $updates = [];
        
        foreach ($data as $key => $value) {
            $updates[] = "$key = :$key";
        }
        
        $sql .= implode(', ', $updates);
        $sql .= " WHERE id = :id";
        
        $this->db->query($sql);
        
        foreach ($data as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }
        
        $this->db->bind(':id', $id);
        
        return $this->db->execute();
    }
    
    public function delete($id) {
        $this->db->query('DELETE FROM mobil WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
    
    public function countAll($search = null) {
        $sql = "SELECT COUNT(*) as total FROM mobil WHERE 1=1";
        
        if (!empty($search)) {
            $sql .= " AND (merk LIKE :search OR model LIKE :search OR plat_nomor LIKE :search)";
        }
        
        $this->db->query($sql);
        
        if (!empty($search)) {
            $this->db->bind(':search', '%' . $search . '%');
        }
        
        $result = $this->db->single();
        return $result['total'];
    }
    
    public function getAvailableCars() {
        $this->db->query('SELECT * FROM mobil WHERE status = "tersedia" ORDER BY created_at DESC');
        return $this->db->resultSet();
    }
    
    public function updateStatus($id, $status) {
        $this->db->query('UPDATE mobil SET status = :status WHERE id = :id');
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
?>