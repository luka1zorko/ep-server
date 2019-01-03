$(document).ready(function(){
    $.get(BASE_URL + "/customerList", {role:role},  function(response,status){
        if(status == "success"){
            var html = "";
            console.log("success");
            console.log(JSON.parse(response));
            
            $.each(JSON.parse(response), function(i, val){
                var row = "<tr>" +
                "<td>" + (i + 1) + "</td>" +
                "<td>" + val.Username + "</td>" +
                "<td>" + val.User_First_Name + "</td>" +
                "<td>" + val.User_Last_Name + "</td>" +
                "<td>" + ((val.Role_Id == 3) ? "Customer" : "Salesman") + "</td>" + 
                "<td>" + ((val.User_Confirmed == 1) ? '<button type="button" class="deactivate btn btn-xs btn-danger">Deactivate</button>' : '<button type="button" class="activate btn btn-xs btn-primary">Activate</button>') + "</td>" + 
                "</tr>";
                html += row;
            });
            $("#dynamicTable").html(html);
        }
        else
            console.log("failed");
    });
    
    $(document).on('click', '.deactivate', function(){ 
        console.log("CLICKED");
        var username = $(this).closest('tr')[0].childNodes[1].innerText;
        console.log($(this).closest('tr')[0].childNodes[1].innerText);
        $.post(BASE_URL + "/toggleConfirmation", {username: username, confirmed: 0}, function (response, status){
            console.log(status);
        });
    });
    $(document).on('click', '.activate', function(){
        console.log("CLICKED");
        var username = $(this).closest('tr')[0].childNodes[1].innerText;
        console.log($(this).closest('tr')[0].childNodes[1].innerText);
        $.post(BASE_URL + "/toggleConfirmation", {username: username, confirmed: 1}, function (response, status){
            console.log(status);
        });
    });
});

