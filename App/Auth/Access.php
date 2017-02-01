<?php

namespace App\Auth;

class Access extends Autenticacao
{
    // URI que não queremos realizar a verificação
    private $uriException = [
        '/softdoc/index/ler/',
		'/softdoc/auth/logout/'
    ];
    private $accessUriException = false;

    public function verificarUri()
    {
        if (!in_array($this->ruleUri(), $this->uriException)) {
            parent::verificarUri();
        } else {
            $this->accessUriException = true;
        }
        
        return $this;
    }
    
    public function verificarAction($actionCode)
    {
        return parent::verificarAction($actionCode);
    }

    public function responseObject()
    {
        if ($this->accessUriException) {
            $stdClass = new \stdClass();
            $stdClass->access = true;
            return $stdClass;
        }

        return parent::responseObject();
    }
    
    // alias
    public function action($actionCode)
    {
        return $this->verificarAction($actionCode)->responseObject()->access;
    }
}
