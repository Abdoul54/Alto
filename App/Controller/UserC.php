<?php

use function PHPSTORM_META\map;

include_once('C:\Apache24\htdocs\BackEnd\App\Model\UserM.php');

class UserC
{
  private $user;

  public function __construct()
  {
    $this->user = new User();
  }

  public function Register($username, $email, $pwd, $fn, $ln, $tel, $address)
  {
    return $this->user->CreateAccount($username, $email, $pwd, $fn, $ln, $tel, $address);
  }

  public function Login($email, $pwd)
  {
    // code to log in a user
    return $this->user->LogintoAccount($email, $pwd);

  }

  public function Logout()
  {
    if ($this->user->LogoutAccount()) {
      header('Location:/BackEnd/Views/SignIn.php');
    }
  }

  public function createPostVehicle($uid, $title, $Description, $Brand, $Model, $ImagesPath, $Year, $Mileage, $BodyType, $Transmission, $FuelType, $EngineSize, $Color, $Interior, $Price)
  {
    return $this->user->createPostVehicle($uid, $title, $Description, $Brand, $Model, $ImagesPath, $Year, $Mileage, $BodyType, $Transmission, $FuelType, $EngineSize, $Color, $Interior, $Price);
  }

  public function DeletePostVehicle($VID)
  {
    return $this->user->DeletePostVehicle($VID);
  }

  public function ShowVehiclesByID($vid)
  {
    return $this->user->ShowVehiclesByID($vid);
  }

  public function ShowVehicles($uid)
  {
    return $this->user->ShowVehicles($uid);
  }
  public function createPostProperty($uid, $title, $Description, $ImagesPath, $PropertyType, $address, $bedrooms, $bathrooms, $Price, $yearBuilt, $LotSize)
  {
    return $this->user->createPostProperty($uid, $title, $Description, $ImagesPath, $PropertyType, $address, $bedrooms, $bathrooms, $Price, $yearBuilt, $LotSize);
  }

  public function DeletePostProperty($PID)
  {
    return $this->user->DeletePostProperty($PID);
  }

  public function ShowProperties($uid)
  {
    return $this->user->ShowProperties($uid);
  }
  public function ShowPropertiesByID($pid)
  {
    return $this->user->ShowPropertiesByID($pid);
  }

  public function createPostJob($uid, $JobTitle, $Description, $Company, $JobType, $Location, $Salary, $Category, $Qualification, $Skills, $AppDeadline, $AppMethod, $Contact)
  {
    return $this->user->createPostJob($uid, $JobTitle, $Description, $Company, $JobType, $Location, $Salary, $Category, $Qualification, $Skills, $AppDeadline, $AppMethod, $Contact);
  }

  public function DeletePostJob($JID)
  {
    return $this->user->DeletePostJob($JID);
  }

  public function ShowJobs($uid)
  {
    return $this->user->ShowJobs($uid);
  }

  public function ShowJobsByID($jid)
  {
    return $this->user->ShowJobsByID($jid);
  }

  public function ShowProfile($uid)
  {
    return $this->user->ShowProfile($uid);
  }
  public function searchV($q)
  {
    return $this->user->SearchV($q);
  }
  public function searchP($q)
  {
    return $this->user->SearchP($q);
  }
  public function searchJ($q)
  {
    return $this->user->SearchJ($q);
  }


}

function chk()
{
  if (!$_SESSION['uid']) {
    header("Location:/BackEnd/Views/SignIn.php");
  }

}

function ShowImgs($dir)
{
  $files = scandir($dir);
  $num_files = count(array_filter($files, function ($file) use ($dir) {
    return is_file($dir . '/' . $file);
  }));
  $files = array_diff($files, array('.', '..'));
  $files = array_map(function($file) use ($dir){
    return str_replace('/Apache24/htdocs/BackEnd', '..', $dir) . $file;
  }, $files);
  return $files;
}


function deleteDirectory($dir) {
  if (!file_exists($dir)) {
      return true;
  }

  if (!is_dir($dir)) {
      return unlink($dir);
  }

  foreach (scandir($dir) as $item) {
      if ($item == '.' || $item == '..') {
          continue;
      }

      if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
          return false;
      }

  }

  return rmdir($dir);
}


//! SIGNIN BUTTON
if (isset($_POST['singin'])) {
  session_start();
  $email = $_POST['email'];
  $password = $_POST['pwd'];

  $user = new UserC;
  $result = $user->Login($email, $password);

  if ($result) {
    if ($_POST['remember']) {
      setcookie('email', $_POST['email'], time() + 365 * 24 * 3600, null, null, false, true);
      setcookie('password', $_POST['pwd'], time() + 365 * 24 * 3600, null, null, false, true);
    }
    $_SESSION['uid'] = $result['UID'];
    $_SESSION['usern'] = $result['username'];
    header('Location:\BackEnd\Views\Home.php');
  } else {
    header('Location:\BackEnd\Views\SignIn.php?I=true');
  }
  ;
}


//! REGISTER BUTTON
if (isset($_POST['register'])) {
  $username = $_POST['username'];
  $fn = $_POST['fn'];
  $ln = $_POST['ln'];
  $email = $_POST['email'];
  $password = $_POST['pwd'];
  $address = $_POST['addr'];
  $tel = "+212" . $_POST['tel'];

  $user = new UserC;
  $result = $user->Register($username, $email, $password, $fn, $ln, $tel, $address);
  if ($result) {
    session_start();

    $res = $user->Login($email, $password);

    if ($res) {
      $_SESSION['uid'] = $res['uid'];
      header('Location:\BackEnd\Views\Home.php');
    }
    ;
  } else {
    echo 'This account is already created, want to <a href="./signin.php">Sign in</a>';
  }
  ;

}

