<div class="wrapper">
	<!-- you can use the class main-raised if you want the main area to be as a page with shadows -->
	<div class="main">
		<div class="container">
			<h4>Admin</h4>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-responsive" id="tabelku">
						<thead>
							<tr>
								<?php foreach ($columns as $column): ?>
									<td>
										<?= $column ?>
									</td>
								<?php endforeach; ?>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data as $row): ?>
							<tr>
								<?php foreach ($columns as $column): ?>
									<td>
										<?php $row = (array)$row; ?>
										<?= $row[$column] ?>
									</td>
								<?php endforeach; ?>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
	    $('#tabelku').DataTable();
	} );
</script>