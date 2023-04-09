<?php
include_once('C:\Apache24\htdocs\BackEnd\App\Config\config.php');
session_start();
class User extends Database
{
  
  // User's Account Methods
  public function CreateAccount($username, $email, $pwd, $fn, $ln, $tel, $address)
  {
    // Code to Sign up a user
    try {
      $this->setConnection();
      $sql = "INSERT INTO `user` (`UID`,`username`, `email`, `Password`, `firstName`, `lastName`, `tel`, `address`, `DateCreated`) VALUES (?,?,?,?,?,?,?,?,?)";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, uniqid('U'));
      $stmt->bindParam(2, $username);
      $stmt->bindParam(3, $email);
      $stmt->bindParam(4, $pwd);
      $stmt->bindParam(5, $fn);
      $stmt->bindParam(6, $ln);
      $stmt->bindParam(7, $tel);
      $stmt->bindParam(8, $address);
      $stmt->bindParam(9, date('y-m-d G:i:s',time()));
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return false;
    } finally {
      $this->closeConnection();
    }
    
  }
  
  public function LogintoAccount($email, $pwd)
  {
    // code to log in a user
    try {
      $this->setConnection();
      $sql = "SELECT * from `user` where `email` = ? and `password` = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, $email);
      $stmt->bindParam(2, $pwd);
      $stmt->execute();
      return $stmt->fetch();
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return false;
    } finally {
      $this->closeConnection();
    }
  }
  
  public function LogoutAccount()
  {
    // Code to Log out 
    try {
      session_unset();
      session_destroy();
      return true;
    } catch (Exception $e) {
      error_log($e->getMessage());
      return false;
    }
  }
  public function ShowProfile($uid)
  {
    try {
      $this->setConnection();
      $sql = "SELECT * FROM user WHERE `UID` = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, $uid);
      $stmt->execute();
      return $stmt->fetch();
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return false;
    } finally {
      $this->closeConnection();
    }
  }
  

  // Vehicle's Posts Methods
  public function createPostVehicle($userId, $title, $Description, $Brand, $Model, $ImagesPath, $Year, $Mileage, $BodyType, $Transmission, $FuelType, $EngineSize, $Color, $Interior, $Price)
  {
    try {
      $this->setConnection();
      $sql = "INSERT INTO `vehicles` (`VehicleID`, `Title`, `Description`, `Brand`, `Model`, `ImagesPath`, `Year`, `Mileage`, `BodyType`, `Transmission`, `FuelType`, `EngineSize`, `Color`, `Interior`, `Price`, `SellerID`, `DateCreated`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, uniqid('V'));
      $stmt->bindParam(2, $title);
      $stmt->bindParam(3, $Description);
      $stmt->bindParam(4, $Brand);
      $stmt->bindParam(5, $Model);
      $stmt->bindParam(6, $ImagesPath);
      $stmt->bindParam(7, $Year);
      $stmt->bindParam(8, $Mileage);
      $stmt->bindParam(9, $BodyType);
      $stmt->bindParam(10, $Transmission);
      $stmt->bindParam(11, $FuelType);
      $stmt->bindParam(12, $EngineSize);
      $stmt->bindParam(13, $Color);
      $stmt->bindParam(14, $Interior);
      $stmt->bindParam(15, $Price);
      $stmt->bindParam(16, $userId);
      $stmt->bindParam(17, date('y-m-d G:i:s',time()));

      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return false;
    } finally {
      $this->closeConnection();
    }

  }

  public function DeletePostVehicle($VehicleID) {
    try {
      $this->setConnection();
      $sql = "DELETE from `vehicles` where `VehicleID` = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, $VehicleID);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return false;
    } finally {
      $this->closeConnection();
    }
  }

  public function ShowVehicles($uid)
  {
    try {
      $this->setConnection();
      $sql = "SELECT * FROM vehicles WHERE `SellerID` = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, $uid);
      $stmt->execute();
      $vehicles = array();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $vehicles[] = array(
          'vid' => $row['VehicleID'],
          'uid' => $row['Seller_id'],
          'title' => $row['Title'],
          'Description' => $row['Description'],
          'Brand' => $row['Brand'],
          'Model' => $row['Model'],
          'ImagesPath' => $row['ImagesPath'],
          'Year' => $row['Year'],
          'Mileage' => $row['Mileage'],
          'BodyType' => $row['BodyType'],
          'Transmission' => $row['Transmission'],
          'FuelType' => $row['FuelType'],
          'EngineSize' => $row['EngineSize'],
          'Color' => $row['Color'],
          'Interior' => $row['Interior'],
          'Price' => $row['Price'],
          'DateCreated' => $row['DateCreated']
        );
      }
      return $vehicles;
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return false;
    } finally {
      $this->closeConnection();
    }
  }
  public function ShowVehiclesByID($vid)
  {
    try {
      $this->setConnection();
      $sql = "SELECT * FROM vehicles WHERE `VehicleID` = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, $vid);
      $stmt->execute();
      return $stmt->fetch();
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return false;
    } finally {
      $this->closeConnection();
    }
  }

  public function SearchV($q)
  {
    try {
      $this->setConnection();
      $sql = "SELECT `VehicleID` FROM `vehicles` WHERE `Title` LIKE '%$q%' OR `Description` LIKE '%$q%' OR `Brand` LIKE '%$q%' OR `Model` LIKE '%$q%' OR `Year` LIKE '%$q%' OR `Mileage` LIKE '%$q%' OR `BodyType` LIKE '%$q%' OR `Transmission` LIKE '%$q%' OR `FuelType` LIKE '%$q%' OR `EngineSize` LIKE '%$q%' OR `Color` LIKE '%$q%' OR `Interior` LIKE '%$q%' OR `Price` LIKE '%$q%'";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll();
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return $e;
    } finally {
      $this->closeConnection();
    }
  }
  public function SearchP($q)
  {
    try {
      $this->setConnection();
      $sql = "SELECT `PropertyID` FROM `properties` WHERE `Title` LIKE '%$q%' OR `PropertyType` LIKE '%$q%' OR `Price` LIKE '%$q%' OR `Address` LIKE '%$q%' OR `YearBuilt` LIKE '%$q%' OR `Description` LIKE '%$q%'";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll();
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return $e;
    } finally {
      $this->closeConnection();
    }
  }
  public function SearchJ($q)
  {
    try {
      $this->setConnection();
      $sql = "SELECT `JobID` FROM `job` WHERE `JobTitle` LIKE '%$q%' OR `Company` LIKE '%$q%' OR `Location` LIKE '%$q%' OR `JobType` LIKE '%$q%' OR `Category` LIKE '%$q%' OR `Salary` LIKE '%$q%' OR `Description` LIKE '%$q%' OR `Qualification` LIKE '%$q%' OR `Skills` LIKE '%$q%'";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll();
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return $e;
    } finally {
      $this->closeConnection();
    }
  }


  // Properties's Posts Methods  
  public function createPostProperty($userId, $title, $Description, $ImagesPath, $PropertyType, $address, $bedrooms, $bathrooms, $Price, $yearBuilt, $LotSize)
  {
    try {
      $this->setConnection();
      $sql = "INSERT INTO `properties` (`PropertyID`, `Title`, `PropertyType`, `Price`, `ImagesPath`,`Address`, `Bedrooms`, `Bathrooms`, `LotSize`, `YearBuilt`, `Description`, `SellerID`, `DateCreated`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?) ";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, uniqid('P'));
      $stmt->bindParam(2, $title);
      $stmt->bindParam(3, $PropertyType);
      $stmt->bindParam(4, $Price);
      $stmt->bindParam(5, $ImagesPath);
      $stmt->bindParam(6, $address);
      $stmt->bindParam(7, $bedrooms);
      $stmt->bindParam(8, $bathrooms);
      $stmt->bindParam(9, $LotSize);
      $stmt->bindParam(10, $yearBuilt);
      $stmt->bindParam(11, $Description);
      $stmt->bindParam(12, $userId);
      $stmt->bindParam(13, date('y-m-d G:i:s',time()));
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return false;
    } finally {
      $this->closeConnection();
    }

  }

  public function DeletePostProperty($PropertyID) {
    try {
      $this->setConnection();
      $sql = "DELETE from `properties` where `PropertyID` = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, $PropertyID);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return false;
    } finally {
      $this->closeConnection();
    }
  }

  public function ShowProperties($uid)
  {
    try {
      $this->setConnection();
      $sql = "SELECT * FROM properties WHERE `SellerID` = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, $uid);
      $stmt->execute();
      $properties = array();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $properties[] = array(
          'pid' => $row['PropertyID'],
          'uid' => $row['SellerID'],
          'title' => $row['Title'],
          'Description' => $row['Description'],
          'PropertyType' => $row['PropertyType'],
          'ImagesPath' => $row['ImagesPath'],
          'Address' => $row['Address'],
          'Bedrooms' => $row['Bedrooms'],
          'Bathrooms' => $row['Bathrooms'],
          'LotSize' => $row['LotSize'],
          'YearBuilt' => $row['YearBuilt'],
          'Price' => $row['Price'],
          'DateCreated' => $row['DateCreated']
        );
      }
      return $properties;
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return false;
    } finally {
      $this->closeConnection();
    }
  }

  public function ShowPropertiesByID($pid)
  {
    try {
      $this->setConnection();
      $sql = "SELECT * FROM properties WHERE `PropertyID` = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, $pid);
      $stmt->execute();
      return $stmt->fetch();
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return 'wth';
    } finally {
      $this->closeConnection();
    }
  }
  // Job's Posts Methods
  public function createPostJob($userId, $JobTitle, $Description, $Company, $JobType, $Location, $Salary, $Category, $Qualification, $Skills, $AppDeadline, $AppMethod, $Contact)
  {
    try {
      $this->setConnection();
      $sql = "INSERT INTO `job` (`JobID`, `JobTitle`, `Company`, `Location`, `JobType`,`Category`, `Salary`, `Description`, `Qualification`, `Skills`, `ApplicationDeadline`, `ApplicationMethod`, `Contact`, `SellerID`, `DateCreated`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, uniqid('J'));
      $stmt->bindParam(2, $JobTitle);
      $stmt->bindParam(3, $Company);
      $stmt->bindParam(4, $Location);
      $stmt->bindParam(5, $JobType);
      $stmt->bindParam(6, $Category);
      $stmt->bindParam(7, $Salary);
      $stmt->bindParam(8, $Description);
      $stmt->bindParam(9, $Qualification);
      $stmt->bindParam(10, $Skills);
      $stmt->bindParam(11, $AppDeadline);
      $stmt->bindParam(12, $AppMethod);
      $stmt->bindParam(13, $Contact);
      $stmt->bindParam(14, $userId);
      $stmt->bindParam(15, date('y-m-d G:i:s',time()));
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return false;
    } finally {
      $this->closeConnection();
    }
  }

  public function DeletePostJob($JobID) {
    try {
      $this->setConnection();
      $sql = "DELETE from `job` where `JobID` = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, $JobID);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return false;
    } finally {
      $this->closeConnection();
    }
  }

  public function ShowJobs($uid)
  {
    try {
      $this->setConnection();
      $sql = "SELECT * FROM job WHERE `SellerID` = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, $uid);
      $stmt->execute();
      $jobs = array();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $jobs[] = array(
          'jid' => $row['JobID'],
          'uid' => $row['SellerID'],
          'JobTitle' => $row['JobTitle'],
          'Description' => $row['Description'],
          'JobType' => $row['JobType'],
          'Location' => $row['Location'],
          'Company' => $row['Company'],
          'Salary' => $row['Salary'],
          'Qualifications' => $row['Qualification'],
          'Skills' => $row['Skills'],
          'ApplicationDeadline' => $row['ApplicationDeadline'],
          'ApplicationMethod' => $row['ApplicationMethod'],
          'Contact' => $row['Contact'],
          'DateCreated' => $row['DateCreated']
        );
      }
      return $jobs;
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return $e;
    } finally {
      $this->closeConnection();
    }
  }
  public function ShowJobsByID($jid)
  {
    try {
      $this->setConnection();
      $sql = "SELECT * FROM job WHERE `JobID` = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, $jid);
      $stmt->execute();
      return $row = $stmt->fetch();
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return $e;
    } finally {
      $this->closeConnection();
    }
  }
  public function ShowAllProps()
  {
    try {
      $this->setConnection();
      $sql = "SELECT * FROM properties";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $properties = array();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $properties[] = array(
          'pid' => $row['PropertyID'],
          'uid' => $row['SellerID'],
          'title' => $row['Title'],
          'Description' => $row['Description'],
          'PropertyType' => $row['PropertyType'],
          'ImagesPath' => $row['ImagesPath'],
          'Address' => $row['Address'],
          'Bedrooms' => $row['Bedrooms'],
          'Bathrooms' => $row['Bathrooms'],
          'LotSize' => $row['LotSize'],
          'YearBuilt' => $row['YearBuilt'],
          'Price' => $row['Price'],
          'DateCreated' => $row['DateCreated']
        );
      }
      return $properties;
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return $e;
    } finally {
      $this->closeConnection();
    }
  }  
  public function ShowAllVehc()
  {
    try {
      $this->setConnection();
      $sql = "SELECT * FROM vehicles";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $vehicles = array();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $vehicles[] = array(
          'vid' => $row['VehicleID'],
          'uid' => $row['Seller_id'],
          'title' => $row['Title'],
          'Description' => $row['Description'],
          'Brand' => $row['Brand'],
          'Model' => $row['Model'],
          'ImagesPath' => $row['ImagesPath'],
          'Year' => $row['Year'],
          'Mileage' => $row['Mileage'],
          'BodyType' => $row['BodyType'],
          'Transmission' => $row['Transmission'],
          'FuelType' => $row['FuelType'],
          'EngineSize' => $row['EngineSize'],
          'Color' => $row['Color'],
          'Interior' => $row['Interior'],
          'Price' => $row['Price'],
          'DateCreated' => $row['DateCreated']
        );
      }
      return $vehicles;
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return false;
    } finally {
      $this->closeConnection();
    }
  }
  public function ShowAllJobs()
  {
    try {
      $this->setConnection();
      $sql = "SELECT * FROM job";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $jobs = array();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $jobs[] = array(
          'jid' => $row['JobID'],
          'uid' => $row['SellerID'],
          'JobTitle' => $row['JobTitle'],
          'Description' => $row['Description'],
          'JobType' => $row['JobType'],
          'Location' => $row['Location'],
          'Company' => $row['Company'],
          'Salary' => $row['Salary'],
          'Qualifications' => $row['Qualification'],
          'Skills' => $row['Skills'],
          'ApplicationDeadline' => $row['ApplicationDeadline'],
          'ApplicationMethod' => $row['ApplicationMethod'],
          'Contact' => $row['Contact'],
          'DateCreated' => $row['DateCreated']
        );
      }
      return $jobs;
    } catch (PDOException $e) {
      error_log($e->getMessage());
      return $e;
    } finally {
      $this->closeConnection();
    }
  }
}



?>

