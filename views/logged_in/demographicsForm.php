<?php
$db_connection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

$sql = $db_connection->prepare("SELECT firstName, lastName, phone, phoneCanText, isMarried, spouseFirstName, spouseLastName, spouseEmail, dependent0_4, dependent5_18 FROM users WHERE userId = :userId");

$sql->bindParam(':userId', $_SESSION['user_id']);

if ($sql->execute())
{
    $ResultsToReturn = $sql->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div class='container theme-showcase'>
    <div class="panel panal-content panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Demographic & Contact Information</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" id="formDemographics" data-parsley-validate>

                <div id="nameGroup" class="form-group">
                    <label for="firstName" style="margin-left:15px; width: 100px" >First Name:</label>
                    <input type="text" style="margin-left:30px; width: 195px" id="firstName" name="firstName" placeholder="First Name" value="<?php echo $ResultsToReturn[0]["firstName"] ?>" data-parsley-group="firstName" required data-parsley-required-message="Please enter your First Name">
                    <label for="lastName" style="margin-left:15px; width: 100px">Last Name:</label>
                    <input type="text" style="margin-left:30px; width: 175" id="lastName" name="lastName" placeholder="Last Name" value="<?php echo $ResultsToReturn[0]["lastName"] ?>" data-parsley-group="lastName" required data-parsley-required-message="Please enter your Last Name">
                </div>

                <div id="divPhone" class="form-group">
                    <label for="phone" style="margin-left:15px; width: 125px">Phone:</label>
                    <input type="text" style="margin-left:5px; width: 50px" name="phoneAreaCode" onkeypress='return isNumberKey(event);' placeholder="###" value="<?php echo substr($ResultsToReturn[0]["phone"], 0, 3) ?>" data-parsley-group="phone" maxlength="3" size="3" data-parsley-length="[3, 3]" data-parsley-error-message="3 Digits Required"/>
                    <input type="text" style="margin-left:5px; width: 50px" name="phoneFirstThree" onkeypress='return isNumberKey(event);' placeholder="###" value="<?php echo substr($ResultsToReturn[0]["phone"], 4, 3) ?>" data-parsley-group="phone" maxlength="3" size="3" data-parsley-length="[3, 3]" data-parsley-error-message="3 Digits Required"/>
                    <input type="text" style="margin-left:5px; width: 75px" name="phoneLastFour" onkeypress='return isNumberKey(event);' placeholder="####" value="<?php echo substr($ResultsToReturn[0]["phone"], 8, 4) ?>" data-parsley-group="phone" maxlength="4" size="4" data-parsley-length="[4, 4]" data-parsley-error-message="4 Digits Required"/>

                    <label for="doYouText" style="margin-left:15px">Do You Text:</label>
                    <input id="phoneCanText" name="phoneCanText" type="checkbox" <?php if ($ResultsToReturn[0]["phoneCanText"] == "0"){echo "checked";} ?> style="margin-left:45px">

                </div>
                <div class="invalid-form-error-message-require-emailORphone"></div>

                <div id="additional"class="form-group">
                    <label for="additionalPerson" style="margin-left:15px">I'm married (Have someone living in the home that I want to include)</label>
                    <input id="isMarried" name="isMarried" type="checkbox" <?php if ($ResultsToReturn[0]["isMarried"] == "0"){echo "checked";} ?> style="margin-left:105px">
                </div>

                <div id="secondNameGroup" class="form-group">
                    <label for="spouseFirstName" style="margin-left:15px; width: 100px" >First Name:</label>
                    <input type="text" style="margin-left:30px; width: 195px" id="spouseFirstName" name="spouseFirstName" placeholder="First Name" value="<?php echo $ResultsToReturn[0]["spouseFirstName"] ?>" data-parsley-group="firstName" required data-parsley-required-message="Please enter your First Name">
                    <label for="spouseLastName" style="margin-left:15px; width: 100px">Last Name:</label>
                    <input type="text" style="margin-left:30px; width: 195px" id="spouseLastName" name="spouseLastName" placeholder="Last Name" value="<?php echo $ResultsToReturn[0]["spouseLastName"] ?>" data-parsley-group="lastName" required data-parsley-required-message="Please enter your Last Name">
                </div>

                <div id="divEmail" class="form-group">
                    <label for="spouseEmail" style="margin-left:15px; width: 100px">Email:</label>
                    <input id="spouseEmail" style="margin-left:30px; width: 300px" type="email" name="spouseEmail" placeholder="Email" value="<?php echo $ResultsToReturn[0]["spouseEmail"] ?>" data-parsley-group="email"/>
                </div>

                <div id="under4" class="form-group">
                    <label for="dependent0_4" style="margin-left:15px; width: 400px" >Number of Children 0-4 you support:</label>
                    <input id="dependent0_4" name="dependent0_4" type="text" onkeypress='return isNumberKey(event);' value="<?php echo $ResultsToReturn[0]["dependent0_4"] ?>" style="margin-left:15px">
                </div>

                <div id="over5" class="form-group">
                    <label for="dependent5_18" style="margin-left:15px; width: 400px">Number of Children 5-18 you support:</label>
                    <input id="dependent5_18" name="dependent5_18" type="text" onkeypress='return isNumberKey(event);' value="<?php echo $ResultsToReturn[0]["dependent5_18"] ?>" style="margin-left:15px">
                </div>

                <div id="totalHousehold" class="form-group">
                    <label for="totalHousehold" style="margin-left:15px; width: 400px">Total number of household members you support:</label>
                    <input type="text" onkeypress='return isNumberKey(event);' style="margin-left:15px">
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="button" value="Submit" class="btn btn-primary pull-right" onclick="submitDemographicsForm(this.form)"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type = "text/javascript">
    function submitDemographicsForm(form)
    {
        var postJSONData = $(form).serializeObject();
        postJSONData = JSON.stringify(postJSONData);

        SendAjax("api/api.php?method=userDemographicsFormSubmit", postJSONData, "none", true);
    }
</script>