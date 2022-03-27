<html>
<head>
    <title>Login</title>
    <!-- <link rel="stylesheet" href="CSS/login.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<!--Navbar-->
<div class="navbar navbar-light bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="#">Online Tickets</a>
      <div>
        <form method="POST" action="../includes/functions.inc.php" class="form-inline p-2 my-lg-0" target="_self">
          <input type="email" placeholder="Email" name="email">
          <input type="password" placeholder="Password" name="psw">
          <button type="submit" class="btn btn-primary" name="login">Login</button>
          <a href="register.php"><input type="button" class="btn btn-primary" value="Register"/></a>
        </form>
      </div>
    </div>
</div>
    
    
