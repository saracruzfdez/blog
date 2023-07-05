<?php require_once "./head.php";
require_once "config/function.php"; ?>

<body>

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
                    <th scope="col">TOPIC</th>
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
                            <a class="btn btn-primary" href="<?="topicMessage.php?id=".$topic['id']?>"><?= $topic['title'] ?>
                            </a>
                        </td>

                        <?php foreach ($categories as $category) { ?>

                            <td>
                                <?= $category['title'] ?>
                            </td>

                        <?php } ?>

                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>











</body>

</html>