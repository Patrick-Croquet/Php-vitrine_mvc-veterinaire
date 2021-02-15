
<header> 
	<nav class="deep-purple lighten-2">
		<div class="container">
			<div>

				<a href="<?=ROOT_URL?>veto_index.html" class="brand-logo"><img height=30 width=30 src=static/img/logo.png> Clinique Vétérinaire Lila</a>

				<a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>

				<ul class="right hide-on-med-and-down">

					<li class="<?php echo ($_GET['a']=="index")?"active" : ""; ?>"><a href="<?=ROOT_URL?>veto_index.html">Accueil<i class="material-icons right">home</i></a></li>
					<li class="<?php echo ($_GET['a']=="dossiers")?"active" : ""; ?>"><a href="<?=ROOT_URL?>veto_dossiers.html">Dossiers<i class="material-icons right">pages</i></a></li>

					<?php if (empty($_SESSION['is_admin']) && empty($_SESSION['is_user'])): ?>
					<li><a href="<?=ROOT_URL?>veto_login.html" class="btn grey waves-effect waves-light">Connexion<i class="material-icons right">lock_open</i></a></li>
					<?php endif ?>

					<?php if (!empty($_SESSION['is_admin'])): ?>
					<li class="<?php echo ($_GET['a']=="dashboard")?"active" : ""; ?>"><a href="<?=ROOT_URL?>admin_dashboard.html"><i class="material-icons">dashboard</i></a></li>
					<?php endif ?>

					<?php if (!empty($_SESSION['is_admin'])): ?>
					<li class="<?php echo ($_GET['a']=="edit")?"active" : ""; ?>"><a href="<?=ROOT_URL?>admin_edit.html"><i class="material-icons">edit</i></a></li>
					<?php endif ?>

					<?php if (!empty($_SESSION['is_admin']) || !empty($_SESSION['is_user'])): ?>
					<li><a href="<?=ROOT_URL?>?p=veto&amp;a=logout" class="btn light-green waves-effect waves-light">Déconnexion<i class="material-icons right">lock_outline</i></a></li>
					<?php endif ?>
				</ul>

				<ul class="side-nav" id="mobile-menu">

					<li class="<?php echo ($_GET['a']=="index")?"active" : ""; ?>"><a href="<?=ROOT_URL?>veto_index.html">Accueil</a></li>
					<li class="<?php echo ($_GET['a']=="dossiers")?"active" : ""; ?>"><a href="<?=ROOT_URL?>veto_dossiers.html">Dossiers</a></li>

					<?php if (empty($_SESSION['is_admin']) && empty($_SESSION['is_user'])): ?>
					<li class="<?php echo ($_GET['a']=="login")?"active" : ""; ?>"><a href="<?=ROOT_URL?>veto_login.html">Connexion</a></li>
					<?php endif ?>

					<?php if (!empty($_SESSION['is_admin'])): ?>
					<li class="<?php echo ($_GET['a']=="dashboard")?"active" : ""; ?>"><a href="<?=ROOT_URL?>admin_login.html">Dashboard</a></li>
					<?php endif ?>

					<?php if (!empty($_SESSION['is_admin'])): ?>
					<li class="<?php echo ($_GET['a']=="edit")?"active" : ""; ?>"><a href="<?=ROOT_URL?>admin_edit.html">Edition</a></li>
					<?php endif ?>

					<?php if (!empty($_SESSION['is_admin']) || !empty($_SESSION['is_user'])): ?>
					<li><a href="<?=ROOT_URL?>?p=veto&amp;a=logout">Déconnexion</a></li>
					<?php endif ?>
				</ul>

			</div>
		</div>
	</nav>
</header>
