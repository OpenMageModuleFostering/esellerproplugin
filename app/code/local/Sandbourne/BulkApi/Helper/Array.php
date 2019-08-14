<?php

class Sandbourne_BulkApi_Helper_Array extends Mage_Core_Helper_Abstract
{
  public function __construct()
  {
    //$this->_debug('Array Helper constructed');
  }
  
  public function findItemUsingEquals($searchKey, $searchValue, $array)
  {
    $key = $this->findItemKeyUsingEquals($searchKey, $searchValue, $array);
    if (!is_null($key))
    {
      return $array[$key];
    }
    return NULL;
  }
  
  public function findItemKeyUsingEquals($searchKey, $searchValue, $array)
  {
    foreach($array as $key=>$value)
    {
      if ($value[$searchKey] === $searchValue)
      {
        return $key;
      }
    }
    return NULL;
  }
  
  public function _debug($message)
  {
    Mage::log($message);
  }
}
