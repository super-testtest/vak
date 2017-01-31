<?php

//This variable specifies relative path to the folder, where the gallery with uploaded files is located.
//Do not forget about the slash in the end of the folder name.
$galleryPath = '../../UploadedFiles/';

require_once '../../Includes/gallery_helper.php';

require_once '../../ImageUploaderFlashPHP/UploadHandler.class.php';

/**
 * FileUploaded callback function
 * @param $uploadedFile UploadedFile
 */
function onFileUploaded($uploadedFile) {
  global $galleryPath;

  $absGalleryPath = realpath($galleryPath) . DIRECTORY_SEPARATOR;
  $absThumbnailsPath = $absGalleryPath . 'Thumbnails' . DIRECTORY_SEPARATOR;

  if ($uploadedFile->getPackage()->getPackageIndex() == 0 && $uploadedFile->getIndex() == 0) {
    initGallery($absGalleryPath, $absThumbnailsPath);
  }

  $originalFileName = $uploadedFile->getSourceName();

  $files = $uploadedFile->getConvertedFiles();

  // Save source file
  $sourceFile = $files[0];
  /* @var $sourceFile ConvertedFile */
  if ($sourceFile) {
    $sourceFileName = getSafeFileName($absGalleryPath, $originalFileName);
    $sourceFile->moveTo($absGalleryPath . $sourceFileName);
  }

  //Load XML file which will keep information about files (image dimensions, description, etc).
  //XML is used solely for brevity. In real-life application most likely you will use database instead.
  $descriptions = new DOMDocument('1.0', 'utf-8');
  $descriptions->load($absGalleryPath . 'files.xml');

  //Save file info.
  $xmlFile = $descriptions->createElement('file');
  $xmlFile->setAttribute('name', $originalFileName);
  $xmlFile->setAttribute('source', $sourceFileName);
  $xmlFile->setAttribute('description', $uploadedFile->getDescription());
  $descriptions->documentElement->appendChild($xmlFile);
  $descriptions->save($absGalleryPath . 'files.xml');
}

$uh = new UploadHandler();
$uh->setFileUploadedCallback('onFileUploaded');
$uh->processRequest();