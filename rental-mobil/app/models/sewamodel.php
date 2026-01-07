<?php
class SewaModel extends Model {
    
    public function getAllSewa($limit = null, $offset = null, $search = null, $user_id = null) {
        $sql = "SELECT s.*, m.merk, m.model, m.gambar, m.harga_per_hari, u.username 
                FROM sewa s 
                JOIN mobil m ON s.mobil_id = m.id 
                JOIN users u ON s.user_id = u.id 
                WHERE 1=1";
        
        if ($user_id !== null) {
            $sql .= " AND s.user_id = :user_id";
        }
        
        if (!empty($search)) {
            $sql .= " AND (m.merk LIKE :search OR m.model LIKE :search OR u.username LIKE :search OR s.status LIKE :search)";
        }
        
        $sql .= " ORDER BY s.created_at DESC";
        
        if ($limit !== null) {
            $sql .= " LIMIT :limit OFFSET :offset";
        }
        
        $this->db->query($sql);
        
        if ($user_id !== null) {
            $this->db->bind(':user_id', $user_id);
        }
        
        if (!empty($search)) {
            $this->db->bind(':search', '%' . $search . '%');
        }
        
        if ($limit !== null) {
            $this->db->bind(':limit', $limit, PDO::PARAM_INT);
            $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        }
        
        return $this->db->resultSet();
    }
    
    public function getSewaById($id) {
        $this->db->query('SELECT s.*, m.merk, m.model, m.gambar, m.harga_per_hari, u.username, u.email 
                         FROM sewa s 
                         JOIN mobil m ON s.mobil_id = m.id 
                         JOIN users u ON s.user_id = u.id 
                         WHERE s.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function create($data) {
        $this->db->query('INSERT INTO sewa (user_id, mobil_id, tanggal_sewa, tanggal_kembali, lama_sewa, total_harga, status, catatan) 
                         VALUES (:user_id, :mobil_id, :tanggal_sewa, :tanggal_kembali, :lama_sewa, :total_harga, :status, :catatan)');
        
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':mobil_id', $data['mobil_id']);
        $this->db->bind(':tanggal_sewa', $data['tanggal_sewa']);
        $this->db->bind(':tanggal_kembali', $data['tanggal_kembali']);
        $this->db->bind(':lama_sewa', $data['lama_sewa']);
        $this->db->bind(':total_harga', $data['total_harga']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':catatan', $data['catatan']);
        
        return $this->db->execute();
    }
    
    public function updateStatus($id, $status) {
        $this->db->query('UPDATE sewa SET status = :status WHERE id = :id');
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
    
    public function countAll($search = null, $user_id = null) {
        $sql = "SELECT COUNT(*) as total 
                FROM sewa s 
                JOIN mobil m ON s.mobil_id = m.id 
                JOIN users u ON s.user_id = u.id 
                WHERE 1=1";
        
        if ($user_id !== null) {
            $sql .= " AND s.user_id = :user_id";
        }
        
        if (!empty($search)) {
            $sql .= " AND (m.merk LIKE :search OR m.model LIKE :search OR s.status LIKE :search)";
        }
        
        $this->db->query($sql);
        
        if ($user_id !== null) {
            $this->db->bind(':user_id', $user_id);
        }
        
        if (!empty($search)) {
            $this->db->bind(':search', '%' . $search . '%');
        }
        
        $result = $this->db->single();
        return $result['total'];
    }
    
    public function getTotalRevenue() {
        $this->db->query('SELECT SUM(total_harga) as total FROM sewa WHERE status = "selesai"');
        $result = $this->db->single();
        return $result['total'] ? $result['total'] : 0;
    }
    
    public function getSewaByUserId($user_id) {
        $this->db->query('SELECT s.*, m.merk, m.model, m.gambar 
                         FROM sewa s 
                         JOIN mobil m ON s.mobil_id = m.id 
                         WHERE s.user_id = :user_id 
                         ORDER BY s.created_at DESC');
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }
}
?>