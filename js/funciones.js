function get_horarios_completos(){
    var data = ""
    $.ajax({
        url: "php/funciones.php",
        type: "POST",
        data: 'opc=get_horarios_completos',
        dataType: "json",
        success: function(json){
            data = json;
            // var html = "";
            // for (var i = 0; i < json.data.length; i++) {
            //     html += '<tr>'+
            //              '<td>'+json.data[i].nombre_horario+'</td>'+
            //              '</tr>';
            // }
            // $("#tbody_horarios").html(html);
        },
        error:function(error){

        },
        async: false
    });
    return data;
}