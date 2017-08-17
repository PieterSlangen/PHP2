<?php

include_once("includes/db.inc.php");

class User
{
    private $Firstname;
    private $Lastname;
    private $Email;
    private $Password;
    private $Admin;

    public function getFirstname()
    {
        return $this->Firstname;
    }

    public function setFirstname($Firstname)
    {
        if ($Firstname==""){
            throw new Exception('Firstname can not be empty');
        }
        $this->Firstname = $Firstname;
    }

    public function getLastname()
    {
        return $this->Lastname;
    }

    public function setLastname($Lastname)
    {
        if ($Lastname==""){
            throw new Exception('Lastname can not be empty');
        }
        $this->Lastname = $Lastname;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function setEmail($Email)
    {
        if ($Email==""){
            throw new Exception('Email can not be empty');
        }
        $this->Email = $Email;
    }

    public function getPassword()
    {
        return $this->Password;
    }

    public function setPassword($Password)
    {
        if ($Password==""){
            throw new Exception('Password can not be empty');
        }
        $this->Password = $Password;
    }

    public function getAdmin()
    {
        return $this->Admin;
    }

    public function setAdmin($Admin)
    {
        if ($Admin==""){
            throw new Exception('Admin can not be empty');
        }
        $this->Admin = $Admin;
    }

    public function register()
    {
        global $conn;

        $statement = $conn->prepare("INSERT INTO User(firstname, lastname, email, password, admin) 
                                       VALUES (:firstname, :lastname, :email, :password, :admin)");
        $statement->bindValue(":firstname", $this->getFirstname());
        $statement->bindValue(":lastname", $this->getLastname());
        $statement->bindValue(":email", $this->getEmail());
        $statement->bindValue(":password", $this->getPassword());
        $statement->bindValue(":admin", $this->getAdmin());

        $options = [
            'cost'=> 12
        ];
        $password = password_hash($this->getPassword(), PASSWORD_DEFAULT, $options);
        $statement->bindValue(":password", $password);
        $statement->execute();
    }

    public function delete()
    {
        global $conn;

        $statement = $conn->prepare("DELETE FROM User where email = :email");
        $statement->bindValue(":email", $this->getEmail());
        $statement->execute();
    }

    public function login()
    {
        global $conn;

        $p_password = $this->getPassword();

        $statement = $conn->prepare("SELECT * FROM User where email = :email LIMIT 1");
        $statement->execute(array( ":email"=>$this->getEmail()));

        if ($statement->rowCount() == 1) {
            $currentUser = $statement->fetch(PDO::FETCH_ASSOC);
            $hash = $currentUser['password'];
            $_SESSION['email'] = $currentUser['email'];
            $_SESSION['id'] = $currentUser['id'];


            if (password_verify($p_password, $hash)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function checkAdmin()
    {
        global $conn;

        $statement = $conn->prepare("SELECT admin FROM User where name = :name");
        $statement->bindValue(":name", $this->getAdmin());
        $statement->execute();

        if(mysqli_num_rows($statement) == 0) {
            return 0;
        } else {
            return 1;
        }


    }
}
