

<body>
  <h1>Sign in</h1>
  <form action="..\App\Controller\UserC.php" method="post">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?php if(isset($_COOKIE['email'])) echo $_COOKIE['email']?>" required><br>
    <label for="pwd">Password</label>
    <input type="password" id="pwd" name="pwd" value="<?php if(isset($_COOKIE['password'])) echo $_COOKIE['password']?>" required><br>
    <label for="remember">Remember me</label>
    <input type="checkbox" name="remember" id="remember"><br>
    <button type="submit" name="singin">Sign In</button>
  </form>
</body>

<?php 
if($_GET['I']==true) {
  echo 'Invalid Email or Password';
}
?>
