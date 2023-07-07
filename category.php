<?php require_once "./head.php";
require_once "config/function.php"; ?>


<body>

<?php

const BASE_PATH = '/exos/';

require_once "./navbar.php" ?>


<!-- Condition, soumission du form et insertion en bdd : -->
<?php

if (!empty($_POST)) {

    //  var_dump($_POST);

    $errorCategory = array();
    
    if (empty($_POST['title'])) {
        
        $errorCategory['title'] = 'Title obligatoire';
    };
    
    if (empty($errorCategory)) {
        
        // Veriefie si je suis en update ou en insertion avec $get id vide ou rempli :
        if (empty($_GET['id'])) {
            
            // Vérifie si la cat est existante en bdd :
                $result = execute("SELECT * FROM category WHERE title=:title", array(':title' => $_POST['title']));
            // var_dump($result->rowCount());

            if ($result->rowCount() == 0) {

                $result = execute("INSERT INTO category (title) VALUES (:title)", array(

                    ':title' => $_POST['title']

                ));

            } else {

                $errorCategory['title_existant'] = "Categorie existante";
            }

        } else {

            execute("UPDATE category SET title=:title WHERE id=:id", array(

                ':id' => $_POST['id'],
                ':title' => $_POST['title']

            ));

            header('Location: category.php');
            exit;

        } // Fin vérification si je suis en update ou en insertion

    }  // Fin vérification $errorCategory


} // Fin vérification !empty $_POST





// vardump pour verifier si je recois les paramettres en url get :
// var_dump($_GET)

// Verifie que je recois en get les parametres au click sur modifier ou supprimer:
if (!empty($_GET) && isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'update') {

    $currentCategory = execute("SELECT * FROM category WHERE id=:id", array(

        ':id' => $_GET['id']
    ))->fetch(PDO::FETCH_ASSOC);

    // var_dump($currentCategory);

}


if (!empty($_GET) && isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {

    $succes = execute("DELETE FROM category WHERE id=:id", array(

        ':id' => $_GET['id']

    ));


    // var_dump($succes);

    header('Location: category.php');
    exit;

};


?>





<div class="container pt-5">
        <div class="w-50 mx-auto col-12 col-sm-10 col-md-8 col-lg-6 border text-bg-light p-3">

            <h4>Gestion categories</h4>

            <form class="w-50 mx-auto" method="post" action="">

                <div class="form-group">
                    <label for="title" class="form-label">Title</label>
                    <input name="title" class="form-control" id="title" type="text" value="<?= $currentCategory['title'] ?? '' ?>">
                    <small><?= $errorCategory['title'] ?? ''; ?></small>
                </div>

                <div class="form-group">
                    <label for="id" class="form-label"></label>
                    <input name="id" class="form-control" type="hidden" value="<?= $currentCategory['id'] ?? '' ?>">
                </div>

                <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>

            </form>
        </div>
    </div>






    <?php
    // Select all categories and show in a table :
    $categories = execute('SELECT * FROM category');
    // var_dump($categories);
    // var_dump($categories->rowCount());

    if ($categories->rowCount() >= 1) {

        // var_dump($category)
    ?>

        <div class="container pt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">TITE</th>
                        <th scope="col">UPDATE</th>
                        <th scope="col">DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category) {
                        // var_dump($category);
                    ?>

                        <tr>
                            <td><?= $category['id'] ?></td>
                            <td><?= $category['title'] ?></td>

                            <td><a class="btn btn-warning" href="<?= "?action=update&id=" . $category['id']; ?>">UPDATE</a>
                            </td>

                            <td><a class="btn btn-danger" href="<?= "?action=delete&id=" . $category['id']; ?>">DELETE</a>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>

    <?php

    } // fin if $categories->rowCount()
    ?>

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>