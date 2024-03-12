<?php

namespace App\Models;

use ErrorException;
use PDO;
use PDOException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\Exception\FormSizeFileException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class Product
{
  protected $productLine;
  protected $productName;
  protected $thumbnail;
  protected $price;
  protected $discount;
  protected $createdAt;
  protected $modifiedAt;
  protected $deletedAt;
  protected $createdBy;
  protected $brandID;
  protected $category;
  protected $categoryName;
  protected $warrantyPeriod;
  protected $infor = [];
  protected $images = [];
  protected $serialNumbers = [];
  protected $stock;
  protected $warrantyId;
  /**
   * Get the value of productLine
   */
  public function getProductLine()
  {
    return $this->productLine;
  }

  /**
   * Set the value of productLine
   *
   * @return  self
   */
  public function setProductLine($productLine)
  {
    $this->productLine = $productLine;

    return $this;
  }

  /**
   * Get the value of productName
   */
  public function getProductName()
  {
    return $this->productName;
  }

  /**
   * Set the value of productName
   *
   * @return  self
   */
  public function setProductName($productName)
  {
    $this->productName = $productName;

    return $this;
  }


  /**
   * Get the value of thumbnail
   */
  public function getThumbnail()
  {
    return $this->thumbnail;
  }

  /**
   * Set the value of thumbnail
   *
   * @return  self
   */
  public function setThumbnail($thumbnail)
  {
    $this->thumbnail = $thumbnail;

    return $this;
  }

  /**
   * Get the value of price
   */
  public function getPrice()
  {
    return $this->price;
  }

  /**
   * Set the value of price
   *
   * @return  self
   */
  public function setPrice($price)
  {
    $this->price = $price;

    return $this;
  }

  /**
   * Get the value of discount
   */
  public function getDiscount()
  {
    return $this->discount;
  }

  /**
   * Set the value of discount
   *
   * @return  self
   */
  public function setDiscount($discount)
  {
    $this->discount = $discount;

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
   * Get the value of createdBy
   */
  public function getCreatedBy()
  {
    return $this->createdBy;
  }

  /**
   * Set the value of createdBy
   *
   * @return  self
   */
  public function setCreatedBy($createdBy)
  {
    $this->createdBy = $createdBy;

    return $this;
  }



  /**
   * Get the value of infor
   */
  public function getInfor()
  {
    return $this->infor;
  }

  /**
   * Set the value of infor
   *
   * @return  self
   */
  public function setInfor($infor)
  {
    $this->infor = $infor;

    return $this;
  }

  /**
   * Get the value of images
   */
  public function getImages()
  {
    return $this->images;
  }

  /**
   * Set the value of images
   *
   * @return  self
   */
  public function setImages($images)
  {
    $this->images = $images;

    return $this;
  }

  /**
   * Get the value of brandID
   */
  public function getBrandID()
  {
    return $this->brandID;
  }

  /**
   * Set the value of brandID
   *
   * @return  self
   */
  public function setBrandID($brandID)
  {
    $this->brandID = $brandID;

    return $this;
  }

  /**
   * Get the value of category
   */
  public function getCategory()
  {
    return $this->category;
  }

  /**
   * Set the value of category
   *
   * @return  self
   */
  public function setCategory($category)
  {
    $this->category = $category;

    return $this;
  }

  /**
   * Get the value of serialNumbers
   */
  public function getSerialNumbers()
  {
    return $this->serialNumbers;
  }

  /**
   * Set the value of serialNumbers
   *
   * @return  self
   */
  public function setSerialNumbers($serialNumbers)
  {
    $this->serialNumbers = $serialNumbers;

    return $this;
  }

  /**
   * Get the value of stock
   */
  public function getStock()
  {
    return $this->stock;
  }

  /**
   * Set the value of stock
   *
   * @return  self
   */
  public function setStock($stock)
  {
    $this->stock = $stock;

    return $this;
  }

  /**
   * Get the value of warrantyPeriod
   */
  public function getWarrantyPeriod()
  {
    return $this->warrantyPeriod;
  }

  /**
   * Set the value of warrantyPeriod
   *
   * @return  self
   */
  public function setWarrantyPeriod($warrantyPeriod)
  {
    $this->warrantyPeriod = $warrantyPeriod;

    return $this;
  }

  /**
   * Get the value of categoryName
   */
  public function getCategoryName()
  {
    return $this->categoryName;
  }

  /**
   * Set the value of categoryName
   *
   * @return  self
   */
  public function setCategoryName($categoryName)
  {
    $this->categoryName = $categoryName;

    return $this;
  }

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

  // CRUD functions

  public function create(array $data, array $files)
  {
    $db = connect();
    $this->productLine = $data['product_line'];
    $this->productName = $data['product_name'];
    $this->price = $data['price'];
    $this->discount = empty($data['discount']) ?? 0;
    $this->createdBy = $data['userID'];
    $this->brandID = $data['brand'];
    $this->category = $data['category'];
    $this->infor = $data['information'];
    $this->warrantyId = $data['warranty'];

    if ($files['thumbnail']['error'] == UPLOAD_ERR_OK) {
      // move uploaded thumbnail to public folder
      $tmp_name = $_FILES["thumbnail"]["tmp_name"];
      $name = basename($_FILES["thumbnail"]["name"]);
      $ext = pathinfo($name, PATHINFO_EXTENSION);
      // if ($ext != 'png' || $ext != 'jpg' || $ext != 'jpeg')
      //   throw new FormSizeFileException("File isn't in the correct format!");
      move_uploaded_file($tmp_name, APP_ROOT . "/public/images/thumbnail/$this->productLine.$ext");
      try {
        // Add product to db
        $sql = "INSERT INTO `product` (`Product_Line`, `Product_Name`, `Thumbnail`, `Price`, 
          `Discount`, `warranty_period`, `Created_at`, `Modified_at`, `Deleted_at`, `Created_by`, `BrandID`, `Category`) 
          VALUES ('$this->productLine', '$this->productName', '$this->productLine.$ext', $this->price,
          '($this->discount)', '$this->warrantyId', current_timestamp(), NULL, NULL, '$this->createdBy', '$this->brandID', '$this->category')";
        $statement = $db->prepare($sql);
        $statement->execute();
      } catch (PDOException $err) {
        echo $err->getMessage();
      }

      $productImgSql = "INSERT INTO `productimage` (`ImageID`, `ProductLine`, `imgPath`) VALUES (NULL, :productLine, :imgPath)";
      $productImgStm = $db->prepare($productImgSql);
      foreach ($_FILES["image"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
          $tmp_name = $_FILES["image"]["tmp_name"][$key];
          $ext = pathinfo($name, PATHINFO_EXTENSION);
          // basename() may prevent filesystem traversal attacks;
          // further validation/sanitation of the filename may be appropriate
          if (!is_dir(APP_ROOT . "/public/images/productImg/$this->productLine/")) {
            mkdir(APP_ROOT . "/public/images/productImg/$this->productLine/");
          }

          $name = basename($_FILES["image"]["name"][$key]);
          move_uploaded_file($tmp_name, APP_ROOT . "/public/images/productImg/$this->productLine/$this->productLine-$key.$ext");

          $productImgStm->execute([
            ':productLine' => $data['product_line'],
            ':imgPath' => "$this->productLine-$key.$ext"
          ]);

        } else {
          throw new FileException('File corrupted!');
        }
      }

      // Sau này tách ra, mà chắc cũng không cần lắm :))
      // Insert infomation for product
      $sql = "INSERT INTO `productinfo` (`Info_ID`, `Product_Line`, `Product_Information`) VALUES (NULL, :productLine, :productInfo)";

      $statement = $db->prepare($sql);
      foreach ($data['information'] as $info) {
        if (empty($data['information'])) {
          continue;
        }
        $statement->execute([
          ':productLine' => $data['product_line'],
          ':productInfo' => $info
        ]);
      }

      $sql = "INSERT INTO `product_warranty` (`product_id`, `purchased_at`, `warranty_period`, `product_line`) 
              VALUES (:product_id, NULL, NULL, :productLine)";
      $statement = $db->prepare($sql);
      try {
        foreach ($data['serial_number'] as $serialNumber) {
          if (empty($data['serial_number'])) {
            continue;
          }
          $statement->execute([
            ':productLine' => $data['product_line'],
            ':product_id' => $serialNumber
          ]);
        }
      } catch (PDOException $err) {
        echo $err->getMessage();
      }

    } else {
      throw new FileException('File corrupted!');
    }
  }


  public function read(string $id)
  {
    $db = connect();

    $countSql = "SELECT COUNT(`product_warranty`.`product_line`)
                  FROM `product_warranty`
                  WHERE `product_warranty`.`product_line` = :productLine
                    AND `product_warranty`.`purchased_at` IS NULL
                  GROUP BY `product_warranty`.`product_line`
    ;";

    $countStm = $db->prepare($countSql);
    $countStm->execute([
      ":productLine" => $id
    ]);

    $this->stock = $countStm->fetchColumn();

    $query = ('SELECT *, `warrantyperiod`.`Months`, `category`.`CategoryName`
                FROM product 
                LEFT JOIN `warrantyperiod` ON `product`.`warranty_period` = `warrantyperiod`.`WarrantyId`
                LEFT JOIN `category` ON `product`.`Category` = `category`.`CategoryID`
                WHERE Product_Line = :id');
    $statement = $db->prepare($query);
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->execute();
    $data = $statement->fetch(PDO::FETCH_ASSOC);

    if ($data) {
      $this->productLine = $data['Product_Line'];
      $this->productName = $data['Product_Name'];
      $this->thumbnail = $data['Thumbnail'];
      $this->price = $data['Price'];
      $this->warrantyPeriod = $data['Months'];
      $this->discount = $data['Discount'];
      $this->createdAt = $data['Created_at'];
      $this->modifiedAt = $data['Modified_at'];
      $this->deletedAt = $data['Deleted_at'];
      $this->createdBy = $data['Created_by'];
      $this->brandID = $data['BrandID'];
      $this->warrantyId = $data['warranty_period'];
      $this->categoryName = $data['CategoryName'];
    } else {
      throw new ResourceNotFoundException("Sản phẩm không tồn tại!");
    }

    $query = 'SELECT `productinfo`.*
    FROM `productinfo` WHERE `productinfo`.`Product_Line` = :productLine';
    $statement = $db->prepare($query);
    $statement->bindParam(':productLine', $this->productLine, PDO::PARAM_STR);
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $item) {
      $this->infor[] = $item['Product_Information'];
    }

    $query = 'SELECT `productimage`.*
    FROM `productimage` WHERE `productimage`.`ProductLine` = :productLine';
    $statement = $db->prepare($query);
    $statement->bindParam(':productLine', $this->productLine, PDO::PARAM_STR);
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $item) {
      $this->images[] = $item['imgPath'];
    }

    $query = null;
    $db = null;
    return $this;
  }

  public function update(array $data, array $files)
  {
    $db = connect();
    $this->productLine = $data['product_line'];
    $this->productName = $data['product_name'];
    $this->price = $data['price'];
    $this->discount = $data['discount'] ?? 0;
    $this->brandID = $data['brand'];
    $this->category = $data['category'];
    if ($data['warranty'] == 'none') {
      $this->warrantyId = '';
    } else {
      $this->warrantyId = $data['warranty'];
    }

    // Update thumbnail
    if ($files['newthumbnail']['error'] == UPLOAD_ERR_OK) {
      $tmp_name = $_FILES["newthumbnail"]["tmp_name"];
      $name = basename($_FILES["newthumbnail"]["name"]);
      $ext = pathinfo($name, PATHINFO_EXTENSION);
      move_uploaded_file($tmp_name, APP_ROOT . "/public/images/thumbnail/$this->productLine.$ext");
    }

    $countCurrentImgSql = "SELECT COUNT(`productimage`.`imgPath`)
                            FROM `productimage`
                            WHERE `productimage`.`ProductLine` = :productLine
                            GROUP BY `productimage`.`ProductLine`
                            ;";
    $countCurrentImgStm = $db->prepare($countCurrentImgSql);
    $countCurrentImgStm->execute([
      ":productLine" => $this->productLine
    ]);
    if ($countCurrentImgStm->fetchColumn() > (isset($data['oldImage']) ? count( $data['oldImage']) : 0)) {
      // clean up current images
      $cleanImageSql = "DELETE FROM `productimage` WHERE `productimage`.`ProductLine` = :productLine";

      $cleanStm = $db->prepare($cleanImageSql);
      $cleanStm->execute([
        ":productLine" => $this->productLine
      ]);

      if (isset($data['oldImage'])) {
        // update image
        $productImgSql = "INSERT INTO `productimage` (`ImageID`, `ProductLine`, `imgPath`) VALUES (NULL, :productLine, :imgPath)";
  
        $productImgStm = $db->prepare($productImgSql);
        foreach ($data['oldImage'] as $image) {
          $productImgStm->execute([
            ':productLine' => $data['product_line'],
            ':imgPath' => $image
          ]);
        }
      }
    }

    $productImgSql = "INSERT INTO `productimage` (`ImageID`, `ProductLine`, `imgPath`) VALUES (NULL, :productLine, :imgPath)";
    $productImgStm = $db->prepare($productImgSql);

    foreach ($_FILES["newImage"]["error"] as $key => $error) {
      if ($error == UPLOAD_ERR_OK) {
        $name = basename($_FILES["newImage"]["name"][$key]);
        $tmp_name = $_FILES["newImage"]["tmp_name"][$key];
        $ext = pathinfo($name, PATHINFO_EXTENSION);

        if (!is_dir(APP_ROOT . "/public/images/productImg/$this->productLine/")) {
          mkdir(APP_ROOT . "/public/images/productImg/$this->productLine/");
        }

        $countCurrentImgSql = "SELECT COUNT(`productimage`.`imgPath`)
                FROM `productimage`
                WHERE `productimage`.`ProductLine` = :productLine
                GROUP BY `productimage`.`ProductLine`
                ;";
        $countCurrentImgStm = $db->prepare($countCurrentImgSql);
        $countCurrentImgStm->execute([
        ":productLine" => $this->productLine
        ]);
        $index = $key + $countCurrentImgStm->fetchColumn();

        move_uploaded_file($tmp_name, APP_ROOT . "/public/images/productImg/$this->productLine/$this->productLine-$index.$ext");

        $productImgStm->execute([
          ':productLine' => $data['product_line'],
          ':imgPath' => "$this->productLine-$index.$ext"
        ]);

      }
    }

    // clean up productInfo
    $cleanInfoSql = "DELETE FROM productinfo WHERE `productinfo`.`Product_Line` = :productLine";

    $cleanStm = $db->prepare($cleanInfoSql);
    $cleanStm->execute([
      ":productLine" => $this->productLine
    ]);

    // update product
    $updateSql = "UPDATE `product` 
                  SET 
                    `Product_Name` = :productName, 
                    `Price` = :price, 
                    `Discount` = :discount, 
                    `BrandID` = :brandID, 
                    `Category` = :category,".
                    (empty($this->warrantyId) ? " `warranty_period` = NULL " : " `warranty_period` = '$this->warrantyId' ")
                  ." WHERE `product`.`Product_Line` = :productLine";
    $updateStm = $db->prepare($updateSql);
    $updateStm->execute([
      ':productName' => $this->productName,
      ':price' => $this->price,
      ':discount' => $this->discount,
      ':brandID' => $this->brandID,
      ':category' => $this->category,
      ':productLine' => $this->productLine
    ]);

    $sql = "INSERT INTO `productinfo` (`Info_ID`, `Product_Line`, `Product_Information`) VALUES (NULL, :productLine, :productInfo)";

    $statement = $db->prepare($sql);
    if (isset($data['information'])) {
      foreach ($data['information'] as $info) {
        if (empty($info)) {
          continue;
        }
        $statement->execute([
          ':productLine' => $this->productLine,
          ':productInfo' => $info
        ]);
      }
    }

  }

  public function addQty($data)
  {
    $db = connect();
    $sql = "INSERT INTO `product_warranty` (`product_id`, `purchased_at`, `warranty_period`, `product_line`) 
            VALUES (:product_id, NULL, NULL, :productLine)";
    $statement = $db->prepare($sql);
    try {
      foreach ($data['serial_number'] as $serialNumber) {
        if (empty($data['serial_number'])) {
          continue;
        }
        $statement->execute([
          ':productLine' => $data['product_line'],
          ':product_id' => $serialNumber
        ]);
      }
    } catch (PDOException $err) {
      echo $err->getMessage();
    }
  }

  public function delete(string $id)
  {
    $db = connect();

    $query = "UPDATE `product` SET `Deleted_at` = current_timestamp() WHERE `product`.`Product_Line` = :id";
    $statement = $db->prepare($query);
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->execute();
  }


}