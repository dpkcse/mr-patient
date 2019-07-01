<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Doctor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('crud_model');

    }

    function index() {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $data['page_name'] = 'dashboard';
        $data['page_title'] = get_phrase('doctor_dashboard');
        $this->load->view('backend/index', $data);
    }

    function patient($task = "", $patient_id = "") {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $email = $_POST['email'];
            $patient = $this->db->get_where('patient', array('email' => $email))->row()->name;
            if ($patient == null) {
                $this->crud_model->save_patient_info();
                $this->session->set_flashdata('message', get_phrase('patient_info_saved_successfuly'));
            } else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
            redirect(base_url() . 'index.php?doctor/patient');
        }

        if ($task == "update") {
                $this->crud_model->update_patient_info($patient_id);
                $this->session->set_flashdata('message', get_phrase('patient_info_updated_successfuly'));
                redirect(base_url() . 'index.php?doctor/patient');
        }

        if ($task == "delete") {
            $this->crud_model->delete_patient_info($patient_id);
            redirect(base_url() . 'index.php?doctor/patient');
        }

        $data['patients'] = $this->crud_model->select_patient_info_by_doctor_id();
        $data['page_name'] = 'manage_patient';
        $data['page_title'] = get_phrase('patient');
        $this->load->view('backend/index', $data);
    }

    function department($task = "", $department_id = "") {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $this->crud_model->save_department_info();
            $this->session->set_flashdata('message', get_phrase('department_info_saved_successfuly'));
            redirect(base_url() . 'index.php?doctor/department');
        }

        if ($task == "update") {
            $this->crud_model->update_department_info($department_id);
            $this->session->set_flashdata('message', get_phrase('department_info_updated_successfuly'));
            redirect(base_url() . 'index.php?doctor/department');
        }

        if ($task == "delete") {
            $this->crud_model->delete_department_info($department_id);
            redirect(base_url() . 'index.php?doctor/department');
        }

        $data['department_info'] = $this->crud_model->select_department_info();
        $data['page_name'] = 'manage_department';
        $data['page_title'] = get_phrase('department');
        $this->load->view('backend/index', $data);
    }

    function doctor($task = "", $doctor_id = "") {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $email = $_POST['email'];
            $doctor = $this->db->get_where('doctor', array('email' => $email))->row()->name;

            if ($doctor == null) {
                $this->crud_model->save_doctor_info();
                $this->session->set_flashdata('message', get_phrase('doctor_info_saved_successfuly'));
            } else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
            redirect(base_url() . 'index.php?doctor/doctor');
        }

        if ($task == "update") {
          
                $this->crud_model->update_doctor_info($doctor_id);
                $this->session->set_flashdata('message', get_phrase('doctor_info_updated_successfuly'));
            
                redirect(base_url() . 'index.php?doctor/doctor');
        }

        if ($task == "delete") {
            $this->crud_model->delete_doctor_info($doctor_id);
            redirect(base_url() . 'index.php?doctor/doctor');
        }
        $data['doctor_info'] = $this->crud_model->select_doctor_info();
        $data['page_name'] = 'manage_doctor';
        $data['page_title'] = get_phrase('doctor');
        $this->load->view('backend/index', $data);
    }

    function medicine_category($task = "", $medicine_category_id = "")
    {
        if ($this->session->userdata('doctor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
                
        if ($task == "create")
        {
            $this->crud_model->save_medicine_category_info();
            $this->session->set_flashdata('message' , get_phrase('medicine_category_info_saved_successfuly'));
            redirect(base_url() .  'index.php?doctor/medicine_category');
        }
        
        if ($task == "update")
        {
            $this->crud_model->update_medicine_category_info($medicine_category_id);
            $this->session->set_flashdata('message' , get_phrase('medicine_category_info_updated_successfuly'));
            redirect(base_url() .  'index.php?doctor/medicine_category');
        }
        
        if ($task == "delete")
        {
            $this->crud_model->delete_medicine_category_info($medicine_category_id);
            redirect(base_url() .  'index.php?doctor/medicine_category');
        }
        
        $data['medicine_category_info'] = $this->crud_model->select_medicine_category_info();
        $data['page_name']              = 'manage_medicine_category';
        $data['page_title']             = get_phrase('medicine_category');
        $this->load->view('backend/index', $data);
    }

    function getSpecificCat(){
        
        if ($this->session->userdata('doctor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }

        $jsonData = array();
        $jsonData['medicine_generic'] = $this->db->get_where('medicine_generic',array('category_id'=> $this->input->post('val')))->result_array();

        header("Content-Type: application/json; charset=utf-8", true);
        echo json_encode($jsonData);

    }

    function medicine_generic_name($task = "", $medicine_category_id = "")
    {
        if ($this->session->userdata('doctor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
                
        if ($task == "create")
        {
            $this->crud_model->save_medicine_generic_info();
            $this->session->set_flashdata('message' , get_phrase('medicine_category_info_saved_successfuly'));
            redirect(base_url() .  'index.php?doctor/medicine_generic_name');
        }
        
        if ($task == "update")
        {
            $this->crud_model->update_medicine_generic_info($medicine_category_id);
            $this->session->set_flashdata('message' , get_phrase('medicine_category_info_updated_successfuly'));
            redirect(base_url() .  'index.php?doctor/medicine_generic_name');
        }
        
        if ($task == "delete")
        {
            $this->crud_model->delete_medicine_generic_info($medicine_category_id);
            redirect(base_url() .  'index.php?doctor/medicine_generic_name');
        }
        
        $data['medicine_generic_info'] = $this->crud_model->select_medicine_generic_info();
        $data['page_name']              = 'manage_medicine_generic';
        $data['page_title']             = get_phrase('medicine_generic_name');
        $this->load->view('backend/index', $data);
    }


    
    function medicine($task = "", $medicine_id = "")
    {
        if ($this->session->userdata('doctor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
                
        if ($task == "create")
        {
            $this->crud_model->save_medicine_info();
            $this->session->set_flashdata('message' , get_phrase('medicine_info_saved_successfuly'));
            redirect(base_url() .'index.php?doctor/medicine');
        }
        
        if ($task == "update")
        {
            $this->crud_model->update_medicine_info($medicine_id);
            $this->session->set_flashdata('message' , get_phrase('medicine_info_updated_successfuly'));
            redirect(base_url() .'index.php?doctor/medicine');
        }
        
        if ($task == "delete")
        {
            $this->crud_model->delete_medicine_info($medicine_id);
            redirect(base_url() .'index.php?doctor/medicine');
        }
        
        $data['medicine_info']  = $this->crud_model->select_medicine_info();
        $data['page_name']      = 'manage_medicine';
        $data['page_title']     = get_phrase('medicine');
        $this->load->view('backend/index', $data);
    }

    function test_category($task = "", $medicine_category_id = "")
    {
        if ($this->session->userdata('doctor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
                
        if ($task == "create")
        {
            $this->crud_model->save_test_category_info();
            $this->session->set_flashdata('message' , get_phrase('test_category_info_saved_successfuly'));
            redirect(base_url() .  'index.php?doctor/test_category');
        }
        
        if ($task == "update")
        {
            $this->crud_model->update_test_category_info($medicine_category_id);
            $this->session->set_flashdata('message' , get_phrase('test_category_info_updated_successfuly'));
            redirect(base_url() .  'index.php?doctor/test_category');
        }
        
        if ($task == "delete")
        {
            $this->crud_model->delete_test_category_info($medicine_category_id);
            redirect(base_url() .  'index.php?doctor/test_category');
        }
        
        $data['test_category_info'] = $this->db->get('test_category')->result_array();
        $data['page_name']              = 'manage_test_category';
        $data['page_title']             = get_phrase('test_category');
        $this->load->view('backend/index', $data);
    }

    function test($task = "", $medicine_id = "")
    {
        if ($this->session->userdata('doctor_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
                
        if ($task == "create")
        {
            $this->crud_model->save_test_info();
            $this->session->set_flashdata('message' , get_phrase('test_info_saved_successfuly'));
            redirect(base_url() .'index.php?doctor/test');
        }
        
        if ($task == "update")
        {
            $this->crud_model->update_test_info($medicine_id);
            $this->session->set_flashdata('message' , get_phrase('medicine_info_updated_successfuly'));
            redirect(base_url() .'index.php?doctor/test');
        }
        
        if ($task == "delete")
        {
            $this->crud_model->delete_test_info($medicine_id);
            redirect(base_url() .'index.php?doctor/test');
        }
        
        $data['test_info']  = $this->db->get('test')->result_array();
    
        $data['page_name']      = 'manage_test';
        $data['page_title']     = get_phrase('test');
        $this->load->view('backend/index', $data);
    }

    function patientCustom($task = "", $patient_id = "") {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $Array = array();

            
            $data['name']       = $this->input->post('name');
            $data['address']    = $this->input->post('address');
            $data['phone']          = $this->input->post('phone');
            $data['sex']            = $this->input->post('sex');
            $data['age']            = $this->input->post('age');
            
            $this->db->insert('patient',$data);
            
            $Array['insertid'] = $this->db->insert_id() ;
            
            header('Content-Type: application/json');
            echo json_encode($Array);
        }
    }

    function doctorCustom($task = "", $patient_id = "") {
        
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $Array = array();

            
            $data['name']       = $this->input->post('name');
            $data['phone']    = $this->input->post('phone');
            $data['department_id']          = $this->input->post('department_id');
            
            $this->db->insert('doctor',$data);
            
            $Array['insertid'] = $this->db->insert_id() ;
            
            header('Content-Type: application/json');
            echo json_encode($Array);
        }
    }

    function medication_history($param1 = "", $prescription_id = "") {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $patient_name = $this->db->get_where('patient', array('patient_id' => $param1))->row()->name; // $param1 = $patient_id
        $data['prescription_info'] = $this->crud_model->select_medication_history($param1); // $param1 = $patient_id
        $data['menu_check'] = 'from_patient';
        $data['page_name'] = 'manage_prescription';
        $data['page_title'] = get_phrase('medication_history_of_:_') . $patient_name;
        $this->load->view('backend/index', $data);
    }

    function bed_allotment($task = "", $bed_allotment_id = "") {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $this->crud_model->save_bed_allotment_info();
            $this->session->set_flashdata('message', get_phrase('bed_allotment_info_saved_successfuly'));
            redirect(base_url() . 'index.php?doctor/bed_allotment');
        }

        if ($task == "update") {
            $this->crud_model->update_bed_allotment_info($bed_allotment_id);
            $this->session->set_flashdata('message', get_phrase('bed_allotment_info_updated_successfuly'));
            redirect(base_url() . 'index.php?doctor/bed_allotment');
        }

        if ($task == "delete") {
            $this->crud_model->delete_bed_allotment_info($bed_allotment_id);
            redirect(base_url() . 'index.php?doctor/bed_allotment');
        }

        $data['bed_allotment_info'] = $this->crud_model->select_bed_allotment_info();
        $data['page_name'] = 'manage_bed_allotment';
        $data['page_title'] = get_phrase('bed_allotment');
        $this->load->view('backend/index', $data);
    }

    function blood_bank($task = "", $blood_bank_id = "") {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $data['blood_bank_info'] = $this->crud_model->select_blood_bank_info();
        $data['blood_donor_info'] = $this->crud_model->select_blood_donor_info();
        $data['page_name'] = 'show_blood_bank';
        $data['page_title'] = get_phrase('blood_bank');
        $this->load->view('backend/index', $data);
    }

    function report($task = "", $report_id = "") {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $this->crud_model->save_report_info();
            $this->session->set_flashdata('message', get_phrase('report_info_saved_successfuly'));
            redirect(base_url() . 'index.php?doctor/report');
        }

        if ($task == "update") {
            $this->crud_model->update_report_info($report_id);
            $this->session->set_flashdata('message', get_phrase('report_info_updated_successfuly'));
            redirect(base_url() . 'index.php?doctor/report');
        }

        if ($task == "delete") {
            $this->crud_model->delete_report_info($report_id);
            redirect(base_url() . 'index.php?doctor/report');
        }

        $data['page_name'] = 'manage_report';
        $data['page_title'] = get_phrase('report');
        $this->load->view('backend/index', $data);
    }

    function profile($task = "") {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $doctor_id = $this->session->userdata('login_user_id');
        if ($task == "update") {
                $this->crud_model->update_doctor_info($doctor_id);
                redirect(base_url() . 'index.php?doctor/profile');
        }

        if ($task == "change_password") {
            $password = $this->db->get_where('doctor', array('doctor_id' => $doctor_id))->row()->password;
            $old_password = sha1($this->input->post('old_password'));
            $new_password = $this->input->post('new_password');
            $confirm_new_password = $this->input->post('confirm_new_password');

            if ($password == $old_password && $new_password == $confirm_new_password) {
                $data['password'] = sha1($new_password);

                $this->db->where('doctor_id', $doctor_id);
                $this->db->update('doctor', $data);

                $this->session->set_flashdata('message', get_phrase('password_info_updated_successfuly'));
                redirect(base_url() . 'index.php?doctor/profile');
            } else {
                $this->session->set_flashdata('message', get_phrase('password_update_failed'));
                redirect(base_url() . 'index.php?doctor/profile');
            }
        }

        $data['page_name'] = 'edit_profile';
        $data['page_title'] = get_phrase('profile');
        $this->load->view('backend/index', $data);
    }

    function appointment($task = "", $appointment_id = "") {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $this->crud_model->save_appointment_info();
            $this->session->set_flashdata('message', get_phrase('appointment_info_saved_successfuly'));
            redirect(base_url() . 'index.php?doctor/appointment');
        }

        if ($task == "update") {
            $this->crud_model->update_appointment_info($appointment_id);
            $this->session->set_flashdata('message', get_phrase('appointment_info_updated_successfuly'));
            redirect(base_url() . 'index.php?doctor/appointment');
        }

        if ($task == "delete") {
            $this->crud_model->delete_appointment_info($appointment_id);
            redirect(base_url() . 'index.php?doctor/appointment');
        }

        $data['appointment_info'] = $this->crud_model->select_appointment_info_by_doctor_id();
        $data['page_name'] = 'manage_appointment';
        $data['page_title'] = get_phrase('appointment');
        $this->load->view('backend/index', $data);
    }

    function appointment_requested($task = "", $appointment_id = "") {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "approve") {
            $this->crud_model->approve_appointment_info($appointment_id);
            $this->session->set_flashdata('message', get_phrase('appointment_info_approved'));
            redirect(base_url() . 'index.php?doctor/appointment_requested');
        }

        if ($task == "delete") {
            $this->crud_model->delete_appointment_info($appointment_id);
            redirect(base_url() . 'index.php?doctor/appointment_requested');
        }

        $data['requested_appointment_info'] = $this->crud_model->select_requested_appointment_info_by_doctor_id();
        $data['page_name'] = 'manage_requested_appointment';
        $data['page_title'] = get_phrase('requested_appointment');
        $this->load->view('backend/index', $data);
    }

    function prescription($task = "", $prescription_id = "", $menu_check = '', $patient_id = '') {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            
            $this->crud_model->save_prescription_info();
            $this->session->set_flashdata('message', get_phrase('prescription_info_saved_successfuly'));
            redirect(base_url() . 'index.php?doctor/prescription');
        }

        if ($task == "update") {
            $this->crud_model->update_prescription_info($prescription_id);
            $this->session->set_flashdata('message', get_phrase('prescription_info_updated_successfuly'));
            if ($menu_check == 'from_prescription')
                redirect(base_url() . 'index.php?doctor/prescription');
            else
                redirect(base_url() . 'index.php?doctor/medication_history/' . $patient_id);
        }

        if ($task == "delete") {
            $this->crud_model->delete_prescription_info($prescription_id);
            if ($menu_check == 'from_prescription')
                redirect(base_url() . 'index.php?doctor/prescription');
            else
                redirect(base_url() . 'index.php?doctor/medication_history/' . $patient_id);
        }

        $data['prescription_info'] = $this->crud_model->select_prescription_info_by_doctor_id();
        $data['menu_check'] = 'from_prescription';
        $data['page_name'] = 'manage_prescription';
        $data['page_title'] = get_phrase('prescription');
        $this->load->view('backend/index', $data);
    }

    function add_prescription() {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
        $data['menu_check'] = 'from_prescription';
        $data['page_name'] = 'add_prescription';
        $data['page_title'] = get_phrase('prescription');
        $this->load->view('backend/index', $data);
    }

    function edit_prescription($param2) {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
        $data['param3'] = 'from_prescription';
        $data['page_name'] = 'edit_prescription';
        $data['page_title'] = get_phrase('prescription');
        $data['param2'] = $param2;
        $this->load->view('backend/index', $data);
    }

    function diagnosis_report($task = "", $diagnosis_report_id = "") {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $this->crud_model->save_diagnosis_report_info();
            $this->session->set_flashdata('message', get_phrase('diagnosis_report_info_saved_successfuly'));
            redirect(base_url() . 'index.php?doctor/prescription');
        }

        if ($task == "delete") {
            $this->crud_model->delete_diagnosis_report_info($diagnosis_report_id);
            $this->session->set_flashdata('message', get_phrase('diagnosis_report_info_deleted_successfuly'));
            redirect(base_url() . 'index.php?doctor/prescription');
        }
    }

    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('doctor_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?doctor/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?doctor/message/message_read/' . $param2, 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
            $this->crud_model->mark_thread_messages_read($param2);
        }

        $page_data['message_inner_page_name'] = $param1;
        $page_data['page_name'] = 'message';
        $page_data['page_title'] = get_phrase('private_messaging');
        $this->load->view('backend/index', $page_data);
    }
	
	// SMS settings.
    function sms_settings($param1 = '') {

        if ($this->session->userdata('doctor_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'do_update') {
            $this->crud_model->update_sms_settings();
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?doctor/sms_settings/', 'refresh');
        }

        $page_data['page_name'] = 'sms_settings';
        $page_data['page_title'] = get_phrase('sms_settings');
        $this->load->view('backend/index', $page_data);
    }

    function show_prescription($param2){
        
        $page_data['page_name'] = 'show_prescription';
        $page_data['page_title'] = get_phrase('show_Prescription');
        $page_data['param2'] = $param2;
        $this->load->view('backend/index', $page_data);
    }

    // function prescriptionPrint(){

    //     $currrentDate = time();
    //     $jsonData = array();
    //     $html = "";
    //     $param2 = $this->input->post('listArr');
        
    //     $edit_data      = $this->db->get_where('prescription', array('prescription_id' => $param2))->result_array();
    //     foreach ($edit_data as $row):
    //         $patient_info   = $this->db->get_where('patient' , array('patient_id' => $row['patient_id'] ))->result_array();
    //         foreach ($patient_info as $row2){
    //             $pName = $row2['name'];
    //             $pAge = $row2['age'];
    //             $pSex = $row2['sex'];
    //         }
    //     $name = $this->db->get_where('doctor' , array('doctor_id' => $row['doctor_id'] ))->row()->name;
    //     $allMedicine      = $this->db->get_where('prescriptionmedicine', array('PrescriptionID' => $param2))->result_array();
                                            

    //     $html .= '<html lang="en">
    //                     <head>
    //                     <meta charset="utf-8">
    //                     <meta http-equiv="X-UA-Compatible" content="IE=edge">
    //                     <meta name="viewport" content="width=device-width, initial-scale=1">
    //                     <meta name="description" content="">
    //                     <meta name="author" content="">
    //                     <title>Prescription</title>
    //                     </head>
    //                     <body>
    //                         <table width="100%">
    //                             <tr>
    //                                 <td colspan="2" class="headerLeft">
    //                                     <h3 class="headerH3">'.$name.'</h3>
    //                                     <p>MBBS, FCPS</p>
    //                                     <p>Cheif Consultane</p>
    //                                     <p>Cheif Consultane</p>
    //                                     <p>Cheif Consultane</p>

    //                                 </td>
    //                                 <td colspan="2" class="headerRight">
    //                                     <h3 class="headerH3" style="font-family: nikosh;">ডাঃ মোহাম্মদ সেলিম</h3>
    //                                     <h3  style="font-family: nikosh;">এমবিবিএস, বিসিএস (স্বাস্থ্য)</h3>
    //                                     <h3>এমবিবিএস, বিসিএস (স্বাস্থ্য)</hp2>
    //                                     <hp3>চট্টগ্রাম মেডিকেল কলেজ ও হাসপাতাল</hp3>
    //                                     <hp4>জেনারেল ফিজিশিয়ান ও সিনিয়র কনসালটেন্ট (সার্জারী)</hp4>
    //                                 </td>
    //                             </tr>
    //                             <tr class="pnfo">
    //                                 <td colspan="4" class="pnfoTD">
    //                                     <span class="per50">Name: '.$pName.'</span>
    //                                     <span class="per30">Age: '.$pAge.' Yrs &nbsp;&nbsp; Sex: '.$pSex.'</span>
    //                                     <span class="per20 exRight">Date: '.date('d-m-Y').'</span>
    //                                 </td>
    //                             </tr>
    //                             <tr>
    //                                 <td class="bodyTDleft"></td>
    //                                 <td colspan="3" class="bodyTDRight">
    //                                     <p class="rx">Rx</p>
    //                                     <div class="medicineList">';
    //                                      foreach ($allMedicine as $medRow){
    //                                         '<p>'.$medRow['Name'].' '.$medRow['Doseage'].' '.$medRow['Remark'].'</p>';
    //                                     }   
                                        
    //                                     $html .= '</div>
    //                                 </td>
    //                             </tr>
    //                             <tr class="pfotterTD">
    //                                 <td colspan="2" class="pfotterTD1">
    //                                     <p>Paitent ID: 1405-0012 </p>
    //                                     <p>Next Visit Date: 12-06-2017 </p>
    //                                 </td>
    //                                 <td colspan="2" class="pfotterTD2">
    //                                     <p class="headerH3">Chamber</p>
    //                                     <p>Laxmipur Adhunik Hospital</p>
    //                                     <p>Phone: +880172547888, +88218544444</p>
    //                                 </td>
    //                             </tr>
    //                         </table>
    //                     </body>
    //                 </html>';
        
        
    //     endforeach;

    //     $pdfFilePath = FCPATH."/downloads/prescription/".$currrentDate.".pdf";
    //     //$data['page_title'] = 'Hello world'; // pass data to the view

    //     if (file_exists($pdfFilePath) == FALSE)

    //     {

    //         $this->load->library('pdf');
    //         $dompdf = new Dompdf\Dompdf();
    //         // Set Font Style
    //         $dompdf->set_option('defaultFont', 'Courier');
    //         $dompdf->loadHtml($html);
    //         // To Setup the paper size and orientation
    //         $dompdf->setPaper('A4', 'landscape');
    //         // Render the HTML as PDF
    //         $dompdf->render();
    //         // Get the generated PDF file contents
    //         $pdf = $dompdf->output();
    //         // Output the generated PDF to Browser
    //         $dompdf->stream("My.pdf");
    //     }


    //     $jsonData['filePath'] = $currrentDate;
        
    //     header("Content-Type: application/json");
    //     echo json_encode($jsonData);
    // }

}
