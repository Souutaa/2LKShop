<?php

namespace App\Models;

use PDO;

class Categories {
  public $categories = [];

  public function readAll() {
    $db = connect();
    $query = ('SELECT * FROM category');
    $statement = $db->prepare($query);
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach($data as $item) {
      $category = new Category();
      $category->setCategoryID($item['CategoryID']);
      $category->setCategoryName($item['CategoryName']);
      $category->setCategoryDeleteAt($item['Deleted_At']);
      $this->categories[] = $category;
    }
    $db = null;
    $query = null;
    return $this;
  }
}