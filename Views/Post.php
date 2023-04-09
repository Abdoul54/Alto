<?php
include_once('C:\Apache24\htdocs\BackEnd\App\Controller\UserC.php');
session_start();
$user = new UserC();
if ($_GET['t'] != 'Vehicles' && $_GET['t'] != 'Jobs' && $_GET['t'] != 'Properties') {
  http_response_code(404);
  include('404.php');
  die();
} else {
  switch ($_GET['t']) {
    case 'Vehicles':
      $post = $user->ShowVehiclesByID($_GET['vid']);
      if ($post) { ?>                                 
            <h1><?php echo $post['title'] ?></h1>
            <dl>
              <dt>Images</dt>
              <dd>
              <?php foreach (ShowImgs($post['ImagesPath']) as $img): ?>
                <img src="<?php echo $img ?>" style="width:50%">
              <?php endforeach ?>
              </dd>
              <dt>Description</dt>
              <dd><?php echo $post['Description'] ?>
              <dt>Brand</dt>
              <dd><?php echo $post['Brand'] ?>
              <dt>Model</dt>
              <dd><?php echo $post['Model'] ?>
              <dt>Year</dt>
              <dd><?php echo $post['Year'] ?>
              <dt>Mileage</dt>
              <dd><?php echo $post['Mileage'] ?>
              <dt>BodyType</dt>
              <dd><?php echo $post['BodyType'] ?>
              <dt>Transmission</dt>
              <dd><?php echo $post['Transmission'] ?>
              <dt>FuelType</dt>
              <dd><?php echo $post['FuelType'] ?>
              <dt>EnginSize</dt>
              <dd><?php echo $post['EngineSize'] ?>
              <dt>Color</dt>
              <dd><?php echo $post['Color'] ?>
              <dt>Interior</dt>
              <dd><?php echo $post['Interior'] ?>
              <dt>Price</dt>
              <dd><?php echo $post['Price'] ?>
              <dt>Created: </dt>
              <dd><?php echo $post['DateCreated'] ?></dd>
            </dl>
<?php
      } else {
        http_response_code(404);
        include('404.php');
        die();
      }
      break;

    case 'Properties':
      $post = $user->ShowPropertiesByID($_GET['pid']);
      if ($post) { ?>
            <h1><?php echo $post['title'] ?></h1>
            <dl>
              <dt>Images</dt>
              <dd>
              <?php foreach (ShowImgs($post['ImagesPath']) as $img): ?>
              <img src="<?php echo $img ?>" style="width:50%">
              <?php endforeach ?>  
              </dd>
              <dt>Description</dt>
              <dd><?php echo $post['Description'] ?></dd>
              <dt>Property Type</dt>
              <dd><?php echo $post['PropertyType'] ?></dd>
              <dt>Address</dt>
              <dd><?php echo $post['Address'] ?></dd>
              <dt>Bedrooms</dt>
              <dd><?php echo $post['Bedrooms'] ?></dd>
              <dt>Bathrooms</dt>
              <dd><?php echo $post['Bathrooms'] ?></dd>
              <dt>Lot Size</dt>
              <dd><?php echo $post['LotSize'] ?></dd>
              <dt>Year Built</dt>
              <dd><?php echo $post['YearBuilt'] ?></dd>
              <dt>Price</dt>
              <dd><?php echo $post['Price'] ?></dd>
              <dt>Created: </dt>
              <dd><?php echo $post['DateCreated'] ?></dd>
            </dl>
<?php
      } else {
        http_response_code(404);
        include('404.php');
        die();
      }
      break;
    case 'Jobs':
      $post = $user->ShowJobsByID($_GET['jid']);
      if ($post) { ?>
      <h1><?php echo $post['JobTitle'] ?></h1>
      <dl>
              <dt>Description</dt>
              <dd><?php echo $post['Description'] ?></dd>
              <dt>Job Type</dt>
              <dd><?php echo $post['JobType'] ?></dd>
              <dt>Location</dt>
              <dd><?php echo $post['Location'] ?></dd>
              <dt>Company</dt>
              <dd><?php echo $post['Company'] ?></dd>
              <dt>Salary</dt>
              <dd><?php echo $post['Salary'] ?></dd>
              <dt>Qualifications</dt>
              <dd><?php echo $post['Qualification'] ?></dd>
              <dt>Skills</dt>
              <dd><?php echo $post['Skills'] ?></dd>
              <dt>Application Deadline</dt>
              <dd><?php echo $post['ApplicationDeadline'] ?></dd>
              <dt>Application Method</dt>
              <dd><?php echo $post['ApplicationMethod'] ?></dd>
              <dt>Contact</dt>
              <dd><?php echo $post['Contact'] ?></dd>
              <dt>Created: </dt>
              <dd><?php echo $post['DateCreated'] ?></dd>
            </dl>
<?php
      } else {
        http_response_code(404);
        include('404.php');
        die();
      }
      break;
  }
}

?>
