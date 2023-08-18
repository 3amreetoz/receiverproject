<?php
defined('MOODLE_INTERNAL') || die();
// Define your external API functions
$functions = array(
    'local_getpayment_save_data' => array(
        'classname' => 'local_getpayment_external',
        'methodname' => 'save_data',
        'description' => 're form data to se Moodle instance',
        'classpath'   => 'local/getpayment/externallib.php', 
        'type' => 'write',
        'capabilities' => '',
    ),
);
$services = array(
    'Local savepayment' => array(
        'functions' => array(

            "local_getpayment_save_data"
        ),
        'restrictedusers' => 0,
        'enabled' => 1,
    ),
);
