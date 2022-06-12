<?php

$contacts = ["Pepe", "Antonio", "Nate"];

foreach($contacts as $contact) {
    print("<div>$contact</div>" . PHP_EOL);
};
?>

<!-- com que hem tencat l'etiqueta, es interpretat com html -->

<?php $contacts = ["Pepe", "Antonio", "Nate"]; ?>

<?php foreach($contacts as $contact) { ?>
    <div><?= $contact ?></div>
<?php }; ?>

<!-- PHP amb if:-->

<?php foreach($contacts as $contact) { ?>
    <?php if ($contact != "Pepe") { ?>
        <div><?= $contact ?></div>
    <?php } ?>
    
<?php }; ?>
