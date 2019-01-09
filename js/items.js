$(document).ready(function(){
    $("#saveCartButton").click(function(){
        console.log("before cart save");
        console.log(cart);
        $.post(BASE_URL + "saveCart", cart, function(response,status){
                console.log("in post");
                console.log(response);
                if(status == "success"){
                    console.log("success");
                }
                else
                    console.log("failed");
        }); 
    });
    
    $("#emptyCartButton").click(function(){
        if(userId > 0){
            console.log("before cart empty");
            console.log(cart);
            $.post(BASE_URL + "emptyCart", function(response,status){
                console.log("in post");
                console.log(response);
                if(status == "success"){
                    console.log("success");
                }
                else
                    console.log("failed");
            }); 
        }
    });
});

