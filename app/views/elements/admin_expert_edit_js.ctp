<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#PasswordChange').click(function () {
				if ($('#PasswordChange:checked').length == 1) $('#ExpertPassword').removeAttr('disabled');
				else $('#ExpertPassword').attr('disabled', 'disabled');
			}
		);
	});
</script>