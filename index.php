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

// Define whether an HTTPS connection is required
$HTTPS_required = FALSE;

if ($HTTPS_required && $_SERVER['HTTPS'] != 'on')
{
    exit("This website requires a secure HTTPS connection!");
}

// include the configs / constants for the database connection
require_once("config/db.php");

// load the login class
require_once("classes/Login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
$login = new Login();

require_once("views/globalCSS.php");
require_once("views/globalJS.php");

if ($login->isUserLoggedIn() == true)  //the user is logged in.
{
    switch (key($_GET))
    {
        case "reports":
            {
                require("views/logged_in/admin_header_menu.php");
                require("views/logged_in/reports.php");
            }
            break;

        case "expungementForm":
            {
                //show the expungement page and then log out
                require("views/not_logged_in/header_menu.php");
                require("views/logged_in/expungement_form.php");
                $login->doLogout();
            }
            break;

        case "settings":
            {
                // load the registration class
                require_once("classes/Registration.php");

                // create the registration object. when this object is created, it will do all registration stuff automatically
                $registration = new Registration();

                // show the register view (with the registration form, and messages/errors)
                require("views/logged_in/admin_header_menu.php");
                require("views/logged_in/admin_settings.php");
            }
            break;

        //inbox is the default
        case "inbox":
        default:
            {
                require("views/logged_in/admin_header_menu.php");
                require("views/logged_in/inbox.php");
            }
            break;
    }
}
else //the user is not logged in.
{
    switch (key($_GET))
    {
        case "info":
            {
                
            }
            break;

        default:
            {
                require("views/not_logged_in/header_menu.php");
                require("views/not_logged_in/initial_form.php");
            }
            break;
    }
}