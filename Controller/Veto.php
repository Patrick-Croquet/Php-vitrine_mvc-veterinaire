<?php

namespace VetoPhp\Controller;

if (empty($_GET['a'])) {
	$_GET['a'] = 'index';
}

class Veto
{
  const MAX_POSTS = 10;

  protected $oUtil, $oModel;
  private $_iId;

  public function __construct()
  {
    // Active la session
    if (empty($_SESSION))
        @session_start();

    $this->oUtil = new \VetoPhp\Engine\Util;

    /** Récupère la classe Model dans toute la class controller **/
    $this->oUtil->getModel('Veto');
    $this->oModel = new \VetoPhp\Model\Veto;

    /** Récupère l'identifiant de publication dans le constructeur afin d'éviter la duplication du même code **/
    $this->_iId = (int) (!empty($_GET['id']) ? $_GET['id'] : 0);
  }

	/* ================ ACTIONS AVEC VUS ================ */

  // On obtient seulement les X derniers posts puis on affiche index.php
  // On obtient seulement les X derniers animaux puis on affiche index.php
  public function index()
  {
      $this->oUtil->oAnimals = $this->oModel->get(0, self::MAX_POSTS);

      $this->oUtil->getView('index');
  }

  // Page 404
  public function notFound()
  {
	  header('HTTP/1.0 404 Not Found');
      $this->oUtil->getView('not_found');
  }

	// Récupère les données du post, les commentaires associés puis affiche la page post.php
	// Récupère les données de l'animal, les visites associées puis affiche la page animal.php
  public function animal()
  {
    if(empty($_GET['id']))
    {
      header('Location: veto_index.html');
    }

    $this->oUtil->oAnimal = $this->oModel->getById($this->_iId);
	  $this->oUtil->oVisites = $this->oModel->getVisites();
		$getUserId = $this->oModel->getUserId(current($_SESSION));

  	if (isset($_POST['submit_comment']))
    {
        if (empty($_POST['comment']))
        {
          $this->oUtil->sErrMsg = 'Vous n\'avez pas prescrit de médicament';
        }
        else
        {
          $aData = array('user_id' => $getUserId->id, 'comment' => htmlspecialchars($_POST['comment']), 'animal_id' => $_GET['id']);
          $this->oModel->addComment($aData);
          ?> <script>window.location.replace('Veto_animal_<?= $_GET['id'] ?>.html');</script> <?php
          $this->oUtil->sSuccMsg = 'Le médicament a été prescrit !';
        }
    }

		$this->oUtil->oUserVotes = $this->oModel->userVotes(current($_SESSION));

    $this->oUtil->getView('animal');
  }

	// On obtient tous les posts puis on affiche la page chapters.php
	// On obtient tous les animaux puis on affiche la page dossiers.php
  public function dossiers()
  {
    $this->oUtil->oAnimals = $this->oModel->getAll();

    $this->oUtil->getView('dossiers');
  }


	// Affiche la page login.php puis suite à l'envoie du formulaire, on vérifie si l'email et le mdp correspondent, puis connecte en tant qu'admin ou user selon le mail.
	public function login()
	{
			if ($this->isLogged())
					header('Location: ' . ROOT_URL . 'veto_index.html');

			if (isset($_POST['submit']))
			{
				$sEmail = htmlspecialchars(trim($_POST['email']));
				$sPassword = htmlspecialchars(trim($_POST['password']));
				$oIsAdmin = $this->oModel->isAdmin($_POST['email']);

				if (empty($sEmail) || empty($sPassword))
				{
					$this->oUtil->sErrMsg = "Tous les champs n'ont pas été remplis !";
				}
				elseif($this->oModel->login($sEmail, $sPassword) == 0)
				{
					$this->oUtil->sErrMsg = "Identifiant ou mot de passe incorrect!";
				}
				else
				{
					if ($oIsAdmin->admin != null)
					{
						$_SESSION['is_admin'] = $oIsAdmin->pseudo; // Admin est connecté maintenant
						header('Location: ' . ROOT_URL . 'veto_index.html');
						exit;
					}
					else
					{
						$_SESSION['is_user'] = $oIsAdmin->pseudo; // user est connecté maintenant
						header('Location: ' . ROOT_URL . 'veto_index.html');
						exit;
					}
				}
			}

			$this->oUtil->getView('login');
	}

