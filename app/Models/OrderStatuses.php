<?php

namespace App\Models;

use PDO;

class OrderStatuses {
  public $statusList = [];

  public function getAll() {
    $db = connect();

    $getAllSql = "SELECT `orderstatus`.*
                  FROM `orderstatus`;";
    $getAllStm = $db->prepare($getAllSql);
    $getAllStm->execute();
    $data = $getAllStm->fetchAll(PDO::FETCH_ASSOC);

    foreach($data as $item) {
      $status = new OrderStatus();
      $status->setStatusId($item['StatusID']);
      $status->setStatusName($item['StatusName']);
      $this->statusList[] = $status;
    }

    return $this;
  }
}