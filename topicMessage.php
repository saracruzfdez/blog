<?php require_once "./head.php";
require_once "config/function.php"; ?>

<body>

<?php

const BASE_PATH = '/exos/';

require_once "./navbar.php" ?>

    <?php

    // Je verifie que mon get de la page topics est rempli:
    if (!empty($_GET['id'])) {
        // var_dump($_GET['id]);

        $topic = execute(

            "SELECT * 
            FROM topic 
            WHERE id = :id",
            array(

                ':id' => $_GET['id']

            )
        )->fetch(PDO::FETCH_ASSOC);


        // var_dump($topic);

        if ($topic) {

            $categories = execute(

                "SELECT c.title 
FROM category c
INNER JOIN topic_category tc
ON tc.id_category = c.id
WHERE tc.id_topic = $topic[id]"
            )->fetchAll(PDO::FETCH_ASSOC);

            // var_dump($categories);


            $messages = execute(

                "SELECT * 
                FROM message 
                WHERE id_topic=:id_topic",
                array(

                    ':id_topic' => $_GET['id']

                )
            );
        }
    }


    // ICI COMMENCE LE TRAITEMENT DU FORM
    if (!empty($_POST)) {


        // Verifie que le formulaire est rempli :
        $messageError = array();

        if (empty($_POST['content'])) {

            $messageError['message'] = "Ce champs est obligatoire";
        }

        if (count($messageError) == 0) {


            $insertContent = execute(
                "INSERT INTO message (id_topic, content, publish_date) VALUES (:id_topic, :content, NOW())",
                array(

                    ':id_topic' => $_GET['id'],
                    ':content' => $_POST['content'],

                )
            );
        }
    } // FIN VERIF EMPTY £ERRORMESSAGE



    ?>



    <!-- ICI COMMENCE LE FORM -->

    <div class="container pt-5">

        <form class="w-50 mx-auto" method="post" action="">

            <h2><?= $topic['title'] ?></h2>

            <?php foreach ($categories as $category) { ?>

                <button type="button" class="btn btn-info">
                    <?= $category['title'] ?>
                </button>

            <?php  } ?>


            <div>
                <div class="form-group">
                    <label for="content" class="form-label"> </label>
                    <textarea id="content" class="form-control" name="content" rows="5" cols="33" value="" placeholder="Ecrivez votre message"></textarea>
                    <small><?= $messageError['message'] ?? '' ?></small>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
            </div>

            <br>



            <div class="overflow-auto p-3 bg-light">

                <?php foreach ($messages as $message) { ?>

                    <div class="card border-primary mb-3">
                        <div class="card-header">Message posté par XX, le <?= $message['publish_date'] ?></div>
                        <div class="card-body text-primary">
                            <p class="card-text"><?= $message['content'] ?></p>
                        </div>
                    </div>

                <?php } ?>

            </div>



        </form>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>