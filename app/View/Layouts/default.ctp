<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php echo $this->Html->charset(); ?>

    <title>
      Система он-лайн заключений "САРАПТАМА"
      <?php //echo $title_for_layout; ?>
    </title>

    <?php
      echo $this->Html->meta('icon');

      echo $this->Html->css('ui.all');
      echo $this->Html->css('jquery.jgrowl');
      echo $this->Html->css('default');

      echo $this->Html->script('plugins/jquery.min');
      echo $this->Html->script('plugins/jquery.min');
      echo $this->Html->script('plugins/jquery-ui.min');
      echo $this->Html->script('plugins/localization/ui.datepicker-ru');
      echo $this->Html->script('datepicker');
      echo $this->Html->script('plugins/jquery.jgrowl.pack');
      echo $this->Html->script('plugins/jquery.alphanumeric.pack');
      echo $this->Html->script('tiny_mce/tiny_mce');

      echo $this->fetch('meta');
      echo $this->fetch('css');
      echo $this->fetch('script');
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
