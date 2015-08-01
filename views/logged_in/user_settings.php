
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

<?php
if ($_SESSION['user_type'] == "Admin")
{
    ?>
    <div id="divRegisterUser" class="container theme-showcase">
        <div class="panel panal-content panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-cog"></span> Register New Admin User</h3>
            </div>
            <div class="panel-body">
                <form method="post" action="index.php?settings" name="registerform">
                    <label for="login_input_username">Username (only letters and numbers, 2 to 64 characters):</label>
                    <input id="login_input_username" class="login_input form-control" type="text" placeholder=" Username" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required /><br>
                    <label for="login_input_email">User's email:</label>
                    <input id="login_input_email" class="login_input form-control" type="email" placeholder=" Email" name="user_email" required /><br>
                    <label for="login_input_password_new">Password (min. 6 characters):</label>
                    <input id="login_input_password_new" class="login_input form-control" type="password" name="user_password_new" placeholder=" Password" pattern=".{6,}" required autocomplete="off" /><br>
                    <label for="login_input_password_repeat">Repeat password:</label>
                    <input id="login_input_password_repeat" class="login_input form-control" type="password" name="user_password_repeat" placeholder=" Repeat Password" pattern=".{6,}" required autocomplete="off" /><br>
                    <input type="submit"  name="registeradmin" value="Register" class="btn btn-primary pull-right" />
                </form>
            </div>
        </div>
    </div>

    <div id="divDeleteUser" class="container theme-showcase">
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
    </div>
<?php } ?>

<script>

</script>