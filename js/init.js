$(document).ready(function () {

    /*
    $('.carousel.carousel-slider').carousel({
        //padding: 200,
        //duration: 10,
        fullWidth: true
    });
    setInterval(function(){
        $('.carousel.carousel-slider').carousel('next');
    }, 2000);
    */

    $('.slider').slider();

 

    
    $('.timepicker').pickatime({
        default: 'now', // Set default time: 'now', '1:30AM', '16:30'
        fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
        twelvehour: false, // Use AM/PM or 24-hour format
        donetext: 'OK', // text for done-button
        cleartext: 'Limpar', // text for clear-button
        canceltext: 'Cancelar', // Text for cancel-button
        autoclose: false, // automatic close timepicker
        ampmclickable: true, // make AM PM clickable
        aftershow: function(){} //Function for after opening timepicker
    });

    $('.datepicker').pickadate({
        selectMonths: true,
        selectYears: 15, 
        today: 'Hoje', 
        clear: 'Limpar',
        close: 'Ok',
        closeOnSelect: false
    });

    $("#my-calendar").zabuto_calendar({
        ajax: {
            url: "site/CalendarioController",
            modalM: true
        },
        weekstartson: 0,
        //today: true
    });


    
        
    
    $('.collapsible').collapsible();
    $('.modalM').modalM();
    //$('.modal').modal();
    //$('.modalBoots').modalBoots();
    $('.modalMNotify').modalM();
    //$('.modalNotify').modal();
    $('select').material_select();
    $('#pendencia').DataTable({
        "pageLength": 50,
        "order": [[ 0, "asc" ]],
        "language": {
            //"lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Não encontrado",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Não encontrado",
            "infoFiltered": "(filtered from _MAX_ total records)"
        }
    });

    $('#conta').DataTable({
        "pageLength": 500,
        "order": [[ 3, "asc" ]],
        "language": {
            //"lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Não encontrado",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Não encontrado",
            "infoFiltered": "(filtrado do total de _MAX_ registros)"
        }
    });

    $('.collapsible-comment').collapsible();
    
    $('.datepickerTarefa').pickadate({
        selectMonths: true,
        selectYears: 15, 
        today: 'Hoje', 
        clear: 'Limpar',
        close: 'Ok',
        closeOnSelect: true,
        
    });

    
    $('.timepickerTarefa').pickatime({
        default: 'now', // Set default time: 'now', '1:30AM', '16:30'
        fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
        twelvehour: false, // Use AM/PM or 24-hour format
        donetext: 'OK', // text for done-button
        cleartext: 'Limpar', // text for clear-button
        canceltext: 'Cancelar', // Text for cancel-button
        autoclose: false, // automatic close timepicker
        ampmclickable: true, // make AM PM clickable
        aftershow: function(){} //Function for after opening timepicker
    });
       // $(this).parents('.previsao').next().children().find('.timepickerTarefa').focus();


    //ComboBox para alterar periodo no Relatório/Pendencia.
    $('#selecPend').on('change', function(){
        var idP = $('#selecPend').val();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        window.location =  "/site/pendencia/" + idP;
        
    });   

    // On click gráfico dias
    document.getElementById("chamaHistoricoDias").onclick = function(evt){
        window.location =  "/site/periodo";
    };

    // On click contas críticas
    document.getElementById("chamaContas").onclick = function(evt){
        window.location =  "/site/contas";
    };

});

$('#alert_close').click(function(){
    $( "#alert_box" ).fadeOut( "slow", function() {});
});


function alertDia(id) {
    
    $.ajax({
        'processing': true, 
        'serverSide': true,
        datatype: "json",
        type: "GET",
        url: '/site/CalendarioController',
        data: {
            "_token" : $('meta[name="csrf-token"]').attr('content'),
        },
        success: function(response)
        {
           alert("ok");
        },
        
    })


    //var dia = $("#" + id).data("date");
    //var hasEvent = $("#" + id).data("hasEvent");
    //alert("Clicou no dia "+dia + ", possui eventos = " +hasEvent);
}

function jsresultado(){
    var idR = $('#idResult').val();
    //alert(idR);
    $.ajax({
        type: "POST",
        url: '/admin/resultadoSwitch/'+idR,
        data: {
            "_token" : $('meta[name="csrf-token"]').attr('content'),
        },
        success: function(response)
        {
           alert("Resultado alterado");
        },
        error: function(xhr)
        {
          alert(xhr.responseText);
        }
        
   });



}

function jsperiodo(){
    var id = $('#idPeriodo').val();
    //alert(id);
    $.ajax({
        type: "POST",
        url: '/admin/periodoSwitch/'+id,
        data: {
            "_token" : $('meta[name="csrf-token"]').attr('content'), 
        },
        success: function(response)
        {
           alert("Periodo alterado");
        },
        error: function(xhr)
        {
          alert(xhr.responseText);
        }
        
   });
}


function yesnoCheck() {
    if (document.getElementById('test').checked) {
        document.getElementById('append2').innerHTML = '';
        document.getElementById('append3').innerHTML = '';
        document.getElementById('append').innerHTML = 'Por favor, justifique: <input pattern=".{5,}" type="text" id="atraso" name="texto" required title="Min 5 caracteres"><br>';
    }
    else if (document.getElementById('test2').checked) {
        document.getElementById('append').innerHTML = '';
        document.getElementById('append3').innerHTML = '';
        document.getElementById('append2').innerHTML = 'Por favor, indique Problema/Requisição: <input pattern=".{5,}" type="text" id="atraso" name="texto" required title="Min 5 caracteres"><br>';

    }else{
        document.getElementById('append').innerHTML = '';
        document.getElementById('append2').innerHTML = '';
        document.getElementById('append3').innerHTML = 'Por favor, justifique: <input pattern=".{5,}" type="text" id="atraso" name="texto" required title="Min 5 caracteres"><br>';
    }
}


