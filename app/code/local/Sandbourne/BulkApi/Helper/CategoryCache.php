<?php

class Sandbourne_BulkApi_Helper_CategoryCache extends Mage_Core_Helper_Abstract 
{
  private $categoryArray = array();
  
  public function __construct()
  {
    //$this->_debug('CategoryCache Helper constructed');
  }
  
  public function resetCache($categories)
  {
    $this->categoryArray = array();
    foreach($categories as $category)
    {
      $this->addCategory($category);
    }
  }
  
  public function addCategory($category)
  {
    array_push($this->categoryArray, $category);
  }
  
  public function getTopLevelCategories()
  {
    $rootCategories = array();
    foreach($this->categoryArray as $magentoCategory)
    {
      if ($magentoCategory->getLevel() == 1)
      {
        array_push($rootCategories, $magentoCategory);
      }
    }
    return $rootCategories;
  }

  public function findCategory($parentID, $categoryName)
  {
    foreach($this->categoryArray as $magentoCategory)
    {
      if ($magentoCategory->parent_id == $parentID &&
          strcmp($magentoCategory->name, $categoryName) == 0)
      {
        return $magentoCategory;
      }
    }
  }
  
  private function _debug($message)
  {
    Mage::log($message);
  }
}
