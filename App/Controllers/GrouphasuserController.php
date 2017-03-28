<?php
/**
 * @Controller GrouphasuserController
 * @Created at 27-03-2017 21:01:11
 * - Criado Automaticamente pelo HTR Assist
 */

namespace App\Controllers;

use HTR\System\ControllerAbstract as Controller;
use HTR\Interfaces\ControllerInterface;
use HTR\Helpers\Access\Access;
use App\Models\GrouphasuserModel;

class GrouphasuserController extends Controller implements ControllerInterface
{
    // Model padrão usado para este Controller
    private $modelDefault;

    // Atributo que guarda o Objeto de Proteção de Páginas (Access)
    private $access;

    public function __construct($auth)
    {
        parent::__construct($auth);

        $this->view['controller'] = APPDIR . 'Grouphasuser/';

        $this->modelDefault = GrouphasuserModel::class;

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
        // relação com model UsersModel
        $usersModel = new \App\Models\UsersModel($this->access->pdo);
        $this->view['resultUsers'] = $usersModel->returnAll();
        // relação com model SoftdocGrupoModel
        $softdocGrupoModel = new \App\Models\GrupoModel($this->access->pdo);
        $this->view['resultGrupo'] = $softdocGrupoModel->returnAll();

        $this->render('Grouphasuser.form_novo');
    }

    /**
     * Action responsável por renderizar o formulário para edição de registros
     */
    public function editarAction()
    {
        // Instanciando o Model padrão usado.
        $model = new $this->modelDefault($this->access->pdo);

        // relação com model UsersModel
        $usersModel = new \App\Models\UsersModel($this->access->pdo);
        $this->view['resultUsers'] = $usersModel->returnAll();
        // relação com model SoftdocGrupoModel
        $softdocGrupoModel = new \App\Models\GrupoModel($this->access->pdo);
        $this->view['resultGrupo'] = $softdocGrupoModel->returnAll();

        $this->view['result'] = $model->findById($this->getParam('id'));
        $this->render('Grouphasuser.form_editar');
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
        // Instanciando o Model padrão usado.
        $model = new $this->modelDefault($this->access->pdo);
        // Atribui os resultados retornados pela consulta
        // feita através do método paginator()
        $model->paginator($this->getParam('pagina'));
        $this->view['result'] = $model->getResultadoPaginator();
        $this->view['btn'] = $model->getNavePaginator();

        $this->render('Grouphasuser.index');
    }

    /**
     * Action responsável controlar a inserção de registros
     */
    public function registraAction()
    {
        // Instanciando o Model padrão usado.
        $model = new $this->modelDefault($this->access->pdo);
        $model->novo();
    }

    /**
     * Action responsável controlar a edição de registros
     */
    public function alteraAction()
    {
        // Instanciando o Model padrão usado.
        $model = new $this->modelDefault($this->access->pdo);
        $model->editar();
    }
}
