<?php

/**
 * Related Products Helper Class, for setting the associated website for the current product.
 */

class Sandbourne_BulkApi_Helper_RelatedProducts extends Mage_Core_Helper_Abstract
{

  public function __construct()
  {
    //$this->_debug('Related Products Helper constructed');
  }

  public function getRelatedProducts($productData)
  {
    //$this->_debug('getRelatedProducts($productData)');
    $relatedProductsList = array();
    $elementCount = 0;

    if (isset($productData->RelatedProducts))
    {
      foreach ($productData->RelatedProducts->RelatedStockNumber as $relatedStockNumber)
      {
        $searchStockNumber = (string)$relatedStockNumber[0];
        $relatedProductID = Mage::getModel('catalog/product')->getIdBySku($searchStockNumber);

        if (!empty($relatedProductID))
        {
          $relatedProductsList[(string)$relatedProductID] = array('position' => (string)$elementCount++);
        }
      }
    }
    //$this->_debug($productData->RelatedProducts->RelatedStockNumber);
    //$this->_debug($relatedProductsList);
    return $relatedProductsList;
  }

  private function _debug($message)
  {
    Mage::log($message);
  }
}
