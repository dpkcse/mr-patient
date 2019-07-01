<?php 
$category_info = $this->db->order_by('name', 'ASC')->get('medicine_category')->result_array();
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_medicine_generic_name'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?doctor/medicine_generic_name/create" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('category_name'); ?></label>

                        <div class="col-sm-5">
                            <select name="category_id" class="select2" id="category_id">
                                <option value=""><?php echo get_phrase('select_category'); ?></option>
                                <?php foreach ($category_info as $row) { ?>
                                        <option value="<?php echo $row['medicine_category_id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('generic_name'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="generic_name" class="form-control" id="field-1" >
                        </div>
                    </div>

                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>