<?php

/**
 * 
 * Prices Helper Class.
 * @author Jason Cyphus
 *
 */

class Sandbourne_BulkApi_Helper_Prices extends Mage_Core_Helper_Abstract
{
  public function __construct()
  {
    //$this->_debug('Price Data Helper constructed');
  }
  
  public function scalePrices($product)
  {
    /** 
	 * $product = The current product we have saved to Magento
	 * 
	 * Populate the configurable product (master), super product attributes configuration table.
	 * Whether we are updating just the configurable product (master), a simple product (variation) or both,
	 * we need to calculate all the prices to stay in sync.
	 */
    
    // Get the configurable Id
    $configurableId = $this->getConfigurableId($product);
    
    // Check we actually have a configurable product
    if ($configurableId > 0)
    {
      // Get the configurable product and associated base price
      // Please note the price will not be the actual configurable, price but the cheapest price from all the simple products
      $configurableProduct = Mage::getSingleton("catalog/Product")->load($configurableId);
      $configurablePrice = $configurableProduct->getPrice();
      
      // Get current attribute data
      $configurableAttributesData = $configurableProduct->getTypeInstance()->getConfigurableAttributesAsArray();
      $configurableProductsData = array();
      
      // We need to identify the attribute name and Id
      $prodAttrName = $this->getAttributeName($configurableProduct);
      $prodAttrId = $this->getAttributeId($prodAttrName);
      
      // Get associates simple products
      $associatedProducts = $configurableProduct->getTypeInstance()->getUsedProducts();
      foreach ($associatedProducts as $prodList)
      {
        // For each associated simple product gather the data and calculate the extra fixed price
        $prodId = $prodList->getId();
        $prodAttrLabel = $prodList->getAttributeText($prodAttrName);
        $prodAttrValueIndex = $prodList[$prodAttrName];
        $prodScalePrice = $prodList['price'] - $configurablePrice;
     
        $productData = array(
            'label'         => $prodAttrLabel,
            'attribute_id'  => $prodAttrId,
            'value_index'   => $prodAttrValueIndex,
            'pricing_value' => $prodScalePrice,
            'is_percent'    => '0'
            );
        $configurableProductsData[$prodId] = $productData;
        $configurableAttributesData[0]['values'][] = $productData;
      }
            
      $configurableProduct->setConfigurableProductsData($configurableProductsData);
      $configurableProduct->setConfigurableAttributesData($configurableAttributesData);
      $configurableProduct->setCanSaveConfigurableAttributes(true);
      Mage::log($configurableProductsData, null, 'configurableProductsData.log', true);
      Mage::log($configurableAttributesData, null, 'configurableAttributesData.log', true);
            
      try
      {
        $configurableProduct->save();        
      }
      catch (Exception $e)
      {
        $this->_debug($e->getMessage());
      }
      
    }   
  }
  
  public function getConfigurableId($product)
  {
    $configurableId = 0;
    
    if ($product->getTypeId() == 'simple')
    {
      // Grab the simple product Id, to find the configurable product Id
      $simpleId = $product->getID();
      $parentIds = Mage::getResourceSingleton('catalog/product_type_configurable')->getParentIdsByChild($simpleId);
      if ($parentIds != null)
      {
        $configproduct = Mage::getModel('catalog/product')->load($parentIds[0]);
        $configurableId = $configproduct->getId();
      }
    }
    else  // We are already on the configurable product
    {
      $configurableId = $product->getID();
    }
    return $configurableId;
  }
  
  public function getAttributeName($configurableProduct)
  {
    $attrs  = $configurableProduct->getTypeInstance(true)->getConfigurableAttributesAsArray($configurableProduct);
    //foreach($attrs as $attr)
    //{
    //  $this->_debug($attr['attribute_code']);
    //  $options = $attr['values'];
    //  foreach($options as $option)
    //  {
    //    $this->_debug($option['store_label']);
    //  }
    //}
    return($attrs[0]['attribute_code']);
  }
  
  public function getAttributeId($prodAttrName)
  {
    $attrDetails = Mage::getSingleton("eav/config")->getAttribute('catalog_product', $prodAttrName);
    $attribute = $attrDetails->getData();
    $prodAttrId = $attribute['attribute_id'];
    return $prodAttrId;
  }
  
  public function _debug($message)
  {
    Mage::log($message);
  }
}