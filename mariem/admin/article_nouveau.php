 <?php include('header.inc.php'); 



@$id = $_GET['id'];
if( !empty($id) ) {
  include("../classes/Article.php");
  $a= new Article();
  $a->_id = $id;
  $a = $a->details();
}
 ?>



<div class="ts-main-content">
  <div class="content-wrapper">
    <div class="container-fluid">

<div class="row" id="content">
         <div class="col-md-1" ></div>
          <div class="col-md-9" id="content_text">
          <h1 style="border-bottom: 1px solid #ccc"> <?php if( !empty($id) ) echo "Modifier"; else echo "Ajouter" ?> Article</h1>

          <?php
          if (isset($_GET['retour']))
          {  
              ?>
            <div class="alert alert-danger">
              alert pas d'ajout
            </div>
            <?php

          } 
          ?>
                   
           <form class="form-horizontal" action="article_nouveau_action.php" method="post">
        
           <div  style="display:none">
              <input type="number"  id="id" name="id"  value="<?php echo @($a->_id); ?>" > 
                          </div>

            <div class="form-group has-feedback">
              <label class="control-label col-sm-2" for="titre" >Titre *:</label>
              <div class="col-sm-7"><input type="texte" class="form-control" id="titre" name="titre" required="required" value="<?php echo @($a->_titre); ?>" > 
              </div>
            </div>
         
            <div class="form-group">
              <label class="control-label col-sm-2" for="image">Image*:</label>
              <div class="col-sm-7"><input type="file" class="form-control" id="image" name="image"<?php if( empty($id) ) {?> required="required" <?php } ?>> </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="texte">Texte *:</label>
              <div class="col-sm-7"><textarea class="form-control" required="required" id="texte" name="texte" por ><?php echo @($a->_texte); ?></textarea> </div>
            </div>

            <input type="submit" value="<?php if( !empty($id) ) echo "Modifier"; else echo "Ajouter" ?>" class="btn btn-default">
          </form>
          </div>

        </div>
        <div >
          <div class="col-sm-7"></div>
          <?php if( !empty($id) ) { ?>
          <img src="../upload/<?php echo @($a->_image)?>" width="150" /> 
          <?php } ?>
      </div>

        </div>
      </div>
              </div>
   <?php require_once("footer.inc.php"); ?>