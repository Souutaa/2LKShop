<?php

namespace App\Models;

use PDO;

class OrderStatus {
  protected $statusId;
  protected $statusName;
  

  /**
   * Get the value of statusName
   */ 
  public function getStatusName()
  {
    return $this->statusName;
  }

  /**
   * Set the value of statusName
   *
   * @return  self
   */ 
  public function setStatusName($statusName)
  {
    $this->statusName = $statusName;

    return $this;
  }

  /**
   * Get the value of statusId
   */ 
  public function getStatusId()
  {
    return $this->statusId;
  }

  /**
   * Set the value of statusId
   *
   * @return  self
   */ 
  public function setStatusId($statusId)
  {
    $this->statusId = $statusId;

    return $this;
  }
}