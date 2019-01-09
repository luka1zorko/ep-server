$(document).ready(function(){
    var indexNum = 0;
    var picSrc = [];
    for(var i = 0; i < images.length; i++){
        picSrc[i] = ".." + images[i]['Image_Path'] + images[i]['Image_Name'];
    }
    $("img").attr('alt', 'No images available for this item');
    $("img").attr('src', picSrc[indexNum]).fadeIn();
    console.log(picSrc);
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
    document.onkeypress = function(e){
        if (e.keyCode == 37 && indexNum > 0) {
            indexNum--;
            $("img").attr('src', picSrc[indexNum]).fadeIn();
            console.log($("img"));
        }

        else if (e.keyCode == 39 && indexNum < picSrc.length - 1) {
            indexNum++;
            $("img").attr('src', picSrc[indexNum]).fadeIn();
        }
    }
});

