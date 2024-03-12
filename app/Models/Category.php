<?php

namespace App\Models;

use PDO;

class Category {
  protected $CategoryID;
  protected $CategoryName;
  protected $Delete_At;

  /**
   * Get the value of CategoryID
   */ 
  public function getCategoryID()
  {
    return $this->CategoryID;
  }
  public function setCategoryID($CategoryID)
  {
    $this->CategoryID = $CategoryID;

  }

  /**
   * Get the value of CategoryName
   */ 
  public function getCategoryName()
  {
    return $this->CategoryName;
  }

  
  public function setCategoryName($CategoryName)
  {
    $this->CategoryName = $CategoryName;
  }


  public function getCategoryDeleteAt()
  {
    return $this->Delete_At;
  }
  public function setCategoryDeleteAt($Delete_At)
  {
    $this->Delete_At = $Delete_At;

  }
  public function create(array $data)
  {
    $db = connect();
    $this->CategoryName = $data['categoryName'];
    $sql = "INSERT INTO `category` (`CategoryID`, `CategoryName`, `Deleted_At`) VALUES (NULL, :CategoryName, NULL);";
    $statement = $db->prepare($sql);
    $statement->execute([
      ':CategoryName' => $this->CategoryName
    ]);
    
  }
  public function read(int $id)
  {
    $db = connect();
    $countSql = "SELECT * FROM `category` WHERE `category`.`CategoryID` = :id AND `category`.`Deleted_At` IS NULL
    ;";
    $statement = $db->prepare($countSql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $data = $statement->fetch(PDO::FETCH_ASSOC);
    
    $this->CategoryID = $data['CategoryID'];
    $this->CategoryName = $data['CategoryName'];
    $this->Delete_At = $data['Deleted_At'];

    return $this;
  }

  public function update( array $data)
  {
    $db = connect();
    $this->CategoryName = $data['categoryName'];
    print_r($data);
    $updateSql = 'UPDATE `category` SET `CategoryName` = :categoryName WHERE `category`.`CategoryID` = :ID';
    $updateStm = $db->prepare($updateSql);
    $updateStm->execute([
      ':ID' => $data['ID'],
      ':categoryName' => $this->CategoryName,
    ]);
  }

  public function delete(int $id)
  {
    $db = connect();
    $query = "UPDATE `category` SET `Deleted_At` = CURRENT_TIMESTAMP() WHERE `category`.`CategoryID` = :id";
    $statement = $db->prepare($query);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
  }
}