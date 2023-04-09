

<form action="..\App\Controller\UserC.php" method="post" enctype="multipart/form-data">
  
  <label for="title">Title</label>
  <input type="text" name="title" id="title" required><br>
  
  <label for="PType">PropertyType</label>
  <input type="text" name="PType" id="PType" required><br>
  
  <label for="price">Price</label>
  <input type="number" name="price" id="price" required><br>
  
  <label for="imgs"></label>
  <input type="file" name="imgs[]" id="imgs" accept="image/gif, image/jpeg, image/png" multiple required><br>
  
  <label for="addr">Address</label>
  <input type="text" name="addr" id="addr" required><br>
  
  <label for="bedrooms">Bedrooms</label>
  <input type="text" name="bedrooms" id="bedrooms" required><br>
  
  <label for="bathrooms">bathrooms</label>
  <input type="text" name="bathrooms" id="bathrooms" required><br>
  
  <label for="lotsize">Lot Size</label>
  <input type="number" name="lotsize" id="lotsize" required><br>
  
  <label for="yearBuilt">Year built</label>
  <input type="number" name="yearBuilt" id="yearBuilt" required><br>
  
  <label for="description">Description</label>
  <textarea name="description" id="description" cols="30" rows="10"></textarea><br>
  
  <button name="addProp">Add Post</button>
</form>