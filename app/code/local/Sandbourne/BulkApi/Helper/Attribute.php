<?php

/**
 * Attribute Helper Class.
 */

class Sandbourne_BulkApi_Helper_Attribute extends Mage_Core_Helper_Abstract 
{
  
  public function __construct()
  {
    //$this->_debug('Attribute Helper constructed');
  }
  
  public function getDefaultAttributeSetId()
  {
    $entityTypeId = Mage::getModel('eav/entity')->setType('catalog_product')->getTypeId();
    $attributeSetCollection = Mage::getResourceModel('eav/entity_attribute_set_collection')->setEntityTypeFilter($entityTypeId)->addFilter('attribute_set_name', 'Default');
  
    foreach($attributeSetCollection as $attributeSet)
    {
      return $attributeSet->getId();
    }
  }

  public function setVariationSpecificValues($magentoProduct, $variationData, $attributeCache)
  {
    //$this->_debug("**** setVariationSpecificValues ****");
    
    // We need to interogate the name of the attribute to make sure it is valid
    $productUtils = Mage::helper('bulkapi/utils');
  
    if (isset($variationData->VariationSpecifics))
    {
      foreach ($variationData->VariationSpecifics->NameValueList as $nameValueList)
      {
        // Check the custom field name about to be added is valid
        if ($productUtils->isCustomFieldValid($nameValueList->Name) === true)
        {
          $replacedChars = $productUtils->replaceInvalidChars($nameValueList->Name);
          $this->setCustomFieldValue($magentoProduct, $replacedChars, $nameValueList->Value, $attributeCache);
        }
      }
    }
  }
  
  public function setCustomFieldGroupValues($magentoProduct, $productData, $attributeCache)
  {
    if (isset($productData->CustomGroups))
    {
      foreach ($productData->CustomGroups->CustomGroup as $customGroup)
      {         
        // Test we want to import from this Customfield Group
        // What Customfield Groups do we want to use, or all of them if field is blank?
        // (JC) - Change this approach, if blank use the default "Magento" group.
        if ($this->canProcessCustomFieldGroup($productData->UseCustomGroups, $customGroup['groupName']))
        {
          $this->setCustomFieldValues($magentoProduct, $customGroup, $attributeCache);
        }
      }
    }
  }
  
  public function setCustomFieldValues($magentoProduct, $customGroup, $attributeCache)
  {
    // We need to interogate the name of the attribute to make sure it is valid
    $productUtils = Mage::helper('bulkapi/utils');
    
    foreach ($customGroup->CustomFields->NameValueList as $nameValueList)
    {
      // Check this attribute name is not reserved before adding it
      if ($productUtils->isAttributeReserved($nameValueList->Name) === false)
      {
        // Check the custom field name about to be added is valid
        if ($productUtils->isCustomFieldValid($nameValueList->Name) === true)
        {
          $replacedChars = $productUtils->replaceInvalidChars($nameValueList->Name);
          $this->setCustomFieldValue($magentoProduct, $replacedChars, $nameValueList->Value, $attributeCache);
        }
      }
    }
  }
  
  private function canProcessCustomFieldGroup($customFieldGroupToUse, $customFieldGroupName)
  {
    $retVal = false;
    $FieldsToUse = trim((string)$customFieldGroupToUse);
    $FieldGroupName = trim((string)$customFieldGroupName);
    
    // (JC) - If blank use the default "Magento" group if it exists.
    if (empty($FieldsToUse))
    {
      $FieldsToUse = "Magento";
    }
    
    //if ((strpos((string)$customFieldGroupToUse, (string)$customFieldGroupName) !== false) || strlen(trim($customFieldGroupToUse)) === 0)
    if (strpos($FieldsToUse, $FieldGroupName) !== false)
    {
      $retVal = true;
    }
    return $retVal;
  }
          
