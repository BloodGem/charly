
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


  $container.append('<h6>alt + s -> Esconder comandos</h6>')


  $container.append('<h6>alt + c -> elegir cliente</h6>')


  $container.append('<h6>alt + b -> buscar producto</h6>')


  $container.append('<h6>alt + t -> elegir tipo de venta</h6>')


  $container.append('<h6>alt + 1 -> confirmar venta</h6>')


})(jQuery)