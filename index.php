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
    $db->exec("CREATE TABLE IF NOT EXISTS names(id INTEGER PRIMARY KEY AUTOINCREMENT,name TEXT)");
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  ?>

  <div class="container ml-4">
    <h1 class="text-xl font-bold text-center">
      <?php
      if ($_POST["method"] == "put") {
        $db->exec("UPDATE names SET name='" . $_POST["name"] . "' WHERE id=" . $_POST["id"] . ";");
      } elseif ($_POST["name"]) {
        $db->exec("INSERT INTO names(name) VALUES('" . $_POST["name"] . "');");
        echo "Hello " . $_POST["name"];
      } else {
        echo "Hello PHP";
      }
      ?>
    </h1>

    <div class='container'>
      <table border=1 class='table'>
        <tr>
          <td>ID</td>
          <td>Name</td>
          <td>Actions</td>
        </tr>
        <?php
        $result = $db->query('SELECT * FROM names;');
        foreach ($result as $row) {
          $_id_ = $row['id'];
          print "<tr><td>" . $_id_ . "</td>";
          print "<form action='server.php' method='POST'>";
          print "<input type='hidden' name='del' value='" . $_id_ . "'>";
          print "<td>" . $row['name'] . "</td><td><a href='name.php?id=" . $_id_ . "' class='btn btn-primary me-4'>Edit</a>";
          print "<button type='submit' class='btn btn-danger me-4'>Delete</button></td></tr>";
          print "</form>";
        }
        ?>
      </table>
    </div>
    <form action="index.php" method="POST">
      <input type="text" name="name" autocomplete="off">
      <input type="submit" value="Add New">
    </form>
  </div>
</body>

</html>