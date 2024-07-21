<

<form id="formProduto" enctype="multipart/form-data" method="post">
    <div class="span10">
        <input type="hidden" name="idProdutoImg" id="idProdutoImg" value="<?php echo isset($idProduto) ? $idProduto : ''; ?>" />
        <label for="userfile">Anexo</label>
        <input type="file" class="span12" name="files[]" multiple="multiple" size="20" />
    </div>
    <div class="span2">
        <label for="submit">.</label>
        <button type="submit" class="button btn btn-success">
            <span class="button__icon"><i class='bx bx-paperclip'></i></span><span class="button__text2">Anexar</span>
        </button>
    </div>
</form>
<div id="divAnexos"></div>
