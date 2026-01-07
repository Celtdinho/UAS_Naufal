<?php
class UserModel extends Model {
    
    public function login($username, $password) {
        $this->db->query('SELECT * FROM users WHERE username = :username OR email = :username');
        $this->db->bind(':username', $username);
        
        $user = $this->db->single();
        
        if ($user) {
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    }
    
    public function register($data) {
        // Check if username or email already exists
        $this->db->query('SELECT id FROM users WHERE username = :username OR email = :email');
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        
        if ($this->db->single()) {
            return false; // User already exists
        }
        
        $this->db->query('INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)');
        
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind(':role', 'user');
        
        return $this->db->execute();
    }
    
    public function getUserById($id) {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function getAllUsers() {
        $this->db->query('SELECT id, username, email, role, created_at FROM users ORDER BY created_at DESC');
        return $this->db->resultSet();
    }
    
    public function countAll() {
        $this->db->query('SELECT COUNT(*) as total FROM users');
        $result = $this->db->single();
        return $result['total'];
    }
}
?>