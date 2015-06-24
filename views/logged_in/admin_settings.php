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

<div id="divEditCOHContact" class="container theme-showcase">
    <div class="panel panal-content panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-cog"></span> Edit CoH Contact</h3>
        </div>
        <div class="panel-body">
            <form id="formAdminEditCOHContact" data-parsley-validate>
                <label for="COHfirstName">CoH First Name:</label>
                <input type="text" class="form-control" id="COHfirstName" placeholder="COH First Name" required data-parsley-required-message="Please enter the COH First Name">
                <br>
                <label for="COHlastName">CoH Last Name:</label>
                <input type="text" class="form-control" id="COHlastName" placeholder="COH Last Name" required data-parsley-required-message="Please enter the COH Last Name">
                <br>
                <label for="COHemail">CoH Email:</label>
                <input type="email" class="form-control" id="COHemail" placeholder="COH Email" required data-parsley-required-message="Please enter the COH Email Address"/>
                <br>
                <label for="COHphone">CoH Phone:</label>
                <input type="text" class="form-control" id="COHphone" placeholder="COH Phone" required data-parsley-required-message="Please enter the COH Phone Number"/>
                <br>
                <button type="button" id="buttonSave_formAdminEditCOHContact" data-loading-text="Saving..." class="btn btn-primary pull-right" autocomplete="off">Save</button>
            </form>
        </div>
    </div>
</div>

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
                <input type="submit"  name="register" value="Register" class="btn btn-primary pull-right" />
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

<script>
    AjaxSubmit_GetCOHContact();

    function AjaxSubmit_GetCOHContact()
    {
        var postJSONData = '{}';
        SendAjax("api/api.php?method=getCOHContact", postJSONData, AjaxSuccess_GetCOHContact, false);
    }

    function AjaxSuccess_GetCOHContact(returnJSONData)
    {
        $('#COHfirstName').val(returnJSONData.data[0].firstname);
        $('#COHlastName').val(returnJSONData.data[0].lastname);
        $('#COHemail').val(returnJSONData.data[0].email);
        $('#COHphone').val(returnJSONData.data[0].phone);
    }

    $('#buttonSave_formAdminEditCOHContact').on('click', function ()
    {
        var btn = $(this).button('loading')

        var newCOHfirstName = ($('#COHfirstName').val());
        var newCOHlastName = ($('#COHlastName').val());
        var newCOHemail = ($('#COHemail').val());
        var newCOHphone = ($('#COHphone').val());

        var postJSONData = '{"newCOHfirstName" : "' + newCOHfirstName +
                '","newCOHlastName" : "' + newCOHlastName +
                '","newCOHemail" : "' + newCOHemail +
                '","newCOHphone" : "' + newCOHphone +
                '"}';

        SendAjax("api/api.php?method=adminUpdateCOHContact", postJSONData, "none", true);

        setTimeout(function () {
            btn.button('reset')
        }, 1500)
    })
</script>