<?php 
    function en2bn($number){

        $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        
        return str_replace($en, $bn, $number);
    }
?>
<style type="text/css">
    #rxDiv{
        padding-top: 10px;
    }

    #tesDiv{
        padding-top: 10px;
    }
</style>
<?php
$edit_data      = $this->db->get_where('prescription', array('prescription_id' => $param2))->result_array();
foreach ($edit_data as $row):
$patient_info   = $this->db->get_where('patient' , array('patient_id' => $row['patient_id'] ))->result_array();
?>
    <div id="prescription_print">
        <table width="100%" border="0">
            <tr>
                <!-- <td align="left" valign="top">
                    <?php foreach ($patient_info as $row2){ ?>
                        <?php echo 'Patient Name: '.$row2['name']; ?><br>
                        <?php echo 'Age: '.$row2['age']; ?><br>
                        <?php echo 'Sex: '.$row2['sex']; ?><br>
                    <?php } ?>
                </td> -->
                <td align="left" valign="top">
                    <p style="color: #943a40; font-size: 20px;font-weight: bold; "><?php $name = $this->db->get_where('doctor' , array('doctor_id' => $row['doctor_id'] ))->row()->name;
                          echo $name;?><p>
                    <p style="line-height: 0.7em">M.B.B.S, BCS (HEALTH)</p>
                    <p style="line-height: 0.7em">M.C.P.S. (SURGERRY)</p>
                    <p style="line-height: 0.7em">Chittagong Medical College & Hospital</p>
                    <p style="line-height: 0.7em">General Physician & Senior Consultant (SURGERRY)</p>
                    
                </td>
                <td align="right" valign="top">
                    <p style="color: #943a40; font-size: 20px;font-weight: bold; ">ডাঃ মোহাম্মদ সেলিম<p>
                    <p style="line-height: 0.7em">এমবিবিএস, বিসিএস (স্বাস্থ্য)</p>
                    <p style="line-height: 0.7em">এম. সি. পি. এস ( সার্জারী)</p>
                    <p style="line-height: 0.7em">চট্টগ্রাম মেডিকেল কলেজ ও হাসপাতাল</p>
                    <p style="line-height: 0.7em">জেনারেল ফিজিশিয়ান ও সিনিয়র কনসালটেন্ট (সার্জারী)</p>
                </td>
            </tr>
            <tr>
                <td>
                    <?php if($row['Referfrom'] != '0' && $row['Referfrom'] != '') {
                        $ReferfromdrName = $this->db->get_where('doctor' , array('doctor_id' => $row['ref_from_dr_id'] ))->row()->name;
                          echo 'Ref. By: '.$ReferfromdrName.'';
                    }else{
                        echo 'Ref. By : .............................';
                    } ?>
                </td>
            </tr>
        </table>
        <table width="100%" border="0" style="margin: 10px 0px;">
            <tr class="text-centre" style="height: 35px;border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;"> 
                <?php foreach ($patient_info as $row2){ ?>
                    <td colspan="3" style="padding-left: 10px;"><?php echo 'Name: '.$row2['name']; ?></td>
                    <td><?php echo 'Age: '.$row2['age']; ?></td>
                    <td><?php echo 'Sex: '.$row2['sex']; ?></td>
                    <td>Date: <?php echo en2bn(date('d / m / Y')); ?></td>
                <?php } ?>
            </tr>
            <tr class="text-centre" style="height: 35px;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;"> 
                <td style="padding-left: 10px;">Height:</td>
                <td>Weight:</td>
                <td>IBW:</td>
                <td>BMI:</td>
                <td>DCA:</td>
                <td>1st Visit:</td>
            </tr>
        </table>
        <table width="100%" border="0" style="margin-top: -10px;">
            <tr style="height: 640px;border-bottom: 1px solid #000000;">
                <td style="width:30%;height: 640px;border-right: 1px solid #000000;margin: 0px; float: left; padding: 20px;">
                    
                    <table width="100%" border="0">
                        <tr style="height: 120px; margin: 0px; padding: 0px; float: left;">
                            <td>Dx:</td>
                        </tr>
                    </table>
                    <table width="100%" border="0">
                        <tr style="height: 65px; margin: 0px; padding: 0px; float: left;">
                            <td>C/C:</td>
                        </tr>
                    </table>
                    <table width="100%" border="0">
                        <tr style="height: 56px; margin: 0px; padding: 0px; float: left;">
                            <td>Risk Factors:</td>
                        </tr>
                    </table>
                    <table width="100%" border="0">
                        <tr style="height: 25px; margin: 0px; padding: 0px; float: left;">
                            <td>O/E:</td>
                        </tr>
                    </table>
                    <table width="100%" border="0">
                        <tr style="height: 25px; margin: 0px; padding: 0px; float: left;">
                            <td>Pulse:</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    /Min</td>
                        </tr>
                    </table>
                    <table width="100%" border="0">
                        <tr style="height: 25px; margin: 0px; padding: 0px; float: left;">
                            <td>BP:</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MMHg</td>
                        </tr>
                    </table>
                    <table width="100%" border="0">
                        <tr style="height: 100px; margin: 0px; padding: 0px; float: left;">
                            <td>Others:</td>
                        </tr>
                    </table>
                    <table width="100%" border="0">
                        <tr style="height: 20px; margin: 0px; padding: 0px; float: left;">
                            <td>Advice:</td>
                        </tr>
                        <tr style="height: 125px; margin: 0px; padding: 0px; float: left;">
                            <td><?php echo $row['note']; ?></td>
                        </tr>
                    </table>
                    
                    
                </td>
                <td style="width: 70%; margin: 0px; float: left; padding: 20px;">
                    <table width="100%" border="0" style="">
                        <tr>
                            <td>Rx,</td>
                        </tr>
                        <?php 
                            $allMedicine = $this->db->get_where('prescriptionmedicine', array('PrescriptionID' => $param2))->result_array();
                            foreach ($allMedicine as $medRow){
                                echo '<tr style="width: 100%;padding-left: 16px; float: left;margin: 5px 0px;"><td>'.$medRow['formation'].' '.$medRow['Name'].' ( '.$medRow['Doseage'].' '.$medRow['Remark'].' )</td></tr>';
                            }

                        ?>
                    </table>
                </td>
            </tr>
        </table>
        <table width="100%" border="0" >
            <tr>
                <td align="left">
                    <p style="color: #943a40; font-size: 16px;font-weight: bold; ">চেম্বারঃ<p>
                    <p style="line-height: 0.7em">ল্যানসেট ডায়াগনষ্টিক সেন্টার</p>
                    <p style="line-height: 0.7em">চট্টগ্রাম মেডিকেল কলেজ মেইন গেইট</p>
                    <p style="line-height: 0.7em">দিনঃ রবি থেকে বৃহস্পতিবার</p>
                    <p style="line-height: 0.7em">সময়ঃ সন্ধ্যা ৭ টা থেকে রাত ৯ টা</p>
                    <p style="line-height: 0.7em">সিরিয়ালের জন্যঃ ০৩১-২৫৫১০০৪-০৫,০১৮১৯-৩৪০৬৭৭,০১৫৫২-৬৭৪৪২৫</p>
                    
                    
                </td>
                <td align="right">
                    <p style="color: #943a40; font-size: 16px;font-weight: bold; ">চেম্বারঃ<p>
                    <p style="line-height: 0.7em">লক্ষীপুর আধুনিক হাসপাতাল (প্রাঃ) লিঃ</p>
                    <p style="line-height: 0.7em">(ঝুমুর সিনেমা হলের ২০০ গজ দক্ষিণে)</p>
                    <p style="line-height: 0.7em">সাক্ষাতের সময়ঃ প্রতি শুক্রবার সকাল ৮ টা থেকে রাত ৮ টা</p>
                    <p style="line-height: 0.7em">যোগাযোগঃ ০১৭১১-৮৬২১৭৭, ০৩৮১-৫৫৬৬৩, ৫৫৭৪৭</p>
                    <p style="line-height: 0.7em">০১৮১৯-৩৪০৬৭৭</p>
                </td>
            </tr>
        </table>
        <!-- <div class="row">
            <div class="col-md-12">

                <div class="panel panel-primary" data-collapsed="0">
                        
                    <div class="panel-body">
                            
                        <div class="col-sm-12" style="border-bottom: 1px solid #c5c5c5;">
                            <b><?php echo get_phrase('case_history'); ?> :</b>
                        
                            <p><?php echo $row['case_history']; ?></p>
                        </div>
                        <div class="col-sm-12" id="midDiv" style="border-bottom: 1px solid #c5c5c5;" >
                            <div class="col-sm-4" id="tesDiv" >
                                <b><?php echo get_phrase('Test'); ?></b>
                                <?php 
                                    $alltest      = $this->db->get_where('prescriptiontest', array('PrescriptionID' => $param2))->result_array();
                                    foreach ($alltest as $medRow){
                                        echo '<p>'.$medRow['name'].'</p>';
                                    }

                                ?>
                            </div>
                            <div class="col-sm-8" id="rxDiv"  style="border-left: 1px solid #c5c5c5;">
                                <b><?php echo get_phrase('Rx.'); ?></b>
                            
                                <?php 
                                    $allMedicine      = $this->db->get_where('prescriptionmedicine', array('PrescriptionID' => $param2))->result_array();
                                    foreach ($allMedicine as $medRow){
                                        echo '<p>'.$medRow['Name'].' '.$medRow['Doseage'].' '.$medRow['Remark'].'</p>';
                                    }

                                ?>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <b><?php echo get_phrase('note'); ?> :</b>
                        
                            <p><?php echo $row['note']; ?></p>
                        </div>
                        

                    </div>

                </div>

            </div>
        </div> -->
    </div>
    <br>

    <a onClick="printDiv('prescription_print')" class="btn btn-primary btn-icon icon-left hidden-print">
        Print Prescription
        <i class="entypo-doc-text"></i>
    </a>
