<?php require 'inc/header.php' ?>
<?php require 'inc/topbar.php' ?>

<main class="test">
  <div class="container">
    <?php if (empty($this->oAnimals)): ?>
        <h1>Il n'y a aucun animal.</h1>
        <p><button type="button" onclick="window.location='<?=ROOT_URL?>admin_add.html'" class="btn waves-effect waves-light">Ajoutez votre premier animal !</button></p>
    <?php else: ?>
      
    <h1 class="page-nom deep-purple-text text-lighten-2">Clinique Vétérinaire Lila </h1>
    <div class="p-4 p-md-5 mb-4 text-black rounded">
    <div class="container col m6 px-0"><img class="materialboxed responsive-img" src="static/img/slider/SLIDER-1.jpg">
      <h3 class="deep-purple-text text-lighten-2">Bienvenue chez Clinique Vétérinaire Lila</h3>
      <p class="lead my-3">Ce site s'adresse à tous les propriétaires d'animaux (chiens, chats, furets, lapins, oiseaux) à la recherche d'une clinique vétérinaire accueillante, animée par un personnel compétent et dynamique, et dotée d'un matériel récent et performant!

Vous trouverez dans ces pages, les informations qui vous permettront de découvrir la clinique et son équipe, ainsi que tous les renseignements nécessaires pour nous contacter et venir nous rendre visite.</p>
      <!--<p class="lead mb-0"><a href="<?=ROOT_URL?>veto_chapters.html" class="text-black fw-bold"> Voir les articles...</a></p>-->
    </div></div></br>


  <div class="row">

      <!-- ANIMAL CARDS -->

      <?php foreach ($this->oAnimals as $oAnimal): ?>
        <div class="col l4 m6 s12">
          <div class="card hoverable">
            <div class="card-content">
              <h5><a class="grey-text text-darken-2" href="<?=ROOT_URL?>veto_animal_<?=$oAnimal->id?>.html"><?=htmlspecialchars($oAnimal->nom)?></a></h5>
               <!-- <h6 class="grey-text">Animal id <?//=date('d/m/Y à H:i', strtotime($oAnimal->id));?></h6> -->
            </div>
            <div class="card-image waves-effect waves-block waves-light">
    					<img src="<?=ROOT_URL?>static/img/animals/<?= $oAnimal->photo?>" class="activator" alt="<?= $oAnimal->nom ?>">
    				</div>
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>
              <p><a href="<?=ROOT_URL?>veto_animal_<?=$oAnimal->id?>.html">Voir le dossier</a></p>
            </div>
            <div class="card-reveal">
    					<span class="card-title grey-text text-darken-4"><?= $oAnimal->nom ?><i class="material-icons right">close</i></span>
    					<p>Date de naissance : <br />
              <?= date( "d-m-Y", strtotime($oAnimal->dateNaissance) );?>
              </p>
    				</div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</main>
<?php endif ?>
<?php require 'inc/footer.php' ?>
