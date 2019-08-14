<?php
echo "Line 2";
//$attributes = Mage::getResourceModel('catalog/product_attribute_collection')->addVisibleFilter();
$attributeArray = array();
echo "Line 5";
foreach($attributes as $attribute)
{
  echo "Line 8";
  $attributeArray[] = array(
      'label' => $attribute->getData('frontend_label'),
      'value' => $attribute->getData('attribute_code')
     );
  echo "Line 13";
}
// return $attributeArray; 
?>