$(document).ready(function(){
    $("#submitOrderButton").click(function(){
        console.log(data);
        $.post(BASE_URL + "submitOrder", data, function(response,status){
            console.log("status " + status);
            console.log("response " + response);
            window.location.href = BASE_URL + "/orders";
        });
    });
});