<?php
class Produtos_model extends CI_Model
{
    /**
     * author: Ramon Silva
     * email: silva018-mg@yahoo.com.br
     *
     */
    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function get($table, $fields, $where = '', $perpage = 0, $start = 0, $one = false, $array = 'array')
    {
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->order_by('idProdutos', 'desc');
        $this->db->limit($perpage, $start);
        if ($where) {
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    public function getById($id)
{
    $this->db->select('
        produtos.*, 
        modelo.nomeModelo, 
        condicoes.descricaoCondicao, 
        direcao.descricaoDirecao
    ');
    $this->db->from('produtos');
    $this->db->join('modelo', 'modelo.idModelo = produtos.idModelo');
    $this->db->join('condicoes', 'condicoes.idCondicao = produtos.idCondicao', 'left');
    $this->db->join('direcao', 'direcao.idDirecao = produtos.idDirecao', 'left');
    $this->db->where('produtos.idProdutos', $id);
    $this->db->limit(1);
    $produto = $this->db->get()->row();

    if ($produto) {
        $this->db->select('compativeis.modeloCompativel');
        $this->db->from('produto_compativel');
        $this->db->join('compativeis', 'compativeis.idCompativel = produto_compativel.idCompativel');
        $this->db->where('produto_compativel.idProduto', $id);
        $produto->compativelProdutos = $this->db->get()->result();
    } else {
        $produto->compativelProdutos = [];
    }

    return $produto;
}

    public function add($table, $data)
    {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() == '1') {
            return true;
        }
        
        return false;
    }


    public function edit($table, $data, $fieldID, $ID)
    {
        $this->db->where($fieldID, $ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0) {
            return true;
        }
        
        return false;
    }


    
    public function delete($table, $fieldID, $ID)
    {
        $this->db->where($fieldID, $ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1') {
            return true;
        }
        
        return false;
    }
    
    public function count($table)
    {
        return $this->db->count_all($table);
    }

    public function updateEstoque($produto, $quantidade, $operacao = '-')
    {
        $sql = "UPDATE produtos set estoque = estoque $operacao ? WHERE idProdutos = ?";
        return $this->db->query($sql, [$quantidade, $produto]);
    }

    // modificações

    public function imgAnexar($produtos, $anexo, $urlImagem, $thumb, $path)
{
    $this->db->set('anexo', $anexo);
    $this->db->set('thumb', $thumb);
    $this->db->set('urlImagem', $urlImagem);
    $this->db->set('path', $path);
    $this->db->set('produto_id', $produtos);

    return $this->db->insert('imagens_produto');
}


    

    public function getImagensProduto($produtoId)
{
    $this->db->where('produto_id', $produtoId);
    return $this->db->get('imagens_produto')->result();
}


    // segunda modificação
    public function update_modelos_compativeis($idProduto, $modelosCompativeis) {
        // Buscar os idsCompativeis atuais
        $this->db->select('idCompativel');
        $this->db->from('produto_compativel');
        $this->db->where('idProduto', $idProduto);
        $query = $this->db->get();
        $existingIds = array_column($query->result_array(), 'idCompativel');
    
        // Garantir que $modelosCompativeis seja um array
        if (!is_array($modelosCompativeis)) {
            $modelosCompativeis = [];
        }
    
        // Identificar ids a serem removidos
        $idsToRemove = array_diff($existingIds, array_column($modelosCompativeis, 'idCompativel'));
        if (!empty($idsToRemove)) {
            $this->db->where('idProduto', $idProduto);
            $this->db->where_in('idCompativel', $idsToRemove);
            $this->db->delete('produto_compativel');
    
            // Também remover da tabela `compativeis`
            $this->db->where_in('idCompativel', $idsToRemove);
            $this->db->delete('compativeis');
        }
    
        // Atualizar ou adicionar novos ids
        foreach ($modelosCompativeis as $modeloCompativel) {
            if (is_array($modeloCompativel) && in_array($modeloCompativel['idCompativel'], $existingIds)) {
                // Atualizar o modelo compatível existente
                $this->db->where('idCompativel', $modeloCompativel['idCompativel']);
                $this->db->update('compativeis', ['modeloCompativel' => $modeloCompativel['modeloCompativel']]);
            } elseif (is_array($modeloCompativel) && !in_array($modeloCompativel['idCompativel'], $existingIds)) {
                // Adicionar novo modelo compatível
                $compativelData = ['modeloCompativel' => $modeloCompativel['modeloCompativel']];
                $this->db->insert('compativeis', $compativelData);
                $idCompativel = $this->db->insert_id();
    
                // Adicionar na tabela `produto_compativel`
                $produtoCompativelData = [
                    'idProduto' => $idProduto,
                    'idCompativel' => $idCompativel
                ];
                $this->db->insert('produto_compativel', $produtoCompativelData);
            }
        }
    }
    
    
    
    


    public function get_modelos_compativeis($idProduto) {
        $this->db->select('compativeis.idCompativel, compativeis.modeloCompativel');
        $this->db->from('produto_compativel');
        $this->db->join('compativeis', 'produto_compativel.idCompativel = compativeis.idCompativel');
        $this->db->where('produto_compativel.idProduto', $idProduto);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return []; // Retorna um array vazio se não houver resultados
        }
    }
    


    
    
    


    

}
