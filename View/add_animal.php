<?php require 'inc/header.php' ?>
<?php require 'inc/topbar.php' ?>

<div class="container">
  <h1>Ajouter un dossier d'animal</h1>
  <?php require 'inc/msg.php' ?>
  <form method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="input-field col s12">
			<input type="text" name="nom" id="nom" required="required">
			<label for="nom">Nom de l'animal</label>
		</div>

		<!--<div class="input-field col s12">
			<input type="text" name="animal" id="animal" required="required">
			<select name="animal" id="animal-select">
				<option value="chien">Chien</option>
				<option value="chat">Chat</option>
				<option value="oiseau">Oiseau</option>
			</select>
			<label for="animal">Type d'animal</label>
		
		</div>-->

		<div class="input-field col s12">
			<input type="date" name="dateNaissance" id="dateNaissance" required="required">
			<label for="date">Date de Naissance</label>
		</div>
		
		<!--<div>
			<input type="text" name="race" id="race" required="required">
			<select name="race" id="race-select">
					<option value="1">Terrier</option>
					<option value="2">Berger Allemand</option>
					<option value="3">Border Collie</option>
			</select>
			<label for="race">Race</label>
		</div>-->

		<!--<div class="input-field col s12">
			<input type="text" name="breed" id="breed" required="required">
			<label for="breed">Race</label>
		</div>-->

		   <!--<div class="input-field col s12">
      <label for="editable">Contenu de l'article</label>
      <br><br>
			<textarea name="body" id="editable"></textarea>
		</div>-->

		<div class="col s12">
			<div class="input-field file-field">
				<div class="btn">
					<span>Photo de l'animal</span>
					<input type="file" name="photo">
				</div>
				<div class="file-path-wrapper">
					<input type="text" class="file-path validate" readonly>
				</div>
			</div>
		</div>

		<div class="col s12 right-align">
			<br><br>
			<button class="btn waves-effect waves-light" type="submit" name="add_submit">Publier</button>
		</div>
	</div>
</form>
</div>
