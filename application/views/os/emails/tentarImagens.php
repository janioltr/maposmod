<?
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

    // Excluir as imagens vinculadas ao produto
    $imagens = $this->produtos_model->getImagensProduto($id);
    $diretorioProduto = '';
    foreach ($imagens as $imagem) {
        $diretorioProduto = FCPATH . 'assets' . DIRECTORY_SEPARATOR . 'anexos' . DIRECTORY_SEPARATOR . 'produtos' . DIRECTORY_SEPARATOR . $imagem->path;
        $imagemPath = $diretorioProduto . DIRECTORY_SEPARATOR . $imagem->anexo;
        $thumbPath = $diretorioProduto . DIRECTORY_SEPARATOR . 'thumbs' . DIRECTORY_SEPARATOR . $imagem->thumb;
        
        if (file_exists($imagemPath)) {
            unlink($imagemPath);
        }
        if (file_exists($thumbPath)) {
            unlink($thumbPath);
        }
        
        $this->produtos_model->delete('imagens_produto', 'idImagem', $imagem->idImagem);
    }

    // Excluir a pasta do produto
    if (is_dir($diretorioProduto . DIRECTORY_SEPARATOR . 'thumbs')) {
        rmdir($diretorioProduto . DIRECTORY_SEPARATOR . 'thumbs');
    }
    if (is_dir($diretorioProduto)) {
        rmdir($diretorioProduto);
    }

    // Excluir o produto
    $this->produtos_model->delete('produtos', 'idProdutos', $id);

    // Excluir o modelo da tabela `modelo`
    $this->produtos_model->delete('modelo', 'idModelo', $idModelo);

    // Excluir os modelos compatíveis da tabela `compativeis`
    foreach ($idCompativeis as $idCompativel) {
        $this->produtos_model->delete('compativeis', 'idCompativel', $idCompativel);
    }

    // Excluir os registros da tabela `produto_compativel`
    $this->produtos_model->delete('produto_compativel', 'idProduto', $id);

    log_info('Removeu um produto, seu modelo, modelos compatíveis e imagens. ID: ' . $id);

    $this->session->set_flashdata('success', 'Produto, modelos compatíveis e imagens excluídos com sucesso!');
    redirect(site_url('produtos/gerenciar/'));
}


/// anterior ta bem


public function excluirImgAnexo($id = null)
    {
        if ($id == null || !is_numeric($id)) {
            echo json_encode(['result' => false, 'mensagem' => 'Erro ao tentar excluir anexo.']);
        } else {
            $this->db->where('idImagem', $id);
            $file = $this->db->get('imagens_produto', 1)->row();
            $idProdutos = $this->input->post('idProdutos');

            unlink($file->path . DIRECTORY_SEPARATOR . $file->anexo);

            if ($file->thumb != null) {
                unlink($file->path . DIRECTORY_SEPARATOR . 'thumbs' . DIRECTORY_SEPARATOR . $file->thumb);
            }

            if ($this->produtos_model->delete('imagens_produto', 'idImagem', $id) == true) {
                log_info('Removeu anexo de uma OS. ID (OS): ' . $idProdutos);
                echo json_encode(['result' => true, 'mensagem' => 'Anexo excluído com sucesso.']);
            } else {
                echo json_encode(['result' => false, 'mensagem' => 'Erro ao tentar excluir anexo.']);
            }
        }
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

    // Excluir as imagens vinculadas ao produto e a pasta do produto
    $imagens = $this->produtos_model->getImagensProduto($id);
    foreach ($imagens as $imagem) {
        $imagemPath = FCPATH . $imagem->path . DIRECTORY_SEPARATOR . $imagem->anexo;
        $thumbPath = FCPATH . $imagem->path . DIRECTORY_SEPARATOR . 'thumbs' . DIRECTORY_SEPARATOR . $imagem->thumb;
        
        if (file_exists($imagemPath)) {
            unlink($imagemPath);
        }
        if ($imagem->thumb != null && file_exists($thumbPath)) {
            unlink($thumbPath);
        }

        $this->produtos_model->delete('imagens_produto', 'idImagem', $imagem->idImagem);
    }

    // Excluir a pasta do produto
    $diretorioProduto = FCPATH . 'assets' . DIRECTORY_SEPARATOR . 'anexos' . DIRECTORY_SEPARATOR . 'produtos' . DIRECTORY_SEPARATOR . 'Produto-' . $id;
    if (is_dir($diretorioProduto . DIRECTORY_SEPARATOR . 'thumbs')) {
        rmdir($diretorioProduto . DIRECTORY_SEPARATOR . 'thumbs');
    }
    if (is_dir($diretorioProduto)) {
        rmdir($diretorioProduto);
    }

    // Excluir os registros das tabelas relacionadas
    $this->produtos_model->delete('produtos_os', 'produtos_id', $id);
    $this->produtos_model->delete('itens_de_vendas', 'produtos_id', $id);

    // Excluir o produto
    $this->produtos_model->delete('produtos', 'idProdutos', $id);

    // Excluir o modelo da tabela `modelo`
    $this->produtos_model->delete('modelo', 'idModelo', $idModelo);

    // Excluir os modelos compatíveis da tabela `compativeis`
    foreach ($idCompativeis as $idCompativel) {
        $this->produtos_model->delete('compativeis', 'idCompativel', $idCompativel);
    }

    // Excluir os registros da tabela `produto_compativel`
    $this->produtos_model->delete('produto_compativel', 'idProduto', $id);

    log_info('Removeu um produto, seu modelo, modelos compatíveis e imagens. ID: ' . $id);

    $this->session->set_flashdata('success', 'Produto, modelos compatíveis e imagens excluídos com sucesso!');
    redirect(site_url('produtos/gerenciar/'));
}

