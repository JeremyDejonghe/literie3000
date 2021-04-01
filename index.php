<?php 
// Connection to the BDD
$dsn = "mysql:host=localhost;dbname=literie3000";
$db = new PDO($dsn, "root", "");

$query = $db->query("SELECT matelas.image, matelas.marque, matelas.nom, matelas.prix
FROM matelas");
$matelas = $query->fetchAll();

$query = $db->query("SELECT nom
FROM dimensions");
$dimensions = $query->fetchAll();

include("tpl/header.php");
?>
<h1>Catalogue</h1>
<div class="matelas">
    <?php 
    foreach ($matelas as $matela) {
    ?>
        <div class="matela">
            <img src="<?= $matela["image"] ?>" alt="">
            <h4><?= $matela["marque"] ?></h4>
            <h5><?= $matela["nom"] ?></h5>
            <select name="dimension" id="dimensions">
                <?php foreach ($dimensions as $dimension) { ?>
                <option value="<?php $dimension["nom"] ?>"><?= $dimension["nom"] ?></option>
                <?php } ?>
            </select>
            <h3><?= $matela["prix"] ?></h4>
        </div>
    <?php 
    }
    ?>
</div>