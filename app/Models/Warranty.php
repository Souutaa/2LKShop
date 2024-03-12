<?php

namespace App\Models;

use PDO;

class Warranty {
  protected $warrantyId;
  protected $months;
  /**
   * Get the value of warrantyId
   */ 
  public function getWarrantyId()
  {
    return $this->warrantyId;
  }

  /**
   * Set the value of warrantyId
   *
   * @return  self
   */ 
  public function setWarrantyId($warrantyId)
  {
    $this->warrantyId = $warrantyId;

    return $this;
  }

  /**
   * Get the value of months
   */ 
  public function getMonths()
  {
    return $this->months;
  }

  /**
   * Set the value of months
   *
   * @return  self
   */ 
  public function setMonths($months)
  {
    $this->months = $months;

    return $this;
  }
}