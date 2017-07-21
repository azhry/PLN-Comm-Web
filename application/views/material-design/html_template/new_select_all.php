<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <?= $table_name ?> 
                        </h2>
                    </div>
                    <?php if ($insertable): ?>
                    <button type="button" class="btn btn-default waves-effect" data-toggle="modal" data-target="#add"><i class="material-icons">add</i> Tambah</button>
                    <?php endif; ?>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
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

                    <?php if ($selectable): ?>
                    <a href="<?php echo '<?= base_url(\''.strtolower($controller_name).'/detail_'.$model.'/\'.$row[\'' ?><?= $primary_key_column ?><?= '\']) ?>' ?>" class="btn btn-info waves-effect">Details</a>
                    <?php endif; ?>

                    <?php if ($editable): ?>
                    <button class="btn btn-info waves-effect" data-toggle="modal" data-target="#edit" onclick="get_<?= strtolower($table_name) ?>(<?= '<?= $row[\'' ?><?= $primary_key_column ?><?= '\'] ?>' ?>)"><i class="material-icons">edit</i></button>
                    <?php endif; ?>

                    <?php if ($deletable): ?>
                    <button class="btn btn-danger waves-effect" onclick="delete_<?= strtolower($table_name) ?>(<?= '<?= $row[\'' ?><?= $primary_key_column ?><?= '\'] ?>' ?>)"><i class="material-icons">delete</i></button>
                    <?php endif; ?>

                                    </td>
                                </tr>
                                <?php echo '<?php endforeach; ?>' . "\n"; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <?php if ($insertable): ?>

        <!-- Add -->
        <div class="modal fade" tabindex="-1" role="dialog" id="add">
          <div class="modal-dialog" role="document">
            <?= form_open(strtolower($controller_name)) ?>
           <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data <?= $controller_name ?></h4>
              </div>
              <div class="modal-body">
                    <?php echo '<?php foreach ($columns as $column): ?>' . "\n"; ?>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="<?= '<?= $column ?>' ?>" name="<?= '<?= $column ?>' ?>" class="form-control">
                                <label class="form-label"><?= '<?= ucwords(str_replace(\'_\', \' \', $column)) ?>' ?></label>
                            </div>
                        </div>
                    <?php echo '<?php endforeach; ?>' . "\n"; ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default m-t-15 waves-effect" data-dismiss="modal">Batal</button>
                <input type="submit" name="insert" value="Simpan" class="btn btn-primary m-t-15 waves-effect">
              </div>
              <?= form_close() ?>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!--/End Add -->

        <?php endif; ?>

        <?php if ($editable): ?>
        <!-- Edit -->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
            <?= form_open(strtolower($controller_name)) ?>
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Data <?= $controller_name ?></h4>
              </div>
              <div class="modal-body">
                    <input type="hidden" name="edit_<?= $primary_key_column ?>" id="edit_<?= $primary_key_column ?>">
                    <?php echo '<?php foreach ($columns as $column): ?>' . "\n"; ?>
                        <div class="form-group form-float">
                            <div class="form-line focused">
                                <input type="text" id="<?= 'edit_<?= $column ?>' ?>" name="<?= '<?= $column ?>' ?>" class="form-control">
                                <label class="form-label"><?= '<?= ucwords(str_replace(\'_\', \' \', $column)) ?>' ?></label>
                            </div>
                        </div>
                    <?php echo '<?php endforeach; ?>' . "\n"; ?>
                    
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <input type="submit" name="edit" value="Edit" class="btn btn-primary">
              </div>
              <?= form_close() ?>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->  
        <!--/End Edit -->
        <?php endif; ?>

    </div>
</section>

<script type="text/javascript">

        <?php if ($selectable): ?>

        function get_<?= strtolower($table_name) ?>(<?= $primary_key_column ?>) {
            $.ajax({
                url: <?= '"<?= base_url(\''.$controller_name.'\') ?>"' ?>,
                type: 'POST',
                data: {
                    <?= $primary_key_column ?>: <?= $primary_key_column ?>,
                    get: true
                },
                success: function(response) {
                    response = JSON.parse(response);
                    <?= '<?php foreach ($columns as $column): ?>' ?>

                    $('#edit_<?= '<?= $column ?>' ?>').val(response.<?= '<?= $column ?>' ?>);
                    <?= '<?php endforeach; ?>' ?>

                    <?= '<?php if (in_array("' ?><?= $primary_key_column ?><?= '", $columns)): ?>' ?>
                    
                    $('input[class="form-control"][name="<?= $primary_key_column ?>"]').val(response.<?= $primary_key_column ?>);
                    <?= '<?php endif; ?>' ?>
                }
            });
        }
        <?php endif; ?>

        <?php if ($deletable): ?>

        function delete_<?= strtolower($table_name) ?>(<?= $primary_key_column ?>) {
            $.ajax({
                url: <?= '"<?= base_url(\''.$controller_name.'\') ?>"' ?>,
                type: 'POST',
                data: {
                    <?= $primary_key_column ?>: <?= $primary_key_column ?>,
                    delete: true
                },
                success: function() {
                    window.location = <?= '"<?= base_url(\''.$controller_name.'\') ?>"' ?>;
                }
            });   
        }
        <?php endif; ?>
    </script>