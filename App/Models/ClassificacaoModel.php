<?php
/**
 * @model ClassificacaoModel
 * @created at 03-11-2016 12:50:59
 * - Criado Automaticamente pelo HTR Assist
 */

namespace App\Models;

use HTR\System\ModelCRUD;
use HTR\Helpers\Mensagem\Mensagem as msg;
use HTR\Helpers\Paginator\Paginator;
use HTR\System\Security;

class ClassificacaoModel extends ModelCRUD
{
    use \App\Validators\ClassificacaoValidatorTrait;

    /**
     * Entidade padrão do Model
     */
    protected $entidade = 'classificacao';
    protected $id;
    protected $nomeClassificacao;
    protected $departamento;
    protected $criado;
    protected $alterado;
    protected $usuarioId;

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
     * Método uaso para retornar todos os dados de classificação de acordo com o departamento do usuário.
     */
    public function returnClassificacao($user){
        $query = "SELECT 
                COUNT(doc.id) AS quantidade, cl.id AS classificacao_id, 
                cl.nome_classificacao, dep.nome AS departamento
            FROM `documentos` AS doc
                INNER JOIN classificacao AS cl ON cl.id = doc.classificacao_id
                INNER JOIN departamento AS dep ON dep.id = doc.departamento
                INNER JOIN auth ON auth.id = doc.user_id AND auth.id = ?
            GROUP BY cl.nome_classificacao ORDER BY cl.nome_classificacao";
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
            . 'departamento.nome as nome_departamento, criado, alterado',
            'entidade' => 'classificacao
			INNER JOIN departamento ON departamento.id= classificacao.departamento',
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
    public function novo($user)
    {
        $token = new Security();
        $token->checkToken();

        // Valida dados
        $this->validateAll($user);
        // Verifica se há registro igual e evita a duplicação
        $this->notDuplicate();

       $dados = [
          'nome_classificacao' => $this->getNomeClassificacao(),
          'departamento' => $this->getDepartamento(),
          'criado' => $this->getCriado(),
        ];

        if ($this->insert($dados)) {
            msg::showMsg('111', 'success');
        }
    }

    /**
     * Método responsável por alterar os registros
     */
    public function editar($user)
    {
        $token = new Security();
        $token->checkToken();

        // Valida dados
        $this->validateAll($user);
        // Verifica se há registro igual e evita a duplicação
        $this->notDuplicate();

       $dados = [
          'nome_classificacao' => $this->getNomeClassificacao(),
          'departamento' => $this->getDepartamento(),
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
            header('Location: ' . APPDIR . 'classificacao/visualizar/');
        }
    }

    /**
     * Evita a duplicidade de registros no sistema
     */
    private function notDuplicate()
    {
        // Não deixa duplicar os valores do campo nome_classificacao
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
                ->setFields(['id'])
                ->setFilters()
                ->where('id', '!=', $this->getId())
                ->whereOperator('AND')
                ->where('nome_classificacao', '=' , $this->getNomeClassificacao());
        $result = $this->db->execute()->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            msg::showMsg('Já existe um registro com este(s) caractere(s) no campo '
                . '<strong>Classificação</strong>.'
                . '<script>focusOn("nome_classificacao")</script>', 'warning');
        }
        
        // Não deixa duplicar os valores do campo criado
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
                ->setFields(['id'])
                ->setFilters()
                ->where('id', '!=', $this->getId())
                ->whereOperator('AND')
                ->where('criado', '=' , $this->getCriado());
        $result = $this->db->execute()->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            msg::showMsg('Já existe um registro com este(s) caractere(s) no campo '
                . '<strong>Criado</strong>.'
                . '<script>focusOn("criado")</script>', 'warning');
        }
        // Não deixa duplicar os valores do campo alterado
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
                ->setFields(['id'])
                ->setFilters()
                ->where('id', '!=', $this->getId())
                ->whereOperator('AND')
                ->where('alterado', '=' , $this->getAlterado());
        $result = $this->db->execute()->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            msg::showMsg('Já existe um registro com este(s) caractere(s) no campo '
                . '<strong>Alterado</strong>.'
                . '<script>focusOn("alterado")</script>', 'warning');
        }
    }

    /*
     * Validação dos Dados enviados pelo formulário
     */
    private function validateAll($user)
    {
        // Seta todos os valores
        $this->setId(filter_input(INPUT_POST, 'id'));
        $this->setNomeClassificacao(filter_input(INPUT_POST, 'nome_classificacao'));
        $this->setDepartamento($user['departamento']);
        $this->setCriado(time());
        $this->setAlterado(time());

        // Inicia a Validação dos dados
        $this->validateId();
        $this->validateNomeClassificacao();
        $this->validateDepartamento();
        $this->validateCriado();
        $this->validateAlterado();
    }

    private function setId($value)
    {
        $this->id = $value ? : time();
        return $this;
    }
    
    public function returnAllClassificacaoByUser($user)
    {
        // Não deixa duplicar os valores do campo criado
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
            ->setFields(['id', 'nome_classificacao'])
            ->setFilters()
            ->where('departamento', '=', $user['departamento']);
        return $this->db->execute()->fetchAll(\PDO::FETCH_ASSOC);
    }
}
