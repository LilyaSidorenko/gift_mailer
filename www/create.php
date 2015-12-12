<?php
/**
 * Created by PhpStorm.
 * User: you
 * Date: 12/12/15
 * Time: 4:26 PM
 */
require 'database.php';

if (!empty($_POST)) {
    $nameError = null;
    $emailError = null;
    $your_emailError = null;


    $name = $_POST['name'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $your_email = $_POST['your_email'];


    $valid = true;
    if (empty($name)) {
        $nameError = 'Пожалуйста,введите имя';
        $valid = false;
    }

    if (empty($email)) {
        $emailError = 'Пожалуйста,введите существующий Email';
        $valid = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Пожалуйста,введите существующий Email';
        $valid = false;
    }
    if (empty($your_email)) {
        $your_emailError = 'Пожалуйста,введите существующий Email';
        $valid = false;
    } else if (!filter_var($your_email, FILTER_VALIDATE_EMAIL)) {
        $your_emailError = 'Пожалуйста,введите существующий Email';
        $valid = false;
    }


    // insert data
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO wishes (name,email,your_email) values(?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($name, $email, $your_email));
        Database::disconnect();
        header("Location: send.php");
    }
    $pdo = Database::connect();
    $sql = 'SELECT * FROM  ORDER BY id DESC ';
    foreach ($pdo->query($sql) as $row) {
        echo '<td><a class="btn" href="read.php?id='.$row['id'].'">Read</a></td>';
        echo '</tr>';
    }
    Database::disconnect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv=«Content-Type» content=«text/html; charset=utf-8»>

</head>

<body>
<div class="container">

    <div class="span10 offset1">
        <div class="row">
            <h3>Create a mailer</h3>
        </div>

        <form class="form-horizontal"  method="post">
            <div class="control-group <?php echo !empty($nameError) ? 'error' : ''; ?>">
                <label class="control-label">Введите имя вашего друга</label>

                <div class="controls">
                    <input name="name" type="text" placeholder="Name" value="<?php echo !empty($name) ? $name : ''; ?>">
                    <?php if (!empty($nameError)): ?>
                        <span class="help-inline"><?php echo $nameError; ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($emailError) ? 'error' : ''; ?>">
                <label class="control-label">Email Вашего Друга</label>

                <div class="controls">
                    <input name="email" type="text" placeholder="Email Address"
                           value="<?php echo !empty($email) ? $email : ''; ?>">
                    <?php if (!empty($emailError)): ?>
                        <span class="help-inline"><?php echo $emailError; ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($your_emailError) ? 'error' : ''; ?>">
                <label class="control-label">Ваш Email</label>

                <div class="controls">
                    <input name="your_email" type="text" placeholder="Main Email Address"
                           value="<?php echo !empty($your_email) ? $your_email : ''; ?>">
                    <?php if (!empty($your_emailError)): ?>
                        <span class="help-inline"><?php echo $your_emailError; ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Отправил блять</button>
            </div>
        </form>
    </div>


</div>
</body>
</html>
