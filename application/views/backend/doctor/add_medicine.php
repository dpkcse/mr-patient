<?php $medicine_category_info = $this->db->order_by('name', 'ASC')->get('medicine_category')->result_array(); ?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_medicine'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?doctor/medicine/create" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('trade_name'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="name" class="form-control" id="field-1" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('medicine_category'); ?></label>

                        <div class="col-sm-5">
                            <select name="medicine_category_id" class="form-control select2" onchange="getSpecificCat(this.value)">
                                <?php foreach ($medicine_category_info as $row) { ?>
                                    <option value="<?php echo $row['medicine_category_id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('medicine_generic_name'); ?></label>

                        <div class="col-sm-5">
                            <select name="medicine_generic_id" id="medicine_generic_id" class="form-control select2">
                                <?php $medicine_generic_info = $this->db->get_where('medicine_generic',array('category_id'=>$medicine_category_info[0]['medicine_category_id']))->result_array(); ?>
                                <?php foreach ($medicine_generic_info as $rowGen) { ?>
                                    <option value="<?php echo $rowGen['generic_id']; ?>"><?php echo $rowGen['generic_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('Formation'); ?></label>

                        <div class="col-sm-5">
                            <select name="Formation" id="Formation" class="form-control select2">
                                <option value="Cap.">Cap.</option>
                                <option value="Tab.">Tab.</option>
                                <option value="Syp.">Syp.</option>
                                <option value="Inj.">Inj.</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('company_name'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="manufacturing_company" class="form-control" id="field-1" >
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
<script type="text/javascript">
    function getSpecificCat(val){
        $.ajax({
                url: '<?php echo site_url();?>doctor/getSpecificCat',
                type: 'POST',
                data: {val:val},
                dataType: 'JSON',
                beforeSend: function (jqXHR, textStatus, errorThrown) {
                   $("#medicine_generic_id").html("");
                },
                success: function (data_st, textStatus) {
                   if(data_st.medicine_generic.length > 0){
                        $.each(data_st.medicine_generic, function(k,v){
                            $("#medicine_generic_id").append('<option value="'+v.generic_id+'">'+v.generic_name+'</option>');
                            $('#medicine_generic_id').trigger('change');
                        });
                   }else{
                        alert("No Generic Found !!!");
                   }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Some code to debbug e.g.:               
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
                
            }); 
    }
</script>