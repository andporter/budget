<?php
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

<div id="divChangePassword" class="container theme-showcase">
    <div class="panel panal-content panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-cog"></span> Change Password For: <em><?php echo $_SESSION['user_name']; ?></em></h3>
        </div>
        <div class="panel-body">
            <form method="post" action="index.php?settings" name="passwordChangeForm">
                <label for="login_input_password_old">Old Password:</label>
                <input id="login_input_password_old" class="login_input form-control" type="password" name="user_password_old" placeholder=" Old Password" pattern=".{6,}" required autocomplete="off" /><br>
                <label for="login_input_password_new">New Password (min. 6 characters):</label>
                <input id="login_input_password_new" class="login_input form-control" type="password" name="user_password_new" placeholder=" New Password" pattern=".{6,}" required autocomplete="off" /><br>
                <label for="login_input_password_repeat">Repeat New password:</label>
                <input id="login_input_password_repeat" class="login_input form-control" type="password" name="user_password_repeat" placeholder=" Repeat New Password" pattern=".{6,}" required autocomplete="off" /><br>
                <input type="submit"  name="changepassword" value="Change Password" class="btn btn-primary pull-right" />
            </form>
        </div>
    </div>
</div>

<!--<div id="divDeleteUser" class="container theme-showcase">
    <div class="panel panal-content panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-cog"></span> Delete User: <em><?php echo $_SESSION['user_name']; ?></em></h3>
        </div>
        <div class="panel-body">
            <div class="alert alert-danger" role="alert">
                <strong>Warning: </strong>This will delete your account and you will be logged out. Please ensure you have another admin account you can use.
            </div>
            <form method="post" action="index.php?settings" name="registerform">
                <label for="login_input_password">Account Password:</label>
                <input id="login_input_password" class="login_input form-control" type="password" name="user_password" placeholder=" Account Password" pattern=".{6,}" required autocomplete="off" /><br>
                <input type="submit"  name="deleteuser" value="Delete User" class="btn btn-danger pull-right" />
            </form>
        </div>
    </div>
</div>-->

<script>

</script>