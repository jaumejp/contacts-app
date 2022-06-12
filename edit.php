<?php
    require "database.php";


    $id = $_GET["id"];

    // Si posem linit 1, en comptes de donar un array de contactes [["name" -> "Jaume]]
    // Ja ens donara el contacte ["name" -> "Jaume"]
    $statement = $conn->prepare("SELECT * FROM contacts WHERE id = :id LIMIT 1");
    $statement->execute([":id" => $id]);

    if ($statement->rowCount() == 0) {
        http_response_code(404);
        echo("HTTP 404 NOT FOUND");
        return;
    }

    $contact = $statement->fetch(PDO::FETCH_ASSOC);


    $error = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Mirem que les dades estiguin bé: 
        if (empty($_POST["name"]) || empty($_POST["number"])) {
            $error = "Please fill all the fields";
        } else {
            // get introduce data
            $name = $_POST["name"];
            $phoneNumber = $_POST["number"];
        
            // put data to bbdd, fer-ho directament així, té problemes de seguretat, per això ho posem dintre del if.
            $statement = $conn->prepare("UPDATE contacts SET name = :name, phone_number = :phone_number WHERE id = :id");
            $statement->execute([
                ":id" => $id,
                ":name" => $_POST["name"],
                ":phone_number" => $_POST["number"],
            ]);
        
            header("Location: index.php");
        }
      }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .danger {
            color: red;
        }
    </style>
</head>
<body>

    <?php if ($error): ?>
        <p class="danger">
            <?= $error ?>
        </p>
    <?php endif ?>


    <!-- method -> GET: demanar dades del servidor, POST: enviar contingut -->
    <!-- action -> quin arxiu del servidor m'aten quan arribo, qui m'interpreta   -->
    <form action="edit.php?id=<?= $contact["id"] ?>" method="POST">
        name: <input value="<?= $contact["name"] ?>" type="text" name="name">
        <br><br>
        phone: <input value="<?= $contact["phone_number"] ?>" type="text" name="number">
        <br><br>
        <input type="submit" value="submit">
    </form>

    <button><a href="./index.php">Contacts List</a></button>


</body>
</html>