  private function setCustomFieldValue($magentoProduct, $attributeName, $attributeValue, $attributeCache)
  {
    $attribute = $attributeCache->getAttribute($attributeName);
    if (is_null($attribute))
    {
      $attribute = $this->createAttribute($attributeName, $magentoProduct->getAttributeSetId());
      $attributeCache->addAttribute($attribute);      
    }
    //We are not going to mess about with putting attributes
    //in sets if the customer has organised it differently    
    if ($attribute->isInSet($magentoProduct->getAttributeSetId()))
    {
      $this->getDefaultAttributeGroupId($magentoProduct->getAttributeSetId());
      if (!is_null($attribute))
      {
        if ($attribute->usesSource())
        {
          $attributeOption = $attributeCache->getAttributeOption($attributeName, $attributeValue);
          //$attributeValueId = $this->findAttributeValueId($attributeValue, $attribute->getSource()->getAllOptions());
          //$this->_debug('attribute value id:'.$attributeValueId);
          if (is_null($attributeOption))
          {
            $attributeOption = $this->addAttributeOption($attributeValue, $attribute, $attributeCache);
          }
          //$this->_debug('setting attribute: '.$attribute->getAttributeCode().' to: '.$attributeOption['value']);
          //$this->_debug('previous attribute value: '.$attribute->getAttributeCode().' to: '.$magentoProduct->getData($attribute->getAttributeCode()));

          $magentoProduct->setData($attribute->getAttributeCode(), $attributeOption['value']);
        }
        else
        {

        }
        //$this->_debug($attribute->getFrontendLabel().':'.$attribute->getBackendType());
      }
    }
  }
  
  private function createAttribute($attributeName, $attributeSetId)
  {
    //$this->_debug('call to create attribute: '.$attributeName.$attributeSetId);
    $attribute = Mage::getModel('catalog/resource_eav_attribute');
    $data = array();
  
    $attributeCode = strtolower($attributeName);
    //$attributeCode = str_replace(' ', '_', $attributeCode);
    //$this->_debug($attributeCode);
    //$this->_debug($attributeName);
  
    $data['attribute_code'] = $attributeCode;
    $data['frontend_label'] = array($attributeName, '','','','');
    $data['apply_to'] = array('simple', 'configurable');
    $data['is_configurable'] = '1';
    $data['is_filterable'] = '1';
    $data['is_filterable_in_search'] = '1';
    $data['frontend_input'] = 'select';
    $data['backend_type'] = 'int';
    $data['is_global'] = Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL;
    $attribute->addData($data);
  
    $attribute->setAttributeSetId($attributeSetId);
    $defaultGroupId = $this->getDefaultAttributeGroupId($attributeSetId);
    $attribute->setAttributeGroupId($defaultGroupId);
    
    //$this->_debug('going to create attribute with set id: '.$attribute->getAttributeSetId().' and group id: '.$attribute->getAttributeGroupId());
    $entityTypeID = Mage::getModel('eav/entity')->setType('catalog_product')->getTypeId();
    $attribute->setEntityTypeId($entityTypeID);
    $attribute->setIsUserDefined(1);
    $attribute->save();    
    //$this->_debug('created attribute with id'.$attribute->getId());
    return $attribute;
  }
  
  //to fetch the attribute group collection
  private function getDefaultAttributeGroupId($attributeSetId)
  {
    $attributeGroups = Mage::getResourceModel('eav/entity_attribute_group_collection');
    $attributeGroups->setAttributeSetFilter($attributeSetId);
    $attributeGroups->load();
    $firstGroupId = -1;
    
    foreach($attributeGroups as $group)
    {
      if ($firstGroupId === -1)
      {
        $firstGroupId = $group->getId();
      }
      
      if ($group->getDefaultId() == 1)
      {
        return $group->getId();
      }
    }
    return $firstGroupId;
  }
  /*
  $attributeSetCollection = Mage::getResourceModel('eav/entity_attribute_group_collection')
                              ->load();*/
  
  private function addAttributeOption($optionValue, $attribute, $attributeCache)
  {
    $optionLabels[0] = $optionValue;
    $optionData = array();
    $optionData['value'] = array('option_1' => $optionLabels);
    $optionData['order'] = array('option_1' => 1);//order

    $modelData = array('option' => $optionData);
    
    $attribute->addData($modelData);
    $attribute->save();

    //we need to load the attribute again to get the newly added option
    $resetAttribute = Mage::getModel('catalog/resource_eav_attribute')->load($attribute->getId());
    $attributeCache->resetAttribute($resetAttribute);
    $attributeOption = $attributeCache->getAttributeOption($resetAttribute->getAttributeCode(), $optionValue);
    
    return $attributeOption;
  }
   
  public function _debug($message)
  {
    Mage::log($message);
  }
}
