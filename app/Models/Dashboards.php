<?php

namespace App\Models;

use PDO;
class Dashboards{
    public $productSeller =[];
    public $totalStatus =[];
    public $categorySeller=[];

    public $RevenueOfMonth=[];

    public function getRevenue(){
        $db = connect();

        $query = ('SELECT SUM(`userorder`.`Total`) AS TONG , MONTH(`userorder`.`Created_at`) AS THANG
                    FROM `userorder` 
                    WHERE `userorder`.`Status` != 5
                    GROUP BY MONTH(`userorder`.`Created_at`)');
        $statement = $db->prepare($query);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($data as $item) {
            $revenue = new DashBoard();
            $revenue->setMonth($item['THANG']);
            $revenue->seTotalRevenue($item['TONG']);
            $this->RevenueOfMonth[] = $revenue;
        }
        
        $db = null;
        $query = null;
        return $this;
    }
    public function getTotalCategorySeller(){
        $db = connect();

        $query = ('SELECT COUNT(`orderdetail`.`ProductId`)-1 AS totalCategorySeller, `category`.`CategoryName`
                    FROM `category`
                    LEFT JOIN `product` ON `product`.`Category` = `category`.`CategoryID`
                    LEFT JOIN  `product_warranty` ON `product_warranty`.`product_line` = `product`.`Product_Line`
                    LEFT JOIN `orderdetail` ON `orderdetail`.`ProductId` = `product_warranty`.`product_id`
                    LEFT JOIN `userorder` ON `userorder`.`OrderID` = `orderdetail`.`OrderID`
                    WHERE `userorder`.`Status` = 4');
        $statement = $db->prepare($query);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($data as $item) {
            $category = new DashBoard();
            $category->setTotalSellCategory($item['totalCategorySeller']);
            $category->setCategory($item['CategoryName']);
            $this->categorySeller[] = $category;
        }
        
        $db = null;
        $query = null;
        return $this;
    }
    public function getProductBestSeller(){
        $db = connect();

        $query = ('SELECT `product`.`Product_Name`, `product`.`price` ,`product`.`Created_at`, COUNT(`product_warranty`.`product_id`) as totalOrder, product_warranty.product_line
                    FROM `product_warranty`
                    LEFT JOIN `product` ON `product`.`Product_Line` = `product_warranty`.`product_line`
                    WHERE `product_warranty`.`purchased_at` IS NOT NULL
                    GROUP BY  `product_warranty`.`product_line`
                    ORDER BY `product`.`Price` DESC, totalOrder DESC
                    LIMIT 5
                    ;');
        $statement = $db->prepare($query);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($data as $item) {
            $product = new DashBoard();
            $product->setProductLine( $item['Product_Name']);
            $product->setPrice($item['price']);
            $product->setCreatedAt($item['Created_at']);
            $product->setTotalOrder($item['totalOrder']);
            $this->productSeller[] = $product;
        }
        
        $db = null;
        $query = null;
        return $this;
    }

    public function getTotalOrderStatus(){

        $db = connect();

        $query = ('    SELECT COUNT(`orderstatus`.`StatusID`) AS TotalOfStatus, `orderstatus`.`StatusName`
                         FROM `orderstatus`
                        LEFT JOIN `userorder` ON `userorder`.`Status` = `orderstatus`.`StatusID`
                      GROUP BY `orderstatus`.`StatusName`');
        $statement = $db->prepare($query);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($data as $item) {
            $orderStatus = new DashBoard();
            $orderStatus->setOrderStatusName( $item['StatusName']);
            $orderStatus->setOrderStatusTotal($item['TotalOfStatus']);
            $this->totalStatus[] = $orderStatus;
        }
        
        $db = null;
        $query = null;
        return $this;
    }
}