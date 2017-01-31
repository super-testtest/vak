<?php

/**
 * Clean gallery directory from previously uploaded files,
 * and creates new Description.xml.
 * @param $absGalleryPath
 * @param $absThumbnailsPath
 */
function initGallery($absGalleryPath, $absThumbnailsPath, $clean = TRUE) {

  $absGalleryPath = rtrim($absGalleryPath, '/\\');
  $absThumbnailsPath = rtrim($absThumbnailsPath, '/\\');

  if (!is_dir($absGalleryPath)) {
    mkdir($absGalleryPath, 0777, TRUE);
  }

  //Clear files and data uploaded at previous time.
  if ($clean) {

    // Clean gallery directory
    $objects = scandir($absGalleryPath);
    foreach ($objects as $object) {
      if ($object != '.' && $object != '..' && $object != '.svn' && $object != 'Thumbnails') {
        $object = $absGalleryPath . '/' . $object;
        if (is_dir($object)) {
          rrmdir($object);
        } else {
          unlink($object);
        }
      }
    }

    // Clean thumbnails directory
    if (is_dir($absThumbnailsPath)) {
      $objects = scandir($absThumbnailsPath);
      foreach ($objects as $object) {
        if ($object != '.' && $object != '..' && $object != '.svn') {
          $object = $absThumbnailsPath . '/' . $object;
          if (is_dir($object)) {
            rrmdir($object);
          } else {
            unlink($object);
          }
        }
      }
    }
  }

  if (!is_dir($absThumbnailsPath)) {
    mkdir($absThumbnailsPath, 0777, TRUE);
  }

  if ($clean || !file_exists($absGalleryPath . '/' . 'files.xml')) {
    //create description.xml
    $descriptions = new DOMDocument('1.0', 'utf-8');
    $descriptions->appendChild($descriptions->createElement("files"));
    $descriptions->save($absGalleryPath . '/' . 'files.xml');
  }

  //NOTE: If you do not want to delete previously uploaded files, just
  //remove or comment out the code above.
}

/**
 * Recursively remove directory
 * @param $dir Directory name
 */
function rrmdir($dir) {
  if (is_dir($dir)) {
    $objects = scandir($dir);
    foreach ($objects as $object) {
      if ($object != '.' && $object != '..') {
        $object = $dir . '/' . $object;
        if (is_dir($object) == "dir") {
          rrmdir($object);
        } else {
          unlink($object);
        }
      }
    }
    reset($objects);
    rmdir($dir);
  }
}

/**
 * Get value from array or return default if key does not exists in the array
 * @param $array Array
 * @param $key String
 * @param $default
 * @return mixed Returns value from array or default value.
 */
function array_get_value_or_default($array, $key, $default = NULL) {
	if (array_key_exists($key, $array)) {
		return $array[$key];
	} else {
		return $default;
	}
}

/**
 * Check if file with the same name exists then add index
 * to the file name to avoid to overwrite other files.
 * @param $path path to save file
 * @param $fileName file name
 * @return string new file name
 */
function getSafeFileName($path, $fileName, $overwrite = FALSE) {

  // Replace special characters in the file name
  $fileName = preg_replace('/[^a-z0-9_\-\.()\[\]{}]/i', '_', $fileName);

  if (!$overwrite && file_exists($path . $fileName)) {
    $file_parts = pathinfo($fileName);
    //get fileName without extension
    $newFileName = $file_parts['filename'];
    //get extension
    $ext = $file_parts['extension'];
    if ($ext != '') {
      $ext = '.' . $ext;
    }
    $i = 0;
    while (file_exists($path . $newFileName . '_' . $i . $ext)) {
      $i++;
    }
    return $newFileName . '_' . $i . $ext;
  } else {
    return $fileName;
  }

}