function SendAjax(urlMethod, postJSONData, returnFunction, asyncTorF) {
    $.ajax({
        type: "POST",
        data: {"data": postJSONData},
        dataType: "json",
        url: urlMethod,
        async: asyncTorF,
        success: function (returnJSONData, status, xhr)
        {
            console.log("Ajax Success! URL: " + urlMethod);
            //console.log("Response: " + xhr.responseText);

            if (returnJSONData !== null && returnFunction !== "none")
            {
                returnFunction(returnJSONData);
            }
        },
        error: function (xhr, status, error)
        {
            console.error("Ajax Error! - URL: " + urlMethod);
            console.log("Response: " + xhr.responseText);
        }
    });
}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    return !(charCode > 31 && (charCode < 48 || charCode > 57));
}
// dash - 189; space - 32; alpha num - 65-90
function isAlphaKey(e) {
    var AllowableCharacters = ' ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-.\'';

    var k = document.all ? parseInt(e.keyCode) : parseInt(e.which);
    if (k !== 13 && k !== 8 && k !== 0) {
        if ((e.ctrlKey === false) && (e.altKey === false)) {
            return (AllowableCharacters.indexOf(String.fromCharCode(k)) !== -1);
        } else {
            return true;
        }
    } else {
        return true;
    }
}

$(function () {
    $("[rel=tooltip]").tooltip({
        placement: 'right',
        container: 'body'
    });
});

$(function () {
    $('#accordion').on('shown.bs.collapse', function (e) {
        var offset = $(this).find('.collapse.in').prev('.panel-heading');
        if (offset) {
            $('html,body').animate({
                scrollTop: $(offset).offset().top - 60
            }, 200);
        }
    });
});

function submitForm(form) {
    var postJSONData = $(form).serializeArray();
    postJSONData = JSON.stringify(postJSONData);
    SendAjax("api/api.php?method=userBudgetFormSubmit", postJSONData, "none", true);
}