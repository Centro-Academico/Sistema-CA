$(document).ready(function(){ 
    
    verifica_materia();
    
    $("select[name=curso]").change(function(){
 
        curso = document.getElementById("curso").value;
         
        if ( curso === '')
            return false;
        
        resetaCombo('materia');
        
        //Maneira incorreta porem necessária para a continuação do projeto
        
        $.getJSON('http://localhost/sistema_sea/adm/cursos/get_materia/' + curso, function (data){
        
         //$.getJSON('http://sea.uni5.net/sistema_sea/adm/cursos/get_materia/' + curso, function (data){
 
            var option = new Array();
 
            $.each(data, function(i, obj){
 
                option[i] = document.createElement('option');
                $( option[i] ).attr( {value : obj.id} );
                $( option[i] ).append( obj.nome );
 
                $("select[name='materia']").append( option[i] );
         
            });
     
        });
     
    });
    
    function verifica_materia( el ) {

       curso = document.getElementById("curso").value;
       if ( curso === '')
            return false;
        else{
           $.getJSON('http://localhost/sistema_sea/adm/cursos/get_materia/' + curso, function (data){
            //$.getJSON('http://sea.uni5.net/sistema_sea/adm/cursos/get_materia/' + curso, function (data){
 
            var option = new Array();
 
            $.each(data, function(i, obj){
 
                option[i] = document.createElement('option');
                $( option[i] ).attr( {value : obj.id} );
                $( option[i] ).append( obj.nome );
                $("select[name='materia']").append( option[i] );
         
            });
     
        });
        }
    }
 
    function resetaCombo( el ) {

       $("select[name='"+el+"']").empty();
       var option = document.createElement('option');                                  
       $( option ).attr( {value : ''} );
       $( option ).append( 'Escolha uma matéria' );
       $("select[name='"+el+"']").append( option );
    }

    $("#data").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'
    });
});