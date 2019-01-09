$(document).ready(function(){
    $.get(BASE_URL + "/itemList", {role:role}, function(response,status){
        if(status == "success"){
            var html = "";
            console.log("success");
            console.log(JSON.parse(response));
            
            $.each(JSON.parse(response), function(i, val){
                var row = "<tr>" +
                "<td>" + (i + 1) + "</td>" +
                "<td>" + val.Item_Id + "</td>" +
                "<td>" + val.Item_Name + "</td>" +
                "<td>" + val.Item_Price + "</td>" +
                "<td>" + ((val.Item_Activated == 1) ? '<button type="button" class="deactivate btn btn-xs btn-danger">Deactivate</button><button type="button" class="activate btn btn-xs btn-primary" style="display: none;">Activate</button>' 
                        : '<button type="button" class="deactivate btn btn-xs btn-danger" style="display: none;">Deactivate</button><button type="button" class="activate btn btn-xs btn-primary">Activate</button>' ) + "</td>" + 
                "<td>" + '<button type="button" class="detailsButton btn btn-xs btn-secondary">Change item</button>' + "</td></tr>";
                html += row;
            });
            $("#dynamicTable").html(html);
        }
        else
            console.log("failed");
    });
    
    $(document).on('click', '.deactivate', function(){
        var itemId = $(this).closest('tr')[0].childNodes[1].innerText;
        console.log($(this).closest('tr')[0].childNodes[1].innerText);
        var button = $(this);
        $.post(BASE_URL + "/toggleActivation", {itemId: itemId, activated: 0}, function (response, status){
            if(status == "success"){
                console.log("Post successful");
                console.log(response);
                button.hide();
                var otherButton = button.siblings();
                otherButton.show();
            }
            else{
                console.log("Post failed");
            }
        });
    });
    $(document).on('click', '.activate', function(){
        var itemId = $(this).closest('tr')[0].childNodes[1].innerText;
        console.log($(this).closest('tr')[0].childNodes[1].innerText);
        var button = $(this);
        $.post(BASE_URL + "/toggleActivation", {itemId: itemId, activated: 1}, function (response, status){
            if(status == "success"){
                console.log("Post successful");
                button.hide();
                var otherButton = button.siblings();
                otherButton.show();
            }
            else
                console.log("Post failed");
        });
    });
    
    $(document).on('click', '.detailsButton', function(){ 
        var itemId = $(this).closest('tr')[0].childNodes[1].innerText;
        window.location.href = BASE_URL + "addItem?itemId=" + itemId;
    });
    
    $("#addItemButton").click(function(){
        window.location.href = BASE_URL + "addItem";
    });
});

