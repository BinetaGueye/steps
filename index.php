<?php
require 'model/autoload.php';
require 'controller/backend.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new NewsManagerPDO($db);
$controllerBackend = new backend($manager);

if (isset($_GET['modifier']))
{
  $news = $controllerBackend->edit($_GET['modifier']);
}

if (isset($_GET['supprimer']))
{
  $manager->delete((int) $_GET['supprimer']);
  $message = 'La news a bien été supprimée !';
}

if (isset($_POST['auteur']))
{
  $news = new News(
    [
      'auteur' => $_POST['auteur'],
      'titre' => $_POST['titre'],
      'contenu' => $_POST['contenu']
    ]
  );
  
  if (isset($_POST['id']))
  {
    $news->setId($_POST['id']);
  }
  
  if (!($news->isValid()))
  {
    $erreurs = $news->erreurs();
  }
  else
  {
    $message = $controllerBackend->save($news);
  }
}
?>
<?php require('view/backend/admin.php'); ?>
