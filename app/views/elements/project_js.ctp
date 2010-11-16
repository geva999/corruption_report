<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#ProjectProjecttype').change(function () {
			tempval = $(this).val();
			if (tempval == 'proiect de lege') {
				$('#ProjectNamesolicitare').val('');
				$('.option2').hide();
				$('.option1').show();
			}
			else if (tempval == 'solicitare expresă') {
				$('#ProjectInitiative, #ProjectProjectnumber').val('');
				$('.option1').hide();
				$('.option2, .option3').show();
			}
		});

		$('#ProjectInitiative').change(function () {
			if ($(this).val() != 'Guvernul RM') $('.option3').hide();
			else $('.option3').show();
		});

		$('#ProjectProjectdomain').change(function () {
			tempval = $(this).val();
			if (tempval == 'II. economie şi comerţ') {
				$('#ProjectReportimpact').val(['1']);
			}
			else {
				$('#ProjectReportimpact').val(['0']);
			}
		});

		$('#ProjectReportnumber, #ProjectNumberpages, #ProjectNumberprojectsstandard').numeric();

		$('#ProjectProjectdatetext').datepicker({
			altField: '#ProjectProjectdate',
			altFormat: 'yy-mm-dd'
		});

		jQuery('#ProjectDatelimitexperttext').datepicker({
			altField: '#ProjectDatelimitexpert',
			altFormat: 'yy-mm-dd'
		});

		jQuery('#ProjectDatelimitparlamenttext').datepicker({
			altField: '#ProjectDatelimitparlament',
			altFormat: 'yy-mm-dd'
		});

		$("#sortabledestination, #sortablesource").sortable({
			revert: true,
			items: 'div',
			connectWith: '.connectedsortable',
			placeholder: 'connectedsortablehighlight'
		}).disableSelection();

	});
</script>