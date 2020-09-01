<?php 

    require 'session_start.php';
    
?>

<?php
     
    require 'database.php';
 
    $nameError = $descriptionError = $priceError = $categoryError = $imageError = $name = $description = $price = $category = $image = "";

    if(!empty($_POST)) 
    {
        $name               = checkInput($_POST['name']);
        $description        = checkInput($_POST['description']);
        $price              = checkInput($_POST['price']);
        $category           = checkInput($_POST['category']); 
        $image              = checkInput($_FILES["image"]["name"]);
        $imagePath          = '../images/'. basename($image);
        $imageExtension     = pathinfo($imagePath,PATHINFO_EXTENSION);
        $isSuccess          = true;
        $isUploadSuccess    = false;
        
        require 'if_field_verification.php';
        
        if(empty($image)) 
        {
            $imageError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        else
        {
            $isUploadSuccess = true;
            if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" ) 
            {
                $imageError = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
            
            if($_FILES["image"]["size"] > 500000) 
            {
                $imageError = "Le fichier ne doit pas depasser les 500KB";
                $isUploadSuccess = false;
            }
            if($isUploadSuccess) 
            {
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) 
                {
                    $imageError = "Il y a eu une erreur lors de l'upload";
                    $isUploadSuccess = false;
                } 
            } 
        }
        
        if($isSuccess && $isUploadSuccess) 
        {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO items (name,description,price,category,image) values(?, ?, ?, ?, ?)");
            $statement->execute(array($name,$description,$price,$category,$image));
            Database::disconnect();
            header("Location: index.php");
        }
    }

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

<?php require('../structure/head_admin.php'); ?>

<body>
    <h1 class="text-logo"> ESCO TOITURE</h1>
    <div class="container admin">
        <h1 class="text-center mb-2"><strong>Ajouter un article</strong></h1>
        <br>
        <form class="form" action="insert.php" role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="font-weight-bold" for="name">Nom :</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?>">
                <span class="help-inline"><?php echo $nameError; ?></span>
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="description">Description :</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description; ?>">
                <span class="help-inline"><?php echo $descriptionError; ?></span>
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="price">Prix :</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix (euro)" value="<?php echo $price; ?>">
                <span class="help-inline"><?php echo $priceError; ?></span>
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="category">Catégorie :</label>
                <select class="form-control" id="category" name="category">
                    <?php
                    $db = Database::connect();
                    foreach ($db->query('SELECT * FROM categories') as $row) {
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';;
                    }
                    Database::disconnect();
                    ?>
                </select>
                <span class="help-inline"><?php echo $categoryError; ?></span>
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="image">Sélectionner une image :</label>
                <br />
                <input type="file" id="image" name="image">
                <br />
                <span class="help-inline"><?php echo $imageError; ?></span>
            </div>
            <br>
            <div class="form-actions">
                <button type="submit" class="btn btn-success">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" />
                        <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z" />
                    </svg> Ajouter</button>
                <a class="btn btn-primary" href="index.php">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-return-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5.854 5.646a.5.5 0 0 1 0 .708L3.207 9l2.647 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0z" />
                        <path fill-rule="evenodd" d="M13.5 2.5a.5.5 0 0 1 .5.5v4a2.5 2.5 0 0 1-2.5 2.5H3a.5.5 0 0 1 0-1h8.5A1.5 1.5 0 0 0 13 7V3a.5.5 0 0 1 .5-.5z" />
                    </svg> Retour</a>
            </div>
        </form>


    </div>
</body>

</html>