<?php

// Connexió amb la BBDD:

$host = "localhost";
$database = "contacts";
$user = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    
} catch(PDOExeption $e) {
    die("PDO Connection error: " . $e->getMessage());
}




// show contacts
//var_dump($contacts);

// foreach($contacts as $contact) {
//     print($contact["first_name"]);
//     print($contact["phone_number"]);
// }

