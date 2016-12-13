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
    protected $link;
    protected $departamento;
    protected $classificacaoId;
    private $resultadoPaginator;
    private $navePaginator;
    private $arrMimiTypeToExtension = [
        'application/msword' => ['doc', 'dot'],
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.template' => 'dotx',
        'application/vnd.ms-word.document.macroEnabled.12' => 'docm',
        'application/vnd.ms-word.template.macroEnabled.12' => 'dotm',
        'application/vnd.ms-excel' => ['xls', 'xlt', 'xla'],
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.template' => 'xltx',
        'application/vnd.ms-excel.sheet.macroEnabled.12' => 'xlsm',
        'application/vnd.ms-excel.template.macroEnabled.12' => 'xltm',
        'application/vnd.ms-excel.addin.macroEnabled.12' => 'xlam',
        'application/vnd.ms-excel.sheet.binary.macroEnabled.12' => 'xlsb',
        'application/vnd.ms-powerpoint' => ['ppt', 'pot', 'pps', 'ppa'],
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
        'application/vnd.openxmlformats-officedocument.presentationml.template' => 'potx',
        'application/vnd.openxmlformats-officedocument.presentationml.slideshow' => 'ppsx',
        'application/vnd.ms-powerpoint.addin.macroEnabled.12' => 'ppam',
        'application/vnd.ms-powerpoint.presentation.macroEnabled.12' => 'pptm',
        'application/vnd.ms-powerpoint.template.macroEnabled.12' => 'potm',
        'application/vnd.ms-powerpoint.slideshow.macroEnabled.12' => 'ppsm',
        'application/pdf' => 'pdf',
        'application/jpeg' => 'jpg'
    ];
    private $arrExtensionToMimeType = [
        'doc' => ['application/msword', 'download' => true],
        'dot' => ['application/msword', 'download' => true],
        'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'download' => true],
        'dotx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.template', 'download' => true],
        'docm' => ['application/vnd.ms-word.document.macroEnabled.12', 'download' => true],
        'dotm' => ['application/vnd.ms-word.template.macroEnabled.12','download' => true],
        'xls' => ['application/vnd.ms-excel','download' => true],
        'xlt' => ['application/vnd.ms-excel','download' => true],
        'xla' => ['application/vnd.ms-excel','download' => true],
        'xlsx' =>['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','download' => true],
        'xltx' => ['application/vnd.openxmlformats-officedocument.spreadsheetml.template','download' => true],
        'xlsm' => ['application/vnd.ms-excel.sheet.macroEnabled.12','download' => true],
        'xltm' => ['application/vnd.ms-excel.template.macroEnabled.12','download' => true],
        'xlam' => ['application/vnd.ms-excel.addin.macroEnabled.12','download' => true],
        'xlsb' => ['application/vnd.ms-excel.sheet.binary.macroEnabled.12','download' => true],
        'ppt' => ['application/vnd.ms-powerpoint','download' => true],
        'pot' => ['application/vnd.ms-powerpoint','download' => true],
        'pps' => ['application/vnd.ms-powerpoint','download' => true],
        'ppa' => ['application/vnd.ms-powerpoint','download' => true],
        'pptx' => ['application/vnd.openxmlformats-officedocument.presentationml.presentation','download' => true],
        'potx' => ['application/vnd.openxmlformats-officedocument.presentationml.template','download' => true],
        'ppsx' => ['application/vnd.openxmlformats-officedocument.presentationml.slideshow','download' => true],
        'ppam' => ['application/vnd.ms-powerpoint.addin.macroEnabled.12','download' => true],
        'pptm' => ['application/vnd.ms-powerpoint.presentation.macroEnabled.12','download' => true],
        'potm' => ['application/vnd.ms-powerpoint.template.macroEnabled.12','download' => true],
        'ppsm' => ['application/vnd.ms-powerpoint.slideshow.macroEnabled.12','download' => true],
        'pdf' => ['application/pdf', 'download' => false],
        'jpg' => ['application/jpeg', 'download' => false]
    ];
    
    

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
        $dados = [
            'pdo' => $this->pdo,
            'select' => ' documentos.id, titulo, auth.name, extensao, '
            . 'tamanho, departamento.nome as departamento, '
            . 'classificacao.nome_classificacao as classificacao',
            'entidade' => '`documentos`
			INNER JOIN auth ON auth.id=user_id
                        INNER JOIN departamento ON departamento.id=auth.departamento
                        INNER JOIN classificacao ON classificacao.id=classificacao_id',
            'pagina' => $pagina,
            'maxResult' => 20
        ];


        // Instacia o Helper que auxilia na paginação de páginas
        $paginator = new Paginator($dados);
        // Resultado da consulta
        $this->resultadoPaginator = $paginator->getResultado();
        // Links para criação do menu de navegação da paginação @return array
        $this->navePaginator = $paginator->getNaveBtn();
    }

    /**
     * Método responsável por filtro de categorias do sistema
     *
     * @param int $pagina
     * @param int $find
     * @return array
     */
    public function filterByCategoria($pagina, $find)
    {
        /**
         * Preparando as diretrizes da consulta
         */
        $dados = [
            'pdo' => $this->pdo,
            'select' => ' documentos.id, titulo, auth.name, extensao, '
            . 'tamanho, departamento.nome as departamento, documentos.criado, '
            . 'classificacao.nome_classificacao as classificacao',
            'entidade' => '`documentos`
			INNER JOIN auth ON auth.id=user_id
                        INNER JOIN departamento ON departamento.id=auth.departamento
                        INNER JOIN classificacao ON classificacao.id=classificacao_id',
            'where' => 'classificacao_id = ?',
            'bindValue' => [$find],
            'pagina' => $pagina,
            'maxResult' => 20
        ];

        // Instacia o Helper que auxilia na paginação de páginas
        $paginator = new Paginator($dados);
        // Resultado da consulta
        $this->resultadoPaginator = $paginator->getResultado();
        // Links para criação do menu de navegação da paginação @return array
        $this->navePaginator = $paginator->getNaveBtn();
    }

    private function upload($dados, $id)
    {
        if (!$dados) {
            return;
        }

        if (empty($dados['arquivo'])) {
            msg::showMsg('É necessário fornecer um <strong>arquivo</strong> para publicar uma documentação.', 'danger');
        }

        if ($dados['arquivo']['size'] == 0) {
            msg::showMsg('Ocorreu um erro ao enviar a arquivo.'
                . 'Verifique se o tamanho do arquivo ultrapassa <strong>10MB</strong>.', 'danger');
        }
        
        $extension = $this->validateExtesion($dados['arquivo']);
        
        if (!$extension) {
            msg::showMsg('O sistema não suporta o arquivo enviado.', 'danger');
        }
        
        $diretorio = 'files_uploads/' . $extension . '/';
        @mkdir($diretorio, '0777');

        if (!move_uploaded_file($dados['arquivo']['tmp_name'], $diretorio . $id . '.' . $extension)) {
            msg::showMsg('Ocorreu um erro ao enviar o arquivo', 'danger');
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

        $dados = [
            'titulo' => $this->getTitulo(),
            'user_id' => $this->getUserId(),
            'extensao' => $this->getExtensao(),
            'tamanho' => $this->getTamanho(),
            'link' => $this->getLink(),
            'departamento' => $this->getDepartamento(),
            'classificacao_id' => $this->getClassificacaoId(),
            'criado' => time(),
        ];

        if ($this->insert($dados)) {

            $id = $this->pdo->lastInsertId();
            $this->upload($_FILES, $id);

            msg::showMsg('111', 'success');
        }
    }

    /**
     * Método responsável por alterar os registros
     */
    public function editar($User)
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
            'tamanho' => $this->getTamanho(),
            'link' => $this->getLink(),
            'departamento' => $this->getDepartamento(),
            'classificacao_id' => $this->getClassificacaoId(),
        ];

        $this->upload($_FILES, $this->getId());

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
            ->where('titulo', '=', $this->getTitulo());
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
            ->where('user_id', '=', $this->getUserId());
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
            ->where('extensao', '=', $this->getExtensao());
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
            ->where('revisao', '=', $this->getRevisao());
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
            ->where('tamanho', '=', $this->getTamanho());
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
            ->where('departamento', '=', $this->getDepartamento());
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
            ->where('classificacao_id', '=', $this->getClassificacaoId());
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
        $extensao = $this->validateExtesion($_FILES['arquivo']);

        if (!$extensao) {
            msg::showMsg('O sistema não suporta o arquivo enviado.', 'danger');
        }


        // Seta todos os valores
        $this->setId(filter_input(INPUT_POST, 'id'));
        $this->setTitulo(filter_input(INPUT_POST, 'titulo'));
        $this->setUserId($User['id']);
        $this->setExtensao($extensao);
        $this->setRevisao(filter_input(INPUT_POST, 'revisao'));
        $this->setTamanho($_FILES['arquivo']['size']);
        $this->setLink(filter_input(INPUT_POST, 'link'));
        $this->setDepartamento($User['departamento']);
        $this->setClassificacaoId(filter_input(INPUT_POST, 'classificacao_id'));

        // Inicia a Validação dos dados
        $this->validateId();
        $this->validateTitulo();
        $this->validateClassificacaoId();
    }

    private function validateExtesion($arquivo)
    {
        if (!array_key_exists($arquivo['type'], $this->arrMimiTypeToExtension)) {
            return false;
        }

        $ext = $this->arrMimiTypeToExtension[$arquivo['type']];

        if (is_array($ext)) {

            $arquivoExt = explode('.', $arquivo['name']);
            $arquivoExt = strtolower($arquivoExt[count($arquivoExt) - 1]);

            if (in_array($arquivoExt, $ext)) {
                return $ext[$arquivoExt];
            }

            return false;
        }

        return $ext;
    }

    private function setId($value)
    {
        $this->id = $value ?: time();
        return $this;
    }

    public function loadPublicacao($documento)
    {
        // caso a publicação seja um link externo, redireciona para este link
        if ($documento['link']) {
            header("location: " . $documento['link']);
            return true;
        }

        // constroi o path para o arquivo
        $filename = 'files_uploads/' . $documento['extensao'] . '/' . $documento['id'] . '.' . $documento['extensao'];

        if (file_exists($filename)) {

            // indica para o browser qual o tipo do arquivo
            // arquivos com a extensão *.DOC, *.DOCX, *.PPT, *.PPTX
            // será iniciado o download automático do arquivo
            $content = $this->getContentType($documento['extensao']);

            // caso a extensão não seja suportada, para a execução do restante do script e retorna FALSE
            if (!$content) {
                return false;
            }

            // verifica se o arquivo deve ser lido pelo browser
            if (!$content['download']) {
                $file = file_get_contents($filename);
                echo $file;
            }

            return true;
        }

        // falha na execução
        return false;
    }

    private function getContentType($extensao)
    {
        if (array_key_exists($extensao, $this->arrExtensionToMimeType)) {
            $mimeType = $this->arrExtensionToMimeType[$extensao];
            header("Content-Type: {$mimeType[0]}");
            
            if ($mimeType['download']) {
                header("Content-Disposition: attachment; filename=" . time() . ".$extensao");
            }
            return $mimeType;
        }
        
        return false;
    }
}
