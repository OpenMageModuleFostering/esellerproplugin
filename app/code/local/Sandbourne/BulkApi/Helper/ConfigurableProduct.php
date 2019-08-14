<?php

class Sandbourne_BulkApi_Helper_ConfigurableProduct extends Mage_Core_Helper_Abstract
{
  public function __construct()
  {
    //$this->_debug('ConfigurableProduct Helper constructed');
  }
  
  public function setConfigurableProducts($magentoProduct, $productData, $attributeCache)
  {
    $attributeHelper = Mage::helper('bulkapi/attribute');
    $arrayHelper = Mage::helper('bulkapi/array');
    
    $this->setupSimpleProducts($magentoProduct, $productData, $attributeCache);
    
    $usedAttributes = $this->getUsedProductAttributes($productData, $attributeCache);
    
    $configurableAttributesData = $this->buildConfigurableAttributesData($usedAttributes, $magentoProduct, $productData, $attributeCache);

    $usedAttributeIDs = array();
    foreach($configurableAttributesData as $configurableAttribute)
    {
      array_push($usedAttributeIDs, $configurableAttribute['attribute_id']);
    }
    
    $configurableProductId = $magentoProduct->getId();
    if (!isset($configurableProductId))
    {
      //$this->_debug('setting used product attribute ids');
      $magentoProduct->setUsedProductAttributeIds($usedAttributeIDs);
    }
    
    //$this->_debug('configurable product attribute IDs');
    //$this->_debug($usedAttributeIDs);
    
    $configurableProductData = $this->buildConfigurableProductsData($magentoProduct, $productData, $attributeCache);
    //$this->_debug($configurableProductData);
    //$magentoProduct->setCanSaveConfigurableAttributes(true);
    //$magentoProduct->setCanSaveCustomOptions(true);
    $magentoProduct->setConfigurableProductsData($configurableProductData);
    if (!isset($configurableProductId))
    {
      $magentoProduct->setConfigurableAttributesData($configurableAttributesData);
    }
  }
  
  private function setupSimpleProducts($magentoProduct, $productData, $attributeCache)
  {
    $attributeHelper = Mage::helper('bulkapi/attribute');
    foreach ($productData->Variations->Variation as $variationData)
    {
      $variationProductID = Mage::getModel('catalog/product')->getIdBySku($variationData->StockNumber);
      if ($variationProductID > 0)
      {
        $simpleProduct = Mage::getModel('catalog/product')->load($variationProductID);
      }
      else
      {
        $simpleProduct = $this->createSimpleProduct($magentoProduct, $variationData);
      }

      $attributeHelper->setVariationSpecificValues($simpleProduct, $variationData, $attributeCache);
      $simpleProduct->save();
    }
  }
  
  private function buildConfigurableProductsData($magentoProduct, $productData, $attributeCache)
  {
    foreach ($productData->Variations->Variation as $variationData)
    {
      //$this->_debug($variationData->StockNumber);
      $variationProductID = Mage::getModel('catalog/product')->getIdBySku($variationData->StockNumber);
      //$this->_debug('simple product id:'.$variationProductID);
      
      $associatedProductData = array();
      //$associatedProductData['attribute_id'] = 92;
      $configurableProductData[$variationProductID] = $associatedProductData;
    }
    return $configurableProductData;
  }

