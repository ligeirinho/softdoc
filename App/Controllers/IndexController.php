<?php

/*
 * @Controller Index
 */
namespace App\Controllers;

use HTR\System\ControllerAbstract as Controller;
use HTR\Interfaces\ControllerInterface as CtrlInterface;
use App\Models\ClassificacaoModel as Classificacao;
use HTR\Helpers\Access\Access;
use App\Models\RankingsModel;
use App\Models\DocumentosModel as Documentos;

class IndexController extends Controller implements CtrlInterface
{
    private $access;

    /*
     * Inicia os atributos usados na View
     */
    public function __construct($auth)
    {
        $this->view['controller'] =  APPDIR . 'index/';
        parent::__construct($auth);
        // Instancia o Helper que auxilia na proteção de páginas e autenticação de usuários
        $this->access = new Access();
        $this->view['userLoggedIn'] = $this->auth->responseArray()['data_user'];
    }

    /*
     * Action DEFAULT
     * Atenção: Todo Controller deve conter uma Action 'indexAction'
     */
    public function indexAction()
    {
        // Renderiza a view index com o layout blank
        //$this->render('Index.index');
        $this->dashboardAction();
    }
    
    public function dashboardAction()
    {
        $classificacao = new Classificacao($this->access->pdo);
        $this->view['resultClassificacao'] = $classificacao->returnClassificacao($this->view['userLoggedIn']);
        //Renderiza a view dashboard
        $this->render('Index.dashboard');
    }
    
    public function lerAction()
    {
        $rankingModel = new RankingsModel($this->access->pdo);
        if (!$rankingModel->novo($this->getParam('id'))) {

            $this->render('Index.publicacao_nao_existe');
        }
    }
    
    public function filtroCategoriaAction(){        
        $documentos = new Documentos($this->access->pdo);
        $ranking = new RankingsModel($this->access->pdo);
        
        $find = $this->getParam('id');

        $documentos->filterByCategoria($this->getParam('pagina'), $find);
        $this->view['result'] = $documentos->getResultadoPaginator();
        $this->view['btn'] = $documentos->getNavePaginator();
        
        $this->view['rankingTotal'] = $ranking->findAll();
        $this->view['ranking'] = $ranking->returnAllRankingByClassificacao($find);
        
        $this->render('Index.filtro_categoria');
    }

    public function accessDenied($uri)
    {
        $this->view['uri'] = $uri;
        $this->render('Index.acesso_negado');
    }
    
    public function acessoNegadoAction()
    {
		$this->view['uri'] = $this->auth->ruleUri();
		dump($this->auth->usersExtractor()->responseArray());
        $this->render('Index.acesso_negado');
    }
}
