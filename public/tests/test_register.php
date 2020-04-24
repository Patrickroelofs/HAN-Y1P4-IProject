<?php require_once '../../core/init.php'; ?>

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