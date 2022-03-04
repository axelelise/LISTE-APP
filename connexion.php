 <?php

  try
{                               // Connexion à la base de donnée
  $db = new PDO('mysql:host=localhost;dbname=app_version', 'base_app', '123456');
  $db->exec('SET NAMES "UTF8"');
}
  catch (PDOException $e){      // Le catch est chargé d’intercepter une éventuelle erreur
    echo 'Erreur : '. $e->getMessage();
    die ();
  }
?>