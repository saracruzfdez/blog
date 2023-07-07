<?php require_once "./head.php";
require_once "config/function.php"; ?>


<body>

<?php

const BASE_PATH = '/exos/';

require_once "./navbar.php" ?>


    <?php
    // Select all categories pour afficher dans option :
    $categories = execute('SELECT * FROM category')->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($categories);



    if (!empty($_POST)) {

        // var_dump($_POST);

        $topicError = array();

        if (empty($_POST['title'])) {

            $topicError['title'] = "Ce champs est obligatoire";
        }

        if (empty($_POST['categories'])) {

            $topicError['categories'] = "Veuillez choissir une ou plusieurs categories";
        }

        if (count($topicError) == 0) {

            // ici on  insere le nouveau topic dans topic et recupére la dernière insertion que l'on va faire dans topic :
            $lastInsert = execute("INSERT INTO topic (title, id_user) VALUES (:title, :id_user)", array(

                ':title' => $_POST['title'],
                ':id_user' => $_SESSION['user']['id']


            ), 'lll');

            // ici on boucle sur category et insère dans topic category
            // var_dump($lastInsert);die;

            foreach ($_POST['categories'] as $id_categorie) {

                $result = execute("INSERT INTO topic_category (id_topic, id_category) VALUES (:id_topic, :id_category)", array(

                    ':id_topic' => $lastInsert,
                    ':id_category' => $id_categorie

                ));
            }
        };

        header('Location: topics.php');
        exit;

    } ?>



<div class="container pt-5">

        <div class="w-50 mx-auto col-12 col-sm-10 col-md-8 col-lg-6 border text-bg-light p-3">

            <h4>New topic</h4>

            <form class="w-50 mx-auto" method="post" action="">

                <div class="form-group">
                    <label for="title" class="form-label">Title</label>
                    <input name="title" class="form-control" id="title" type="text" value="">
                    <small><?= $topicError['title'] ?? ''; ?></small>
                </div>

                <br>

                <div class="form-group">
                    <label for="category">Choisissez une categorie:</label>
                    <select multiple name="categories[]" id="category">

                        <?php foreach ($categories as $category) { ?>

                            <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>

                        <?php } ?>

                    </select>
                    <small><?= $topicError['categories'] ?? ''; ?></small>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>

            </form>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>