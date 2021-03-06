<!DOCTYPE html>
<?php
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<'))
{
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !" . " Your PHP Version: " . PHP_VERSION);
}
else if (version_compare(PHP_VERSION, '5.5.0', '<'))
{
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    require_once("libraries/password_compatibility_library.php");
}

// include the configs / constants for the database connection
require_once("config/config.php");

if (HTTPS_required === "TRUE" && $_SERVER['HTTPS'] != 'on')
{
    exit("This website requires a secure HTTPS connection!");
}

// load the login class & registration class
require_once("classes/Login.php");
require_once("classes/Registration.php");
require_once("classes/Budget.php");

// create a login & registration object. when this object is created, it will do all login/logout stuff automatically
$login = new Login();
$registration = new Registration();
$budget = new Budget();

require_once("views/globalCSS.php");
require_once("views/globalJS.php");

if ($login->isUserLoggedIn() == true)  //the user is logged in.
{
    switch (key($_GET))
    {
        case "budgets":
            {
                require("views/logged_in/user_header_menu.php");

                if ($login->userHasBugdet() == true) //Already has at least one budget. Show list of budgets.
                {
                    require("views/logged_in/budgets.php");
                }
                else //No existing budget.
                {
                    $budget->createNewBudget($budgetName="Current",$budgetIdToDuplicate="new");
                    require("views/logged_in/user_header_menu.php");
                    require("views/logged_in/demographicsForm.php");
                    require("views/logged_in/incomeForm.php");
                }
            }
            break;

        case "editincomebudget":
            {
                if ($_GET['editincomebudget'] == "new")
                {
                    $budget->createNewBudget($budgetName=$_GET['budgetname'],$budgetIdToDuplicate="new");
                }
                else // set the user session budgetId to the budgetId supplied in the url
                {
                    $_SESSION['user_budgetid'] = $_GET['editincomebudget'];
                }

                if ($budget->errors)
                {
                    require("views/logged_in/user_header_menu.php");
                    require("views/logged_in/budgets.php");
                }
                else
                {
                    require("views/logged_in/user_header_menu.php");
                    require("views/logged_in/incomeForm.php");
                }
            }
            break;

        case "editexpensebudget":
            {
                if ($budget->errors)
                {
                    require("views/logged_in/user_header_menu.php");
                    require("views/logged_in/budgets.php");
                }
                else
                {
                    require("views/logged_in/user_header_menu.php");
                    require("views/logged_in/expenseForm.php");
                }
            }
            break;

        case "duplicatebudget":
            {
                $budget->createNewBudget($budgetName=$_GET['budgetname'],$budgetIdToDuplicate=$_GET['duplicatebudget']); //duplicate passed in budgetId

                if ($budget->errors)
                {
                    require("views/logged_in/user_header_menu.php");
                    require("views/logged_in/budgets.php");
                }
                else
                {
                    require("views/logged_in/user_header_menu.php");
                    require("views/logged_in/incomeForm.php");
                }
            }
            break;

        case "budgetreview":
            {
                require("views/logged_in/user_header_menu.php");

                if ($_GET['budgetreview'] == "income")
                {
                    require("views/logged_in/incomeReview.php");
                }
                elseif ($_GET['budgetreview'] == "expense")
                {
                    require("views/logged_in/expenseReview.php");
                }
                elseif ($_GET['budgetreview'] == "budget")
                {
                    require("views/logged_in/budgetReview.php");
                }
            }
            break;

        case "settings":
            {
                require("views/logged_in/user_header_menu.php");
                require("views/logged_in/demographicsForm.php");
                require("views/logged_in/user_settings.php");
            }
            break;

        default:
            {
                require("views/logged_in/user_header_menu.php");
                require("views/logged_in/budgets.php");
            }
            break;
    }
}
else //the user is not logged in.
{
    require("views/not_logged_in/header_menu.php");
    require("views/not_logged_in/introLogin.php");
}