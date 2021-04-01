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

<?php
if ($find) {
?>
    <img src="<?= $data["image"] ?>" alt="">
    <h4><?= $data["marque"] ?></h4>
    <h5><?= $data["nom"] ?></h5>
    <h3><?= $data["prix"] ?></h3>
    <h2><?= $data["promo"] ?></h2>
    <form action="delete.php" method="post">
        <input type="hidden" name="id" value="<?= $data["id"] ?>">
        <input class="delete" type="submit" value="X">
    </form>
<?php
}
include("./tpl/footer.php");
?>