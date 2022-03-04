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

    $sql = "DELETE FROM `app` WHERE `id` = '$id'";

    $query = $db->prepare($sql);                // On prépare la requête

    $query->execute();                          // On exécute la requête
    $_SESSION['message'] = "Application supprimé";
    header('Location: index.php');
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index.php');
}

?>
