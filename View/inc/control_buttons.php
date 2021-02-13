<?php if(!empty($_SESSION['is_admin'])): ?>

  <a href="<?=ROOT_URL?>admin_editPost_<?=$oAnimal->id?>.html"><button class="btn grey lighten-1 waves-effect waves-light">Modifier</button></a>
  <a href="<?=ROOT_URL?>admin_delete_<?=$oAnimal->id?>.html"><button class="btn light-green waves-effect waves-light">Supprimer</button></a>

<?php endif ?>
