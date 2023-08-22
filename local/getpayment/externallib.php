<?php

use dml_exception;
use stdClass;
use local_getpayment\manager;
use core_external\external_api;
use core_external\external_function_parameters;
use core_external\external_single_structure;
use core_external\external_value;


require_once(__DIR__ . '/../../config.php'); // Adjust the path as needed
require_once($CFG->libdir . '/externallib.php');
require_once($CFG->dirroot . '/user/lib.php');
require_once($CFG->dirroot . '/course/lib.php');

class local_getpayment_external extends external_api
{

    public static function save_data_parameters()
    {
        return new external_function_parameters(
            array(
                // 'username' => new external_value(PARAM_TEXT, 'User Name'),
                'firstname' => new external_value(PARAM_TEXT, 'First Name'),
                'lastname' => new external_value(PARAM_TEXT, 'Last Name'),
                'email' => new external_value(PARAM_EMAIL, 'Email'),
                'phone' => new external_value(PARAM_RAW_TRIMMED, 'Phone'),
                'country' => new external_value(PARAM_TEXT, 'Country'),
                'certificatename' => new external_value(PARAM_TEXT, 'Certificate Name'),
                'courseid' => new external_value(PARAM_TEXT, 'Course Id'),
                'cost' => new external_value(PARAM_TEXT, 'Cost'),
                'coursename' => new external_value(PARAM_TEXT, 'course name'),
            )

        );
    }
    public static function save_data( $firstname,  $lastname,  $email,  $phone,  $country,  $certificatename, $courseid, $cost, $coursename)
    {
        $params = self::validate_parameters(
            self::save_data_parameters(),
            array('firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'phone' => $phone, 'country' => $country, 'certificatename' => $certificatename, 'courseid'=>$courseid, 'cost' => $cost, 'coursename'=> $coursename)
        );

        // Create the notification using the manager class
        $manager = new manager();
        $result = $manager->create_payment(
            // $params['username'],
            $params['firstname'],
            $params['lastname'],
            $params['email'],
            $params['phone'],
            $params['country'],
            $params['certificatename'],
            $params['courseid'],
            $params['cost'],
            $params['coursename']
        );
        if ($result) {
            return array(
                'success' => true,
                'urlredirect' => 'http://localhost/57/lms/local/notifi/manage.php'
            );
        } else {
            return array(
                'success' => false,
                'urlredirect' => 'Failed to create payment form'
            );
        }
    }

    public static function save_data_returns()
    {
        return new external_single_structure([
            'success' => new external_value(PARAM_BOOL, 'Whether the form processing was successful'),
            'urlredirect' => new external_value(PARAM_TEXT, 'Response message'),


        ]);
    }
}
