<?php

namespace App\Models;

use PDO;

class Warranties {

  public $warrantyList = [];

  public function getAll() {
    $db = connect();

    $getAllSql = "SELECT `warrantyperiod`.*
                  FROM `warrantyperiod`
                  ORDER BY `warrantyperiod`.`Months` ASC;";
    $getAllStm = $db->prepare($getAllSql);
    $getAllStm->execute();

    $data = $getAllStm->fetchAll(PDO::FETCH_ASSOC);

    foreach($data as $item) {
      $warranty = new Warranty();
      $warranty->setWarrantyId($item['WarrantyId']);
      $warranty->setMonths($item['Months']);
      $this->warrantyList[] = $warranty;
    }
    return $this;
  }

}