<?php
class User
{
    private $conn;
    private $table_name = "users";
    public $email;
    public $firstname;
    public $lastname;
    public $password;
    public $role;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function readAllUsers()
    {
        $query = "SELECT
                email, firstname, lastname, password, role
            FROM
                " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    function registerUser()
    {
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    email=:email, 
                    firstname=:firstname, 
                    lastname=:lastname, 
                    password=:password, 
                    role='User'";

        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":password", md5($this->password));

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function existUser() {
        $sel = "SELECT * FROM " . $this->table_name . " WHERE email = ?";
        $exec = $this->conn->prepare($sel);
        $this->email = htmlspecialchars(strip_tags($this->email));
        $exec->bindParam(1, $this->email);

        if($exec->execute()) {
            $num = $exec->rowCount();
            if ($num >= 1) {
                return true;
            }
        }
        return false;
    }

    function deleteUser() {
        $query = "DELETE FROM " . $this->table_name . " WHERE email = ?";

        $stmt = $this->conn->prepare($query);
        $this->email = htmlspecialchars(strip_tags($this->email));
        $stmt->bindParam(1, $this->email);
        
        if($stmt->execute()) {
            return true;
        }
     
        return false;
         
    }
}
