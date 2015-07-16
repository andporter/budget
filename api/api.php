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
    case "userGetBudgets":
        {
            try
            {
                if ($login->isUserLoggedIn() == true) //requires login
                {
                    $db_connection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

                    if ($_SESSION['user_type'] == "Regular")
                    {
                        $sql = $db_connection->prepare("SELECT b.budgetId, b.budgetName, b.dateCreated, b.dateUpdated, u.userName FROM budget b JOIN users u ON (b.userId = u.userId) WHERE u.userId = :userId");
                        $sql->bindParam(':userId', $_SESSION['user_id']);
                    } elseif ($_SESSION['user_type'] == "Admin")
                    {
                        $sql = $db_connection->prepare("SELECT b.budgetId, b.budgetName, b.dateCreated, b.dateUpdated, u.userName FROM budget b JOIN users u ON (b.userId = u.userId)");
                    }

                    if ($sql->execute())
                    {
                        $ResultsToReturn = $sql->fetchAll(PDO::FETCH_ASSOC);
                        $response['code'] = 1;
                        $response['data'] = $ResultsToReturn;
                        $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
                    }
                } else //not logged in
                {
                    $response['code'] = 3;
                    $response['data'] = $api_response_code[$response['code']]['Message'];
                    $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
                }
            } catch (Exception $e)
            {
                $response['code'] = 0;
                $response['data'] = $e->getMessage();
                $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
            }
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
                    $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
                } else //not logged in
                {
                    $response['code'] = 3;
                    $response['data'] = $api_response_code[$response['code']]['Message'];
                    $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
                }
            } catch (Exception $e)
            {
                $response['code'] = 0;
                $response['data'] = $e->getMessage();
                $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
            }
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
                            $sql = $db_connection->prepare("UPDATE budgetDetail SET amount = :amount WHERE budgetDetailId = :budgetDetailId AND budgetId = :budgetId AND categoryId = :categoryId");

                            $sql->bindParam(':amount', $row["value"]);
                        } elseif ($who == "spouse")
                        {
                            $sql = $db_connection->prepare("UPDATE budgetDetail SET spouseAmount = :spouseAmount WHERE budgetDetailId = :budgetDetailId AND budgetId = :budgetId AND categoryId = :categoryId");

                            $sql->bindParam(':spouseAmount', $row["value"]);
                        }

                        $sql->bindParam(':budgetDetailId', $budgetDetailId);
                        $sql->bindParam(':budgetId', $_SESSION['user_budgetid']);
                        $sql->bindParam(':categoryId', $categoryId);

                        $sql->execute();
                    }

                    $response['code'] = 1;
                    $response['data'] = $api_response_code[$response['code']]['Message'];
                    $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
                } else //not logged in
                {
                    $response['code'] = 3;
                    $response['data'] = $api_response_code[$response['code']]['Message'];
                    $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
                }
            } catch (Exception $e)
            {
                $response['code'] = 0;
                $response['data'] = $e->getMessage();
                $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
            }
        }
        break;
}

// --- Step 3: Deliver Response
deliver_response($response);

/**
 * Deliver HTTP Response
 * @param string $api_response The desired HTTP response data
 * @return void (will echo json or xlsx)
 * */
function deliver_response ($api_response)
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

    // End script process
    exit;
}
