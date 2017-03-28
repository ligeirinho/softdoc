<?php
/**
 * @model UsersModel
 * @created at 28-03-2017 21:39:35
 * - Criado Automaticamente pelo HTR Assist
 */

namespace App\Models;

use HTR\System\ModelCRUD;
use HTR\Helpers\Mensagem\Mensagem as msg;
use HTR\Helpers\Paginator\Paginator;
use HTR\System\Security;

class UsersModel extends ModelCRUD
{

    /**
     * Entidade padrão do Model
     */
    protected $entidade = 'users';
    protected $id;
    protected $nome;
    protected $email;
    protected $departamento;
    protected $ramal;
    protected $matricula;
    protected $telefone;
    protected $celular;
    protected $criado;
    protected $ativo;

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
          'nome' => $this->getNome(),
          'email' => $this->getEmail(),
          'departamento' => $this->getDepartamento(),
          'ramal' => $this->getRamal(),
          'matricula' => $this->getMatricula(),
          'telefone' => $this->getTelefone(),
          'celular' => $this->getCelular(),
          'criado' => $this->getCriado(),
          'ativo' => $this->getAtivo(),
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
          'nome' => $this->getNome(),
          'email' => $this->getEmail(),
          'departamento' => $this->getDepartamento(),
          'ramal' => $this->getRamal(),
          'matricula' => $this->getMatricula(),
          'telefone' => $this->getTelefone(),
          'celular' => $this->getCelular(),
          'criado' => $this->getCriado(),
          'ativo' => $this->getAtivo(),
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
            header('Location: ' . APPDIR . 'users/visualizar/');
        }
    }

    /**
     * Evita a duplicidade de registros no sistema
     */
    private function notDuplicate()
    {
        // Não deixa duplicar os valores do campo nome
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
                ->setFields(['id'])
                ->setFilters()
                ->where('id', '!=', $this->getId())
                ->whereOperator('AND')
                ->where('nome', '=' , $this->getNome());
        $result = $this->db->execute()->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            msg::showMsg('Já existe um registro com este(s) caractere(s) no campo '
                . '<strong>Nome do Usuário</strong>.'
                . '<script>focusOn("nome")</script>', 'warning');
        }
        // Não deixa duplicar os valores do campo email
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
                ->setFields(['id'])
                ->setFilters()
                ->where('id', '!=', $this->getId())
                ->whereOperator('AND')
                ->where('email', '=' , $this->getEmail());
        $result = $this->db->execute()->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            msg::showMsg('Já existe um registro com este(s) caractere(s) no campo '
                . '<strong>E-mail</strong>.'
                . '<script>focusOn("email")</script>', 'warning');
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
        // Não deixa duplicar os valores do campo ramal
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
                ->setFields(['id'])
                ->setFilters()
                ->where('id', '!=', $this->getId())
                ->whereOperator('AND')
                ->where('ramal', '=' , $this->getRamal());
        $result = $this->db->execute()->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            msg::showMsg('Já existe um registro com este(s) caractere(s) no campo '
                . '<strong>Ramal</strong>.'
                . '<script>focusOn("ramal")</script>', 'warning');
        }
        // Não deixa duplicar os valores do campo matricula
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
                ->setFields(['id'])
                ->setFilters()
                ->where('id', '!=', $this->getId())
                ->whereOperator('AND')
                ->where('matricula', '=' , $this->getMatricula());
        $result = $this->db->execute()->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            msg::showMsg('Já existe um registro com este(s) caractere(s) no campo '
                . '<strong>Matrícula</strong>.'
                . '<script>focusOn("matricula")</script>', 'warning');
        }
        // Não deixa duplicar os valores do campo telefone
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
                ->setFields(['id'])
                ->setFilters()
                ->where('id', '!=', $this->getId())
                ->whereOperator('AND')
                ->where('telefone', '=' , $this->getTelefone());
        $result = $this->db->execute()->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            msg::showMsg('Já existe um registro com este(s) caractere(s) no campo '
                . '<strong>Telefone</strong>.'
                . '<script>focusOn("telefone")</script>', 'warning');
        }
        // Não deixa duplicar os valores do campo celular
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
                ->setFields(['id'])
                ->setFilters()
                ->where('id', '!=', $this->getId())
                ->whereOperator('AND')
                ->where('celular', '=' , $this->getCelular());
        $result = $this->db->execute()->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            msg::showMsg('Já existe um registro com este(s) caractere(s) no campo '
                . '<strong>Celular</strong>.'
                . '<script>focusOn("celular")</script>', 'warning');
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
        // Não deixa duplicar os valores do campo ativo
        $this->db->instruction(new \HTR\Database\Instruction\Select($this->entidade))
                ->setFields(['id'])
                ->setFilters()
                ->where('id', '!=', $this->getId())
                ->whereOperator('AND')
                ->where('ativo', '=' , $this->getAtivo());
        $result = $this->db->execute()->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            msg::showMsg('Já existe um registro com este(s) caractere(s) no campo '
                . '<strong>Ativo</strong>.'
                . '<script>focusOn("ativo")</script>', 'warning');
        }
    }

    /*
     * Validação dos Dados enviados pelo formulário
     */
    private function validateAll()
    {
        // Seta todos os valores
        $this->setId(filter_input(INPUT_POST, 'id'));
        $this->setNome(filter_input(INPUT_POST, 'nome'));
        $this->setEmail(filter_input(INPUT_POST, 'email'));
        $this->setDepartamento(filter_input(INPUT_POST, 'departamento'));
        $this->setRamal(filter_input(INPUT_POST, 'ramal'));
        $this->setMatricula(filter_input(INPUT_POST, 'matricula'));
        $this->setTelefone(filter_input(INPUT_POST, 'telefone'));
        $this->setCelular(filter_input(INPUT_POST, 'celular'));
        $this->setCriado(filter_input(INPUT_POST, 'criado'));
        $this->setAtivo(filter_input(INPUT_POST, 'ativo'));

        // Inicia a Validação dos dados
        $this->validateId();
        $this->validateNome();
        $this->validateEmail();
        $this->validateDepartamento();
        $this->validateRamal();
        $this->validateMatricula();
        $this->validateTelefone();
        $this->validateCelular();
        $this->validateCriado();
        $this->validateAtivo();
    }

    private function setId($value)
    {
        $this->id = $value ? : time();
        return $this;
    }
}
