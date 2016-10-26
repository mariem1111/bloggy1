<?php
include("../classes/Article.php");
include("../classes/Util.php");

@$titre = $_POST['titre'];
@$texte = $_POST['texte'];
@$id = $_POST['id'];

	$a = new Article();
	$util = new Util();
	$a->_titre= $titre;
	$a->_texte = $texte;
	$a->_image = $util->upload( 'image', "../upload/");
   if( empty($id) ) 
	{
	  if($a->ajouter())
		{
		$retour = 1;
	    header("Location: article_liste.php?retour=$retour&titre=$titre");
	    }
	}elseif ( !empty($id)) {
        $a->_id = $id;
		$a->modifier();
		$retour = 1;
		header("Location: article_liste.php?retourm=$retour&titre=$titre");
	}
	else
	{
		$retour = -1;
        header("Location: article_nouveau.php?retour=$retour");
    }    

?>