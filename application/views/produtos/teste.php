<
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

.form-horizontal .control-group {
        border-bottom: 1px solid #ffffff;
    }

    .form-horizontal .controls {
        margin-left: 20px;
        padding-bottom: 8px 0;
    }

    .form-horizontal .control-label {
        text-align: left;
        padding-top: 15px;
    }

    .nopadding {
        padding: 0 20px !important;
        margin-right: 20px;
    }

    .widget-title h5 {
        padding-bottom: 30px;
        text-align-last: left;
        font-size: 2em;
        font-weight: 500;
    }

    @media (max-width: 480px) {
        form {
            display: contents !important;
        }

        .form-horizontal .control-label {
            margin-bottom: -6px;
        }

        .btn-xs {
            position: initial !important;
        }
    }
/* meus  */  

.image-slider {
    position: relative;
    width: 100%;
    max-width: 500px; /* Ajuste conforme necessário */
    margin: 10px;
}

.image-slider img {
    width: 100%;
    height: 100%;
}

.prev, .next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    width: auto;
    padding: 16px;
    margin-top: -22px;
    color: blue;
    font-weight: bold;
    font-size: 18px;
    transition: 0.6s ease;
    border-radius: 0 3px 3px 0;
    user-select: none;
}

.next {
    right: 0;
    border-radius: 3px 0 0 3px;
}

.prev:hover, .next:hover {
    background-color: rgba(0,0,0,0.8);
}

.div-bord {
            border: 1px solid black; /* Define a borda */
            padding: 1%; /* Define o padding de 5% em todos os lados */
            margin-bottom: 2%; /* Adiciona um espaço de 5% abaixo de cada div */
}


