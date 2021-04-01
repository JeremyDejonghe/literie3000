<?php 
include("tpl/header.php");
$id = trim(strip_tags($_GET["id"]));
if (!empty($_POST)) {
    $nom = trim(strip_tags($_POST["nom"]));
    $marque = trim(strip_tags($_POST["marque"]));
    $image = trim(strip_tags($_POST["image"]));
    $prix = trim(strip_tags($_POST["prix"]));
    $promo = trim(strip_tags($_POST["promo"]));

    $errors = [];

    if (empty($nom)) {
        $errors["nom"] = "Le nom de la recette est obligatoire";
    }

    if (!filter_var($image, FILTER_VALIDATE_URL)) {
        $errors["image"] = "L'url de l'image est invalidé";
    }

    if (empty($errors)) {
        $dsn = "mysql:host=localhost;dbname=literie3000";
        $db = new PDO($dsn, "root", "");

        $query = $db->prepare("UPDATE matelas SET nom = :nom, image = :image, marque = :marque, prix = :prix, promo = :promo WHERE id = :id");
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->bindParam(":nom", $nom);
        $query->bindParam(":image", $image);
        $query->bindParam(":marque", $marque);
        $query->bindParam(":prix", $prix, PDO::PARAM_INT);
        $query->bindParam(":promo", $promo, PDO::PARAM_INT);
        if ($query->execute()) {
            header("Location: index.php");
        }
    }
}
?>
<h1>Modifier un matelas</h1>

<?= $id ?>

<form action="" method="post">
    <div class="form-group">
        <label for="inputName">Nom du matelas :</label>
        <input type="text" name="nom" id="inputName" value="<?= isset($nom) ? $nom : "" ?>">
        <?php
        if (isset($errors["nom"])) {
            echo "<span class=\"info-error\">{$errors["nom"]}</span>";
        }
        ?>
    </div>

    <div class="form-group">
        <label for="inputPicture">Photo du matelas :</label>
        <input type="text" name="image" id="inputPicture" placeholder="URL de l'image" value="<?= isset($image) ? $image : "" ?>">
        <?php
        if (isset($errors["image"])) {
            echo "<span class=\"info-error\">{$errors["image"]}</span>";
        }
        ?>
    </div>

    <div class="form-group">
        <label for="inputMarque">Marque :</label>
        <input type="text" name="marque" id="inputMarque" value="<?= isset($marque) ? $marque : "" ?>">
    </div>

    <div class="form-group">
        <label for="inputPrice">Prix :</label>
        <input type="number" name="prix" id="inputPrice" value="<?= isset($prix) ? $prix : "" ?>">
    </div>

    <div class="form-group">
        <label for="inputPromo">Promo :</label>
        <input type="number" name="promo" id="inputPromo" value="<?= isset($promo) ? $promo : "" ?>">
    </div>

    <input class="btn" type="submit" value="Modifier le matelas">
</form>


<?php 
include("tpl/footer.php");
?>