<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Produtos extends MY_Controller
{
    /**
     * author: Ramon Silva
     * email: silva018-mg@yahoo.com.br
     *
     */

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->model('produtos_model');
        $this->data['menuProdutos'] = 'Produtos';
    }

    public function index()
    {
        $this->gerenciar();
    }

    

    public function gerenciar()
{
    if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) {
        $this->session->set_flashdata('error', 'Você não tem permissão para visualizar produtos.');
        redirect(base_url());
    }

    $this->load->library('pagination');

    $this->data['configuration']['base_url'] = site_url('produtos/gerenciar/');
    $this->data['configuration']['total_rows'] = $this->produtos_model->count('produtos');

    $this->pagination->initialize($this->data['configuration']);

    // Ajuste a consulta para incluir as novas colunas e tabelas relacionadas
    $this->db->select('
        produtos.*, 
        modelo.nomeModelo, 
        condicoes.descricaoCondicao, 
        direcao.descricaoDirecao, 
        compativeis.modeloCompativel,
        imagens_produto.anexo,
        imagens_produto.thumb,
        imagens_produto.urlImagem,
        imagens_produto.path
    ');
    $this->db->from('produtos');
    $this->db->join('modelo', 'modelo.idModelo = produtos.idModelo');
    $this->db->join('condicoes', 'condicoes.idCondicao = produtos.idCondicao', 'left');
    $this->db->join('direcao', 'direcao.idDirecao = produtos.idDirecao', 'left');
    $this->db->join('compativeis', 'compativeis.idCompativel = produtos.idCompativel', 'left');
    $this->db->join('imagens_produto', 'imagens_produto.produto_id = produtos.idProdutos', 'left');
    $this->db->limit($this->data['configuration']['per_page'], $this->uri->segment(3));
    $this->data['results'] = $this->db->get()->result();

    $this->data['view'] = 'produtos/produtos';
    return $this->layout();
}



