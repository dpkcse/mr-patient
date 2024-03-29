<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <!-- <img src="assets/images/logo.png"  style="max-height:60px;"/> -->
                <img src="<?php echo $this->crud_model->get_image_url($this->session->userdata('login_type'), $this->session->userdata('login_user_id'));?>" alt="" style="width:60px; height:60px;border-radius: 50%;">
            </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

                <i class="entypo-menu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>
    <div class="sidebar-user-info">

        <div class="sui-normal">
            <a href="#" class="user-link">
                <!-- <img src="<?php echo $this->crud_model->get_image_url($this->session->userdata('login_type'), $this->session->userdata('login_user_id'));?>" alt="" class="img-circle" style="height:44px;"> -->

                <span><?php echo get_phrase('welcome'); ?>:-</span>
                <strong><?php
                    echo $this->db->get_where($this->session->userdata('login_type'), array($this->session->userdata('login_type') . '_id' =>
                        $this->session->userdata('login_user_id')))->row()->name;
                    ?>
                </strong>
            </a>
        </div>

        <div class="sui-hover inline-links animate-in"><!-- You can remove "inline-links" class to make links appear vertically, class "animate-in" will make A elements animateable when click on user profile -->				
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/profile">
                <i class="entypo-pencil"></i>
                <?php echo get_phrase('edit_profile'); ?>
            </a>

            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/profile">
                <i class="entypo-lock"></i>
                <?php echo get_phrase('change_password'); ?>
            </a>

            <span class="close-sui-popup">×</span><!-- this is mandatory -->			
        </div>
    </div>


    <div style="border-top:1px solid rgba(69, 74, 84, 0.7);"></div>	
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->

        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?doctor">
                <i class="fa fa-desktop"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>

        <li class="<?php if ($page_name == 'manage_department' || $page_name == 'manage_doctor') 
            echo 'opened active';?> ">
                <a href="#">
                    <i class="fa fa-edit"></i>
                    <span><?php echo get_phrase('Doctor'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'manage_department') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?doctor/department">
                            <i class="fa fa-sitemap"></i>
                            <span><?php echo get_phrase('add_department'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'manage_doctor') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?doctor/doctor">
                            <i class="fa fa-user-md"></i>
                            <span><?php echo get_phrase('add_doctor'); ?></span>
                        </a>
                    </li>
                </ul>
        </li>
        <li class="<?php if ($page_name == 'manage_medicine_category' || $page_name == 'manage_medicine' || $page_name == 'manage_medicine_generic') 
            echo 'opened active';?> ">
                <a href="#">
                    <i class="fa fa-edit"></i>
                    <span><?php echo get_phrase('medicine'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'manage_medicine_category') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?doctor/medicine_category">
                            <i class="fa fa-edit"></i>
                            <span><?php echo get_phrase('add_category'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'manage_medicine_generic') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?doctor/medicine_generic_name">
                            <i class="fa fa-edit"></i>
                            <span><?php echo get_phrase('add_generic_name'); ?></span>
                        </a>
                    </li>
                    
                    <li class="<?php if ($page_name == 'manage_medicine') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?doctor/medicine">
                            <i class="fa fa-medkit"></i>
                            <span><?php echo get_phrase('add_trade_name'); ?></span>
                        </a>
                    </li>
                </ul>
        </li>

        <li class="<?php if ($page_name == 'manage_test_category' || $page_name == 'manage_test') 
            echo 'opened active';?> ">
                <a href="#">
                    <i class="fa fa-edit"></i>
                    <span><?php echo get_phrase('test'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'manage_test_category') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?doctor/test_category">
                            <i class="fa fa-edit"></i>
                            <span><?php echo get_phrase('add_category'); ?></span>
                        </a>
                    </li>
                    
                    <li class="<?php if ($page_name == 'manage_test') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?doctor/test">
                            <i class="fa fa-medkit"></i>
                            <span><?php echo get_phrase('add_test_name'); ?></span>
                        </a>
                    </li>
                </ul>
        </li>

        <li class="<?php if ($page_name == 'manage_patient' ||
            ($page_name == 'manage_prescription' && $menu_check == 'from_patient')) echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?doctor/patient">
                    <i class="fa fa-user"></i>
                    <span><?php echo get_phrase('patient'); ?></span>
                </a>
        </li>
        <li class="<?php if ($page_name == 'manage_prescription' && $menu_check == 'from_prescription') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?doctor/prescription">
                <i class="fa fa-stethoscope"></i>
                <span><?php echo get_phrase('prescription'); ?></span>
            </a>
        </li>
        
        
        
        <!--<li class="<?php if ($page_name == 'manage_bed_allotment') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?doctor/bed_allotment">
                <i class="fa fa-hdd-o"></i>
                <span><?php echo get_phrase('bed_allotment'); ?></span>
            </a>
        </li>-->
        
        <!--<li class="<?php if ($page_name == 'show_blood_bank') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?doctor/blood_bank">
                <i class="fa fa-tint"></i>
                <span><?php echo get_phrase('blood_bank'); ?></span>
            </a>
        </li> -->
        
        <!--<li class="<?php if ($page_name == 'manage_report') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?doctor/report">
                <i class="fa fa-hospital-o"></i>
                <span><?php echo get_phrase('report'); ?></span>
            </a>
        </li>-->
        
        <!-- MESSAGE -->

        <li class="<?php if ($page_name == 'message' || $page_name == 'sms_settings') 
            echo 'opened active';?> ">
                <a href="#">
                    <i class="fa fa-edit"></i>
                    <span><?php echo get_phrase('settings'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'message') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?doctor/message">
                            <i class="entypo-mail"></i>
                            <span><?php echo get_phrase('message'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?doctor/sms_settings">
                            <span><i class="entypo-paper-plane"></i> <?php echo get_phrase('sms_settings'); ?></span>
                        </a>
                    </li>
                </ul>
        </li>
        
        
        <li class="<?php if ($page_name == 'edit_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?doctor/profile">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('profile'); ?></span>
            </a>
        </li>

    </ul>

</div>