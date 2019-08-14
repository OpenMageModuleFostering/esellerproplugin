<?php

/**
 * TestData Helper Class.
 */

class Sandbourne_BulkApi_Helper_TestData extends Mage_Core_Helper_Abstract
{

  public function __construct()
  {
    //$this->_debug('Test Data Helper constructed');
  }
  
  public function loadTestData()
  {
    /*
     * Insert the below at around line 28 in FullProduct Api.php
     * 
     * $productXMLData = simplexml_load_string($productXML);
     * -----
     * Testing XML
     * Comment these lines out if no testing is required.
     * $utils = Mage::helper('bulkapi/testData');
     * $productXML = $utils->loadTestData();
     * $this->_debug($productXML);
     * Testing XML
     * -----
     * $attributeHelper = Mage::helper('bulkapi/attribute');
     */
    
    $testData = '<?xml version="1.0" encoding="UTF-8"?><FullProductsUpdate batch="141" version="1.0">
<Product>
<StockNumber>HH_CHINO</StockNumber>
<SupplierSKU/>
<InternalSKU/>
<SKUType>Master</SKUType>
<MasterStockNumber/>
<IsActive>Y</IsActive>
<Dropship>N</Dropship>
<ExternalStoreView/>
<Title><![CDATA[New Mens Designer Hutson Harbour Casual Chino Twill Straight Leg Trouser Pants]]></Title>
<Subtitle/>
<WebsiteTitle/>
<AlternativeWebsiteTitle/>
<ListingTitle><![CDATA[New Mens Designer Hutson Harbour Casual Chino Twill Straight Leg Trouser Pants]]></ListingTitle>
<NewRelease>N</NewRelease>
<OnSale>N</OnSale>
<SalePrice>0.0</SalePrice>
<StockLevel>0</StockLevel>
<MinOrderQty>0</MinOrderQty>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<TaxRate>20.0</TaxRate>
<RRP>0.0</RRP>
<CostEach>6.0</CostEach>
<ShippingCost>0.0</ShippingCost>
<ShortDescription/>
<Description><![CDATA[<p>These are Hutson Harbour Brand Twill Chinos trousers. These are suitable for summer and casual use, manufactured with a moderate weight twill cotton fabric to give extra comfort. Modern Straight leg cut and finely detailed trousers. Look good and feel great with these twill chinos.</P>
<P>It comes with Hutson Harbour brand quality assurance</p> 
</br>

<p><font size="4" color="red"><b>Features:</b></font></p>
<ul>Brand:  Hutson Harbour</ul>
<ul>Style:   Chinos</ul>
<ul>Material: 100% Cotton </ul>
<ul>Colours: Blue, Navy, Rust</ul>
<ul>Garment Care: 30 Degree Machine Washable (Please follow the full washing instruction from the garment Tag)</ul>
<ul>Sizes:  Waist size form 30 to 40 inside leg 29 and 31</ul>
<ul>Regular fit Twill Chinos Jean</ul>
<ul>2 Front Pockets </ul>
<ul>2 Back Pockets </ul>
<ul>Leg: Short, Regular and Long</ul>
<ul>Urban Look</ul>
<ul>Button Fly</ul>
<ul>Belt Loops </ul>
<ul>Double stich for extra durability</ul>
<ul>Washed for required effect</ul>]]></Description>
<Description2><![CDATA[<p>These are Hutson Harbour Brand Twill Chinos trousers. These are suitable for summer and casual use, manufactured with a moderate weight twill cotton fabric to give extra comfort. Modern Straight leg cut and finely detailed trousers. Look good and feel great with these twill chinos.</P>
<P>It comes with Hutson Harbour brand quality assurance</p> 
</br>

<p><font size="4" color="red"><b>Features:</b></font></p>
<ul>Brand:  Hutson Harbour</ul>
<ul>Style:   Chinos</ul>
<ul>Material: 100% Cotton </ul>
<ul>Colours: Blue, Navy, Rust</ul>
<ul>Garment Care: 30 Degree Machine Washable (Please follow the full washing instruction from the garment Tag)</ul>
<ul>Sizes:  Waist size form 30 to 40 inside leg 29 and 31</ul>
<ul>Regular fit Twill Chinos Jean</ul>
<ul>2 Front Pockets </ul>
<ul>2 Back Pockets </ul>
<ul>Leg: Short, Regular and Long</ul>
<ul>Urban Look</ul>
<ul>Button Fly</ul>
<ul>Belt Loops </ul>
<ul>Double stich for extra durability</ul>
<ul>Washed for required effect</ul>]]></Description2>
<Description3/>
<Description4/>
<Description5/>
<MetaDescription/>
<Images>
<ImageURL>http://images.esellerpro.com/3628/I/24/HH_CHINO_Title.jpg</ImageURL>
</Images>
<Weight unit="g">0.0</Weight>
<Width unit="(cm)">0</Width>
<Height unit="(cm)">0</Height>
<Depth unit="(cm)">0</Depth>
<UPC/>
<AllowPreOrder>N</AllowPreOrder>
<Keywords/>
<Publisher/>
<ISBN/>
<Notes/>
<Source>import</Source>
<Category/>
<GlobalAnchoring>N</GlobalAnchoring>
<ProductCategories>
<ProductCategory><![CDATA[TrueFace Magento>MEN>BOTTOMS>Jeans]]></ProductCategory>
<ProductCategory><![CDATA[TrueFace Magento>BRANDS>Other Brands]]></ProductCategory>
</ProductCategories>
<Supplier/>
<ShowInHome>N</ShowInHome>
<FreeShipping>N</FreeShipping>
<StarItem>N</StarItem>
<FeatureProduct>N</FeatureProduct>
<Feature2>N</Feature2>
<Feature3>N</Feature3>
<VideoName/>
<ShippingTemplate/>
<CustomGroups>
<CustomGroup groupName="Amazon">
<CustomFields>
<NameValueList>
<Name>ProdDesc</Name>
<Value><![CDATA[<p>These are Hutson Harbour Brand Twill Chinos trousers. These are suitable for summer and casual use, manufactured with a moderate weight twill cotton fabric to give extra comfort. Modern Straight leg cut and finely detailed trousers. Look good and feel great with these twill chinos.</P>
<P>It comes with Hutson Harbour brand quality assurance</p> 
</br>

<p><font size="4" color="red"><b>Features:</b></font></p>
<ul>Brand:  Hutson Harbour</ul>
<ul>Style:   Chinos</ul>
<ul>Material: 100% Cotton </ul>
<ul>Colours: Blue, Navy, Rust</ul>
<ul>Garment Care: 30 Degree Machine Washable (Please follow the full washing instruction from the garment Tag)</ul>
<ul>Sizes:  Waist size form 30 to 40 inside leg 29 and 31</ul>
<ul>Regular fit Twill Chinos Jean</ul>
<ul>2 Front Pockets </ul>
<ul>2 Back Pockets </ul>
<ul>Leg: Short, Regular and Long</ul>
<ul>Urban Look</ul>
<ul>Button Fly</ul>
<ul>Belt Loops </ul>
<ul>Double stich for extra durability</ul>
<ul>Washed for required effect</ul>]]></Value>
</NameValueList>
</CustomFields>
</CustomGroup>
<CustomGroup groupName="CustomFieldsAUS">
<CustomFields/>
</CustomGroup>
<CustomGroup groupName="CustomFieldsDE">
<CustomFields/>
</CustomGroup>
<CustomGroup groupName="CustomFieldsES">
<CustomFields/>
</CustomGroup>
<CustomGroup groupName="CustomFieldsFR">
<CustomFields/>
</CustomGroup>
<CustomGroup groupName="CustomFieldsIT">
<CustomFields/>
</CustomGroup>
<CustomGroup groupName="CustomFieldsUK">
<CustomFields/>
</CustomGroup>
<CustomGroup groupName="CustomFieldsUS">
<CustomFields/>
</CustomGroup>
<CustomGroup groupName="Downloaded data">
<CustomFields/>
</CustomGroup>
<CustomGroup groupName="eBay Item Specifics">
<CustomFields/>
</CustomGroup>
<CustomGroup groupName="Magento">
<CustomFields/>
</CustomGroup>
<CustomGroup groupName="New Listing eBay Spc">
<CustomFields>
<NameValueList>
<Name>Brand</Name>
<Value><![CDATA[Hutson Harbour]]></Value>
</NameValueList>
<NameValueList>
<Name>Style</Name>
<Value><![CDATA[Chinos]]></Value>
</NameValueList>
<NameValueList>
<Name>Material</Name>
<Value><![CDATA[100% Cotton]]></Value>
</NameValueList>
<NameValueList>
<Name>GarmentCare</Name>
<Value><![CDATA[Machine Washable]]></Value>
</NameValueList>
<NameValueList>
<Name>Gender</Name>
<Value><![CDATA[Male]]></Value>
</NameValueList>
<NameValueList>
<Name>Fit</Name>
<Value><![CDATA[Regular fit]]></Value>
</NameValueList>
<NameValueList>
<Name>Feature</Name>
<Value><![CDATA[Urban Look]]></Value>
</NameValueList>
<NameValueList>
<Name>Feature</Name>
<Value><![CDATA[2 Front Pockets]]></Value>
</NameValueList>
<NameValueList>
<Name>Feature</Name>
<Value><![CDATA[Double stich for extra durability]]></Value>
</NameValueList>
<NameValueList>
<Name>Feature</Name>
<Value><![CDATA[Urban Look]]></Value>
</NameValueList>
<NameValueList>
<Name>Feature</Name>
<Value><![CDATA[Washed for required effect]]></Value>
</NameValueList>
<NameValueList>
<Name>Fly</Name>
<Value><![CDATA[Button Fly]]></Value>
</NameValueList>
<NameValueList>
<Name>Pockets</Name>
<Value><![CDATA[4 Pockets]]></Value>
</NameValueList>
<NameValueList>
<Name>DiagramURL</Name>
<Value><![CDATA[http://truefaceuk.com/Trueface_Pictures/HH_CHINO_Chart.JPG]]></Value>
</NameValueList>
</CustomFields>
</CustomGroup>
<CustomGroup groupName="NewListing Variation">
<CustomFields/>
</CustomGroup>
</CustomGroups>
<Variations>
<Variation>
<StockNumber>HH_CHINO_BLU_30R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>1</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Blue]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[30WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_BLU_30S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>1</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Blue]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[30WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_BLU_32R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>2</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Blue]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[32WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_BLU_32S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>2</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Blue]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[32WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_BLU_34R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>3</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Blue]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[34WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_BLU_34S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>4</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Blue]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[34WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_BLU_36R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>4</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Blue]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[36WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_BLU_36S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>5</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Blue]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[36WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_BLU_38R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>1</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Blue]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[38WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_BLU_38S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>3</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Blue]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[38WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_BLU_40R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>1</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Blue]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[40WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_BLU_40S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>2</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Blue]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[40WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_GRY_30R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>1</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Grey]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[30WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_GRY_30S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>1</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Grey]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[30WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_GRY_32R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>2</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Grey]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[32WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_GRY_32S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>2</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Grey]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[32WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_GRY_34R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>3</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Grey]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[34WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_GRY_34S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>4</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Grey]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[34WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_GRY_36R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>4</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Grey]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[36WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_GRY_36S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>5</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Grey]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[36WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_GRY_38R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>2</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Grey]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[38WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_GRY_38S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>4</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Grey]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[38WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_GRY_40R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>1</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Grey]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[40WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_GRY_40S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>2</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Grey]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[40WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_NVY_30R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>1</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Navy]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[30WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_NVY_30S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>1</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Navy]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[30WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_NVY_32R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>2</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Navy]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[32WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_NVY_32S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>2</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Navy]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[32WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_NVY_34R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>3</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Navy]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[34WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_NVY_34S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>4</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Navy]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[34WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_NVY_36R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>4</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Navy]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[36WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_NVY_36S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>5</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Navy]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[36WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_NVY_38R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>1</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Navy]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[38WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_NVY_38S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>3</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Navy]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[38WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_NVY_40R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>1</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Navy]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[40WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_NVY_40S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>2</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Navy]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[40WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_RST_30R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>1</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Rust]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[30WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_RST_30S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>1</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Rust]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[30WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_RST_32R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>2</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Rust]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[32WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_RST_32S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>2</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Rust]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[32WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_RST_34R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>3</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Rust]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[34WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_RST_34S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>4</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Rust]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[34WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_RST_36R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>4</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Rust]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[36WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_RST_36S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>5</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Rust]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[36WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_RST_38R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>2</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Rust]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[38WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_RST_38S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>4</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Rust]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[38WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_RST_40R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>2</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Rust]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[40WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_RST_40S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>2</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Rust]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[40WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_Tbco_30R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>1</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Tobacco]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[30WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_Tbco_30S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>1</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Tobacco]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[30WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_Tbco_32R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>2</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Tobacco]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[32WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_Tbco_32S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>2</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Tobacco]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[32WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_Tbco_34R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>3</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Tobacco]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[34WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_Tbco_34S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>4</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Tobacco]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[34WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_Tbco_36R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>2</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Tobacco]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[36WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_Tbco_36S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>5</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Tobacco]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[36WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_Tbco_38R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>2</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Tobacco]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[38WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_Tbco_38S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>4</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Tobacco]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[38WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_Tbco_40R</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>2</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Tobacco]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[40WX31L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
<Variation>
<StockNumber>HH_CHINO_Tbco_40S</StockNumber>
<SellPrice>9.99</SellPrice>
<TaxCode>S</TaxCode>
<StockLevel>2</StockLevel>
<VariationSpecifics>
<NameValueList>
<Name>colour</Name>
<Value><![CDATA[Tobacco]]></Value>
</NameValueList>
<NameValueList>
<Name>Trouser Size</Name>
<Value><![CDATA[40WX29L]]></Value>
</NameValueList>
</VariationSpecifics>
</Variation>
</Variations>
<UseVariations>Y</UseVariations>
<RelatedProducts/>
<SimilarProducts/>
<StoreView/>
<AttributeSet/>
<Ignore>N</Ignore>
<IgnoreImages>N</IgnoreImages>
<IgnoreCategories>N</IgnoreCategories>
<IgnoreDescription>N</IgnoreDescription>
<IgnoreCustomFields>N</IgnoreCustomFields>
<UseCustomGroups/>
</Product>
</FullProductsUpdate>';    
    
    return $testData;
  }
}