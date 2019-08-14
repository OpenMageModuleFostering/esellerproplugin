<?php

class Sandbourne_BulkApi_Helper_AttributeOptionCache extends Mage_Core_Helper_Abstract
{
  private $attributeOptionArray = array();
  
  public function __construct()
  {
    //$this->_debug('AttributeOptionCache Helper constructed');
  }
  
  public function resetCache($attributeOptions)
  {
    $this->atrributeOptionArray = array();
    foreach ($attributeOptions as $attributeOption)
    {
      $this->addAttributeOption($attributeOption);
    }
  }
  
  public function getAttributeOption($attributeOptionLabel)
  {
    $lowerCaseLabel = strtolower($attributeOptionLabel);
    if (array_key_exists($lowerCaseLabel, $this->attributeOptionArray))
    {
      return $this->attributeOptionArray[$lowerCaseLabel];
    }
  }
  
  public function addAttributeOption($attributeOption)
  {
    $lowerCaseLabel = strtolower($attributeOption['label']);
    $this->attributeOptionArray[$lowerCaseLabel] = $attributeOption;
  }

  private function _debug($message)
  {
    Mage::log($message);
  }
}
