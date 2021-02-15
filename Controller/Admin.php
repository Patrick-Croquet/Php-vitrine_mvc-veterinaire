<?php

namespace VetoPhp\Controller;

class Admin extends Veto
{

    /* ================ ACTIONS AVEC VUS ================ */

    // Récupère les données de tous les animaux puis affiche la page edit.php
    public function edit()
    {
      if (!$this->isLogged())
      header('Location: veto_index.html');

      $this->oUtil->oAnimals = $this->oModel->getAll();
      $this->oUtil->getView('edit');
    }

    // Affiche la page d'édition du dossier
    // Suite à l'envoie du formulaire, on récupère les données saisies puis on update les données de l'animal".
    // Si on modifie la photo associée, on vérifie que l'extension existe (jpg, png ...)
    public function editAnimal()
    {
      if (!$this->isLogged())
      header('Location: veto_index.html');

      if (isset($_POST['edit_submit']))
      {
        if (empty($_POST['nom']))
        {
          $this->oUtil->sErrMsg = 'Tous les champs doivent être remplis.';
        }
        else
        {
          $this->oUtil->getModel('Admin');
          $this->oModel = new \VetoPhp\Model\Admin;

          $aData = array('animal_id' => $_GET['id'], 'nom' => $_POST['nom']);
          $this->oModel->update($aData);

          if (!empty($_FILES['photo']['name']))
          {
            $file = $_FILES['photo']['name'];
            $extensions = ['.png','.jpg','.jpeg','.gif','.PNG','.JPG','.JPEG','.GIF'];
            $extension = strrchr($file, '.');
            $id = $_GET['id'];
            if(!in_array($extension,$extensions)){
              $this->oUtil->sErrMsg = "Cette photo n'est pas valable";
            }
            $this->oModel->updateImg($_FILES['photo']['name'], $_GET['id'], $_FILES['photo']['tmp_name']);
          }

          $this->oUtil->sSuccMsg = 'Le dossier a bien été mis à jour !';

        }
      }

      /* Récupère les données de l'animal */
      $this->oUtil->oAnimal = $this->oModel->getById($_GET['id']);

      $this->oUtil->getView('edit_animal');
    }

    // Affiche la page add_animal.php
    // Suite à l'envoie du formulaire, on récupère les données et on les insert dans la table animal
    // Si il n'y a pas de photo associée, alors la photo de base sera post.png
    public function add()
    {
      if (!$this->isLogged())
      header('Location: veto_index.html');

      if (isset($_POST['add_submit']))
      {
          if (empty($_POST['nom']))
          {
            $this->oUtil->sErrMsg = 'Tous les champs doivent être remplis 2.';
          }
          else
          {
            $this->oUtil->getModel('Admin');
            $this->oModel = new \VetoPhp\Model\Admin;

            $aData = array('nom' => $_POST['nom']);
            $this->oModel->add($aData);

            if (!empty($_FILES['photo']['name']))
            {
              $file = $_FILES['photo']['name'];
              $extensions = ['.png','.jpg','.jpeg','.gif','.PNG','.JPG','.JPEG','.GIF'];
              $extension = strrchr($file, '.');
              if(!in_array($extension,$extensions)){
        				  $this->oUtil->sErrMsg = "Cette photo n'est pas valable";
        			}
              $this->oModel->animalImg($_FILES['photo']['tmp_name'], $extension);
            }

            $this->oUtil->sSuccMsg = 'Le dossier a bien été ajouté !';
          }
      }

      $this->oUtil->getView('add_animal');
    }

    // On affiche la page dashboard.php
    // On définit les tables qui seront affichées sur la page ainsi que leur couleur
    // On obtient les commentaires non-signalés, les commentaires signalés et le nombre de signalements
    public function dashboard()
    {
      if (!$this->isLogged())
      header('Location: veto_index.html');

      $this->oUtil->getModel('Admin');
      $this->oModel = new \VetoPhp\Model\Admin;

      $tables = [
      	'Animaux' 	      	     => 'Animal',
      	'Visites' 	  	         => 'Visite',
      	'Vétérinaires' 	         => 'Users',
        'Prescriptions'           => 'Votes'
      ];

      $colors = [
      	'Animal'				         => 'green',
      	'Visite' 		  	         => 'brown',
      	'Users' 			           => 'blue',
        'Votes'                  => 'red'
      ];

      $this->oUtil->aColors = array();
      $this->oUtil->aInTable = array();
      $this->oUtil->aTableName = array();



      foreach ($tables as $table_name => $table)
      {
        $this->oUtil->aColors[] = $this->getColor($table,$colors);
        $this->oUtil->aInTable[] = $this->oModel->inTable($table);
        $this->oUtil->aTableName[] = $table_name;
      }

      $this->oUtil->length = count($this->oUtil->aTableName);

      $this->oUtil->oVisites = $this->oModel->getVisitesUnseen();

      $this->oUtil->oSignaledVisites = $this->oModel->getSignaledVisites();

      $this->oUtil->aNbrSignals = $this->oModel->getNbrSignals();

      $this->oUtil->getView('dashboard');
    }




    /* ================ ACTIONS SANS VUS ================ */




    // On supprime le post ainsi que les commentaires associés à ce post et les signalements de ces commentaires
    // On supprime l'animal ainsi que les commentaires associés à cet animal et les signalements de ces commentaires
    public function delete()
    {
      if (!$this->isLogged())
      header('Location: veto_index.html');

      $this->oUtil->getModel('Admin');
      $this->oModel = new \VetoPhp\Model\Admin;

      $this->oModel->deleteVisites($_GET['id']); // supprime les visites de l'animal
      $this->oModel->deleteVotes($_GET['id']);// supprime les médicaments des visites de l'animal
      $this->oModel->delete($_GET['id']); // supprime l'animal

      header('Location: admin_edit.html');
    }

    // On update la visite en mettant "vu"
    public function seeVisiteJs()
    {
      if (!$this->isLogged())
      header('Location: veto_index.html');

      $this->oUtil->getModel('Admin');
      $this->oModel = new \VetoPhp\Model\Admin;

      $this->oModel->see_visite();
    }

    // On supprime la visite ainsi que les médicaments associés
    public function deleteVisiteJs()
    {
      if (!$this->isLogged())
      header('Location: veto_index.html');

      $this->oUtil->getModel('Admin');
      $this->oModel = new \VetoPhp\Model\Admin;

      $this->oModel->delete_visite();
      $this->oModel->deleteVotes($_GET['id']);
    }

    //On supprime le commentaire ainsi que les signalements associés
    //On supprime la visite ainsi que les médicaments associés
    public function deleteVisite()
    {
      if (!$this->isLogged())
      header('Location: veto_index.html');

      $oAnimal = $this->oUtil->oAnimal = $this->oModel->getById($_GET['animalid']); // Récupère les données de l'animal
      $this->oUtil->getModel('Admin');
      $this->oModel = new \VetoPhp\Model\Admin;

      $iId = $_GET['id'];
      $this->oModel->deleteVisite($iId); // supprime la visite
      $this->oModel->deleteVote($iId); // supprime les médicaments de la visite

      header("Location: veto_animal_$oAnimal->id.html");
    }

    // On obtient la couleur associé à chaque table
    private function getColor($aTable,$sColors)
    {
      if(isset($sColors[$aTable])){
  			return $sColors[$aTable];
  		}else {
  			return "orange";
  		}
    }

}
