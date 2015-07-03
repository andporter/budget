<?php
if (isset($login))
{ // show potential errors / feedback (from login object)
    if ($login->errors)
    {
        foreach ($login->errors as $error)
        {
            echo "<div id=\"alertErrors\" class=\"container theme-showcase\">";
            echo "<div class=\"alert alert-danger\" role=\"alert\"><strong>Error: </strong>" . $error;
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
            echo "</div>";
            echo "</div>";
        }
    }
    if ($login->messages)
    {
        foreach ($login->messages as $message)
        {
            echo "<div id=\"alertMessages\" class=\"container theme-showcase\">";
            echo "<div class=\"alert alert-success\" role=\"alert\">" . $message;
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
            echo "</div>";
            echo "</div>";
        }
    }
}

// show potential errors / feedback (from registration object)
if (isset($registration))
{
    if ($registration->errors)
    {
        foreach ($registration->errors as $error)
        {
            echo "<div id=\"alertErrors\" class=\"container theme-showcase\">";
            echo "<div class=\"alert alert-danger\" role=\"alert\"><strong>Error: </strong>" . $error;
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
            echo "</div>";
            echo "</div>";
        }
    }
    if ($registration->messages)
    {
        foreach ($registration->messages as $message)
        {
            echo "<div id=\"alertMessages\" class=\"container theme-showcase\">";
            echo "<div class=\"alert alert-success\" role=\"alert\">" . $message;
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
            echo "</div>";
            echo "</div>";
        }
    }
}
?>

<body>
    <div class='container theme-showcase'>
        <div class="panel panal-content panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"> Cottages of Hope - Budget Assistance</h3>
            </div>
            <div class="panel-body">
                This site does cool stuff
            </div>
        </div>
    </div>

    <div class='container theme-showcase'>
        <div class="row">
            <div class="col-sm-6 centered">
                <div class="panel panal-content panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> New User Registration</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="index.php?register" name="registerform">
                            <input id="login_input_username" class="login_input form-control" type="text" placeholder=" Choose a Username" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required /><br>
                            <input id="login_input_email" class="login_input form-control" type="email" placeholder=" Email" name="user_email" required /><br>
                            <input id="login_input_password_new" class="login_input form-control" type="password" name="user_password_new" placeholder=" Password" pattern=".{6,}" required autocomplete="off" /><br>
                            <input id="login_input_password_repeat" class="login_input form-control" type="password" name="user_password_repeat" placeholder=" Repeat Password" pattern=".{6,}" required autocomplete="off" /><br>
                            <input type="submit"  name="register" value="Register" class="btn btn-primary pull-right" />
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 centered">
                <div class="panel panal-content panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> User Login</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="index.php?budgets" name="loginform">
                            <input id="login_input_username" class="login_input form-control" type="text" name="user_name" placeholder=" Username" required/><br>
                            <input id="login_input_password" class="login_input form-control" type="password" name="user_password" placeholder=" Password" autocomplete="off" required/><br>
                            <input type="submit"  name="login" value="Login" class="btn btn-primary pull-right" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $(function () {
            window.setTimeout(function () {
                $("#alertErrors").fadeTo(1500, 0).slideUp(500, function () {
                    $(this).remove();
                });
                $("#alertMessages").fadeTo(1500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 5000);

            $("[rel=tooltip]").tooltip({placement: 'right'});
        });
    </script>
</body>