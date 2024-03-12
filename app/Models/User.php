<?php

namespace App\Models;

use ErrorException;
use Exception;
use PDO;

class User
{
  protected $username;
  protected $password;
  protected $createdAt;
  protected $modifiedAt;
  protected $deletedAt;
  protected $userGroup;
  protected $permissions = [];
  protected $firstName;
  protected $lastName;
  protected $email;
  protected $detailedAddress;
  protected $ward;
  protected $district;
  protected $province;
  protected $phoneNumber;

  /**
   * Get the value of username
   */
  public function getUsername()
  {
    return $this->username;
  }

  /**
   * Set the value of username
   *
   * @return  self
   */
  public function setUsername($username)
  {
    $this->username = $username;

    return $this;
  }

  /**
   * Get the value of password
   */
  public function getPassword()
  {
    return $this->password;
  }

  /**
   * Set the value of password
   *
   * @return  self
   */
  public function setPassword($password)
  {
    $this->password = $password;

    return $this;
  }

  /**
   * Get the value of createdAt
   */
  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  /**
   * Set the value of createdAt
   *
   * @return  self
   */
  public function setCreatedAt($createdAt)
  {
    $this->createdAt = $createdAt;

    return $this;
  }

  /**
   * Get the value of modifiedAt
   */
  public function getModifiedAt()
  {
    return $this->modifiedAt;
  }

  /**
   * Set the value of modifiedAt
   *
   * @return  self
   */
  public function setModifiedAt($modifiedAt)
  {
    $this->modifiedAt = $modifiedAt;

    return $this;
  }

  /**
   * Get the value of deletedAt
   */
  public function getDeletedAt()
  {
    return $this->deletedAt;
  }

  /**
   * Set the value of deletedAt
   *
   * @return  self
   */
  public function setDeletedAt($deletedAt)
  {
    $this->deletedAt = $deletedAt;

    return $this;
  }

  /**
   * Get the value of userGroup
   */
  public function getUserGroup()
  {
    return $this->userGroup;
  }

  /**
   * Set the value of userGroup
   *
   * @return  self
   */
  public function setUserGroup($userGroup)
  {
    $this->userGroup = $userGroup;

    return $this;
  }

  /**
   * Get the value of permissions
   */
  public function getPermissions()
  {
    return $this->permissions;
  }

  /**
   * Set the value of permissions
   *
   * @return  self
   */
  public function setPermissions($permissions)
  {

    $this->permissions = $permissions;

    return $this;
  }

  

  /**
   * Get the value of firstName
   */ 
  public function getFirstName()
  {
    return $this->firstName;
  }

  /**
   * Set the value of firstName
   *
   * @return  self
   */ 
  public function setFirstName($firstName)
  {
    $this->firstName = $firstName;

    return $this;
  }

  /**
   * Get the value of lastName
   */ 
  public function getLastName()
  {
    return $this->lastName;
  }

  /**
   * Set the value of lastName
   *
   * @return  self
   */ 
  public function setLastName($lastName)
  {
    $this->lastName = $lastName;

    return $this;
  }

  /**
   * Get the value of email
   */ 
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Set the value of email
   *
   * @return  self
   */ 
  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  /**
   * Get the value of detailedAddress
   */ 
  public function getDetailedAddress()
  {
    return $this->detailedAddress;
  }

  /**
   * Set the value of detailedAddress
   *
   * @return  self
   */ 
  public function setDetailedAddress($detailedAddress)
  {
    $this->detailedAddress = $detailedAddress;

    return $this;
  }

  /**
   * Get the value of ward
   */ 
  public function getWard()
  {
    return $this->ward;
  }

  /**
   * Set the value of ward
   *
   * @return  self
   */ 
  public function setWard($ward)
  {
    $this->ward = $ward;

    return $this;
  }

  /**
   * Get the value of district
   */ 
  public function getDistrict()
  {
    return $this->district;
  }

  /**
   * Set the value of district
   *
   * @return  self
   */ 
  public function setDistrict($district)
  {
    $this->district = $district;

    return $this;
  }

  /**
   * Get the value of province
   */ 
  public function getProvince()
  {
    return $this->province;
  }

  /**
   * Set the value of province
   *
   * @return  self
   */ 
  public function setProvince($province)
  {
    $this->province = $province;

    return $this;
  }

  /**
   * Get the value of phoneNumber
   */ 
  public function getPhoneNumber()
  {
    return $this->phoneNumber;
  }

  /**
   * Set the value of phoneNumber
   *
   * @return  self
   */ 
  public function setPhoneNumber($phoneNumber)
  {
    $this->phoneNumber = $phoneNumber;

    return $this;
  }

  public function getFullName() {
    return $this->firstName." ".$this->lastName;
  }

  // Crud function

  public function createAccount($username, $password)
  {
    $db = connect();
    $q_Account = "INSERT INTO `account`(`Username`, `Password`, `Created_at`) VALUES (:username,:password,current_timestamp())";
    $result = $db->prepare($q_Account);
    $result -> bindParam(':username', $username);
    $result -> bindParam(':password', $password);
    $result -> execute();
  }

