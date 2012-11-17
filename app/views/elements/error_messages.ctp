<div align="center" class="errormessage">
    <?php if ($session->check('Message.flash')) $session->flash();?>
</div>
<div align="center" class="errormessage">
    <?php if ($session->check('Message.auth')) $session->flash('auth');?>
</div>
