<?php
/**
 * @model DocumentosModel
 * @created at 03-11-2016 12:49:34
 * - Criado Automaticamente pelo HTR Assist
 */

namespace App\Models;

use HTR\System\ModelCRUD;
use HTR\Helpers\Mensagem\Mensagem as msg;
use HTR\Helpers\Paginator\Paginator;
use HTR\System\Security;

class DocumentosModel extends ModelCRUD
{
    use \App\Validators\DocumentosValidatorTrait;

    /**
     * Entidade padrão do Model
     */
    protected $entidade = 'documentos';
    protected $id;
    protected $titulo;
    protected $userId;
    protected $logId;
    protected $extensao;
    protected $revisao;
    protected $tamanho;
    protected $departamento;
    protected $classificacaoId;

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
    
    private function upload($dados, $id)
    {
        if (!$dados) {
            return;
        }

        if (!isset($dados['arquivo'])) {
            return;
        }

        if ($dados['arquivo']['type'] != 'application/pdf') {
            msg::showMsg('O arquivo de publicação deve ser no formato PDF. '
                . '<strong>Extensão *.jpg</strong>.', 'danger');
        }

        if ($dados['arquivo']['size'] == 0) {
            msg::showMsg('Ocorreu um erro ao enviar o arquivo de puplicação.'
                . 'Verifique se o tamanho da imagem ultrapassa <strong>10MB</strong>.', 'danger');
        }

        if (!move_uploaded_file($dados['arquivo']['tmp_name'], 'files_uploads/' . $id . '.pdf')) {
            msg::showMsg('Ocorreu um erro ao salvar o arquivo de publicação.'
                . 'Verifique sua conexão com a internet.', 'danger');
        }
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
    public function novo($User)
    {
        $token = new Security();
        $token->checkToken();

        // Valida dados
        $this->validateAll($User);
        // Verifica se há registro igual e evita a duplicação
        $this->notDuplicate();

       $dados = [
          'titulo' => $this->getTitulo(),
          'user_id' => $this->getUserId(),
          'extensao' => $this->getExtensao(),
          'revisao' => $this->getRevisao(),
          'tamanho' => $this->getTamanho(),
          'departamento' => $this->getDepartamento(),
          'classificacao_id' => $this->getClassificacaoId(),
        ];

        if ($this->insert($dados)) {
            
            $id = $this->pdo->lastInsertId();
            $acao = "Inserir";
            $this->upload($_FILES, $id);
            
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
          'titulo' => $this->getTitulo(),
          'user_id' => $this->getUserId(),
          'extensao' => $this->getExtensao(),
          'revisao' => $this->getRevisao(),
          'tamanho' => $this->getTamanho(),
          'departamento' => $this->getDepartamento(),
          'classificacao_id' => $this->getClassificacaoId(),
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
            header('Location: ' . APPDIR . 'documentos/visualizar/');
        }
    }

    /**
     * Evita a duplicidade de registros no sistema
     */
    private function notDuplicate()
    {
        // Não deixa duplicar os valores do campo titulo
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
                ->setFields(['id'])
                ->setFilters()
                ->where('id', '!=', $this->getId())
                ->whereOperator('AND')
                ->where('titulo', '=' , $this->getTitulo());
        $result = $this->db->execute()->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            msg::showMsg('Já existe um registro com este(s) caractere(s) no campo '
                . '<strong>Título</strong>.'
                . '<script>focusOn("titulo")</script>', 'warning');
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
                . '<strong>Usuário</strong>.'
                . '<script>focusOn("user_id")</script>', 'warning');
        }
        
        // Não deixa duplicar os valores do campo extensao
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
                ->setFields(['id'])
                ->setFilters()
                ->where('id', '!=', $this->getId())
                ->whereOperator('AND')
                ->where('extensao', '=' , $this->getExtensao());
        $result = $this->db->execute()->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            msg::showMsg('Já existe um registro com este(s) caractere(s) no campo '
                . '<strong>Extensão</strong>.'
                . '<script>focusOn("extensao")</script>', 'warning');
        }
        // Não deixa duplicar os valores do campo revisao
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
                ->setFields(['id'])
                ->setFilters()
                ->where('id', '!=', $this->getId())
                ->whereOperator('AND')
                ->where('revisao', '=' , $this->getRevisao());
        $result = $this->db->execute()->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            msg::showMsg('Já existe um registro com este(s) caractere(s) no campo '
                . '<strong>Revisão</strong>.'
                . '<script>focusOn("revisao")</script>', 'warning');
        }
        // Não deixa duplicar os valores do campo tamanho
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
                ->setFields(['id'])
                ->setFilters()
                ->where('id', '!=', $this->getId())
                ->whereOperator('AND')
                ->where('tamanho', '=' , $this->getTamanho());
        $result = $this->db->execute()->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            msg::showMsg('Já existe um registro com este(s) caractere(s) no campo '
                . '<strong>Tamanho</strong>.'
                . '<script>focusOn("tamanho")</script>', 'warning');
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
        // Não deixa duplicar os valores do campo classificacao_id
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
                ->setFields(['id'])
                ->setFilters()
                ->where('id', '!=', $this->getId())
                ->whereOperator('AND')
                ->where('classificacao_id', '=' , $this->getClassificacaoId());
        $result = $this->db->execute()->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            msg::showMsg('Já existe um registro com este(s) caractere(s) no campo '
                . '<strong>Classificação</strong>.'
                . '<script>focusOn("classificacao_id")</script>', 'warning');
        }
    }

    /*
     * Validação dos Dados enviados pelo formulário
     */
    private function validateAll($User)
    {
        // Seta todos os valores
        $this->setId(filter_input(INPUT_POST, 'id'));
        $this->setTitulo(filter_input(INPUT_POST, 'titulo'));
        $this->setUserId($User['id']);
        $this->setExtensao($_FILES['arquivo']['type']);
        $this->setRevisao(filter_input(INPUT_POST, 'revisao'));
        $this->setTamanho($_FILES['arquivo']['size']);
        $this->setDepartamento(filter_input(INPUT_POST, 'departamento'));
        $this->setClassificacaoId(filter_input(INPUT_POST, 'classificacao_id'));

        // Inicia a Validação dos dados
        $this->validateId();
        $this->validateTitulo();
        $this->validateDepartamento();
        $this->validateClassificacaoId();
    }

    private function setId($value)
    {
        $this->id = $value ? : time();
        return $this;
    }
}
