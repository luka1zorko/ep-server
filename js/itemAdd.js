$(document).ready(function(){
    console.log(itemId);
    if(itemId != 0){
        $("#heading").html("Edit item");
        $("input[name=itemName]").val("uij");
        $("input[name=itemPrice]").val("hbjnk");
        $("textarea[name=description]").val("zzu");
    }
    else
        $("#heading").html("Create a new item");
    $("#saveItemButton").click(function(){
        var itemName = $("input[name=itemName]").val();
        var itemPrice = $("input[name=itemPrice]").val();
        var description = $("textarea[name=description]").val();
        var data = {itemName: itemName, itemPrice: itemPrice, description: description, activated: 1};  
        if(itemId != 0){
            console.log("before update post");
            console.log(data);
            $.post(BASE_URL + "item/edit", data, function(response,status){
                console.log("in post");
                console.log(response);
                if(status == "success"){
                    console.log("success");
                }
                else
                    console.log("failed");
            });
        }
        else{
            console.log("before create post");
            console.log(data);
            $.post(BASE_URL + "addItem", data, function(response,status){
                console.log("in post");
                console.log(response);
                if(status == "success"){
                    console.log("success");
                }
                else
                    console.log("failed");
            });
        }
        $("#addItemForm")[0].reset(); 
    });
});

