<?php

namespace App\Models;

use ErrorException;
use PDO;
use PDOException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\Exception\FormSizeFileException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class Brand
{
  protected $id;
  protected $name;
  protected $delete_at;

  // GET METHODS
  public function getId()
  {
    return $this->id;
  }

  public function getName()
  {
    return $this->name;
  }
  public function getDeleteAt()
  {
    return $this->delete_at;
  }
  
  // SET METHODS
  public function setId($id)
  {
    $this->id = $id;
  }

  public function setName($name)
  {
    $this->name = $name;
  }
  public function setDeleteAt($delete_at)
  {
    $this->delete_at = $delete_at;
  }
  // CRUD OPERATIONS
  public function create(array $data)
  {
    $db = connect();
    $this->id = $data['brandId'];
    $this->name = $data['brandName'];
    $sql = "INSERT INTO `brand` (`BrandID`, `BrandName`,`Delete_At`) 
            VALUES (:brandId, :brandName,NULL )";
    $statement = $db->prepare($sql);
    $statement->execute([
      ':brandId' => $this->id,
      ':brandName' => $this->name
    ]);

  }

  public function read(string $id)
  {
    $db = connect();

    $countSql = "SELECT `brand`.*
                  FROM `brand`
                  WHERE `brand`.`BrandID` = :brandId
                    AND `brand`.`Delete_At` IS NULL
    ;";
    $statement = $db->prepare($countSql);
    $statement->bindParam(':brandId', $id, PDO::PARAM_STR);
    $statement->execute();
    $data = $statement->fetch(PDO::FETCH_ASSOC);
    if ($data) {
      $this->id = $data['BrandID'];
      $this->name = $data['BrandName'];
      $this->delete_at = $data['Delete_At'];
    }
    return $this;
  }

  public function update(array $data)
  {
    $db = connect();
    $this->id = $data['brandId'];
    $this->name = $data['brandName'];
    print_r($data);
    $updateSql = 'UPDATE `brand` SET `BrandID` = :brandId, `BrandName` = :brandName  WHERE `brand`.`BrandID` = :ID';
    $updateStm = $db->prepare($updateSql);
    $updateStm->execute([
      ':brandId' => $this->id,
      ':brandName' => $this->name,
      ':ID' => $data['ID'],
    ]);
  }

  public function delete(string $id)
  {
    $db = connect();
    $query = 'UPDATE `brand` SET `Delete_At` = CURRENT_TIMESTAMP() WHERE `brand`.`BrandID` = :id';
    $statement = $db->prepare($query);
    $statement->execute([
      ':id' => $id,
    ]);
  }
}