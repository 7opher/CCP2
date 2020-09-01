<?php

require 'session_start.php';

?>

<!DOCTYPE html>
<html>

<?php require('../structure/head_admin.php'); ?>

<body>
  <nav class="navbar">
    <div class="container mb-2" id="button_signin">
      <a id="btn_logOut" class="btn btn-danger btn-lg pull-right" href="../registration/index.php?logout='1'">
        Log out
      </a>
    </div>
  </nav>



  <div class="container admin">
    <div class="row">
      <div class="col">
        <!-- logged in user information -->

        <?php if (isset($_SESSION['username'])) : ?>
        <?php endif ?>




        <!-- notification message -->
        <div class="text-center" id="success_admin">
          <div>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <span class="h4">Bienvenue <strong><?php echo $_SESSION['username']; ?></strong></span>
              <?php if (isset($_SESSION['success'])) : ?>
                <div class="error success">
                  <h3>
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                  </h3>
                </div>
              <?php endif ?>
            </div>
          </div>
        </div>

        <h1><strong>Liste des articles <a href="insert.php" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></strong></h1>
        <table class="table table-striped table-bordered table-responsive">
          <thead>
            <tr>
              <th scope="col">Nom</th>
              <th scope="col">Description</th>
              <th scope="col">Prix</th>
              <th scope="col">Catégorie</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            require 'database.php';
            $db = Database::connect();
            $statement = $db->query('SELECT items.id, items.name, items.description, items.price, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id ORDER BY items.id DESC');
            while ($item = $statement->fetch()) {
              echo '<tr>';
              echo '<td>' . $item['name'] . '</td>';
              echo '<td>' . $item['description'] . '</td>';
              echo '<td>' . number_format($item['price'], 2, '.', '') . '</td>';
              echo '<td>' . $item['category'] . '</td>';
              echo '<td>';
              echo '<a class="btn btn-default mb-1" href="view.php?id=' . $item['id'] . '">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
                            <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                            </svg>
                            </span>Visioner</a>';
              echo ' ';
              echo '<a class="btn btn-primary mb-1" href="update.php?id=' . $item['id'] . '">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
                            <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
                            </svg>
                            </span>Modifier</a>';
              echo ' ';
              echo '<a class="btn btn-danger mb-1" href="delete.php?id=' . $item['id'] . '">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-square center" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
                            <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
                            </svg>
                            </span>Supprimer</a>';
              echo '</td>';
              echo '</tr>';
            }
            Database::disconnect();
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>