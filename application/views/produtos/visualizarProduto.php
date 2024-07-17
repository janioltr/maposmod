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
            <div class="widget-content">
                <table class="table table-bordered">
                    <tbody>
                        
                        <tr>
                            <td style="text-align: right; width: 30%"><strong>Produto</strong></td>
                            <td>
                                <?php echo $result->descricao ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: right; width: 30%"><strong>Marca</strong></td>
                            <td>
                                <?php echo $result->marcaProduto ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: right; width: 30%"><strong>Modelo</strong></td>
                            <td>
                                <?php echo $result->nomeModelo ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: right; width: 30%"><strong>Compatíveis</strong></td>
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
                            <td style="text-align: right; width: 30%"><strong>Condição</strong></td>
                            <td>
                                <?php echo $result->descricaoCondicao ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: right; width: 30%"><strong>Direcionado</strong></td>
                            <td>
                                <?php echo $result->descricaoDirecao ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: right; width: 30%"><strong>Codigo da peça</strong></td>
                            <td>
                                <?php echo $result->codigoPeca ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: right; width: 30%"><strong>Número da peça</strong></td>
                            <td>
                                <?php echo $result->numeroPeca ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: right; width: 30%"><strong>Localização</strong></td>
                            <td>
                                <?php echo $result->localizacaoProduto ?>
                            </td>
                        </tr>



                        <tr>
                            <td style="text-align: right; width: 30%"><strong>Número de Série</strong></td>
                            <td>
                                <?php echo $result->nsProduto ?>
                            </td>
                        </tr>


                        <tr>
                            <td style="text-align: right"><strong>Unidade</strong></td>
                            <td>
                                <?php echo $result->unidade ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Preço de Compra</strong></td>
                            <td>R$
                                <?php echo $result->precoCompra; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Preço de Venda</strong></td>
                            <td>R$
                                <?php echo $result->precoVenda; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Estoque</strong></td>
                            <td>
                                <?php echo $result->estoque; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Estoque Mínimo</strong></td>
                            <td>
                                <?php echo $result->estoqueMinimo; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
