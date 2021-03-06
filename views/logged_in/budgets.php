<?php
date_default_timezone_set('America/Denver');
?>

<div id="divBudgets" class="container-fluid" role="main">
    <div id="budgetTableToolbar" class="btn-group">
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-plus"></i> Add <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#AddBudgetConfirmModal" data-toggle="modal" title="Add New Budget">New</a></li>
                <li><a href="#" id="duplicateConfirmButton" title="Duplicate Selected Budget">Duplicate</a></li>
            </ul>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-edit"></i> Edit <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#" id="editConfirmButton" title="Edit Selected Budget">Edit Budget</a></li>
                <li><a href="#UpdateBudgetNameModal" data-toggle="modal" title="Update Selected Budget Name">Edit Name</a></li>
                <?php
                if ($_SESSION['user_type'] == "Admin")
                {
                    ?>
                    <li><a href="#" id="baselineConfirmButton" title="Toggle Selected Baseline">Baseline</a></li>
                <?php } ?>
            </ul>
        </div>
        <a href="#DeleteBudgetConfirmModal" data-toggle="modal" role="button" class="btn btn-default" data-placement="bottom" title="Delete Selected Budget"><i class="glyphicon glyphicon-trash"></i> Delete</a>
    </div>
    <table id="budgetTable"
           data-click-to-select="true"
           data-search="true"
           data-toolbar-align="left"
           data-toolbar="#budgetTableToolbar"
           data-classes="table table-hover table-condensed"
           data-pagination="true"
           data-page-size="20"
           data-height="650"
           data-maintain-selected="true"
           data-striped="true"
           data-sort-name="name"
           data-sort-order="desc"
           data-sortable="true">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="true"></th>
                <th class="col-xs-2" data-field="name" data-sortable="true">Name</th>
                <th class="col-xs-5" data-field="budgetName" data-sortable="true">Budget Name</th>
                <th class="col-xs-1" data-field="isBaseline" data-sortable="true">Baseline</th>
                <th class="col-xs-2" data-field="dateCreated" data-sortable="true">Date Created</th>
                <th class="col-xs-2" data-field="dateUpdated" data-sortable="true">Date Updated</th>
            </tr>
        </thead>
    </table>
</div>

<div id="AddBudgetConfirmModal" class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content well">
            <div class="modal-header">
                <h4><span class="glyphicon glyphicon-plus"></span> Confirm New</h4>
            </div>
            <div class="modal-body">
                <p>Enter the new Budget Name</p>
                <input id="newBudgetName" name="newBudgetName" type="text" placeholder="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" id="addConfirmButton" class="btn btn-success btn-ok">New</a>
            </div>
        </div>
    </div>
</div>

<div id="UpdateBudgetNameModal" class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content well">
            <div class="modal-header">
                <h4><span class="glyphicon glyphicon-edit"></span> Update Budget Name</h4>
            </div>
            <div class="modal-body">
                <p>Enter the new Budget Name</p>
                <input id="updateBudgetName" name="updateBudgetName" type="text" placeholder="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" id="updateNameConfirmButton" class="btn btn-primary btn-ok" title="Update Budget Name">Update</a>
            </div>
        </div>
    </div>
</div>

<div id="DeleteBudgetConfirmModal" class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content well">
            <div class="modal-header">
                <h4><span class="glyphicon glyphicon-trash"></span> Confirm Delete</h4>
            </div>
            <div class="modal-body">
                <p>Delete the selected budget(s)?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger btn-ok" id="deleteConfirmButton" title="Delete Selected Budget">Delete</a>
            </div>
        </div>
    </div>
</div>

<script>
    $('#progressBarModal').modal('show');

    AjaxSubmit_getBudgets();

    function AjaxSubmit_getBudgets()
    {
        var postJSONData = '{}';
        SendAjax("api/api.php?method=userGetBudgets", postJSONData, AjaxSuccess_getBudgets, true);
    }

    function AjaxSuccess_getBudgets(returnJSONData)
    {
        $('#budgetTable').bootstrapTable({data: returnJSONData.data});
        $('#budgetTable').bootstrapTable('load', returnJSONData.data);

        setTimeout(function () {
            $('#progressBarModal').modal('hide');
        }, 1000);
    }

    function getSelectedRowIDs(dataformat)
    {
        var selectedTableRows = $('#budgetTable').bootstrapTable('getAllSelections');
        var selectedTableRowIDs = new Array();

        selectedTableRows.forEach(function (obj)
        {
            selectedTableRowIDs.push(obj.budgetId);
        });

        if (dataformat === 'json')
        {
            return JSON.stringify(selectedTableRowIDs);
        }
        else
        {
            return selectedTableRowIDs;
        }
    }

    $('#updateNameConfirmButton').click(function ()
    {
        $('#UpdateBudgetNameModal').modal('hide');
        $('#progressBarModal').modal('show');

        var updateBudgetName = $('input[name=updateBudgetName]').val();

        var postJSONData = '{"updateBudgetName" : "' + updateBudgetName +
                '","budgetIds" : "' + getSelectedRowIDs() +
                '"}';

        SendAjax("api/api.php?method=userUpdateBudgetName", postJSONData, AjaxSubmit_getBudgets, true);
    });

    $('#baselineConfirmButton').click(function ()
    {
        $('#progressBarModal').modal('show');

        var postJSONData = getSelectedRowIDs("json");
        SendAjax("api/api.php?method=userToggleBudgetBaseline", postJSONData, AjaxSubmit_getBudgets, true);
    });
    
    $('#addConfirmButton').click(function ()
    {
        window.location.href = "index.php?editincomebudget=new&budgetname=" + $('input[name=newBudgetName]').val();
    });

    $('#editConfirmButton').click(function ()
    {
        window.location.href = "index.php?editincomebudget=" + getSelectedRowIDs();
    });

    $('#duplicateConfirmButton').click(function ()
    {
        var rowdata = $('#budgetTable').bootstrapTable('getSelections');
        console.log(rowdata[0]);
        console.log(rowdata[0].budgetName);
        window.location.href = "index.php?duplicatebudget=" + rowdata[0].budgetId + "&budgetname=Duplicate of " + rowdata[0].budgetName;
    });

    $('#deleteConfirmButton').click(function ()
    {
        $('#DeleteBudgetConfirmModal').modal('hide');
        $('#progressBarModal').modal('show');

        var postJSONData = getSelectedRowIDs("json");
        SendAjax("api/api.php?method=userDeleteBudget", postJSONData, AjaxSubmit_getBudgets, true);
    });

</script>