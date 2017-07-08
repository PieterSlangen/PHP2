<?php

try {
    $conn = new PDO("mysql:host=localhost;dbname=PHP2", "root", "");
} catch (PDOException $e) {
    echo "Connection failed " . $e->getMessage();
}
