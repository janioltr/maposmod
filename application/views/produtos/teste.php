<?php

<div class="control-group">
    <label for="nomeModelo" class="control-label">Modelo<span class="required">*</span></label>
    <div class="controls">
        <input id="nomeModelo" type="text" name="nomeModelo" value="<?php echo $result->nomeModelo; ?>" onChange="javascript:this.value=this.value.toUpperCase();" />
        <button type="button" id="addCompativelProduto" class="btn btn-primary">Adicionar</button>
    </div>
</div>

<div id="additionalCompativelProdutos">
    <?php if (!empty($compativelProdutos)) : ?>
        <?php foreach ($compativelProdutos as $index => $compativelProduto) : ?>
            <div class="control-group">
                <label for="compativelProduto_<?php echo $index; ?>" class="control-label">Modelo Compatível<span class="required"></span></label>
                <div class="controls">
                    <input id="compativelProduto_<?php echo $index; ?>" type="text" name="compativelProduto[]" value="<?php echo $compativelProduto; ?>" onChange="javascript:this.value=this.value.toUpperCase();" />
                    <button type="button" class="btn btn-danger removeCompativelProduto">Remover</button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
let compativelProdutoCounter = <?php echo count($compativelProdutos); ?>;

document.getElementById('addCompativelProduto').addEventListener('click', function() {
    const inputs = document.querySelectorAll('input[name="compativelProduto[]"]');
    let allFilled = true;

    inputs.forEach(function(input) {
        if (input.value.trim() === '') {
            allFilled = false;
        }
    });

    if (allFilled) {
        const newInput = document.createElement('div');
        newInput.className = 'control-group';
        newInput.innerHTML = `
            <label for="compativelProduto_${compativelProdutoCounter}" class="control-label">Modelo Compatível<span class="required"></span></label>
            <div class="controls">
                <input id="compativelProduto_${compativelProdutoCounter}" type="text" name="compativelProduto[]"
                    value=""
                    onChange="javascript:this.value=this.value.toUpperCase();" />
                <button type="button" class="btn btn-danger removeCompativelProduto">Remover</button>
            </div>
        `;
        document.getElementById('additionalCompativelProdutos').appendChild(newInput);
        compativelProdutoCounter++;
    } else {
        alert('Por favor, preencha todos os campos Modelo Compatível antes de adicionar um novo.');
    }
});

document.addEventListener('click', function(e) {
    if (e.target && e.target.className.includes('removeCompativelProduto')) {
        e.target.parentElement.parentElement.remove();
    }
});
</script>
