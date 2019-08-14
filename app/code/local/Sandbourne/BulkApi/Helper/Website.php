<?php

/**
 * Website Helper Class, for setting the associated website for the current product.
 */

class Sandbourne_BulkApi_Helper_Website extends Mage_Core_Helper_Abstract
{
  //const MAGENTO_CUSTOM_GROUP_NAME = "Magento";

  public function __construct()
  {
    //$this->_debug('Website Helper constructed');
  }

  public function getProductWebsiteIDs($productData)
  {
    $currentWebsites = $this->getCurrentWebsites();
    $productWebsites = $this->getProductWebsites($productData);
    $result = array();

    foreach ($productWebsites as $website)
    {
      if (array_search($website, $currentWebsites, true))
      {
        array_push($result, array_search($website, $currentWebsites, true));
      }
    }
    if (empty($result))
    {
      array_push($result, 1);
    }
    return $result;
  }

  private function getCurrentWebsites()
  {
    $currentWebsites = array();

    foreach (Mage::app()->getWebsites() as $website)
    {
      // Remove the whitespace from the magento website names to match the whitespace removed from the XML.
      $currentWebsites[$website->getID()] = str_replace(" ", "", $website->getName());
    }
    return $currentWebsites;
  }

  private function getProductWebsites($productData)
  {
    $result = array();

    if (isset($productData->CustomGroups))
    {      
      $siteCustomFields = array();
      
      $lookUseCustomGroups = trim($productData->UseCustomGroups);
      if (!$lookUseCustomGroups)
      {
        $lookUseCustomGroups = "Magento";
      }
      $lookUseCustomGroups = explode(',', $lookUseCustomGroups);
      	
      foreach ($productData->CustomGroups->CustomGroup as $customGroup)
      {
        // Only check for Custom Groups that have been specified in the field "Use Custom Groups".
        // If no Custom Group has been defined, use the default group.
        foreach ($lookUseCustomGroups as $lookUseCustomGroup)
        {
          if ((string)$customGroup['groupName'] === trim($lookUseCustomGroup))
          {
            $siteCustomFields = $siteCustomFields + $this->getSiteCustomFields($customGroup);
          }
        }                
        //$siteCustomFields = $siteCustomFields + $this->getSiteCustomFields($customGroup);
      }
      $productWebsites = $this->getAllProductWebsites($siteCustomFields);
      if (isset($productWebsites))
      {
        $result = $productWebsites;
      }
    }
    return $result;
  }

  private function getSiteCustomFields($customGroup)
  {
    $siteCustomFields = array();

    foreach ($customGroup->CustomFields->NameValueList as $nameValueList)
    {
      if (!empty($nameValueList))
      {
        if (substr($nameValueList->Name, 0, 5) === "SITE:")
        {
          array_push($siteCustomFields, $nameValueList);
        }
      }
    }
    return $siteCustomFields;
  }

  private function getAllProductWebsites($siteCustomFields)
  {
    $productWebsites = array();

    foreach ($siteCustomFields as $nameValue)
    {
      if (strtolower((string)$nameValue->Value) === "y")
      {
        array_push($productWebsites, str_replace("SITE:", "", $nameValue->Name));
      }
    }
    return $productWebsites;
  }

  private function _debug($message)
  {
    Mage::log($message);
  }
}
