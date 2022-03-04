<?php
session_start();                                // On démarre une session

if($_POST){
    if(isset($_POST['nom']) && !empty($_POST['nom'])
    && isset($_POST['vers']) && !empty($_POST['vers'])){

        require_once('connexion.php');          // On inclut la connexion à la base
        
        $nom = ($_POST['nom']);                 // On nettoie les données envoyées
        $vers = ($_POST['vers']);

        $sql = "INSERT INTO `app` (`nom`, `vers`) VALUES
        ('$nom', '$vers');";
      

        $query = $db->prepare($sql);

        //$query->bindValue(':nom', $nom, PDO::PARAM_STR); 
        //$query->bindValue(':vers', $vers, PDO::PARAM_STR);

        if($query->execute())
        {

            $_SESSION['message'] = "Application ajouté";
            require_once('close.php');

            header('Location: index.php');
        }else{
            $_SESSION['erreur'] = "Probléme avec la commande sql";
        }
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

?>
<!DOCTYPE HTML>
<HTML lang="fr">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Ajouter une app</title>

      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
      crossorigin="anonymous">
  </head>

    <body>
        <main class="container">
            <div class="row">
            <section class="col-12">
                <?php
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert-danger" role="alert">'. $_SESSION['erreur'].'
                            </div>';
                            $_SESSION['erreur'] = "";
                    }
                ?>
                <h1>Ajouter une application</h1> 
                <form method="post">
                    <div class="form-group">
                        <label for="nom">nom</label>
                        <input type="text" id="nom" name="nom"
                        class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="vers">version</label>
                        <input type="text" id="vers" name="vers"
                        class="form-control">
                    </div>
                    <button class="btn btn btn-primary">Envoyer</button><br>
                </form>
            </section>
            <input type="file"id="avatar" name="avatar"></input>
            </div>
        </main>
    </body>
<HTML> 
  