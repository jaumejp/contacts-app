<?php 
    // Hard code data:
    // $contacts = [
    //     ["name" => "Jaume", "phone_number" => "222"],
    //     ["name" => "Juan", "phone_number" => "333"],
    //     ["name" => "Perez", "phone_number" => "444"],
    //     ["name" => "Dani", "phone_number" => "555"],
    // ];

    require "database.php";

    $contacts = $conn->query("SELECT * FROM contacts");
    // Això retorna un format raro, serà com un array
    //var_dump($contacts);
    //die();

    // Accedir als camps com un diccionari:


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 3em;
        }
        .contacts {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 1em;
        }
        .contact {
            background-color: lightslategray;
            width: fit-content;
            margin-top: 50px;
            padding: 15px;
            text-align: center;
            color: white;
            line-height: 40px;
        }
    </style>

</head>
<body>
    <div class="contacts">
        
        <!-- Fem un bucle amb php amb la llista -->
        <?php foreach($contacts as $contact) : ?>
            <div class="contact">
                <h2> <?= $contact["name"]; ?> </h2>
                <p> <?= $contact["phone_number"]; ?> </p>
                <div>
                    <button><a href="edit.php?id=<?= $contact["id"] ?>">Edit</a></button>
                    <button><a href="delete.php?id=<?= $contact["id"] ?>">Delete</a></button>
                </div>
            </div> 
        <?php endforeach ?>

    </div>

    <button><a href="./add.php">Add Contact</a></button>

</body>
</html>