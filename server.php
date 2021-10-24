<?php
  try {
    $db = new PDO('sqlite:test.db');
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  if(isset($_POST['del'])) {
    $db->exec("DELETE FROM names WHERE id=" . $_POST["del"] . ";");
    header('location: index.php');
  }
?>