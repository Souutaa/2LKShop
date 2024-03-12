<?php

namespace App\Models;
use PDO;

class DashBoard{
    protected string $productLine;
    protected int $price;
    protected int $totalOrder;
    protected string $created_at;

    protected string $orderStatusName;
    protected int $orderStatusTotal;

    protected string $category;
    protected int $totalSellCategory;

    protected int $totalRevenue;
    protected int $month;

    public function getTotalRevenue()
    {
        return $this->totalRevenue;
    }
    public function seTotalRevenue($totalRevenue)
    {
        $this->totalRevenue = $totalRevenue;

    }
    public function getMonth()
    {
        return $this->month;
    }
    public function setMonth($month)
    {
        $this->month = $month;

    }
    public function getCategory()
    {
        return $this->category;
    }
    public function setCategory($category)
    {
        $this->category = $category;

    }
    public function getTotalSellCategory()
    {
        return $this->totalSellCategory;
    }
    public function setTotalSellCategory($totalSellCategory)
    {
        $this->totalSellCategory = $totalSellCategory;

    }
    public function getProductLine()
    {
        return $this->productLine;
    }
    public function setProductLine($productLine)
    {
        $this->productLine = $productLine;

    }
    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice($price)
    {
        $this->price = $price;

    }
    public function getTotalOrder()
    {
        return $this->totalOrder;
    }
    public function setTotalOrder($totalOrder)
    {
        $this->totalOrder = $totalOrder;

    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

    }
    public function getOrderStatusName()
    {
        return $this->orderStatusName;
    }
    public function setOrderStatusName($orderStatusName)
    {
        $this->orderStatusName = $orderStatusName;

    }
    public function getOrderStatusTotal()
    {
        return $this->orderStatusTotal;
    }
    public function setOrderStatusTotal($orderStatusTotal)
    {
        $this->orderStatusTotal = $orderStatusTotal;

    }

}

?>