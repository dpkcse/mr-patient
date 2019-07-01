<div class="row">
    <!-- CALENDAR--><div class="col-sm-4">
        <a href="<?php echo base_url(); ?>index.php?doctor/doctor">
            <div class="tile-stats tile-white tile-white-primary">
                <div class="icon"><i class="fa fa-user-md"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('doctor'); ?>"
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('doctor') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-4">
        <a href="<?php echo base_url(); ?>index.php?doctor/patient">
            <div class="tile-stats tile-white-red">
                <div class="icon"><i class="fa fa-user"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('patient'); ?>" 
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('patient') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-4">
        <a href="<?php echo base_url(); ?>index.php?doctor/medicine">
            <div class="tile-stats tile-white-orange">
                <div class="icon"><i class="fa fa-medkit"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('medicine'); ?>" 
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('medicine') ?></h3>
            </div>
        </a>
    </div>
</div>

<br />

<!--

    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?doctor/nurse">
            <div class="tile-stats tile-white-aqua">
                <div class="icon"><i class="fa fa-plus-square"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('nurse'); ?>" 
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('nurse') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?doctor/pharmacist">
            <div class="tile-stats tile-white-blue">
                <div class="icon"><i class="fa fa-medkit"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('pharmacist'); ?>" 
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('pharmacist') ?></h3>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?doctor/laboratorist">
            <div class="tile-stats tile-white-cyan">
                <div class="icon"><i class="fa fa-user"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('laboratorist'); ?>" 
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('laboratorist') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?doctor/accountant">
            <div class="tile-stats tile-white-purple">
                <div class="icon"><i class="fa fa-money"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('accountant'); ?>" 
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('accountant') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?doctor/payment_history">
            <div class="tile-stats tile-white-pink">
                <div class="icon"><i class="fa fa-list-alt"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('invoice'); ?>" 
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('payment') ?></h3>
            </div>
        </a>
    </div>

<div class="row">
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?doctor/operation_report">
            <div class="tile-stats tile-white-green">
                <div class="icon"><i class="fa fa-wheelchair"></i></div>
                <div class="num" data-start="0" data-end="<?php echo count($this->db->get_where('report', array('type' => 'operation'))->result_array());?>" 
                     data-duration="1500" data-delay="0"></div>
                <h3><?php echo get_phrase('operation_report') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?doctor/birth_report">
            <div class="tile-stats tile-white-brown">
                <div class="icon"><i class="fa fa-github-alt"></i></div>
                <div class="num" data-start="0" data-end="<?php echo count($this->db->get_where('report', array('type' => 'birth'))->result_array());?>" 
                     data-duration="1500" data-delay="0"></div>
                <h3><?php echo get_phrase('birth_report') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?doctor/death_report">
            <div class="tile-stats tile-white-plum">
                <div class="icon"><i class="fa fa-ban"></i></div>
                <div class="num" data-start="0" data-end="<?php echo count($this->db->get_where('report', array('type' => 'death'))->result_array());?>" 
                     data-duration="1500" data-delay="0"></div>
                <h3><?php echo get_phrase('death_report') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?doctor/system_settings">
            <div class="tile-stats tile-white-gray">
                <div class="icon"><i class="fa fa-h-square"></i></div>
                <div class="num">&nbsp;</div>
                <h3><?php echo get_phrase('settings') ?></h3>
            </div>
        </a>
    </div>-->
</div>    