	// Affiche la page registration.php
	// Suite à l'envoie du formulaire, si il n'y a pas d'erreurs alors on enregistre le nouvel utilisateur pusi redirige vers la page login.php
	public function registration()
	{
		if ($this->isLogged())
			header('Location: veto_index.html');

		if (isset($_POST['submit']))
		{
			$sPassword = htmlspecialchars(trim($_POST['password']));
      		$sPassword_again = htmlspecialchars(trim($_POST['password_again']));
			$sEmail = htmlspecialchars(trim($_POST['email']));
			$sPseudo = htmlspecialchars(trim($_POST['pseudo']));

			if (empty($sPassword) || empty($sPassword_again))
			{
				$this->oUtil->sErrMsg = "Tous les champs n'ont pas été remplis";
			}

			elseif ($sPassword != $sPassword_again)
			{
				$this->oUtil->sErrMsg = "Les mots de passe sont différents";
			}

			elseif ($this->oModel->emailTaken($sEmail))
			{
				$this->oUtil->sErrMsg = "Cette adresse email est déjà utilisée";
			}

			elseif ($this->oModel->pseudoTaken($sPseudo))
			{
				$this->oUtil->sErrMsg = "Ce pseudo est déjà utilisé";
			}

			else
			{
				$aData = array('email' => $sEmail, 'pseudo' => $sPseudo, 'password' => md5($sPassword));
				$this->oModel->addUser($aData);
				?> <script>window.location.replace('veto_login.html');</script> <?php
				$this->oUtil->sSuccMsg = 'Votre compte a été créé, vous pouvez maintenant vous connecter';
			}

		}

		$this->oUtil->getView('registration');
	}



	public function legalNotice()
	{
    $this->oUtil->getView('legalNotice');
	}



	/* ================ ACTIONS SANS VUS ================ */



	// si admin est connecté return true
	protected function isLogged()
	{
		return !empty($_SESSION['is_admin']);
	}


	// si user est connecté return true
	protected function userIsLogged()
	{
		return !empty($_SESSION['is_user']);
	}


	// Si il y a une session, la détruit pour déconnecter l'admin
	public function logout()
	{
		if (!$this->isLogged())
			header('Location: veto_index.html');

		if (!empty($_SESSION))
		{
			$_SESSION = array();
			session_unset();
			session_destroy();
		}

		// Redirection à la page d'accueil
		header('Location: ' . ROOT_URL);
		exit;
	}


	// Suite à l'envoie du formulaire, on insert dans la table Votes un signalement, si le signalement existe déja alors on le supprime
	public function signal ()
	{
		if ($this->userIsLogged())
			header('Location: veto_index.html');

		if ($_SERVER['REQUEST_METHOD'] != 'POST')
		{
			http_response_code(403);
			die();
		}

		if ($_GET['vote'] == 1)
		{
			$aData = array('comment_id' => $_GET['commentId'], 'user_id' => current($_SESSION), 'animal_id' =>$_GET['animalid']);

			if ($this->oModel->signalExist($aData) > 0)
			{
				$this->oModel->deleteUserVote($aData);
				$this->oModel->substrSignal($_GET['commentId']);
			}
			else
			{
				$this->oModel->signalComment($aData);
				$this->oModel->addSignal($_GET['commentId']);
				$this->oModel->setUnseen($_GET['commentId']);
			}

		}
		else
		{
			$this->oUtil->getView('not_found');
		}
		header('Location: ' . ROOT_URL . 'veto_animal_' . $_GET['animalid'] . '.html#comment_ink');
	}


}
