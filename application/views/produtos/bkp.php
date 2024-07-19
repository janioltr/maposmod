


<




<div class="span3 div-bord" style="padding: 1%; margin-left: 1" >

<div class="span12 control-group">
    <label class="control-label">Tipo de Movimento</label>
    <div>
    <div class="span12 controls">
        <label for="entrada" class="span6 btn btn-default" style="margin-top: 5px;">Entrada
            <input type="checkbox" id="entrada" name="entrada" class=" badgebox" value="1" checked>
            <span class="badge">&check;</span>
        </label>
        <label for="saida" class="span6 btn btn-default" style="margin-top: 5px;">Saída
            <input type="checkbox" id="saida" name="saida" class="badgebox" value="1" checked>
            <span class="badge">&check;</span>
        </label>
    </div>
    </div>
</div>

<div >
<div class="span12 control-group">
    <label for="unidade" class="control-label">Unidade<span class="required">*</span></label>
    <div class="controls">
        <select class="span12" id="unidade" name="unidade" ></select>
    </div>
</div>
</div>

<div>
<div class="span12 control-group">
    <label for="estoque" class="control-label">Estoque<span class="required">*</span></label>
    <div class="controls">
        <input class="span12" id="estoque" type="text" name="estoque"
            value="<?php echo set_value('estoque'); ?>" />
    </div>
</div>
</div>


<div>
<div class="span12 control-group">
    <label for="estoqueMinimo" class="control-label">Estoque Mínimo</label>
    <div class="controls">
        <input class="span12" id="estoqueMinimo" type="text" name="estoqueMinimo"
            value="<?php echo set_value('estoqueMinimo'); ?>" />
    </div>
</div>
</div>

<div>
<div class="span12 control-group">
<div class="span8">
    <div class="span12" >
        <label for="precoCompra" class="control-label">Preço de Compra<span
                class="required">*</span></label>
        <div class="controls">
            <input  id="precoCompra" class="money span12" data-affixes-stay="true"
                data-thousands="" data-decimal="." type="text" name="precoCompra"
                value="<?php echo set_value('precoCompra'); ?>" />
            
        </div>
    </div>
    
</div>
    <div class="span4" >
        <div class="span12" >
        <label for="margemLucro" class="control-label">Margem</label>
        <input class="span12" id="margemLucro" name="margemLucro" type="text"
            placeholder="%" maxlength="3" size="2" />
        <strong><span style="color: red" id="errorAlert"></span><strong></strong>
        </div>
    </div>
    
</div>
</div>

<div class="control-group">
    <label for="precoVenda" class="control-label">Preço de Venda<span
            class="required">*</span></label>
    <div class="controls">
        <input id="precoVenda" class="money span12" data-affixes-stay="true" data-thousands=""
            data-decimal="." type="text" name="precoVenda"
            value="<?php echo set_value('precoVenda'); ?>" />
    </div>
</div>

</div>


<label for="margemLucro" class="control-label">Margem</label>










<div class="span4" >
                                            <div class="span12" >
                                            
                                            <div class="">
                                            <label for="margemLucro" class="control-label">Margem</label>
                                                <input class="span12" id="margemLucro" name="margemLucro" type="text"
                                                    placeholder="%" maxlength="3" size="2" />
                                                <strong><span style="color: red" id="errorAlert"></span><strong></strong>
                                            </div>
                                            </div>
                                            </div>
                                            
                                        </div>