$(document).ready(function(){
    $.get(BASE_URL + "/customerList", function(response,status){
        if(status == "success"){
            var html = "";
            console.log("success");
            console.log(response);
            
            $.each(response, function(i, val){
                var row = "<tr><td>" + i + "</td>" +
                "<td>" + i + "</td>" +
                "<td>" + val.Username + "</td>" +
                "<td>" + val.User_First_Name + "</td>" +
                "<td>" + val.User_Last_Name + "</td>" +
                "<td>" + val.Role_Id == 3 ? "Customer" : "Salesman" + "</td></tr>"
                ;
                html += row;
            });
            $("#dynamicTable").html(html);
        }
        else
            console.log("failed");
    });
});


 //add generated tr html to corresponding table