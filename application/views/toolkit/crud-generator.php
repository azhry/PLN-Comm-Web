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
					<h3>CRUD GENERATOR</h3>
					<form action="" method="POST" accept-charset="utf-8">
						<div class="row">
							<div class="col-md-9">
								<div class="form-group label-floating">
									<label class="control-label">Controller</label>
									<input id="controller" type="text" class="form-control" onkeyup="check_controller(this.value);">
								</div>
								<p id="controller-status"></p>
								<ul id="function-list"></ul>
								<div class="form-group label-floating">
									<label class="control-label">Table Name</label>
									<input id="table" type="text" class="form-control" onkeyup="check_table(this.value);">
								</div>
								<p id="table-status"></p>
							</div>
							<div class="col-md-3">
								<div class="checkbox">
									<label>
										<input type="checkbox" id="selectable" name="optionsCheckboxes">
										Selectable
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" id="insertable" name="optionsCheckboxes">
										Insertable
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" id="editable" name="optionsCheckboxes">
										Editable
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" id="deletable" name="optionsCheckboxes">
										Deletable
									</label>
								</div>

								<div class="checkbox">
									<label>
										<input type="checkbox" id="primary_key" name="optionsCheckboxes">
										Show Primary Key
									</label>
								</div>

								<div class="checkbox">
									<label>
										<input type="checkbox" id="json_api" name="optionsCheckboxes">
										JSON API
									</label>
								</div>
							</div>
						</div>
						<button class="btn btn-success" id="generate">Generate</button>
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

		var components = {
			'controller': $('#controller').val(),
			'table': $('#table').val()
		};

		var options = {
			selectable: $('#selectable').is(':checked'),
			insertable: $('#insertable').is(':checked'),
			editable: $('#editable').is(':checked'),
			deletable: $('#deletable').is(':checked'),
			primary_key: $('#primary_key').is(':checked'),
			json_api: $('#json_api').is(':checked')
		};

		var data = {
			'generate'	: true,
			'controller': $('#controller').val(),
			'table'		: $('#table').val(),
		};

		var opt_key = Object.keys(options);
		var opt_val = Object.values(options);
		for (var i = 0; i < opt_key.length; i++)
			data[opt_key[i]] = opt_val[i];

		$.ajax({
			url 	: '<?= base_url("toolkit/crud-generator") ?>',
			type	: 'POST',
			data 	: data,
			success : function(response) {
				$('#process').append(response);
				$('#process').append('<p style="color: green; font-weight: bold;">OK.</p>');
			},
			error: function(err) {
				console.log(err.responseText);
			}
		});

		
		return false;
	}

	function check_controller(controller_name) {
		var controller = controller_name || "";
		$.ajax({
			url: '<?= base_url('toolkit/check-controller') ?>',
			type: 'POST',
			data: {
				controller_name: controller
			},
			success: function(response) {
				var json = JSON.parse(response);
				if (json.status == '0') {
					$('#controller-status')
						.html('<i class="fa fa-check"></i> ' + controller_name + ' controller not found. Create new ' + controller_name + '.php')
						.css('color', 'red');
					$('#function-list').html('');
				} else {
					$('#controller-status')
						.html('<i class="fa fa-check"></i> ' + controller_name + ' controller found. Method list:')
						.css('color', 'green');
					var method_list = '';
					for (var i = 0; i < json.method_list.length; i++)
						method_list += '<li>' + json.method_list[i] + '</li>';
					$('#function-list')
						.html(method_list)
						.css('color', 'green');
				}
			},
			error: function(err) {
				console.log(err.responseText);
			}
		});
	}

	function check_table(table_name) {
		$.ajax({
			url: '<?= base_url('toolkit/check-table') ?>',
			type: 'POST',
			data: {
				table_name: table_name
			},
			success: function(response) {
				var json = JSON.parse(response);
				if (json.status == '0') {
					$('#table-status')
						.html('<i class="fa fa-check"></i> ' + table_name + ' table not found on database ' + json.active_db)
						.css('color', 'red');
				} else {
					$('#table-status')
						.html('<i class="fa fa-check"></i> ' + table_name + ' table found on database ' + json.active_db)
						.css('color', 'green');
				}
			},
			error: function(err) {
				console.log(err.responseText);
			}
		});
	}
</script>