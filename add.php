<?php
    // Definim quan ens estan demanant mostrar el formulari (mostrar la pàgina)
    // o quan ens ens estan enviant dades (Quan fem post (perque ens aten aquest document))

    // Conte informació sobre la petició, si ho posem entre <pre> ruta, host, REQUEST_METHOD (GET, POST)
    //var_dump($_SERVER);

    // importar la variable $conn
    require "database.php";

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
            $statement = $conn->prepare("INSERT INTO contacts (name, phone_number) VALUES (:name, :phone_number)");
            $statement->bindParam(":name", $_POST["name"]);
            $statement->bindParam(":phone_number", $_POST["number"]);
            $statement->execute();
        
            header("Location: index.php");
        }
      }
?>

<?php require "partials/header.php" ?>

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
    <form action="add.php" method="POST">
        name: <input type="text" name="name">
        <br><br>
        phone: <input type="text" name="number">
        <br><br>
        <input type="submit" value="submit">
    </form>

    <button><a href="./index.php">Contacts List</a></button>

    <?php require "partials/footer.php" ?>

</body>
</html>