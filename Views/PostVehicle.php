

<form action="..\App\Controller\UserC.php" method="post" enctype="multipart/form-data">
  
  <label for="title">Title</label>
  <input type="text" name="title" id="title" required><br>

  <label for="brand">Brand</label>
  <input type="text" name="brand" id="brand" required><br>
  
  <label for="model">Model</label>
  <input type="text" name="model" id="model" required><br>
  
  <label for="imgs"></label>
  <input type="file" name="imgs[]" id="imgs" accept="image/gif, image/jpeg, image/png" multiple required><br>
  
  <label for="year">Year</label>
  <input type="number" name="year" id="year" min="1900" max="2023" required><br>
  
  <label for="BType">Body Type</label>
  <input type="text" name="BType" id="BType" required><br>
  
  <label for="mileage">Mileage</label>
  <input type="number" name="mileage" id="mileage" required><br>
  
  <label for="transmission">Transmission</label>
  <input type="text" name="transmission" id="transmission" required><br>
  
  <label for="FType">Fuel Type</label>
  <input type="text" name="FType" id="FType" required><br>
  
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

