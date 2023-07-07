  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
          <a class="navbar-brand" href="<?= BASE_PATH . "index.php"; ?>">LOGO</a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">


                  <?php if (empty($_SESSION)) { ?>

                      <li class="nav-item">
                          <a class="nav-link" href="<?= BASE_PATH . "authentication.php?action=register"; ?>">INSCRIPTION</a>
                      </li>

                      <li class="nav-item">
                          <a class="nav-link" href="<?= BASE_PATH . "authentication.php?action=login"; ?>">CONNEXION</a>
                      </li>

                      
                      <?php } ?>
                      
                      
                      <?php if (isset($_SESSION) && (!empty($_SESSION))) { ?>

                      <li class="nav-item">
                          <a class="nav-link" href="<?= BASE_PATH . "topic.php"; ?>">NEW TOPIC</a>
                      </li>

                      <li class="nav-item">
                          <a class="nav-link" href="<?= BASE_PATH . "topics.php"; ?>">ALL TOPICS</a>
                      </li>

                      <li class="nav-item">
                          <a class="nav-link" href="<?= BASE_PATH . "category.php?"; ?>">CATEGORIES</a>
                      </li>

                      <li class="nav-item">
                          <a class="nav-link" href="<?= BASE_PATH . "deconnexion.php"; ?>">LOG OUT</a>
                      </li>

                  <?php } ?>


              </ul>
          </div>
      </div>
  </nav>