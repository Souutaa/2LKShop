<?php

namespace App\Models;

use PDO;

class Products
{
  public $productList = [];

  public function readByBrand(string $brand)
  {
    $db = connect();

    $query = ('SELECT * FROM product WHERE BrandID = :brand ORDER BY `product`.`Created_at` DESC');
    $statement = $db->prepare($query);
    $statement->bindParam(':brand', $brand, PDO::PARAM_STR);
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $item) {
      if ($item['Deleted_at'] != null) {
        continue;
      }
      $product = new Product();
      $product->setProductLine($item['Product_Line']);
      $product->setProductName($item['Product_Name']);
      $product->setThumbNail($item['Thumbnail']);
      $product->setPrice($item['Price']);
      $product->setDiscount($item['Discount']);
      $this->productList[] = $product;
    }
    $db = null;
    $query = null;
    return $this->productList;
  }

  public function readByCategory(string $category){
    $db = connect();

    $query = ('
      SELECT `product`.*, `category`.*
      FROM `product` 
      LEFT JOIN `category` ON `product`.`Category` = `category`.`CategoryID`
      WHERE `category`.`CategoryName` = :category
      ORDER BY `product`.`Created_at` DESC
    ;');
    $statement = $db->prepare($query);
    $statement->bindParam(':category', $category, PDO::PARAM_STR);
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $item) {
      if ($item['Deleted_at'] != null) {
        continue;
      }
      $countSql = "SELECT COUNT(`product_warranty`.`product_line`)
                  FROM `product_warranty`
                  WHERE `product_warranty`.`product_line` = :productLine
                    AND `product_warranty`.`purchased_at` IS NULL
                  GROUP BY `product_warranty`.`product_line`
      ;";

      $countStm = $db->prepare($countSql);
      $countStm->execute([
        ":productLine" => $item['Product_Line']
      ]);

      $stock = $countStm->fetchColumn() ?? 0;
      if ($stock == 0) 
        continue;
      $product = new Product();
      $product->setStock($stock);
      $product->setProductLine($item['Product_Line']);
      $product->setProductName($item['Product_Name']);
      $product->setThumbNail($item['Thumbnail']);
      $product->setPrice($item['Price']);
      $product->setDiscount($item['Discount']);
      $product->setBrandID($item['BrandID']);
      $product->setCategory($item['Category']);
      $this->productList[] = $product;
    }
    $db = null;
    $query = null;
    return $this->productList;
  }

  public function getAll(bool $includeDeleted = false, bool $includeOutOfStock = false)
  {
    $db = connect();

    $query = ('SELECT `product`.*, `category`.`CategoryName`
                FROM `product` 
                  LEFT JOIN `category` ON `product`.`Category` = `category`.`CategoryID`
                  ORDER BY `product`.`Created_at` DESC
                  ;');
    $statement = $db->prepare($query);
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $item) {
      if ($includeDeleted == false && $item['Deleted_at'] != null) {
        continue;
      }
      $countSql = "SELECT COUNT(`product_warranty`.`product_line`)
                  FROM `product_warranty`
                  WHERE `product_warranty`.`product_line` = :productLine
                    AND `product_warranty`.`purchased_at` IS NULL
                  GROUP BY `product_warranty`.`product_line`
      ;";

      $countStm = $db->prepare($countSql);
      $countStm->execute([
        ":productLine" => $item['Product_Line']
      ]);

      $stock = $countStm->fetchColumn();
      if ($stock == 0 && !$includeOutOfStock) {
        continue;
      } else {
        $product = new Product();
        $product->setStock($stock);
        $product->setProductLine($item['Product_Line']);
        $product->setProductName($item['Product_Name']);
        $product->setThumbNail($item['Thumbnail']);
        $product->setBrandID($item['BrandID']);
        $product->setCategory($item['Category']);
        $product->setPrice($item['Price']);
        $product->setDiscount($item['Discount']);
        $product->setCreatedAt($item['Created_at']);
        $product->setModifiedAt($item['Modified_at']);
        $product->setDeletedAt($item['Deleted_at']);
        $product->setCreatedBy($item['Created_by']);
        $product->setCategoryName($item['CategoryName']);
        $this->productList[] = $product;
      }
    }
    $db = null;
    $query = null;
    return $this->productList;
  }

  public function search(string $searchStr)
  {
    $db = connect();
    $search = "%".join("%", explode(" ",$searchStr))."%";
    
    $query = ("SELECT `product`.*
    FROM `product` 
      LEFT JOIN `productinfo` ON `productinfo`.`Product_Line` = `product`.`Product_Line` 
      LEFT JOIN `brand` ON `product`.`BrandID` = `brand`.`BrandID` 
      LEFT JOIN `category` ON `product`.`Category` = `category`.`CategoryID`
      WHERE `product`.`Product_Line` LIKE '$search' OR
            `product`.`Product_Name` LIKE '$search' OR
            `productinfo`.`Product_Information` LIKE '$search' OR
            `category`.`CategoryName` LIKE '$search' OR
            `brand`.`BrandName` LIKE '$search'
      GROUP BY `product`.`Product_Line`;");
    $statement = $db->prepare($query);
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $item) {
      if ($item['Deleted_at'] != null) {
        continue;
      }
      $product = new Product();
      $product->setProductLine($item['Product_Line']);
      $product->setProductName($item['Product_Name']);
      $product->setThumbNail($item['Thumbnail']);
      $product->setBrandID($item['BrandID']);
      $product->setCategory($item['Category']);
      $product->setPrice($item['Price']);
      $product->setDiscount($item['Discount']);
      $product->setCreatedAt($item['Created_at']);
      $product->setModifiedAt($item['Modified_at']);
      $product->setDeletedAt($item['Deleted_at']);
      $product->setCreatedBy($item['Created_by']);
      $this->productList[] = $product;
    }
    $db = null;
    $query = null;
    return $this->productList;
  }

  public function getProductItem(string $productLine) {
    $db = connect();

    $getItemSql = "SELECT `product_warranty`.`product_id`
                    FROM `product_warranty` 
                    WHERE `product_warranty`.`product_line` = :productLine";
    $getItemStm = $db->prepare($getItemSql);
    $getItemStm->execute([
      ":productLine" => $productLine
    ]);
    $data = $getItemStm->fetchAll();
    return $data;
  }

}