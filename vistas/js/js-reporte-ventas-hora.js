/*=============================================
REVISAR SI LA FAMILIA NO ESTA VACIA
=============================================*/
function validarFechaInicial() {
if($("#fechaInicialRVH").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir una fecha inicial',
        showConfirmButton: false,
        timer: 2000
        });

        $("#fechaInicialRVH").focus();
        
        return 0;
        
        
    }else{
    
    return 1;
    }
    
    
    
}





function validarFechaFinal() {
if($("#fechaFinalRVH").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir una fecha final',
        showConfirmButton: false,
        timer: 2000
        });

        $("#fechaFinalRVH").focus();
        
        return 0;
        
        
    }else{
    
    return 1;
    }
    
    
    
}










$(document).on("click", "#btnGenerarReporteVentasHora", function(){
    
    $(this).blur();

    validar_fecha_final = validarFechaFinal();
    validar_fecha_inicial = validarFechaInicial();
    
    

if(validar_fecha_inicial !== 0 && validar_fecha_final  !== 0){
    
    document.forms["formularioGenerarReporteVentasHora"].submit();
}

   

});