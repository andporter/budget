<?php
date_default_timezone_set('America/Denver');
?>

<div class="container-fluid" role="main">
    <div class="well">
        <div>
            <h4><p>Report Date Range:</p></h4>
            <input type="text" placeholder="yyyy-mm-dd" value="<?php echo date('Y-m-01'); ?>" id="fromdatepicker"/>
            <span class="add-on">to</span>
            <input type="text" placeholder="yyyy-mm-dd" value="<?php echo date('Y-m-d'); ?>" id="todatepicker"/>
            <input type="submit" id="runReports" value="Run Reports" class="btn btn-sm btn-success btn-ok">
        </div>
    </div>
</div>

<div id="reports" class="container-fluid" role="main">
    <div class="row">
        <div  class="col-md-2">
            <div id="panelInitialFormAttemptedSuccess" class="panel panal-content panel-primary collapse">
                <div class="panel-heading">
                    <a href="#" onclick="exportToExcel('adminReportGetInitialFormAttemptedSuccess', 'Initial%20Form%20Attempts');
                            return false;" rel="tooltip" class="btn-sm btn-default pull-right" title="Export to Excel"><i class="glyphicon glyphicon-export"></i></a>
                    <h3 class="panel-title">Initial Attempts</h3>
                </div>
                <div class="panel-body">
                    <table id="tableInitialFormAttemptedSuccess"
                           data-height="96"
                           data-sortable="false">
                        <thead>
                            <tr>
                                <th data-field="attempts">Attempt</th>
                                <th data-field="success">Success</th>
                            </tr>
                        </thead>
                    </table>
                    <div id="pieChartInitialFormAttemptedSuccess"></div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div id="panelInitialFormFrequentylMissed" class="panel panal-content panel-primary collapse">
                <div class="panel-heading">
                    <a href="#" onclick="exportToExcel('adminReportGetInitialFormFrequentlyMissed', 'Initial%20Form%20Frequently%20Missed');
                            return false;" rel="tooltip" class="btn-sm btn-default pull-right" title="Export to Excel"><i class="glyphicon glyphicon-export"></i></a>
                    <a href="#" onclick="exportToExcel('adminReportGetInitialMonthlyTotals', 'Initial%20Monthly%20Totals');
                            return false;" rel="tooltip" class="btn-sm btn-default pull-right" title="Monthly Totals Export to Excel"><i class="glyphicon glyphicon-calendar"></i><i class="glyphicon glyphicon-export"></i></a>
                    <h3 class="panel-title">Initial Frequently Missed</h3>
                </div>
                <div class="panel-body">
                    <table id="initialFormFrequentylMissed"
                           data-height="96"
                           data-sortable="false">
                        <thead>
                            <tr>
                                <th data-field="q1">Q1</th>
                                <th data-field="q2">Q2</th>
                                <th data-field="q3">Q3</th>
                                <th data-field="q4">Q4</th>
                                <th data-field="q5">Q5</th>
                                <th data-field="q6">Q6</th>
                                <th data-field="q7">Q7</th>
                                <th data-field="q8">Q8</th>
                                <th data-field="q9">Q9</th>
                                <th data-field="q10">Q10</th>
                                <th data-field="q11">Q11</th>
                                <th data-field="q12">Q12</th>
                            </tr>
                        </thead>
                    </table>
                    <div id="barChartInitialFormFrequentylMissed"></div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div id="panelInitialTANFQuestions" class="panel panal-content panel-primary collapse">
                <div class="panel-heading">
                    <a href="#" onclick="exportToExcel('adminReportGetInitialTanfQuestions', 'Initial%20TANF%20Questions');
                            return false;" rel="tooltip" class="btn-sm btn-default pull-right" title="Export to Excel"><i class="glyphicon glyphicon-export"></i></a>
                    <h3 class="panel-title">Initial TANF</h3>
                </div>
                <div class="panel-body">
                    <table id="InitialTANFQuestions"
                           data-height="96"
                           data-sortable="false">
                        <thead>
                            <tr>
                                <th data-field="tanfYes">Yes</th>
                                <th data-field="tanfNo">No</th>
                            </tr>
                        </thead>
                    </table>
                    <div id="pieChartInitialTANFQuestions"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div  class="col-md-2">
            <div id="panelExpungmentFormAttemptedSuccess" class="panel panal-content panel-primary collapse">
                <div class="panel-heading">
                    <a href="#" onclick="exportToExcel('adminReportGetExpungmentFormAttemptedSuccess', 'Expungement%20Attempts');
                            return false;" rel="tooltip" class="btn-sm btn-default pull-right" title="Export to Excel"><i class="glyphicon glyphicon-export"></i></a>
                    <h3 class="panel-title">Expungement Attempts</h3>
                </div>
                <div class="panel-body">
                    <table id="tableExpungmentFormAttemptedSuccess"
                           data-height="96"
                           data-sortable="false">
                        <thead>
                            <tr>
                                <th data-field="attempts">Attempt</th>
                                <th data-field="success">Success</th>
                            </tr>
                        </thead>
                    </table>
                    <div id="pieChartExpungmentFormAttemptedSuccess"></div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div id="panelExpungmentFormFrequentylMissed" class="panel panal-content panel-primary collapse">
                <div class="panel-heading">
                    <a href="#" onclick="exportToExcel('adminReportGetExpungementFormFrequentlyMissed', 'Expungement%20Frequently%20Missed');return false;" rel="tooltip" class="btn-sm btn-default pull-right" title="Export to Excel"><i class="glyphicon glyphicon-export"></i></a>
                    <a href="#" onclick="exportToExcel('adminReportGetExpungementMonthlyTotals', 'Expungement%20Monthly%20Totals');return false;" rel="tooltip" class="btn-sm btn-default pull-right" title="Monthly Totals Export to Excel"><i class="glyphicon glyphicon-calendar"></i><i class="glyphicon glyphicon-export"></i></a>
                    <h3 class="panel-title">Expungement Frequently Missed</h3>
                </div>
                <div class="panel-body">
                    <table id="expungmentFormFrequentylMissed"
                           data-height="96"
                           data-sortable="false">
                        <thead>
                            <tr>
                                <th data-field="q1">Q1</th>
                                <th data-field="q2">Q2</th>
                                <th data-field="q3a">Q3a</th>
                                <th data-field="q3b">Q3b</th>
                                <th data-field="q4a">Q4a</th>
                                <th data-field="q4b">Q4a</th>
                                <th data-field="q5a">Q5a</th>
                                <th data-field="q5b">Q5b</th>
                                <th data-field="q6a">Q6a</th>
                                <th data-field="q6b">Q6b</th>
                                <th data-field="q7">Q7</th>
                                <th data-field="q8">Q8</th>
                                <th data-field="q9">Q9</th>
                                <th data-field="q10">Q10</th>
                                <th data-field="q11">Q11</th>
                                <th data-field="q12">Q12</th>
                                <th data-field="q13">Q13</th>
                                <th data-field="q14">Q14</th>
                                <th data-field="q15">Q15</th>
                                <th data-field="q16">Q16</th>
                                <th data-field="q17">Q17</th>
                            </tr>
                        </thead>
                    </table>
                    <div id="barChartExpungmentFormFrequentylMissed"></div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div id="panelExpungementTANFQuestions" class="panel panal-content panel-primary collapse">
                <div class="panel-heading">
                    <a href="#" onclick="exportToExcel('adminReportGetExpungementTanfQuestions', 'Expungement%20TANF%20Questions');
                            return false;" rel="tooltip" class="btn-sm btn-default pull-right" title="Export to Excel"><i class="glyphicon glyphicon-export"></i></a>
                    <h3 class="panel-title">Expungement TANF</h3>
                </div>
                <div class="panel-body">
                    <table id="ExpungementTANFQuestions"
                           data-height="96"
                           data-sortable="false">
                        <thead>
                            <tr>
                                <th data-field="tanfYes">Yes</th>
                                <th data-field="tanfNo">No</th>
                            </tr>
                        </thead>
                    </table>
                    <div id="pieChartExpungementTANFQuestions"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#progressBarModal').modal('show');

    google.load('visualization', '1', {'packages': ['corechart']});
    google.setOnLoadCallback(runReports);

    $(function ()
    {
        $("#fromdatepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            showButtonPanel: true,
            showOtherMonths: true,
            selectOtherMonths: true
        });

        $("#todatepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            showButtonPanel: true,
            showOtherMonths: true,
            selectOtherMonths: true
        });
    });

    $('#runReports').click(function ()
    {
        runReports();
    });

    function runReports()
    {
        $('#progressBarModal').modal('show');

        setTimeout(
                function ()
                {
                    AjaxSubmit_AdminReportGetInitialFormAttemptedSuccess();
                }, 0);
        setTimeout(
                function ()
                {
                    AjaxSubmit_AdminReportGetInitialFormFrequentlyMissed();
                }, 300);
        setTimeout(
                function ()
                {
                    AjaxSubmit_AdminReportGetInitialTanfQuestions();
                }, 600);
        setTimeout(
                function ()
                {
                    AjaxSubmit_AdminReportGetExpungementFormAttemptedSuccess();
                }, 900);
        setTimeout(
                function ()
                {
                    AjaxSubmit_AdminReportGetExpungementFormFrequentlyMissed();
                }, 1200);
        setTimeout(
                function ()
                {
                    AjaxSubmit_AdminReportGetExpungementTanfQuestions();
                }, 1500);
    }

    function getFromDateAndTime()
    {
        return $("#fromdatepicker").val() + '%20' + '00:00:00';
    }

    function getToDateAndTime()
    {
        return $("#todatepicker").val() + '%20' + '23:59:59';
    }

    function getFromDate()
    {
        return $("#fromdatepicker").val();
    }

    function getToDate()
    {
        return $("#todatepicker").val();
    }

    function getBarColor(value, max, min, mean, stdev)
    {
        if (value === max)
        {
            return "Crimson";
        }
        else if (value === min)
        {
            return "DarkGreen";
        }

        if (value >= (mean + (2 * stdev))) //Group 6
        {
            return "Crimson";
        }
        else if (value >= (mean + stdev)) //Group 5
        {
            return "DarkOrange";
        }
        else if (value >= (mean)) //Group 4
        {
            return "Gold";
        }
        else if (value >= (mean - stdev)) //Group 3
        {
            return "YellowGreen";
        }
        else if (value >= (mean - (2 * stdev))) //Group 2
        {
            return "OliveDrab";
        }
        else if (value >= 0) //Group 1
        {
            return "DarkGreen";
        }
    }

    function AjaxSubmit_AdminReportGetInitialFormAttemptedSuccess()
    {
        var postJSONData = {};
        SendAjax("api/api.php?method=adminReportGetInitialFormAttemptedSuccess&fromDate=" + getFromDateAndTime() + "&toDate=" + getToDateAndTime() + "", postJSONData, AjaxSuccess_AdminReportGetInitialFormAttemptedSuccess, true);
    }

    function AjaxSuccess_AdminReportGetInitialFormAttemptedSuccess(returnJSONData)
    {
        $('#tableInitialFormAttemptedSuccess').bootstrapTable({data: returnJSONData.data});
        $('#tableInitialFormAttemptedSuccess').bootstrapTable('load', returnJSONData.data);

        $("#panelInitialFormAttemptedSuccess").fadeIn();

        var data = google.visualization.arrayToDataTable([
            ['Key', 'Value'],
            ['Fail', parseInt(returnJSONData.data[0].attempts) - parseInt(returnJSONData.data[0].success)],
            ['Success', parseInt(returnJSONData.data[0].success)]
        ]);

        drawPieChart(data, 'pieChartInitialFormAttemptedSuccess');
        closeProgressBarWhenReportsAreLoaded();
    }

    function AjaxSubmit_AdminReportGetInitialFormFrequentlyMissed()
    {
        var postJSONData = {};
        SendAjax("api/api.php?method=adminReportGetInitialFormFrequentlyMissed&fromDate=" + getFromDateAndTime() + "&toDate=" + getToDateAndTime() + "", postJSONData, AjaxSuccess_AdminReportGetInitialFormFrequentlyMissed, true);
    }

    function AjaxSuccess_AdminReportGetInitialFormFrequentlyMissed(returnJSONData)
    {
        $('#initialFormFrequentylMissed').bootstrapTable({data: returnJSONData.data});
        $('#initialFormFrequentylMissed').bootstrapTable('load', returnJSONData.data);

        var array = [];

        for (var x in returnJSONData.data[0]) {
            array.push(parseInt(returnJSONData.data[0][x]));
        }

        var max = math.max(array);
        var min = math.min(array);
        var mean = math.mean(array);
        var stdev = math.std(array);

        $("#panelInitialFormFrequentylMissed").fadeIn();

        var data = google.visualization.arrayToDataTable([
            ['Question', 'Value', {role: 'style'}],
            ['Q1', array[0], getBarColor(array[0], max, min, mean, stdev)],
            ['Q2', array[1], getBarColor(array[1], max, min, mean, stdev)],
            ['Q3', array[2], getBarColor(array[2], max, min, mean, stdev)],
            ['Q4', array[3], getBarColor(array[3], max, min, mean, stdev)],
            ['Q5', array[4], getBarColor(array[4], max, min, mean, stdev)],
            ['Q6', array[5], getBarColor(array[5], max, min, mean, stdev)],
            ['Q7', array[6], getBarColor(array[6], max, min, mean, stdev)],
            ['Q8', array[7], getBarColor(array[7], max, min, mean, stdev)],
            ['Q9', array[8], getBarColor(array[8], max, min, mean, stdev)],
            ['Q10', array[9], getBarColor(array[9], max, min, mean, stdev)],
            ['Q11', array[10], getBarColor(array[10], max, min, mean, stdev)],
            ['Q12', array[11], getBarColor(array[11], max, min, mean, stdev)]
        ]);

        drawBarChart(data, 'barChartInitialFormFrequentylMissed');
        closeProgressBarWhenReportsAreLoaded();
    }

    function AjaxSubmit_AdminReportGetInitialTanfQuestions()
    {
        var postJSONData = {};
        SendAjax("api/api.php?method=adminReportGetInitialTanfQuestions&fromDate=" + getFromDateAndTime() + "&toDate=" + getToDateAndTime() + "", postJSONData, AjaxSuccess_AdminReportGetInitialTanfQuestions, true);
    }

    function AjaxSuccess_AdminReportGetInitialTanfQuestions(returnJSONData)
    {
        $('#InitialTANFQuestions').bootstrapTable({data: returnJSONData.data});
        $('#InitialTANFQuestions').bootstrapTable('load', returnJSONData.data);

        $("#panelInitialTANFQuestions").fadeIn();

        var data = google.visualization.arrayToDataTable([
            ['Question', 'Value'],
            ['Yes', parseInt(returnJSONData.data[0].tanfYes)],
            ['No', parseInt(returnJSONData.data[0].tanfNo)]
        ]);

        drawPieChart(data, 'pieChartInitialTANFQuestions');
        closeProgressBarWhenReportsAreLoaded();
    }

    function AjaxSubmit_AdminReportGetExpungementFormAttemptedSuccess()
    {
        var postJSONData = {};
        SendAjax("api/api.php?method=adminReportGetExpungmentFormAttemptedSuccess&fromDate=" + getFromDateAndTime() + "&toDate=" + getToDateAndTime() + "", postJSONData, AjaxSuccess_AdminReportGetExpungementFormAttemptedSuccess, true);
    }

    function AjaxSuccess_AdminReportGetExpungementFormAttemptedSuccess(returnJSONData)
    {
        $('#tableExpungmentFormAttemptedSuccess').bootstrapTable({data: returnJSONData.data});
        $('#tableExpungmentFormAttemptedSuccess').bootstrapTable('load', returnJSONData.data);

        $("#panelExpungmentFormAttemptedSuccess").fadeIn();

        var data = google.visualization.arrayToDataTable([
            ['Key', 'Value'],
            ['Fail', parseInt(returnJSONData.data[0].attempts) - parseInt(returnJSONData.data[0].success)],
            ['Success', parseInt(returnJSONData.data[0].success)]
        ]);

        drawPieChart(data, 'pieChartExpungmentFormAttemptedSuccess');
        closeProgressBarWhenReportsAreLoaded();
    }

    function AjaxSubmit_AdminReportGetExpungementFormFrequentlyMissed()
    {
        var postJSONData = {};
        SendAjax("api/api.php?method=adminReportGetExpungementFormFrequentlyMissed&fromDate=" + getFromDateAndTime() + "&toDate=" + getToDateAndTime() + "", postJSONData, AjaxSuccess_AdminReportGetExpungementFormFrequentlyMissed, true);
    }

    function AjaxSuccess_AdminReportGetExpungementFormFrequentlyMissed(returnJSONData)
    {
        $('#expungmentFormFrequentylMissed').bootstrapTable({data: returnJSONData.data});
        $('#expungmentFormFrequentylMissed').bootstrapTable('load', returnJSONData.data);

        var array = [];

        for (var x in returnJSONData.data[0]) {
            array.push(parseInt(returnJSONData.data[0][x]));
        }

        var max = math.max(array);
        var min = math.min(array);
        var mean = math.mean(array);
        var stdev = math.std(array);

        $("#panelExpungmentFormFrequentylMissed").fadeIn();

        var data = google.visualization.arrayToDataTable([
            ['Question', 'Value', {role: 'style'}],
            ['Q1', array[0], getBarColor(array[0], max, min, mean, stdev)],
            ['Q2', array[1], getBarColor(array[1], max, min, mean, stdev)],
            ['Q3a', array[2], getBarColor(array[2], max, min, mean, stdev)],
            ['Q3b', array[3], getBarColor(array[3], max, min, mean, stdev)],
            ['Q4a', array[4], getBarColor(array[4], max, min, mean, stdev)],
            ['Q4b', array[5], getBarColor(array[5], max, min, mean, stdev)],
            ['Q5a', array[6], getBarColor(array[6], max, min, mean, stdev)],
            ['Q5b', array[7], getBarColor(array[7], max, min, mean, stdev)],
            ['Q6a', array[8], getBarColor(array[8], max, min, mean, stdev)],
            ['Q6b', array[9], getBarColor(array[9], max, min, mean, stdev)],
            ['Q7', array[10], getBarColor(array[10], max, min, mean, stdev)],
            ['Q8', array[11], getBarColor(array[11], max, min, mean, stdev)],
            ['Q9', array[12], getBarColor(array[12], max, min, mean, stdev)],
            ['Q10', array[13], getBarColor(array[13], max, min, mean, stdev)],
            ['Q11', array[14], getBarColor(array[14], max, min, mean, stdev)],
            ['Q12', array[15], getBarColor(array[15], max, min, mean, stdev)],
            ['Q13', array[16], getBarColor(array[16], max, min, mean, stdev)],
            ['Q14', array[17], getBarColor(array[17], max, min, mean, stdev)],
            ['Q15', array[18], getBarColor(array[18], max, min, mean, stdev)],
            ['Q16', array[19], getBarColor(array[19], max, min, mean, stdev)],
            ['Q17', array[20], getBarColor(array[20], max, min, mean, stdev)]
        ]);

        drawBarChart(data, 'barChartExpungmentFormFrequentylMissed');
        closeProgressBarWhenReportsAreLoaded();
    }

    function AjaxSubmit_AdminReportGetExpungementTanfQuestions()
    {
        var postJSONData = {};
        SendAjax("api/api.php?method=adminReportGetExpungementTanfQuestions&fromDate=" + getFromDateAndTime() + "&toDate=" + getToDateAndTime() + "", postJSONData, AjaxSuccess_AdminReportGetExpungementTanfQuestions, true);
    }

    function AjaxSuccess_AdminReportGetExpungementTanfQuestions(returnJSONData)
    {
        $('#ExpungementTANFQuestions').bootstrapTable({data: returnJSONData.data});
        $('#ExpungementTANFQuestions').bootstrapTable('load', returnJSONData.data);
        $("#panelExpungementTANFQuestions").fadeIn();

        var data = google.visualization.arrayToDataTable([
            ['Question', 'Value'],
            ['Yes', parseInt(returnJSONData.data[0].tanfYes)],
            ['No', parseInt(returnJSONData.data[0].tanfNo)]
        ]);

        drawPieChart(data, 'pieChartExpungementTANFQuestions');
        closeProgressBarWhenReportsAreLoaded();
    }

    function drawPieChart(data, divID)
    {
        var options = {
            legend: {position: 'bottom'},
            chartArea: {width: "100%", height: "75%"},
//            colors: ['Crimson', 'blue'],
            colors: ['#337ab7', '#449d44'],
            tooltip: {trigger: 'none'}
        };

        var chart = new google.visualization.PieChart(document.getElementById(divID));
        chart.draw(data, options);
    }

    function drawBarChart(data, divID)
    {
        var options = {
            legend: 'none',
            chartArea: {width: "100%", height: "75%"},
            tooltip: {trigger: 'none'}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById(divID));
        chart.draw(data, options);
    }

    var numberOfFinishedReports = 0;
    var totalNumberOfReports = 6;
    function closeProgressBarWhenReportsAreLoaded()
    {
        numberOfFinishedReports += 1;

        if (numberOfFinishedReports === totalNumberOfReports)
        {
            setTimeout(function () {
                $('#progressBarModal').modal('hide');
            }, 1000);

            numberOfFinishedReports = 0;
        }
    }

    function exportToExcel(methodName, fileName)
    {
        document.location.href = "api/api.php?method=" + methodName + "&fromDate=" + getFromDateAndTime() + "&toDate=" + getToDateAndTime() + "&format=excel&filename=" + fileName + "%20" + getFromDate() + "-" + getToDate() + "";
    }

</script>