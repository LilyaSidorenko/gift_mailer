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
    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $link = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = "Ебать кому то интересно шо ты хочешь на НГ";
        $headers  = "Content-type: text/html; charset=utf-8 \r\n";
        $message = '
<html>
<head>
<meta http-equiv=«Content-Type» content=«text/html; charset=utf-8»>
</head>
<body style="margin:0;">

<table cellspacing="0" cellpadding="0"
       style="width: 100%; font-family: Open Sans, arial, serif; font-size: 16px; line-height: 1.3; color: #999999; background-color: #eeeeee">
    <tbody>
    <tr>
        <td><img src="http://www.shurov-studio.biz.ua/images/header__email.png" width="100%" style="margin-bottom: 60px;">
            <table cellspacing="0" cellpadding="0" style="width: 100%; padding:0 80px; margin-bottom:30px;">
                <tbody>
                <tr>
                    <td style="padding: 30px 15px; background-color:#ffffff;box-shadow: 2px 2px 9px -1px rgba(0,0,0,0.18);">
                                           <p style="color: #000000; font-size: 24px;">'  .$name.' </p><span style="font-size: 16px;"> С Наступающими Праздниками, '.$name.',  Ваш друг Дмитрий
<a href="mailto:dima@dima.com"  style="color: #99b5a7; text-decoration:none">(dima@dima.com)</a><br>Рассказал(а) Вам, что он(а) мечтает получить на Новый год.<br>И оставвил(а) для Вас пожелание!</span>

                        <div style="padding:60px 0 20px 0"><a href=""
                                                              style="color: #267a5a; text-transform: uppercase; text-decoration: none; font-size: 16px; font-weight:bold;">Купить
                                подарок</a></div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>';
        mail("$email", $subject, $message, $headers,
            "From: party@shurov-studio.biz.ua");
    }
    ?>

</div>
</body>
</html>
