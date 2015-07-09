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
                    require("views/logged_in/budgets.php");
//                    require("views/logged_in/demographicsForm.php");
//                    require("views/logged_in/incomeForm.php");
                }
            }
            break;

        case "editbudget":
            {
                $budget = new Budget();
                
                if ($_GET['editbudget'] == "new")
                {
                    $budget->createNewBudget();
                }
                else
                {
                    $_SESSION['user_budgetid'] = $_GET['editbudget'];
                }

                if ($budget->getNumberOfUserBudgets() >= MAX_BUDGETS)
                {
                    require("views/logged_in/user_header_menu.php");
                    require("views/logged_in/budgets.php");
                }
                else
                {
                    require("views/logged_in/user_header_menu.php");
//                    require("views/logged_in/demographicsForm.php");
                    require("views/logged_in/incomeForm.php");
                }
            }
            break;

        case "settings":
            {
                // show the register view (with the registration form, and messages/errors)
                require("views/logged_in/user_header_menu.php");
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
    switch (key($_GET))
    {
        case "register":
        default:
            {
                // show the register view (with the registration form, and messages/errors)
                require("views/not_logged_in/header_menu.php");
                require("views/not_logged_in/introLogin.php");
            }
            break;
    }
}