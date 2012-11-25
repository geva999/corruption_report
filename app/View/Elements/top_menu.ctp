<div id="top">
  <a href="<?php echo($isadmin == 1 ? '/admin' : '/');?>">
    <div id="logo">"САРАПТАМА" - <?php echo $top_menu_title;?></div>
  </a>
</div>
<div id="Session">
    <?php
        if ($isadmin == 1) echo 'Администратор: ';
        else echo 'Эксперт: ';
        echo $logineduserfullname;
    ?>
    (<a href="/experts/logout">выйти</a>)
</div>
