<?php require_once '../../core/init.php';

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {

        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array(
                'required' => true,
                'min' => 2,
                'max' => 255,
                'unique' => 'Gebruiker'
            ),
            'email' => array(),
            'password' => array()
        ));

        if ($validation->passed()) {
            $user = new User();

            try {

                $user->create(array(
                    'gebruikersnaam' => Input::get('username'),
                    'emailadres' => Input::get('email'),
                    'wachtwoord' => Hash::make('wachtwoord')
                ));

                Session::flash('index', 'Jouw account is geregistreerd!');
                Redirect::to('test_login.php');

            } catch (Exception $e) {
                die($e->getMessage());
            }

        } else {
            foreach ($validation->errors() as $error) {
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
            <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>">
        </div>

        <div class="field">
            <label for="email">Emailadres</label>
            <input type="text" name="email" id="email" value="">
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


<?php
//$user = Database::getInstance()->query("SELECT * FROM Gebruiker");
//
//if(!$user->count()) {
//    echo 'no user';
//} else {
//    echo $user->first()->gebruikersnaam;
//}
?>
<?php
//$user = Database::getInstance()->insert('Gebruiker', array(
//    'gebruikersnaam' => 'Testuser',
//    'emailadres' => 'contact@patrickroelofs.com',
//    'wachtwoord' => 'wachtwoord'
//));

?>
<?php
//$user = Database::getInstance()->update('Gebruiker', 1, array(
//    'gebruikersnaam' => 'Testuser'
//));

?>
<?php
//if(Session::exists('success')) {
//    echo Session::flash('success');
//}
?>

