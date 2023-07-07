<?php require_once "./head.php";
require_once "config/function.php"; ?>

<body>
    <?php

    const BASE_PATH = '/exos/';

    ?>


<?php require_once "./navbar.php";

// var_dump($_SESSION['user']['id']);

?>




<div class="container pt-3">
    
<?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])) { ?>
    
    <div class="w-10 mx-auto mt-5">
        <h6>Bonjour <?= $_SESSION['user']["pseudo"]; ?></h6>
        <img style = "width: 25%" src="<?= $_SESSION['user']["picture_profil"]; ?>" alt="">
    </div>

    <br>
    
    <?php } ?>

        <h1>Mise en place du projet forum</h1>
        <p>Notre client souhaite la création ,par notre équipe, de son forum devTech le montage de sa base de donnée. Il nous explique qu'il a besoin d'une simple authentification par Pseudo. Que ses utilisateur peuvent créer un topic en liens avec plusieurs catégories que nous qualifiront de tag. Une fois le topic créé, il souhaite que tout utilisateur puisse y participer</p>

        <h4>Exo 1. Identifier les différentes tables</h4>
        <ol>
            <li>User: id (AI), pseudo (varchar 20), picture_profil (varchar 50), password (varchar 70)</li>
            <li>Topic: id (AI), title (varchar 70), id_user (int)</li>
            <li>Message: id (AI), content (longText), publish_date (dateTime), id_topic(int), id_user(int)</li>
            <li>Category: id (AI), title (varchar 20)</li>
            <li>Topic_category: id (AI), id_topic (int), id_category (int)</li>
        </ol>

        <h4>Exo 2. Créer cette BDD</h4>

        <h4>Inscription / connexion :</h4>
        <h4>Exo 3. Créer les formulaires</h4>
        <p>Ajouter les bouton inscription et connexion envoyant sur une page authentication.php qui contiendra les 2 formulaires.</p>
        <p>Ainsi il va faloir déclarer un passage en get qui sera receptionné dans la superglobale $_GET.
            Rappel: <a href="mapage.php?1ereClé=1erevaleur&2ndeClé=2ndevaleur"></a> qui sera receptionné dans $_GET sous la forme ['1erarg'=>'1erevaleur', '2ndarg'=>'2ndevaleur' ]. Pour accéder à la 1ereValeur il nous faut donc appeler echo $_GET['1ereClé']. Ensuite créez les formulaires parametrés pour être opérationnels. (rappel: un formulaire doit avoir une méthode, les inputs un name, un enctype si le formulaire contient un input type file et enfin un button type submit). Enfin gérer la condition d'apparition d'un formulaire ou de l'autre grace à $_GET </p>

        <h4>Exo 4. Afficher les infos de l'utilisateur connecté grace à $_SESSION</h4>
        <p>A la condition que l'utilisateur soit chargé en session afficher ses informations de profil: pseudo et photo </p>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>