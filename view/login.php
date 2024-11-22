<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OSS CR Track</title>

    <link rel="stylesheet" href="http://ossportal/osscr/asset/css/bootstrap.min.css"  crossorigin="anonymous">
    <link href="asset/css/login.css" rel="stylesheet">    
    <link rel="stylesheet" type="text/css" href="http://ossportal/osscr/asset/css/style_2.css">

</head>
<body class="text-center">

<main class="form-signin">
  <form action="controller/authController.php" method="POST" >
    <!-- <img class="mb-4" src="/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
    <h1 class="h3 mb-3 fw-normal">OSS CR TRACK</h1>
    <h2 class="h3 mb-3 fw-normal">Sign in</h2>

    <div class="form-floating">
      <input type="text" class="form-control" id="sno" name="sno" placeholder="name@example.com">
      <label for="floatingInput">Service No</label>
    </div>
    <br/>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
  </form>
</main>


</body>
</html>