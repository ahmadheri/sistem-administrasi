<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllUser()
    {
        $this->db->query('SELECT id, username, email, role FROM users');
        // $result = $this->db->resultSet();
        $result = $this->db->resultSet();

        return $result;
    }

    public function paginate($number1, $number2)
    {
        $this->db->query('SELECT id, username, email, role FROM users LIMIT :number1, :number2');
        $this->db->bind(':number1', $number1);
        $this->db->bind(':number2', $number2);
        $result = $this->db->resultSet();

        return $result;
    }

    public function createUser($data)
    {
        $this->db->query('INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)');
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':role', $data['role']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function show($id)
    {
        $this->db->query('SELECT username, email, role FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        $result = $this->db->single();

        return $result;
    }

    public function edit($id)
    {
        $this->db->query('SELECT id, username, email, role FROM users WHERE id = :id');
        $this->db->bind(':id', $id);

        $result = $this->db->single();

        return $result;
    }

    public function updateUser($data)
    {
        $this->db->query('UPDATE users SET username = :username, email = :email, role = :role WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':role', $data['role']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteUser($id)
    {
        $this->db->query('DELETE FROM users WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)');

        // Bind values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':role', $data['role']);

        // Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email OR username = :username');
        $this->db->bind(':email', $email);
        $this->db->bind(':username', $email);

        $row = $this->db->single();

        // check the email, if true will select the password column if false return false
        if ($row) {
            $hashedPassword = $row->password;
        } else {
            return false;
        }

        // get the email and check the password
        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    // Find user by email. Email is passed in by the controller
    public function findUserByEmail($email)
    {
        // Prepared statement
        $this->db->query('SELECT * FROM users WHERE email = :email');

        // Email param will be binded with the email variable
        $this->db->bind(':email', $email);

        // Check if email is already registered
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function findUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);

        $rowResult = $this->db->single();

        return $rowResult;
    }

    // Count how many user registered
    public function countUser()
    {
        $this->db->query('SELECT COUNT(id) as count_users FROM users');
        $result = $this->db->fetchColumn();

        return $result;
    }

    // Get the number of registered users
    // Mengambil jumlah user yang terdaftar
    public function findUserByUsername($keyword)
    {
        $this->db->query('SELECT username, email, role FROM users WHERE username LIKE :keyword ');
        $this->db->bind(':keyword' , '%' . $keyword . '%');

        $result = $this->db->rowCount();

        return $result;
    
    }

    // Get the result of search
    public function getUserByUsername($keyword)
    {
        $this->db->query('SELECT username, email, role FROM users WHERE username LIKE :keyword');
        $this->db->bind(':keyword', '%' . $keyword . '%' );

        $result = $this->db->resultSet();

        return $result;
    }

}
