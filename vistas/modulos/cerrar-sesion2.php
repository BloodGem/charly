<?php

session_destroy();
echo "<script>
	Swal.fire({
                icon: 'error',
                title: 'Se inicio sesión en esta cuenta en otro lado',
                text: 'Se cerrará la sesión aquí',
                showConfirmButton: true
                }).then(function(result){

                  window.location = 'login';
                });
</script>";
?>