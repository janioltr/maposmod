<?

<div class="control-group">
<label for="condicaoProduto" class="control-label">Condição<span class="required"></span></label>
<div class="controls">
<select class="" name="condicaoProduto" id="condicaoProduto" value="">
    <option <?php if ($result->condicaoProduto == 'Novo') {
        echo 'selected';
    } ?> value="Novo">Novo
    </option>
    <option <?php if ($result->condicaoProduto == 'Usado') {
        echo 'selected';
    } ?>   value="Usado">Usado
    </option>
    <option <?php if ($result->condicaoProduto == 'Recondicionado') {
        echo 'selected';
    } ?>   value="Recondicionado">Recondicionado
    </option>
    <option <?php if ($result->condicaoProduto == 'Suspeito') {
        echo 'selected';
    } ?> value="Suspeito">Suspeito
    </option>
    <option <?php if ($result->condicaoProduto == 'Defeito') {
        echo 'selected';
    } ?> value="Defeito">Defeito
    </option>
</select>
</div>
</div>