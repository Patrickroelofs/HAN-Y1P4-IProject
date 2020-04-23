<?php
require_once '../../core/init.php';

if(Input::exists()) {
  if(Token::check(Input::get('token'))) {
      $validate = new Validate();
      $validation = $validate->check($_POST, array(
              'username' => array('required' => true),
              'password' => array('required' => true)
      ));

      if($validation->passed()){
          $user = new User();
          $login = $user->login(Input::get('username'), Input::get('password'));

          if($login){
              echo 'Success';
          } else {
              echo 'not working?';
          }

      } else {
          foreach ($validation->errors() as $error){
              echo $error . '<br>';
          }
      }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Testfile</title>
</head>
<body>
<form action="" method="post">
    <div class="field">
        <label for="username">Gebruikersnaam</label>
        <input type="text" name="username" id="username" value="">
    </div>

    <div class="field">
        <label for="password">Wachtwoord</label>
        <input type="password" name="password" id="password" value="">
    </div>

    <div class="field">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" value="Submit">
    </div>
</form>
</body>
</html>