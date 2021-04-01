<?php
// Connection to the BDD
$dsn = "mysql:host=localhost;dbname=literie3000";
$db = new PDO($dsn, "root", "");

$query = $db->query("SELECT * FROM matelas");
$matelas = $query->fetchAll();

$query = $db->query("SELECT nom FROM dimensions");
$dimensions = $query->fetchAll();

include("tpl/header.php");
?>
<h1>Catalogue</h1>

<a href="http://localhost/literie3000/add_matelas.php">
    <div class="btn">Ajouter un Matelas</div>
</a>
<div class="container">
    <div class="matelas">
        <?php
        foreach ($matelas as $matela) {
        ?>
            <div class="matela">
                <img src="<?= $matela["image"] ?>" alt="">
                <h4><?= $matela["marque"] ?></h4>
                <a href="matelas.php?id=<?= $matela["id"] ?>"><h5><?= $matela["nom"] ?></h5></a>
                <select name="dimension" id="dimensions">
                    <?php foreach ($dimensions as $dimension) { ?>
                        <option value="<?php $dimension["nom"] ?>"><?= $dimension["nom"] ?></option>
                    <?php } ?>
                </select>
                <h3><?= $matela["prix"] ?></h3>
                <h2><?= $matela["promo"] ? $matela["promo"] : $matela["prix"] ?></h2>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<?php
include("tpl/footer.php");
?>