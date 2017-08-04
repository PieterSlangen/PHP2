<?php

include_once("includes/db.inc.php");

class User
{
    private $Firstname;
    private $Lastname;
    private $Email;
    private $Password;

    public function getFirstname()
    {
        return $this->Firstname;
    }

    public function setFirstname($Firstname)
    {
        $this->Firstname = $Firstname;
    }

    public function getLastname()
    {
        return $this->Lastname;
    }

    public function setLastname($Lastname)
    {
        $this->Lastname = $Lastname;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    public function getPassword()
    {
        return $this->Password;
    }

    public function setPassword($Password)
    {
        $this->Password = $Password;
    }

    public function Register()
    {
        global $conn;

        $statement = $conn->prepare("INSERT INTO User(firstname, lastname, email, password) 
                                       VALUES (:firstname, :lastname, :email, :password)");
        $statement->bindValue(":firstname", $this->getFirstname());
        $statement->bindValue(":lastname", $this->getLastname());
        $statement->bindValue(":email", $this->getEmail());
        $statement->bindValue(":password", $this->getPassword());

        $options = [
            'cost'=> 12
        ];
        $password = password_hash($this->getPassword(), PASSWORD_DEFAULT, $options);
        $statement->bindValue(":password", $password);
        $statement->execute();
    }

    public function Login()
    {
        global $conn;

        $p_password = $this->getPassword();

        $statement = $conn->prepare("SELECT * FROM User where email = :email LIMIT 1");
        $statement->execute(array( ":email"=>$this->getEmail() ));

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
}
