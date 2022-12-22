<?php

namespace VetoPhp\Model;

class Veto
{
  protected $oDb;

  public function __construct()
  {
    $this->oDb = new \VetoPhp\Engine\Db;
  }


  /* ========== SELECT ========== */


  public function get($iOffset, $iLimit)
  {
    //$oStmt = $this->oDb->prepare('SELECT t1.id, t1.dateNaissance, t1.photo, t1.nom, t1.breed, t1.type FROM
    //(SELECT id, nom,dateNaissance,photo,breed,type FROM animal) AS t1 
    // ORDER BY id LIMIT :offset, :limit');
    $oStmt = $this->oDb->prepare('SELECT t1.id, t1.dateNaissance, t1.photo, t1.nom, t2.nom as race FROM (SELECT id, nom, dateNaissance, photo FROM animal) AS t1 INNER JOIN (SELECT A.idAnimal, A.idRace, B.nom FROM chat AS A INNER JOIN race_chat AS B ON A.idRace = B.id UNION SELECT C.idAnimal, C.idRace, D.nom FROM chien AS C 
    INNER JOIN race_chien AS D ON C.idRace = D.id) AS t2 ON t1.id = t2.idAnimal ORDER BY id LIMIT :offset, :limit');
    $oStmt->bindParam(':offset', $iOffset, \PDO::PARAM_INT);
    $oStmt->bindParam(':limit', $iLimit, \PDO::PARAM_INT);
    $oStmt->execute();
    return $oStmt->fetchAll(\PDO::FETCH_OBJ);
  }