  public function createUserDetail($username, $FirstName, $LastName, $Email)
  {
    $db = connect();

    //Main
    $sql= "INSERT INTO userdetail(username, FirstName, LastName, Email) Values('$username', '$FirstName', '$LastName', '$Email')";

    // $sql= "INSERT INTO userdetail(username, FullName, Email) Values('$username', '$FullName','$Email')";
    echo $sql;
    $result = $db->prepare($sql);
    $result -> execute();
  }

  public function updateUserDetail($data) {
    $db = connect();
    $updateInfoSql = "UPDATE userdetail SET userdetail.FirstName= :FirstName, 
            userdetail.LastName= :LastName, 
            userdetail.Email= :Email, 
            userdetail.detailedAddress= :detailedAddress, 
            userdetail.District= :District,
            userdetail.`City/Province`= :City, 
            userdetail.Phone_Number= :Phone_Number
            WHERE userdetail.username= :username";
    $updateInfoStm = $db->prepare($updateInfoSql);
    $updateInfoStm->execute([
      ":FirstName" => $data["user__first-name"],
      ":LastName" => $data["user__last-name"],
      ":Email" => $data["user__email"],
      ":City" => $data["order__address-city"],
      ":District" => $data["order__address-district"],
      ":detailedAddress" => $data["order__address"],
      ":Phone_Number" => $data["user__tel"],
      ":username" => $data["username"],
    ]);

    $updateRoleSql = "UPDATE `accountgroup` SET `accountypeid` = :roleId WHERE `accountgroup`.`username` = :username ";
    $updateRoleStm = $db->prepare($updateRoleSql);
    $updateRoleStm->execute([
      ":roleId" => $data["role-id"],
      ":username" => $data["username"],
    ]);
  }

  public function createAccountGroup($username)
  {
    $db = connect();
    $q_AccountGroup = "INSERT INTO `accountgroup`(`username`, `accountypeid`) VALUES (:username,'CUSTOMER')";
    $result = $db->prepare($q_AccountGroup);
    $result -> bindParam(':username', $username);
    // $result -> bindParam(':accountypeid', $accountypid);
    $result -> execute();
  }

  public function read(string $username, string $password)
  {
    $db = connect();

    $sql = "SELECT `account`.*, `accountgroup`.`accountypeid`, `accountpermission`.`PermissionID`
    FROM `account` 
      LEFT JOIN `accountgroup` ON `accountgroup`.`username` = `account`.`Username`, `accountpermission`
    WHERE `account`.`Username` = :username AND `account`.`Password` = :pwd";

    $statement = $db->prepare($sql);
    $statement->execute(
      array(
        ':username' => $username,
        ':pwd' => $password,
      )
    );
    $data = $statement->fetch(PDO::FETCH_ASSOC);
    if (!isset($data['Username'])) {
      throw new ErrorException('Tài khoản hoặc mật khẩu sai');
    }
    $this->username = $data['Username'];
    $this->password = $data['Password'];
    $this->createdAt = $data['Created_at'];
    $this->modifiedAt = $data['Modified_at'];
    $this->deletedAt = $data['Deleted_at'];
    $this->userGroup = $data['accountypeid'];

    $sql = 'SELECT * FROM accountpermission WHERE TypeID = :userType';
    $statement = $db->prepare($sql);
    $statement->execute(
      array(
        ':userType' => $this->userGroup,
      )
    );
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $item) {
      $this->permissions[] = $item['PermissionID'];
    }

    $sql = "SELECT * FROM `userdetail` WHERE `username` = :username";
    $statement = $db -> prepare($sql);
    $statement -> bindParam(':username', $username);
    $statement->execute();

    $data = $statement->fetch(PDO::FETCH_ASSOC);

    $this->firstName = $data['FirstName'] ?? "";
    $this->lastName = $data['LastName'] ?? "";
    $this->email = $data['Email'] ?? "";
    $this->detailedAddress = $data['detailedAddress'] ?? "";
    $this->district = $data['District'] ?? "";
    $this->province = $data['City/Province'] ?? "";
    $this->phoneNumber = $data['Phone_Number'] ?? "";

    $sql = null;
    $db = null;

