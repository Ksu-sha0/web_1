<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <?php echo '<title>'.$name = 'Веб-разработчик Скворцова К.И.'.' </title>' ?>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <header class="header">
            <div class="container">
                <nav class="main-menu">
                    <a class = "navigation" href="
                    <?php
                        $text='ОБО МНЕ';
                        $ref = '#about';
                        $current=true;
                        echo $ref;                    
                    ?>"
                    <?php
                        if($current) echo ' id="underline"';
                    ?>

                    ><?= $text?></a>
                    
                    <a href="<?php
                        $text='УМЕНИЯ';
                        $ref = '#skills';
                        echo $ref;
                    ?>"
                    class = "navigation"><?= $text?></a>
                    <a  href="<?php
                        $text='РАНДОМНЫЕ ФАКТЫ';
                        $ref = '#facts';
                        echo $ref;
                    ?>"
                    class = "navigation"><?= $text?></a>
                </nav>   
            <div class="text-center py-5">
                <h1 class="name">Скворцова Ксения Ильинична</h1>
                <h2>группа 201-361</h2>
                <p class="w-50 mx-auto my-3 ">
                Создаю настроение людям,<br> помогаю в обычной жизни,<br> а в университете появляется моя вторая личность, которая постоянно тупит.
                </p>
                <a class="btn contact-me-btn" href="mailto:ks00716@mail.ru">Написать мне</a>
            </div>
            </div>
        </header>
        
        <main>
            <div class="container">
             <section id="about">
                <h1 id = >Обо мне</h1>
                <?php
                    if (date("s") % 2 === 0) {
                        $name = "images/22.jpg";
                    } else {
                        $name = "images/17.jpg";
                    }
                ?>  

                <figure class="avatar">
                   <img src=<?=$name?> alt="Person"> 
                </figure>
                
                <p>
                Надеюсь, что веселая. Вроде бы меня все любят, но могу ошибаться. Состою в закрытом комьюнити tri.tupika (подписывайтесь на инстаграм, хоть там теперь ничего и не происходит).  <br> Второй год пытаюсь не вылететь из университета. Люблю спорт, но не могу им заниматься. Обожаю читать и если не быть программистом, то предпочла бы стать издателем. Оказывается, что умею готовить. <br> Занималась практически всем в этой жизни.  <br>Когда в 14 лет в мамин день рождения прыгала с парашутом, бабушка положила мне маленькую иконку в карман против наркозависимости.  <br>Люблю танцевать и петь. Бросила пить в 18.  <br>Наверное это все.
                </p>
            </section> 
            <section id="skills">
                <h1 $ref='skills.php'>Умения</h1>
                <p>
                Умею шить, петь, танцевать,  вязать, готовить, драться, стрелять, играть в шахматы, хоккей, футбол, баскетбол, волейбол, теннис, плавать и вроде что-то еще. 
                </p>
                
            </section>   

            <section id="facts">
                <h1 id = "<?php
                        $text='РАНДОМНЫЕ ФАКТЫ';
                        $ref='technologies.html';
                        echo $ref;
                    ?>">Рандомные факты</h1>
                <p>
                    Мой инстаграм: xe___non <br>
                    Люблю или пресную еду, или острую <br>
                    Люблю ходить без гугл карт чтобы заблудиться и найти дорогу самой, тк это  весело <br>
                    Люблю сладкое  <br>
                    Люблю Владу <br>
                    2 моих кактуса умерли за месяц  <br>
                </p>

                <h2>Языки:</h2>
                <?php
                    $arr = array('HTML', 'CSS', 'JAVASCRIPT', 'PASCAL', 'C++', 'PYTHON', '1C');
                ?>
                <ul>
                    <li><?=$arr[0];?></li>
                    <li><?=$arr[1];?></li>
                    <li><?=$arr[2];?></li>
                    <li><?=$arr[3];?></li>
                    <li><?=$arr[4];?></li>
                    <li><?=$arr[5];?></li>
                    <li><?=$arr[6];?></li>
                </ul>
                <div class="text-right">
                    <a class="btn" href="technologies.html">Мои подружечки</a>
                </div>
            </section>
            </div>
        </main>
        
        <footer class="footer">
            <div class="container">
                <div class="ksu">
                    &copy; Ksu
                </div>
                <img class= "f_img" src= "images/14.jpg" alt="Person"> 
                <?php
                    date_default_timezone_set("Europe/Moscow");
                    echo "<p>&nbsp; Сформировано: ".date("d.m.Y в H-i.s")."</p>";
                ?>
            </div>
        </footer>

    </body>
</html>