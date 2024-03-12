<?php

namespace App\Models;

use PDO;

class Order {
  protected string $id;
  protected string $username;
  protected string $createdAt;
  protected string $statusId;
  protected string $statusName;
  protected string $total;
  protected string $confirmedBy;
  public $orderItems = [];

  /**
   * Get the value of id
   */ 
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set the value of id
   *
   * @return  self
   */ 
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

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

  /**
   * Get the value of total
   */ 
  public function getTotal()
  {
    return $this->total;
  }

  /**
   * Set the value of total
   *
   * @return  self
   */ 
  public function setTotal($total)
  {
    $this->total = $total;

    return $this;
  }

  /**
   * Get the value of confirmedBy
   */ 
  public function getConfirmedBy()
  {
    return $this->confirmedBy;
  }

  /**
   * Set the value of confirmedBy
   *
   * @return  self
   */ 
  public function setConfirmedBy($confirmedBy)
  {
    $this->confirmedBy = $confirmedBy;

    return $this;
  }

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

  public function createOrder(array $formData) {
    $db = connect();

    $this->username = $formData['userID'];
    $this->total = $formData['total'];
    
    // Insert user oder
    $sql = "INSERT INTO `userorder` (`OrderID`, `Username`, `Created_at`, `Status`, `Total`, `Confirmed_by`) 
            VALUES (NULL, :username, current_timestamp(), '1', :total, NULL)";
    $statement = $db->prepare($sql);
    $statement->execute([
      ':username' => $this->username,
      ':total' => $this->total
    ]);

    $orderId = $db->lastInsertId();

    // Insert user information who placed the order
    $orderInformationSql = "INSERT INTO `orderinformation` (`Id`, `OrderID`, `username`, `fullname`, `address`, `note`, `email`,`phoneNumber`) 
                          VALUES (NULL, :orderId, :username, :fullname, :_address, :note, :email, :phoneNumber)";

    $orderInformationStm = $db->prepare($orderInformationSql);
    $orderInformationStm->execute([
      ':orderId' => $orderId,
      ':username' => $this->username,
      ':fullname' => $formData['firstName']." ".$formData['lastName'],
      ':_address' => $formData['detailedAddress'].", ".$formData['district'].", ".$formData['city'],
      ':note' => $formData['note'],
      ':email' => $formData['mail'],
      ':phoneNumber' => $formData['phoneNumber']
    ]);

    $orderItems = json_decode($formData['cartItems']);
    
    // Get n item which hasn't been bought for current order
    $sql = "SELECT `product_warranty`.*, `product`.`Price`, `product`.`Discount`, `warrantyperiod`.`Months`
            FROM `product_warranty` 
            LEFT JOIN `product` ON `product_warranty`.`product_line` = `product`.`Product_Line`
            LEFT JOIN `warrantyperiod` ON `product`.`warranty_period` = `warrantyperiod`.`WarrantyId`
            WHERE `product_warranty`.`product_line` = :productLine 
              AND `product_warranty`.`purchased_at` IS NULL
            GROUP BY `product_warranty`.`product_id`
            LIMIT :quantity;";
    $statement = $db->prepare($sql);

    // Loop through all item in ordersItems(cart) and fetch the product for warranty
    foreach($orderItems as $key => $item) {
      // get get product details
      $statement->execute([
        ':productLine' => $key,
        'quantity' => $item,
      ]);
    
      $data = $statement->fetchAll(PDO::FETCH_ASSOC);

      // create order details for each purchased product
      for($i = 0; $i < $item; $i++) {      
        $orderDetailSql = "INSERT INTO `orderdetail` (`OrderID`, `ProductId`, `purchasePrice`, `purchaseDiscount`)
                           VALUES (:orderID, :productID, :price, :discount)";

        $orderDetailStm = $db->prepare($orderDetailSql);
        $orderDetailStm->execute([
          ":orderID" => $orderId,
          ":productID" => $data[$i]['product_id'],
          ":price" => $data[$i]['Price'],
          ":discount" => $data[$i]['Discount'],
        ]);

        // update purchased product
        $warranty_months = (int)$data[$i]['Months'];
        date_default_timezone_set("Asia/Bangkok");
        $currentDate = date('Y-m-d', time());
        $effectiveDate = date('Y-m-d', strtotime("+$warranty_months months", strtotime($currentDate)));
        $updateProductSql = "UPDATE `product_warranty` 
                              SET `purchased_at` = current_timestamp(), 
                                  `warranty_period` = :warrantyDate
                              WHERE `product_warranty`.`product_id` = :productID";
        $updateProductStm = $db->prepare($updateProductSql);
        $updateProductStm->execute([
          ":productID" => $data[$i]['product_id'],
          ":warrantyDate" => $effectiveDate
        ]);
      }
    }
  }

