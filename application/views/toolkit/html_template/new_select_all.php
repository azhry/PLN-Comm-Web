<div class="wrapper">
	<!-- you can use the class main-raised if you want the main area to be as a page with shadows -->
	<div class="main">
		<div class="container">
			<h4><?= $table_name ?></h4>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-responsive" id="tabelku">
						<thead>
							<tr>
								<?php echo '<?php foreach ($columns as $column): ?>' . "\n"; ?>
									<td>
										<?php echo '<?= $column ?>' . "\n"; ?>
									</td>
								<?php echo '<?php endforeach; ?>' . "\n"; ?>
							</tr>
						</thead>
						<tbody>
							<?php echo '<?php foreach ($data as $row): ?>' . "\n"; ?>
							<tr>
								<?php echo '<?php foreach ($columns as $column): ?>' . "\n"; ?>
									<td>
										<?php echo '<?php $row = (array)$row; ?>' . "\n"; ?>
										<?php echo '<?= $row[$column] ?>' . "\n"; ?>
									</td>
								<?php echo '<?php endforeach; ?>' . "\n"; ?>
							</tr>
							<?php echo '<?php endforeach; ?>' . "\n"; ?>
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