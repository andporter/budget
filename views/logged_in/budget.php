<?php 
date_default_timezone_set('America/Denver');
?>

<div id="divInboxContacts" class="container-fluid" role="main">
    <div id="inboxToolbar" class="btn-group">
        <a href="#IncrementCountConfirmModal" data-toggle="modal" rel="tooltip" role="button" class="btn btn-default" data-placement="bottom" title="Increment Selected"><i class="glyphicon glyphicon-plus"></i></a>
        <a href="#DeleteContactsConfirmModal" data-toggle="modal" rel="tooltip" role="button" class="btn btn-default" data-placement="bottom" title="Delete Selected"><i class="glyphicon glyphicon-trash"></i></a>
        <a href="api/api.php?method=adminGetInboxContacts&format=excel&filename=Expungement%20Contacts%20<?php echo date('m-d-Y'); ?>" rel="tooltip" role="button" class="btn btn-default" data-placement="bottom" title="Export to Excel"><i class="glyphicon glyphicon-export"></i></a>
    </div>
    <table id="inboxTable"
           data-click-to-select="true"
           data-search="true"
           data-toolbar-align="left"
           data-toolbar="#inboxToolbar"
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
                <th class="col-xs-2" data-field="date" data-sortable="true">Date</th>
                <th class="col-xs-2" data-field="firstname" data-sortable="true">First Name</th>
                <th class="col-xs-2" data-field="lastname" data-sortable="true">Last Name</th>
                <th class="col-xs-2" data-field="phone" data-sortable="true">Phone</th>
                <th class="col-xs-3" data-field="email" data-sortable="true">Email</th>
                <th class="col-xs-1" data-field="contactattempts" data-sortable="true">Contact Attempts</th>
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

<div id="IncrementCountConfirmModal" class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content well">
            <div class="modal-header">
                <h4><span class="glyphicon glyphicon glyphicon-plus"></span> Confirm Increment</h4>
            </div>
            <div class="modal-body">
                <p>Increment the selected contact attempts?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-success btn-ok" id="incrementConfirmButton">Yes, Increment</a>
            </div>
        </div>
    </div>
</div>

<script>
    $('#progressBarModal').modal('show');
    
    AjaxSubmit_getInboxContacts();

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

    $('#incrementConfirmButton').click(function (e)
    {
        $('#IncrementCountConfirmModal').modal('hide');
        $('#progressBarModal').modal('show');
        
        if (e.handled !== true) //Checking for the event whether it has occurred or not.
        { 
            e.handled = true;
            
            var postJSONData = getSelectedRowIDs();

            SendAjax("api/api.php?method=adminIncrementInboxContactAttempt", postJSONData, AjaxSuccess_DeleteORIncrementContacts, true);
        }

    });
    
    function AjaxSuccess_DeleteORIncrementContacts()
    {
        AjaxSubmit_getInboxContacts();
    }

    function getSelectedRowIDs()
    {
        var jsonInboxContacts = $('#inboxTable').bootstrapTable('getSelections');
        var inboxContactIDs = new Array();

        jsonInboxContacts.forEach(function (obj) {
            inboxContactIDs.push(obj.id);
        });

        return JSON.stringify(inboxContactIDs);
    }

    function AjaxSubmit_getInboxContacts()
    {
        var postJSONData = '{}';
        SendAjax("api/api.php?method=adminGetInboxContacts", postJSONData, AjaxSuccess_getInboxContacts, true);
    }

    function AjaxSuccess_getInboxContacts(returnJSONData)
    {
        $('#inboxTable').bootstrapTable({data: returnJSONData.data});
        $('#inboxTable').bootstrapTable('load', returnJSONData.data);

        setTimeout(function () {
            $('#progressBarModal').modal('hide');
        }, 1000);
    }

</script>