  public function read(string $orderId) {
    $db = connect();

    $sql = "SELECT `userorder`.*, `orderinformation`.*, `orderdetail`.*, `orderstatus`.*
            FROM `userorder` 
              LEFT JOIN `orderinformation` ON `orderinformation`.`OrderID` = `userorder`.`OrderID` 
              LEFT JOIN `orderdetail` ON `orderdetail`.`OrderID` = `userorder`.`OrderID`
              LEFT JOIN `orderstatus` ON `userorder`.`Status` = `orderstatus`.`StatusID`
            WHERE `userorder`.`OrderID` = :OrderID";

    $statement = $db->prepare($sql);
    $statement->execute([
      ":OrderID" => $orderId
    ]);

    $data = $statement->fetch(PDO::FETCH_ASSOC);
    
    $orderProductSql = "SELECT product.Product_Line, product.Product_Name, COUNT(`orderdetail`.`ProductId`) 
                          AS `quantity`, `orderdetail`.`purchasePrice`, `orderdetail`.`purchaseDiscount`, `product_warranty`.`warranty_period`
                        FROM `orderdetail` 
                          LEFT JOIN `product_warranty` ON `orderdetail`.`ProductId` = `product_warranty`.`product_id` 
                          LEFT JOIN `product` ON `product_warranty`.`product_line` = `product`.`Product_Line`
                        WHERE `orderdetail`.`OrderID` = :orderId
                        GROUP BY `product`.`Product_Line`";

    $statement = $db->prepare($orderProductSql);
    $statement->execute([
      ":orderId" => $orderId
    ]);


    $products = $statement->fetchAll(PDO::FETCH_ASSOC);

    return [
      "data" => $data,
      "products" => $products
    ];
  }
  
  public function cancelOrder(string $orderId) {
    $db = connect();
    $getProductSql = "SELECT `orderdetail`.`ProductId`
                      FROM `orderdetail`
                      WHERE `orderdetail`.`OrderID` = :orderId;";
    $getProductStm = $db->prepare($getProductSql);
    $getProductStm->execute([
      ":orderId" => $orderId
    ]);
    $orderItems = $getProductStm->fetchAll(PDO::FETCH_ASSOC);
    foreach($orderItems as $item) {
      $updateProductSql = "UPDATE `product_warranty` 
                            SET `purchased_at` = NULL,
                            `warranty_period` = NULL
                            WHERE `product_warranty`.`product_id` = :productId";

      $updateProductStm = $db->prepare($updateProductSql);
      $updateProductStm->execute([
        "productId" => $item['ProductId']
      ]);
    }
    $this->updateOrderStatus($orderId, 5);
  }

  public function updateOrderStatus(string $orderId, int $statusCode) {
    $db = connect();
    $updateOrderStatusSql = "UPDATE `userorder` SET `Status` = :statusCode WHERE `userorder`.`OrderID` = :orderId";
    $updateOrderStm = $db -> prepare($updateOrderStatusSql);
    $updateOrderStm->execute([
      ":orderId" => $orderId,
      ":statusCode" => $statusCode,
    ]);
  }

}