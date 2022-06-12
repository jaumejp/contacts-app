<?php

require "database.php";

$id = $_GET["id"];

$statement = $conn->prepare("SELECT * FROM contacts WHERE id = :id");
$statement->execute([":id" => $id]);

// Això es per si demanen un id que no existeix, per consola
// Exemple comanda, desde terminal o desde navegador:
// curl http://contacts-app.test/delete.php?id=1000;
if ($statement->rowCount() == 0) {
  http_response_code(404);
  echo("HTTP 404 NOT FOUND");
  return;
}

$statement = $conn->prepare("DELETE FROM contacts WHERE id = :id");
$statement->execute([":id" => $id]);

header("Location: index.php");