<?php
/**
 * @Controller DocumentosController
 * @Created at 03-11-2016 12:49:33
 * - Criado Automaticamente pelo HTR Assist
 */

namespace App\Controllers;

use HTR\System\ControllerAbstract as Controller;
use HTR\Interfaces\ControllerInterface;
use HTR\Helpers\Access\Access;
use App\Models\DocumentosModel;
use App\Models\DepartamentoModel as Departamento;
use App\Models\ClassificacaoModel as Classificacao;

class DocumentosController extends Controller implements ControllerInterface
{
    // Model padrão usado para este Controller
    private $modelDefault;

    // Atributo que guarda o Objeto de Proteção de Páginas (Access)
    private $access;

    public function __construct()
    {
        parent::__construct();

        $this->view['controller'] = APPDIR . 'documentos/';

        $this->modelDefault = DocumentosModel::class;

        // Instancia o Helper que auxilia na proteção de páginas e autenticação de usuários
        $this->access = new Access();
    }

    /**
     * Action DEFAULT
     * Atenção: Todo Controller deve implementar a interface HTR\Interfaces\ControllerInterface
     */
    public function indexAction()
    {
        // Chama a Action Ver
        $this->visualizarAction();
    }

    /**
     * Action responsável por renderizar o formulário para novos registros
     */
    public function novoAction()
    {
        $this->view['userLoggedIn'] = $this->access->authenticAccess([1,2]);
        $departamento = new Departamento;
        $this->view['resultDepartamento'] = $departamento->returnAll();
     
        $classificacao = new Classificacao;
        $this->view['resultClassificacao'] = $classificacao->returnAll();
        $this->render('documentos.form_novo');
    }

    /**
     * Action responsável por renderizar o formulário para edição de registros
     */
    public function editarAction()
    {
        $this->view['userLoggedIn'] = $this->access->authenticAccess([1,2]);
        // Instanciando o Model padrão usado.
        $model = new $this->modelDefault($this->access->pdo);
        
        $departamento = new Departamento;
        $this->view['resultDepartamento'] = $departamento->returnAll();
     
        $classificacao = new Classificacao;
        $this->view['resultClassificacao'] = $classificacao->returnAll();

        $this->view['result'] = $model->findById($this->getParam('id'));
        $this->render('documentos.form_editar');
    }

    /**
     * Action responsável por eliminar os registros
     */
    public function eliminarAction()
    {
        // Instanciando o Model padrão usado.
        $model = new $this->modelDefault($this->access->pdo);
        $model->remover($this->getParam('id'));
    }

    /**
     * Action responsável por eliminar os registros
     */
    public function visualizarAction()
    {
        $this->view['userLoggedIn'] = $this->access->authenticAccess([1,2]);
        // Instanciando o Model padrão usado.
        $model = new $this->modelDefault($this->access->pdo);
        // Atribui os resultados retornados pela consulta
        // feita através do método paginator()
        $model->paginator($this->getParam('pagina'));
        $this->view['result'] = $model->getResultadoPaginator();
        $this->view['btn'] = $model->getNavePaginator();

        $this->render('documentos.index');
    }

    /**
     * Action responsável controlar a inserção de registros
     */
    public function registraAction()
    {
        $this->view['userLoggedIn'] = $this->access->authenticAccess([1,2]);
        // Instanciando o Model padrão usado.
        $model = new $this->modelDefault($this->access->pdo);
        $model->novo($this->view['userLoggedIn']);
    }

    /**
     * Action responsável controlar a edição de registros
     */
    public function alteraAction()
    {
        $this->view['userLoggedIn'] = $this->access->authenticAccess([1,2]);
        // Instanciando o Model padrão usado.
        $model = new $this->modelDefault($this->access->pdo);
        $model->editar($this->view['userLoggedIn']);
    }
}
