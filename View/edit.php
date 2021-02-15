<?php require 'inc/header.php' ?>
<?php require 'inc/topbar.php' ?>

<div class="container">
  <?php if (empty($this->oAnimals)): ?>
    <h1>Il n'y a aucun dossier.</h1>
    <p><button type="button" onclick="window.location='<?=ROOT_URL?>admin_add.html'" class="btn waves-effect waves-light">Ajoutez votre premier dossier !</button></p>
  <?php else: ?>
  <h1>Les dossiers de la clinique</h1>
  <a href="<?=ROOT_URL?>admin_add.html"><button class="btn light-blue waves-effect waves-light">Ajouter un dossier </button></a>
  <br>
  <br>
  <hr>

  <table class="striped">
    <thead>
      <tr>
          <th>Nom</th>
          <th>Date de naissance</th>
          <th>Action</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($this->oAnimals as $oAnimal): ?>
        <tr>
          <td><a href="veto_animal_<?=$oAnimal->id?>.html"><strong><?= $oAnimal->nom ?></strong></a></td>
          <td><?= date('d/m/Y', strtotime($oAnimal->dateNaissance)); ?></td>
          <td>
            <?php require 'inc/control_buttons.php' ?>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
<?php endif ?>
