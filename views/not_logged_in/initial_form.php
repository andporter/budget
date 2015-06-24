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
        <div id="divTanf" class="container theme-showcase">
            <div class="alert alert-warning" role="alert">
                <strong>Note: </strong>In order for Cottages of Hope to potentially assist you with the expungement process please answer all of the following questions.
            </div>
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
                    <h3 class="panel-title">Initial Expungement Questionnaire</h3>
                </div>
                <div class="panel-body">
                    <ol>
                        <h4><li>Do you have any criminal charges pending in court?</li></h4>
                        <div class="btn-group" data-toggle="buttons" id="q1">
                            <label class="btn btn-default"><input type="radio" name="initialq1" value="1" required data-parsley-errors-container="#q1-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                            <label class="btn btn-default"><input type="radio" name="initialq1" value="0" required data-parsley-errors-container="#q1-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                        </div><div id="q1-invalid-form-error-message"></div>

                        <h4><li>Do you owe any fines or restitution to the courts or victims as of today’s date?</li></h4>
                        <div class="btn-group" data-toggle="buttons" id="q2">
                            <label class="btn btn-default"><input type="radio" name="initialq2" value="1" required data-parsley-errors-container="#q2-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                            <label class="btn btn-default"><input type="radio" name="initialq2" value="0" required data-parsley-errors-container="#q2-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                        </div><div id="q2-invalid-form-error-message"></div>

                        <h4><li>Have you been convicted of a felony in the last seven years?</li></h4>
                        <div class="btn-group" data-toggle="buttons" id="q3">
                            <label class="btn btn-default"><input type="radio" name="initialq3" value="1" required data-parsley-errors-container="#q3-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                            <label class="btn btn-default"><input type="radio" name="initialq3" value="0" required data-parsley-errors-container="#q3-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                        </div><div id="q3-invalid-form-error-message"></div>

                        <h4><li>Have you been convicted of a Class A misdemeanor in the last five years?</li></h4>
                        <div class="btn-group" data-toggle="buttons" id="q4">
                            <label class="btn btn-default"><input type="radio" name="initialq4" value="1" required data-parsley-errors-container="#q4-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                            <label class="btn btn-default"><input type="radio" name="initialq4" value="0" required data-parsley-errors-container="#q4-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                        </div><div id="q4-invalid-form-error-message"></div>

                        <h4><li>Have you been convicted of a Class B misdemeanor in the last four years?</li></h4>
                        <div class="btn-group" data-toggle="buttons" id="q5">
                            <label class="btn btn-default"><input type="radio" name="initialq5" value="1" required data-parsley-errors-container="#q5-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                            <label class="btn btn-default"><input type="radio" name="initialq5" value="0" required data-parsley-errors-container="#q5-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                        </div><div id="q5-invalid-form-error-message"></div>  

                        <h4><li>Have you been convicted of a Class C misdemeanor in the last three years?</li></h4>
                        <div class="btn-group" data-toggle="buttons" id="q6">
                            <label class="btn btn-default"><input type="radio" name="initialq6" value="1" required data-parsley-errors-container="#q6-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                            <label class="btn btn-default"><input type="radio" name="initialq6" value="0" required data-parsley-errors-container="#q6-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                        </div><div id="q6-invalid-form-error-message"></div>

                        <h4><li>Have you ever been convicted of a 1st degree felony or capitol offense?</li></h4>
                        <div class="btn-group" data-toggle="buttons" id="q7">
                            <label class="btn btn-default"><input type="radio" name="initialq7" value="1" required data-parsley-errors-container="#q7-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                            <label class="btn btn-default"><input type="radio" name="initialq7" value="0" required data-parsley-errors-container="#q7-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                        </div><div id="q7-invalid-form-error-message"></div>

                        <h4><li>Have you ever been convicted of a felony automobile homicide?</li></h4>
                        <div class="btn-group" data-toggle="buttons" id="q8">
                            <label class="btn btn-default"><input type="radio" name="initialq8" value="1" required data-parsley-errors-container="#q8-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                            <label class="btn btn-default"><input type="radio" name="initialq8" value="0" required data-parsley-errors-container="#q8-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                        </div><div id="q8-invalid-form-error-message"></div>

                        <h4><li>Are you or have you ever been a registered sex offender?</li></h4>
                        <div class="btn-group" data-toggle="buttons" id="q9">
                            <label class="btn btn-default"><input type="radio" name="initialq9" value="1" required data-parsley-errors-container="#q9-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                            <label class="btn btn-default"><input type="radio" name="initialq9" value="0" required data-parsley-errors-container="#q9-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                        </div><div id="q9-invalid-form-error-message"></div>

                        <h4><li>Have you ever been convicted of a felony DUI?</li></h4>
                        <div class="btn-group" data-toggle="buttons" id="q10">
                            <label class="btn btn-default"><input type="radio" name="initialq10" value="1" required data-parsley-errors-container="#q10-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                            <label class="btn btn-default"><input type="radio" name="initialq10" value="0" required data-parsley-errors-container="#q10-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                        </div><div id="q10-invalid-form-error-message"></div>

                        <h4><li> Have you ever been convicted of a misdemeanor DUI in the last 10 years? </li></h4>
                        <div class="btn-group" data-toggle="buttons" id="q11">
                            <label class="btn btn-default"><input type="radio" name="initialq11" value="1" required data-parsley-errors-container="#q11-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                            <label class="btn btn-default"><input type="radio" name="initialq11" value="0" required data-parsley-errors-container="#q11-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                        </div><div id="q11-invalid-form-error-message"></div>

                        <h4><li> Have you ever been convicted of a violent felony? </li></h4>
                        <div class="btn-group" data-toggle="buttons" id="q12">
                            <label class="btn btn-default"><input type="radio" name="initialq12" value="1" required data-parsley-errors-container="#q12-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>Yes</label>
                            <label class="btn btn-default"><input type="radio" name="initialq12" value="0" required data-parsley-errors-container="#q12-invalid-form-error-message" data-parsley-required-message="Answering this question is required"/>No</label>
                        </div><div id="q12-invalid-form-error-message"></div>
                    </ol>
                    <hr/>
                    <input type="submit" value="Submit" class="btn btn-primary pull-right" />
                </div>
            </div>
        </div>
    </form>

    <div id="divContactModal" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="panel-content panel-success">
                    <div class="panel-heading">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="panel-title">Next Steps</h3>
                    </div>
                    <div class="panel-body">
                        <div class="well">
                            <p>You have finished the initial expungement questionnaire.  Based on your responses you may qualify for expungement.  To further review your case please meet with Cottages of Hope’s Expungement Specialist.  Provide your contact information below and we will contact you to set up an appointment.</p>
                            <p>Alternately you may contact us by phone or e-mail to set up an appointment.</p>
                            <p>Phone: Call Cottages of Hope (<span id="spanCOH_Phone"></span>) and ask for <span id="spanCOH_FirstName"></span> the Expungement Specialist.</p>
                            <p>Email: Email <span id="spanCOH_FirstName"></span> at <a id="aCOH_Email"><span id="spanCOH_Email"></span></a> Please use “Expungement” as the subject</p>
                        </div>
                        <form class="form-horizontal" id="formContact" data-parsley-validate>
                            <div id="divFirstName" class="form-group">
                                <label for="firstName" class="col-sm-2 control-label">First Name:</label>
                                <div class="col-xs-4">
                                    <input type="text" class="form-control" name="firstName" placeholder="First Name" data-parsley-group="firstName" required data-parsley-required-message="Please enter your First Name">
                                </div>
                            </div>
                            <div id="divLastName" class="form-group">
                                <label for="lastName" class="col-sm-2 control-label">Last Name:</label>
                                <div class="col-xs-4">
                                    <input type="text" class="form-control" name="lastName" placeholder="Last Name" data-parsley-group="lastName" required data-parsley-required-message="Please enter your Last Name">
                                </div>
                            </div>
                            <div id="divEmail" class="form-group">
                                <label for="email" class="col-sm-2 control-label">Email:</label>
                                <div class="col-xs-4">
                                    <input id="email" type="email" class="form-control" name="email" placeholder="Email" data-parsley-group="email"/>
                                </div>
                            </div>
                            <div id="divPhone" class="form-group">
                                <label for="phone" class="col-sm-2 control-label">Phone:</label>
                                <div class="col-xs-4" id="phone">
                                    <div class="col-xs-4">
                                        <input type="text" class="phonenumber form-control" name="phoneAreaCode" placeholder="###" data-parsley-group="phone" maxlength="3" size="3" data-parsley-length="[3, 3]" data-parsley-error-message="3 Digits Required"/>
                                    </div>
                                    <div class="col-xs-4">
                                        <input type="text" class="phonenumber form-control" name="phoneFirstThree" placeholder="###" data-parsley-group="phone" maxlength="3" size="3" data-parsley-length="[3, 3]" data-parsley-error-message="3 Digits Required"/>
                                    </div>
                                    <div class="col-xs-4">
                                        <input type="text" class="phonenumber form-control" name="phoneLastFour" placeholder="####" data-parsley-group="phone" maxlength="4" size="4" data-parsley-length="[4, 4]" data-parsley-error-message="4 Digits Required"/>
                                    </div>
                                </div>
                            </div>
                            <div class="invalid-form-error-message-require-emailORphone"></div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="submit" value="Submit" class="btn btn-primary pull-right" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalMissedQuestionsNextSteps" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="panel-content panel-danger">
                    <div class="panel-heading">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="panel-title">Unable to Continue</h3>
                    </div>
                    <div class="panel-body">
                        <div class="well">
                            <p>You do not currently qualify for expungement based on your responses to questions (<span id="listOfMissedQuestions"></span>).</p>  
                            <p>It is important to note however, that you may still qualify for expungement in the future.  Please see the slideshow for details on each non-qualifying response to see if you may be able to qualify in the future.</p>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10" >
                            <input type="submit" value="View Slideshow" class="btn btn-primary pull-right" id="buttonViewMissedQuestionsSlideshow"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="carouselModalMissedQuestions" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="panel-content panel-danger">
                    <div class="panel-heading">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="panel-title">Questions to Review</h3>
                    </div>
                    <div class="panel-body" >
                        <div id="carouselMissedQuestionSlideShow" class="carousel slide" data-interval="false" data-wrap="false" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="active item" id="missedQuestionSlide1"><img class="img-responsive center-block" src="images/slide_1.jpeg"></div>
                                <div class="item" id="missedQuestionSlide2"><img class="img-responsive center-block" src="images/slide_2.jpeg"></div>
                                <div class="item" id="missedQuestionSlide3"><img class="img-responsive center-block" src="images/slide_3.jpeg"></div>
                                <div class="item" id="missedQuestionSlide4"><img class="img-responsive center-block" src="images/slide_4.jpeg"></div>
                                <div class="item" id="missedQuestionSlide5"><img class="img-responsive center-block" src="images/slide_5.jpeg"></div>
                                <div class="item" id="missedQuestionSlide6"><img class="img-responsive center-block" src="images/slide_6.jpeg"></div>
                                <div class="item" id="missedQuestionSlide7"><img class="img-responsive center-block" src="images/slide_7.jpeg"></div>
                                <div class="item" id="missedQuestionSlide8"><img class="img-responsive center-block" src="images/slide_8.jpeg"></div>
                                <div class="item" id="missedQuestionSlide9"><img class="img-responsive center-block" src="images/slide_9.jpeg"></div>
                                <div class="item" id="missedQuestionSlide10"><img class="img-responsive center-block" src="images/slide_10.jpeg"></div>
                                <div class="item" id="missedQuestionSlide11"><img class="img-responsive center-block" src="images/slide_11.jpeg"></div>
                                <div class="item" id="missedQuestionSlide12"><img class="img-responsive center-block" src="images/slide_12.jpeg"></div>
                                <div class="item" id="missedQuestionSlideFinal"><img class="img-responsive center-block" src="images/slide_final.jpeg"></div>
                            </div>
                            <a class="left carousel-control" href="#carouselMissedQuestionSlideShow" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                            <a class="right carousel-control" href="#carouselMissedQuestionSlideShow" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalContactInfoUploaded" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="panel-content panel-success">
                    <div class="panel-heading">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="panel-title">Success!</h3>
                    </div>
                    <div class="panel-body">
                        <div class="well">
                            <p>We have successfully received your contact information. We will be contacting you soon!</p>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10" >
                            <input type="submit" value="Close" class="btn btn-primary pull-right" id="buttonCloseContactInfoUploaded"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $(function () {
            $.autotab({tabOnSelect: true});
            $('.phonenumber').autotab('filter', 'number');

            $('#formContact').parsley().subscribe('parsley:form:validate', function (formInstance)
            {
                formInstance.submitEvent.preventDefault();

                if ($('#email').val().length > 0 && $('#email').val() !== "Email")
                {
                    if (formInstance.isValid('email', true))
                    {
                        $('#divEmail').removeClass("has-error");
                        $('#divEmail').addClass("has-success");
                    }
                    else //error
                    {
                        $('#divEmail').removeClass("has-success");
                        $('#divEmail').addClass("has-error");
                        return false;
                    }
                }

                // if one of these blocks is not failing do not prevent submission
                if ((formInstance.isValid('firstName', true) && formInstance.isValid('lastName', true)) && (formInstance.isValid('email', true) || formInstance.isValid('phone', true)))
                {
                    $('#divFirstName').removeClass("has-error");
                    $('#divFirstName').addClass("has-success");
                    $('#divLastName').removeClass("has-error");
                    $('#divLastName').addClass("has-success");
                    $('#divEmail').removeClass("has-error");
                    $('#divEmail').addClass("has-success");
                    $('#divPhone').removeClass("has-error");
                    $('#divPhone').addClass("has-success");

                    $('.invalid-form-error-message-require-emailORphone').html('');
                    AjaxSubmit_InitialContactForm();
                    $('#divContactModal').modal('hide');
                    $('#modalContactInfoUploaded').modal('show');
                }
                else // else stop form submission
                {
                    if (formInstance.isValid('firstName', true))
                    {
                        $('#divFirstName').removeClass("has-error");
                        $('#divFirstName').addClass("has-success");
                    }
                    else //error
                    {
                        $('#divFirstName').removeClass("has-success");
                        $('#divFirstName').addClass("has-error");
                    }

                    if (formInstance.isValid('lastName', true))
                    {
                        $('#divLastName').removeClass("has-error");
                        $('#divLastName').addClass("has-success");
                    }
                    else //error
                    {
                        $('#divLastName').removeClass("has-success");
                        $('#divLastName').addClass("has-error");
                    }

                    if (formInstance.isValid('email', true))
                    {
                        $('#divEmail').removeClass("has-error");
                        $('#divEmail').addClass("has-success");
                    }
                    else //error
                    {
                        $('#divEmail').removeClass("has-success");
                        $('#divEmail').addClass("has-error");
                        $('.invalid-form-error-message-require-emailORphone').html("You must provide either your email address or phone number.").addClass("parsley-required");
                    }

                    if (formInstance.isValid('phone', true))
                    {
                        $('#divPhone').removeClass("has-error");
                        $('#divPhone').addClass("has-success");
                    }
                    else //error
                    {
                        $('#divPhone').removeClass("has-success");
                        $('#divPhone').addClass("has-error");
                        $('.invalid-form-error-message-require-emailORphone').html("You must provide either your email address or phone number.").addClass("parsley-required");
                    }

                }
            });

            var alreadyCreatedSlideshow = false;
            var missedQuestionsList = Array();
            var correctQuestionsList = Array();
            $('#formInitial').submit(function (e)
            {
                e.preventDefault();
                AjaxSubmit_InitialForm();

                if (alreadyCreatedSlideshow === false)
                {
                    for (var i = 1; i <= 12; i++)
                    {
                        if ($('input[name=initialq' + i + ' ]:checked', '#formInitial').val() === "1")
                        {
                            missedQuestionsList.push(i);
                        }
                        else
                        {
                            correctQuestionsList.push(i);
                        }
                    }

                    if (missedQuestionsList.length >= 1)
                    {
                        $("#listOfMissedQuestions").text(missedQuestionsList.toString());

                        var alreadySetFirstElementActive = false;
                        for (var i = 0; i < correctQuestionsList.length; i++)
                        {
                            if (alreadySetFirstElementActive === false) //set first element active
                            {
                                $("#missedQuestionSlide" + missedQuestionsList[i]).addClass('active');
                                alreadySetFirstElementActive = true;
                            }

                            $("#missedQuestionSlide" + correctQuestionsList[i]).remove(); //remove correct questions from carousel
                        }
                    }

                    alreadyCreatedSlideshow = true;
                }

                if (missedQuestionsList.length >= 1) //they can't continue
                {
                    $('#modalMissedQuestionsNextSteps').modal('show');
                }
                else //they can continue
                {
                    AjaxSubmit_GetCOHContact();
                    $('#divContactModal').modal('show');
                }
            });

            $('#buttonViewMissedQuestionsSlideshow').click(function (e)
            {
                $('#modalMissedQuestionsNextSteps').modal('hide');
                $('#carouselMissedQuestionSlideShow').carousel();
                $('#carouselModalMissedQuestions').modal('show');
            });

            $('#buttonCloseContactInfoUploaded').click(function (e)
            {
                location.href = "http://www.cottagesofhope.org";
            });

            window.setTimeout(function () {
                $("#alertErrors").fadeTo(1500, 0).slideUp(500, function () {
                    $(this).remove();
                });
                $("#alertMessages").fadeTo(1500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 5000);
        });

        var alreadyUploadedInitialFormThisSession = false;
        function AjaxSubmit_InitialForm()
        {
            if (alreadyUploadedInitialFormThisSession === false)
            {
                var tanfq1 = $('input[name=tanfq1]:checked', '#formInitial').val();
                var tanfq2 = $('input[name=tanfq2]:checked', '#formInitial').val();
                var initialq1 = $('input[name=initialq1]:checked', '#formInitial').val();
                var initialq2 = $('input[name=initialq2]:checked', '#formInitial').val();
                var initialq3 = $('input[name=initialq3]:checked', '#formInitial').val();
                var initialq4 = $('input[name=initialq4]:checked', '#formInitial').val();
                var initialq5 = $('input[name=initialq5]:checked', '#formInitial').val();
                var initialq6 = $('input[name=initialq6]:checked', '#formInitial').val();
                var initialq7 = $('input[name=initialq7]:checked', '#formInitial').val();
                var initialq8 = $('input[name=initialq8]:checked', '#formInitial').val();
                var initialq9 = $('input[name=initialq9]:checked', '#formInitial').val();
                var initialq10 = $('input[name=initialq10]:checked', '#formInitial').val();
                var initialq11 = $('input[name=initialq11]:checked', '#formInitial').val();
                var initialq12 = $('input[name=initialq12]:checked', '#formInitial').val();
                var postJSONData = '{"tanfq1" : ' + tanfq1 +
                        ',"tanfq2" : ' + tanfq2 +
                        ',"initialq1" : ' + initialq1 +
                        ',"initialq2" : ' + initialq2 +
                        ',"initialq3" : ' + initialq3 +
                        ',"initialq4" : ' + initialq4 +
                        ',"initialq5" : ' + initialq5 +
                        ',"initialq6" : ' + initialq6 +
                        ',"initialq7" : ' + initialq7 +
                        ',"initialq8" : ' + initialq8 +
                        ',"initialq9" : ' + initialq9 +
                        ',"initialq10" : ' + initialq10 +
                        ',"initialq11" : ' + initialq11 +
                        ',"initialq12" : ' + initialq12 +
                        '}';
                SendAjax("api/api.php?method=initialForm", postJSONData, "none", true);
                alreadyUploadedInitialFormThisSession = true;
            }
            else
            {
                console.log("Initial Form Already Uploaded for this session");
            }
        }

        function AjaxSubmit_InitialContactForm()
        {
            var ic_FirstName = $('input[name=firstName]').val();
            var ic_LastName = $('input[name=lastName]').val();
            var ic_Email = $('input[name=email]').val();
            var ic_PhoneAreaCode = $('input[name=phoneAreaCode]').val();
            var ic_PhoneFirstThree = $('input[name=phoneFirstThree]').val();
            var ic_PhoneLastFour = $('input[name=phoneLastFour]').val();
            var ic_Phone = "";
            if ((ic_PhoneAreaCode !== "") && (ic_PhoneFirstThree !== "") && (ic_PhoneLastFour !== ""))
            {
                ic_Phone = ic_PhoneAreaCode + '-' + ic_PhoneFirstThree + '-' + ic_PhoneLastFour;
            }

            var postJSONData = '{"ic_FirstName" : "' + ic_FirstName +
                    '","ic_LastName" : "' + ic_LastName +
                    '","ic_Email" : "' + ic_Email +
                    '","ic_Phone" : "' + ic_Phone +
                    '"}';
            SendAjax("api/api.php?method=contactForm", postJSONData, "none", true);
        }

        function AjaxSubmit_GetCOHContact()
        {
            var postJSONData = '{}';
            SendAjax("api/api.php?method=getCOHContact", postJSONData, AjaxSuccess_GetCOHContact, false);
        }

        function AjaxSuccess_GetCOHContact(returnJSONData)
        {
            $('#spanCOH_Phone').text(returnJSONData.data[0].phone);
            $('#spanCOH_FirstName').text(returnJSONData.data[0].firstname);
            $('#spanCOH_Email').text(returnJSONData.data[0].email);
            $('#aCOH_Email').attr("href", "mailto:" + returnJSONData.data[0].email + "?Subject=Expungement");
        }

    </script>
</body>