  private function buildConfigurableAttributesData($usedAttributes, $magentoProduct, $productData, $attributeCache)
  {
    $attributeHelper = Mage::helper('bulkapi/attribute');
    $arrayHelper = Mage::helper('bulkapi/array');
    
    //$attributesArray = $magentoProduct->getTypeInstance(true)->getConfigurableAttributesAsArray($magentoProduct);
    //$this->_debug($attributes_array);
    $attributesArray = array();
    
    foreach ($usedAttributes as $usedAttribute)
    {
      $configurableAttributeIndex = $arrayHelper->findItemKeyUsingEquals('attribute_id', $usedAttribute->getId(), $attributesArray);

      $configurableAttribute = array();
      if (!is_null($configurableAttributeIndex))
      {
        $configurableAttribute = $attributesArray[$configurableAttributeIndex];
      }
      else
      {
        $configurableAttribute['attribute_id'] = $usedAttribute->getId();
        $configurableAttribute['values'] = array();
        $configurableAttributeIndex = array_push($attributesArray, $configurableAttribute) - 1;
      }

      $values = $configurableAttribute['values'];
      
      foreach ($productData->Variations->Variation as $variationData)
      {
        $productAttributeValue = $this->findProductAttributeValue($usedAttribute->getAttributeCode(), $variationData);
        if (!is_null($productAttributeValue))
        {
          //got the correct attribute. Now get it's value
          $attributeOption = $attributeCache->getAttributeOption($usedAttribute->getAttributeCode(), $productAttributeValue);

          //if null need to add another attribute option and set it on the simple product
          if (!is_null($attributeOption))
          {
            //$this->_debug($attributeOption);
            //find the value section in $configurableAttributeArray
            //$configurableAttributeValueArray = $this->findConfigurableAttributeValueArray($attributeOption['value'], $configurableAttributeArray['values']);
            $valueItem = $arrayHelper->findItemUsingEquals('value_index', $attributeOption['value'], $values);
            if (is_null($valueItem))
            {
              $valueItem = array();
              $valueItem['value_index'] = $attributeOption['value'];
              $valueItem['pricing_value'] = 0;
              $valueItem['is_percent'] = 0;
              array_push($attributesArray[$configurableAttributeIndex]['values'], $valueItem);
            }
          }
        }
      }
    }
    return $attributesArray;
  }
  
  private function createSimpleProduct($configurableProduct, $variationData)
  {
    $simpleProduct = Mage::getModel('catalog/product');
    $simpleProduct->setWebsiteIds(array(1));
    $simpleProduct->setSku($variationData->StockNumber);
    $simpleProduct->setName($variationData->StockNumber);//need to change to parent name plus variation values
    $simpleProduct->setTypeId(Mage_Catalog_Model_Product_Type::TYPE_SIMPLE);
    $simpleProduct->setAttributeSetId($configurableProduct->getAttributeSetId());
    $simpleProduct->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_NOT_VISIBLE);
    $simpleProduct->setPrice($variationData->SellPrice);
    $simpleProduct->setTaxClassId(2);
    $simpleProduct->setWeight(1);
    $simpleProduct->setDescription('description');
    $simpleProduct->setShortDescription('short description');
    $simpleProduct->setStatus(Mage_Catalog_Model_Product_Status::STATUS_ENABLED);
    
    $stockData = array();
    $stockData['qty'] = $variationData->StockLevel;
    $inStock = ($variationData->StockLevel > 0 ? 1 : 0);
    $stockData['is_in_stock'] = $inStock;
    
    $simpleProduct->setStockData($stockData);
    
    return $simpleProduct;
  }
  
  private function getUsedProductAttributes($productData, $attributeCache)
  {
    $utilsHelper = Mage::helper('bulkapi/utils');
    
    //$this->_debug('getUsedProductAttributes called');
    $attributeNames = array();
    if (isset($productData->Variations))
    {
      foreach ($productData->Variations->Variation as $variationData)
      {
        foreach ($variationData->VariationSpecifics->NameValueList as $nameValueItem)
        {
          if (!in_array($nameValueItem->Name, $attributeNames))
          {
            array_push($attributeNames, (string)$nameValueItem->Name);
          }
        }
      }
    }
    //$this->_debug('attribute names for configurable product:');
    //$this->_debug($attributeNames);
    $attributeIDList = array();
    foreach ($attributeNames as $attributeName)
    {
      $attributeName = $utilsHelper->replaceInvalidChars($attributeName);
      $attribute = $attributeCache->getAttribute($attributeName);
      
      if (!is_null($attribute))
      {
        array_push($attributeIDList, $attribute);
      }
    }
    return $attributeIDList;
  }

  private function findProductAttributeValue($attributeCode, $variationData)
  {
    $productAttributeValues = array();
    
    foreach ($variationData->VariationSpecifics->NameValueList as $nameValueItem)
    {
      if(strcasecmp($nameValueItem->Name, $attributeCode) == 0)
      {
        return $nameValueItem->Value;
      }
    }    
  }

  private function _debug($message)
  {
    Mage::log($message);
  }
}
