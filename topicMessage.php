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



    // REQUETTE QUI PERMET d'AFFICHER le nom d'un user, tous les messages quil a posté dans un topic donné, aussi le nom du topic, et les categories qui sont lies a ce topic (noter dabord sur un bout de papier afin de faire les liens (ON)):

    // SELECT user.pseudo AS pseudo, message.content AS message, topic.title AS topicTitle, category.title AS catTitle

    // FROM user

    // INNER JOIN message
    // ON user.id = message.id_user

    // INNER JOIN topic
    // ON message.id_topic = topic.id

    // INNER JOIN topic_category
    // ON topic_category.id_topic = topic.id

    // INNER JOIN category
    // ON category.id = topic_category.id_category

    // WHERE topic.id = 7



    // ICI COMMENCE LE TRAITEMENT DU FORM
    if (!empty($_POST)) {


        // Verifie que le formulaire est rempli :
        $messageError = array();

        if (empty($_POST['content'])) {

            $messageError['message'] = "Ce champs est obligatoire";
        }

        if (count($messageError) == 0) {


            $insertContent = execute(
                "INSERT INTO message (content, publish_date, id_topic, id_user) 
                VALUES (:content, NOW(), :id_topic, :id_user)",
                array(

                    ':content' => $_POST['content'],
                    ':id_topic' => $_GET['id'],
                    ':id_user' => $_SESSION['user']['id']

                )
            );

            header("Location: topicMessage.php?id=$_GET[id]");
        }
    }; // FIN VERIF EMPTY £ERRORMESSAGE

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


            <?php foreach ($messages as $message) { ?>

                <div class="card border-primary mb-3">
                    <div class="card-header">Message posté par XX, le <?= $message['publish_date'] ?></div>
                    <div class="card-body text-primary">
                        <p class="card-text"><?= $message['content'] ?></p>
                    </div>
                </div>

            <?php } ?>



            <!-- <?php var_dump($message) ?> -->



        </form>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>