<?php
include("../classes/Article.php");
$a= new article();
$a->_id = $_REQUEST['id'];
$a->supprimer();
$retour = 10;
header("Location: article_liste.php?retoursup=$retour");
?>