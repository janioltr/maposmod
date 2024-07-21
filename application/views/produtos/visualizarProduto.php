<!-- #mudanças -->
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
<!-- #st -->




<div class="accordion" id="collapse-group">
    <div class="accordion-group widget-box">
        <div class="accordion-heading">
            <div class="widget-title" style="margin: -20px 0 0">
                <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                    <span class="icon"><i class="fas fa-shopping-bag"></i></span>
                    <h5>Dados do Produto</h5>
                </a>
            </div>
        </div>
        <div class="collapse in accordion-body">
            <div class="widget-content span12">
              <div class="span4 div-bord" >
                <table class="table table-bordered">
                   

                <tbody>

                        <tr>
                            <td style=""><strong>Produto / Peça</strong></td>
                            <td >
                                <?php echo $result->descricao ?>
                            </td>
                        </tr>

                        <tr>
                            <td style=""><strong>Marca</strong></td>
                            <td>
                                <?php echo $result->marcaProduto ?>
                            </td>
                        </tr>

                        <tr>
                            <td style=""><strong>Modelo</strong></td>
                            <td>
                                <?php echo $result->nomeModelo ?>
                            </td>
                        </tr>

                        <tr>
                            <td style=""><strong>Compatíveis</strong></td>
                            <td>
                                <?php if (!empty($modelosCompativeis)) : ?>
                                    <ul>
                                        <?php foreach ($modelosCompativeis as $modeloCompativel) : ?>
                                            <li><?php echo $modeloCompativel->modeloCompativel; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else : ?>
                                    <p>Nenhum modelo compatível encontrado.</p>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <tr>
                            <td style=""><strong>Código da Peça</strong></td>
                            <td>
                                <?php echo $result->codigoPeca ?>
                            </td>
                        </tr>

                        <tr>
                            <td style=""><strong>Número de Série</strong></td>
                            <td>
                                <?php echo $result->nsProduto ?>
                            </td>
                        </tr>

                        <tr>
                            <td style=""><strong>Condições do Produto</strong></td>
                            <td>
                                <?php echo $result->descricaoCondicao ?>
                            </td>
                        </tr>

                        <tr>
                            <td style=""><strong>Direcionado (a)</strong></td>
                            <td>
                                <?php echo $result->descricaoDirecao ?>
                            </td>
                        </tr>

                        

                        
                        

                    </tbody>
                </table>
                
              </div>
              <div class="span4 div-bord" >
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                            <td style=""><strong>Localização</strong></td>
                            <td>
                                <?php echo $result->localizacaoProduto ?>
                            </td>
                        </tr>


                        <tr>
                            <td style=""><strong>Unidade</strong></td>
                            <td>
                                <?php echo $result->unidade ?>
                            </td>
                        </tr>
                        <tr>
                            <td style=""><strong>Preço de Compra</strong></td>
                            <td>R$
                                <?php echo $result->precoCompra; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style=""><strong>Preço de Venda</strong></td>
                            <td>R$
                                <?php echo $result->precoVenda; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style=""><strong>Estoque</strong></td>
                            <td>
                                <?php echo $result->estoque; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style=""><strong>Estoque Mínimo</strong></td>
                            <td>
                                <?php echo $result->estoqueMinimo; ?>
                            </td>
                        </tr>

                        <tr>
                            <td style=""><strong>Observação</strong></td>
                            <td>
                                <?php echo $result->numeroPeca ?>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
              </div>

              <div class="span4 div-bord" >
                <table class="table table-bordered">
                    <tbody>
                        <!-- #region -->
                        <div class="table table-bordered" >
                        <div class="span12 pull-left" id="divAnexos" style="margin-left: 0">
                            <?php
                            foreach ($imagensProduto as $imagem) {
                                if ($imagem->thumb == null) {
                                    $thumb = base_url() . 'assets/img/icon-file.png';
                                    $link = base_url() . 'assets/img/icon-file.png';
                                } else {
                                    $thumb = $imagem->urlImagem . '/thumbs/' . $imagem->thumb;
                                    $link = $imagem->urlImagem . '/' . $imagem->anexo;
                                }
                                echo '<div class="span3" style="min-height: 150px; margin-left: 0">
                                            <a style="min-height: 150px;" href="#modal-anexo" imagem="' . $imagem->idImagem . '" link="' . $link . '" role="button" class="btn anexo span12" data-toggle="modal">
                                                <img src="' . $thumb . '" alt="">
                                            </a>
                                            <span>' . $imagem->anexo . '</span>
                                        </div>';
                            }
                            ?>
                        </div>
                            <!-- #region -->

                            
                        </div>
                        <!-- #region -->
                    </tbody>
                </table>
               </div>
            </div>
        </div>
    </div>
</div>


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

