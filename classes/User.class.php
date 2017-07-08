<?php

include_once("includes/db.inc.php");

class User
{
    private $m_sFirstname;
    private $m_sLastname;
    private $m_sEmail;
    private $m_sPassword;

    public function getFirstname()
    {
        return $this->m_sFirstname;
    }

    public function setFirstname($m_sFirstname)
    {
        $this->m_sFirstname = $m_sFirstname;
    }

    public function getLastname()
    {
        return $this->m_sLastname;
    }

    public function setLastname($m_sLastname)
    {
        $this->m_sLastname = $m_sLastname;
    }

    public function getEmail()
    {
        return $this->m_sEmail;
    }

    public function setEmail($m_sEmail)
    {
        $this->m_sEmail = $m_sEmail;
    }

    public function getPassword()
    {
        return $this->m_sPassword;
    }

    public function setPassword($m_sPassword)
    {
        $this->m_sPassword = $m_sPassword;
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
