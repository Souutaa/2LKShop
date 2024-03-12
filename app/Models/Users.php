<?php

namespace App\Models;

use PDO;

class Users
{
  public $userList = [];

  public function getAllUsers() {
    $db = connect();

    $sql = "SELECT  `account`.`Username`, `account`.`Created_at`, `account`.`Deleted_at`, `accounttype`.`accountTypeID`, `userdetail`.*
            FROM `account` 
              LEFT JOIN `accountgroup` ON `accountgroup`.`username` = `account`.`Username` 
              LEFT JOIN `accounttype` ON `accountgroup`.`accountypeid` = `accounttype`.`accountTypeID` 
              LEFT JOIN `userdetail` ON `userdetail`.`username` = `account`.`Username`";
    $statement = $db->prepare($sql);
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach($data as $item) {
      $user = new User();
      $user->setUsername($item['Username']);
      $user->setCreatedAt($item['Created_at']);
      $user->setDeletedAt($item['Deleted_at']);
      $user->setUserGroup($item['accountTypeID']);
      $user->setPhoneNumber($item['Phone_Number']);
      $user->setEmail($item['Email']);
      $user->setFirstName($item['FirstName']);
      $user->setLastName($item['LastName']);
      $this->userList[] = $user;
    }

    return $this;
  }
}