$(document).ready(function(){
    $('#list-tab a').on('click', function (e) {
        console.log("click detected");
        console.log($(this));
        var receiptId = $(this)[0].childNodes[1].childNodes[1].innerText;
        data = {receiptId: receiptId};
        console.log(data);
        $.post(BASE_URL + "orderItems", data, function(response,status){
            console.log("in post");
            console.log("status " + status);
            console.log("response " + response);
            $("#orderItems").html(response);
        });
    
    });
    $(".confirmOrder").click(function(e){
        e.stopPropagation();
        var receiptId = $(this).closest('a')[0].childNodes[1].childNodes[1].innerText;
        $.post(BASE_URL + "confirmOrder", {receiptId: receiptId}, function(response,status){
            console.log("status " + status);
            console.log("response " + response);
        });
    });
    $(".cancelOrder").click(function(){
        var receiptId = $(this).closest('a')[0].childNodes[1].childNodes[1].innerText;
        $.post(BASE_URL + "cancelOrder", {receiptId: receiptId}, function(response,status){
            console.log("status " + status);
        });
    });
});

