
<script>
  var flagNoAction2 = true;
  $("#btnClickAlert").click();

  $('#alert-modal').off("click", ".btn-ok");

  $('#alert-modal').on('click', '.btn-ok', function(e) {
    var $modalDiv   = $(e.delegateTarget);
    var id_pedido   = $(this).data('recordId');
    var id_etiqueta = $(this).data('recordEtiqueta');

      $(this).html("Ciente..");

      $modalDiv.addClass('loading');
      setTimeout(function() {
        $("#alert-modal").modal('hide');
        flagNoAction2 = false;
          redirecionarPagina('<?= $link_confirma; ?>', 'id_pedido=' + "<?=$id_pedido?>" + '&id_etiqueta=' + "<?=$id_etiqueta?>");
      }, 1000)
    });

  $('#alert-modal').on('click', '.btn-close', function(e) {

    var $modalDivs = $(e.delegateTarget);
    $(this).html("Retornando..");
    $modalDivs.addClass('loading');
    setTimeout(() => {
      $("#alert-modal").modal('hide');
      flagNoAction2 = false;
        redirecionarPagina('<?= $link_cancelar; ?>', 'id_pedido=' + "<?=$id_pedido?>" + '&id_etiqueta=' + "<?=$id_etiqueta?>");
    }, 1000);
    return false;
  })

  setTimeout(()=>{
    if(flagNoAction2){
      $("#alert-modal").modal('hide');
      redirecionarPagina('expedicao/melhorenvio/index.php', 'id_pedido=' + "<?=$id_pedido?>" + '&id_etiqueta=' + "<?=$id_etiqueta?>");
    }
  }, 10000);


$('#alert-modal').on('show.bs.modal', function(e) {
  var data = $(e.relatedTarget).data();
  $('.title', this).text(data.recordTitle);
  $('.btn-ok', this).data('recordId', data.recordId);
});

</script>
