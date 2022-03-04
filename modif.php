<?php
session_start();                                // On démarre une session

if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('connexion.php');

    $id = strip_tags($_GET['id']);              // On nettoie l'id envoyé

    $sql = "SELECT * FROM `app` WHERE `id` = '$id'";

    $query = $db->prepare($sql);                // On prépare la requête

    $query->execute();                          // On exécute la requête

    $application = $query->fetch();                     // On récupère le nom

    if(!$application){
        $_SESSION['erreur'] = "Cette id n'existe pas";
        header('Location: index.php');
    }
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index.php');
}

if($_POST){
    if(isset($_POST['id']) && !empty($_POST['id'])
    && isset($_POST['nom']) && !empty($_POST['nom'])
    && isset($_POST['vers']) && !empty($_POST['vers'])){

        require_once('connexion.php');          // On inclut la connexion à la base
        
        $id = ($_POST['id']);                 // On nettoie les données envoyées
        $nom = ($_POST['nom']);
        $vers = ($_POST['vers']);

        $sql = "UPDATE `app` SET `nom`='$nom', `vers`='$vers' 
        WHERE `id`='$id'";
      

        $query = $db->prepare($sql);

        //$query->bindValue(':nom', $nom, PDO::PARAM_STR); 
        //$query->bindValue(':vers', $vers, PDO::PARAM_STR);

        if($query->execute())
        {

            $_SESSION['message'] = "Application modifié";
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
      <title>Modifier une app</title>

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
                <h1>Modifier une application</h1> 
                <form method="post">
                    <div class="form-group">
                        <label for="nom">nom</label>
                        <input type="text" id="nom" name="nom"
                        class="form-control" value="<?= $application['nom']
                        ?>"]>
                    </div>
                    <div class="form-group">
                        <label for="vers">version</label>
                        <input type="text" id="vers" name="vers"
                        class="form-control" value="<?= $application['vers']
                        ?>"]>
                    </div>
                    <input type="hidden" value="<?= $application['id']?>"
                    name="id">
                    <button class="btn btn btn-primary">Envoyer</button>
                    <a href="https://www.google.com/" class="btn btn btn-primary">Mettre a jour</a>
                </form>
            </section>
            </div>
        </main>
    </body>
<HTML> 
  