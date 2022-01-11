<?php
error_reporting(E_ALL & ~E_NOTICE);
include 'header.html';
if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $email = $_GET['email'];
    $source = $_GET['source'];
}
?>
<main class="form-main">
    <h1>Форма обратной связи</h1>
    <div class="container">
        <form action="home.php" method="POST">
            <div class="form-group">
                <label class="form-label" for="name">ФИО</label>
                <input class="form-input" type="text" name="name" id="name" placeholder="Иванов И.И." value="<?= $name; ?>" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input class="form-input" type="email" name="email" id="email" placeholder="abc@yandex.ru" value="<?= $email; ?>" required>
            </div>
            <div class="form-group">
                <p>Как Вы узнали о нас?</p>
                <input type="radio" name="source" id="advertising" checked>
                <?php if ($source == 'advertising') echo 'checked'; ?>
                <label class="form-label" for="advertising">Реклама в интернете</label>
                <input type="radio" name="source" id="friends">
                <?php if ($source == 'friends') echo 'checked'; ?>
                <label class="form-label" for="friends">Рассказали друзья</label>
            </div>
            <div class="form-group">
                <label class="form-label" for="category">Категория обращения</label>
                <select name="category" id="category">
                    <option value="propose">Предложение</option>
                    <option value="grievance">Жалоба</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="message">Текст сообщения</label>
                <textarea name="message" id="message" cols="30" rows="10" placeholder="Введите сообщение"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="attachment">Вложение</label>
                <input type="file" name="attachment" id="attachment">
            </div>
            <div class="form-group">
                <input type="checkbox" name="agreement" id="agreement" value="yes" required>
                <label class="form-label" for="checkbox">Согласие на обработку персональных данных</label>
            </div>
            <div class="form-group">
                <input class="button" type="submit" value="Отправить">
            </div>
        </form>
    </div>
</main>
</body>

</html>