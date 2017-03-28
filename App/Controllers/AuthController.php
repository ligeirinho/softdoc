<?php

/*
 * @Controller Acesso
 */
namespace App\Controllers;

use HTR\System\ControllerAbstract as Controller;
use HTR\Interfaces\ControllerInterface as CtrlInterface;
use HTR\Helpers\Access\Access;
use App\Models\AuthModel;

class AuthController extends Controller implements CtrlInterface
{
    // Model padrão usado para este Controller
    private $modelDefault = AuthModel::class;
    private $access;

    /*
     * Inicia os atributos usados na View
     */
    public function __construct($auth)
    {
        parent::__construct($auth);
        $this->view['controller'] = APPDIR . 'auth/';
        // Instancia o Helper que auxilia na proteção e autenticação de usuários
        $this->access = new Access();
        $this->view['userLoggedIn'] = $this->auth->responseArray()['data_user'];
    }


    /*
     * Action DEFAULT
     * Atenção: Todo Controller deve conter um método 'indexAction'
     */
    public function indexAction()
    {
        $this->visualizarAction();
    }
    
    public function novoAction()
    {
        // Renderiza a página
        $this->render('Auth.form_novo');
        
    }
    
    public function editarAction()
    {
        // Instanciando o Model padrão usado.
        $model = new $this->modelDefault($this->access->pdo);
        
        // Executa a consulta no Banco de Dados
        // Se o usuário logado tiver um nível diferente de administrador
        // então, retorna o id do usuário logado, senão retorna o id setado na url
        $id = $this->view['userLoggedIn']['level'] > 1 ? $this->view['userLoggedIn']['id'] : $this->getParam('id');
        $this->view['result'] = $model->findById($id);
                
        $this->render('Auth.form_editar');
    }
    
    public function eliminarAction()
    {
        $this->access->authenticAccess([1]);

        $model = new $this->modelDefault($this->access->pdo);

        $model->remover($this->getParam('id'));
    }

    public function visualizarAction()
    {
        // Instanciando o Model padrão usado.
        $model = new $this->modelDefault($this->access->pdo);

        $model->paginator($this->getParam('pagina'));
        $this->view['result'] = $model->getResultadoPaginator();
        $this->view['btn'] = $model->getNavePaginator();

        $this->render('Auth.index');
    }
    
    public function registraAction()
    {
        // Instanciando o Model padrão usado.
        $model = new $this->modelDefault($this->access->pdo);
        $model->novo();
    }
    
    public function alteraAction()
    {
        // Instanciando o Model padrão usado.
        $model = new $this->modelDefault($this->access->pdo);
        $model->editar();
    }
    
    public function loginAction()
    {
        // evita que o usuário acesse a página de login novamente após a autenticação
        $this->access->notAuthenticatedAccess();

        $this->render('Auth.form_login');
    }
    
    public function logoutAction()
    {
        // Instanciando o Model padrão usado.
        //$model = new $this->modelDefault($this->access->pdo);  
        //$model->logout();
		$this->auth->logout();
        header('Location:'. APPDIR);
    }

    public function autenticaAction()
    {
        // Instanciando o Model padrão usado.
        $model = new $this->modelDefault($this->access->pdo);
        $model->login();
    }

    public function mudarSenhaAction()
    {
        $this->access->breakRedirect();

        $this->render('Auth.form_mudar_senha');
    }

    public function mudandoSenhaAction()
    {
        $model = new $this->modelDefault($this->access->pdo);
        $this->access->breakRedirect();
        $dados['id'] = $user['id'];
        $dados['password'] = filter_input(INPUT_POST, 'password');
        // Instanciando o Model padrão usado.
        $model->mudarSenha($dados);
    }
}
