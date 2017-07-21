<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Buku 
                        </h2>
                    </div>
                                        <button type="button" class="btn btn-default waves-effect" data-toggle="modal" data-target="#add"><i class="material-icons">add</i> Tambah</button>
                                        <div class="body">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <?php foreach ($columns as $column): ?>
                                        <th>
                                            <?= ucwords(str_replace("_", " ", $column)) ?>
                                        </th>
                                    <?php endforeach; ?>
                                    <th>Action</th>
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
                                    <td align="center">

                                        <a href="<?= base_url('buku/detail_buku/'.$row['id_buku']) ?>" class="btn btn-info waves-effect">Details</a>
                    
                                        <button class="btn btn-info waves-effect" data-toggle="modal" data-target="#edit" onclick="get_buku(<?= $row['id_buku'] ?>)"><i class="material-icons">edit</i></button>
                    
                                        <button class="btn btn-danger waves-effect" onclick="delete_buku(<?= $row['id_buku'] ?>)"><i class="material-icons">delete</i></button>
                    
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        
        <!-- Add -->
        <div class="modal fade" tabindex="-1" role="dialog" id="add">
          <div class="modal-dialog" role="document">
            <form action="http://localhost/crud-generator/buku" method="post" accept-charset="utf-8">
           <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Buku</h4>
              </div>
              <div class="modal-body">
                    <?php foreach ($columns as $column): ?>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="<?= $column ?>" name="<?= $column ?>" class="form-control">
                                <label class="form-label"><?= ucwords(str_replace('_', ' ', $column)) ?></label>
                            </div>
                        </div>
                    <?php endforeach; ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default m-t-15 waves-effect" data-dismiss="modal">Batal</button>
                <input type="submit" name="insert" value="Simpan" class="btn btn-primary m-t-15 waves-effect">
              </div>
              </form>            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!--/End Add -->

        
                <!-- Edit -->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form action="http://localhost/crud-generator/buku" method="post" accept-charset="utf-8">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Data Buku</h4>
              </div>
              <div class="modal-body">
                    <input type="hidden" name="edit_id_buku" id="edit_id_buku">
                    <?php foreach ($columns as $column): ?>
                        <div class="form-group form-float">
                            <div class="form-line focused">
                                <input type="text" id="edit_<?= $column ?>" name="<?= $column ?>" class="form-control">
                                <label class="form-label"><?= ucwords(str_replace('_', ' ', $column)) ?></label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <input type="submit" name="edit" value="Edit" class="btn btn-primary">
              </div>
              </form>            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->  
        <!--/End Edit -->
        
    </div>
</section>

<script type="text/javascript">

        
        function get_buku(id_buku) {
            $.ajax({
                url: "<?= base_url('Buku') ?>",
                type: 'POST',
                data: {
                    id_buku: id_buku,
                    get: true
                },
                success: function(response) {
                    response = JSON.parse(response);
                    <?php foreach ($columns as $column): ?>
                    $('#edit_<?= $column ?>').val(response.<?= $column ?>);
                    <?php endforeach; ?>
                    <?php if (in_array("id_buku", $columns)): ?>                    
                    $('input[class="form-control"][name="id_buku"]').val(response.id_buku);
                    <?php endif; ?>                }
            });
        }
        
        
        function delete_buku(id_buku) {
            $.ajax({
                url: "<?= base_url('Buku') ?>",
                type: 'POST',
                data: {
                    id_buku: id_buku,
                    delete: true
                },
                success: function() {
                    window.location = "<?= base_url('Buku') ?>";
                }
            });   
        }
            </script>