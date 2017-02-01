<?php

namespace App\Auth;

/**
 * Biblioteca de Interface para autenticação no serviço de permissão de acesso
 * @author Edson Bruno <bruno.monteirodg@gmail.com>
 * @version 0.0.3
 */
class Autenticacao
{

    // URL que aponta para o servidor de serviço
    private $urlService = 'http://10.88.3.76/access/public_html/auth/verify/';
    // Path para o arquivo de Cookie usado pelo cURL
    private $pathCookieRepository = "C:\wamp\www\softdoc\ccookie.hcf";
    // Rota para a página de login do sistema
    private $routeLogin = 'http://10.88.3.76/access/public_html/auth/login/';
    private $sessionId;
    private $token;
    private $userId = 0;
    private $applicationId = 0;
    private $response;

    const ROUTE_APP = '/softdoc/';

    function setPathCookieRepository($pathCookieRepository)
    {
        $this->pathCookieRepository = $pathCookieRepository;
        return $this;
    }

    function setRouteLogin($routeLogin)
    {
        $this->routeLogin = $routeLogin;
        return $this;
    }

    function setUrlService($urlService)
    {
        $this->urlService = $urlService;
        return $this;
    }

    /**
     * Envia a requisição para verificação de acesso
     * @param string $uri URI que o usuário está acessando
     */
    private function sendRequest()
    {
        $curl = curl_init($this->urlService);

        $curlPostData = [
            "user_id" => $this->userId,
            "application_id" => $this->applicationId,
            "uri" => $this->ruleUri(),
            "sid" => $this->sessionId,
            "token" => $this->token
        ];

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($curl, CURLOPT_COOKIEFILE, $this->pathCookieRepository);
        curl_setopt($curl, CURLOPT_COOKIEJAR, $this->pathCookieRepository);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPostData);

        $curlResponse = curl_exec($curl);

        curl_close($curl);

        $this->response = $curlResponse;
    }

    /**
     * 
     * @return string URI
     */
    public function ruleUri()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = explode('/', $uri);

        $returnUri = '/' . $uri[1] . '/';
        $returnUri .= $uri[2] != '' ? $uri[2] . '/' : null;

        if (isset($uri[3])) {
            if ($uri[3] != '') {
                $returnUri .= $uri[3] . '/';
            }
        }

        return $returnUri;
    }

    private function sessionStart()
    {
        if (!isset($_SESSION)) {
            session_set_cookie_params(
                1800, // Tempo de vida da sessão. Padrão 30min
                self::ROUTE_APP, //APPDIR, // Path da Sessão
                $_SERVER['HTTP_HOST'], // Nome no Domínio
                false, // SSL
                true // HTTP Only
            );
            session_start();
        }
    }

    public function verificar()
    {
        $uri = $this->ruleUri();

        $this->sessionStart();

        $this->applicationId = isset($_SESSION['_aid']) ? $_SESSION['_aid'] : null;
        $this->userId = isset($_SESSION['_uid']) ? $_SESSION['_uid'] : null;
        $this->sessionId = isset($_SESSION['_sid']) ? $_SESSION['_sid'] : null;
        $this->token = isset($_SESSION['_token']) ? $_SESSION['_token'] : null;

        $this->sendRequest($uri);

        if (!$this->responseObject()->session_id) {
            header("location:" . $this->routeLogin);
            return;
        }

        $_SESSION['_sid'] = $this->responseObject()->session_id;
    }

    final public function sincSessionId()
    {
        $token = base64_decode(filter_input(INPUT_GET, 'token'));
        $sp = substr($token, -4);
        $values = explode($sp, $token);

        $this->sessionStart();

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
        $this->verificar();
    }
}
