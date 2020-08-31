<?php 

    require 'session_start.php';
    
?>

<?php
    require 'database.php';

    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }
     
    $db = Database::connect();
    $statement = $db->prepare("SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id WHERE items.id = ?");
    $statement->execute(array($id));
    $item = $statement->fetch();
    Database::disconnect();

    function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

?>

<!DOCTYPE html>
<html>
    
    <?php require ('../structure/head_admin.php'); ?>
    
    <body>
        <h1 class="text-logo"> ESCO TOITURE</h1>
         <div class="container admin">
            <div class="row">
               <div class="col-sm-6">
                    <h1 class="text-center"><strong>Article<?php echo '  '.$item['name'];?></strong></h1>
                    <br>
                    <form class="list-group">
                      <div class="form-group list-group-item">
                        <label class="font-weight-bold">Nom :</label><?php echo '  '.$item['name'];?>
                      </div>
                      <div class="form-group list-group-item">
                        <label class="font-weight-bold">Description :</label><br/><?php echo '  '.$item['description'];?>
                      </div>
                      <div class="form-group list-group-item">
                        <label class="font-weight-bold">Prix :</label><?php echo '  '.number_format((float)$item['price'], 2, '.', ''). ' €';?>
                      </div>
                      <div class="form-group list-group-item">
                        <label class="font-weight-bold">Catégorie :</label><?php echo '  '.$item['category'];?>
                      </div>
                      <div class="form-group list-group-item">
                        <label class="font-weight-bold">Image :</label><?php echo '  '.$item['image'];?>
                      </div>
                    </form>
                </div> 
                <div class="col-sm-6 site">
                    <div class="card border p-2">
                        <img class="img-fluid" src="<?php echo '../images/'.$item['image'];?>" alt="...">
                        <div class="price"><?php echo number_format((float)$item['price'], 2, '.', ''). ' €';?></div>
                          <div class="card-body">
                            <h4 class="mt-3"><?php echo $item['name'];?></h4>
                            <p><?php echo $item['description'];?></p>
                            <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Commander</a>
                          </div>
                    </div>
                </div>
                <div class="form-actions m-3">
                      <a class="btn btn-primary" href="index.php">
                      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-return-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M5.854 5.646a.5.5 0 0 1 0 .708L3.207 9l2.647 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0z"/>
                      <path fill-rule="evenodd" d="M13.5 2.5a.5.5 0 0 1 .5.5v4a2.5 2.5 0 0 1-2.5 2.5H3a.5.5 0 0 1 0-1h8.5A1.5 1.5 0 0 0 13 7V3a.5.5 0 0 1 .5-.5z"/>
                      </svg> Retour</a>
                    </div>
            </div>
        </div>   
    </body>
</html>

