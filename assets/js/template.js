$(document).ready(function(){
    
    $('.btn_remover').click(function(e){
        
        e.preventDefault();
        
        var id = $(this).data('id');
        
        $('#confirma_remocao').attr('href',$('#confirma_remocao').attr('href') + '/' + id);
    });
    
    $('.btn_cancelar').click(function(e){
        
        window.history.back();
    });
});
