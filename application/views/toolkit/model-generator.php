<div class="wrapper">
	<!-- you can use the class main-raised if you want the main area to be as a page with shadows -->
	<div class="main">
		<div class="container">

			<div class="row">
				<div class="col-md-3">
					<div class="list-group">
						<button class="btn btn-info list-group-item">CRUD GENERATOR</button>
						<button class="btn btn-default list-group-item">REGISTER GENERATOR</button>
						<button class="btn btn-default list-group-item">LOGIN GENERATOR</button>
						<button class="btn btn-default list-group-item">MODEL GENERATOR</button>
					</div>
				</div>
				<div class="col-md-9">
					<h3>MODEL GENERATOR</h3>
					<form action="" method="POST" accept-charset="utf-8">
						<div class="checkbox">
							<label>
								<input type="checkbox" id="project_prefix" name="optionsCheckboxes">
								Project name prefix
							</label>
						</div>
						<button class="btn btn-success" id="generate">Generate All Models</button>
					</form>

					<div id="process" class="well" style="min-height: 200px; overflow-y: scroll; font-family: 'Courier New'">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	$('#generate').on('click', generate);
	function generate() {
		$('#process').html('');

		$.ajax({
			url: '<?= base_url('toolkit/model-generator') ?>',
			type: 'POST',
			data: {
				generate: true,
				prefix: $('#project_prefix').val()
			},
			success: function(response) {
				var json = JSON.parse(response);
				$('#process').append(json.html);
				$('#process').append('<p style="color: green; font-weight: bold;">OK.</p>');
			},
			error: function(err) {
				console.log(err.responseText);
			}
		});

		return false;
	}
</script>