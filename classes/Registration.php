<?php

/**
 * Class registration
 * handles the user registration
 */
class Registration
{

    /**
     * @var object $db_connection The database connection
     */
    private $db_connection = null;

    /**
     * @var array $errors Collection of error messages
     */
    public $errors = array();

    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$registration = new Registration();"
     */
    public function __construct()
    {
        //        foreach ($_POST as $key => $value)
        //        {
        //            echo $key . '=' . $value . '<br />';
        //        }

        if (isset($_POST["register"]))
        {
            $this->registerNewUser($user_type = "Regular");
        }
        if (isset($_POST["registeradmin"]))
        {
            $this->registerNewUser($user_type = "Admin");
        }
        else if (isset($_POST["changepassword"]))
        {
            $this->changePassword();
        }
        else if (isset($_POST["deleteuser"]))
        {
            $this->deleteUser();
        }
    }

    /**
     * handles the entire registration process. checks all error possibilities
     * and creates a new user in the database if everything is fine
     */
    private function registerNewUser($user_type = "Regular")
    {
        if (empty($_POST['user_name']))
        {
            $this->errors[] = "Empty Username";
        }
        elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat']))
        {
            $this->errors[] = "Empty Password";
        }
        elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat'])
        {
            $this->errors[] = "Password and password repeat are not the same";
        }
        elseif (strlen($_POST['user_password_new']) < 6)
        {
            $this->errors[] = "Password has a minimum length of 6 characters";
        }
        elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2)
        {
            $this->errors[] = "Username cannot be shorter than 2 or longer than 64 characters";
        }
        elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name']))
        {
            $this->errors[] = "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters";
        }
        elseif (empty($_POST['user_email']))
        {
            $this->errors[] = "Email cannot be empty";
        }
        elseif (strlen($_POST['user_email']) > 64)
        {
            $this->errors[] = "Email cannot be longer than 64 characters";
        }
        elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL))
        {
            $this->errors[] = "Your email address is not in a valid email format";
        }
        elseif (!empty($_POST['user_name']) && strlen($_POST['user_name']) <= 64 && strlen($_POST['user_name']) >= 2 && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name']) && !empty($_POST['user_email']) && strlen($_POST['user_email']) <= 64 && filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL) && !empty($_POST['user_password_new']) && !empty($_POST['user_password_repeat']) && ($_POST['user_password_new'] === $_POST['user_password_repeat'])
        )
        {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8"))
            {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno)
            {

                // escaping, additionally removing everything that could be (html/javascript-) code
                $user_name = $this->db_connection->real_escape_string(strip_tags($_POST['user_name'], ENT_QUOTES));
                $user_email = $this->db_connection->real_escape_string(strip_tags($_POST['user_email'], ENT_QUOTES));

                $user_password = $_POST['user_password_new'];

                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

                // check if user or email address already exists
                $sql = "SELECT * FROM users WHERE userName = '" . $user_name . "' OR userEmail = '" . $user_email . "';";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1)
                {
                    $this->errors[] = "Sorry, that username / email address is already taken.";
                }
                else
                {
                    // write new user's data into database
                    $sql = "INSERT INTO users (userName, userType, userPasswordHash, userEmail) VALUES('" . $user_name . "','" . $user_type . "', '" . $user_password_hash . "', '" . $user_email . "');";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    // if user has been added successfully
                    if ($query_new_user_insert)
                    {
                        $this->messages[] = "Your account has been created successfully! You can now login!";
                    }
                    else
                    {
                        $this->errors[] = "Sorry, your registration failed. Please go back and try again.";
                    }
                }
            }
            else
            {
                $this->errors[] = "Sorry, no database connection.";
            }
        }
        else
        {
            $this->errors[] = "An unknown error occurred.";
        }
    }

    /**
     * allows the user to change their password
     */
    private function changePassword()
    {
        if (empty($_POST['user_password_old']) || empty($_POST['user_password_new']) || empty($_POST['user_password_repeat']))
        {
            $this->errors[] = "Empty Password.";
        }
        elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat'])
        {
            $this->errors[] = "Password and password repeat are not the same.";
        }
        elseif (strlen($_POST['user_password_new']) < 6)
        {
            $this->errors[] = "Password has a minimum length of 6 characters.";
        }
        else //ready to try and change the password
        {
            // create a database connection, using the constants from config/db.php (which we loaded in index.php)
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8"))
            {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno)
            {
                // database query, getting password hash to verify old password
                $sql = "SELECT userPasswordHash FROM users WHERE userName = '" . $_SESSION['user_name'] . "';";
                $result_of_login_check = $this->db_connection->query($sql);

                // if this user exists
                if ($result_of_login_check->num_rows == 1)
                {
                    // get result row (as an object)
                    $result_row = $result_of_login_check->fetch_object();

                    // using PHP 5.5's password_verify() function to check if the provided password fits
                    // the hash of that user's password
                    if (password_verify($_POST['user_password_old'], $result_row->userPasswordHash))
                    {
                        $user_password = $_POST['user_password_new'];

                        // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                        // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                        // PHP 5.3/5.4, by the password hashing compatibility library
                        $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

                        // write user's new password into database
                        $sql = "UPDATE users SET userPasswordHash = '" . $user_password_hash . "' WHERE userName = '" . $_SESSION['user_name'] . "';";
                        $query_change_password = $this->db_connection->query($sql);

                        // if user has been added successfully
                        if ($query_change_password)
                        {
                            $this->messages[] = "Your password has been updated successfully!";
                        }
                        else
                        {
                            $this->errors[] = "Failed to change password!";
                        }
                    }
                    else
                    {
                        $this->errors[] = "Old password does not match!";
                    }
                }
                else
                {
                    $this->errors[] = "User does not exist. Try again.";
                }
            }
            else
            {
                $this->errors[] = "Database connection problem.";
            }
        }
    }

    /**
     * allows the user to delete their account
     */
    private function deleteUser()
    {
        if (empty($_POST['user_password']))
        {
            $this->errors[] = "Empty Password";
        }
        else //ready to try and change the password
        {
            // create a database connection, using the constants from config/db.php (which we loaded in index.php)
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8"))
            {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno)
            {
                // database query, getting password hash to verify old password
                $sql = "SELECT userPasswordHash FROM users WHERE userName = '" . $_SESSION['user_name'] . "';";
                $result_of_login_check = $this->db_connection->query($sql);

                // if this user exists
                if ($result_of_login_check->num_rows == 1)
                {
                    // get result row (as an object)
                    $result_row = $result_of_login_check->fetch_object();

                    // using PHP 5.5's password_verify() function to check if the provided password fits
                    // the hash of that user's password
                    if (password_verify($_POST['user_password'], $result_row->userPasswordHash))
                    {
                        // write user's new password into database
                        $sql = "DELETE from users WHERE userName = '" . $_SESSION['user_name'] . "';";
                        $query_delete_account = $this->db_connection->query($sql);

                        // if user has been added successfully
                        if ($query_delete_account)
                        {
                            //Account has been deleted and this will redirect and logout
                            header('Location: index.php?deleteuserlogout');
                        }
                        else
                        {
                            $this->errors[] = "Failed to change password!";
                        }
                    }
                    else
                    {
                        $this->errors[] = "Wrong Account Password!";
                    }
                }
                else
                {
                    $this->errors[] = "User does not exist. Try again.";
                }
            }
            else
            {
                $this->errors[] = "Database connection problem.";
            }
        }
    }
}