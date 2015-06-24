<?php ?>

<body>
    <form id="formExpungement" data-parsley-validate>
        <div id="divContactInfo" class="container theme-showcase">
            <div class="panel panal-content panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Contact Info</h3>
                </div>
                <div class="panel-body">
                    <div class="form-inline">
                        <div class="form-group">
                            <label for="firstName">First Name: </label>
                            <input type="text" class="form-control" id="firstName" placeholder="First Name" required data-parsley-required-message="Please enter your First Name">
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name: </label>
                            <input type="text" class="form-control" id="lastName" placeholder="Last Name" required data-parsley-required-message="Please enter your Last Name">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="divTanf" class="container theme-showcase">
            <div class="panel panal-content panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">General Information</h3>
                </div>
                <div class="panel-body">
                    <ol>
                        <h4><li>Are you the legal guardian of a child under the age of 18 years old?</li></h4>
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default"><input type="radio" name="tanfq1" value="1" required data-parsley-errors-container="#tq1-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                            <label class="btn btn-default"><input type="radio" name="tanfq1" value="0" required data-parsley-errors-container="#tq1-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                        </div><div id="tq1-invalid-form-error-message"></div>

                        <h4><li>Are you receiving any assistance from a Department of Workforce program, such as Medicaid, CHIP, Food Stamps, Refugee Cash Assistance, Family Employment Program, Temporary Assistance for Needy Families, or the WIC program?</li></h4>
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default"><input type="radio" name="tanfq2" value="1" required data-parsley-errors-container="#tq2-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                            <label class="btn btn-default"><input type="radio" name="tanfq2" value="0" required data-parsley-errors-container="#tq2-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                        </div><div id="tq2-invalid-form-error-message"></div>
                    </ol>
                </div>
            </div>
        </div>

        <div id="divInital" class="container theme-showcase">
            <div class="panel panal-content panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Expungement Questionnaire</h3>
                </div>
                <div class="panel-body">
                    <ul>
                        <div id="q1">
                            <h4><li>1. Do you have any criminal charges pending in court?</li></h4>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default"><input type="radio" name="expungementQ1" value="1" required data-parsley-errors-container="#q1-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                                <label class="btn btn-default"><input type="radio" name="expungementQ1" value="0" required data-parsley-errors-container="#q1-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                            </div><div id="q1-invalid-form-error-message"></div>
                        </div>

                        <div id="q2">
                            <h4><li>2. Do you owe any fines or restitution to the courts or victims as of today’s date?</li></h4>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default"><input type="radio" name="expungementQ2" value="1" required data-parsley-errors-container="#q2-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                                <label class="btn btn-default"><input type="radio" name="expungementQ2" value="0" required data-parsley-errors-container="#q2-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                            </div><div id="q2-invalid-form-error-message"></div>
                        </div>

                        <div id="q3">
                            <h4><li>3. Have you ever been convicted of two or more felonies? </li></h4>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default"><input type="radio" name="expungementQ3" value="1" required data-parsley-errors-container="#q3a-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                                <label class="btn btn-default"><input type="radio" name="expungementQ3" value="0" required data-parsley-errors-container="#q3a-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                            </div><div id="q3a-invalid-form-error-message"></div>
                            <ul>
                                <h4><li>3a. If yes, were they all during the same arrest?</li></h4>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default"><input type="radio" name="expungementQ3b" value="1" required data-parsley-errors-container="#q3b-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                                    <label class="btn btn-default"><input type="radio" name="expungementQ3b" value="0" required data-parsley-errors-container="#q3b-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No / NA</label>
                                </div><div id="q3b-invalid-form-error-message"></div>
                            </ul>
                        </div>

                        <div id="q4">
                            <h4><li>4. Have you ever been convicted of three or more class A misdemeanors?</li></h4>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default"><input type="radio" name="expungementQ4" value="1" required data-parsley-errors-container="#q4a-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                                <label class="btn btn-default"><input type="radio" name="expungementQ4" value="0" required data-parsley-errors-container="#q4a-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                            </div><div id="q4a-invalid-form-error-message"></div>
                            <ul>
                                <h4><li>4a. If yes, were they all during the same arrest?</li></h4>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default"><input type="radio" name="expungementQ4b" value="1" required data-parsley-errors-container="#q4b-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                                    <label class="btn btn-default"><input type="radio" name="expungementQ4b" value="0" required data-parsley-errors-container="#q4b-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No / NA</label>
                                </div><div id="q4b-invalid-form-error-message"></div>
                            </ul>
                        </div>

                        <div id="q5">
                            <h4><li>5. Have you ever been convicted of 4 or more class B misdemeanors</li></h4>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default"><input type="radio" name="expungementQ5" value="1" required data-parsley-errors-container="#q5a-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                                <label class="btn btn-default"><input type="radio" name="expungementQ5" value="0" required data-parsley-errors-container="#q5a-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                            </div><div id="q5a-invalid-form-error-message"></div>
                            <ul>
                                <h4><li>5a. If yes, were they all during the same arrest?</li></h4>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default"><input type="radio" name="expungementQ5b" value="1" required data-parsley-errors-container="#q5b-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                                    <label class="btn btn-default"><input type="radio" name="expungementQ5b" value="0" required data-parsley-errors-container="#q5b-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No / NA</label>
                                </div><div id="q5b-invalid-form-error-message"></div>
                            </ul>
                        </div>

                        <div id="q6">
                            <h4><li>6. Do you have 5 or more convictions?</li></h4>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default"><input type="radio" name="expungementQ6" value="1" required data-parsley-errors-container="#q6a-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                                <label class="btn btn-default"><input type="radio" name="expungementQ6" value="0" required data-parsley-errors-container="#q6a-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                            </div><div id="q6a-invalid-form-error-message"></div>
                            <ul>
                                <h4><li>6a. If yes, are any of these infractions or traffic related?</li></h4>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default"><input type="radio" name="expungementQ6b" value="1" required data-parsley-errors-container="#q6b-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                                    <label class="btn btn-default"><input type="radio" name="expungementQ6b" value="0" required data-parsley-errors-container="#q6b-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No / NA</label>
                                </div><div id="q6b-invalid-form-error-message"></div>
                            </ul>
                        </div>

                        <div id="q7">
                            <h4><li>7. Have you ever been convicted of a capitol offense or 1st degree felony?</li></h4>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default"><input type="radio" name="expungementQ7" value="1" required data-parsley-errors-container="#q7-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                                <label class="btn btn-default"><input type="radio" name="expungementQ7" value="0" required data-parsley-errors-container="#q7-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                            </div><div id="q7-invalid-form-error-message"></div>
                        </div>

                        <div id="q8">
                            <h4><li>8. Have you ever been convicted of a violent felony</li></h4>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default"><input type="radio" name="expungementQ8" value="1" required data-parsley-errors-container="#q8-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                                <label class="btn btn-default"><input type="radio" name="expungementQ8" value="0" required data-parsley-errors-container="#q8-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                            </div><div id="q8-invalid-form-error-message"></div>
                        </div>

                        <div id="q9">
                            <h4><li>9. Have you ever been convicted of an automobile homicide?</li></h4>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default"><input type="radio" name="expungementQ9" value="1" required data-parsley-errors-container="#q9-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                                <label class="btn btn-default"><input type="radio" name="expungementQ9" value="0" required data-parsley-errors-container="#q9-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                            </div><div id="q9-invalid-form-error-message"></div>
                        </div>


                        <div id="q10">
                            <h4><li>10. Have you ever been convicted of a felony DUI?</li></h4>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default"><input type="radio" name="expungementQ10" value="1" required data-parsley-errors-container="#q10-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                                <label class="btn btn-default"><input type="radio" name="expungementQ10" value="0" required data-parsley-errors-container="#q10-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                            </div><div id="q10-invalid-form-error-message"></div>
                        </div>

                        <div id="q11">
                            <h4><li>11. Have you ever been convicted of registerable sex offense? </li></h4>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default"><input type="radio" name="expungementQ11" value="1" required data-parsley-errors-container="#q11-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                                <label class="btn btn-default"><input type="radio" name="expungementQ11" value="0" required data-parsley-errors-container="#q11-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                            </div><div id="q11-invalid-form-error-message"></div>
                        </div>


                        <div id="q12">
                            <h4><li>12. Have you been convicted of a felony in the last seven years? </li></h4>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default"><input type="radio" name="expungementQ12" value="1" required data-parsley-errors-container="#q12-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                                <label class="btn btn-default"><input type="radio" name="expungementQ12" value="0" required data-parsley-errors-container="#q12-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                            </div><div id="q12-invalid-form-error-message"></div>
                        </div>


                        <div id="q13">
                            <h4><li>13. Have you been convicted of a Class A misdemeanor in the last five years?</li></h4>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default"><input type="radio" name="expungementQ13" value="1" required data-parsley-errors-container="#q13-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                                <label class="btn btn-default"><input type="radio" name="expungementQ13" value="0" required data-parsley-errors-container="#q13-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                            </div><div id="q13-invalid-form-error-message"></div>
                        </div>

                        <div id="q14">
                            <h4><li>14. Have you been convicted of a Class B misdemeanor in the last 4 years?</li></h4>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default"><input type="radio" name="expungementQ14" value="1" required data-parsley-errors-container="#q14-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                                <label class="btn btn-default"><input type="radio" name="expungementQ14" value="0" required data-parsley-errors-container="#q14-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                            </div><div id="q14-invalid-form-error-message"></div>
                        </div>

                        <div id="q15">
                            <h4><li>15. Have you been convicted of a Class C misdemeanor in the last 3 years? </li></h4>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default"><input type="radio" name="expungementQ15" value="1" required data-parsley-errors-container="#q15-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                                <label class="btn btn-default"><input type="radio" name="expungementQ15" value="0" required data-parsley-errors-container="#q15-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                            </div><div id="q15-invalid-form-error-message"></div>
                        </div>


                        <div id="q16">
                            <h4><li>16. Have you been convicted of a misdemeanor DUI in the last 10 years? </li></h4>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default"><input type="radio" name="expungementQ16" value="1" required data-parsley-errors-container="#q16-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                                <label class="btn btn-default"><input type="radio" name="expungementQ16" value="0" required data-parsley-errors-container="#q16-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                            </div><div id="q16-invalid-form-error-message"></div>
                        </div>

                        <div id="q17">
                            <h4><li>17. Have you ever applied for the expungement process before and been denied? </li></h4>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default"><input type="radio" name="expungementQ17" value="1" required data-parsley-errors-container="#q17-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                                <label class="btn btn-default"><input type="radio" name="expungementQ17" value="0" required data-parsley-errors-container="#q17-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                            </div><div id="q17-invalid-form-error-message"></div>


                            <ul>
                                <h4><li>17a. If yes, please list why</li></h4>
                                <textarea class="form-control" rows="3"></textarea>
                            </ul>
                        </div>
                    </ul>
                    <hr/>
                    <input id="submit" type="submit" value="Submit" class="btn btn-primary pull-right" />
                    <input id="print" value="Print" class="btn btn-primary pull-right" onclick="window.print()"/>
                </div>
            </div>
        </div>
    </form>

    <div id="divModalExpungementComplete" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="panel-content panel-success">
                    <div class="panel-heading">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="panel-title">Next Step</h3>
                    </div>
                    <div class="panel-body">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#print').hide();
        $(function ()
        {
            $('#formExpungement').submit(function (e)
            {
                e.preventDefault();
                AjaxSubmit_ExpungementForm();

                for (var i = 1; i <= 17; i++)
                {
                    if ($('input[name=expungementQ' + i + ' ]:checked', '#formExpungement').val() === "0")
                    {
                        $("#q" + i).remove();
                    }
                }

                $('#print').show();
                $('.btn-group').hide();
                $('#submit').hide();
                $('#divTanf').hide();
                window.scrollTo(0, 0);
            });
        });

        var alreadyUploadedExpungementFormThisSession = false;
        function AjaxSubmit_ExpungementForm()
        {
            if (alreadyUploadedExpungementFormThisSession === false)
            {
                var tanfq1 = $('input[name=tanfq1]:checked', '#formExpungement').val();
                var tanfq2 = $('input[name=tanfq2]:checked', '#formExpungement').val();
                var expungementQ1 = $('input[name=expungementQ1]:checked', '#formExpungement').val();
                var expungementQ2 = $('input[name=expungementQ2]:checked', '#formExpungement').val();
                var expungementQ3a = $('input[name=expungementQ3]:checked', '#formExpungement').val();
                var expungementQ3b = $('input[name=expungementQ3b]:checked', '#formExpungement').val();
                var expungementQ4a = $('input[name=expungementQ4]:checked', '#formExpungement').val();
                var expungementQ4b = $('input[name=expungementQ4b]:checked', '#formExpungement').val();
                var expungementQ5a = $('input[name=expungementQ5]:checked', '#formExpungement').val();
                var expungementQ5b = $('input[name=expungementQ5b]:checked', '#formExpungement').val();
                var expungementQ6a = $('input[name=expungementQ6]:checked', '#formExpungement').val();
                var expungementQ6b = $('input[name=expungementQ6b]:checked', '#formExpungement').val();
                var expungementQ7 = $('input[name=expungementQ7]:checked', '#formExpungement').val();
                var expungementQ8 = $('input[name=expungementQ8]:checked', '#formExpungement').val();
                var expungementQ9 = $('input[name=expungementQ9]:checked', '#formExpungement').val();
                var expungementQ10 = $('input[name=expungementQ10]:checked', '#formExpungement').val();
                var expungementQ11 = $('input[name=expungementQ11]:checked', '#formExpungement').val();
                var expungementQ12 = $('input[name=expungementQ12]:checked', '#formExpungement').val();
                var expungementQ13 = $('input[name=expungementQ13]:checked', '#formExpungement').val();
                var expungementQ14 = $('input[name=expungementQ14]:checked', '#formExpungement').val();
                var expungementQ15 = $('input[name=expungementQ15]:checked', '#formExpungement').val();
                var expungementQ16 = $('input[name=expungementQ16]:checked', '#formExpungement').val();
                var expungementQ17 = $('input[name=expungementQ17]:checked', '#formExpungement').val();

                var postJSONData = '{"tanfq1" : "' + tanfq1 +
                        '","tanfq2" : "' + tanfq2 +
                        '","expungementQ1" : "' + expungementQ1 +
                        '","expungementQ2" : "' + expungementQ2 +
                        '","expungementQ3a" : "' + expungementQ3a +
                        '","expungementQ3b" : "' + expungementQ3b +
                        '","expungementQ4a" : "' + expungementQ4a +
                        '","expungementQ4b" : "' + expungementQ4b +
                        '","expungementQ5a" : "' + expungementQ5a +
                        '","expungementQ5b" : "' + expungementQ5b +
                        '","expungementQ6a" : "' + expungementQ6a +
                        '","expungementQ6b" : "' + expungementQ6b +
                        '","expungementQ7" : "' + expungementQ7 +
                        '","expungementQ8" : "' + expungementQ8 +
                        '","expungementQ9" : "' + expungementQ9 +
                        '","expungementQ10" : "' + expungementQ10 +
                        '","expungementQ11" : "' + expungementQ11 +
                        '","expungementQ12" : "' + expungementQ12 +
                        '","expungementQ13" : "' + expungementQ13 +
                        '","expungementQ14" : "' + expungementQ14 +
                        '","expungementQ15" : "' + expungementQ15 +
                        '","expungementQ16" : "' + expungementQ16 +
                        '","expungementQ17" : "' + expungementQ17 +
                        '"}';
                SendAjax("api/api.php?method=expungementForm", postJSONData, AjaxSuccess_ExpungementForm, true);
            }
            else
            {
                console.log("Expungement Form Already Uploaded for this session");
            }
        }

        function AjaxSuccess_ExpungementForm(returnJSONData)
        {
            alreadyUploadedExpungementFormThisSession = true;
        }
    </script>
</body>