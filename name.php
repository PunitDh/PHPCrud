<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Tutorial</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
  <?php
    try {
      $db = new PDO('sqlite:test.db');
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  ?>
  <div class="container ml-4">
    <h1 class="text-xl font-bold text-center">Hello PHP</h1>

    <?php
      $_id_ = $_GET['id'];
      $result = $db->query('SELECT * FROM names WHERE id=' . $_id_ . ';');
    ?>

    <form action="index.php" method="POST">
      <input type="hidden" name="method" value="put">
      <?php
        foreach($result as $res) {
          print '<input type="text" name="name" autocomplete="off" value="'. $res["name"] .'">';
          print '<input type="hidden" name="id" value="'.$_id_.'">';
        }
      ?>
      <input type="submit" class="btn btn-primary" value="Update">
    </form>
  </div>
</body>

</html>