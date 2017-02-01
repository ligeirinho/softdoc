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

    public function verificar()
    {
        if (!in_array($this->ruleUri(), $this->uriException)) {
            parent::verificar();
        } else {
            $this->accessUriException = true;
        }
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
}
