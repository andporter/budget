
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

<script>

</script>