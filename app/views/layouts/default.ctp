<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Система он-лайн заключений "САРАПТАМА"</title>
		<?php
			echo $html->css('ui.all');
			echo $html->css('jquery.jgrowl');
			echo $html->css('default');

			echo $javascript->link('plugins/prototype');
			echo $javascript->link('plugins/jquery.min');
		?>
		<script type="text/javascript">
			jQuery.noConflict();
		</script>
		<?php
			echo $javascript->link('plugins/jquery-ui.min');
			echo $javascript->link('plugins/localization/ui.datepicker-ru');
			echo $javascript->link('datepicker');
			echo $javascript->link('plugins/jquery.jgrowl.pack');
			echo $javascript->link('plugins/jquery.alphanumeric.pack');
			echo $javascript->link('tiny_mce/tiny_mce');

			echo $scripts_for_layout;
		?>
	</head>
	<body>
		<div id="container">
			<div id="content">
				<?php echo $content_for_layout;?>
			</div>
		</div>
	</body>
</html>
