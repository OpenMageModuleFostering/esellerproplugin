<?php

class Sandbourne_BulkApi_Helper_Category extends Mage_Core_Helper_Abstract 
{
  public function __construct()
  {
    //$this->_debug('Category Helper constructed');
  }

  public function setProductCategories($magentoProduct, $productData)
  {
    $categoryTreeModel = Mage::getModel('catalog/category')->getTreeModel();
    $categoryTreeModel->load();
    $categoryCache = Mage::helper('bulkapi/categoryCache');
    $categoryCache->resetCache($categoryTreeModel->getCollection());
    
    //$rootCategories = $categoryCache->getTopLevelCategories();
  
    $categoryIds = array();
    foreach ($productData->ProductCategories->ProductCategory as $productCategory)
    {
      //$magentoCategories = $rootCategories;
  
      //$this->_debug((string)$productCategory);
      $categoryParts = explode('>', (string)$productCategory);
      $foundCategory = NULL;
      $path = '1';
      $currentParentID = 1;
      
      foreach($categoryParts as $categoryPart)
      {
        $foundCategory = $categoryCache->findCategory($currentParentID, $categoryPart);
        //$foundCategory = $this->findCategory($magentoCategories, $categoryPart);
        if (isset($foundCategory))
        {
          //$magentoCategories = $foundCategory->getChildrenCategories();
        }
        else
        {
          $foundCategory = Mage::getModel('catalog/category');
          $foundCategory->setStoreId(0);
          $foundCategory->setName($categoryPart);
          $foundCategory->setPath($path);
          $foundCategory->setIsActive(1);
          $foundCategory->save();
          $categoryCache->addCategory($foundCategory);
          //$magentoCategories = $foundCategory->getChildrenCategories();
        }
        $path = $path.'/'.$foundCategory->getId();
        $currentParentID = $foundCategory->getId();
      }
      if (isset($foundCategory))
      {
        //$this->_debug('found:'.$foundCategory->getName());
        array_push($categoryIds, $foundCategory->getId());
      }
    }
    $magentoProduct->setCategoryIds($categoryIds);
  }
  
  private function findCategory($magentoCategories, $categoryName)
  {
    foreach($magentoCategories as $magentoCategory)
    {
      if (strcmp($magentoCategory->getName(), $categoryName)==0)
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
