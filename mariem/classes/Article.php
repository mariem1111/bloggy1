<?php
include("Mysql.php");
class Article extends Mysql  {

	// Attributs de la classe
	private $_id;
	private $_titre;
	private $_image;
	private $_texte;
	private $_d_ajout;

	// Méthode magique pour les setters & getters
	public function __get($property) {
		if (property_exists($this, $property)) {
                return htmlentities( $this->$property );
            }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            	$this->$property = $value;
        }
    }

	public function details()
	{
		$q = "SELECT * FROM article WHERE id ='$this->_id' ";
		$result =  $this->get_cnx()->query($q);
		$res = $result->fetch();
		$a = new article();
		
			$a->_id 	     = $res['id'];
			$a->_titre	 = $res['titre'];
			$a->_image 	 = $res['image'];
			$a->_texte 	 = $res['texte'];
			$a->_d_ajout   = $res['d_ajout'];
	
		return $a;
	}
	// Autres méthodes
	public function ajouter()
	{
	    try {
	    if (!isset($this->_titre) || 
	    	!isset($this->_image) || 
	    	!isset($this->_texte)
	    	)
	    	return false;
	    $q = "INSERT INTO article (id, titre, image, texte, d_ajout) 
	    	  VALUES (null, :titre, :image, :texte, NOW())";
		$stmt = $this->get_cnx()->prepare($q);

		$stmt->bindParam(':titre', $this->_titre);
		$stmt->bindParam(':image', $this->_image);
		$stmt->bindParam(':texte', $this->_texte);

		$stmt->execute();

		return $this->get_cnx()->lastInsertId();
		} catch (PDOException $e) {
		    exit("<pre>Erreur de connexion à la BdD : " . $e->getMessage() . "<br/>");
		}

	}
	
	public function supprimer()
	{
		$q = "DELETE FROM article WHERE id = :id";
		$stmt = $this->get_cnx()->prepare($q);
		$stmt->bindParam(':id', $this->_id);
		return ($stmt->execute() == true);
	}

	public function liste()
	{
		$q = "SELECT * FROM article ORDER BY d_ajout DESC";
		$liste = array(); // Tableau VIDE
		$res = $this->get_cnx()->query($q);
		foreach ($res as $row)
		{
			$a= new Article();

			$a->_id 	 = $row['id'];
			$a->_titre	 = $row['titre'];
			$a->_image 	 = $row['image'];
			$a->_texte 	 = $row['texte'];
			$a->_d_ajout = $row['d_ajout'];
		
			$liste[]=$a;
		}
		
		return $liste; // Renvoi un tableau d'objets
	}
	public function nbarticle()
	{
		 $q = "SELECT count(*) as nb   FROM article";
			 $res = $this->get_cnx()->query($q);
			 $data = $res->fetch();
	         $nb = $data['nb'];
	         return $nb;
    } 
   	public function modifier(){
		$q = "UPDATE article SET
			  titre 	= '$this->_titre',
			  image = IF('$this->_image' = '', image, '$this->_image') ,
			  texte = '$this->_texte'
			  WHERE id = '$this->_id' ";
	  
		$res = $this->requete($q);
		return $res;
	}

}

?>