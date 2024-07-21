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





<div class="span12">
    <div class="span12">
        <div class="span8" >
            <label for="precoCompra" class="control-label">Preço de Compra<span
                    class="required">*</span></label>
            <div class="controls">
                <input  id="precoCompra" class="money span12" data-affixes-stay="true"
                    data-thousands="" data-decimal="." type="text" name="precoCompra"
                    value="<?php echo set_value('precoCompra'); ?>" />
            </div>
        </div>
        <div class="span4" >
        <div class="span12" >
        <label for="margemLucro" class="control-label">Margem</label>
            <input class="span12" id="margemLucro" name="margemLucro" type="text"
                placeholder="%" maxlength="3" size="2" />
    </div>
</div>
