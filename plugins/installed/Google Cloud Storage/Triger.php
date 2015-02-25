<?php

require_once 'google-api-php-client/autoload.php';

session_start();

$client = new Google_Client();
$client->setApplicationName("Google Cloud Storage PHP Starter Application");
$client->setClientId('637042380728-h1o5j1jksf4v2thqapgah01njnjfpia7.apps.googleusercontent.com');
$client->setClientSecret('1MdNyPugyX_rOea6MsVa1hDQ');
$client->setRedirectUri('https://www.pharaohtools.com/oauth2callback');
$client->setDeveloperKey('AIzaSyCwYa5UVxKNzNHo2Oy2A9B8lOQk2SI_kZM');
$client->setScopes('https://www.googleapis.com/auth/devstorage.full_control');
$storageService = new Google_Service_Storage($client);

/**
 * Constants for sample request parameters.
 */
define('API_VERSION', 'v1');
define('DEFAULT_PROJECT', 'YOUR_DEFAULT_PROJECT_ID');
define('DEFAULT_BUCKET', 'YOUR_DEFAULT_BUCKET_NAME');
define('DEFAULT_OBJECT', 'YOUR_DEFAULT_OBJECT_NAME');

/**
 * Generates the markup for a specific Google Cloud Storage API request.
 * @param string $apiRequestName The name of the API request to process.
 * @param string $apiResponse The API response to process.
 * @return string Markup for the specific Google Cloud Storage API request.
 */
function generateMarkup($apiRequestName, $apiResponse) {
  $apiRequestMarkup = '';
  $apiRequestMarkup .= "<header><h2>" . $apiRequestName . "</h2></header>";

  if ($apiResponse['items'] == '' ) {
    $apiRequestMarkup .= "<pre>";
    $apiRequestMarkup .= print_r(json_decode(json_encode($apiResponse), true),
      true);
    $apiRequestMarkup .= "</pre>";
  } else {
    foreach($apiResponse['items'] as $response) {
      $apiRequestMarkup .= "<pre>";
      $apiRequestMarkup .= print_r(json_decode(json_encode($response), true),
        true);
      $apiRequestMarkup .= "</pre>";
    }
  }

  return $apiRequestMarkup;
}

/**
 * Clear access token whenever a logout is requested.
 */
if (isset($_REQUEST['logout'])) {
  unset($_SESSION['access_token']);
}

/**
 * Authenticate and set client access token.
 */
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

/**
 * Set client access token.
 */
if (isset($_SESSION['access_token'])) {
  $client->setAccessToken($_SESSION['access_token']);
}

/**
 * If all authentication has been successfully completed, make Google
 * Cloud Storage API requests.
 */
if ($client->getAccessToken()) {
  /**
   * Google Cloud Storage API request to retrieve the list of buckets in your
   * Google Cloud Storage project.
   */
  $buckets = $storageService->buckets->listBuckets(DEFAULT_PROJECT);
  $listBucketsMarkup = generateMarkup('List Buckets', $buckets);

  /**
   * Google Cloud Storage API request to retrieve the list of objects in your
   * Google Cloud Storage bucket.
   */
  $objects = $storageService->objects->listObjects(DEFAULT_BUCKET);
  $listObjectsMarkup = generateMarkup('List Objects', $objects);

  /**
   * Google Cloud Storage API request to retrieve the list of Access Control
   * Lists on your Google Cloud Storage buckets.
   */
  $bucketsAccessControls = $storageService->bucketAccessControls->
    listBucketAccessControls(DEFAULT_BUCKET);
  $listBucketsAccessControlsMarkup = generateMarkup(
    'List Buckets Access Controls', $bucketsAccessControls);

  /**
   * Google Cloud Storage API request to retrieve the list of Access Control
   * Lists on your Google Cloud Storage objects.
   */
  $objectsAccessControls = $storageService->objectAccessControls->
    listObjectAccessControls(DEFAULT_BUCKET, DEFAULT_OBJECT);
  $listObjectsAccessControlsMarkup = generateMarkup(
    'List Objects Access Controls', $objectsAccessControls);

  /**
   * Google Cloud Storage API request to retrieve a bucket from your
   * Google Cloud Storage project.
   */
  $bucket = $storageService->buckets->get(DEFAULT_BUCKET);
  $getBucketMarkup = generateMarkup('Get Bucket', $bucket);

  // The access token may have been updated lazily.
  $_SESSION['access_token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
}
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <header><h1>Google Cloud Storage Sample App</h1></header>
    <div class="main-content">
      <?php if(isset($listBucketsMarkup)): ?>
        <div id="listBuckets">
          <?php print $listBucketsMarkup ?>
        </div>
      <?php endif ?>

      <?php if(isset($listObjectsMarkup)): ?>
        <div id="listObjects">
          <?php print $listObjectsMarkup ?>
        </div>
      <?php endif ?>

      <?php if(isset($listBucketsAccessControlsMarkup)): ?>
        <div id="listBucketsAccessControls">
          <?php print $listBucketsAccessControlsMarkup ?>
        </div>
      <?php endif ?>

      <?php if(isset($listObjectsAccessControlsMarkup)): ?>
        <div id="listObjectsAccessControls">
          <?php print $listObjectsAccessControlsMarkup ?>
        </div>
      <?php endif ?>

      <?php if(isset($getBucketMarkup)): ?>
        <div id="getBucket">
          <?php print $getBucketMarkup ?>
        </div>
      <?php endif ?>

      <?php
        if(isset($authUrl)) {
          print "<a class='login' href='$authUrl'>Authorize Me!</a>";
        } else {
          print "<a class='logout' href='?logout'>Logout</a>";
        }
      ?>
    </div>
  </body>
</html>