//! LOG OUT BUTTON
if (isset($_POST['logout'])) {
  $user = new UserC();
  $user->Logout();

}


//! ADDING A PROPERTY POST BUTTON
if (isset($_POST['addProp'])) {
  $uid = $_SESSION['uid'];
  $title = $_POST['title'];
  $Description = $_POST['description'];
  $PropertyType = $_POST['PType'];
  $address = $_POST['addr'];
  $bedrooms = $_POST['bedrooms'];
  $bathrooms = $_POST['bathrooms'];
  $Price = $_POST['price'];
  $yearBuilt = $_POST['yearBuilt'];
  $LotSize = $_POST['lotsize'];
  $targetDir = "/Apache24/htdocs/BackEnd/uploads/" . uniqid('IMGS') . "/";
  mkdir($targetDir);
  $fileNames = array_filter($_FILES['imgs']['name']);
  if (!empty($fileNames)) {
    foreach ($_FILES['imgs']['name'] as $key => $val) {
      // File upload path 
      $fileName = basename($_FILES['imgs']['name'][$key]);
      $targetFilePath = $targetDir . $fileName;

      // Check whether file type is valid 
      $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
      move_uploaded_file($_FILES["imgs"]["tmp_name"][$key], $targetFilePath);
    }

    $user = new UserC();
    $result = $user->createPostProperty($uid, $title, $Description, $targetDir, $PropertyType, $address, $bedrooms, $bathrooms, $Price, $yearBuilt, $LotSize);
    if ($result) {
      header('Location:\BackEnd\Views\Posts.php?t=Properties');
    }
  }

}

//! REMOVING A PROPERTY POST BUTTON
if (isset($_POST['dltProp'])) {
  $user = new UserC();
  deleteDirectory(str_replace('\BackEnd\App\Controller', str_replace('/', '\\', substr(explode('/*_', $_POST['dltProp'])[1],16)),__DIR__));  
  $user->DeletePostProperty(explode('/*_', $_POST['dltProp'])[0]);
  header('Location:\BackEnd\Views\Posts.php?t=Properties');
}

//! ADDING A VEHICLE POST BUTTON
if (isset($_POST['addVehc'])) {
  $uid = $_SESSION['uid'];
  $title = $_POST['title'];
  $Brand = explode("_", $_POST['brand'])[0];
  $Model = explode("_", $_POST['brand'])[1];
  $Year = $_POST['year'];
  $BType = $_POST['BType'];
  $FType = $_POST['FType'];
  $Price = $_POST['price'];
  $Mileage = $_POST['mileage'];
  $Transmission = $_POST['transmission'];
  $EngineSize = $_POST['EngineSize'];
  $Color = $_POST['color'];
  $Interior = $_POST['interior'];
  $Description = $_POST['description'];
  $targetDir = "/Apache24/htdocs/BackEnd/uploads/" . uniqid('IMGS') . "/";
  mkdir($targetDir);
  $fileNames = array_filter($_FILES['imgs']['name']);
  if (!empty($fileNames)) {
    foreach ($_FILES['imgs']['name'] as $key => $val) {
      // File upload path 
      $fileName = basename($_FILES['imgs']['name'][$key]);
      $targetFilePath = $targetDir . $fileName;

      // Check whether file type is valid 
      $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
      move_uploaded_file($_FILES["imgs"]["tmp_name"][$key], $targetFilePath);
    }

    $user = new UserC();
    $result = $user->createPostVehicle($uid, $title, $Description, $Brand, $Model, $targetDir, $Year, $Mileage, $BType, $Transmission, $FType, $EngineSize, $Color, $Interior, $Price);

    if ($result) {
      header('Location:\BackEnd\Views\Posts.php?t=Vehicles');
    }
  }
  

}
//! REMOVING A VEHICLE POST BUTTON
if (isset($_POST['dltVehc'])) {
  $user = new UserC();
  deleteDirectory(str_replace('\BackEnd\App\Controller', str_replace('/', '\\', substr(explode('/*_', $_POST['dltVehc'])[1],16)),__DIR__));  
  $user->DeletePostVehicle(explode('/*_', $_POST['dltVehc'])[0]);
  header('Location:\BackEnd\Views\Posts.php?t=Vehicles');
}


//! ADDING A JOB POST BUTTON

if (isset($_POST['addJob'])) {
  $uid = $_SESSION['uid'];
  $JobTitle = $_POST['JobTitle'];
  $Description = $_POST['Description'];
  $Company = $_POST['Company'];
  $JobType = $_POST['JobType'];
  $Location = $_POST['Location'];
  $Salary = $_POST['Salary'];
  $Category = $_POST['Category'];
  $Qualification = $_POST['Qualification'];
  $Skills = $_POST['Skills'];
  $AppMethod = $_POST['AppMethod'];
  $AppDeadline = $_POST['AppDeadline'];
  $Contact = $_POST['Contact'];

  $user = new UserC();
  $result = $user->createPostJob($uid, $JobTitle, $Description, $Company, $JobType, $Location, $Salary, $Category, $Qualification, $Skills, $AppDeadline, $AppMethod, $Contact);
  if ($result) {
    header('Location:\BackEnd\Views\Posts.php?t=Jobs'); 
  }

}

//! REMOVING A VEHICLE POST BUTTON
if (isset($_POST['dltJob'])) {
  $user = new UserC();
  $result = $user->DeletePostJob($_POST['dltJob']);
  header('Location:\BackEnd\Views\Posts.php?t=Jobs');
}


?>