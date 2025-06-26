$.ajax({
    url: "./web_services/listar.php",
    type: 'POST', 
    success:(response)=>{
        response.data.map(item => {
            $('#course_1').append('<option value="'+ item.nome +'">' + item.nome + '</option>');

        })
    },
});

$.ajax({
    url: "./web_services/listar.php",
    type: 'POST', 
    success:(response)=>{
        response.data.map(item => {
            $('#course_2').append('<option value="'+ item.nome +'">' + item.nome + '</option>');

        })
    },
});

$.ajax({
    url: "./web_services/listar.php",
    type: 'POST', 
    success:(response)=>{
        response.data.map(item => {
            $('#course_3').append('<option value="'+ item.nome +'">' + item.nome + '</option>');

        })
    },
});



$( "#whatsapp" ).blur(function() {
  
  var whatsapp = $("#whatsapp").val();

  $.ajax({
            type: "POST",
            url: "web_services/includes/verificarwpp.php",
            data: "whatsapp="+ whatsapp,
            
            success: function(html){
            
            var sucesso = html;
            
            if(sucesso=='1'){
                    
                    $("#enviar").hide();
                    $("#errorwp").show();
                    $("#corrija").show();
                    
            
            }else{
                    $("#enviar").show();
                    $("#errorwp").hide();
                    $("#corrija").hide();
            }
            
        }
    });

});

$( "#email" ).blur(function() {
  
  var email = $("#email").val();

  $.ajax({
            type: "POST",
            url: "web_services/includes/verificarem.php",
            data: "email="+ email,
            
            success: function(html){
            
            var sucesso = html;
            
            if(sucesso=='1'){
                    
                    $("#enviar").hide();
                    $("#errorem").show();
                    $("#corrija").show();
                    
            
            }else{
                    $("#enviar").show();
                    $("#errorem").hide();
                    $("#corrija").hide();
            }
            
        }
    });

});