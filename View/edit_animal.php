<?php require 'inc/header.php' ?>
<?php require 'inc/topbar.php' ?>

<div class="container">
  <?php require 'inc/msg.php' ?>

  <?php if (empty($this->oAnimal)): ?>
      <p class="error">Cet animal n'existe pas !</p>
  <?php else: ?>
    <h1>Modifier l'animal :</h1>
    <form method="post" enctype="multipart/form-data">
    	<div class="row">
    		<div class="input-field col s12">
    			<input type="text" name="nom" id="nom" value="<?=htmlspecialchars($this->oAnimal->nom)?>" required="required">
    			<label for="title">Nom de l'animal</label>
    		</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="date" name="dateNaissance" id="dateNaissance" value="<?=date('d-m-Y', strtotime($this->oAnimal->dateNaissance))?>" required="required">
				<label for="date">Date de Naissance</label>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<!--<select name="race" id="race">
						<option value="1">Terrier</option>
						<option value="2">Berger Allemand</option>
						<option value="3">Border Collie</option>
				</select>-->
				<input type="text" name="race" id="race" value="<?=htmlspecialchars($this->oAnimal->race)?>" required="required">
				<label for="race">Race</label>
			</div>
		</div>		

    		<!--<div class="input-field col s12">
          <label for="editable">Contenu de l'article</label>
          <br>
    			<textarea name="body" id="editable" class="materialize-textarea"><?//=$this->oPost->body?></textarea>
    		</div>
			-->
		<div class="row">
        <div class="col s6 left-align">
    			<br><br>
          <div class="input-field file-field">
    				<div class="btn deep-orange darken-4">
    					<span>Modifier la photo</span>
    					<input type="file" name="image">
    				</div>
    				<div class="file-path-wrapper">
    					<input type="text" class="file-path validate" readonly>
    				</div>
    			</div>
    		</div>

    		<div class="col s6 right-align">
    			<br><br>
    			<button type="submit" class="btn light-green waves-effect waves-light" name="edit_submit">Confirmer</button>
    		</div>
    	</div>
    </form>
  <?php endif ?>
</div>
<script>
$(document).ready(function() {
    $('select').formSelect();
    // Old way
    // $('select').material_select();
});
</script>
