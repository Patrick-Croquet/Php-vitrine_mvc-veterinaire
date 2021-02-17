<?php

namespace VetoPhp\Model;

class Admin extends Veto
{

  /* ========== SELECT ========== */


  public function inTable($sTable)
  {
    $oStmt = $this->oDb->query("SELECT COUNT(id) FROM $sTable");
    return $oStmt->fetch();
  }


  public function getVisitesUnseen()
  {
    $oStmt = $this->oDb->query("
      SELECT  Visite.id,
              Visite.dateVisite,
              Visite.heureVisite,
              Visite.raison,
              Animal.id as animal_id,
              Animal.nom as animal_nom,
              Veterinaire.nom as veto_nom,
              Veterinaire.prenom as veto_prenom
      FROM Visite
      INNER JOIN Animal
      ON Visite.idAnimal = Animal.id
      INNER JOIN Veterinaire
      ON Visite.idVeterinaire = Veterinaire.id
      WHERE Visite.seen = '0'
      AND Visite.signals = '0'
      ORDER BY Visite.dateVisite ASC
    ");

    $results = [];

    while($rows = $oStmt->fetchObject())
    {
      $results[] = $rows;
    }
    return $results;
  }


  public function getSignaledVisites()
  {
    $oStmt = $this->oDb->query("
    SELECT  Visite.id,
              Visite.dateVisite,
              Visite.heureVisite,
              Visite.raison,
              Animal.id as animal_id,
              Animal.nom as animal_nom,
              Veterinaire.nom as veto_nom,
              Veterinaire.prenom as veto_prenom
      FROM Visite
      INNER JOIN Animal
      ON Visite.idAnimal = Animal.id
      INNER JOIN Veterinaire
      ON Visite.idVeterinaire = Veterinaire.id
      WHERE Visite.seen = '0'
      AND Visite.signals > '0'
      ORDER BY Visite.signals
    ");

    $results = [];

    while($rows = $oStmt->fetchObject())
    {
      $results[] = $rows;
    }
    return $results;
  }


  public function getNbrSignals()
  {
    $oStmt = $this->oDb->query("SELECT COUNT(id) FROM Votes");
    return $oStmt->fetch();
  }


  /* ========== UPDATE ========== */


    public function update(array $aData)
    {
      $oStmt = $this->oDb->prepare('UPDATE Animals SET nom = :nom WHERE id = :animalId LIMIT 1');
      $oStmt->bindValue(':animalId', $aData['animal_id'], \PDO::PARAM_INT);
      $oStmt->bindValue(':nom', $aData['nom'], \PDO::PARAM_STR);
      return $oStmt->execute();
    }


    public function updateImg($name, $id, $tmp_name)
    {
      $i = [
        'id'     => $id,
        'photo'  => $name
      ];

      $oStmt = $this->oDb->prepare('UPDATE Animal SET photo = :photo WHERE id = :id');
      move_uploaded_file($tmp_name,"static/img/animals/".$i['photo']);
      return $oStmt->execute($i);
    }


    public function animalImg($tmp_name, $extension)
    {
      $i = [
        'id'     => $this->oDb->lastInsertId(),
        'photo'  => $this->oDb->lastInsertId().$extension
      ];

      $oStmt = $this->oDb->prepare('UPDATE Animal SET photo = :photo WHERE id = :id');
      move_uploaded_file($tmp_name,"static/img/animals/".$i['photo']);
      return $oStmt->execute($i);
    }


    public function see_visite()
    {
      $oStmt = $this->oDb->exec("UPDATE Visite SET seen = '1' WHERE id='{$_POST['id']}'");
      //$oStmt = $this->oDb->exec("DELETE FROM Prescrire WHERE idVisite = {$_POST['id']}");
      $oStmt = $this->oDb->exec("UPDATE Visite SET signals = '0' WHERE id='{$_POST['id']}'");
    }


//     /* ========== DELETE ========== */


    public function delete($iId)
    {
      $oStmt = $this->oDb->prepare('DELETE FROM Animal WHERE id = :animalId LIMIT 1');
      $oStmt->bindParam(':animalId', $iId, \PDO::PARAM_INT);
      return $oStmt->execute();
    }


    public function deleteVisites($iId){
      $oStmt = $this->oDb->prepare('DELETE FROM Visite WHERE animal_id = :animalId');
      $oStmt->bindParam(':animalId', $iId, \PDO::PARAM_INT);
      return $oStmt->execute();
    }


    public function deleteVotes($iId){
      $oStmt = $this->oDb->prepare('DELETE FROM Votes WHERE animal_id = :animalId');
      $oStmt->bindParam(':animalId', $iId, \PDO::PARAM_INT);
      return $oStmt->execute();
    }


    public function deleteVisite($iId)
    {
      $oStmt = $this->oDb->prepare('DELETE FROM Visite WHERE id = :id');
      $oStmt->bindParam(':id', $iId, \PDO::PARAM_INT);
      return $oStmt->execute();
    }


    public function deleteVote($iId)
    {
      $oStmt = $this->oDb->prepare('DELETE FROM Votes WHERE comment_id = :comment_id');
      $oStmt->bindParam(':comment_id', $iId, \PDO::PARAM_INT);
      return $oStmt->execute();
    }


    public function delete_visite()
    {
      $oStmt = $this->oDb->exec("DELETE FROM Visite WHERE id = {$_POST['id']}");
      $oStmt = $this->oDb->exec("DELETE FROM Prescrire WHERE idVisite = {$_POST['id']}");
    }


//     /* ========== INSERT ========== */


    public function add(array $aData)
    {
      $oStmt = $this->oDb->prepare('INSERT INTO Animal (nom) VALUES(:nom)');
      $oStmt->bindValue(':nom', $aData['nom'], \PDO::PARAM_STR);
      return $oStmt->execute();
    }
}
