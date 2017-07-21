<section class="content">
    <div class="container-fluid">
<!-- Bordered Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Detail <?= $table_name ?>
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <?php echo '<?php foreach ($columns as $column): ?>' . "\n"; ?>
                                    <tr>
                                        <td><?php echo '<?= ucwords(str_replace("_", " ", $column)); ?>'; ?></td>
                                        <td>
                                            <?php echo '<?php $data = (array)$data; ?>' . "\n"; ?>
                                            <?php echo '<?= $data[$column] ?>' . "\n"; ?>
                                        </td>
                                    </tr>
                                <?php echo '<?php endforeach; ?>' . "\n"; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Bordered Table -->
    </div>
</section>