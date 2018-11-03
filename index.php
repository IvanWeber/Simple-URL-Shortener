<?php if(empty($_POST)): ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Сокращатель ссылок</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h1 class="main-header">Сократить ссылку</h1>
    <form action="" method="post">
        <input type="url" name="url" required placeholder="Введите вашу ссылку" autocomplete="off">
        <input type="submit" value="Сократить" name="submit">
    </form>
</div>
</body>
</html>

<?php elseif(!filter_var($_POST['url'], FILTER_VALIDATE_URL) && isset($_POST)): ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Сокращатель ссылок</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h1 class="main-header">Сократить ссылку</h1>
    <form action="" method="post">
        <input type="url" name="url" required placeholder="Введите вашу ссылку" autocomplete="off">
        <input type="submit" value="Сократить" name="submit">
    </form>
	<p class="validation">Введите корректный адрес</p>
</div>
</body>
</html>

<?php else: ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Сокращатель ссылок</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h1 class="main-header">Сократить ссылку</h1>
    <form action="" method="post">
        <input type="url" name="url" required placeholder="Введите вашу ссылку" autocomplete="off">
        <input type="submit" value="Сократить" name="submit">
    </form>
<?php
$h = "QqWwEeRrTtYyUuIiOoPpAaSsDdFfGgHhJjKkLlZzXxCcVvBbNnMm1234567890"; //Выбор символов, из которых будет состоять случайный набор
$rand = substr(str_shuffle($h), 0, 5); //создаём случайный набор символов. Цифра 5 обозначает длину набора
$site = "https://it-sol-test-task.000webhostapp.com/"; //Адрес сайта
$url = $_POST['url'];

if ($_POST['submit']) {
echo "<h2 class='second-header'>Ваша ссылка:</h2><br/><p><a href='$site/rand-files/$rand.php' target='_blank'>$site$rand</a></p>"; //Вывод ссылки для пользователя
$f = fopen("rand-files/$rand.php", "w"); //Создание файла с именем случайного набора в каталоге rand-files
fwrite($f, "<?php header('Location: $url') ?>"); //Запись в код редиректа, со ссылкой которую ввёл пользователь
fclose($f); //Закрытие файла

$fh = fopen(".htaccess", "a"); //Открытие файла .htaccess с дозаписью на последний байт
fwrite($fh, "
RewriteRule ^$rand$ rand-files/$rand.php"); //Запись ссылки на файл в каталоге rand-files и её сокращённый вариант, который был дан пользователю. !ВНИМАНИЕ! Перенос сделан специально, иначе всё будет писаться в плотную и вызовет 500 ошибку!
fclose($fh); //Закрытие файла
}
?>
</div>
</body>
</html>
<?php endif; ?>





