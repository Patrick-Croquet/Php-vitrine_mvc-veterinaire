<?php require 'inc/header.php' ?>
<?php require 'inc/topbar.php' ?> 

<main>
    <div class="container">

        <!-- Dossier -->

        <?php if (empty($this->oAnimal)): ?>
            <h1>Ce dossier n'existe pas !</h1>
        <?php else: ?>

            <article>
                <time datetime="<?=$this->oAnimal->dateNaissance?>" pubdate="pubdate"></time>
                <h1><?=htmlspecialchars($this->oAnimal->nom)?></h1>
                <p>Animal id : <?=nl2br($this->oAnimal->id)?></p> 
                <p>Date de naissance : <?=  date( "d-m-Y", strtotime($this->oAnimal->dateNaissance) ); ?><br>
				<p>Animal race :<?= nl2br($this->oAnimal->race); ?><br>
				<!--<p>Animal race :<?//= nl2br($this->oAnimal->breed); ?><br>
				<p>Type d'animal :<?=  nl2br($this->oAnimal->type); ?><br>-->
                <img src="<?=ROOT_URL?>static/img/animals/<?= $this->oAnimal->photo ?>" class="activator right circle" alt="">
            </article>
            <hr>
              <!--<p><em>Posté le <?//=date('d/m/Y à H:i', strtotime($this->oAnimal->createdDate));?></em></p>-->
            <br>


            <!-- Visites -->

            <h4 id="visite_ink">Visites à la clinique vétérinaire :</h4>
            <?php if (empty($this->oVisites)): ?>
                <p class="bold">Aucune visite n'a été publiée... </p>
            <?php else: ?>

                <?php foreach ($this->oVisites as $oVisite): ?>

                    <blockquote id="blockquote">
                        <strong>Dr. <?= $oVisite->veto_nom ?> <em> (Le <?= date('d/m/Y', strtotime($oVisite->dateVisite)) ?>)</em></strong> 
                        <p><?= $oVisite->raison ?></p>
                        <p><?= nl2br($oVisite->visite); ?></p>
                    </blockquote>
                    <?php if (!empty($_SESSION['is_admin'])): ?>
                        <a href="<?=ROOT_URL?>?p=admin&amp;a=deleteVisite&amp;id=<?=$oVisite->id?>&amp;animalId=<?=$this->oAnimal->id?>"><button class="btn light-green waves-effect waves-light">Supprimer</button></a>
                    <?php endif ?>

                    <?php if(!empty($_SESSION['is_user'])): ?>
                        <?php $color = 'is_signaled'; ?>
                        <?php $aIsSignaled = array(); ?>
                        <?php foreach($this->oUserVotes as $key => $userVote): ?>
                            <?php $aIsSignaled[] = $userVote->visite_id; ?>
                        <?php endforeach ?>
                        <?php if(in_array($oVisite->id ,$aIsSignaled) == false): ?>
                            <?php $color = '' ;?>
                        <?php endif ?>
                        <pre>
      </pre>
                        <form class="vote-form" action="veto_signal_<?=$this->oAnimal->id?>_<?=$oVisite->id?>_1.html" method="POST">
                            <button class="btn red waves-effect waves-light signal-btn <?= $color ?>" type="submit">Signaler</button>
                        </form>
                    <?php endif ?>

                <?php endforeach ?>
            <?php endif ?>
            <br>
            <hr>
            <br>

            <!-- Formulaire -->
            <?php if(empty($_SESSION['is_user']) && empty($_SESSION['is_admin'])): ?>
                <a href="<?=ROOT_URL?>?p=veto&amp;a=login"><button class="btn light-green lighten-2 waves-effect waves-light">Se connecter pour ajouter une visite</button></a>
                <br><br>
            <?php else: ?>
                <h4> Ajouter une visite :</h4>
                <?php require 'inc/msg.php' ?>
                <form method="post">
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea name="visite" id="visite" class="materialize-textarea" maxlength="1200"></textarea>
                            <label for="visite">Visite</label>
                        </div>
                        <div class="col s12">
                            <button type="submit" name="submit_visite" class="btn deep-orange waves-effect waves-light">
                                Ajouter une visite
                            </button>
                        </div>
                    </div>
                </form>
            <?php endif ?>
        <?php endif ?>
    </div>
</main>
<?php require 'inc/footer.php' ?>
