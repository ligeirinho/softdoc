<?php
/**
 * @model GrupoModel
 * @created at 27-03-2017 21:04:36
 * - Criado Automaticamente pelo HTR Assist
 */

namespace App\Models;

use HTR\System\ModelCRUD;
use HTR\Helpers\Mensagem\Mensagem as msg;
use HTR\Helpers\Paginator\Paginator;
use HTR\System\Security;

class GrupoModel extends ModelCRUD
{
    use \App\Validators\GrupoValidatorTrait;

    /**
     * Entidade padrão do Model
     */
    protected $entidade = 'softdoc_grupo';
    protected $id;
    protected $nomeGrupo;
    protected $criado;
    protected $alterado;

    private $resultadoPaginator;
    private $navePaginator;

    /**
     * @param \PDO $pdo Recebe uma instância do PDO
     */
    public function __construct(\PDO $pdo = null)
    {
        parent::__construct($pdo);
    }

    /**
     * Método uaso para retornar todos os dados da tabela.
     */
    public function returnAll()
    {
        /**
         * Método padrão do sistema usado para retornar todos os dados da tabela
         */
        return $this->findAll();
    }
    
    /**
     * Método usado para retornar todos os dados de grupo de acordo com o usuário.
     */
    public function returnGruposByUser($user){
        $query = "SELECT grupo.id, grupo.nome_grupo 
                FROM `softdoc_user_has_group` as uhg
                INNER JOIN softdoc_grupo as grupo ON grupo.id = uhg.grupo_id AND user_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$user['id']]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function paginator($pagina)
    {
        /**
         * Preparando as diretrizes da consulta
         */
        $dados = [
            'pdo' => $this->pdo,
            'entidade' => $this->entidade,
            'pagina' => $pagina,
            'maxResult' => 20,
        ];

        // Instacia o Helper que auxilia na paginação de páginas
        $paginator = new Paginator($dados);
        // Resultado da consulta
        $this->resultadoPaginator =  $paginator->getResultado();
        // Links para criação do menu de navegação da paginação @return array
        $this->navePaginator = $paginator->getNaveBtn();
    }
    
    public function paginatorUser($pagina, $user)
    {
        /**
         * Preparando as diretrizes da consulta
         */
        $dados = [
            'pdo' => $this->pdo,
            'select' => 'classificacao.id, nome_classificacao, '
            . 'classificacao.departamento, '
            . 'bas_departamento.nome_departamento as nome_departamento, criado, alterado',
            'entidade' => 'softdoc_classificacao as classificacao
			INNER JOIN bas_departamento ON bas_departamento.id= classificacao.departamento',
            'where' => "departamento = '{$user['departamento']}'",
            'pagina' => $pagina,
            'maxResult' => 20
        ];

        // Instacia o Helper que auxilia na paginação de páginas
        $paginator = new Paginator($dados);
        // Resultado da consulta
        $this->resultadoPaginator =  $paginator->getResultado();
        // Links para criação do menu de navegação da paginação @return array
        $this->navePaginator = $paginator->getNaveBtn();
    }


    /**
     * Acessivel para o Controller coletar os resultados
     */
    public function getResultadoPaginator()
    {
        return $this->resultadoPaginator;
    }

    /**
     * Acessivel para o Controller coletar os links da paginação
     */
    public function getNavePaginator()
    {
        return $this->navePaginator;
    }

    /**
     * Método responsável por salvar os registros
     */
    public function novo()
    {
        $token = new Security();
        $token->checkToken();

        // Valida dados
        $this->validateAll();
        // Verifica se há registro igual e evita a duplicação
        $this->notDuplicate();

       $dados = [
          'nome_grupo' => $this->getNomeGrupo(),
          'criado' => $this->getCriado()
        ];

        if ($this->insert($dados)) {
            msg::showMsg('111', 'success');
        }
    }

    /**
     * Método responsável por alterar os registros
     */
    public function editar()
    {
        $token = new Security();
        $token->checkToken();

        // Valida dados
        $this->validateAll();
        // Verifica se há registro igual e evita a duplicação
        $this->notDuplicate();

       $dados = [
          'nome_grupo' => $this->getNomeGrupo(),
          'alterado' => $this->getAlterado(),
        ];

        if ($this->update($dados, $this->getId())) {
            msg::showMsg('001', 'success');
        }
    }

    /**
     * Método responsável por remover os registros do sistema
     */
    public function remover($id)
    {
        if ($this->delete($id)) {
            header('Location: ' . APPDIR . 'Grupo/visualizar/');
        }
    }

    /**
     * Evita a duplicidade de registros no sistema
     */
    private function notDuplicate()
    {
        // Não deixa duplicar os valores do campo nome_grupo
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
                ->setFields(['id'])
                ->setFilters()
                ->where('id', '!=', $this->getId())
                ->whereOperator('AND')
                ->where('nome_grupo', '=' , $this->getNomeGrupo());
        $result = $this->db->execute()->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            msg::showMsg('Já existe um registro com este(s) caractere(s) no campo '
                . '<strong>Classificação</strong>.'
                . '<script>focusOn("nome_grupo")</script>', 'warning');
        }
    }

    /*
     * Validação dos Dados enviados pelo formulário
     */
    private function validateAll()
    {
        // Seta todos os valores
        $this->setId(filter_input(INPUT_POST, 'id'));
        $this->setNomeGrupo(filter_input(INPUT_POST, 'nome_grupo'));
        $this->setCriado(time());
        $this->setAlterado(time());

        // Inicia a Validação dos dados
        $this->validateNomeGrupo();
    }

    private function setId($value)
    {
        $this->id = $value ? : time();
        return $this;
    }
    
    public function returnAllGroupByUser($user)
    {
        $query = "SELECT grp.id, grp.nome_grupo "
                . "FROM `softdoc_user_has_group` as uhg "
                . "INNER JOIN softdoc_grupo as grp ON grp.id = uhg.grupo_id "
                . "AND uhg.user_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$user['id']]);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        return $result;
    }
}
