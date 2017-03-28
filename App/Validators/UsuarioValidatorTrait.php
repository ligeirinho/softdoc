<?php
/**
 * @validator UsuarioValidatorTrait
 * @created at 16-03-2017 14:08:50
 * - Criado Automaticamente pelo HTR Assist
 */

namespace App\Validators;

use HTR\Helpers\Mensagem\Mensagem as msg;
use Respect\Validation\Validator as v;

trait UsuarioValidatorTrait
{
    use \HTR\System\CommonTrait;

    protected function validateId()
    {
        $value = v::intVal()->notEmpty()->length(1, 11)->validate($this->getId());
        if (!$value) {
            msg::showMsg('O campo id deve ser preenchido corretamente.'
                . '<script>focusOn("id");</script>', 'danger');
            return $this;
        }
    }

    protected function validateNome()
    {
        $value = v::stringType()->notEmpty()->length(1, 45)->validate($this->getNome());
        if (!$value) {
            msg::showMsg('O campo Nome do Usuário deve ser preenchido corretamente.'
                . '<script>focusOn("nome");</script>', 'danger');
            return $this;
        }
    }

    protected function validateEmail()
    {
        $value = v::stringType()->length(null, 100)->validate($this->getEmail());
        if (!$value) {
            msg::showMsg('O campo E-mail deve ser preenchido corretamente.'
                . '<script>focusOn("email");</script>', 'danger');
            return $this;
        }
    }

    protected function validateDepartamento()
    {
        $value = v::intVal()->length(null, 3)->validate($this->getDepartamento());
        if (!$value) {
            msg::showMsg('O campo Departamento deve ser preenchido corretamente.'
                . '<script>focusOn("departamento");</script>', 'danger');
            return $this;
        }
    }

    protected function validateRamal()
    {
        $value = v::stringType()->length(null, 15)->validate($this->getRamal());
        if (!$value) {
            msg::showMsg('O campo Ramal deve ser preenchido corretamente.'
                . '<script>focusOn("ramal");</script>', 'danger');
            return $this;
        }
    }

    protected function validateMatricula()
    {
        $value = v::intVal()->length(null, 10)->validate($this->getMatricula());
        if (!$value) {
            msg::showMsg('O campo Matrícula deve ser preenchido corretamente.'
                . '<script>focusOn("matricula");</script>', 'danger');
            return $this;
        }
    }

    protected function validateTelefone()
    {
        $value = v::phone()->length(null, 15)->validate($this->getTelefone());
        if (!$value) {
            msg::showMsg('O campo Telefone deve ser preenchido corretamente.'
                . '<script>focusOn("telefone");</script>', 'danger');
            return $this;
        }
    }

    protected function validateCelular()
    {
        $value = v::phone()->length(null, 15)->validate($this->getCelular());
        if (!$value) {
            msg::showMsg('O campo Celular deve ser preenchido corretamente.'
                . '<script>focusOn("celular");</script>', 'danger');
            return $this;
        }
    }

    protected function validateCriado()
    {
        $value = v::intVal()->length(null, 15)->validate($this->getCriado());
        if (!$value) {
            msg::showMsg('O campo Criado deve ser preenchido corretamente.'
                . '<script>focusOn("criado");</script>', 'danger');
            return $this;
        }
    }

    protected function validateAtivo()
    {
        $value = v::intVal()->length(null, 1)->validate($this->getAtivo());
        if (!$value) {
            msg::showMsg('O campo Ativo deve ser preenchido corretamente.'
                . '<script>focusOn("ativo");</script>', 'danger');
            return $this;
        }
    }

}