</style>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title" style="margin: -20px 0 0">
                <span class="icon">
                    <i class="fas fa-shopping-bag"></i>
                </span>
                <h5>Cadastro de Produto</h5>
            </div>
            <div class="widget-content nopadding tab-content">
                <?php echo $custom_error; ?>
                <form action="<?php echo current_url(); ?>" id="formProduto" method="post" class="form-horizontal">
                   <!-- #modificação 1 inicio-->
                    <div class="span4" >
                        <div class="" >

                        <div class="control-group">
                        <label for="descricao" class="control-label">Produto / Peça <span class="required">*</span></label>
                        <div class="controls">
                            <input id="descricao" type="text" name="descricao"
                                value="<?php echo set_value('descricao'); ?>"
                                onChange="javascript:this.value=this.value.toUpperCase();" />
                        </div>
                        </div>
                        <div class="control-group">
                            <label for="marcaProduto" class="control-label">Marca<span class="required">*</span></label>
                            <div class="controls">
                                <input id="marcaProduto" type="text" name="marcaProduto"
                                    value="<?php echo set_value('marcaProduto'); ?>"
                                    onChange="javascript:this.value=this.value.toUpperCase();" />
                            </div>
                        </div>

                        

                        


                        

                        <div class="control-group">
                            <label for="codigoPeca" class="control-label">Código da Peça<span class="required">*</span></label>
                            <div class="controls">
                                <input id="codigoPeca" type="text" name="codigoPeca"
                                    value="<?php echo set_value('codigoPeca'); ?>"
                                    onChange="javascript:this.value=this.value.toUpperCase();" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="nsProduto" class="control-label">Número de Série<span class=""></span></label>
                            <div class="controls">
                                <input id="nsProduto" type="text" name="nsProduto"
                                    value="<?php echo set_value('nsProduto'); ?>"
                                    onChange="javascript:this.value=this.value.toUpperCase();" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="condicaoProduto" class="control-label">Condições do Produto<span class="required"></span></label>
                            <div class="controls">
                                <select class="" name="condicaoProduto" id="condicaoProduto" >
                                    <option value="Novo">Novo</option>
                                    <option value="Usado">Usado</option>
                                    <option value="Recondicionado">Recondicionado</option>
                                    <option value="Suspeito">Suspeito</option>
                                    <option value="Defeito">Defeito</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="localizacaoProduto" class="control-label">Localização<span class="required">*</span></label>
                            <div class="controls">
                                <input id="localizacaoProduto" type="text" name="localizacaoProduto"
                                    value="<?php echo set_value('localizacaoProduto'); ?>"
                                    onChange="javascript:this.value=this.value.toUpperCase();" />
                            </div>
                        </div>

                        </div>
                    </div>
                    <!-- #modificação 1 final -->

                    <!-- #modificação 2 inicio -->

                    <div class="span4" >
                        <div class="" >

                        

                        <div class="control-group">
                            <label for="direcaoProduto" class="control-label">Direcionado (a)<span class="required"></span></label>
                            <div class="controls">
                                <select class="" name="direcaoProduto" id="direcaoProduto">
                                    <option value="Estoque">Estoque</option>
                                    <option value="Garantia">Garantia</option>
                                    <option value="Pedido">Pedido</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Tipo de Movimento</label>
                            <div class="controls">
                                <label for="entrada" class="btn btn-default" style="margin-top: 5px;">Entrada
                                    <input type="checkbox" id="entrada" name="entrada" class="badgebox" value="1" checked>
                                    <span class="badge">&check;</span>
                                </label>
                                <label for="saida" class="btn btn-default" style="margin-top: 5px;">Saída
                                    <input type="checkbox" id="saida" name="saida" class="badgebox" value="1" checked>
                                    <span class="badge">&check;</span>
                                </label>
                            </div>
                        </div>

                        

                        <div class="control-group">
                            <label for="precoVenda" class="control-label">Preço de Venda<span
                                    class="required">*</span></label>
                            <div class="controls">
                                <input id="precoVenda" class="money" data-affixes-stay="true" data-thousands=""
                                    data-decimal="." type="text" name="precoVenda"
                                    value="<?php echo set_value('precoVenda'); ?>" />
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
                                <input id="estoque" type="text" name="estoque"
                                    value="<?php echo set_value('estoque'); ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="estoqueMinimo" class="control-label">Estoque Mínimo</label>
                            <div class="controls">
                                <input id="estoqueMinimo" type="text" name="estoqueMinimo"
                                    value="<?php echo set_value('estoqueMinimo'); ?>" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="numeroPeca" class="control-label">Observação<span class="required"></span></label>
                            <div class="controls">
                                <input id="numeroPeca" type="text" name="numeroPeca"
                                    value="<?php echo set_value('numeroPeca'); ?>"
                                    onChange="javascript:this.value=this.value.toUpperCase();" />
                            </div>
                        </div>

                      </div>

                      

                    </div>


                    <div class="span4">
                            <div>
                            <div class="control-group">
                                <label for="imgProduto" class="control-label"><span class="required"></span></label>
                                <div class="controls">
                                    <div class="image-slider">
                                        <span class="prev" onclick="changeImage(-1)">❮</span>
                                        <img id="imgProduto" src="https://encurtador.com.br/1Nwzd" alt="Imagem do Produto" />
                                        <span class="next" onclick="changeImage(1)">❯</span>
                                    </div>
                                </div>
                            </div>
                            </div>
                    </div>
                    
                    </div>

                    </div>
                    

                    
                    <!-- #codigo nova tela -->

<div class="span12 div-bord" >  
<!-- #region div 1-->
       <div class="span3 div-bord" >
            <div class="span12">
                        <div class="control-group span12">
                            <label for="imgProduto" class="control-label"><span class="required"></span></label>
                            <div class="controls">
                                <div class="image-slider">
                                    <span class="prev" onclick="changeImage(-1)">❮</span>
                                    <img id="imgProduto" src="https://encurtador.com.br/1Nwzd" alt="Imagem do Produto" />
                                    <span class="next" onclick="changeImage(1)">❯</span>
                                
                            </div>

                            <div class="span8" style="padding: 3%;" >
                                <input type="file" name="files[]" id="files" accept="image/*" multiple>
                                </div>
                        </div>

                </div>
            </div>

       </div>
