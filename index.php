<?php
session_start();

require_once('connexion.php');    // On inclut la connexion à la base
    
$sql = 'SELECT * FROM `app`';

$query = $db->prepare($sql);       // On prépare la requête
    
$query->execute();                // On exécute la requête
    
$result = $query->fetchAll(PDO::FETCH_ASSOC);     // On stocke le resultat dans un tableau

require_once('close.php');

?>
<!DOCTYPE HTML>
<HTML lang="fr">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Liste des applis</title>

      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
      crossorigin="anonymous">
  </head>

  <body>
      <main class="container">
        <div class="row">
          <section class="col-12">
        <script>
  				function showAlerte() {    // Permet d'enlever le message
    				document.getElementById("alerte").style.display = "none";
					}
        	setTimeout("showAlerte()", 3000); 
    		</script>
        
          <?php
                  if(!empty($_SESSION['erreur'])){
                      echo '<div class="alert-danger" role="alert">
                              '. $_SESSION['erreur'].'
                          </div>';
                      $_SESSION['erreur'] = "";
                  }
              ?>
              <?php
                  if(!empty($_SESSION['message'])){
                      echo '<div class="alert-succes" role="alert">
                              '. $_SESSION['message'].'
                          </div>';
                      $_SESSION['message'] = "";
                  }
              ?>
              <h1>Liste des applications</h1>
              <table class="table">
                  <thead>
                      <th>Nom</th>
                      <th>Version</th>
                      <th>Modification</th>
                      <th>Supprimer</th>
                  </thead>
                  <tbody>
                      <?php
                      foreach($result as $application){   // On fais une boucle sur la variable result
                      ?>
                          <tr>
                            <td><?= $application['nom']?></td>
                            <td><?= $application['vers']?></td>
                            <td><a href="modif.php?id=<?= $application['id'] ?>">
                            Modifier</a></td>
                            <td><a href="suppr.php?id=<?= $application['id'] ?>">
                            Supprimer</a></td>
                          </tr>
                      <?php
                      }
                      ?>
                  </tbody>
              </table>
              <a href="ajout.php" class="btn btn-primary">Ajouter une app</a>
          </section>
        </div>
      </main>
  </body>
<HTML> 
  