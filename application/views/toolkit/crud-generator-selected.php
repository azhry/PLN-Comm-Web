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
							</div>
							
						</div>
						<div class="row" style="height: 350px; overflow-y: scroll;">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Table Name</th>
										<th>Option</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 0; foreach ($all_tables as $table): ?>
										<tr>
											<td><?= ++$i ?></td>
											<td>
												<div class="checkbox">
													<label>
														<input type="checkbox" class="db_table" id="<?= $table->TABLE_NAME ?>" name="optionsCheckboxes">
														<?= $table->TABLE_NAME ?>
													</label>
												</div>
											</td>
											<td>
												<style type="text/css">
													#opt div.checkbox {display: inline; margin-right: 24px;}
												</style>
												<div id="opt">
													<div class="checkbox">
														<label>
															<input type="checkbox" id="<?= $table->TABLE_NAME ?>_selectable" name="optionsCheckboxes">
															S
														</label>
													</div>
													<div class="checkbox">
														<label>
															<input type="checkbox" id="<?= $table->TABLE_NAME ?>_insertable" name="optionsCheckboxes">
															I
														</label>
													</div>
													<div class="checkbox">
														<label>
															<input type="checkbox" id="<?= $table->TABLE_NAME ?>_editable" name="optionsCheckboxes">
															E
														</label>
													</div>
													<div class="checkbox">
														<label>
															<input type="checkbox" id="<?= $table->TABLE_NAME ?>_deletable" name="optionsCheckboxes">
															D
														</label>
													</div>

													<div class="checkbox">
														<label>
															<input type="checkbox" id="<?= $table->TABLE_NAME ?>_primary_key" name="optionsCheckboxes">
															PK
														</label>
													</div>

													<div class="checkbox">
														<label>
															<input type="checkbox" id="<?= $table->TABLE_NAME ?>_json_api" name="optionsCheckboxes">
															JSON
														</label>
													</div>
												</div>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
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
</script>