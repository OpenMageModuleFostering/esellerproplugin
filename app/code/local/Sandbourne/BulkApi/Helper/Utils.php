<?php

/**
 * Utils Helper Class, collection of basic utilities.
 */

class Sandbourne_BulkApi_Helper_Utils extends Mage_Core_Helper_Abstract
{

  public function __construct()
  {
    //$this->_debug('Utils Helper constructed');
  }
   
  public function isAttributeReserved($attribute)
  {
    //$this->_debug(">>  isAttributeReserved");
    
    $RESERVED_ATTRIBUTES = array("SITE:");
    
    $retVal = false;
    foreach ($RESERVED_ATTRIBUTES as $string)
    {
      if (strpos($attribute, $string) !== false)
      {
        $retVal = true;
      }
    }
    return $retVal;
  }
  
  public function replaceInvalidChars($stringItem)
  {
    //$this->_debug(">>  replaceInvalidChars");
    
    $INVALID_CHARACTERS = array(" ", ":", "/", ".");
    $REPLACEMENT_CHARACTER = "_";
    
    foreach ($INVALID_CHARACTERS as $char)
    {
      $stringItem = str_replace($char, $REPLACEMENT_CHARACTER, $stringItem);
    }
          
    return $stringItem;
  }
  
  public function isCustomFieldValid($stringItem)
  {
    //$this->_debug(">>  isCustomFieldValid");
    
    // The rule for Magento custom fields is to use only letters (a-z), numbers (0-9) or underscore(_)
    // in the field name and the first character should be a letter.
    // As we are replacing some invalid characters (:./) with an underscore,
    // we can include these into the regular expression.
    
    $retVal = FALSE;
 
    if (preg_match("/^[A-Z a-z][A-Z a-z 0-9 _ : \/ .]*$/", $stringItem) > 0)
    {
      $retVal = TRUE;
    }
    
    return $retVal;
  }

  private function _debug($message)
  {
    Mage::log($message);
  }
}
