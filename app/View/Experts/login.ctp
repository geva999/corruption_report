<div class="SiteContainer SignIn">
  <div class="title">
    <h1>
      Система он-лайн заключений
      <br/>
      "САРАПТАМА"
    </h1>
  </div>

    <div id="Form" class="SignInForm">
        <fieldset>
            <?php echo $this->Form->create('Expert', array('action' => 'login')); ?>
            <ul>
                <li>
                    <?php echo $this->Form->input('username', array('label'=>'Пользователь', 'size'=>'20', 'class'=>'Input'));?>
                </li>
                <li>
                    <?php echo $this->Form->input('password', array('label'=>'Пароль', 'size'=>'20', 'class'=>'Input'));?>
                </li>
            </ul>
            <div class="Submit"><?php echo $this->Form->end('Войти', array('class'=>'button'));?></div>
            </form>
        </fieldset>
    </div>
</div>

<?php echo $this->element('error_messages');?>
<br/><br/><br/>
<?php echo $this->element('sponsor');?>