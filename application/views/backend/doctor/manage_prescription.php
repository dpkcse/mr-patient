<?php if($menu_check == 'from_prescription') { ?>
<!-- <button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/add_prescription/');" 
    class="btn btn-primary pull-right">
        <?php echo get_phrase('add_prescription'); ?>
</button> -->
<a class="btn btn-primary pull-right" href="<?php echo base_url().'index.php?doctor/add_prescription/'; ?>"><?php echo get_phrase('add_prescription'); ?></a>
<div style="clear:both;"></div>
<br>
<?php } ?>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('prescription');?></th>
            <th><?php echo get_phrase('date');?></th>
            <th><?php echo get_phrase('patient');?></th>
            <th><?php echo get_phrase('doctor');?></th>
            <th><?php echo get_phrase('Case History');?></th>
            <th  style="text-align: center;"><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($prescription_info as $row) { ?>   
            <tr>

                <td>
                    <?php $prescription_id = $this->db->get_where('prescription' , array('prescription_id' => $row['prescription_id'] ))->row()->prescription_id;
                        echo $prescription_id;?>
                </td>
                <td><?php echo date("d M, Y -  H:i", $row['timestamp']); ?></td>


                <td>
                    <?php $name = $this->db->get_where('patient' , array('patient_id' => $row['patient_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td>
                    <?php $name = $this->db->get_where('doctor' , array('doctor_id' => $row['doctor_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td>
                    <?php $case_history = $this->db->get_where('prescription' , array('case_history' => $row['case_history'] ))->row()->case_history;
                        echo $case_history;?>
                </td>
                <td style="text-align: center;">
                    <?php if($menu_check == 'from_prescription') { ?>
                        <a  href="<?php echo base_url().'index.php?doctor/edit_prescription/'.$row["prescription_id"];?>" class="btn btn-default btn-sm btn-icon icon-left">
                                <i class="entypo-pencil"></i>
                                Edit
                        </a>
                    <?php } ?>
                    <a  href="<?php echo base_url();?>index.php?doctor/show_prescription/<?php echo $row['prescription_id']?>" 
                        class="btn btn-default btn-sm btn-icon icon-left">
                            <i class="fa fa-eye"></i>
                            View Prescription
                    </a>
                    <a  onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/manage_diagnosis_report/<?php echo $row['prescription_id']; ?>/<?php echo $row['doctor_id']; ?>');" 
                        class="btn btn-default btn-sm btn-icon icon-left">
                            <i class="fa fa-eye"></i>
                            View Diagnosis Report
                    </a>
                    <?php if($menu_check == 'from_prescription') { ?>
                        <a href="<?php echo base_url();?>index.php?doctor/prescription/delete/<?php echo $row['prescription_id']?>/<?php echo $menu_check; ?>/<?php echo $row['patient_id']; ?>"
                            class="btn btn-danger btn-sm btn-icon icon-left" onclick="return checkDelete();">
                                <i class="entypo-cancel"></i>
                                Delete
                        </a>

                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap"
            //"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        // Highlighted rows
        $("#table-2 tbody input[type=checkbox]").each(function (i, el)
        {
            var $this = $(el),
                    $p = $this.closest('tr');

            $(el).on('change', function ()
            {
                var is_checked = $this.is(':checked');

                $p[is_checked ? 'addClass' : 'removeClass']('highlight');
            });
        });

        // Replace Checboxes
        $(".pagination a").click(function (ev)
        {
            replaceCheckboxes();
        });
    });

    function reportjoin(id){
        alert(id);
        var  base_url = '<?php echo base_url(); ?>';
        
        $.ajax({
                url: '<?php echo base_url(); ?>index.php?doctor/prescriptionPrint',
                type: 'POST',
                data: {
                    listArr:id
                },
                dataType: 'JSON',
                beforeSend: function (jqXHR, textStatus, errorThrown) {
                   //abortAjax(jqXHR);
                },
                success: function (data_st, textStatus) {
                    
                    var str = data_st.filePath;
                    window.open(base_url+'downloads/prescription/'+str+'.pdf', '_blank');
                },
                error : function(data){
                    console.log(data);
                }
            });
        
    }
</script>