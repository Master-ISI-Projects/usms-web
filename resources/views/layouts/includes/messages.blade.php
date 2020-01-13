<script type="text/javascript">
	$(document).ready(function(){
		@if(Session::has('success'))
			messageBox("", "L'enregistrement a été effectué avec succès", "success");
		@endif
		@if(Session::has('error'))
			messageBox("", "{{ Session::get('error') }}", "error");
		@endif
		function messageBox(title, content, type) {
			setTimeout(function () {
				swal(
					title,
					content,
					type
				);
			}, 1000);
		}
	});
</script>