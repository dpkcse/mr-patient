<style type="text/css">
    .customBtn{
        width: 25%;
        margin-top: 2%;
        margin-left: 2%;
    }
    #patientInfoDiv{
        display:none;
        margin-top: 3%;
        border-bottom: 1px solid #eee;
    }

    #doctorInfoDiv{
        display:none;
        margin-top: 3%;
        border-bottom: 1px solid #eee;
    }
    .cDiv{
        margin-top: 2%;
    }

    .customSelect{
        display: block;
        width: 100%;
        height: 31px;
        padding: 6px 12px;
        font-size: 12px;
        line-height: 1.42857143;
        color: #555555;
        background-color: #ffffff;
        background-image: none;
        border: 1px solid #ebebeb;
        border-radius: 3px;
        margin-bottom: 5px;
    }
    .tbtn{
        font-size: 23px;
        margin-left: 3%;
        margin-top: 3px;
        color: red;
        cursor: pointer;
    }
</style>
<?php 
$this->db->select('formation');
$this->db->group_by('formation');// add group_by
$formation = $this->db->get('medicine')->result_array(); ?>
<?php
$menu_check                 = $param3;
$patient_info               = $this->db->get('patient')->result_array();
$single_prescription_info   = $this->db->get_where('prescription', array('prescription_id' => $param2))->result_array();
$single_medicine_info   = $this->db->get('medicine')->result_array();
$prescriptionMedList = $this->db->get_where('prescriptionmedicine', array('PrescriptionID' => $param2))->result_array();
$prescriptiontest_info   = $this->db->get_where('prescriptiontest', array('PrescriptionID' => $param2))->result_array();
$test_info   = $this->db->get('test')->result_array();
$cnt = 0;
$cntT = 0;

