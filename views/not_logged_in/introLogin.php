
<body>
    <div class='container theme-showcase'>
        <div class="panel panal-content panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Basic Budget Builder</h3>
            </div>
            <div class="panel-body">
                <center><img src="images/Cottages of Hope Logo.jpg" alt=""/></center>
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
            $("[rel=tooltip]").tooltip({placement: 'right'});
        });
    </script>
</body>