<!-- #region div 2-->
        <div class="span3 div-bord" >
            <div class="span12">
                <label for="marcaProdutoOs"class="control-label">Produto / Peça<span class="required">*</span></label>
                <input name="marcaProdutoOs" class="span12" type="text" id="marcaProdutoOs"
                    value="" onChange="javascript:this.value=this.value.toUpperCase();"/> 

            </div>

            <div>
            <div class="span12">
                <label for="marcaProdutoOs"class="control-label">Marca<span class="required">*</span></label>
                <input name="marcaProdutoOs" class="span12" type="text" id="marcaProdutoOs"
                    value="" onChange="javascript:this.value=this.value.toUpperCase();"/> 

            </div>
            </div>

            
            <div>
            <div class="span12">
                    <label for="modeloProduto" class="control-label">Modelo<span class="required">*</span></label>
                    <div class="controls">
                        <input id="modeloProduto"  class="span9" type="text" name="modeloProduto"
                            value="<?php echo set_value('modeloProduto'); ?>"
                            onChange="javascript:this.value=this.value.toUpperCase();" />
                        <button type="button" id="addCompativelProduto" class="span3 btn btn-primary">+</button>
                    </div>
                   
                </div>
                <div class="" >
                <div id="additionalCompativelProdutos"></div>
            </div>
            </div>
       </div>
       <div class="span6 div-bord" >
                <div class="span6">
                    <label for="marcaProdutoOs"class="control-label">Código / Peça<span class="required">*</span></label>
                    <input name="marcaProdutoOs" class="span12" type="text" id="marcaProdutoOs"
                        value="" onChange="javascript:this.value=this.value.toUpperCase();"/> 

                </div>

                <div class="span6">
                    <label for="marcaProdutoOs"class="control-label">Número de Série<span class="required">*</span></label>
                    <input name="marcaProdutoOs" class="span12" type="text" id="marcaProdutoOs"
                        value="" onChange="javascript:this.value=this.value.toUpperCase();"/> 

                </div>
<!-- #region -->
                <div>  
<!-- #region -->
                <div class="span6">
                    <label for="marcaProdutoOs"class="control-label">Condições do Produto<span class="required">*</span></label>
                    <input name="marcaProdutoOs" class="span12" type="text" id="marcaProdutoOs"
                        value="" onChange="javascript:this.value=this.value.toUpperCase();"/> 

                </div>

                <div class="span6">
                    <label for="marcaProdutoOs"class="control-label">Direcionado (a)<span class="required">*</span></label>
                    <input name="marcaProdutoOs" class="span12" type="text" id="marcaProdutoOs"
                        value="" onChange="javascript:this.value=this.value.toUpperCase();"/> 

                </div>


                <div>
                    <div class="span6">
                        <label for="marcaProdutoOs"class="control-label">Localização<span class="required">*</span></label>
                        <input name="marcaProdutoOs" class="span12" type="text" id="marcaProdutoOs"
                            value="" onChange="javascript:this.value=this.value.toUpperCase();"/> 

                    </div>

                    <div class="span6">
                        <label for="marcaProdutoOs"class="control-label">Tipo de Movimento<span class="required">*</span></label>
                        <input name="marcaProdutoOs" class="span12" type="text" id="marcaProdutoOs"
                            value="" onChange="javascript:this.value=this.value.toUpperCase();"/> 

                    </div>
                </div>

                


                <div>
                    <div class="span5">
                    <label for="precoCompra" class="control-label">Preço de Compra<span
                            class="required">*</span></label>
                    <div class="controls">
                        <input id="precoCompra" class="money" data-affixes-stay="true"
                            data-thousands="" data-decimal="." type="text" name="precoCompra"
                            value="<?php echo set_value('precoCompra'); ?>" />
                        <div>
                        <strong><span style="color: red" id="errorAlert"></span><strong>
                            
                    </div>

                    </div>

                    <div class="span2">
                        <label for="marcaProdutoOs"class="control-label">Tipo de Movimento<span class="required">*</span></label>
                        <input name="marcaProdutoOs" class="span12" type="text" id="marcaProdutoOs"
                            value="" onChange="javascript:this.value=this.value.toUpperCase();"/> 

                    </div>

                    <div class="span5">
                        <label for="marcaProdutoOs"class="control-label">Tipo de Movimento<span class="required">*</span></label>
                        <input name="marcaProdutoOs" class="span12" type="text" id="marcaProdutoOs"
                            value="" onChange="javascript:this.value=this.value.toUpperCase();"/> 

                    </div>
                </div>

                <div>
                

                


