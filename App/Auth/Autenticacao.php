<?php

namespace App\Auth;
/**
 * Biblioteca de Interface para autenticação no serviço de permissão de acesso
 * @author Edson Bruno <bruno.monteirodg@gmail.com>
 * @version 0.0.6
 */
class Autenticacao
{

    // Path para o arquivo de Cookie usado pelo cURL
    private $pathCookieRepository = "C:/wamp/www/softdoc_core/App/Auth/cookie.hcf";
    // Armazena a resposta do servidor
    private $response;

    // URL que aponta para o servidor de serviço
    const URL_SERVICE = 'http://10.88.3.7:88/access/';
    // Rota para a verificação de URI
    const ROUTE_TO_VERIFY_URI = '/auth/verify/';
    // Rota para a verificação de Ações
    const ROUTE_TO_VERIFY_ACTION = '/auth/verifyaction/';
    // Rota para a extração de usuários
    const ROUTE_TO_USERS_EXTRACTOR = '/auth/usersextractor/';
    // Rota para a sincronização de sessão
    const ROUTE_TO_SYNC_SESSION = '/auth/sincsession/';
    // Rota para a página de login do sistema
    const URL_TO_LOGIN = 'http://10.88.3.7:88/access/auth/login/';
    // ROTA PADRÃO para aplicação cliente
    const ROUTE_APP = '/softdoc/';
    // DOMÍNIO PADRÃO
    const DOMAIN = '10.88.3.7';
    // token da applicação
    const TOKEN_APP = 'f6e7c52ccdef098be8fd7ec29eb7a4c659c3a674';

    function setPathCookieRepository($pathCookieRepository)
    {
        $this->pathCookieRepository = $pathCookieRepository;
        return $this;
    }

    /**
     * Envia a requisição para verificação de acesso
     * 
     * @param array $dataRequest Array de dados a serem enviados para o servidor de verificação
     * @param string $routeToService Rota de consumo do serviço
     * @return \Autenticacao
     */
    private function sendRequest(array $dataRequest, $routeToService)
    {
        $curl = curl_init(self::URL_SERVICE . $routeToService);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($curl, CURLOPT_COOKIEFILE, $this->pathCookieRepository);
        curl_setopt($curl, CURLOPT_COOKIEJAR, $this->pathCookieRepository);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $dataRequest);

        $curlResponse = curl_exec($curl);

        curl_close($curl);

        $this->response = $curlResponse;
        return $this;
    }

    /**
     * Regra de extração da URI
     * @return string URI a ser consultada
     */
    public function ruleUri()
    {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        
        if(count($uri) > 4){
            $uri = '/'.$uri[1].'/'.$uri[2].'/'.$uri[3].'/';
            return $uri;
        }
        
        $uri = $_SERVER['REQUEST_URI'];
        
        return $uri;
    }

    private function sessionStart()
    {
        if (!isset($_SESSION)) {
            session_set_cookie_params(
                1800, // Tempo de vida da sessão. Padrão 30min
                self::ROUTE_APP, //APPDIR, // Path da Sessão
                self::DOMAIN, // Nome no Domínio
                false, // SSL
                true // HTTP Only
            );
            session_start();
        }
    }

    public function verificarUri()
    {
        $this->sessionStart();

        $userId = isset($_SESSION['_uid']) ? $_SESSION['_uid'] : null;
        $sessionId = isset($_SESSION['_sid']) ? $_SESSION['_sid'] : null;
        $token = isset($_SESSION['_token']) ? $_SESSION['_token'] : null;

        $dataRequest = [
            "user_id" => $userId,
            "application_token" => self::TOKEN_APP,
            "uri" => $this->ruleUri(),
            "sid" => $sessionId,
            "token" => $token
        ];


        if (!$this->sendRequest($dataRequest, self::ROUTE_TO_VERIFY_URI)->responseObject()->session_id) {
            header("location:" . self::URL_TO_LOGIN);
            return;
        }

        $_SESSION['_sid'] = $this->responseObject()->session_id;

        return $this;
    }

    public function verificarAction($actionCode)
    {
        $this->sessionStart();

        $userId = isset($_SESSION['_uid']) ? $_SESSION['_uid'] : null;
        $sessionId = isset($_SESSION['_sid']) ? $_SESSION['_sid'] : null;
        $token = isset($_SESSION['_token']) ? $_SESSION['_token'] : null;

        $dataRequest = [
            "user_id" => $userId,
            "application_token" => self::TOKEN_APP,
            "code" => $actionCode,
            "sid" => $sessionId,
            "token" => $token
        ];

        if ($this->sendRequest($dataRequest, self::ROUTE_TO_VERIFY_ACTION)->responseObject()->session_id) {
            $_SESSION['_sid'] = $this->responseObject()->session_id;
        }

        return $this;
    }

    final public function usersExtractor()
    {
        $this->sessionStart();

        $sessionId = isset($_SESSION['_sid']) ? $_SESSION['_sid'] : null;
        $token = isset($_SESSION['_token']) ? $_SESSION['_token'] : null;

        $dataRequest = [
            "application_token" => self::TOKEN_APP,
            "sid" => $sessionId,
            "token" => $token
        ];

        if ($this->sendRequest($dataRequest, self::ROUTE_TO_USERS_EXTRACTOR)->responseObject()->session_id) {
            $_SESSION['_sid'] = $this->responseObject()->session_id;
        }

        return $this;
    }

    final public function sincSessionId()
    {
        $this->sessionStart();

        $token = base64_decode(filter_input(INPUT_GET, 'token'));
        $sp = substr($token, -4);
        $values = explode($sp, $token);

        $_SESSION['_token'] = $values[0];
        $_SESSION['_sid'] = $values[1];
        $_SESSION['_aid'] = $values[2];
        $_SESSION['_uid'] = $values[3];
    }

    public function responseJson()
    {
        return $this->response;
    }

    public function responseObject()
    {
        return json_decode($this->response) ? : new \stdClass();
    }

    public function responseArray()
    {
        return json_decode($this->response, true) ? : [];
    }

    public function logout()
    {
        $this->sessionStart();
        session_destroy();
    }
}
