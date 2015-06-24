
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid" id="navfluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigationbar">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
            <a class="navbar-brand" href="index.php">Cottages of Hope</a>
        </div>
        <div class="collapse navbar-collapse" id="navigationbar">
            <ul class="nav navbar-nav">

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Login<span class="caret"></span>
                    <ul class="dropdown-menu">
                        <li><a href="#adminLoginModal" data-toggle="modal"><span class="glyphicon glyphicon-log-in"></span>  Admin Login</a></li>
                        <li><a href="#expungementFormLoginModal" data-toggle="modal"><span class="glyphicon glyphicon-list-alt"></span>  Expungment Form</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="adminLoginModal" class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content well">
            <form method="post" action="index.php?inbox" data-parsley-validate>
                <div class="modal-header">
                    <h4><span class="glyphicon glyphicon-log-in"></span> Admin Login</h4>
                </div>
                <div class="modal-body">
                    <p><input id="admin_login_input_username" class="login_input form-control" type="text" name="user_name" placeholder=" Username" required minlength="2" data-parsley-required-message="Please enter your username"/></p>
                    <p><input id="admin_login_input_password" class="login_input form-control" type="password" name="user_password" placeholder=" Password" autocomplete="off" required minlength="2" data-parsley-required-message="Please enter your password" /></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="login" value="Login" class="btn btn-success btn-ok">                 
                </div>
            </form>
        </div>
    </div>
</div>

<div id="expungementFormLoginModal" class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content well">
            <form method="post" action="index.php?expungementForm" data-parsley-validate>
                <div class="modal-header">
                    <h4><span class="glyphicon glyphicon-list-alt"></span> Expungment Form Login</h4>
                </div>
                <div class="modal-body">
                    <p><input id="login_input_username" class="login_input form-control" type="text" name="user_name" placeholder=" Username" required minlength="2" data-parsley-required-message="Please enter your username"/></p>
                    <p><input id="login_input_password" class="login_input form-control" type="password" name="user_password" placeholder=" Password" autocomplete="off" required minlength="2" data-parsley-required-message="Please enter your password" /></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="login" value="Show Form" class="btn btn-success btn-ok">                 
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#adminLoginModal').on('shown.bs.modal', function () {
        $('#admin_login_input_username').focus();
    });
    
    $('#expungementFormLoginModal').on('shown.bs.modal', function () {
        $('#login_input_username').focus();
    });
</script>