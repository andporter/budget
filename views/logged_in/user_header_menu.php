<?php 

//function echoActiveClassIfRequestMatches($requestUri)
//{
//    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
//
//    if ($current_file_name == $requestUri)
//    {
//        echo 'class="active"';
//    }  
//}

?>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid" id="navfluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigationbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php?budgets">Cottages of Hope</a>
        </div>
        <div class="collapse navbar-collapse" id="navigationbar">
            <ul class="nav navbar-nav">
                <li><a href="index.php?budgets"><span class="glyphicon glyphicon glyphicon-inbox"></span> Budgets</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo ucwords($_SESSION['user_name']); ?><span class="caret"></span>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?settings"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                            <li><a href="#adminLogoutConfirmModal" id="logout" data-toggle="modal"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li> 
                        </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="adminLogoutConfirmModal" class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content well">
            <div class="modal-header">
                <h4><span class="glyphicon glyphicon-log-out"></span> Logout</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to logout?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="index.php?logout" class="btn btn-danger btn-ok">Yes, Logout</a>
            </div>
        </div>
    </div>
</div>

<div id="progressBarModal" class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content well">
            <h4><span class="glyphicon glyphicon-hourglass"></span> Loading...</h4>
            <div class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" style="width: 100%"></div>
            </div>
        </div>
    </div>
</div>

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

if (isset($budget))
{
    if ($budget->errors)
    {
        foreach ($budget->errors as $error)
        {
            echo "<div id=\"alertErrors\" class=\"container theme-showcase\">";
            echo "<div class=\"alert alert-danger\" role=\"alert\"><strong>Error: </strong>" . $error;
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
            echo "</div>";
            echo "</div>";
        }
    }
    if ($budget->messages)
    {
        foreach ($budget->messages as $message)
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
    });
    
</script>