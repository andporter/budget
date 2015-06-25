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
?>

<body>
    <form id="formInitial" data-parsley-validate>
        <div id="divInital" class="container theme-showcase">
            <div class="panel panal-content panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Initial Expungement Questionnaire</h3>
                </div>
                <div class="panel-body">

                    <input type="submit" value="Submit" class="btn btn-primary pull-right" />
                </div>
            </div>
        </div>
    </form>

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
</body>
