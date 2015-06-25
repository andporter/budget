<?php

/*
  Input: $_GET['method'] = []

  Output: A JSON formatted HTTP response

  Original Script: thtp://markroland.com/blog/restful-php-api/
 */

require_once("../classes/Login.php");
require_once("../config/config.php");
$login = new Login();

date_default_timezone_set('America/Denver');

// Set default HTTP response
$response['code'] = 0;
$response['status'] = 404;
$response['data'] = NULL;

// Define API response codes AND their related HTTP response
$api_response_code = array(
    0 => array('HTTP Response' => 400, 'Message' => 'Unknown Error'),
    1 => array('HTTP Response' => 200, 'Message' => 'Success'),
    2 => array('HTTP Response' => 403, 'Message' => 'HTTPS Required'),
    3 => array('HTTP Response' => 401, 'Message' => 'Authentication Required'),
    4 => array('HTTP Response' => 401, 'Message' => 'Authentication Failed'),
    5 => array('HTTP Response' => 404, 'Message' => 'Invalid Request'),
    6 => array('HTTP Response' => 400, 'Message' => 'Invalid Response Format')
);

// --- Step 1: Optionally require connections to be made via HTTPS
if (HTTPS_required === "TRUE" && $_SERVER['HTTPS'] != 'on')
{
    $response['code'] = 2;
    $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
    $response['data'] = $api_response_code[$response['code']]['Message'];

    // Return Response to browser. This will exit the script.
    deliver_response($response);
}

// --- Step 2: Process Request
switch ($_GET['method'])
{
    case "hello":
        {
            $response['code'] = 1;
            $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
            $response['data'] = 'Hello World';
        }
        break;

    case "adminHello":
        {
            if ($login->isUserLoggedIn() == true) //requires login
            {
                $response['code'] = 1;
                $response['data'] = 'Hello World';
            }
            else //user not logged in
            {
                $response['code'] = 3;
                $response['data'] = $api_response_code[$response['code']]['Message'];
            }

            $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
        }
        break;
}

// --- Step 3: Deliver Response
deliver_response($response, $_GET['format'], $_GET['filename']);


/**
 * Deliver HTTP Response
 * @param string $api_response The desired HTTP response data
 * @return void (will echo json or xlsx)
 * */
function deliver_response($api_response, $format, $filename)
{
    // Define HTTP responses
    $http_response_code = array(
        200 => 'OK',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found'
    );

    // Set HTTP Response
    header('HTTP/1.1 ' . $api_response['status'] . ' ' . $http_response_code[$api_response['status']]);

    // Process different content types
    if (strcasecmp($format, 'excel') == 0)
    {
        require_once("../classes/PHPExcel.php");

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getActiveSheet()->fromArray(array_keys($api_response['data'][0]), NULL, 'A1'); //header row
        $objPHPExcel->getActiveSheet()->fromArray($api_response['data'], NULL, 'A2'); //data rows
        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }
    else //json is default
    {
        // Set HTTP Response Content Type
        header('Content-Type: application/json; charset=utf-8');

        // Deliver JSON formatted data
        echo json_encode($api_response);
    }

    // End script process
    exit;
}