<?php

class Sandbourne_BulkApi_Model_FullImage_Api extends Mage_Api_Model_Resource_Abstract
{
  public function __construct()
  {
    //$this->_debug('FullImage constructed');
  }

  public function update($productXML)
  {
    $productXMLData = simplexml_load_string($productXML);
    $ioAdapter = new Varien_Io_File();
    $imageHelper = Mage::helper('bulkapi/image');

    foreach ($productXMLData as $imageData)
    {
      $data = array();
      $productID = Mage::getModel('catalog/product')->getIdBySku($imageData->stockNumber);
      //$this->_debug($imageData->url);

      if ($productID > 0)
      {
        $product = Mage::getModel('catalog/product')->load($productID);
        $mediaGallery = $product['media_gallery'];
        $imageFound = $imageHelper->findImage($imageData->url, $mediaGallery['images']);

        if (!$imageFound)
        {
          //$this->_debug('FullImage API - New Image');
          $fileContent = @base64_decode((string)$imageData->content, true);
          $tmpDirectory = Mage::getBaseDir('var') . DS . 'api' . DS . $this->_getSession()->getSessionId();

          $ioAdapter->checkAndCreateFolder($tmpDirectory);
          $ioAdapter->open(array('path'=>$tmpDirectory));

          if (!$fileContent)
          {
            //$this->_debug('Invalid image data');
          }
          
          $espFilename = basename($imageData->url);

          // Write image file
          @file_put_contents($tmpDirectory . DS . $espFilename, $fileContent);
          
          $attributes = $product->getTypeInstance(true)->getSetAttributes($product);
          $mediaGalleryObj = $attributes['media_gallery'];
          
          // Adding image to gallery (the last parameter for addImage so whether to move the image or not)
          //$file = $mediaGalleryObj->getBackend()->addImage($product, $tmpDirectory . DS . $espFilename, null, true);
          $file = $mediaGalleryObj->getBackend()->addImage($product, $tmpDirectory . DS . $espFilename, null, false);
          
          // Remove temporary directory
          $ioAdapter->rmdir($tmpDirectory, true);

          $data['label'] = $espFilename;
          $data['exclude'] = '0';
          $data['name'] = $espFilename;
          $data['file'] = $espFilename;
          
          $index = (string)$imageData->imageIndex;
          $data['position'] = $index;
          
          // If this is the first Image for this product then set it as the Image, SmallImage and Thumbnail default.
          if ($index === '0')
          {
            $product->setImage($file);
            $product->setSmallImage($file);
            $product->setThumbnail($file);
          }
          
          //$data['mime'] = 'image/jpeg';
          //$data['types'] = array('image', 'small_image', 'thumbnail');
          $mediaGalleryObj->getBackend()->updateImage($product, $file, $data);
          $product->save();
        }
        else
        {
          //$this->_debug('FullImage API - EXISTING Image');
          $file = $imageFound;
        }  
      }
    }
  }

  public function _debug($message)
  {
    Mage::log($message);
  }
}
