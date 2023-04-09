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
      $posts = $user->ShowVehicles($_SESSION['uid']);
      if ($posts):
        foreach ($posts as $post): ?>
                                    <form action="..\App\Controller\UserC.php" method="post">
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
                                      </dl>
                                      <button name="dltVehc" value="<?php echo $post['vid'] . "/*_" . $post['ImagesPath'] ?>">DELETE</button>
                                    </form>
                      <?php
        endforeach;
      endif;
      break;

    case 'Properties':
      $posts = $user->ShowProperties($_SESSION['uid']);
      if ($posts): foreach ($posts as $post): ?>
                                    <form action="..\App\Controller\UserC.php" method="post">
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
                                      </dl>
                                      <button name="dltProp" value="<?php echo $post['pid'] . "/*_" . $post['ImagesPath'] ?>">DELETE</button>
                                    </form>
      
                            <?php endforeach; endif;
      break;
    case 'Jobs':
      $posts = $user->ShowJobs($_SESSION['uid']);
      if ($posts): foreach ($posts as $post): ?>
                                <form action="..\App\Controller\UserC.php" method="post">
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
                                    <dd><?php echo $post['Qualifications'] ?></dd>
                                    <dt>Skills</dt>
                                    <dd><?php echo $post['Skills'] ?></dd>
                                    <dt>Application Deadline</dt>
                                    <dd><?php echo $post['ApplicationDeadline'] ?></dd>
                                    <dt>Application Method</dt>
                                    <dd><?php echo $post['ApplicationMethod'] ?></dd>
                                    <dt>Contact</dt>
                                    <dd><?php echo $post['Contact'] ?></dd>
                                  </dl>
                                  <button name="dltJob" value="<?php echo $post['jid'] ?>">DELETE</button>
                                </form>
  
                        <?php endforeach; endif;
      break;
  }
}

?>