  public function getById($iId)
  {
    $oStmt = $this->oDb->prepare('SELECT t1.id, t1.dateNaissance, t1.photo, t1.nom, t2.nom as race FROM 
    (SELECT id, nom, dateNaissance, photo FROM animal) AS t1 INNER JOIN 
    (SELECT idAnimal, nom FROM chat As A INNER JOIN race_chat AS B ON A.idRace = B.id UNION SELECT idAnimal, nom FROM chien As A INNER JOIN race_chien AS B ON A.idRace = B.id order by idAnimal) AS t2 ON t1.id = t2.idAnimal WHERE t1.id = :animalId LIMIT 1 ');
    $oStmt->bindParam(':animalId', $iId, \PDO::PARAM_INT);
    $oStmt->execute();
    return $oStmt->fetch(\PDO::FETCH_OBJ);
  }


	public function getVisites()
	{
		$oStmt = $this->oDb->query("
    SELECT Veterinaire.id,
           Visite.idVeterinaire,
           Visite.raison,
           Visite.idAnimal,
           Visite.dateVisite,
           Visite.signals,
           Veterinaire.nom as veto_nom,
           Veterinaire.prenom as veto_prenom,
           Visite.id
    FROM Visite
    INNER JOIN Veterinaire
    ON Visite.idVeterinaire = Veterinaire.id
    WHERE idAnimal = '{$_GET['id']}'
    ORDER BY dateVisite DESC
       ");
    return $oStmt->fetchAll(\PDO::FETCH_OBJ);
	}

  public function getAll()
  {
    $oStmt = $this->oDb->query('
    SELECT t1.id, t1.dateNaissance, t1.photo, t1.nom, t2.nom as race FROM 
    (SELECT id, nom, dateNaissance, photo FROM animal) AS t1 INNER JOIN 
    (SELECT idAnimal, nom FROM chat As A INNER JOIN race_chat AS B ON A.idRace = B.id 
    UNION 
    SELECT idAnimal, nom FROM chien As A INNER JOIN race_chien AS B ON A.idRace = B.id order by idAnimal) 
    AS t2 ON t1.id = t2.idAnimal');
    
    return $oStmt->fetchAll(\PDO::FETCH_OBJ);
  }


  public function isAdmin($sEmail)
  {
    $oStmt = $this->oDb->prepare('SELECT * FROM Users WHERE email = :email LIMIT 1');
    $oStmt->bindValue(':email', $sEmail, \PDO::PARAM_STR);
    $oStmt->execute();
    return $oStmt->fetch(\PDO::FETCH_OBJ);
  }


  public function login($sEmail, $sPassword)
  {
    $a = [
      'email' 	  => $sEmail,
      'password' 	=> md5($sPassword)
    ];
    $sSql = "SELECT * FROM Users WHERE email = :email AND password = :password";
    $oStmt = $this->oDb->prepare($sSql);
    $oStmt->execute($a);
    $exist = $oStmt->rowCount();

    return $exist;
  }


  public function signalExist($aData)
  {
    $oStmt = $this->oDb->prepare('SELECT * FROM Votes WHERE comment_id = :comment_id AND user_id = :user_id');
    $oStmt->bindValue(':comment_id', $aData['comment_id'], \PDO::PARAM_INT);
    $oStmt->bindValue(':user_id', $aData['user_id'], \PDO::PARAM_STR);
    $oStmt->execute();
    return $oStmt->rowCount();
  }


  public function userVotes($user)
  {
    $oStmt = $this->oDb->prepare('SELECT * FROM Votes WHERE user_id = :user_id');
    $oStmt->bindValue(':user_id', $user, \PDO::PARAM_STR);
    $oStmt->execute();
    return $oStmt->fetchAll(\PDO::FETCH_OBJ);
  }


  public function pseudoTaken($pseudo)
  {
    $oStmt = $this->oDb->prepare('SELECT * FROM Users WHERE pseudo = :pseudo');
    $oStmt->bindParam(':pseudo', $pseudo, \PDO::PARAM_STR);
    $oStmt->execute();
    return $oStmt->rowCount();
  }


  public function emailTaken($sEmail)
  {
    $oStmt = $this->oDb->prepare('SELECT * FROM Users WHERE email = :email');
    $oStmt->bindParam(':email', $sEmail, \PDO::PARAM_STR);
    $oStmt->execute();
    return $oStmt->rowCount();
  }


  public function getUserId($userId)
  {
    $oStmt = $this->oDb->prepare('SELECT id FROM Users WHERE pseudo = :pseudo');
    $oStmt->bindParam(':pseudo', $userId, \PDO::PARAM_STR);
    $oStmt->execute();
    return $oStmt->fetch(\PDO::FETCH_OBJ);
  }


  /* ========== INSERT ========== */


	public function addVisite(array $aData)
	{
		$oStmt = $this->oDb->prepare('INSERT INTO Visite (dateVisite, heureVisite, raison, idDossier, idAnimal, idVeterinaire) VALUES(NOW(), NOW(), :raison, :idDossier, :idAnimal, :idVeterinaire)');
    return $oStmt->execute($aData);
	}


  public function addUser($aData)
  {
    $oStmt = $this->oDb->prepare('INSERT INTO Users (email, pseudo, password) VALUES(:email, :pseudo, :password)');
    return $oStmt->execute($aData);
  }


  public function signalVisite($aData)
  {
    $oStmt = $this->oDb->prepare('SELECT * FROM Visite WHERE id = :visite_id');
    $oStmt->bindValue(':visite_id', $aData['visite_id'], \PDO::PARAM_INT);
    $oStmt->execute();

    if ($oStmt->rowCount() > 0)
    {
      $oStmt = $this->oDb->prepare('INSERT INTO Votes (visite_id, user_id, animal_id, vote) VALUES(:visite_id, :user_id, :animal_id, 1) ');
      $oStmt->execute($aData);
      return true;
    }
    else
    {
      throw new \Exception("Impossible d'enregistrer une visite qui n'existe pas");

    }
  }


  /* ========== UPDATE ========== */


  public function substrSignal($id)
  {
    $oStmt = $this->oDb->exec("UPDATE Visite SET signals = signals - '1' WHERE id='$id'");
  }


  public function addSignal($id)
  {
    $oStmt = $this->oDb->exec("UPDATE Visite SET signals = signals + '1' WHERE id='$id'");
  }


  public function setUnseen($id)
  {
    $oStmt = $this->oDb->exec("UPDATE Visite SET seen = '0' WHERE id='$id'");
  }


  /* ========== DELETE ========== */


  public function deleteUserVote($aData)
  {
    $oStmt = $this->oDb->prepare('DELETE FROM Votes WHERE comment_id = :comment_id AND user_id = :user_id');
    $oStmt->bindParam(':comment_id', $aData['comment_id'], \PDO::PARAM_INT);
    $oStmt->bindParam(':user_id', $aData['user_id'], \PDO::PARAM_STR);
    return $oStmt->execute();
  }


}
