<?php
require 'db_access.php';
$db = get_db();

$first_name = htmlspecialchars($_POST['first_name']);
$last_name = htmlspecialchars($_POST['last_name']);
$username = htmlspecialchars($_POST['username']);
$email = htmlspecialchars($_POST['email']);
$password1 = htmlspecialchars($_POST['password1']);
$password2 = htmlspecialchars($_POST['password2']);

if ($password1 != $password2)
{
  header("Location: create_new_user.php?message=password");
  die();
}

try {
  $stmt = $db->prepare('INSERT INTO reader(username, first_name, last_name,
                                           email, password)
                        VALUES (:username, :first_name, :last_name, :email,
                                :password)');
  $stmt->execute(array(':username' => $username, ':first_name' => $first_name,
                       ':last_name' => $last_name, 'email' => $email,
                       ':password' => $password1));
  header("Location: login.php?message=user");
  die();
}
catch (Exception $e) {
  echo "Error: " . $e->getMessage();
  //header("Location: create_new_user.php?message=fail");
  die();
}

echo "Hello $first_name $last_name, How are you?";
echo " $username will be your username, and $password1 shall be your password.";
echo " Assuming that $password1 equals $password2, otherwise you are doomed.";
?>
