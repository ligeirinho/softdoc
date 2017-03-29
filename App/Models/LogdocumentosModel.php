<?php
/**
 * @model LogdocumentosModel
 * @created at 27-03-2017 21:02:00
 * - Criado Automaticamente pelo HTR Assist
 */

namespace App\Models;

use HTR\System\ModelCRUD;
use HTR\Helpers\Mensagem\Mensagem as msg;
use HTR\Helpers\Paginator\Paginator;
use HTR\System\Security;

class LogdocumentosModel extends ModelCRUD
{
    use \App\Validators\LogdocumentosValidatorTrait;

    /**
     * Entidade padrão do Model
     */
    protected $entidade = 'softdoc_log_documentos';
    protected $id;
    protected $documentoId;
    protected $acaoId;
    protected $userId;
    protected $criado;

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
    public function novo($documentoId, $acaoId, $userId)
    {
       
       $dados = [
          'documento_id' => $documentoId,
          'acao_id' => $acaoId,
          'user_id' => $userId,
          'criado' => time(),
        ];

        if ($this->insert($dados)) {
            return true;
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
          'documento_id' => $this->getDocumentoId(),
          'acao_id' => $this->getAcaoId(),
          'user_id' => $this->getUserId(),
          'criado' => $this->getCriado(),
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
            header('Location: ' . APPDIR . 'Logdocumentos/visualizar/');
        }
    }

    /**
     * Evita a duplicidade de registros no sistema
     */
    private function notDuplicate()
    {
        // Não deixa duplicar os valores do campo documento_id
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
                ->setFields(['id'])
                ->setFilters()
                ->where('id', '!=', $this->getId())
                ->whereOperator('AND')
                ->where('documento_id', '=' , $this->getDocumentoId());
        $result = $this->db->execute()->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            msg::showMsg('Já existe um registro com este(s) caractere(s) no campo '
                . '<strong>Documento</strong>.'
                . '<script>focusOn("documento_id")</script>', 'warning');
        }
        // Não deixa duplicar os valores do campo acao_id
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
                ->setFields(['id'])
                ->setFilters()
                ->where('id', '!=', $this->getId())
                ->whereOperator('AND')
                ->where('acao_id', '=' , $this->getAcaoId());
        $result = $this->db->execute()->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            msg::showMsg('Já existe um registro com este(s) caractere(s) no campo '
                . '<strong>acao_id</strong>.'
                . '<script>focusOn("acao_id")</script>', 'warning');
        }
        // Não deixa duplicar os valores do campo user_id
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
                ->setFields(['id'])
                ->setFilters()
                ->where('id', '!=', $this->getId())
                ->whereOperator('AND')
                ->where('user_id', '=' , $this->getUserId());
        $result = $this->db->execute()->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            msg::showMsg('Já existe um registro com este(s) caractere(s) no campo '
                . '<strong>user_id</strong>.'
                . '<script>focusOn("user_id")</script>', 'warning');
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
                . '<strong>criado</strong>.'
                . '<script>focusOn("criado")</script>', 'warning');
        }
    }

    /*
     * Validação dos Dados enviados pelo formulário
     */
    private function validateAll()
    {
        // Seta todos os valores
        $this->setId(filter_input(INPUT_POST, 'id'));
        $this->setDocumentoId(filter_input(INPUT_POST, 'documento_id'));
        $this->setAcaoId(filter_input(INPUT_POST, 'acao_id'));
        $this->setUserId(filter_input(INPUT_POST, 'user_id'));
        $this->setCriado(filter_input(INPUT_POST, 'criado'));

        // Inicia a Validação dos dados
        $this->validateId();
        $this->validateDocumentoId();
        $this->validateAcaoId();
        $this->validateUserId();
        $this->validateCriado();
    }

    private function setId($value)
    {
        $this->id = $value ? : time();
        return $this;
    }
}
