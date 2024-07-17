<style>
    /* Hiding the checkbox, but allowing it to be focused */
    .badgebox {
        opacity: 0;
    }

    .badgebox+.badge {
        /* Move the check mark away when unchecked */
        text-indent: -999999px;
        /* Makes the badge's width stay the same checked and unchecked */
        width: 27px;
    }

    .badgebox:focus+.badge {
        /* Set something to make the badge looks focused */
        /* This really depends on the application, in my case it was: */

        /* Adding a light border */
        box-shadow: inset 0px 0px 5px;
        /* Taking the difference out of the padding */
    }

    .badgebox:checked+.badge {
        /* Move the check mark back when checked */
        text-indent: 0;
    }
</style>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title" style="margin: -20px 0 0">
                <span class="icon">
                    <i class="fas fa-shopping-bag"></i>
                </span>
                <h5>Editar Produto</h5>
            </div>
            <div class="widget-content nopadding tab-content">
                <?php echo $custom_error; ?>
                <form action="<?php echo current_url(); ?>" id="formProduto" method="post" class="form-horizontal">
                    <div class="control-group">
                        <?php echo form_hidden('idProdutos', $result->idProdutos) ?>
                        <?php echo form_hidden('idModelo', $result->idModelo) ?>
                        <?php echo form_hidden('idCondicao', $result->idCondicao) ?>
                        <?php echo form_hidden('idDirecao', $result->idDirecao) ?>
                       
                    </div>
                    <div class="control-group">
                        <label for="descricao" class="control-label">Produto<span class="required">*</span></label>
                        <div class="controls">
                            <input id="descricao" type="text" name="descricao" value="<?php echo $result->descricao; ?>" onChange="javascript:this.value=this.value.toUpperCase();" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="marcaProduto" class="control-label">Marca<span class="required">*</span></label>
                        <div class="controls">
                            <input id="marcaProduto" type="text" name="marcaProduto" value="<?php echo $result->marcaProduto; ?>" onChange="javascript:this.value=this.value.toUpperCase();" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="nomeModelo" class="control-label">Modelo<span class="required">*</span></label>
                        <div class="controls">
                            <input id="nomeModelo" type="text" name="nomeModelo" value="<?php echo $result->nomeModelo; ?>" onChange="javascript:this.value=this.value.toUpperCase();" />
                            <button type="button" id="addCompativelProduto" class="btn btn-primary">+</button>
                        </div>
                    </div>
            
                    <div id="additionalCompativelProdutos">
                        <?php foreach ($modelos_compativeis as $index => $modelo): ?>
                            <div class="control-group">
                                <label for="compativelProduto_<?php echo $index; ?>" class="control-label">Modelo Compatível<span class="required"></span></label>
                                <div class="controls">
                                    <input id="compativelProduto_<?php echo $index; ?>" type="text" name="compativelProduto[]"
                                        value="<?php echo $modelo->modeloCompativel; ?>"
                                        onChange="javascript:this.value=this.value.toUpperCase();" />
                                    <button type="button" class="btn btn-danger removeCompativelProduto">x</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="control-group">
                        <label for="descricaoCondicao" class="control-label">Condição<span class="required"></span></label>
                        <div class="controls">
                        <select class="" name="descricaoCondicao" id="descricaoCondicao" value="">
                            <option <?php if ($result->descricaoCondicao == 'Novo') {
                                echo 'selected';
                            } ?> value="Novo">Novo
                            </option>
                            <option <?php if ($result->descricaoCondicao == 'Usado') {
                                echo 'selected';
                            } ?>   value="Usado">Usado
                            </option>
                            <option <?php if ($result->descricaoCondicao == 'Recondicionado') {
                                echo 'selected';
                            } ?>   value="Recondicionado">Recondicionado
                            </option>
                            <option <?php if ($result->descricaoCondicao == 'Suspeito') {
                                echo 'selected';
                            } ?> value="Suspeito">Suspeito
                            </option>
                            <option <?php if ($result->descricaoCondicao == 'Defeito') {
                                echo 'selected';
                            } ?> value="Defeito">Defeito
                            </option>
                        </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="descricaoDirecao" class="control-label">Direção<span class="required"></span></label>
                        <div class="controls">
                        <select class="" name="descricaoDirecao" id="descricaoDirecao" value="">
                            <option <?php if ($result->descricaoDirecao == 'Estoque') {
                                echo 'selected';
                            } ?> value="Estoque">Estoque
                            </option>
                            <option <?php if ($result->descricaoDirecao == 'Garantia') {
                                echo 'selected';
                            } ?>   value="Garantia">Garantia
                            </option>
                            <option <?php if ($result->descricaoDirecao == 'Pedido') {
                                echo 'selected';
                            } ?>   value="Pedido">Pedido
                            </option>
                        </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="nsProduto" class="control-label">Número de Série<span class=""></span></label>
                        <div class="controls">
                            <input id="nsProduto" type="text" name="nsProduto" value="<?php echo $result->nsProduto; ?>" onChange="javascript:this.value=this.value.toUpperCase();"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="codigoPeca" class="control-label">Codigo da Peça<span class=""></span></label>
                        <div class="controls">
                            <input id="codigoPeca" type="text" name="codigoPeca" value="<?php echo $result->codigoPeca; ?>" onChange="javascript:this.value=this.value.toUpperCase();"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="numeroPeca" class="control-label">Número da Peça<span class=""></span></label>
                        <div class="controls">
                            <input id="numeroPeca" type="text" name="numeroPeca" value="<?php echo $result->numeroPeca; ?>" onChange="javascript:this.value=this.value.toUpperCase();"/>
                        </div>
                    </div>


                    <div class="control-group">
                        <label for="localizacaoProduto" class="control-label">Localização<span class=""></span></label>
                        <div class="controls">
                            <input id="localizacaoProduto" type="text" name="localizacaoProduto" value="<?php echo $result->localizacaoProduto; ?>" onChange="javascript:this.value=this.value.toUpperCase();"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Tipo de Movimento</label>
                        <div class="controls">
                            <label for="entrada" class="btn btn-default" style="margin-top: 5px;">Entrada
                                <input type="checkbox" id="entrada" name="entrada" class="badgebox" value="1" <?= ($result->entrada == 1) ? 'checked' : '' ?>>
                                <span class="badge">&check;</span>
                            </label>
                            <label for="saida" class="btn btn-default" style="margin-top: 5px;">Saída
                                <input type="checkbox" id="saida" name="saida" class="badgebox" value="1" <?= ($result->saida == 1) ? 'checked' : '' ?>>
                                <span class="badge">&check;</span>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="precoCompra" class="control-label">Preço de Compra<span class="required">*</span></label>
                        <div class="controls">
                            <input id="precoCompra" class="money" data-affixes-stay="true" data-thousands="" data-decimal="." type="text" name="precoCompra" value="<?php echo $result->precoCompra; ?>" />
                            Margem <input style="width: 3em;" id="margemLucro" name="margemLucro" type="text" placeholder="%" maxlength="3" size="2" />
                            <strong><span style="color: red" id="errorAlert"></span><strong>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="precoVenda" class="control-label">Preço de Venda<span class="required">*</span></label>
                        <div class="controls">
                            <input id="precoVenda" class="money" data-affixes-stay="true" data-thousands="" data-decimal="." type="text" name="precoVenda" value="<?php echo $result->precoVenda; ?>" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="unidade" class="control-label">Unidade<span class="required">*</span></label>
                        <div class="controls">
                            <select id="unidade" name="unidade" style="width: 15em;"></select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="estoque" class="control-label">Estoque<span class="required">*</span></label>
                        <div class="controls">
                            <input id="estoque" type="text" name="estoque" value="<?php echo $result->estoque; ?>" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="estoqueMinimo" class="control-label">Estoque Mínimo</label>
                        <div class="controls">
                            <input id="estoqueMinimo" type="text" name="estoqueMinimo" value="<?php echo $result->estoqueMinimo; ?>" />
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3" style="display: flex;justify-content: center">
                                <button type="submit" class="button btn btn-primary" style="max-width: 160px">
                                  <span class="button__icon"><i class="bx bx-sync"></i></span><span class="button__text2">Atualizar</span></button>
                                <a href="<?php echo base_url() ?>index.php/produtos" id="" class="button btn btn-mini btn-warning">
                                  <span class="button__icon"><i class="bx bx-undo"></i></span><span class="button__text2">Voltar</span></a>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>


