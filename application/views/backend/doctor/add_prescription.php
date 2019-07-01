<style>
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
$single_medicine_info   = $this->db->get('medicine')->result_array();
$test_info   = $this->db->get('test')->result_array();
?>
<?php $patient_info = $this->db->get('patient')->result_array(); ?>
<?php $doctor_info = $this->db->get('doctor')->result_array(); ?>
<?php $department_info = $this->db->get('department')->result_array(); ?>
<?php 
$this->db->select('formation');
$this->db->group_by('formation');// add group_by
$formation = $this->db->get('medicine')->result_array(); ?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_prescription'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?doctor/prescription/create" method="post" enctype="multipart/form-data" accept-charset="utf-8">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('date'); ?></label>

                        <div class="col-sm-9">
                            <div class="date-and-time">
                                <input type="text" name="date_timestamp" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="date here">
                                <input type="text" name="time_timestamp" class="form-control timepicker" data-template="dropdown" data-show-seconds="false" data-default-time="00:05 AM" data-show-meridian="false" data-minute-step="5"  placeholder="time here">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('patient'); ?></label>

                        <div class="col-sm-9">
                            <select name="patient_id" class="select2 pull-left" id="patient_id" style="width:70%;">
                                <option value=""><?php echo get_phrase('select_patient'); ?></option>
                                <?php foreach ($patient_info as $row) { ?>
                                        <option value="<?php echo $row['patient_id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
							<button type="button" class="btn btn-success customBtn" id="patientBtn"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>


                    <div id="patientInfoDiv" >
						<div class="form-group">
							<label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('patient_name'); ?></label>

							<div class="col-sm-9">
								<input type="text" name="pName" id="pName" class="form-control" >
							</div>
						</div>
                        <div class="form-group">
                            <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('patient_sex'); ?></label>

                            <div class="col-sm-9">
                                <select name="pSex" id="pSex" class="form-control">
                                    <option value=""><?php echo get_phrase('select_sex'); ?></option>
                                    <option value="male"><?php echo get_phrase('male'); ?></option>
                                    <option value="female"><?php echo get_phrase('female'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('patient_age'); ?></label>

                            <div class="col-sm-9">
                                <input type="text" name="pAge"  id="pAge"  class="form-control" >
                            </div>
                        </div>
						<div class="form-group">
							<label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('patient_phone'); ?></label>

							<div class="col-sm-9">
								<input type="text" name="pPhone"  id="pPhone"  class="form-control" >
							</div>
						</div>
						<div class="form-group">
							<label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('patient_address'); ?></label>

							<div class="col-sm-9">
								<input type="text" name="pAddress"  id="pAddress"  class="form-control" >
							</div>
						</div>
                        <div class="form-group">
                            <div class="col-sm-3 control-label col-sm-offset-3">
                                <input type="button" class="btn btn-success" id="savePatient" value="Save Patient">
                            </div>
                        </div>
					</div>

                    <div class="form-group">
                        <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('refernce_type'); ?></label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <div class="col-sm-12" style="height: 50px;">
                                    <div class="col-sm-3" style="margin-top: 6px;">
                                        <span class="button-checkbox">
                                            <button type="button" class="btn" data-color="primary">Refer From</button>
                                            <input type="checkbox" class="hidden" name="Referfrom" id="Referfrom" value="1" />
                                        </span>
                                    </div>
                                    <div class="col-sm-9">
                                        <select name="OptReferFrom" class="select2 pull-left" id="OptReferFrom" style="width:70%;">
                                            <option value=""><?php echo get_phrase('select_doctor'); ?></option>
                                            <?php foreach ($doctor_info as $row) { ?>
                                                    <option value="<?php echo $row['doctor_id']; ?>"><?php echo $row['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <button type="button" class="btn btn-success customBtn" onclick="addDoc('OptReferFrom');"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="padding-top:0px;">
                                    <div class="col-sm-3" style="margin-top: 6px;">
                                        <span class="button-checkbox">
                                            <button type="button" class="btn" data-color="primary" style="letter-spacing: 2px;">Refer To</button>
                                            <input type="checkbox" class="hidden" name="Referto" id="Referto" value="1" />
                                        </span>
                                    </div>
                                    <div class="col-sm-9">
                                        <select name="OptReferTo" class="select2 pull-left" id="OptReferTo" style="width:70%;">
                                            <option value=""><?php echo get_phrase('select_doctor'); ?></option>
                                            <?php foreach ($doctor_info as $row) { ?>
                                                    <option value="<?php echo $row['doctor_id']; ?>"><?php echo $row['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <button type="button" class="btn btn-success customBtn"  onclick="addDoc('OptReferTo');"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div id="doctorInfoDiv">
                        <div class="form-group">
                            <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('doctor_name'); ?></label>

                            <div class="col-sm-9">
                                <input type="text" name="DName" id="DName" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('doctor_phone'); ?></label>

                            <div class="col-sm-9">
                                <input type="text" name="DPhone"  id="DPhone"  class="form-control" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('department'); ?></label>

                            <div class="col-sm-9">
                                <select name="department_id" id="department_id" class="form-control">
                                    <option value=""><?php echo get_phrase('select_department'); ?></option>
                                    <?php foreach ($department_info as $row) { ?>
                                        <option value="<?php echo $row['department_id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3 control-label col-sm-offset-3">
                                <input type="button" class="btn btn-success" data-type="" id="saveDoctor" value="Save Patient">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('case_history'); ?></label>

                        <div class="col-sm-9">
                            <textarea name="case_history" class="form-control html5editor" id="field-ta" data-stylesheet-url="assets/css/wysihtml5-color.css"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('medication'); ?></label>

                        <div class="col-sm-9">
                            <div id="">
                                <div class="col-sm-4" style="width:16%;margin-left: -15px;margin-right: -5px;">
                                    <select name="formation[]" class="select2 pull-left" id="formation" style="width:100%;">
                                        <?php foreach ($formation as $row) { ?>
                                                <option value="<?php echo $row['formation']; ?>"><?php echo $row['formation']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-4" style="width:18%;margin-left: -15px;margin-right: -5px;">
                                    <select name="mName[]" id="mName" class="select2">
                                        
                                    </select>
                                </div>
                                <div class="col-sm-4" style="width:16%;margin-left: -15px;margin-right: -5px;">
                                    <select name="strength[]" id="strength" class="select2">
                                        <option value="1mg">1mg</option>
                                        <option value="2mg">2mg</option>
                                        <option value="3mg">3mg</option>
                                    </select>
                                </div>
                                <div class="col-sm-4" style="width:27%;margin-left: -15px;margin-right: -5px;">
                                    <select name="doseage[]" id="doseage" class="select2">
                                        <option value="">ডোজ</option>
                                        <option value="১+১+১">১+১+১</option>
                                        <option value="১+০+১">১+০+১</option>
                                        <option value="১+০+০">১+০+০</option>
                                        <option value="০+১+০">০+১+০</option>
                                        <option value="১+১+০">১+১+০</option>
                                        <option value="০+০+১">০+০+১</option>
                                        <option value="০+১+১">০+১+১</option>
                                        <option value="দিনে ১ বার">দিনে ১ বার</option>
                                        <option value="দিনে ২ বার">দিনে ২ বার</option>
                                        <option value="দিনে ৩ বার">দিনে ৩ বার</option>
                                        <option value="দিনে ৪ বার">দিনে ৪ বার</option>
                                        <option value="১/২ চামচ করে ১ বার">১/২ চামচ করে ১ বার</option>
                                        <option value="১/২ চামচ করে ২ বার">১/২ চামচ করে ২ বার</option>
                                        <option value="১/২ চামচ করে ৩ বার">১/২ চামচ করে ৩ বার</option>
                                        <option value="১ চামচ করে ১ বার">১ চামচ করে ১ বার</option>
                                        <option value="১ চামচ করে ২ বার">১ চামচ করে ২ বার</option>
                                        <option value="১ চামচ করে ৩ বার">১ চামচ করে ৩ বার</option>
                                        <option value="২ চামচ করে ১ বার">২ চামচ করে ১ বার</option>
                                        <option value="২ চামচ করে ২ বার">২ চামচ করে ২ বার</option>
                                        <option value="২ চামচ করে ৩ বার">২ চামচ করে ৩ বার</option>
                                        
                                    </select>
                                </div>
                                
                                <div class="col-sm-4" style="width:27%;margin-left: -15px;margin-right: -5px;">
                                    <select name="remark[]" id="remark" class="select2">
                                        <option value="">নির্দেশিকা</option>
                                        <option value="খাওয়ার আগে">খাওয়ার আগে</option>
                                        <option value="খাওয়ার ১০ মিনিট আগে">খাওয়ার ১০ মিনিট আগে</option>
                                        <option value="খাওয়ার ২০ মিনিট আগে">খাওয়ার ২০ মিনিট আগে</option>
                                        <option value="খাওয়ার ৩০ মিনিট আগে">খাওয়ার ৩০ মিনিট আগে</option>
                                    </select>
                                </div>
                                <button type="button" class="btn btn-sm" style="margin-top: 1%;margin-left: 2%;" id="medBtn"><i class="fa fa-plus"></i></button>
                            </div>
                            <div id="appendMedDiv">
                                
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('Test'); ?></label>

                        <div class="col-sm-9">
                            <div id="">
                                <div class="col-sm-4" style="width:90%;">
                                    <select name="Test[]" id="Test" class="select2">
                                        
                                    </select>
                                </div>
                                
                                <button type="button" class="btn btn-sm" style="font-size: 14px; margin-top: 1%;margin-left: 2%;" id="testBtn"><i class="fa fa-plus"></i></button>
                            </div>
                            <div id="appendTestdDiv">
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('note'); ?></label>

                        <div class="col-sm-9">
                            <textarea name="note" class="form-control html5editor" id="field-ta" data-stylesheet-url="assets/css/wysihtml5-color.css"></textarea>
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
    var arra = <?php echo json_encode($single_medicine_info) ?>;
    var arraTest = <?php echo json_encode($test_info) ?>;
    var formation = <?php echo json_encode($formation) ?>;
    
    var count = 0;
    var countTest = 0;

    $.each(arra,function(k,v){
        $("#mName").append('<option value="'+v.name+'">'+v.name+'</option>');
        $('#mName').trigger('change');
    });

    $.each(arraTest,function(k,v){
        $("#Test").append('<option value="'+v.name+'">'+v.name+'</option>');
        $('#Test').trigger('change');
    });

    $("#patientBtn").click(function(){
        $("#patientInfoDiv").toggle('slide');
    });

    $("#savePatient").click(function(){

        var pName = $("#pName").val();
        var pPhone = $("#pPhone").val();
        var pAddress = $("#pAddress").val();
        var pSex = $("#pSex").val();
        var pAge = $("#pAge").val();

        $.ajax({
            type:"POST",
            url:"<?php echo base_url(); ?>index.php?doctor/patientCustom/create",
            data:{
                name:pName,
                phone:pPhone,
                address:pAddress,
                sex:pSex,
                age:pAge
            }, 
            dataType: "JSON",
            success: function (data) {
                console.log(data.value);

                $("#patient_id").append("<option value='"+data.insertid+"'>"+pName+"</option>");
                $('#patient_id').trigger('change');
                
                $("#pName").val("");
                $("#pPhone").val("");
                $("#pAddress").val("");
                $("#pSex").val("");
                $("#pAge").val("");

                $("#patientBtn").trigger('click');


            },
            error : function(data){
                console.log(data);
            }
        });

    });

    $("#medBtn").click(function(){
        count++;
        var design = '<div class="cDiv" id="MedDiv'+count+'">';
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
        var design = '<div class="cDiv" id="TestDiv'+countTest+'">';
            design += '    <div class="col-sm-4" style="width:90%;">';
            design += '        <select name="Test[]" id="Test" class="customSelect" >';
                                $.each(arraTest,function(k,v){
            design += '            <option value="'+v.name+'">'+v.name+'</option>';
                                });
            design += '        </select>';
            design += '    </div>';
            design += '    <button type="button" class="btn" style="margin-left: 2%;"><i onclick="removeDiv(\'TestDiv\','+countTest+')" class="fa fa-trash-o tbtn"></i></button>';
            design += '</div>';
        
        $("#appendTestdDiv").append(design);


    });

    function removeDiv(type,value){
        $("#"+type+value).remove();
    }

    $(function () {
        $('.button-checkbox').each(function () {

            // Settings
            var $widget = $(this),
                $button = $widget.find('button'),
                $checkbox = $widget.find('input:checkbox'),
                color = $button.data('color'),
                settings = {
                    on: {
                        icon: 'glyphicon glyphicon-check'
                    },
                    off: {
                        icon: 'glyphicon glyphicon-unchecked'
                    }
                };

            // Event Handlers
            $button.on('click', function () {
                $checkbox.prop('checked', !$checkbox.is(':checked'));
                $checkbox.triggerHandler('change');
                updateDisplay();
            });
            $checkbox.on('change', function () {
                updateDisplay();
            });

            // Actions
            function updateDisplay() {
                var isChecked = $checkbox.is(':checked');

                // Set the button's state
                $button.data('state', (isChecked) ? "on" : "off");

                // Set the button's icon
                $button.find('.state-icon')
                    .removeClass()
                    .addClass('state-icon ' + settings[$button.data('state')].icon);

                // Update the button's color
                if (isChecked) {
                    $button
                        .removeClass('btn-default')
                        .addClass('btn-' + color + ' active');
                }
                else {
                    $button
                        .removeClass('btn-' + color + ' active')
                        .addClass('btn-default');
                }
            }

            // Initialization
            function init() {

                updateDisplay();

                // Inject the icon if applicable
                if ($button.find('.state-icon').length == 0) {
                    $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
                }
            }
            init();
        });
    });

    function addDoc(idname){

        $("#saveDoctor").attr('data-type',idname);
        $("#doctorInfoDiv").toggle('slide');
    }

    $("#saveDoctor").click(function(){

        var idname = $("#saveDoctor").attr('data-type');
        var pName = $("#DName").val();
        var pPhone = $("#DPhone").val();
        var department_id = $("#department_id").val();

        $.ajax({
            type:"POST",
            url:"<?php echo base_url(); ?>index.php?doctor/doctorCustom/create",
            data:{
                name:pName,
                phone:pPhone,
                department_id:department_id
            }, 
            dataType: "JSON",
            success: function (data) {
                $("#"+idname).append("<option value='"+data.insertid+"'>"+pName+"</option>");
                $("#"+idname).trigger('change');
                
                $("#DName").val("");
                $("#DPhone").val("");
                $("#department_id").val("");
                $("#doctorInfoDiv").toggle('slide');
            },
            error : function(data){
                console.log(data);
            }
        });
    });
</script>