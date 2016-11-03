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
            // USAR QUANDO FOR PARA DEMONSTRAR O RESULTADO DE UMA PESQUISA
            //'orderBy' => 'nome ASC',
            //'where' => 'nome LIKE ?',
            //'bindValue' => [0 => '%MONTEIRO%']
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
          'nome_classificacao' => $this->getNomeClassificacao(),
          'departamento' => $this->getDepartamento(),
          'criado' => $this->getCriado(),
          'alterado' => $this->getAlterado(),
          'usuario_id' => $this->getUsuarioId(),
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
          'nome_classificacao' => $this->getNomeClassificacao(),
          'departamento' => $this->getDepartamento(),
          'criado' => $this->getCriado(),
          'alterado' => $this->getAlterado(),
          'usuario_id' => $this->getUsuarioId(),
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
        // Não deixa duplicar os valores do campo departamento
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
                ->setFields(['id'])
                ->setFilters()
                ->where('id', '!=', $this->getId())
                ->whereOperator('AND')
                ->where('departamento', '=' , $this->getDepartamento());
        $result = $this->db->execute()->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            msg::showMsg('Já existe um registro com este(s) caractere(s) no campo '
                . '<strong>Departamento</strong>.'
                . '<script>focusOn("departamento")</script>', 'warning');
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
        // Não deixa duplicar os valores do campo usuario_id
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
                ->setFields(['id'])
                ->setFilters()
                ->where('id', '!=', $this->getId())
                ->whereOperator('AND')
                ->where('usuario_id', '=' , $this->getUsuarioId());
        $result = $this->db->execute()->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            msg::showMsg('Já existe um registro com este(s) caractere(s) no campo '
                . '<strong>Usuário</strong>.'
                . '<script>focusOn("usuario_id")</script>', 'warning');
        }
    }

    /*
     * Validação dos Dados enviados pelo formulário
     */
    private function validateAll()
    {
        // Seta todos os valores
        $this->setId(filter_input(INPUT_POST, 'id'));
        $this->setNomeClassificacao(filter_input(INPUT_POST, 'nome_classificacao'));
        $this->setDepartamento(filter_input(INPUT_POST, 'departamento'));
        $this->setCriado(filter_input(INPUT_POST, 'criado'));
        $this->setAlterado(filter_input(INPUT_POST, 'alterado'));
        $this->setUsuarioId(filter_input(INPUT_POST, 'usuario_id'));

        // Inicia a Validação dos dados
        $this->validateId();
        $this->validateNomeClassificacao();
        $this->validateDepartamento();
        $this->validateCriado();
        $this->validateAlterado();
        $this->validateUsuarioId();
    }

    private function setId($value)
    {
        $this->id = $value ? : time();
        return $this;
    }
}