<?php endforeach; ?>




<script type="text/javascript">

    $(document).ready(function(){
        $('#midDiv').height($("#rxDiv").height()+10);
    });
    
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        console.log(data);
        var mywindow = window.open('', 'prescription', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Prescription</title>');
        mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-theme.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }


    function printDiv(divName) {
         var printContents = document.getElementById(divName).innerHTML;
         var originalContents = document.body.innerHTML;

         document.body.innerHTML = printContents;

         window.print();

         document.body.innerHTML = originalContents;
    }

</script>


<!-- <?php if($row['Referfrom'] != '0' && $row['Referfrom'] != '') {
                        $ReferfromdrName = $this->db->get_where('doctor' , array('doctor_id' => $row['ref_from_dr_id'] ))->row()->name;
                          echo 'Refered By: '.$ReferfromdrName.'<br>';
                    }else{
                        echo 'Refered By : None<br>';
                        } ?>
                    <?php if($row['Referto'] != '0' && $row['Referto'] != '') {
                        $RefertodrName = $this->db->get_where('doctor' , array('doctor_id' => $row['ref_to_dr_id'] ))->row()->name;
                          echo 'Refere To: '.$RefertodrName.'<br>';
                    }else{
                        echo 'Refere To: None<br>';
                        } ?>       
                    <?php echo 'Date: '.date("d M, Y", $row['timestamp']); ?><br>
                    <?php echo 'Time: '.date("H:i", $row['timestamp']); ?><br> -->