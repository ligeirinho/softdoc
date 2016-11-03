<?php
/**
 * @validator ClassificacaoValidatorTrait
 * @created at 03-11-2016 12:51:00
 * - Criado Automaticamente pelo HTR Assist
 */

namespace App\Validators;

use HTR\Helpers\Mensagem\Mensagem as msg;
use Respect\Validation\Validator as v;

trait ClassificacaoValidatorTrait
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

    protected function validateNomeClassificacao()
    {
        $value = v::stringType()->notEmpty()->length(1, 40)->validate($this->getNomeClassificacao());
        if (!$value) {
            msg::showMsg('O campo Classificação deve ser preenchido corretamente.'
                . '<script>focusOn("nome_classificacao");</script>', 'danger');
            return $this;
        }
    }

    protected function validateDepartamento()
    {
        $value = v::intVal()->notEmpty()->length(1, 5)->validate($this->getDepartamento());
        if (!$value) {
            msg::showMsg('O campo Departamento deve ser preenchido corretamente.'
                . '<script>focusOn("departamento");</script>', 'danger');
            return $this;
        }
    }

    protected function validateCriado()
    {
        $value = v::intVal()->notEmpty()->length(1, 15)->validate($this->getCriado());
        if (!$value) {
            msg::showMsg('O campo Criado deve ser preenchido corretamente.'
                . '<script>focusOn("criado");</script>', 'danger');
            return $this;
        }
    }

    protected function validateAlterado()
    {
        $value = v::intVal()->length(null, 15)->validate($this->getAlterado());
        if (!$value) {
            msg::showMsg('O campo Alterado deve ser preenchido corretamente.'
                . '<script>focusOn("alterado");</script>', 'danger');
            return $this;
        }
    }

    protected function validateUsuarioId()
    {
        $value = v::intVal()->notEmpty()->length(1, 5)->validate($this->getUsuarioId());
        if (!$value) {
            msg::showMsg('O campo Usuário deve ser preenchido corretamente.'
                . '<script>focusOn("usuario_id");</script>', 'danger');
            return $this;
        }
    }

}