foreach ($single_prescription_info as $row) {
?>
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h3><?php echo get_phrase('edit_prescription'); ?></h3>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered"  method="post" 
                        action="<?php echo base_url(); ?>index.php?doctor/prescription/update/<?php echo $row['prescription_id']; ?>/<?php echo $menu_check; ?>/<?php echo $row['patient_id']; ?>"
                        enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('date'); ?></label>

                            <div class="col-sm-9">
                                <div class="date-and-time">
                                    <input type="text" name="date_timestamp" class="form-control datepicker" data-format="D, dd MM yyyy" 
                                           placeholder="date here" value="<?php echo date("d M, Y", $row['timestamp']); ?>">
                                    <input type="text" name="time_timestamp" class="form-control timepicker" data-template="dropdown" 
                                           data-show-seconds="false" data-default-time="00:05 AM" data-show-meridian="false" 
                                           data-minute-step="5"  placeholder="time here" value="<?php echo date("H", $row['timestamp']); ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('patient'); ?></label>

                            <div class="col-sm-9">
                                <select name="patient_id" class="select2">
                                    <option value=""><?php echo get_phrase('select_patient'); ?></option>
                                    <?php foreach ($patient_info as $row2) { ?>
                                            <option value="<?php echo $row2['patient_id']; ?>" <?php if ($row['patient_id'] == $row2['patient_id']) echo 'selected'; ?>>
                                                <?php echo $row2['name']; ?>
                                            </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('case_history'); ?></label>

                            <div class="col-sm-9">
                                <textarea name="case_history" class="form-control html5editor" data-stylesheet-url="assets/css/wysihtml5-color.css" 
                                          id="field-ta"><?php echo $row['case_history']; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('medication'); ?></label>
                            <div class="col-sm-9">
                                <?php 
                                foreach ($prescriptionMedList as $value) {
                                    //echo $value['Name'];
                                    $cnt++;
                                    ?>
                                    
                                        <div id="MedDiv<?php echo $cnt; ?>" style="margin-bottom: 15px;">
                                            <div class="col-sm-4" style="width:16%;margin-left: -15px;margin-right: -5px;">
                                                <select name="formation[]" class="select2 pull-left" id="formation" style="width:100%;">
                                                    <?php foreach ($formation as $row) { ?>
                                                            <option <?php if ($value['formation'] == $row['formation']) echo 'selected'; ?> value="<?php echo $row['formation']; ?>"><?php echo $row['formation']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4" style="width:20%;margin-left: -15px;margin-right: -5px;">
                                                <select name="mName[]" id="mName" class="select2">
                                                    <?php foreach ($single_medicine_info as $rowMed) { ?>
                                                        <option value="<?php echo $rowMed['name']; ?>" <?php if ($value['Name'] == $rowMed['name']) echo 'selected'; ?>>
                                                            <?php echo $rowMed['name']; ?>
                                                        </option>
                                                    <?php } ?> 
                                                </select>
                                            </div>
                                            <div class="col-sm-4" style="width:16%;margin-left: -15px;margin-right: -5px;">
                                                <select name="strength[]" id="strength" class="select2">
                                                    <option <?php if ($value['strength'] == '1mg') echo 'selected'; ?> value="1mg">1mg</option>
                                                    <option <?php if ($value['strength'] == '2mg') echo 'selected'; ?> value="2mg">2mg</option>
                                                    <option <?php if ($value['strength'] == '3mg') echo 'selected'; ?> value="3mg">3mg</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4" style="width:25%;margin-left: -15px;margin-right: -5px;">
                                                <select name="doseage[]" id="doseage" class="select2">
                                                    <option value="">ডোজ</option>
                                                    <option <?php if ($value['Doseage'] == '১+১+১') echo 'selected'; ?> value="১+১+১">১+১+১</option>
                                                    <option <?php if ($value['Doseage'] == '১+০+১') echo 'selected'; ?> value="১+০+১">১+০+১</option>
                                                    <option <?php if ($value['Doseage'] == '১+০+০') echo 'selected'; ?> value="১+০+০">১+০+০</option>
                                                    <option <?php if ($value['Doseage'] == '০+১+০') echo 'selected'; ?> value="০+১+০">০+১+০</option>
                                                    <option <?php if ($value['Doseage'] == '১+১+০') echo 'selected'; ?> value="১+১+০">১+১+০</option>
                                                    <option <?php if ($value['Doseage'] == '০+০+১') echo 'selected'; ?> value="০+০+১">০+০+১</option>
                                                    <option <?php if ($value['Doseage'] == '০+১+১') echo 'selected'; ?> value="০+১+১">০+১+১</option>
                                                    <option <?php if ($value['Doseage'] == 'দিনে ১ বার') echo 'selected'; ?> value="দিনে ১ বার">দিনে ১ বার</option>
                                                    <option <?php if ($value['Doseage'] == 'দিনে ২ বার') echo 'selected'; ?> value="দিনে ২ বার">দিনে ২ বার</option>
                                                    <option <?php if ($value['Doseage'] == 'দিনে ৩ বার') echo 'selected'; ?> value="দিনে ৩ বার">দিনে ৩ বার</option>
                                                    <option <?php if ($value['Doseage'] == 'দিনে ৪ বার') echo 'selected'; ?> value="দিনে ৪ বার">দিনে ৪ বার</option>
                                                    <option <?php if ($value['Doseage'] == '১/২ চামচ করে ১ বার') echo 'selected'; ?> value="১/২ চামচ করে ১ বার">১/২ চামচ করে ১ বার</option>
                                                    <option <?php if ($value['Doseage'] == '১/২ চামচ করে ২ বার') echo 'selected'; ?> value="১/২ চামচ করে ২ বার">১/২ চামচ করে ২ বার</option>
                                                    <option <?php if ($value['Doseage'] == '১/২ চামচ করে ৩ বার') echo 'selected'; ?> value="১/২ চামচ করে ৩ বার">১/২ চামচ করে ৩ বার</option>
                                                    <option <?php if ($value['Doseage'] == '১ চামচ করে ১ বার') echo 'selected'; ?> value="১ চামচ করে ১ বার">১ চামচ করে ১ বার</option>
                                                    <option <?php if ($value['Doseage'] == '১ চামচ করে ২ বার') echo 'selected'; ?> value="১ চামচ করে ২ বার">১ চামচ করে ২ বার</option>
                                                    <option <?php if ($value['Doseage'] == '১ চামচ করে ৩ বার') echo 'selected'; ?> value="১ চামচ করে ৩ বার">১ চামচ করে ৩ বার</option>
                                                    <option <?php if ($value['Doseage'] == '২ চামচ করে ১ বার') echo 'selected'; ?> value="২ চামচ করে ১ বার">২ চামচ করে ১ বার</option>
                                                    <option <?php if ($value['Doseage'] == '২ চামচ করে ২ বার') echo 'selected'; ?> value="২ চামচ করে ২ বার">২ চামচ করে ২ বার</option>
                                                    <option <?php if ($value['Doseage'] == '২ চামচ করে ৩ বার') echo 'selected'; ?> value="২ চামচ করে ৩ বার">২ চামচ করে ৩ বার</option>
                                                    
                                                </select>
                                            </div>
                                            
                                            <div class="col-sm-4" style="width:29%;margin-left: -15px;margin-right: -5px;">
                                                <select name="remark[]" id="remark" class="select2">
                                                    <option value="">নির্দেশিকা</option>
                                                    <option <?php if ($value['Remark'] == 'খাওয়ার আগে') echo 'selected'; ?> value="খাওয়ার আগে">খাওয়ার আগে</option>
                                                    <option <?php if ($value['Remark'] == 'খাওয়ার ১০ মিনিট আগে') echo 'selected'; ?> value="খাওয়ার ১০ মিনিট আগে">খাওয়ার ১০ মিনিট আগে</option>
                                                    <option <?php if ($value['Remark'] == 'খাওয়ার ২০ মিনিট আগে') echo 'selected'; ?> value="খাওয়ার ২০ মিনিট আগে">খাওয়ার ২০ মিনিট আগে</option>
                                                    <option <?php if ($value['Remark'] == 'খাওয়ার ৩০ মিনিট আগে') echo 'selected'; ?> value="খাওয়ার ৩০ মিনিট আগে">খাওয়ার ৩০ মিনিট আগে</option>
                                                </select>
                                            </div>
                                            <?php if($cnt >1){
                                                echo '<i onclick="removeDiv('.'\'MedDiv\''.','.$cnt.')" class="fa fa-trash-o tbtn"></i>';
                                            }else{
                                                echo '<button type="button" class="btn btn-sm" style="margin-top: 1%;margin-left: 2%;" id="medBtn"><i class="fa fa-plus"></i></button>';
                                            } ?>
                                            
                                        </div>
                                        
                                    
                                    <?php
                                }
                                ?>
                                <div id="appendMedDiv">
                                        
                                </div>
                            </div>
                            
                        </div>

                    <div class="form-group">
                        <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('Test'); ?></label>

                        <div class="col-sm-9">
                            <?php 
                            foreach ($prescriptiontest_info as $valueT) {
                                $cntT++;
                                ?>
                                <div id="TestDiv<?php echo $cntT; ?>" style="margin-bottom: 15px;">
                                    <div class="col-sm-4" style="width:90%;">
                                        <select name="Test[]" id="Test" class="select2">
                                            <?php foreach ($test_info as $rowTest) { ?>
                                                <option value="<?php echo $rowTest['name']; ?>" <?php if ($valueT['name'] == $rowTest['name']) echo 'selected'; ?>>
                                                    <?php echo $rowTest['name']; ?>
                                                </option>
                                            <?php } ?> 
                                        </select>
                                    </div>
                                    
                                    <?php if($cntT >1){
                                        echo '<i onclick="removeDiv('.'\'TestDiv\''.','.$cntT.')" class="fa fa-trash-o tbtn"></i>';
                                    }else{
                                        echo '<button type="button" class="btn btn-sm" style="margin-top: 1%;margin-left: 2%;" id="testBtn"><i class="fa fa-plus"></i></button>';
                                    } ?>
                                    
                                </div>
                                <?php
                            }
                            ?>
                            <div id="appendTestdDiv" style="margin-top: 25px;">
                                
                            </div>
                        </div>
                    </div>
                        
                        <div class="form-group">
                            <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('note'); ?></label>

                            <div class="col-sm-9">
                                <textarea name="note" class="form-control" id="field-ta">
                                    <?php //echo $row['note']; ?>
                                </textarea>
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
<script type="text/javascript">
    
    var arra = <?php echo json_encode($single_medicine_info) ?>;
    var arraTest = <?php echo json_encode($test_info) ?>;
    var prescriptionMedList = <?php echo json_encode($prescriptionMedList) ?>;
    var prescriptiontest_info = <?php echo json_encode($prescriptiontest_info) ?>;
    var formation = <?php echo json_encode($formation) ?>;
    //console.log(prescriptionMedList.length);
    var count = parseInt(prescriptionMedList.length)+1;
    var countTest = parseInt(prescriptiontest_info.length)+1;
    //var countTest = 0;

    // $.each(arra,function(k,v){
    //     $("#mName").append('<option value="'+v.name+'">'+v.name+'</option>');
    //     $('#mName').trigger('change');
    // });

    // $.each(arraTest,function(k,v){
    //     $("#Test").append('<option value="'+v.name+'">'+v.name+'</option>');
    //     $('#Test').trigger('change');
    // });

    function removeDiv(type,value){
        //alert(type+"<>"+value);
        $("#"+type+value).remove();
    }

    $("#medBtn").click(function(){
        count++;
        var design = '<div class="cDiv" id="MedDiv'+count+'" style="margin-top: 3%;margin-bottom: -1%;">';
            design += '    <div class="col-sm-4" style="width:16%;margin-left: -15px;margin-right: -5px;">';
            design += '        <select name="formation[]" id="formation" class="customSelect" >';
                                $.each(formation,function(k,v){
            design += '            <option value="'+v.formation+'">'+v.formation+'</option>';
                                });
            design += '        </select>';
            design += '    </div>';

            design += '    <div class="col-sm-4" style="width:23%;margin-left: -15px;margin-right: -5px;">';
            design += '        <select name="mName[]" id="mName" class="customSelect" >';
                                $.each(arra,function(k,v){
            design += '            <option value="'+v.name+'">'+v.name+'</option>';
                                });
            design += '        </select>';
            design += '    </div>';
            design += '    <div class="col-sm-4" style="width:16%;margin-left: -15px;margin-right: -5px;">';
            design += '        <select name="strength[]" id="strength" class="customSelect" >';
            design += '         <option value="1mg">1mg</option>';
            design += '         <option value="2mg">2mg</option>';
            design += '         <option value="3mg">3mg</option>';
            design += '        </select>';
            design += '    </div>';
            design += '    <div class="col-sm-4" style="width:27%;margin-left: -15px;margin-right: -5px">';
            design += '        <select name="doseage[]" id="doseage" class="customSelect" >';
            design += '         <option value="">ডোজ</option>';
            design += '         <option value="১+১+১">১+১+১</option>';
            design += '         <option value="১+০+১">১+০+১</option>';
            design += '         <option value="১+০+০">১+০+০</option>';
            design += '         <option value="০+১+০">০+১+০</option>';
            design += '         <option value="১+১+০">১+১+০</option>';
            design += '         <option value="০+০+১">০+০+১</option>';
            design += '         <option value="০+১+১">০+১+১</option>';
            design += '         <option value="দিনে ১ বার">দিনে ১ বার</option>';
            design += '         <option value="দিনে ২ বার">দিনে ২ বার</option>';
            design += '         <option value="দিনে ৩ বার">দিনে ৩ বার</option>';
            design += '         <option value="দিনে ৪ বার">দিনে ৪ বার</option>';
            design += '         <option value="১/২ চামচ করে ১ বার">১/২ চামচ করে ১ বার</option>';
            design += '         <option value="১/২ চামচ করে ২ বার">১/২ চামচ করে ২ বার</option>';
            design += '         <option value="১/২ চামচ করে ৩ বার">১/২ চামচ করে ৩ বার</option>';
            design += '         <option value="১ চামচ করে ১ বার">১ চামচ করে ১ বার</option>';
            design += '         <option value="১ চামচ করে ২ বার">১ চামচ করে ২ বার</option>';
            design += '         <option value="১ চামচ করে ৩ বার">১ চামচ করে ৩ বার</option>';
            design += '         <option value="২ চামচ করে ১ বার">২ চামচ করে ১ বার</option>';
            design += '         <option value="২ চামচ করে ২ বার">২ চামচ করে ২ বার</option>';
            design += '         <option value="২ চামচ করে ৩ বার">২ চামচ করে ৩ বার</option>';
            design += '        </select>';
            design += '    </div>';
            design += '    <div class="col-sm-4" style="width:25%;margin-left: -15px;margin-right: -5px;">';
            design += '        <select name="remark[]" id="remark" class="customSelect">';
            design += '          <option value="">নির্দেশিকা</option>';
            design += '          <option value="খাওয়ার আগে">খাওয়ার আগে</option>';
            design += '          <option value="খাওয়ার ১০ মিনিট আগে">খাওয়ার ১০ মিনিট আগে</option>';
            design += '          <option value="খাওয়ার ২০ মিনিট আগে">খাওয়ার ২০ মিনিট আগে</option>';
            design += '          <option value="খাওয়ার ৩০ মিনিট আগে">খাওয়ার ৩০ মিনিট আগে</option>';
            design += '        </select>';
            design += '    </div';
            design += '    <button type="button" class="btn" style="margin-left: 2%;"><i onclick="removeDiv(\'MedDiv\','+count+')" class="fa fa-trash-o tbtn"></i></button>';
            design += '</div>';
        
        $("#appendMedDiv").append(design);


    });

    $("#testBtn").click(function(){
        countTest++;
        var design = '<div class="cDiv" id="TestDiv'+countTest+'" >';
            design += '    <div class="col-sm-4" style="width:90%;">';
            design += '        <select name="Test[]" id="Test" class="customSelect" >';
                                $.each(arraTest,function(k,v){
            design += '            <option value="'+v.name+'">'+v.name+'</option>';
                                });
            design += '        </select>';
            design += '    </div>';
            design += '    <i onclick="removeDiv(\'TestDiv\','+countTest+')" class="fa fa-trash-o tbtn"></i>';
            design += '</div>';
        
        $("#appendTestdDiv").append(design);


    });
</script>