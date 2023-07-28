
<script>
  var flagNoAction   = true;
  $("#btnClick").click();
  clearTimeout(time_sem_acao);


  $('#confirm-modal').off("click", ".btn-ok");

  $('#confirm-modal').on('click', '.btn-ok', function(e) {
    var $modalDiv   = $(e.delegateTarget);
    var id_pedido   = $(this).data('recordId');
    var id_etiqueta = $(this).data('recordEtiqueta');
    clearTimeout(time_direito);

      $(this).html("Confirmando..");

      $modalDiv.addClass('loading');
      var time_direito = setTimeout(function() {
        $("#confirm-modal").modal('hide');
        flagNoAction = false;
          redirecionarPagina('<?= $link_confirma; ?>', 'id_pedido=' + "<?=$id_pedido?>" + '&id_etiqueta=' + "<?=$id_etiqueta?>");
      }, 1000)
    });

  $('#confirm-modal').on('click', '.btn-esquerdo', function(e) {
    var $modalDivE   = $(e.delegateTarget);
    clearTimeout(time_esquerdo);

      $(this).html("Confirmando..");

      $modalDivE.addClass('loading');
      var time_esquerdo = setTimeout(function() {
        $("#confirm-modal").modal('hide');
        flagNoAction = false;
          redirecionarPagina('<?= $link_esquerdo; ?>', 'id_pedido=' + "<?=$id_pedido?>" + '&id_etiqueta=' + "<?=$id_etiqueta?>");
      }, 1000)
    });

  $('#confirm-modal').on('click', '.btn-cancelar, .btn-close', function(e) {
    clearTimeout(time_close);

    var $modalDivs = $(e.delegateTarget);
    $(this).html("Retornando..");
    $modalDivs.addClass('loading');
    var time_close = setTimeout(() => {
      $("#confirm-modal").modal('hide');
      flagNoAction = false;
        redirecionarPagina('<?= $link_cancelar; ?>', 'id_pedido=' + "<?=$id_pedido?>" + '&id_etiqueta=' + "<?=$id_etiqueta?>");
    }, 1000);
    return false;
  })

  var time_sem_acao = setTimeout(()=>{
    if(flagNoAction){
      $("#confirm-modal").modal('hide');
      redirecionarPagina('expedicao/melhorenvio/index.php', 'id_pedido=' + "<?=$id_pedido?>" + '&id_etiqueta=' + "<?=$id_etiqueta?>");
    }
  }, '<?=$tempo_sem_acao?>');

$('#confirm-modal').on('show.bs.modal', function(e) {
  var data = $(e.relatedTarget).data();
  $('.title', this).text(data.recordTitle);
  $('.btn-ok', this).data('recordId', data.recordId);
});

</script>
