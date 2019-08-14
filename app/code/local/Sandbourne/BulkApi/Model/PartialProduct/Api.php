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
      $product = Mage::getModel('catalog/product')->load($productID);
      
      $active = ((string)$productData->IsActive === 'Y' ? 
              Mage_Catalog_Model_Product_Status::STATUS_ENABLED : 
              Mage_Catalog_Model_Product_Status::STATUS_DISABLED);

      $product->setStatus($active);
      $product->setPrice($productData->Price);
         
      // Include sales price info
      // 20150730 - Currently on a partial update, only SalePrice is sent via the XML if the OnSale flag is set
      if ((string)$productData->SalePrice > '0')
      {
      	$product->setSpecialPrice($productData->SalePrice);
      }
      else
      {
      	$product->setSpecialPrice('');
      	$product->setSpecialFromDate('');
      	$product->setSpecialToDate('');
      }
      
      $stockData = array();
      $stockData['qty'] = $productData->StockLevel;
      // Set the 'is_in_stock' to true incase this is a master,
      // if it is a subsku and the StockLevel is 0, this will automatically get set to false anyhow.
      //$inStock = ($productData->StockLevel > 0 ? 1 : 0);
      //$stockData['is_in_stock'] = $inStock;
      $stockData['is_in_stock'] = 1;
           
      $product->setStockData($stockData);
      $product->save();
      
      // After we have saved all the details, lets check to see if we need to update variation scale prices.
      if (strcmp($productData->ScalePricing,'Y') == 0)
      {
        $pricesHelper = Mage::helper('bulkapi/prices');
        $pricesHelper->scalePrices($product);
      }
    }
  }
  
  public function _debug($message)
  {
    Mage::log($message);
  }
}
