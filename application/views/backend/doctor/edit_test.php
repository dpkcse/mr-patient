<?php
$test_category_info = $this->db->get('test_category')->result_array();
$single_test_info   = $this->db->get_where('test', array('id' => $param2))->result_array();
foreach ($single_test_info as $row) {
?>

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h3><?php echo get_phrase('edit_medicine'); ?></h3>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?doctor/test/update/<?php echo $row['id']; ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" name="name" class="form-control" id="field-1" value="<?php echo $row['name']; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('test_category'); ?></label>

                            <div class="col-sm-5">
                                <select name="medicine_category_id" class="form-control">
                                    <option value=""><?php echo get_phrase('select_test_category'); ?></option>
                                    <?php foreach ($test_category_info as $row2) { ?>
                                        <option value="<?php echo $row2['test_id']; ?>" <?php if ($row['test_cat'] == $row2['test_id']) echo 'selected'; ?>>
                                            <?php echo $row2['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3 control-label col-sm-offset-2">
                            <input type="submit" class="btn btn-success" value="Update">
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
<?php } ?>