<!DOCTYPE html>
<html lang="fr">

<?php require('structure/head.php'); ?>


<body>
<nav class="navbar">
    <div class="container" id="button_signin">
    <a class="btn btn-outline-light btn-lg" role="button" href="registration/login.php">
            Admin
    </a>
</div>
</nav>
    
    <div class="container site">
        <h1 class="text-logo"> ESCO TOITURE </h1>
        <?php
        require 'admin/database.php';

        echo '<nav>
                        <ul class="nav nav-pills">';

        $db = Database::connect();
        $statement = $db->query('SELECT * FROM categories');
        $categories = $statement->fetchAll();
        foreach ($categories as $category) 
        {
            if ($category['id'] == '1')
                echo '<li role="presentation" class="active"><a href="#' . $category['id'] . '" data-toggle="tab">' . $category['name'] . '</a></li>';
            else
                echo '<li role="presentation"><a href="#' . $category['id'] . '" data-toggle="tab">' . $category['name'] . '</a></li>';
        }

        echo    '</ul>
              </nav>';

        echo '<div class="tab-content">';

        foreach ($categories as $category) 
        {
            if ($category['id'] == '1')
                echo '<div class="tab-pane active" id="' . $category['id'] . '">';
            else
                echo '<div class="tab-pane" id="' . $category['id'] . '">';

            echo '<div class="row">';

            $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
            $statement->execute(array($category['id']));
            while ($item = $statement->fetch()) 
            {
                echo '<div class="col-md-4">
                        <div class="card mb-4">
                            <img src="images/' . $item['image'] . '" alt="..." class"img-thumbnail" width="100%" height="225"> 
                            <div class="price">' . number_format($item['price'], 2, '.', '') . ' €</div>
                            <div class="card-body">
                                <h4 class="card-title">' . $item['name'] . '</h4>
                                <p class="card-text">' . $item['description'] . '</p>
                                <a href="#" class="btn btn-order" role="button"></span> Contacter</a>
                            </div>
                        </div>
                    </div>';
            }

            echo    '</div>
                </div>';
        }
        Database::disconnect();
        echo  '</div>';
        ?>
    </div>
</body>

</html>