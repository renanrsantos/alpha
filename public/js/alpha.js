function setOptionsWithJson(select, urlJson,data = null){
    select.attr('readonly',true).attr('disabled',true);
    select.find('option').each(function(){
        if($(this).val() !== ""){
            $(this).remove();
        }
    });
    $.get(urlJson,data,function(response){
        response = JSON.parse(JSON.stringify(response));
        for(i = 0; i < response.length; i++){
            var option = $('<option></option>').html(response[i].label).val(response[i].value);
            select.append(option);
        }
        select.val("");
        select.attr('readonly',false).attr('disabled',false);
    });
}

function formataData(d){
    return d.getFullYear() + '-' + ("00" + d.getMonth()).slice(-2)  + '-' + ("00" + d.getDate()).slice(-2) ;
}

function clear(elementos){
    for(i = 0; i < elementos.length; i++){
        $(elementos[i]).html('');
    }
}

$.extend(true, $.fn.dataTable.defaults, {
    "language": {
        "sEmptyTable": "Não há registros",
        "sInfo": "Total <b>_TOTAL_</b>",
        "sInfoEmpty": "Total <b><font color='red'>0</font></b>"
    }
});

$(document).ready(function(){

    $('form[data-toggle="validator"]').vindicate('init');

    $('form[data-toggle="validator"]').on('submit',function(e){
        if(!$(this).vindicate('validate')){
            e.preventDefault();
            e.stopPropagation();
        }
    });
    
    $('body').on('click','button[type="submit"]' ,function (e) {
        var form = $(this).closest('form');
        form.prop('submited',true);
    });
    
    $('body').on('input change','[data-function="vindicate"]',function(){
        var form = $(this).closest('form');
        if(form.prop('submited')){
            form = form.vindicate("get");
            var id = $(this).attr("id");
            var field = form.findById(id);
            field.validate(form.options);
        }
    });

    $('#periodo').on('change',function(){
        var diaInicio = '', diaFim = '';
        if($(this).val() === '1'){
            var dec = [1,2,3,4,5,6,0];
            var inc = [5,4,3,2,1,0,6];
            var d = new Date();
            var diaDaSemana = d.getDay() - 1;
            var diaInicio = new Date();
            var diaFim = new Date();
            diaInicio.setMonth(diaInicio.getMonth()+1);
            diaFim.setMonth(diaFim.getMonth()+1);
            diaInicio.setDate(d.getDate() - dec[diaDaSemana] -7);
            diaFim.setDate(d.getDate() + inc[diaDaSemana] -7);
            diaInicio = formataData(diaInicio);
            diaFim = formataData(diaFim);
        } else if($(this).val() === '2') {
            var d = new Date(), y = d.getFullYear(), m = d.getMonth()+1;
            var diaInicio = formataData(new Date(y, m, 1));
            var diaFim = new Date(y, m + 1);
            diaFim.setDate(diaFim.getDate() -1);
            diaFim = formataData(diaFim);
        } 
        $('#datainicio').val(diaInicio);
        $('#datafim').val(diaFim);
    });
});