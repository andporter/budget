<?php
date_default_timezone_set('America/Denver');
?>

<div id="divBudgets" class="container-fluid" role="main">
    <div id="budgetTableToolbar" class="btn-group">
        <a href="#DeleteContactsConfirmModal" data-toggle="modal" rel="tooltip" role="button" class="btn btn-default" data-placement="bottom" title="Delete Selected"><i class="glyphicon glyphicon-trash"></i></a>
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
           data-show-footer="true"
           data-striped="true"
           data-sort-name="date"
           data-sort-order="desc"
           data-sortable="true">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="true"></th>
                <th class="col-xs-3" data-field="dateCreated" data-sortable="true">Date Created</th>
                <th class="col-xs-3" data-field="dateUpdated" data-sortable="true">Date Updated</th>
                <th class="col-xs-6" data-field="budgetName" data-sortable="true">Budget Name</th>
            </tr>
        </thead>
    </table>
</div>

<div id="DeleteContactsConfirmModal" class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content well">
            <div class="modal-header">
                <h4><span class="glyphicon glyphicon-trash"></span> Confirm Delete</h4>
            </div>
            <div class="modal-body">
                <p>Delete the selected contacts?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger btn-ok" id="deleteConfirmButton">Yes, Delete</a>
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
    
    function getSelectedRowIDs()
    {
        var jsonInboxContacts = $('#budgetTable').bootstrapTable('getSelections');
        var inboxContactIDs = new Array();
        jsonInboxContacts.forEach(function (obj) {
            inboxContactIDs.push(obj.id);
        });
        return JSON.stringify(inboxContactIDs);
    }
    
    $('#deleteConfirmButton').click(function (e)
    {
        $('#DeleteContactsConfirmModal').modal('hide');
        $('#progressBarModal').modal('show');
        
        if (e.handled !== true) //Checking for the event whether it has occurred or not.
        { 
            e.handled = true;
            
            var postJSONData = getSelectedRowIDs();
            SendAjax("api/api.php?method=adminDeleteInboxContact", postJSONData, AjaxSuccess_DeleteORIncrementContacts, true);
        }
    });

</script>