$(document).ready(function(){
    $.get(BASE_URL + "/customerList", {role:role},  function(response,status){
        if(status == "success"){
            var html = "";
            console.log("success");
            console.log(JSON.parse(response));
            
            $.each(JSON.parse(response), function(i, val){
                var row = "<tr>" +
                "<td>" + (i + 1) + "</td>" +
                "<td>" + val.User_Id + "</td>" +
                "<td>" + val.Username + "</td>" +
                "<td>" + val.User_First_Name + "</td>" +
                "<td>" + val.User_Last_Name + "</td>" +
                "<td>" + ((val.Role_Id == 3) ? "Customer" : "Salesman") + "</td>" + 
                "<td>" + ((val.User_Confirmed == 1) ? '<button type="button" class="deactivate btn btn-xs btn-danger">Deactivate</button><button type="button" class="activate btn btn-xs btn-primary" style="display: none;">Activate</button>' 
                        : '<button type="button" class="deactivate btn btn-xs btn-danger" style="display: none;">Deactivate</button><button type="button" class="activate btn btn-xs btn-primary">Activate</button>' ) + "</td>" + 
                "<td>" + '<button type="button" class="profileButton btn btn-xs btn-secondary">Profile</button>' + "</td></tr>";
                html += row;
            });
            $("#dynamicTable").html(html);
        }
        else
            console.log("failed");
    });
    
    $(document).on('click', '.deactivate', function(){ 
        var username = $(this).closest('tr')[0].childNodes[2].innerText;
        console.log($(this).closest('tr')[0].childNodes[2].innerText);
        var button = $(this);
        $.post(BASE_URL + "/toggleConfirmation", {username: username, confirmed: 0}, function (response, status){
            if(status == "success"){
                console.log("Post successful");
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
        var username = $(this).closest('tr')[0].childNodes[2].innerText;
        console.log($(this).closest('tr')[0].childNodes[2].innerText);
        var button = $(this);
        $.post(BASE_URL + "/toggleConfirmation", {username: username, confirmed: 1}, function (response, status){
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
    
    $(document).on('click', '.profileButton', function(){ 
        var rowUserId = $(this).closest('tr')[0].childNodes[1].innerText;
        var rowRole = $(this).closest('tr')[0].childNodes[5].innerText;
        var rowRoleId = rowRole == "Customer" ? 3 : 2;
        window.location.href = BASE_URL + "/profile?role=" + rowRoleId + "&userId=" + rowUserId;
        //$.get(BASE_URL + "/profile", {role:rowRoleId, userId: rowUserId},  function(response,status){
         //   console.log(status);
          //  console.log(response);
        //});
    });
});

