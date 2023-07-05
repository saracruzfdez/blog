<?php require_once "./head.php"; 
      require_once "config/function.php";?>

<body>
    <?php

    const BASE_PATH = '/exos/';

    ?>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link active" aria-current='page' href="<?= BASE_PATH . "category.php?"; ?>">GESTION CATEGORIES</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_PATH . "authentication.php?action=register"; ?>">INSCRIPTION</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_PATH . "authentication.php?action=login"; ?>">CONNEXION</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_PATH . "topic.php"; ?>">NEW TOPIC</a>
                    </li>
                  
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_PATH . "topics.php"; ?>">ALL TOPICS</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <h2>Mise en place du projet forum</h2>
    <p>Notre client souhaite la création ,par notre équipe, de son forum devTech le montage de sa base de donnée. Il nous explique qu'il a besoin d'une simple authentification par Pseudo. Que ses utilisateur peuvent créer un topic en liens avec plusieurs catégories que nous qualifiront de tag. Une fois le topic créé, il souhaite que tout utilisateur puisse y participer</p>

    <h3>Identifier les différentes tables</h3>
    <ol>
        <li>User: id (AI), pseudo (varchar 20), picture_profil (varchar 50), password (varchar 70)</li>
        <li>Topic: id (AI), title (varchar 70), id_user (int)</li>
        <li>Message: id (AI), content (longText), publish_date (dateTime), id_topic(int), id_user(int)</li>
        <li>Category: id (AI), title (varchar 20)</li>
        <li>Topic_category: id (AI), id_topic (int), id_category (int)</li>
    </ol>

    <h4>Exo 1 : Créer cette BDD</h4>

    <h3>Exo 2: Inscription / connexion</h3>
    <h4>Partie 1 : Créer les formulaires</h4>
    <p>Ajouter les bouton inscription et connexion envoyant sur une page authentication.php qui contiendra les 2 formulaires.</p>
    <p>Ainsi il va faloir déclarer un passage en get qui sera receptionné dans la superglobale $_GET.
        Rappel: <a href="mapage.php?1ereClé=1erevaleur&2ndeClé=2ndevaleur"></a> qui sera receptionné dans $_GET sous la forme ['1erarg'=>'1erevaleur', '2ndarg'=>'2ndevaleur' ]. Pour accéder à la 1ereValeur il nous faut donc appeler echo $_GET['1ereClé']. Ensuite créez les formulaires parametrés pour être opérationnels. (rappel: un formulaire doit avoir une méthode, les inputs un name, un enctype si le formulaire contient un input type file et enfin un button type submit). Enfin gérer la condition d'apparition d'un formulaire ou de l'autre grace à $_GET </p>

    <h3>Exo 4: afficher les infos de l'utilisateur connecté grace à $_SESSION</h3>
    <p>A la condition que l'utilisateur soit chargé en session afficher ses informations de profil: pseudo et photo </p>


  
    
<?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])) { ?>

<div class="w-10 mx-auto mt-5">
    <h4><?= $_SESSION['user']["pseudo"] ;?></h4>
<img src="<?= $_SESSION['user']["picture_profil"] ;?>" alt="">
</div>

<?php } ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>