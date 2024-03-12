<?php

namespace App\Models;

use PDO;

class Brands
{
  public $brandList = [];
  public function readAll()
  {
    $db = connect();
    $query = ('SELECT * FROM brand');
    $statement = $db->prepare($query);
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $item) {
      $this->brandList[] = (object) ['id' => $item['BrandID'], 'name' => $item['BrandName']];
    }
    $db = null;
    $query = null;
    return $this;
  }
  public function getAllBrands(){
    $db = connect();
    $getBrandSql = ('SELECT * FROM brand');

    $getBrandStm = $db->prepare($getBrandSql);
    $getBrandStm->execute();

    $data = $getBrandStm->fetchAll(PDO::FETCH_ASSOC);
    foreach($data as $item) {
      $brand = new Brand();
      $brand->setId($item['BrandID']);
      $brand->setName($item['BrandName']);
      $brand->setDeleteAt($item['Delete_At']);
      $this->brandList[] = $brand;
    }
    return $this;
  }
}