<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/style.css">
        <title>lutsan_lab4</title>
    </head>
    <body>
        <header>
            <img src ="images/Mospolytech_logo.jpg" alt="polytech">
            <div class="container">
                <nav class="flex">
                    <a href = "?">ГЛАВНАЯ</a>
                    <div class="right">
                        <?php
                            if(!isset($_GET['content'])){
                                echo '<a href = "?type=Table">ТАБЛИЧНАЯ ВЁРСТКА</a>';
                                echo '<a href = "?type=Div">БЛОЧНАЯ ВЁРСТКА</a>';
                            }else{
                                echo '<a href = "?type=Table&content='.$_GET['content'].'">ТАБЛИЧНАЯ ВЁРСТКА</a>';
                                echo '<a href = "?type=Div&content='.$_GET['content'].'">БЛОЧНАЯ ВЁРСТКА</a>';
                            }
                        ?>
                    </div>
                </nav> 
            </div>
        </header>
        <main>
            <div class="container flex">
                <aside class="sidebar">
                    <?php
                        echo '<a href="?">ВСЯ ТАБЛИЦА УМНОЖЕНИЯ</a>';
                        for ($i=2;$i<10;$i++){
                            echo '<a href="?content='.$i;
                            if(isset($_GET['type']))
                                echo '&type='.$_GET['type'].'">УМНОЖЕНИЕ НА '.$i.'</a>';
                            else echo '">УМНОЖЕНИЕ НА '.$i.'</a>';
                        }
                    
                    ?>
                </aside>
                <div class="flex">
                    <div class="<?php
                        if(!isset($_GET['type']) || $_GET['type'] == 'Table') 
                            echo 'table-view';
                        elseif ($_GET['type'] == 'Div') echo 'block-view';
                    ?>">
                    <?php 
                        if (isset($_GET['content'])){
                            if (!isset($_GET['type']) || $_GET['type'] == 'Table')
                                doTable($_GET['content']);
                            elseif (isset($_GET['type']) && $_GET['type'] == 'Div') 
                                doDiv($_GET['content']);
                        }else {
                            if(isset($_GET['type']) && $_GET['type']=='Div'){
                                for ($i=2; $i<10; $i++){
                                    doDiv($i);
                                }
                            }else for($i=2; $i<10; $i++){
                                doTable($i);
                            }
                        }
                    ?>
                    </div>
                      
            </div>
            <?php
                function doTable($number){
                    echo '<table>';
                    for ($i=2; $i<10;$i++){
                        $result=$i*$number;
                    echo '<tr>
                            <td><a href="?content='.$i.'">'.$i.'</a>* 
                            <a href="?content='.$number.'">'.$number.'</a></td>';
                            if($result < 10)
                                echo '<td><a href="?content='.$result.'">'.$result.'</a></td>';
                            else echo '<td>'.$result.'</td>';
                            
                        echo'</tr>';
                    
                    }
                    echo '</table>';
                }
                function doDiv($number){
                    echo '<div class="table">';
                    for($i=2; $i<10; $i++){
                        echo '<p>'.$i.'*'.$number.'='.$i*$number.'</p>';
                    }
                    echo '</div>';
                }
            ?>
        </main>
        <footer>
            <?php
                if (!isset($_GET['type']))
                    echo '<p> Верстка не выбрана. ';
                elseif ($_GET['type'] == 'Table')
                    echo '<p> Табличная верстка. ';
                else
                    echo '<p> Блочная верстка. ';

                if (!isset($_GET['content']))
                    echo 'Все таблицы умножения. ';
                else
                    echo 'Таблица умножения на '.$_GET['content'].'. ';

                date_default_timezone_set("Europe/Moscow");
                echo 'Дата: '.date("d.m.Y").'г. Время: '.date("H:i").'</p>';
            ?>
        </footer>
    </body>
    </html>