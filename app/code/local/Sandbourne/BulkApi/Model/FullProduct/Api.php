<?php

class Sandbourne_BulkApi_Model_FullProduct_Api extends Mage_Api_Model_Resource_Abstract
{
  public function __construct()
  {
    //$this->_debug('FullProduct constructed');
  }

  public function version()
  {
    //return "1.0.0.6";	// 20140604 (Beta)
    //return "1.0.0.7";	// 20140702 (Beta)
    //return "1.1.0.0";	// 20141017 (First Stable release)
    //return "1.1.0.1";	// 20141121
    //return "1.1.0.2";	// 20150421
    //return "1.1.0.3";	// 20150618
    //return "1.1.1.0";	// 20150724 (enhancements 88826, 88828)
    //return "1.1.1.1";	// 20150730 (improvement 88168)
    //return "1.1.1.2"; // 20151125 (Change request be Creative)  
    //return "1.1.2.0";   // 20151012 (scale prices 92003 - Needs Testing)
    return "1.1.2.1"; // 201500209 (duplicated images on Website- request from Creative) 
  }

  public function update($productXML)
  {
    $resultXMLData = new DOMDocument();
    $productResultsXMLData = $resultXMLData->createElement('ProductResults');
    $resultXMLData->appendChild($productResultsXMLData);
    $productXMLData = simplexml_load_string($productXML);

    $attributeHelper = Mage::helper('bulkapi/attribute');
    $defaultAttributeSetId = $attributeHelper->getDefaultAttributeSetId();
    $magentoAttributeList = Mage::getResourceModel('catalog/product_attribute_collection')->addVisibleFilter();

    $attributeCache = Mage::helper('bulkapi/attributeCache');
    $attributeCache->resetCache($magentoAttributeList);

    foreach ($productXMLData as $productData)
    {
      $productResultXMLData = new DOMElement('ProductResult');
      $productResultsXMLData->appendChild($productResultXMLData);
      $this->updateOrCreateProduct($productData, $defaultAttributeSetId, $productResultXMLData, $attributeCache);
    }
    return $resultXMLData->saveXML();
  }

  private function updateOrCreateProduct($productData, $defaultAttributeSetId, $productResultXMLData, $attributeCache)
  {
    $productResultXMLData->appendChild(new DOMElement('StockNumber', $productData->StockNumber));
    $productID = Mage::getModel('catalog/product')->getIdBySku($productData->StockNumber);
    $addUpdateProduct = false;
    
    // If the following SKUType is a SubSKU, we need to ignore the Variations node, as we do not want any attached listing SKU's.
    if ((string)$productData->SKUType == "Sub")
    {
      $configurableDataSentFlag = 0;
    }
    else
    {
      $configurableDataSentFlag = (strcmp($productData->UseVariations,'Y') == 0);
    }
    
    if ($productID > 0)
    {
      // Product exists.
      $addUpdateProduct = true;
      $product = Mage::getModel('catalog/product')->load($productID);
    }
    else
    {
      // Product doesn't exist, but we only want to create it, if it is active.  
      if ((string)$productData->IsActive === 'Y')
      {
        $addUpdateProduct = true;
      }
      
      if ($addUpdateProduct)
      {
        $product = Mage::getModel('catalog/product');
        $product->setSku($productData->StockNumber);
        
        // Before setting the Product Type we need to know what the SKU type is, as only the "Master" can be configurable.
        // SKUTypes = "Master", "Sub" or "Listing".
        if ($configurableDataSentFlag && (string)$productData->SKUType == "Master")
        {
          $product->setTypeId(Mage_Catalog_Model_Product_Type::TYPE_CONFIGURABLE);
        }
        else
        {
          $product->setTypeId(Mage_Catalog_Model_Product_Type::TYPE_SIMPLE);
        }

        $product->setAttributeSetId($defaultAttributeSetId);
        $product->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH);
      }
    }
    
