<?php

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
    deliver_json_response($response);
}

// --- Step 2: Process Request
switch ($_GET['method'])
{
    case "userGetBudgets":
        {
            try
            {
                if ($login->isUserLoggedIn() == true) //requires login
                {
                    $db_connection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

                    //create temp table to calculate the max dateUpdated for the budget
                    $sql = $db_connection->prepare("DROP TEMPORARY TABLE IF EXISTS budgetDetailDateUpdated; CREATE TEMPORARY TABLE budgetDetailDateUpdated (SELECT budgetId, MAX(dateUpdated) dateUpdated from budgetDetail GROUP BY budgetId);");
                    $sql->execute();

                    $adminquery = "SELECT CONCAT(u.firstName, ' ', u.lastName) as name, b.budgetId, b.budgetName, b.dateCreated, IF(b.dateUpdated > bddu.dateUpdated, b.dateUpdated, bddu.dateUpdated) dateUpdated, u.userName, IF(b.isBaseline='1','Yes','No') isBaseline FROM budget b JOIN users u ON (b.userId = u.userId) JOIN budgetDetailDateUpdated bddu ON (bddu.budgetId = b.budgetId)";

                    if ($_SESSION['user_type'] == "Admin")
                    {
                        $sql = $db_connection->prepare($adminquery);
                    }
                    else //not admin user, filter to only show the logged in user's budgets
                    {
                        $userquery = $adminquery . "WHERE u.userId = :userId";

                        $sql = $db_connection->prepare($userquery);

                        $sql->bindParam(':userId', $_SESSION['user_id']);
                    }

                    if ($sql->execute())
                    {
                        $ResultsToReturn = $sql->fetchAll(PDO::FETCH_ASSOC);
                        $response['code'] = 1;
                        $response['data'] = $ResultsToReturn;
                    }
                    else
                    {
                        $response['code'] = 0;
                        $response['data'] = $sql->errorInfo();
                    }
                }
                else //not logged in
                {
                    $response['code'] = 3;
                    $response['data'] = $api_response_code[$response['code']]['Message'];
                }
            }
            catch (Exception $e)
            {
                $response['code'] = 0;
                $response['data'] = $e->getMessage();
            }

            $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
            deliver_json_response($response);
        }
        break;

    case "userUpdateBudgetName":
        {
            try
            {
                if ($login->isUserLoggedIn() == true) //requires login
                {
                    $jsonData = json_decode($_POST["data"], true);
                    $db_connection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

                    $sql = $db_connection->prepare("UPDATE budget SET budgetName = :budgetName WHERE budgetId = :budgetId");

                    $sql->bindParam(':budgetName', $jsonData['updateBudgetName']);

                    foreach (explode(",", $jsonData['budgetIds']) as $budgetId)
                    {
                        $sql->bindParam(':budgetId', $budgetId);
                        $sql->execute();
                    }

                    $response['code'] = 1;
                    $response['data'] = $api_response_code[$response['code']]['Message'];
                }
                else //not logged in
                {
                    $response['code'] = 3;
                    $response['data'] = $api_response_code[$response['code']]['Message'];
                }
            }
            catch (Exception $e)
            {
                $response['code'] = 0;
                $response['data'] = $e->getMessage();
            }

            $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
            deliver_json_response($response);
        }
        break;

    case "userDeleteBudget":
        {
            try
            {
                if ($login->isUserLoggedIn() == true) //requires login
                {
                    $jsonData = json_decode($_POST["data"], true);
                    $db_connection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

                    $sql = $db_connection->prepare("DELETE FROM budget WHERE budgetId = :budgetId");

                    foreach ($jsonData as $budgetId)
                    {
                        $sql->bindParam(':budgetId', $budgetId);
                        $sql->execute();
                    }

                    $response['code'] = 1;
                    $response['data'] = $api_response_code[$response['code']]['Message'];
                }
                else //not logged in
                {
                    $response['code'] = 3;
                    $response['data'] = $api_response_code[$response['code']]['Message'];
                }
            }
            catch (Exception $e)
            {
                $response['code'] = 0;
                $response['data'] = $e->getMessage();
            }

            $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
            deliver_json_response($response);
        }
        break;

    case "userToggleBudgetBaseline":
        {
            try
            {
                if ($login->isUserLoggedIn() == true) //requires login
                {
                    $jsonData = json_decode($_POST["data"], true);
                    $db_connection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

                    $sql = $db_connection->prepare("UPDATE budget SET isBaseline = !isBaseline WHERE budgetId = :budgetId");

                    foreach ($jsonData as $budgetId)
                    {
                        $sql->bindParam(':budgetId', $budgetId);
                        $sql->execute();
                    }

                    $response['code'] = 1;
                    $response['data'] = $api_response_code[$response['code']]['Message'];
                }
                else //not logged in
                {
                    $response['code'] = 3;
                    $response['data'] = $api_response_code[$response['code']]['Message'];
                }
            }
            catch (Exception $e)
            {
                $response['code'] = 0;
                $response['data'] = $e->getMessage();
            }

            $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
            deliver_json_response($response);
        }
        break;

    case "userBudgetFormSubmit":
        {
            try
            {
                if ($login->isUserLoggedIn() == true) //requires login
                {
                    $jsonData = json_decode($_POST["data"], true);
                    $db_connection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

                    foreach ($jsonData as $row)
                    {
                        $who_budgetDetailId_categoryId = explode("_", $row["name"]);

                        $who = $who_budgetDetailId_categoryId[0];
                        $budgetDetailId = $who_budgetDetailId_categoryId[1];
                        $categoryId = $who_budgetDetailId_categoryId[2];

                        if ($who == "self")
                        {
                            $sql = $db_connection->prepare("UPDATE budgetDetail SET budgetSelfAmount = :budgetSelfAmount WHERE budgetDetailId = :budgetDetailId AND budgetId = :budgetId AND categoryId = :categoryId");

                            $sql->bindParam(':budgetSelfAmount', $row["value"]);
                        }
                        elseif ($who == "spouse")
                        {
                            $sql = $db_connection->prepare("UPDATE budgetDetail SET budgetSpouseAmount = :budgetSpouseAmount WHERE budgetDetailId = :budgetDetailId AND budgetId = :budgetId AND categoryId = :categoryId");

                            $sql->bindParam(':budgetSpouseAmount', $row["value"]);
                        }

                        $sql->bindParam(':budgetDetailId', $budgetDetailId);
                        $sql->bindParam(':budgetId', $_SESSION['user_budgetid']);
                        $sql->bindParam(':categoryId', $categoryId);

                        $sql->execute();
                    }

                    $response['code'] = 1;
                    $response['data'] = $api_response_code[$response['code']]['Message'];
                }
                else //not logged in
                {
                    $response['code'] = 3;
                    $response['data'] = $api_response_code[$response['code']]['Message'];
                }
            }
            catch (Exception $e)
            {
                $response['code'] = 0;
                $response['data'] = $e->getMessage();
            }

            $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
            deliver_json_response($response);
        }
        break;

    case "userDemographicsFormSubmit":
        {
            try
            {
                if ($login->isUserLoggedIn() == true) //requires login
                {
                    $jsonData = json_decode($_POST["data"], true);
                    $db_connection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

                    $sql = $db_connection->prepare("UPDATE users SET firstName = :firstName, lastName = :lastName, phone = :phone, phoneCanText = :phoneCanText, isMarried = :isMarried, spouseFirstName = :spouseFirstName, spouseLastName = :spouseLastName, spouseEmail = :spouseEmail, dependent0_4 = :dependent0_4, dependent5_18 = :dependent5_18, dependentAdditional = :dependentAdditional WHERE userId = :userId");

                    $phone = $jsonData['phoneAreaCode'] . '-' . $jsonData['phoneFirstThree'] . '-' . $jsonData['phoneLastFour'];

                    $sql->bindParam(':firstName', $jsonData["firstName"]);
                    $sql->bindParam(':lastName', $jsonData["lastName"]);
                    $sql->bindParam(':phone', $phone);
                    $sql->bindParam(':phoneCanText', $jsonData["phoneCanText"]);
                    $sql->bindParam(':isMarried', $jsonData["isMarried"]);
                    $sql->bindParam(':spouseFirstName', $jsonData["spouseFirstName"]);
                    $sql->bindParam(':spouseLastName', $jsonData["spouseLastName"]);
                    $sql->bindParam(':spouseEmail', $jsonData["spouseEmail"]);
                    $sql->bindParam(':dependent0_4', $jsonData["dependent0_4"]);
                    $sql->bindParam(':dependent5_18', $jsonData["dependent5_18"]);
                    $sql->bindParam(':dependentAdditional', $jsonData["dependentAdditional"]);
                    $sql->bindParam(':userId', $_SESSION['user_id']);

                    if ($sql->execute())
                    {
                        $response['code'] = 1;
                        $response['data'] = $api_response_code[$response['code']]['Message'];
                    }
                    else
                    {
                        $response['code'] = 0;
                        $response['data'] = $sql->errorInfo();
                    }
                }
                else //not logged in
                {
                    $response['code'] = 3;
                    $response['data'] = $api_response_code[$response['code']]['Message'];
                }
            }
            catch (Exception $e)
            {
                $response['code'] = 0;
                $response['data'] = $e->getMessage();
            }

            $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
            deliver_json_response($response);
        }
        break;
}

/**
 * Deliver HTTP Response
 * @param string $api_response The desired HTTP response data
 * @return void (will echo json or xlsx)
 * */
function deliver_json_response($api_response)
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

    // Set HTTP Response Content Type
    header('Content-Type: application/json; charset=utf-8');

    // Deliver JSON formatted data
    echo json_encode($api_response);

    // End script process, error log is just to output a log... not really an error.
    error_log('UserType: ' . $_SESSION['user_type'] . ', UserName: ' . $_SESSION['user_name'] . ', Method: ' . $_GET['method']);
    exit;
}