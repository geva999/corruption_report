<div class="SiteContainer SignIn">
	<h1>Система он-лайн заключений</h1>
	<div id="Form" class="SignInForm">
		<fieldset>
			<?php echo $form->create('Expert', array('action' => 'login')); ?>
			<ul>
				<li>
					<?php echo $form->input('username', array('label'=>'Пользователь', 'size'=>'20', 'class'=>'Input'));?>
				</li>
				<li>
					<?php echo $form->input('password', array('label'=>'Пароль', 'size'=>'20', 'class'=>'Input'));?>
				</li>
			</ul>
			<div class="Submit"><?php echo $form->end('Войти', array('class'=>'button'));?></div>
			</form>
		</fieldset>
	</div>
</div>

<?php echo $this->element('error_messages');?>
<br/><br/><br/>
<?php echo $this->element('sponsor');?>