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
            console.error("Ajax Error! - URL: " + urlMethod + " - Response: " + xhr.responseText);
        }
    });
}