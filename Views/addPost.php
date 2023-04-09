<?php
session_start();
$data = json_decode(file_get_contents('cars.json'), true);

if ($_GET['t'] != 'Vehicles' && $_GET['t'] != 'Jobs' && $_GET['t'] != 'Properties') {
  http_response_code(404);
  include('404.php');
  die();
} else {
  switch ($_GET['t']) {
    case 'Vehicles': ?>
                                    <form action="..\App\Controller\UserC.php" method="post" enctype="multipart/form-data">
  
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" required><br>


                                    <label for="title">Model</label>

                                <?php
                                echo '<select id="brand" name="brand" required>';
                                foreach ($data as $brand) {
                                  echo '<optgroup label="' . $brand['brand'] . '">';
                                  foreach ($brand['models'] as $model) {
                                    echo '<option value="' . $brand['brand'] . "_" . $model['title'] . '">' . $model['title'] . '</option>';
                                    ;
                                  }
                                  echo '</optgroup>';
                                }
                                echo '</select>';

                                ?>
  
                                    <br>
                                    <label for="imgs"></label>
                                    <input type="file" name="imgs[]" id="imgs" accept="image/gif, image/jpeg, image/png" multiple required><br>
  
                                    <label for="year">Year</label>
                                    <input type="number" name="year" id="year" min="1900" max="2023" required><br>
  
                                    <label for="BType">Body Type</label>
                                    <select id="BType" name="BType" required>
                                      <option value="compact">Compact</option>
                                      <option value="convertible">Convertible</option>
                                      <option value="coupe">Coupe</option>
                                      <option value="crossover">Crossover</option>
                                      <option value="electric">Electric</option>
                                      <option value="hatchback">Hatchback</option>
                                      <option value="hybrid">Hybrid</option>
                                      <option value="luxury">Luxury</option>
                                      <option value="microcar">Microcar</option>
                                      <option value="minivan">Minivan</option>
                                      <option value="muscle">Muscle</option>
                                      <option value="offroad">Off-road</option>
                                      <option value="pickup">Pick-up</option>
                                      <option value="roadster">Roadster</option>
                                      <option value="sedan">Sedan</option>
                                      <option value="sports">Sports</option>
                                      <option value="stationwagon">Station Wagon</option>
                                      <option value="suv">SUV</option>
                                      <option value="supercar">Supercar</option>
                                      <option value="van">Van</option>
                                    </select><br>
  
                                    <label for="mileage">Mileage</label>
                                    <input type="number" name="mileage" id="mileage" required><br>
  
                                    <label for="transmission">Transmission</label>
                                    <select id="transmission" name="transmission" required>
                                      <option value="Manual">Manual</option>
                                      <option value="Automatic">Automatic</option>
                                    </select>
                                    <br>
  
                                    <label for="FType">Fuel Type</label>
                                    <select name="FType" id="FType" required>
                                      <option value="Gasoline">Gasoline</option>
                                      <option value="Diesel">Diesel</option>
                                      <option value="Ethanol">Ethanol</option>
                                      <option value="Biodiesel">Biodiesel</option>
                                      <option value="Propane">Propane</option>
                                      <option value="Compressed Natural Gas">Compressed Natural Gas</option>
                                      <option value="Hydrogen">Hydrogen</option>
                                      <option value="Electricity">Electricity</option>
                                    </select><br>
  
                                    <label for="EngineSize">Engine Size</label>
                                    <input type="number" name="EngineSize" id="EngineSize" required><br>
  
                                    <label for="color">Color</label>
                                    <input type="text" name="color" id="color" required><br>
  
                                    <label for="interior">Interior</label>
                                    <input type="text" name="interior" id="interior" required><br>
  
                                    <label for="price">Price</label>
                                    <input type="number" name="price" id="price" required><br>
  
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="10"></textarea><br>
  
                                    <button name="addVehc">Add Vehicle</button>
                                    </form>

                              <?php
                              break;

    case 'Jobs': ?>
                              <form action="..\App\Controller\UserC.php" method="post" enctype="multipart/form-data">
                                <label for="JobTitle">Title</label>
                                <input type="text" name="JobTitle" id="JobTitle" required><br>
  
                                <label for="Description">Description</label>
                                <textarea name="Description" id="Description" cols="30" rows="10"></textarea><br>
  
                                <label for="Company">Company</label>
                                <input type="text" name="Company" id="Company" required><br>
  
                                <label for="JobType">Job Type</label>
                                <input type="text" name="JobType" id="JobType" required><br>
  
                                <label for="Location">Location</label>
                                <input type="text" name="Location" id="Location" required><br>
  
                                <label for="Salary">Salary</label>
                                <input type="number" name="Salary" id="Salary" required><br>
  
                                <label for="Category">Category</label>
                                <input type="text" name="Category" id="Category" required><br>
  
                                <label for="Qualification">Qualification</label>
                                <textarea name="Qualification" id="Qualification" cols="30" rows="10"></textarea><br>
  
                                <label for="Skills">Skills</label>
                                <textarea name="Skills" id="Skills" cols="30" rows="10"></textarea><br>
  
                                <label for="AppMethod">Application Method</label>
                                <input type="text" name="AppMethod" id="AppMethod" required><br>
  
                                <label for="AppDeadline">Skills</label>
                                <input type="date" name="AppDeadline" id="AppDeadline" required><br>
  
                                <label for="Contact">Contact</label>
                                <input type="text" name="Contact" id="Contact" required><br>
  
                                <button name="addJob">Add Post</button>
                              </form>
                        <?php
                        break;
    case 'Properties': ?>
                      <form action="..\App\Controller\UserC.php" method="post" enctype="multipart/form-data">
  
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" required><br>

                    <label for="PType">Property Type</label>
                    <select name="PType" id="PType" required>
                      <option value="single-family">Single-Family Home</option>
                      <option value="multi-family">Multi-Family Home</option>
                      <option value="commercial">Commercial Property</option>
                      <option value="industrial">Industrial Property</option>
                      <option value="land">Land</option>
                      <option value="mixed-use">Mixed-Use Property</option>
                      <option value="vacation">Vacation Property</option>
                      <option value="special-use">Special-Use Property</option>
                    </select><br>

                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" min="0" required><br>

                    <label for="imgs"></label>
                    <input type="file" name="imgs[]" id="imgs" accept="image/gif, image/jpeg, image/png" multiple required><br>

                    <label for="addr">Address</label>
                    <input type="text" name="addr" id="addr" required><br>

                    <label for="bedrooms">Bedrooms</label>
                    <input type="text" name="bedrooms" id="bedrooms" min="0" required><br>

                    <label for="bathrooms">bathrooms</label>
                    <input type="text" name="bathrooms" id="bathrooms" min="0" required><br>

                    <label for="lotsize">Lot Size</label>
                    <input type="number" name="lotsize" id="lotsize" min="1" required><br>

                    <label for="yearBuilt">Year built</label>
                    <input type="number" name="yearBuilt" id="yearBuilt" min="1900" max="2023" required><br>

                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10"></textarea><br>

                    <button name="addProp">Add Post</button>
                  </form>
                <?php
                break;
  }
}
?>