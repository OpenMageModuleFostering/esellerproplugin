<?php

class Sandbourne_BulkApi_Helper_AttributeCache extends Mage_Core_Helper_Abstract
{
  private $attributeArray = array();
  private $attributeOptionCacheArray = array();
  
  public function __construct()
  {
    //$this->_debug('AttributeCache Helper constructed');
  }
  
  public function resetCache($attributes)
  {
    $this->attributeArray = array();
    $this->attributeOptionCacheArray = array();
    foreach ($attributes as $attribute)
    {
      $this->addAttribute($attribute);
      /*if ($attribute->usesSource())
      {
        $this->_debug('attribute name:'.$attribute->getName());
        $this->_debug('attribute source class:'.get_class($attribute->getSource()));
      }*/
    }
  }
  
  public function addAttribute($attribute)
  {
    $lowerCaseAttributeCode = strtolower($attribute->getAttributeCode());
    //$this->_debug('adding attribute to cache:'.$lowerCaseAttributeCode);
    //$this->_debug('adding attribute to cache with set id: '.$attribute->getAttributeSetId().' and group id: '.$attribute->getAttributeGroupId());
    $this->attributeArray[$lowerCaseAttributeCode] = $attribute;
  }

  public function resetAttribute($attribute)
  {
    $lowerCaseAttributeCode = strtolower($attribute->getAttributeCode());
    $this->attributeArray[$lowerCaseAttributeCode] = $attribute;
    if (array_key_exists($lowerCaseAttributeCode, $this->attributeOptionCacheArray))
    {
      $attributeOptionCache = Mage::helper('bulkapi/attributeOptionCache');
      $options = $attribute->getSource()->getAllOptions();
      $attributeOptionCache->resetCache($options);
      $this->attributeOptionCacheArray[$lowerCaseAttributeCode] = $attributeOptionCache;
    }
  }

  public function getAttribute($attributeCode)
  {
    $lowerCaseAttributeCode = strtolower($attributeCode);
    if (array_key_exists($lowerCaseAttributeCode, $this->attributeArray))
    {
      //$this->_debug('attribute found in cache:'.$lowerCaseAttributeCode);
      return $this->attributeArray[$lowerCaseAttributeCode];
    }
    //$this->_debug('attribute not found in cache:'.$lowerCaseAttributeCode);
  }

  public function getAttributeOption($attributeCode, $attributeOptionLabel)
  {
    $attribute = $this->getAttribute($attributeCode);
    if (!is_null($attribute))
    {
      $lowerCaseAttributeCode = strtolower($attributeCode);
      if (!array_key_exists($lowerCaseAttributeCode, $this->attributeOptionCacheArray))
      {
        $attributeOptionCache = Mage::helper('bulkapi/attributeOptionCache');
        $options = $attribute->getSource()->getAllOptions();
        $attributeOptionCache->resetCache($options);
        $this->attributeOptionCacheArray[$lowerCaseAttributeCode] = $attributeOptionCache;
      }
      
      $attributeOptionCache = $this->attributeOptionCacheArray[$lowerCaseAttributeCode];
      return $attributeOptionCache->getAttributeOption($attributeOptionLabel);
    }
  }

  public function addAttributeOption($attributeCode, $attributeOption)
  {
    $attribute = $this->getAttribute($attributeCode);
    if (!is_null($attribute))
    {
      $lowerCaseAttributeCode = strtolower($attributeCode);
      if (array_key_exists($lowerCaseAttributeCode, $this->attributeOptionCacheArray))
      {
        $attributeOptionCache = $this->attributeOptionCacheArray[$lowerCaseAttributeCode];
        $attributeOptionCache->addAttributeOption($attributeOption);
      }
    }    
  }
  
  private function _debug($message)
  {
    Mage::log($message);
  }
}
