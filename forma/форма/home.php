<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <title>Лабораторная работа 3</title>
</head>

<body>
    <div class="container">
        <?php
        echo '<p> Хай, ' . $_POST['name'] . '</p>';
        if ($_POST['category'] == 'propose') {
            echo '<p> Спасибо за Ваше предложение: </p>';
            echo '<textarea>' . $_POST['message'] . '</textarea>';
        } else {
            echo '<p> Мы рассмотрим Вашу жалобу: </p>';
            echo '<textarea>' . $_POST['message'] . '</textarea>';
        }
        if (isset($_POST['attachment']) & $_POST['attachment'] != '') echo 'Вы приложили следующий файл: ' . $_POST['attachment'];

        echo '<div class="btn__wrapper"><a class="btn" href="index.php?name=' . $_POST['name'] . '&email=' . $_POST['email'] . '&source=' . $_POST['source'] . '">Заполнить снова</a> </div>';
        ?>
    </div>
</body>

</html>