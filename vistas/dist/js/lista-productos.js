
(function ($) {
  'use strict'



  function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1)
  }


  var $sidebar = $('.control-sidebar')
  var $container = $('<div />', {
    class: 'p-3 control-sidebar-content'
  })

  $sidebar.append($container)

  // Checkboxes

  $container.append(
    '<h5>Comandos</h5><hr class="mb-2"/>'
  )



  // Navbar Variants


  $container.append('<h6>alt + s --- Esconder comandos</h6>')

  $container.append('<h6>alt + b --- Buscar producto</h6>')

  $container.append('<h6>ctrl + b --- Buscar producto</h6>')

  $container.append('<h6>shift + tab --- Recorrer registros hacia arriba</h6>')

  $container.append('<h6>tab --- Recorrer registros hacia abajo</h6>')

  $container.append('<h6>ctrl + &uarr; --- Recorrer registros hacia arriba</h6>')

  $container.append('<h6>ctrl + &darr; --- Recorrer registros hacia abajo</h6>')

  $container.append('<h6>Enter --- Selecciona botón encendido</h6>')

})(jQuery)