    return $this;
  }

  public function getUser(string $username)
  {
    $db = connect();

    $sql = "SELECT `account`.*, `accountgroup`.`accountypeid`, `accountpermission`.`PermissionID`
    FROM `account` 
      LEFT JOIN `accountgroup` ON `accountgroup`.`username` = `account`.`Username`, `accountpermission`
    WHERE `account`.`Username` = :username";

    $statement = $db->prepare($sql);
    $statement->execute(
      array(
        ':username' => $username,
      )
    );
    $data = $statement->fetch(PDO::FETCH_ASSOC);

    $this->username = $data['Username'];
    $this->password = $data['Password'];
    $this->createdAt = $data['Created_at'];
    $this->modifiedAt = $data['Modified_at'];
    $this->deletedAt = $data['Deleted_at'];
    $this->userGroup = $data['accountypeid'];

    $sql = "SELECT * FROM `userdetail` WHERE `username` = :username";
    $statement = $db -> prepare($sql);
    $statement -> bindParam(':username', $username);
    $statement->execute();

    $data = $statement->fetch(PDO::FETCH_ASSOC);

    $this->firstName = $data['FirstName'] ?? "";
    $this->lastName = $data['LastName'] ?? "";
    $this->email = $data['Email'] ?? "";
    $this->detailedAddress = $data['detailedAddress'] ?? "";
    $this->district = $data['District'] ?? "";
    $this->province = $data['City/Province'] ?? "";
    $this->phoneNumber = $data['Phone_Number'] ?? "";

    $sql = null;
    $db = null;

    return $this;
  }
  
  public function UpdateUserInfo($userName,$lastName, $firstName, $email, $phoneNumber, $City, $District, $detailAddress){
    $db = connect();
    $sql = "UPDATE userdetail SET userdetail.FirstName='$firstName', 
            userdetail.LastName='$lastName', 
            userdetail.Email='$email', 
            userdetail.detailedAddress='$detailAddress', 
            userdetail.District='$District',userdetail.`City/Province`='$City', 
            userdetail.Phone_Number='$phoneNumber' 
            WHERE userdetail.username='$userName'";
    $result = $db->prepare($sql);
    $result -> execute();
  }


  public function getAccountInDB(){
    $db = connect();
    $sql = "SELECT Username,Password FROM account";
    $stm = $db->query($sql);
    return $stm->fetchAll(PDO::FETCH_ASSOC);

  }

  public function getGmailInDB(){
    $db = connect();
    $sql = "SELECT Email FROM userdetail";
    $stm = $db->query($sql);
    return $stm->fetchAll(PDO::FETCH_ASSOC);

  }

  public function getCurrentfirstNameInDB($userName){
    $db = connect();
    $sql = "SELECT userdetail.firstName FROM userdetail WHERE userdetail.username='$userName'";
    $stm = $db->query($sql);
    return $stm->fetch();
  }

  public function getCurrentLastNameInDB($userName){
    $db = connect();
    $sql = "SELECT userdetail.LastName FROM userdetail WHERE userdetail.username='$userName'";
    $stm = $db->query($sql);
    return $stm->fetch();
  }

  public function getCurrentEmailInDB($userName){
    $db = connect();
    $sql = "SELECT userdetail.Email FROM userdetail WHERE userdetail.username='$userName'";
    $stm = $db->query($sql);
    return $stm->fetch();
  }

  public function getCurrentDetailedAddressInDB($userName){
    $db = connect();
    $sql = "SELECT userdetail.detailedAddress FROM userdetail WHERE userdetail.username='$userName'";
    $stm = $db->query($sql);
    return $stm->fetch();
  }

  public function getCurrentDistrictInDB($userName){
    $db = connect();
    $sql = "SELECT userdetail.District FROM userdetail WHERE userdetail.username='$userName'";
    $stm = $db->query($sql);
    return $stm->fetch();
  }

  public function getCurrentCityInDB($userName){
    $db = connect();
    $sql = "SELECT userdetail.`City/Province` FROM userdetail WHERE userdetail.username='$userName'";
    $stm = $db->query($sql);
    return $stm->fetch();
  }

  public function getCurrentTelInDB($userName){
    $db = connect();
    $sql = "SELECT userdetail.Phone_Number FROM userdetail WHERE userdetail.username='$userName'";
    $stm = $db->query($sql);
    return $stm->fetch();
  }

  public function createUser(array $data) {
    $db = connect();
    $createUserSql = "INSERT INTO `account` (`Username`, `Password`, `Created_at`, `Modified_at`, `Deleted_at`)
                       VALUES (:username, :pwd, current_timestamp(), NULL, NULL)";
    $createUserStm = $db->prepare($createUserSql);
    $createUserStm->execute([
      ":username" => $data['Username'],
      ":pwd" => $data['password'],
    ]);

    $addBasicInfoSql = "INSERT INTO `userdetail` (`userdetailID`, `username`, `FirstName`, `LastName`, 
                        `Email`, `detailedAddress`, `District`, `City/Province`, `Phone_Number`) 
                        VALUES (NULL, :username, :firstName, :lastName, :email, NULL, '', '', '')";
    $addBasicInfoStm = $db->prepare($addBasicInfoSql);
    $addBasicInfoStm->execute([
      ":username" => $data['Username'],
      ":firstName" => $data['fist-name'],
      ":lastName" => $data['Last-name'],
      ":email" => $data['email'],
    ]);

    $addUserToGroupSql = "INSERT INTO `accountgroup` (`ID`, `username`, `accountypeid`) 
                          VALUES (NULL, :username, :roleId)";
    $addUserToGroupStm = $db->prepare($addUserToGroupSql);
    $addUserToGroupStm->execute([
      ":username" => $data['Username'],
      ":roleId" => $data['role-id'],
    ]);
  }

  public function deactiveUser(string $username) {
    $db = connect();
    $deactiveSql = "UPDATE `account` 
                    SET `Deleted_at` = current_timestamp()
                    WHERE `account`.`Username` = :username";
    $deactiveStm = $db->prepare($deactiveSql);
    $deactiveStm->execute([
      ":username" => $username,
    ]);
  }
}