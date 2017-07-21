<div class="wrapper">
	<!-- you can use the class main-raised if you want the main area to be as a page with shadows -->
	<div class="main">
		<div class="container">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
				  		<div class="col-sm-10">
				  			<h4><?= $table_name ?></h4>
				  		</div>
				  		<div class="col-md-2 pull-right">
				  			<button class="btn btn-info" data-toggle="modal" data-target="#TambahData"><i class="fa fa-plus"></i> Tambah Data</button>
				  		</div>
				  	</div>
				</div>
				<div class="panel-body">
					<table class="table table-responsive" id="tabelku">
						<thead>
							<tr>
								<?php echo '<?php foreach ($columns as $column): ?>' . "\n"; ?>
									<th>
										<?php echo '<?= ucwords(str_replace("_", " ", $column)) ?>' . "\n"; ?>
									</th>
								<?php echo '<?php endforeach; ?>' . "\n"; ?>
								<th>Action</th>
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
								<td align="center">
									<div class="btn-group">
										
										<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#EditData"><i class="fa fa-edit"></i></button>
										<button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
									</div>
								</td>
							</tr>
							<?php echo '<?php endforeach; ?>' . "\n"; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="TambahData" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
		<form action="submit" method="get" accept-charset="utf-8">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Tambah Data</h4>
	      </div>
	      <div class="modal-body">
	        <div class="form-group label-floating">
				<label class="control-label">Nama</label>
				<input type="text" class="form-control">
			</div>
			<div class="form-group label-static">
				<label class="control-label">Datepicker</label>
				<input type="text" class="datepicker form-control" value="03/12/2016" />
			</div>
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-success" data-dismiss="modal">Tambah Data</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
		</form>
    </div>

  </div>
</div>

<div id="EditData" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
		<form action="submit" method="get" accept-charset="utf-8">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Edit Data</h4>
	      </div>
	      <div class="modal-body">
	        <div class="form-group label-floating">
				<label class="control-label">Nama</label>
				<input type="text" class="form-control">
			</div>
			<div class="form-group label-static">
				<label class="control-label">Datepicker</label>
				<input type="text" class="datepicker form-control" value="03/12/2016" />
			</div>
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-success" data-dismiss="modal">Edit Data</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
		</form>
    </div>

  </div>
</div>

<script>
	$(document).ready(function() {
	    $('#tabelku').DataTable();
	} );

	$('.datepicker .dropdown-menu.open').css('z-index', '1200');
</script>