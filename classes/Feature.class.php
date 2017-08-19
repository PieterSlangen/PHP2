<?php
include_once("includes/db.inc.php");

class Feature
{
    private $name;
    private $deadline;
    private $subject;
    private $list;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        if ($name=="") {
            throw new Exception('Name can not be empty');
        }
        $this->name = $name;
    }

    public function getDeadline()
    {
        return $this->deadline;
    }

    public function setDeadline($deadline)
    {
        if ($deadline=="") {
            throw new Exception('Deadline can not be empty');
        }
        $this->deadline = $deadline;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        if ($subject=="") {
            throw new Exception('Subject can not be empty');
        }
        $this->subject = $subject;
    }

    public function getList()
    {
        return $this->list;
    }

    public function setList($list)
    {
        if ($list=="") {
            throw new Exception('List can not be empty');
        }
        $this->list = $list;
    }

    public function addList()
    {
        global $conn;
        $statement = $conn->prepare("INSERT INTO List(name) VALUES (:name)");
        $statement->bindValue(":name", $this->getName());
        $statement->execute();
    }

    public function deleteList()
    {
        global $conn;
        $statement = $conn->prepare("DELETE FROM List where name = :name");
        $statement->bindValue(":name", $this->getName());
        $statement->execute();
    }

    public function getLists()
    {
        global $conn;
        $statement = $conn->prepare("select * from List");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function addSubject()
    {
        global $conn;
        $statement = $conn->prepare("INSERT INTO subject(name) VALUES (:name)");
        $statement->bindValue(":name", $this->getName());
        $statement->execute();
    }

    public function deleteSubject()
    {
        global $conn;
        $statement = $conn->prepare("DELETE FROM subject where name = :name");
        $statement->bindValue(":name", $this->getName());
        $statement->execute();
    }

    public function getSubjects()
    {
        global $conn;
        $statement = $conn->prepare("select * from subject");
        $statement->execute();
        return $statement->fetchAll();
    }


    public function addTask()
    {
        global $conn;
        $statement = $conn->prepare("INSERT INTO Task(name, deadline, listID, subjectID) VALUES (:name, :deadline, :list, :subject)");
        $statement->bindValue(":name", $this->getName());
        $statement->bindValue(":deadline", $this->getDeadline());
        $statement->bindValue(":list", $this->getList());
        $statement->bindValue(":subject", $this->getSubject());
        $statement->execute();
    }

    public function getListId()
    {
        global $conn;
        $statement = $conn->prepare("SELECT s.name as subjectname, t.name as taskname, t.deadline as deadline FROM subject s INNER JOIN Task t on t.subjectID = s.id  inner join list l on l.id = t.listID WHERE l.id = :id");
        $statement->bindValue(":id", $this->getList());
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getSubjectId()
    {
        global $conn;
        $statement = $conn->prepare("SELECT l.name as listname, t.name as taskname, t.deadline as deadline FROM list l INNER JOIN Task t on t.listID = l.id  inner join subject s on s.id = t.subjectID WHERE s.id = :id");
        $statement->bindValue(":id", $this->getSubject());
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getTasks()
    {
        global $conn;
        $statement = $conn->prepare("select * from Task ORDER BY deadline ASC");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function checkDeadline($date)
    {
        $currentDate = strtotime(date("Y-m-d H:i:s"));
        $savedDate = strtotime($date);
        $diff = $savedDate-$currentDate;
        if ($diff>0 and $diff<604800) {
            $r = floor($diff/86400);
            if ($r==1) {
                $r = $r." dag resterend.";
            } else {
                $r = $r." dagen resterend.";
            }
        } elseif ($diff>604800 and $diff<31449600) {
            $r = floor($diff/604800);
            if ($r==1) {
                $r = $r." week resterend.";
            } else {
                $r = $r." weken resterend.";
            }
        } elseif ($diff>31449600) {
            $r = floor($diff/31449600)." jaar resterend.";
        } else {
            $r = "Deadline voorbij.";
        }
        return $r;
    }

    public function updateSubject()
    {
        global $conn;
        $statement =$conn->prepare("UPDATE subject SET name = :name WHERE id = :id");
        $statement->bindValue(":name", $this->getName());
        $statement->bindValue(":id", $this->getSubject());
        $statement->execute();
    }
}
