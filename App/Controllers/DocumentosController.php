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
use App\Models\GrupoModel as Grupo;

class DocumentosController extends Controller implements ControllerInterface
{
    // Model padrão usado para este Controller
    private $modelDefault;

    // Atributo que guarda o Objeto de Proteção de Páginas (Access)
    private $access;

    public function __construct($auth)
    {
        parent::__construct($auth);
        
        $this->view['controller'] = APPDIR . 'documentos/';
        
        $this->modelDefault = DocumentosModel::class;
        // Instancia o Helper que auxilia na proteção de páginas e autenticação de usuários
        $this->access = new Access();
        $this->view['userLoggedIn'] = $this->auth->responseArray()['data_user'];
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
        $grupo = new Grupo($this->access->pdo);
        
        $this->view['resultGrupos'] = $grupo->returnAllGroupByUser($this->view['userLoggedIn']);
        $this->render('documentos.form_novo');
    }

    /**
     * Action responsável por renderizar o formulário para edição de registros
     */
    public function editarAction()
    {
        // Instanciando o Model padrão usado.
        $model = new $this->modelDefault($this->access->pdo);
        $grupo = new Grupo($this->access->pdo);
        
        $this->view['resultGrupos'] = $grupo->returnAllGroupByUser($this->view['userLoggedIn']);
        
        $this->view['result'] = $model->findById($this->getParam('id'));
        
        $this->render('documentos.form_editar');
    }

    /**
     * Action responsável por eliminar os registros
     */
    public function eliminarAction()
    {
        //Instanciando o Model padrão usado.
        $model = new $this->modelDefault($this->access->pdo);
        $model->remover($this->getParam('id'));
    }
    
    /**
     * Action responsável por eliminar os registros
     */
    public function visualizarAction()
    {
        // Instanciando o Model padrão usado.
        $model = new $this->modelDefault($this->access->pdo);
        // Atribui os resultados retornados pela consulta
        // feita através do método paginator()
        $model->paginator($this->getParam('pagina'), $this->view['userLoggedIn']['departamento']);
        $this->view['result'] = $model->getResultadoPaginator();
        $this->view['btn'] = $model->getNavePaginator();

        $this->render('documentos.index');
    }

    /**
     * Action responsável controlar a inserção de registros
     */
    public function registraAction()
    {
        // Instanciando o Model padrão usado.
        $model = new $this->modelDefault($this->access->pdo);
        $model->novo($this->view['userLoggedIn']);
    }
    
    public function enviarEmailAction()
    {
        $model = new $this->modelDefault($this->access->pdo);
        $model->enviarEmail();
    }

    /**
     * Action responsável controlar a edição de registros
     */
    public function alteraAction()
    {
        // Instanciando o Model padrão usado.
        $model = new $this->modelDefault($this->access->pdo);
        $model->editar($this->view['userLoggedIn']);
    }
}