public function adicionar()
{
    if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aProduto')) {
        $this->session->set_flashdata('error', 'Você não tem permissão para adicionar produtos.');
        redirect(base_url());
    }

    $this->load->library('form_validation');
    $this->data['custom_error'] = '';

    if ($this->form_validation->run('produtos') == false) {
        $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
    } else {
        $precoCompra = $this->input->post('precoCompra');
        $precoCompra = str_replace(",", "", $precoCompra);
        $precoVenda = $this->input->post('precoVenda');
        $precoVenda = str_replace(",", "", $precoVenda);
    
        // Salvar o modelo na tabela `modelo`
        $modeloProduto = set_value('modeloProduto');
        $modeloData = ['nomeModelo' => $modeloProduto];
        $this->produtos_model->add('modelo', $modeloData);
    
        // Obter o ID do modelo recém-adicionado
        $idModelo = $this->db->insert_id();
    
        // Salvar a condição na tabela `condicoes`
        $condicaoProduto = set_value('condicaoProduto');
        $condicaoData = ['descricaoCondicao' => $condicaoProduto];
        $this->produtos_model->add('condicoes', $condicaoData);
    
        // Obter o ID da condição recém-adicionada
        $idCondicao = $this->db->insert_id();
    
        // Salvar a direção na tabela `direcao`
        $direcaoProduto = set_value('direcaoProduto');
        $direcaoData = ['descricaoDirecao' => $direcaoProduto];
        $this->produtos_model->add('direcao', $direcaoData);
    
        // Obter o ID da direção recém-adicionada
        $idDirecao = $this->db->insert_id();
    
        // Salvar os modelos compatíveis na tabela `compativeis`
        $compativelProdutos = $this->input->post('compativelProduto');
        $idCompativeis = [];

        if (is_array($compativelProdutos)) {
            foreach ($compativelProdutos as $compativelProduto) {
                if (!empty($compativelProduto)) {
                    $compativelData = ['modeloCompativel' => $compativelProduto];
                    $this->produtos_model->add('compativeis', $compativelData);
                    $idCompativeis[] = $this->db->insert_id();
                }
            }
        } else {
            // Tratar o caso onde $compativelProdutos não é um array
            echo "Nenhum produto compatível foi enviado.";
        }
    
        // Preparar os dados para a tabela `produtos`
        $data = [
            'codDeBarra' => set_value('codDeBarra'),
            'descricao' => set_value('descricao'),
            'marcaProduto' => set_value('marcaProduto'),
            'idModelo' => $idModelo,
            'nsProduto' => set_value('nsProduto'),
            'codigoPeca' => set_value('codigoPeca'),
            'localizacaoProduto' => set_value('localizacaoProduto'),
            'unidade' => set_value('unidade'),
            'precoCompra' => $precoCompra,
            'precoVenda' => $precoVenda,
            'estoque' => set_value('estoque'),
            'estoqueMinimo' => set_value('estoqueMinimo'),
            'saida' => set_value('saida'),
            'entrada' => set_value('entrada'),
            'idCondicao' => $idCondicao,
            'idDirecao' => $idDirecao,
            'dataPedido' => set_value('dataPedido'),
            'dataChegada' => set_value('dataChegada'),
            'numeroPeca' => set_value('numeroPeca')
        ];
    
        if ($this->produtos_model->add('produtos', $data) == true) {
            // Adicionar os modelos compatíveis na tabela `produto_compativel`
            $idProduto = $this->db->insert_id();

            // Passar o ID do produto para a variável idProdutoImg
            $idProdutoImg = $idProduto;
            foreach ($idCompativeis as $idCompativel) {
                $produtoCompativelData = [
                    'idProduto' => $idProduto,
                    'idCompativel' => $idCompativel,
                ];
                $this->produtos_model->add('produto_compativel', $produtoCompativelData);
            }

            // Verificar se há arquivos anexados
            if (!empty($_FILES['userfile']['name'][0])) {
                $this->imgAnexar($idProdutoImg);
            }

            $this->session->set_flashdata('success', 'Produto adicionado com sucesso!');
            log_info('Adicionou um produto');
            redirect(site_url('produtos/adicionar/'));
        } else {
            $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
        }
    }

    $this->data['view'] = 'produtos/adicionarProduto';
    return $this->layout();
}


    public function editar()
    {
        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }
    
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar produtos.');
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
    
        if ($this->form_validation->run('produtos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $precoCompra = $this->input->post('precoCompra');
            $precoCompra = str_replace(",", "", $precoCompra);
            $precoVenda = $this->input->post('precoVenda');
            $precoVenda = str_replace(",", "", $precoVenda);
        
            // Atualizar o modelo na tabela `modelo`
            $nomeModelo = $this->input->post('nomeModelo');
            $modeloData = ['nomeModelo' => $nomeModelo];
            $this->produtos_model->edit('modelo', $modeloData, 'idModelo', $this->input->post('idModelo'));
        
            // Atualizar a condição na tabela `condicoes`
            $descricaoCondicao = $this->input->post('descricaoCondicao');
            $condicaoData = ['descricaoCondicao' => $descricaoCondicao];
            $this->produtos_model->edit('condicoes', $condicaoData, 'idCondicao', $this->input->post('idCondicao'));
        
            // Atualizar a direção na tabela `direcao`
            $descricaoDirecao = $this->input->post('descricaoDirecao');
            $direcaoData = ['descricaoDirecao' => $descricaoDirecao];
            $this->produtos_model->edit('direcao', $direcaoData, 'idDirecao', $this->input->post('idDirecao'));
    
            // Preparar os dados para a tabela `produtos`
            $data = [
                'codDeBarra' => set_value('codDeBarra'),
                'descricao' => $this->input->post('descricao'),
                'marcaProduto' => $this->input->post('marcaProduto'),
                'idModelo' => $this->input->post('idModelo'),
                'nsProduto' => $this->input->post('nsProduto'),
                'codigoPeca' => $this->input->post('codigoPeca'),
                'localizacaoProduto' => $this->input->post('localizacaoProduto'),
                'unidade' => $this->input->post('unidade'),
                'precoCompra' => $precoCompra,
                'precoVenda' => $precoVenda,
                'estoque' => $this->input->post('estoque'),
                'estoqueMinimo' => $this->input->post('estoqueMinimo'),
                'saida' => set_value('saida'),
                'entrada' => set_value('entrada'),
                'idCondicao' => $this->input->post('idCondicao'),
                'idDirecao' => $this->input->post('idDirecao'),
                'dataPedido' => $this->input->post('dataPedido'),
                'dataChegada' => $this->input->post('dataChegada'),
                'numeroPeca' => $this->input->post('numeroPeca')
            ];
    
            // Preparar os dados para a tabela `imagens_produto`
            $imagensData = [
                'anexo' => $this->input->post('anexo'),
                'thumb' => $this->input->post('thumb'),
                'urlImagem' => $this->input->post('urlImagem'),
                'path' => $this->input->post('path'),
                'produto_id' => $this->input->post('idProdutos')
            ];
    
            if ($this->produtos_model->edit('produtos', $data, 'idProdutos', $this->input->post('idProdutos')) == true) {
                $this->produtos_model->edit('imagens_produto', $imagensData, 'produto_id', $this->input->post('idProdutos'));
            
                // Atualizar os modelos compatíveis
                $modelosCompativeis = $this->input->post('compativelProduto');
                $modelosCompativeisArray = [];
            
                if (is_array($modelosCompativeis)) {
                    foreach ($modelosCompativeis as $index => $modeloCompativel) {
                        $modelosCompativeisArray[] = [
                            'idCompativel' => $this->input->post('idCompativel')[$index] ?? null,
                            'modeloCompativel' => $modeloCompativel
                        ];
                    }
                }
            
                $this->produtos_model->update_modelos_compativeis($this->input->post('idProdutos'), $modelosCompativeisArray);
            
                $this->session->set_flashdata('success', 'Produto editado com sucesso!');
                log_info('Editou um produto');
                redirect(site_url('produtos/editar/' . $this->input->post('idProdutos')));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }
    
        /// Recuperar os dados do produto e modelos compatíveis
        $this->data['result'] = $this->produtos_model->getById($this->uri->segment(3));
        $this->data['modelos_compativeis'] = $this->produtos_model->get_modelos_compativeis($this->uri->segment(3));
        $this->data['view'] = 'produtos/editarProduto';
        return $this->layout();
    }
    


    public function visualizar()
{
    if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
        $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
        redirect('mapos');
    }

    if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) {
        $this->session->set_flashdata('error', 'Você não tem permissão para visualizar produtos.');
        redirect(base_url());
    }

    $produtoId = $this->uri->segment(3);
    $this->data['result'] = $this->produtos_model->getById($produtoId);

    if ($this->data['result'] == null) {
        $this->session->set_flashdata('error', 'Produto não encontrado.');
        redirect(site_url('produtos/editar/') . $this->input->post('idProdutos'));
    }

    // Buscar modelos compatíveis
    $this->data['modelosCompativeis'] = $this->produtos_model->get_modelos_compativeis($produtoId);

    // Buscar imagens do produto
    $this->data['imagensProduto'] = $this->produtos_model->getImagensProduto($produtoId);

    $this->data['view'] = 'produtos/visualizarProduto';
    return $this->layout();
}



