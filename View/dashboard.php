<?php require 'inc/header.php' ?>
<?php require 'inc/topbar.php' ?>

<div class="container">
  <h2>Tableau de bord</h2>
  <div class="row">
    <?php for($i=0;$i<$this->length;$i++): ?>
			<div class="col l4 m3 s12">
				<div class="card">
					<div class="card-content <?= $this->aColors[$i] ?> white-text">
						<span class="card-title"><?= $this->aTableName[$i] ?></span>
						<h4><?= $this->aInTable[$i][0] ?></h4>
					</div>
				</div>
			</div>
    <?php endfor ?>
  </div>

  <!-- ============================== -->

  <h4>Visites non enregistrées</h4>
  <br>
  <div class="row white z-depth-3">
    <div class="col s12">
      <ul class="tabs tabs-fixed-width">
        <li class="tab"><a class="" href="#notSignaled"><strong>Non enregistrées</strong></a></li>
        <li class="tab"><a class="<?php echo ($this->aNbrSignals[0] > 0)?"active" : ""; ?>" href="#signaled"><strong>Enregistrées</strong></a></li>
      </ul>
    </div>
    <div id="notSignaled" class="col s12">
      <table class="centered bordered ">
      	<thead>
      		<tr>
      			<th>Dossier</th>
				<th>Vétérinaire</th>
      			<th>Raison de la visite</th>
      			<th>Actions</th>
      		</tr>
      	</thead>
      	<tbody>
      		<?php if(!empty($this->oVisites)): ?>
      			<?php foreach($this->oVisites as $visite): ?>
      				<tr id="visite_<?= $visite->id ?>">
      					<td><a href="veto_animal_<?=$visite->animal_id?>.html"><strong><?= $visite->animal_nom ?></strong></a></td>
						<td>Dr. <?= substr($visite->veto_prenom,0,100) . ' ' . substr($visite->veto_nom,0,100); ?></td>
      					<td><?= substr($visite->raison,0,100); ?></td>
      					<td>
      						<a id="<?= $visite->id ?>" class="btn-floating btn-small waves-effect waves-light green see_visite"><i class="material-icons">done</i></a>
      						<a id="<?= $visite->id ?>" class="btn-floating btn-small waves-effect waves-light red delete_visite"><i class="material-icons">delete</i></a>
      						<a href="#visite_<?= $visite->id ?>" class="btn-floating btn-small waves-effect waves-light blue modal-trigger"><i class="material-icons">more_vert</i></a>
      						<div class="modal" id="visite_<?= $visite->id ?>">
      							<div class="modal-content">
      								<h4><?= $visite->animal_nom ?></h4>
      								<p>Visite effectuée par <strong>Dr. <?= $visite->veto_prenom . ' ' . $visite->veto_nom.'</strong><br/>Le '.date('d/m/y', strtotime($visite->dateVisite)) ?></p>
      								<hr>
      								<p><?= nl2br($visite->raison) ?></p>
      							</div>
      							<div class="modal-footer">
      								<a id="<?= $visite->id ?>" class="modal-action modal-close waves-effect waves-green btn-flat see_visite"><i class="material-icons">done</i></a>
      								<a id="<?= $visite->id ?>" class="modal-action modal-close waves-effect waves-red btn-flat delete_visite"><i class="material-icons">delete</i></a>
      							</div>
      						</div>
      					</td>
      				</tr>
            <?php endforeach ?>
      		<?php else :?>
            <tr>
              <td></td>
              <td>Aucune prescription à valider</td>
              <td></td>
            </tr>
          <?php endif ?>
      	</tbody>
      </table>
    </div>
    <div id="signaled" class="col s12">
      <table class="centered bordered ">
      	<thead>
      		<tr>
			    <th>Dossier</th>
				<th>Vétérinaire</th>
				<th>Raison de la visite</th>
            	<th>Signalements</th>
      			<th>Actions</th>
      		</tr>
      	</thead>
      	<tbody>
      		<?php if(!empty($this->oSignaledVisites)): ?>
      			<?php foreach($this->oSignaledVisites as $signaledVisite): ?>
      				<tr id="comment_<?= $signaledVisite->id ?>">
      					<td><a href="veto_animal_<?=$signaledVisite->animal_id?>.html"><strong><?= $signaledVisite->animal_nom ?></strong></a></td>
      					<td>Dr. <?= substr($visite->veto_prenom,0,100) . ' ' . substr($visite->veto_nom,0,100); ?></td>
						<td><?= substr($signaledVisite->raison,0,100); ?></td>
                <td><?= $signaledVisite->signals ?></td>
      					<td>
      						<a id="<?= $signaledVisite->id ?>" class="btn-floating btn-small waves-effect waves-light green see_visite"><i class="material-icons">done</i></a>
      						<a id="<?= $signaledVisite->id ?>" class="btn-floating btn-small waves-effect waves-light red delete_visite"><i class="material-icons">delete</i></a>
      						<a href="#visite_<?= $signaledVisite->id ?>" class="btn-floating btn-small waves-effect waves-light blue modal-trigger"><i class="material-icons">more_vert</i></a>
      						<div class="modal" id="comment_<?= $signaledVisite->id ?>">
      							<div class="modal-content">
      								<h4><?= $signaledVisite->animal_nom ?></h4>
      								<p>Visite effectuée par <strong>Dr. <?= $signaledVisite->veto_prenom . ' ' . $signaledVisite->veto_nom . '</strong><br/>Le '.date('d/m/y', strtotime($signaledVisite->dateVisite)) ?></p>
      								<hr>
      								<p><?= nl2br($signaledVisite->raison) ?></p>
      							</div>
      							<div class="modal-footer">
      								<a id="<?= $signaledVisite->id ?>" class="modal-action modal-close waves-effect waves-green btn-flat see_visite"><i class="material-icons">done</i></a>
      								<a id="<?= $signaledVisite->id ?>" class="modal-action modal-close waves-effect waves-red btn-flat delete_visite"><i class="material-icons">delete</i></a>
      							</div>
      						</div>
      					</td>
      				</tr>
            <?php endforeach ?>
      		<?php else :?>
      				<tr>
                <td></td>
      					<td>Aucune visite à valider</td>
                <td></td>
                <td></td>
      				</tr>
          <?php endif ?>
      	</tbody>
      </table>
    </div>
  </div>




</div>
