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