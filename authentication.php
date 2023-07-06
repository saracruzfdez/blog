<?php require_once "./head.php"; 
      require_once "config/function.php";?>

<body>

    <?php

const BASE_PATH = '/exos/';

require_once "./navbar.php";


    if (!empty($_POST)) {

        if ((isset($_GET['action']) && $_GET['action']) == "register") { // Condition de traitement de la connexion grace à $_GET['register'] :

            //var_dump($_FILES);
            //die();
            $error = array();

            if (empty($_POST['pseudo'])) {

                $error['pseudo'] = 'Pseudo obligatoire';
            }

            if (empty($_POST['password'])) {

                $error['password'] = 'Password obligatoire';
            }

            if (empty($_FILES['picture_profil']['name'])) {

                $error['picture_profil'] = 'Photo de profil obligatoire';
            }

            if (empty($error)) {

                $mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $result = execute("SELECT * FROM user WHERE pseudo=:pseudo", array(':pseudo' => $_POST['pseudo']));

                // var_dump($result->fetch(PDO::FETCH_ASSOC));
                // die();

                if ($result->rowCount() == 0) {

                    $picture = date_format(new DateTime(), 'Y_m_d_i_s') . $_FILES['picture_profil']['name'];
                    // var_dump($picture);die();

                    if (!file_exists('upload/')) {

                        mkdir('upload', 777);
                    }

                    copy($_FILES['picture_profil']['tmp_name'], 'upload/' . $picture);
                    //unlink('upload/nomimage.png');

                    $result = execute("INSERT INTO user (pseudo, picture_profil, password) VALUES (:pseudo, :picture_profil, :password)", array(

                        ':pseudo' => $_POST['pseudo'],
                        ':picture_profil' => 'upload/' . $picture,
                        ':password' => $mdp

                    ));

                    //Une fois l'inscription faite, on redirige vers la page de login :
                    header('location:./authentication.php?action=login');
                    exit();
                } else {

                    $error['pseudo_existant'] = "Votre pseudo est déjà utilisé";
                }
            } // Fin empty $error
        } // Fin condition de traitement de la connexion grace à $_GET['register']

        // condition de traitement de la connexion grace à $_GET['action'] :
        if ((isset($_GET['action']) && $_GET['action']) == "login") {
            $result = execute("SELECT * FROM user WHERE pseudo=:pseudo", array(':pseudo' => $_POST['pseudo']));

            if ($result->rowCount() == 1) {
                $user = $result->fetch(PDO::FETCH_ASSOC);
                // var_dump($user);
                // die();

                if (password_verify($_POST['password'], $user['password'])) {

                    $_SESSION['user'] = $user;
                    header('location:./');
                    exit();
                } else {

                    $error['password'] = 'erreur sur le mot de passe';
                }
            } else {
                $error['pseudo_pas_existant'] = "Aucun compte existe à ce nom";
            }
        }
    } // Fin !empty $_POST

    ?>

    <!-- Formulaire : -->
    <div class="container pt-5">

    <div class="w-50 mx-auto col-12 col-sm-10 col-md-8 col-lg-6 border text-bg-light p-3">

            <div class="w-50 mx-auto"><?= $error['pseudo_existant'] ?? ' ' ?></div>

                <?php if (!empty($_GET) && isset($_GET['action']) && $_GET['action'] == 'register') : ?>

                    <form class="w-50 mx-auto" enctype="multipart/form-data" method="post" action="">
                        <div class="form-group">
                            <label for="pseudo" class="form-label">Pseudo</label>
                            <input name="pseudo" class="form-control" id="pseudo" type="text">
                            <small><?= $error['pseudo'] ?? ''; ?></small>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input name="password" class="form-control" id="password" type="password">
                            <small><?= $error['password'] ?? ''; ?></small>
                        </div>
                        <div class="form-group">
                            <label for="picture_profil" class="form-label">Photo de profil</label>
                            <input name="picture_profil" class="form-control" id="picture_profil" type="file">
                            <small><?= $error['picture_profil'] ?? ''; ?></small>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">enregistrer</button>
                    </form>

                <?php elseif (!empty($_GET) && isset($_GET['action']) && $_GET['action'] == 'login') : ?>

                    <form class="w-50 mx-auto mt-5" <?= $error['pseudo_pas_existant'] = "Aucun compte existe à ce nom" ?>; method="post" action="">
                        <div class="form-group">
                            <label for="pseudo" class="form-label">Pseudo</label>
                            <input name="pseudo" class="form-control" id="pseudo" type="text">
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input name="password" class="form-control" id="password" type="password">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">enregistrer</button>
                    </form>

                <?php endif; 
                
                // var_dump($_SESSION);
                // die()
                ?>




            </div>

        </div>

    </div>
                

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>