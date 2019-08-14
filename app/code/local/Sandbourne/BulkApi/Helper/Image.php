<?php

class Sandbourne_BulkApi_Helper_Image extends Mage_Core_Helper_Abstract
{
  public function __construct()
  {
    //$this->_debug('Image Helper constructed');
  }

  public function setImageList($magentoProduct, $productData, $productResultXMLData)
  {
    //$this->_debug('setImageList($magentoProduct, $productData, $productResultXMLData)');
    $magentoImageList = $magentoProduct['media_gallery']['images'];
    
    $requiredImagesXMLData = new DOMElement('RequiredImages');
    $productResultXMLData->appendChild($requiredImagesXMLData);
    
    $imageIndex = 0;

    // Check we actually have images otherwise we generate an unnecessary error.
    if ($productData->Images->ImageURL != NULL)
    {

      foreach ($productData->Images->ImageURL as $espImageUrl)
      {
        $image = $this->findImage($espImageUrl, $magentoImageList);

		//if (is_null($image))
      	if ($image == NULL)  //  For ==; NULL, false, 0, and empty string are equal.
      	{
      	  //$this->_debug('$image is_null '.$espImageUrl);
		  // Need to create the image. Add it to the list to return to eSellerPro.
		  // eSellerPro will then download the images and pass the image data to Magento.
	      $requiredImageXMLData = new DOMElement('RequiredImage');
	      $requiredImagesXMLData->appendChild($requiredImageXMLData);
	      $requiredImageXMLData->appendChild(new DOMElement('URL', $espImageUrl));
	      $requiredImageXMLData->appendChild(new DOMElement('ImageIndex', $imageIndex));
      	}
      	else
      	{
      	  $this->setImagePosition($magentoProduct, $image, $imageIndex);
      	}
      	$imageIndex++;
      }
      // Now we have all the images are they in the right order
	  //$this->repositionImages($magentoProduct, $productData);
	  // Set the first immage as the gallery image
	  $this->setFirstImageAsBase($magentoProduct);
	  //$this->_debug($magentoProduct['media_gallery']);
    }
  }
  
  public function findImage($espImageUrl, $imageList)
  {
    //$this->_debug('findImage:'.$espImageUrl);
    
    $espFilename = basename($espImageUrl);
    $espFilename = str_replace('%', '_', $espFilename);

    $pathInfo = pathinfo($espFilename);
    $temp = str_replace('+', '_', $pathInfo['filename']);
    
    //$imagePattern = '/'.$pathInfo['filename'].'[\d_]*\.'.$pathInfo['extension'].'/';
    //$imagePattern = '/'.$pathInfo['filename'].'_\d+\.'.$pathInfo['extension'].'/';
    $imagePattern = '/'.$temp.'[\d_]*\.'.$pathInfo['extension'].'/';

    // Check we actually have an image list otherwise we generate an unnecessary error.
    if ($imageList != NULL)
    {
      foreach ($imageList as $image)
      {
        //$this->_debug('looking at '.$image['file']);
        if (preg_match($imagePattern, $image['file']) === 1)
        {
          //$this->_debug('found '.$espFilename);
          return $image;
        }
      }
    }
    return "";
  }

  public function setImagePosition(&$magentoProduct, $magentoImage, $newImageIndex)
  {
    $mediaGallery = $magentoProduct['media_gallery'];
    
    $oldImagePosition = $magentoImage['position'];
    $newImagePosition = $newImageIndex + 1;
    //$this->_debug('setImagePosition positions('.$oldImagePosition.','.$newImagePosition.')');
    
    foreach ($magentoProduct['media_gallery']['images'] as $key => $image)
    {
      if ($image['file'] === $magentoImage['file'])
      {
        //$this->_debug('setting position of index:'.$key.' to '.$newImagePosition);
        $mediaGallery['images'][$key]['position'] = $newImagePosition;
        break;
      }
      //$this->_debug('iterating at '.$image['file'].' at position:'.$image['position']);
    }
    $magentoProduct['media_gallery'] = $mediaGallery;
    //$this->_debug($magentoImageList);
  }

  private function setFirstImageAsBase($product)
  {
    // Make sure the first image is used for the base, small and thumbnail images.
    //$this->_debug('setFirstImageAsBase($product)');
    $mediaGallery = $product->getMediaGallery();
    
    if (isset($mediaGallery['images']))
    {
      foreach ($mediaGallery['images'] as $galleryImage)
      {
        if ($galleryImage['position'] === 1)
        {
          $product['image'] = $galleryImage['file'];
          $product['small_image'] = $galleryImage['file'];
          $product['thumbnail'] = $galleryImage['file'];
          break;
        }    
      }
    }
  }

  public function _debug($message)
  {
    Mage::log($message);
  }
}
