<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Система он-лайн заключений</title>
		<?php
			echo $html->css('thickbox');
			echo $html->css('ui.all');
			echo $html->css('jquery.jgrowl');
			echo $html->css('reportedit');

			echo $javascript->link('plugins/jquery.min');
			echo $javascript->link('plugins/jquery-ui.min');
			echo $javascript->link('plugins/localization/ui.datepicker-ru');
			echo $javascript->link('datepicker');
			echo $javascript->link('plugins/jquery.form');
			echo $javascript->link('plugins/jquery.metadata');
			echo $javascript->link('plugins/jquery.validate.pack');
			echo $javascript->link('plugins/localization/jquery.validate.messages_ru');
			echo $javascript->link('plugins/jquery.blockUI');
			echo $javascript->link('plugins/jquery.jgrowl.pack');
			echo $javascript->link('plugins/jquery.corner');
			echo $javascript->link('plugins/jquery.timers');
			echo $javascript->link('plugins/thickbox');
			echo $javascript->link('tiny_mce/tiny_mce');

			echo $scripts_for_layout;
		?>
	</head>
	<body>
		<div id="container">
			<div id="content"><?php echo $content_for_layout;?></div>
			<div align="center" class="errormessage"><?php if ($session->check('Message.flash')) $session->flash();?></div>
			<div align="center" class="errormessage"><?php if ($session->check('Message.auth')) $session->flash('auth');?></div>
		</div>
	</body>
</html>