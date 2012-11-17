<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php echo $this->Html->charset(); ?>

    <title>Система он-лайн заключений "САРАПТАМА"</title>

    <?php
      echo $this->Html->meta('icon');

      echo $this->Html->css('thickbox');
      echo $this->Html->css('ui.all');
      echo $this->Html->css('jquery.jgrowl');
      echo $this->Html->css('reportedit');

      echo $this->Html->script('plugins/jquery.min');
      echo $this->Html->script('plugins/jquery-ui.min');
      echo $this->Html->script('plugins/localization/ui.datepicker-ru');
      echo $this->Html->script('datepicker');
      echo $this->Html->script('plugins/jquery.form');
      echo $this->Html->script('plugins/jquery.metadata');
      echo $this->Html->script('plugins/jquery.validate.pack');
      echo $this->Html->script('plugins/localization/jquery.validate.messages_ru');
      echo $this->Html->script('plugins/jquery.blockUI');
      echo $this->Html->script('plugins/jquery.jgrowl.pack');
      echo $this->Html->script('plugins/jquery.corner');
      echo $this->Html->script('plugins/jquery.timers');
      echo $this->Html->script('plugins/thickbox');
      echo $this->Html->script('tiny_mce/tiny_mce');

      echo $scripts_for_layout;
    ?>
  </head>

  <body>
    <div id="container">
      <div id="content">
        <?php echo $content_for_layout;?>
      </div>

      <div align="center" class="errormessage">
        <?php //if ($session->check('Message.flash')) echo $this->Session->flash();?>
        <?php echo $this->Session->flash();?>
      </div>
      <div align="center" class="errormessage">
        <?php //if ($session->check('Message.auth')) echo $this->Session->flash('auth');?>
        <?php echo $this->Session->flash('auth');?>
      </div>
    </div>

    <?php echo $this->element('sql_dump'); ?>
  </body>
</html>
