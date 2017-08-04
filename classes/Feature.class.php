<?php
include_once("includes/db.inc.php");

class Feature
{
    private $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName($Name)
    {
        $this->name = $Name;
    }

    public function add(){
        global $conn;
        $statement = $conn->prepare("INSERT INTO List(name) VALUES (:name)");
        $statement->bindValue(":name", $this->getName());
        $statement->execute();
    }

    public function getList()
    {
        global $conn;
        $statement = $conn->prepare("select * from List");
        $statement->execute();
        return $statement->fetchAll();
    }
}
