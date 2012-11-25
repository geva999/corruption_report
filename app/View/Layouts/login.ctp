<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php echo $this->Html->charset(); ?>

    <title>Система он-лайн заключений - Аутентификация</title>

    <?php
      echo $this->Html->meta('icon');

      echo $this->Html->css('login');
    ?>
  </head>

  <body>
    <div id="container">
      <div id="content">
        <?php echo $this->fetch('content');?>
      </div>
    </div>

    <?php echo $this->element('sql_dump'); ?>
  </body>
</html>
