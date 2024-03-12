<?php

namespace App\Models;

use PDO;

class PermissionGroup {
  protected $ID;
  protected $Name;
  protected $description;
  protected $disabled;
  

  /**
   * Get the value of ID
   */ 
  public function getID()
  {
    return $this->ID;
  }

  /**
   * Set the value of ID
   *
   * @return  self
   */ 
  public function setID($ID)
  {
    $this->ID = $ID;

    return $this;
  }

  /**
   * Get the value of Name
   */ 
  public function getName()
  {
    return $this->Name;
  }

  /**
   * Set the value of Name
   *
   * @return  self
   */ 
  public function setName($Name)
  {
    $this->Name = $Name;

    return $this;
  }

  /**
   * Get the value of description
   */ 
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Set the value of description
   *
   * @return  self
   */ 
  public function setDescription($description)
  {
    $this->description = $description;

    return $this;
  }

  /**
   * Get the value of disabled
   */ 
  public function getDisabled()
  {
    return $this->disabled;
  }

  /**
   * Set the value of disabled
   *
   * @return  self
   */ 
  public function setDisabled($disabled)
  {
    $this->disabled = $disabled;

    return $this;
  }

  public function read(string $id) {
    $db = connect();

    $readSql = "SELECT `permissiongroup`.*
                FROM `permissiongroup`
                WHERE `permissiongroup`.`PermisionGroupID` = :permissionGroupId;";
    $readStm = $db->prepare($readSql);
    $readStm->execute([
      ":permissionGroupId" => $id
    ]);

    $data = $readStm->fetch(PDO::FETCH_ASSOC);
    $this->ID = $data['PermisionGroupID'];
    $this->Name = $data['PermisionGroupName'];
    $this->description = $data['Description'];
    $this->disabled = $data['Disabled'];

    return $this;
  }

  public function create($name, $description)
  {
    $db = connect();
    $createPermissionGroupSql = "INSERT INTO `permissiongroup` 
                                  (`PermisionGroupID`, `PermisionGroupName`, `Description`, `Disabled`) 
                                VALUES (NULL, :groupName, :groupDescription, '0')";
    $createPermissionGroupStm = $db->prepare($createPermissionGroupSql);
    $createPermissionGroupStm->execute([
      ':groupName' => $name,
      ':groupDescription' => $description,
    ]);
  }


  public function updatePermissionGroupState($permissionGroupId, $state) {
    $db = connect();

    $updateStateSql = "UPDATE `permissiongroup` 
                      SET `Disabled` = :isDisabled 
                      WHERE `permissiongroup`.`PermisionGroupID` = :permissionGroupId";
    $updateStateStm = $db->prepare($updateStateSql);
    $updateStateStm->execute([
      ':isDisabled' => $state,
      ':permissionGroupId' => $permissionGroupId,
    ]);
  }

  public function updatePermissionGroup(array $data) {
    $db = connect();

    $updateSql = "UPDATE `permissiongroup` 
                      SET `PermisionGroupName` = :permissionGroupName, `Description` = :permissionGroupDescription
                      WHERE `permissiongroup`.`PermisionGroupID` = :permissionGroupId";
    $updateStm = $db->prepare($updateSql);
    $updateStm->execute([
      ":permissionGroupName" => $data["permission_group_name"],
      ":permissionGroupDescription" => $data["permission_group_description"],
      ":permissionGroupId" => $data["permission_group_id"],
    ]);
  }

}