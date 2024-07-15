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
        compativeis.modeloCompativel
    ');
    $this->db->from('produtos');
    $this->db->join('modelo', 'modelo.idModelo = produtos.idModelo');
    $this->db->join('condicoes', 'condicoes.idCondicao = produtos.idCondicao', 'left');
    $this->db->join('direcao', 'direcao.idDirecao = produtos.idDirecao', 'left');
    $this->db->join('compativeis', 'compativeis.idCompativel = produtos.idCompativel', 'left');
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
        foreach ($compativelProdutos as $compativelProduto) {
            if (!empty($compativelProduto)) {
                $compativelData = ['modeloCompativel' => $compativelProduto];
                $this->produtos_model->add('compativeis', $compativelData);
                $idCompativeis[] = $this->db->insert_id();
            }
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
            'idCompativel' => implode(',', $idCompativeis), // Salvar IDs dos modelos compatíveis como string separada por vírgulas
            'numeroPeca' => set_value('numeroPeca')
        ];
    
        if ($this->produtos_model->add('produtos', $data) == true) {
            $this->session->set_flashdata('success', 'Produto adicionado com sucesso!');
            log_info('Adicionou um produto');
            redirect(site_url('produtos/adicionar/'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
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
    
        // Atualizar os modelos compatíveis na tabela `compativeis`
    $compativelProdutos = $this->input->post('compativelProduto');
    $idCompativeis = [];
    foreach ($compativelProdutos as $compativelProduto) {
        if (!empty($compativelProduto)) {
            $compativelData = ['modeloCompativel' => $compativelProduto];
            // Verificar se o modelo compatível já existe
            $existing = $this->produtos_model->get_by('compativeis', ['modeloCompativel' => $compativelProduto]);
            if ($existing) {
                // Atualizar o modelo compatível existente
                $this->produtos_model->edit('compativeis', $compativelData, 'idCompativel', $existing->idCompativel);
                $idCompativeis[] = $existing->idCompativel;
            } else {
                // Adicionar novo modelo compatível
                $this->produtos_model->add('compativeis', $compativelData);
                $idCompativeis[] = $this->db->insert_id();
            }
        }
    }
    
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
            'idCompativel' => implode(',', $idCompativeis), // Salvar IDs dos modelos compatíveis como string separada por vírgulas
            'numeroPeca' => $this->input->post('numeroPeca')
        ];
       
        if ($this->produtos_model->edit('produtos', $data, 'idProdutos', $this->input->post('idProdutos')) == true) {
            $this->session->set_flashdata('success', 'Produto editado com sucesso!');
            log_info('Editou um produto');
            redirect(site_url('produtos/editar/' . $this->input->post('idProdutos')));
        } else {
            $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
        }
    }

    $this->data['result'] = $this->produtos_model->getById($this->uri->segment(3));
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

        $this->data['result'] = $this->produtos_model->getById($this->uri->segment(3));

        if ($this->data['result'] == null) {
            $this->session->set_flashdata('error', 'Produto não encontrado.');
            redirect(site_url('produtos/editar/') . $this->input->post('idProdutos'));
        }

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

    $this->produtos_model->delete('produtos_os', 'produtos_id', $id);
    $this->produtos_model->delete('itens_de_vendas', 'produtos_id', $id);
    $this->produtos_model->delete('produtos', 'idProdutos', $id);

    // Excluir o modelo da tabela `modelo`
    $this->produtos_model->delete('modelo', 'idModelo', $idModelo);

    log_info('Removeu um produto e seu modelo. ID: ' . $id);

    $this->session->set_flashdata('success', 'Produto e modelo excluídos com sucesso!');
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
}











