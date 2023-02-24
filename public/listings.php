<?php
// Lines 0 - 76 written by William Hilton
// The listings page displays a condensed view of properties that are available to rent or buy.

session_start();
?>

<?php include("includes/config.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/nav.php"); ?>

<?php
// Get user input from search bar on form submit (button click)
// Query database for corresponding city, address, region etc. as required
// Apply property filters to query
// Return query results on listing page

include("includes/connect.php");

// Get data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get user input
  $propertySearched = $_POST['propertySearched'];

  // Filters
  $radius = $_POST['radius'];
  $bedrooms = $_POST['bedrooms'];
  $maxPrice = $_POST['maxPrice'];
  $propertyType = $_POST['propertyType'];

  echo "User input: " . $propertySearched;

  // apply radius filter using Google Maps API
  // LIMIT

  // Apply all or specific filter to property type
  if ($propertyType == "all") {
    $sql = "SELECT ADDRESS_CITY, ADDRESS_STREET, PROPERTY_TYPE_NAME
    FROM [ADVERTISEMENT].[ADVERTISEMENT] AS adv
    INNER JOIN [ADVERTISEMENT].[PROPERTY_TYPE] AS prop ON adv.PROPERTY_TYPE_ID = prop.PROPERTY_TYPE_ID
    WHERE ADDRESS_CITY LIKE '%$propertySearched%' AND NUMBER_OF_BEDROOMS >= '$bedrooms' AND ADVERTISEMENT_PRICE <= '$maxPrice'";
  } else {
    $sql = "SELECT ADDRESS_CITY, ADDRESS_STREET, PROPERTY_TYPE_NAME
    FROM [ADVERTISEMENT].[ADVERTISEMENT] AS adv
    INNER JOIN [ADVERTISEMENT].[PROPERTY_TYPE] AS prop ON adv.PROPERTY_TYPE_ID = prop.PROPERTY_TYPE_ID
    WHERE ADDRESS_CITY LIKE '%$propertySearched%' AND NUMBER_OF_BEDROOMS >= '$bedrooms' AND ADVERTISEMENT_PRICE <= '$maxPrice' AND PROPERTY_TYPE_NAME = '$propertyType'";
  }

  $stmt = sqlsrv_prepare($conn, $sql);

  if (sqlsrv_execute($stmt) === false) {
    echo "</br> error";
  } else {
    echo "</br> success </br>";

    $count = 0;

    // Return results
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
      echo $row['ADDRESS_CITY'] . ' ' . $row['ADDRESS_STREET'] . '</br>';
      $count += 1;

    }

    // If no result alert user
    if ($row < 1 && $count === 0) {
      echo "No results were found. Please expand your search parameters.";
    }

  }

  

}

?>

<div class="container p-5">
  <div class="d-flex align-items-center justify-content-center">
    <div class="m-2 p-3 border rounded w-75">
        <div class="row text-center align-items-center justify-content-center">
          <div class="col-12 col-md-8 col-lg-4 p-3">
            <img src="/images/artur-tumasjan-p_cHW1REBWc-unsplash.jpg" class="img-fluid rounded">
          </div>
          <div class="col-12 col-md-8 col-lg-4 text-start col p-3">
            <h1>390 pcm</h1>
            <p>House | 4 Beds | 2 Bath | 688 sqft</p>
            <p>48 Roebuck Road, Crookesmoor, Sheffield</p>
          </div>
          <div class="col-12 col-md-8 col-lg-4 p-3">
            <a href="propertyInfo.php" class="btn btn-dark p-3">More Info</a>
          </div>
        </div>
    </div>
  </div>

  <div class="d-flex align-items-center justify-content-center">
    <div class="m-2 p-3 border rounded w-75">
        <div class="row text-center align-items-center justify-content-center">
          <div class="col-12 col-md-8 col-lg-4 p-3">
            <img src="/images/artur-tumasjan-p_cHW1REBWc-unsplash.jpg" class="img-fluid rounded">
          </div>
          <div class="col-12 col-md-8 col-lg-4 text-start col p-3">
            <h1>390 pcm</h1>
            <p>House | 4 Beds | 2 Bath | 688 sqft</p>
            <p>48 Roebuck Road, Crookesmoor, Sheffield</p>
          </div>
          <div class="col-12 col-md-8 col-lg-4 p-3">
            <a href="propertyInfo.php" class="btn btn-dark p-3">More Info</a>
          </div>
        </div>
    </div>
  </div>

  <div class="d-flex align-items-center justify-content-center">
    <div class="m-2 p-3 border rounded w-75">
        <div class="row text-center align-items-center justify-content-center">
          <div class="col-12 col-md-8 col-lg-4 p-3">
            <img src="/images/artur-tumasjan-p_cHW1REBWc-unsplash.jpg" class="img-fluid rounded">
          </div>
          <div class="col-12 col-md-8 col-lg-4 text-start col p-3">
            <h1>390 pcm</h1>
            <p>House | 4 Beds | 2 Bath | 688 sqft</p>
            <p>48 Roebuck Road, Crookesmoor, Sheffield</p>
          </div>
          <div class="col-12 col-md-8 col-lg-4 p-3">
            <a href="propertyInfo.php" class="btn btn-dark p-3">More Info</a>
          </div>
        </div>
    </div>
  </div>
</div>

<?php include("includes/footer.php"); ?>

