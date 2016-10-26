<?php require_once("header.inc.php"); 
include("classes/Article.php");

@$id = $_GET['id'];
if( !empty($id) ) {

	$a= new Article();
	$a->_id = $id;
	$a= $a->details();
}
?>
<div class="ts-main-content">
	<div class="content-wrapper">
		<div class="container-fluid">

			<div class="row" id="content">
				<div class="col-md-3" >
					<?php if( !empty($id) ) { ?>
					<img src="../upload/<?php echo @($a->_image)?>" width="150" /> 
					<?php } ?>
				</div>
				<div class="col-md-9" id="content_text">
					<h1 style="border-bottom: 1px solid #ccc"> Detail Article</h1>

					<div class="form-group has-feedback col-sm-12">
						<label class="control-label col-sm-2" for="titre" >Titre *:</label>
						<div class="col-sm-7"><input type="number"  disabled="true" class="form-control" id="titre" name="titre" required="required" value="<?php echo @($a->_titre); ?>" > 
						</div>
					</div>


					<div class="form-group col-sm-12">
						<label class="control-label col-sm-2" for="texte">Texte *:</label>
						<div class="col-sm-7"><textarea class="form-control" disabled="true" required="required" id="texte" name="texte" por ><?php echo @($a->_texte); ?></textarea> </div>
					</div>


				</div>

			</div>


		</div>
	</div>
</div>

<?php require_once("footer.inc.php"); ?>