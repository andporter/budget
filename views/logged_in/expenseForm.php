<?php
include_once('GetIncomeOrExpenseForm.php');
?>
<div class='container theme-showcase'>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php
        for ($i = 1; $i <= 9; $i++)
        {
            getIncomeOrExpenseForm("Expense", $i);
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