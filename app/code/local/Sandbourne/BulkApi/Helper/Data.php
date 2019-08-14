<?php

// This empty class is required in order to be able to create a magento soap role.
// Magento throws an error without this class.

class Sandbourne_BulkApi_Helper_Data extends Mage_Core_Helper_Abstract
{
  public function __construct()
  {
    //$this->_debug('Array Helper constructed');
  }
  
  public function _debug($message)
  {
    Mage::log($message);
  }
}
