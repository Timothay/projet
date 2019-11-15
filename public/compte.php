<?php

try
 {
  $bdd = new PDO('mysql:host=localhost;dbname=projetweb', 'root', '');
 }
  catch (Exception $e)
 {
  die('Erreur : ' . $e->getMessage());
 }


 $reponse = $bdd->query('SELECT users.nom, prenom, mail, centre, users.password, role.nom FROM users JOIN role ON users.role_id = role.id');

 while ($donnees = $reponse->fetch())
    {
    ?>
    <p>Prénom : <?php echo $donnees['prenom']; ?>
    Nom : <?php echo $donnees['users.nom']; ?>
    E-Mail : <?php echo $donnees['mail']; ?>
    Centre : <?php echo $donnees['centre']; ?>
    Mot de passe : <?php echo $donnees['users.password']; ?>
    Statut : <?php echo $donnees['role.nom']; ?></p>
    <?php
    }

$reponse->closeCursor();

?>