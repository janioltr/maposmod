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


