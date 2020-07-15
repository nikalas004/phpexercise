$(document).ready( function() {
   $(".submit").click( function() {
       var nameInput = $(".name").val();
       var emailInput = $(".email").val();
       var numberInput = $(".number").val();
       var cityInput = $(".city").val();
       var addressInput = $(".address").val();

       $.ajax({
           type: "POST",
           url: "../request",
           dataType: "json",
           data: {
               target: "User",
               action: "addUser",
               name: nameInput,
               email: emailInput,
               number: numberInput,
               city: cityInput,
               address: addressInput
           },
           success: function(data) {
               alert("User added!");
               location.href = "../users";
           }
       });
   });
});