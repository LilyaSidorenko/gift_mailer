<?php
require 'database.php';
$pdo = Database::connect();
$sql = 'SELECT * FROM wishes ORDER BY id DESC LIMIT 1';
foreach ($pdo->query($sql) as $row) {
    echo '<tr>';
    echo '<tr>' . $row['id'];
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td><</td>';
    echo '</tr>';
}
Database::disconnect();
if ( !empty($_POST)) {
    // keep track validation errors
    $nameError = null;
    $emailError = null;
    $mobileError = null;

    // keep track post values
    $email = $row['email'];

    // validate input
    $valid = true;
    if (empty($email)) {
        $emailError = 'Please enter Email Address';
        $valid = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Please enter a valid Email Address';
        $valid = false;
    }

    if (empty($mobile)) {
        $mobileError = 'Please enter Mobile Number';
        $valid = false;
    }
}




    $name=$row['name'];
    $email=$row['email'];
    ?>
    <form action="" method="post">
        <div class="control-group <?php echo !empty($nameError) ? 'error' : ''; ?>">
            <label class="control-label">Name</label>

            <div class="controls">
                <input name="name" type="text" placeholder="Name" value="<?php echo $email;?>">
                <?php if (!empty($nameError)): ?>
                    <span class="help-inline"><?php echo $nameError; ?></span>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-success">Send</button>
    <?php
    var_dump($row['email']);

    if ($_POST['submit']) {
        $link = 'http://www.shurov-studio.biz.ua/update.php?id=' . $row['id'];
        $name = $row['email'];
        $email= $row['email'];
        $subject = "Ебать кому то интересно шо ты хочешь на НГ";
        $headers = "Content-type: text/html; charset=utf-8 \r\n";
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
                                           <p style="color: #000000; font-size: 24px;">' . $row['email'] . ' </p><span style="font-size: 16px;"> С Наступающими Праздниками, ' . $name . ',  Ваш друг Дмитрий
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
