<?php require 'inc/header.php' ?>
<?php require 'inc/topbar.php' ?>
<main>
  <div class="container">
    <h1 class="page-title">Les animaux de la clinique</h1> 
    <?php foreach ($this->oAnimals as $oAnimal): ?>
      <div class="row">
        <hr>
  			<div class="col s12 m12 l12">
  				<h4><?= $oAnimal->nom ?></h4>
  				<div class="row">
  					<div class="col s12 m6 l8">
              <!-- On affiche les 1200 premiers caractères et on affiche pas les images -->
  						<p>Date de naissance : <?= preg_replace("/<img[^>]+\>/i", "", nl2br(mb_strimwidth($oAnimal->dateNaissance, 0, 800, '...'))); ?><br>
						<p>Animal id :<?= preg_replace("/<img[^>]+\>/i", "", nl2br(mb_strimwidth($oAnimal->id, 0, 800, '...'))); ?><br>
						<p>Animal race :<?= preg_replace("/<img[^>]+\>/i", "", nl2br(mb_strimwidth($oAnimal->race, 0, 800, '...'))); ?><br>
						<!--<p>Type d'animal :<?//= preg_replace("/<img[^>]+\>/i", "", nl2br(mb_strimwidth($oAnimal->type, 0, 800, '...'))); ?><br>-->


              <br><br>
              <?php require 'inc/control_buttons.php' ?>
  					</div>
  					<div class="col s12 m6 l4">
  						<img src="<?=ROOT_URL?>static/img/posts/<?= $oAnimal->photo ?>" class="materialboxed responsive-img" alt="<?= $oAnimal->nom ?>"/>
  						<br/><br/>
  				  	<a class="btn deep-purple lighten-2 waves-effect waves-light" href="<?=ROOT_URL?>blog_post_<?=$oAnimal->id?>.html">Consulter</a>
  					</div>
  				</div>
  			</div>
  		</div>
    <?php endforeach ?>
  </div>
</main>
<?php require 'inc/footer.php' ?>

