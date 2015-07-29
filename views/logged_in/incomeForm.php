<?php
include_once('GetIncomeOrExpenseForm.php');

?>
<div class='container theme-showcase'>
    <div class="panel-group" id="accordion">
        <?php
        for ($i = 1; $i <= 3; $i++)
        {
            getIncomeOrExpenseForm("Income", $i);
        }
        ?>
    </div>
</div>

<script type = "text/javascript">
    function submitForm(form) {
        var postJSONData = $(form).serializeArray();
        postJSONData = JSON.stringify(postJSONData);
        SendAjax("api/api.php?method=userBudgetFormSubmit", postJSONData, "none", true);
    }
</script>
</body>