<!-- #region -->
            </div>
<!-- #region -->
              

                

                
                

           
                
       </div>

        </div>
            </div>

                    <!-- #final codigo nova tela -->
                     
                    
                    <!-- #modificação 2 final -->
                    
                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3" style="display: flex;justify-content: center">
                                <button type="submit" class="button btn btn-mini btn-success"
                                    style="max-width: 160px"><span class="button__icon"><i
                                            class='bx bx-plus-circle'></i></span><span
                                        class="button__text2">Adicionar</span>

                                        
                                    
                                    </button>
                                <a href="<?php echo base_url() ?>index.php/produtos" id=""
                                    class="button btn btn-mini btn-warning"><span class="button__icon"><i
                                            class="bx bx-undo"></i></span><span class="button__text2">Voltar</span></a>
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
$("#precoCompra").focusout(function() {
    if ($("#precoCompra").val() == '0.00' && $('#precoVenda').val() != '') {
        $('#errorAlert').text('Você não pode preencher valor de compra e depois apagar.').css("display",
            "inline").fadeOut(6000);
        $('#precoVenda').val('');
        $("#precoCompra").focus();
    } else {
        $('#precoVenda').val(calcLucro(Number($("#precoCompra").val()), Number($("#margemLucro").val())));
    }
});

$("#margemLucro").keyup(function() {
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

$('#precoVenda').focusout(function() {
    if (Number($('#precoVenda').val()) < Number($("#precoCompra").val())) {
        $('#errorAlert').text('Preço de venda não pode ser menor que o preço de compra.').css("display",
            "inline").fadeOut(6000);
        $('#precoVenda').val('');
        if ($("#margemLucro").val() != "" || $("#margemLucro").val() != null) {
            $('#precoVenda').val(calcLucro(Number($("#precoCompra").val()), Number($("#margemLucro").val())));
        }
    }

});



$(document).ready(function() {
    $(".money").maskMoney();
    $.getJSON('<?php echo base_url() ?>assets/json/tabela_medidas.json', function(data) {
        for (i in data.medidas) {
            $('#unidade').append(new Option(data.medidas[i].descricao, data.medidas[i].sigla));
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
let compativelProdutoCounter = 1;

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
            <label for="compativelProduto_${compativelProdutoCounter}" class="control-label span12">Modelo Compatível<span class="required"></span></label>
            <div class="controls">
                <input id="compativelProduto_${compativelProdutoCounter}" class="span9" type="text" name="compativelProduto[]"
                    value=""
                    onChange="javascript:this.value=this.value.toUpperCase();" />
                <button type="button" class="span3 btn btn-danger removeCompativelProduto">x</button>
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


<script>
let currentImageIndex = 0;
const images = [
    "https://encurtador.com.br/nAudQ",
    "https://encurtador.com.br/1Nwzd",
    "https://encurtador.com.br/nAudQ"
];

function changeImage(direction) {
    currentImageIndex += direction;
    if (currentImageIndex >= images.length) {
        currentImageIndex = 0;
    } else if (currentImageIndex < 0) {
        currentImageIndex = images.length - 1;
    }
    document.getElementById("imgProduto").src = images[currentImageIndex];
}
</script>