<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>assets/js/maskmoney.js"></script>
<script type="text/javascript">
    function calcLucro(precoCompra, margemLucro) {
    var precoVenda = (precoCompra * margemLucro / 100 + precoCompra).toFixed(2);
    return precoVenda;

}
    $("#precoCompra").focusout(function () {
        if ($("#precoCompra").val() == '0.00' && $('#precoVenda').val() != '') {
            $('#errorAlert').text('Você não pode preencher valor de compra e depois apagar.').css("display", "inline").fadeOut(6000);
            $('#precoVenda').val('');
            $("#precoCompra").focus();
        } else {
            $('#precoVenda').val(calcLucro(Number($("#precoCompra").val()), Number($("#margemLucro").val())));
        }
    });

   $("#margemLucro").keyup(function () {
        this.value = this.value.replace(/[^0-9.]/g, '');
        if ($("#precoCompra").val() == null || $("#precoCompra").val() == '') {
            $('#errorAlert').text('Preencher valor da compra primeiro.').css("display", "inline").fadeOut(5000);
            $('#margemLucro').val('');
            $('#precoVenda').val('');
            $("#precoCompra").focus();

        } else if (Number($("#margemLucro").val()) >= 0) {
            $('#precoVenda').val(calcLucro(Number($("#precoCompra").val()), Number($("#margemLucro").val())));
        } else {
            $('#errorAlert').text('Não é permitido número negativo.').css("display", "inline").fadeOut(5000);
            $('#margemLucro').val('');
            $('#precoVenda').val('');
        }
    });

    $('#precoVenda').focusout(function () {
        if (Number($('#precoVenda').val()) < Number($("#precoCompra").val())) {
            $('#errorAlert').text('Preço de venda não pode ser menor que o preço de compra.').css("display", "inline").fadeOut(6000);
            $('#precoVenda').val('');
            if($("#margemLucro").val() != "" || $("#margemLucro").val() != null){
                $('#precoVenda').val(calcLucro(Number($("#precoCompra").val()), Number($("#margemLucro").val())));
            }
        }
    });

    $(document).ready(function() {
        $(".money").maskMoney();
        $.getJSON('<?php echo base_url() ?>assets/json/tabela_medidas.json', function(data) {
            for (i in data.medidas) {
                $('#unidade').append(new Option(data.medidas[i].descricao, data.medidas[i].sigla));
                $("#unidade option[value=" + '<?php echo $result->unidade; ?>' + "]").prop("selected", true);
            }
        });
        $('#formProduto').validate({
            rules: {
                descricao: {
                    required: true
                },
                unidade: {
                    required: true
                },
                precoCompra: {
                    required: true
                },
                precoVenda: {
                    required: true
                },
                estoque: {
                    required: true
                }
            },
            messages: {
                descricao: {
                    required: 'Campo Requerido.'
                },
                unidade: {
                    required: 'Campo Requerido.'
                },
                precoCompra: {
                    required: 'Campo Requerido.'
                },
                precoVenda: {
                    required: 'Campo Requerido.'
                },
                estoque: {
                    required: 'Campo Requerido.'
                }
            },

            errorClass: "help-inline",
            errorElement: "span",
            highlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });
    });
</script>


 <script>
    let compativelProdutoCounter = <?php echo count($modelos_compativeis); ?>;

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
                    <button type="button" class="btn btn-danger removeCompativelProduto">x</button>
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
