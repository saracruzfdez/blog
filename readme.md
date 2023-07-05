# Mise en place du projet forum

- Notre client souhaite la création ,par notre équipe, de son forum devTech le montage de sa base de donnée. Il nous explique qu'il a besoin d'une simple authentification par Pseudo. Que ses utilisateur peuvent créer un topic en liens avec plusieurs catégories que nous qualifiront de tag. Une fois le topic créé, il souhaite que tout utilisateur puisse y participer

- Identifier les différentes tables
User: id (AI), pseudo (varchar 20), picture_profil (varchar 50), password (varchar 70)
Topic: id (AI), title (varchar 70), id_user (int)
Message: id (AI), content (longText), publish_date (dateTime), id_topic(int), id_user(int)
Category: id (AI), title (varchar 20)
Topic_category: id (AI), id_topic (int), id_category (int)
Exo 1 : Créer cette BDD
Exo 2: Inscription / connexion
Partie 1 : Créer les formulaires
Ajouter les bouton inscription et connexion envoyant sur une page authentication.php qui contiendra les 2 formulaires.

Ainsi il va faloir déclarer un passage en get qui sera receptionné dans la superglobale $_GET. Rappel: qui sera receptionné dans $_GET sous la forme ['1erarg'=>'1erevaleur', '2ndarg'=>'2ndevaleur' ]. Pour accéder à la 1ereValeur il nous faut donc appeler echo $_GET['1ereClé']. Ensuite créez les formulaires parametrés pour être opérationnels. (rappel: un formulaire doit avoir une méthode, les inputs un name, un enctype si le formulaire contient un input type file et enfin un button type submit). Enfin gérer la condition d'apparition d'un formulaire ou de l'autre grace à $_GET