    if ($addUpdateProduct)
    {
      // Define the websites to use for the product
      $productWebsites = Mage::helper('bulkapi/website');
      $product->setWebsiteIds($productWebsites->getProductWebsiteIDs($productData));
      
      // Assign any related products associated for the product
      $productRelatedProducts = Mage::helper('bulkapi/relatedProducts');
      $product->setRelatedLinkData($productRelatedProducts->getRelatedProducts($productData));

      // Check to see if we have been asked to ignore categories
      $this->setProductProperties($product,$productData);
      if (strcmp($productData->IgnoreCategories,'Y') != 0)
      {
        $categoryHelper = Mage::helper('bulkapi/category');
        $categoryHelper->setProductCategories($product,$productData);
      }
      
      // Check to see if we have been asked to ignore custom fields
      if (strcmp($productData->IgnoreCustomFields,'Y') != 0)
      {
        $attributeHelper = Mage::helper('bulkapi/attribute');
        $attributeHelper->setCustomFieldGroupValues($product,$productData, $attributeCache);
      }
      
      // Check to see if we have been asked to ignore images
      if (strcmp($productData->IgnoreImages,'Y') != 0)
      {
      	$imageHelper = Mage::helper('bulkapi/image');
      	$imageHelper->setImageList($product, $productData, $productResultXMLData);  //$magentoAttributeList);
      }
      
      if ($configurableDataSentFlag)
      {
        $configurableHelper = Mage::helper('bulkapi/configurableProduct');
        $configurableHelper->setConfigurableProducts($product, $productData, $attributeCache);
      }
      $product->save();
      
      // After we have saved all the details, lets check to see if we need to update variation scale prices.
      if (strcmp($productData->ScalePricing,'Y') == 0)
      {
        $pricesHelper = Mage::helper('bulkapi/prices');
        $pricesHelper->scalePrices($product);
      }
    }
  }

  private function setProductProperties($magentoProduct, $productData)
  {
    $title = $this->getTitle($productData);
    $magentoProduct->setName($title);
    $magentoProduct->setMetaTitle($title);
    
    // Change request be Creative.
    // Set release date
    if ((string)$productData->NewRelease == "Y" && $date = (string)$productData->ReleaseDate)
    {
      $magentoProduct->setData('news_from_date', $date);
      $magentoProduct->setData('news_to_date', date("Y-m-d", strtotime("+2 weeks",strtotime($date))));
    }
    else
    {
      $magentoProduct->setData('news_from_date', "");
      $magentoProduct->setData('news_to_date', "");
    }
    
    // Make a double check we have the visibility of the product correct
    if ((string)$productData->SKUType == "Sub")
    {
      $magentoProduct->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_NOT_VISIBLE);
    }
    else // SKUType is "Master" or "Listing" so should be visable
    {
      $magentoProduct->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH);
    }
    
    // Should we be ignoring any changes to the description
    if (strcmp($productData->IgnoreDescription,'Y') != 0)
    {
      $magentoProduct->setDescription($productData->Description);
    }
    
    $magentoProduct->setShortDescription($productData->ShortDescription);
    $magentoProduct->setPrice($productData->SellPrice);
    
    // Include the CostPrice
    $magentoProduct->setCost($productData->CostEach);
    
    // Include the RRP price
    $magentoProduct->setMsrp($productData->RRP);
    
    // Include the UPC (barcode)
    // Make sure the customer has an attribute with the Attribute Code of "upc" or "barcode"
    $magentoProduct->setData("upc", $productData->UPC);
    $magentoProduct->setData("barcode", $productData->UPC);
    
    // Include sales price info
    if (((string)$productData->OnSale === 'Y') && ((string)$productData->SalePrice > '0'))
    {
      $magentoProduct->setSpecialPrice($productData->SalePrice);
      $magentoProduct->setSpecialFromDate($productData->OnSaleStartDate);
      $magentoProduct->setSpecialToDate($productData->OnSaleEndDate);
    }
    else
    {
      $magentoProduct->setSpecialPrice('');
      $magentoProduct->setSpecialFromDate('');
      $magentoProduct->setSpecialToDate('');
    }
    
    // Include Meta Data
    $magentoProduct->setMetaKeyword($productData->Keywords);
    $magentoProduct->setMetaDescription($productData->MetaDescription);
    
    $active = ((string)$productData->IsActive === 'Y' ?
        Mage_Catalog_Model_Product_Status::STATUS_ENABLED :
        Mage_Catalog_Model_Product_Status::STATUS_DISABLED);

    $magentoProduct->setStatus($active);
    $magentoProduct->setWeight($productData->Weight);
    
    // Set the TaxCodeId integer from the TaxCode string
    //$magentoProduct->setTaxClassId(2);
    $magentoProduct->setTaxClassId($this->setTaxCodeClass($productData->TaxCode));

    $stockData = array();
    $stockData['qty'] = $productData->StockLevel;
    //$this->_debug('stock level for product:'.$productData->StockLevel);
    
    // Set the 'is_in_stock' to true incase this is a master,
    // if it is a subsku and the StockLevel is 0, this will automatically get set to false anyhow. 
    $stockData['is_in_stock'] = 1;
    $magentoProduct->setStockData($stockData);
  }

  private function getTitle($productData)
  {
    $title = $productData->WebsiteTitle;
    if (strlen($title) == 0)
    {
      $title = $productData->ListingTitle;
    }
    if (strlen($title) == 0)
    {
      $title = $productData->Title;
    }
    return $title;
  }
  
  private function setTaxCodeClass($taxCode)
  {
  	$retVal = 2;
  	
  	// Magento Product Tax Class standard definitions.
  	// 0 - None
  	// 1 - Default
  	// 2 - Taxable Goods
  	// 3 - Retail Customer
  	// 4 - Shipping
  	// 5 - VAT Standard
  	// 6 - VAT Reduced
  	// 7 - VAT Zero
  	
  	// As a standard default, we set the $taxCode to; 2 - Taxable Goods
  	// To change this, create a new tax code in Volo under "Value Added Tax" and and with a pipe and the required code, i.e. "Shipping|4".
  	
  	if (stripos($taxCode, "|"))
  	{
  		list($strIgnore, $strNumber) = array_pad(explode("|", $taxCode, 2), 2, "2");
  		$retVal = intval($strNumber);
  	}
  	else
  	{
  		switch ($taxCode)
  		{
  			case "E":
  				$retVal = 0;
  				break;
  				
  			case "Z":
  				$retVal = 7;
  				break;
  				
  			case "S":
  				$retVal = 5;
  				break;
  				
  			default:
  				$retVal = 2;
  		}
  	}
  	return $retVal;
  }

  public function _debug($message)
  {
    Mage::log($message);
  }
}
