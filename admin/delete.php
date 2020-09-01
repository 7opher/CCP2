<?php

require 'session_start.php';

?>

<?php
require 'database.php';

if (!empty($_GET['id'])) {
    $id = checkInput($_GET['id']);
}

if (!empty($_POST)) {
    $id = checkInput($_POST['id']);
    $db = Database::connect();
    $statement = $db->prepare("DELETE FROM items WHERE id = ?");
    $statement->execute(array($id));
    Database::disconnect();
    header("Location: index.php");
}

function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$db = Database::connect();
        $statement = $db->prepare("SELECT * FROM items where id = ?");
        $statement->execute(array($id));
        $item = $statement->fetch();
        $name           = $item['name'];
        Database::disconnect();
?>

<!DOCTYPE html>
<html>

<?php require('../structure/head_admin.php'); ?>

<body>
    <h1 class="text-logo"> ESCO TOITURE </h1>
    <div class="container admin">
        <div class="row">
            <div class="col">
                <h1 class="text-center"><strong>Supprimer <span class="alert-dark"><?php echo '  '.$item['name'];?></span></strong></h1>
                <br>

                <form class="form" action="delete.php" role="form" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <p class="alert alert-warning mt-4">Etes vous sur de vouloir supprimer ?</p>
                    <div class="text-center form-actions">
                        <button type="submit" class="btn btn-danger">Oui</button>
                        <a class="btn btn-default" href="index.php">Non</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>