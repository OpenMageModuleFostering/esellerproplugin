<?php

class Sandbourne_BulkApi_Model_PartialProduct_Api extends Mage_Api_Model_Resource_Abstract
{
  public function __construct()
  {
    //$this->_debug('PartialProduct constructed');
  }
  
  public function update($productXML)
  {
    $resultXMLData = new DOMDocument();
    $productResultsXMLData = $resultXMLData->createElement('ProductResults');
    $resultXMLData->appendChild($productResultsXMLData);

    $productXMLData = simplexml_load_string($productXML);
    
    foreach ($productXMLData as $productData)
    {
      //$this->_debug($productData->StockNumber);
      $productResultXMLData = new DOMElement('ProductResult');
      $productResultsXMLData->appendChild($productResultXMLData);
      $this->updateProduct($productData, $productResultXMLData);
    }
  }
  
  private function updateProduct($productData, $productResultXMLData)
  {
    $productID = Mage::getModel('catalog/product')->getIdBySku($productData->StockNumber);
    if ($productID > 0)
    {
      //$this->_debug('product exists with id:'.$productID);
      $product = Mage::getModel('catalog/product')->load($productID);
      
      $active = ((string)$productData->IsActive === 'Y' ? 
              Mage_Catalog_Model_Product_Status::STATUS_ENABLED : 
              Mage_Catalog_Model_Product_Status::STATUS_DISABLED);

      $product->setStatus($active);
      $product->setPrice($productData->Price);
      
      $stockData = array();
      $stockData['qty'] = $productData->StockLevel;
      // Set the 'is_in_stock' to true incase this is a master,
      // if it is a subsku and the StockLevel is 0, this will automatically get set to false anyhow.
      //$inStock = ($productData->StockLevel > 0 ? 1 : 0);
      //$stockData['is_in_stock'] = $inStock;
      $stockData['is_in_stock'] = 1;
      
      //$this->_debug($productData);
      //$this->_debug($stockData);
      
      $product->setStockData($stockData);
      $product->save();
    }
  }
  
  public function _debug($message)
  {
    Mage::log($message);
  }
}
