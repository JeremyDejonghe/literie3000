<?php
$find = false;
$data = array("nom" => "Matelas introuvable");
if (isset($_GET["id"])) {
    $dsn = "mysql:host=localhost;dbname=literie3000";
    $db = new PDO($dsn, "root", "");

    $query = $db->prepare("SELECT * FROM matelas WHERE id = :id");
    $query->bindParam(":id", $_GET["id"], PDO::PARAM_INT);
    $query->execute();
    $matela = $query->fetch();

    if ($matela) {
        $find = true;

        $data = $matela;
    }
}

include("./tpl/header.php");
?>

<h1><?= $data["nom"] ?></h1>

<a href="http://localhost/literie3000/update_matelas.php?id=<?= $data["id"] ?>">
    <div class="btn">Modifier un Matelas</div>
</a>

<?php
if ($find) {
?>
    <div class="lit">
        <img src="<?= $data["image"] ?>" alt="">
        <h4><?= $data["marque"] ?></h4>
        <h5><?= $data["nom"] ?></h5>
        <h3><?= $data["prix"] ?></h3>
        <h2><?= $data["promo"] ?></h2>
        <form action="delete.php" method="post">
            <input type="hidden" name="id" value="<?= $data["id"] ?>">
            <input class="delete" type="submit" value="X">
        </form>
    </div>
<?php
}
include("./tpl/footer.php");
?>