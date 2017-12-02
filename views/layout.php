<DOCTYPE html>
<html>
  <head>
    <link href="assets/styles/app.css" rel="stylesheet">
  </head>
  <body>
    <header>
      <a href='/ql'>Home</a>
      <a href='?controller=energy_consumptions&action=index'>records</a>
      <a href='?controller=sessions&action=create'>tenant log in</a>
    </header>
    <body>
      <?php require_once('routes.php'); ?>
    </body>

    <footer>
      Copyright
    </footer>
  <body>
<html>