<?php require_once "./head.php";
require_once "config/function.php"; ?>

<body>

<?php

const BASE_PATH = '/exos/';

require_once "./navbar.php" ?>


    <?php

    // Select
    $topics = execute('SELECT * FROM topic')->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($topics);



    ?>

    <!-- Affiche les topics -->
    <div class="container pt-5">
        <table class="table">
            <thead>
                <tr>
                    <!-- <th scope="col">ID</th> -->
                    <th scope="col">TOPICS</th>
                    <th scope="col">CATEGORIES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($topics as $topic) {

                    $categories = execute("SELECT c.title FROM category c INNER JOIN topic_category tc ON tc.id_category = c.id WHERE tc.id_topic = $topic[id]")->fetchAll(PDO::FETCH_ASSOC);

                    // var_dump($categories);

                ?>

                    <tr>
                        <!-- <td><?= $topic['id'] ?></td> -->
                        <td>
                            <a class="btn btn-primary" href="<?= "topicMessage.php?id=" . $topic['id'] ?>"><?= $topic['title'] ?>
                            </a>
                        </td>

                        <td>
                            <?php foreach ($categories as $category) { ?>
                                <button type="button" class="btn btn-info">
                                    <?= $category['title'] ?>
                                </button>
                            <?php } ?>
                        </td>

                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>










    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>