public function excluir()
{
    if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dProduto')) {
        $this->session->set_flashdata('error', 'Você não tem permissão para excluir produtos.');
        redirect(base_url());
    }

    $id = $this->input->post('id');
    if ($id == null) {
        $this->session->set_flashdata('error', 'Erro ao tentar excluir produto.');
        redirect(base_url() . 'index.php/produtos/gerenciar/');
    }

    // Obter o idModelo antes de excluir o produto
    $produto = $this->produtos_model->getById($id);
    $idModelo = $produto->idModelo;

    // Obter os ids dos modelos compatíveis
    $modelosCompativeis = $this->produtos_model->get_modelos_compativeis($id);
    $idCompativeis = array_map(function($modelo) {
        return $modelo->idCompativel;
    }, $modelosCompativeis);

    // Excluir os registros das tabelas relacionadas
    $this->produtos_model->delete('produtos_os', 'produtos_id', $id);
    $this->produtos_model->delete('itens_de_vendas', 'produtos_id', $id);
    $this->produtos_model->delete('produtos', 'idProdutos', $id);

    // Excluir o modelo da tabela `modelo`
    $this->produtos_model->delete('modelo', 'idModelo', $idModelo);

    // Excluir os modelos compatíveis da tabela `compativeis`
    foreach ($idCompativeis as $idCompativel) {
        $this->produtos_model->delete('compativeis', 'idCompativel', $idCompativel);
    }

    // Excluir os registros da tabela `produto_compativel`
    $this->produtos_model->delete('produto_compativel', 'idProduto', $id);

    // Excluir as imagens vinculadas ao produto
    $imagens = $this->produtos_model->getImagensProduto($id);
    foreach ($imagens as $imagem) {
        $imagemPath = FCPATH . 'assets' . DIRECTORY_SEPARATOR . 'anexos' . DIRECTORY_SEPARATOR . 'produtos' . DIRECTORY_SEPARATOR . $imagem->path . DIRECTORY_SEPARATOR . $imagem->anexo;
        $thumbPath = FCPATH . 'assets' . DIRECTORY_SEPARATOR . 'anexos' . DIRECTORY_SEPARATOR . 'produtos' . DIRECTORY_SEPARATOR . $imagem->path . DIRECTORY_SEPARATOR . 'thumbs' . DIRECTORY_SEPARATOR . $imagem->thumb;
        
        if (file_exists($imagemPath)) {
            unlink($imagemPath);
        }
        if (file_exists($thumbPath)) {
            unlink($thumbPath);
        }
        
        $this->produtos_model->delete('imagens_produto', 'idImagem', $imagem->idImagem);
    }

    log_info('Removeu um produto, seu modelo, modelos compatíveis e imagens. ID: ' . $id);

    $this->session->set_flashdata('success', 'Produto, modelos compatíveis e imagens excluídos com sucesso!');
    redirect(site_url('produtos/gerenciar/'));
}




    public function atualizar_estoque()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para atualizar estoque de produtos.');
            redirect(base_url());
        }

        $idProduto = $this->input->post('id');
        $novoEstoque = $this->input->post('estoque');
        $estoqueAtual = $this->input->post('estoqueAtual');

        $estoque = $estoqueAtual + $novoEstoque;

        $data = [
            'estoque' => $estoque,
        ];

        if ($this->produtos_model->edit('produtos', $data, 'idProdutos', $idProduto) == true) {
            $this->session->set_flashdata('success', 'Estoque de Produto atualizado com sucesso!');
            log_info('Atualizou estoque de um produto. ID: ' . $idProduto);
            redirect(site_url('produtos/visualizar/') . $idProduto);
        } else {
            $this->data['custom_error'] = '<div class="alert">Ocorreu um erro.</div>';
        }
    }

    // modificações

    public function imgAnexar($idProduto)
{
    $this->load->library('upload');
    $this->load->library('image_lib');
    $directory = FCPATH . 'assets' . DIRECTORY_SEPARATOR . 'anexos' . DIRECTORY_SEPARATOR . 'produtos' . DIRECTORY_SEPARATOR . date('m-Y') . DIRECTORY_SEPARATOR . 'Produto-' . $idProduto;
    if (!is_dir($directory . DIRECTORY_SEPARATOR . 'thumbs')) {
        // make directory for images and thumbs
        try {
            mkdir($directory . DIRECTORY_SEPARATOR . 'thumbs', 0755, true);
        } catch (Exception $e) {
            echo json_encode(['result' => false, 'mensagem' => $e->getMessage()]);
            die();
        }
    }
    $upload_conf = [
        'upload_path' => $directory,
        'allowed_types' => 'jpg|png|gif|jpeg|JPG|PNG|GIF|JPEG', // formatos permitidos para anexos de os
        'max_size' => 0,
    ];
    $this->upload->initialize($upload_conf);

    if (isset($_FILES['userfile'])) {
        $files = $_FILES['userfile'];
        $file_count = count($files['name']);
        for ($i = 0; $i < $file_count; $i++) {
            $_FILES['file_' . $i] = [
                'name' => $files['name'][$i],
                'type' => $files['type'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error' => $files['error'][$i],
                'size' => $files['size'][$i],
            ];
        }
        unset($_FILES['userfile']);
    }

    $error = [];
    $success = [];
    foreach ($_FILES as $field_name => $file) {
        if (!$this->upload->do_upload($field_name)) {
            $error['upload'][] = $this->upload->display_errors();
        } else {
            $upload_data = $this->upload->data();
            $new_file_name = uniqid() . '.' . pathinfo($upload_data['file_name'], PATHINFO_EXTENSION);
            $new_file_path = $upload_data['file_path'] . $new_file_name;
            rename($upload_data['full_path'], $new_file_path);

            if ($upload_data['is_image'] == 1) {
                $resize_conf = [
                    'source_image' => $new_file_path,
                    'new_image' => $upload_data['file_path'] . 'thumbs' . DIRECTORY_SEPARATOR . 'thumb_' . $new_file_name,
                    'width' => 200,
                    'height' => 125,
                ];
                $this->image_lib->initialize($resize_conf);
                if (!$this->image_lib->resize()) {
                    $error['resize'][] = $this->image_lib->display_errors();
                } else {
                    $success[] = $upload_data;
                    $this->load->model('produtos_model');
                    $result = $this->produtos_model->imgAnexar($idProduto, $new_file_name, base_url('assets' . DIRECTORY_SEPARATOR . 'anexos' . DIRECTORY_SEPARATOR . 'produtos' . DIRECTORY_SEPARATOR . date('m-Y') . DIRECTORY_SEPARATOR . 'Produto-' . $idProduto), 'thumb_' . $new_file_name, $directory);
                    if (!$result) {
                        $error['db'][] = 'Erro ao inserir no banco de dados.';
                    }
                }
            } else {
                $success[] = $upload_data;
                $this->load->model('produtos_model');
                $result = $this->produtos_model->imgAnexar($this->input->post('idProdutoImg'), $new_file_name, base_url('assets' . DIRECTORY_SEPARATOR . 'anexos' . DIRECTORY_SEPARATOR . 'produtos' . DIRECTORY_SEPARATOR . date('m-Y') . DIRECTORY_SEPARATOR . 'Produto-' . $this->input->post('idProdutoImg')), '', $directory);
                if (!$result) {
                    $error['db'][] = 'Erro ao inserir no banco de dados.';
                }
            }
        }
    }
    if (count($error) > 0) {
        echo json_encode(['result' => false, 'mensagem' => 'Ocorreu um erro ao processar os arquivos.', 'errors' => $error]);
    } else {
        log_info('Adicionou imagen(s) a um Produto. ID (Produto): ' . $this->input->post('idProdutoImg'));
        echo json_encode(['result' => true, 'mensagem' => 'Arquivo(s) anexado(s) com sucesso.']);
    }
}



}




