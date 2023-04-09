<?php
include_once('C:\Apache24\htdocs\BackEnd\App\Controller\UserC.php');
if ($_GET['t'] != 'Vehicles' && $_GET['t'] != 'Jobs' && $_GET['t'] != 'Properties') {
  http_response_code(404);
  include('404.php');
  die();
} else {?>
<form action="" method="post">
<input type="text" name="q">
<button name="srch">Search</button>
</form>
<?php
  switch ($_GET['t']) {
    case 'Vehicles':
      if (isset($_POST['srch'])) {
        $user = new UserC();
        $result = $user->searchV($_POST['q']); 
        if ($result) {
          foreach ($result as $res):?>
            <a href="\BackEnd\Views\Post.php?t=Vehicles&vid=<?php echo $res['VehicleID']?>">
            <?php print_r($user->ShowVehiclesByID($res['VehicleID']));?>
            </a>';
          <?php endforeach;
        } else {
          echo '<p>No Results</p>';
        }
      }
      break;
    case 'Properties':
      if (isset($_POST['srch'])) {
        $user = new UserC();
        $result = $user->searchP($_POST['q']); 
        if ($result) {
          foreach ($result as $res):?>
            <a href="\BackEnd\Views\Post.php?t=Properties&pid=<?php echo $res['PropertyID']?>">
            <?php print_r($user->ShowPropertiesByID($res['PropertyID']));?>
            </a>';
          <?php endforeach;
        } else {
          echo '<p>No Results</p>';
        }
      }  
      break;
    case 'Jobs':
      if (isset($_POST['srch'])) {
        $user = new UserC();
        $result = $user->searchJ($_POST['q']); 
        if ($result) {
          foreach ($result as $res):?>
            <a href="\BackEnd\Views\Post.php?t=Jobs&jid=<?php echo $res['JobID']?>">
            <?php print_r($user->ShowJobsByID($res['JobID']));?>
            </a>';
          <?php endforeach;
        } else {
          echo '<p>No Results</p>';
        }
      }
      break;
  }
}


?>