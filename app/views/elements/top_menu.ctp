<div id="top">
    <div id="logo">"САРАПТАМА" - <?php echo $top_menu_title;?></div>
</div>
<div id="Session">
    <?php
        if ($isadmin == 1) echo 'Администратор: ';
        else echo 'Эксперт: ';
        echo $logineduserfullname;
    ?>
    (<a href="/experts/logout">выйти</a>)
</div>
