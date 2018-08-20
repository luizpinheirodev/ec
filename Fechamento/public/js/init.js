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
        language: "pt",
        //show_previous: true,
        //show_next: 2,
        nav_icon: {
            prev: '<i class="fa fa-chevron-circle-left"></i>',
            next: '<i class="fa fa-chevron-circle-right"></i>'
        },
        //show_days: false,
        cell_border: true,
        today: true,
    });
    
    $('.collapsible').collapsible();
    $('.modal').modal();
    $('.modalNotify').modal();
    $('select').material_select();
    $('#pendencia').DataTable({
        "pageLength": 50,
        "order": [[ 5, "desc" ]],
        "language": {
            //"lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Não encontrado",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Não encontrado",
            "infoFiltered": "(filtered from _MAX_ total records)"
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
    

});


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
    if (document.getElementById('test2').checked) {
        document.getElementById('append').innerHTML = 'Por favor, justifique: <input type="text" id="outro" name="texto" required><br>';
        //document.getElementById('append').append('Por favor, justifique: <input type="text" id="outro" name="texto" required><br>');
        //document.getElementById('ifYes').style.visibility = 'visible';
    }
    else{
        //document.getElementById('ifYes').style.visibility = 'hidden'        
        document.getElementById('append').innerHTML = '';
    }

}