<?php
require_once('dbconnect.php');
$db = get_db();

$course_id = $_GET['course_id'];

$query = 'SELECT id, name, course_code FROM course WHERE id = :course_id';
$statement = $db->prepare($query);
$statement->execute(array(':course_id' => $course_id));
$course = $statement->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Notes</title>
  </head>
  <body>
<?php
$course_name = $course['name'];
$course_code = $course['course_code'];
echo "<h1> Notes for $course_code - $course_name</h1>"; 
?>

  </body>
</html>
