<?php
/**
 * @validator LogdocumentosValidatorTrait
 * @created at 27-03-2017 21:02:00
 * - Criado Automaticamente pelo HTR Assist
 */

namespace App\Validators;

use HTR\Helpers\Mensagem\Mensagem as msg;
use Respect\Validation\Validator as v;

trait LogdocumentosValidatorTrait
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

    protected function validateDocumentoId()
    {
        $value = v::intVal()->notEmpty()->length(1, 11)->validate($this->getDocumentoId());
        if (!$value) {
            msg::showMsg('O campo Documento deve ser preenchido corretamente.'
                . '<script>focusOn("documento_id");</script>', 'danger');
            return $this;
        }
    }

    protected function validateAcaoId()
    {
        $value = v::intVal()->notEmpty()->length(1, 11)->validate($this->getAcaoId());
        if (!$value) {
            msg::showMsg('O campo acao_id deve ser preenchido corretamente.'
                . '<script>focusOn("acao_id");</script>', 'danger');
            return $this;
        }
    }

    protected function validateUserId()
    {
        $value = v::intVal()->notEmpty()->length(1, 11)->validate($this->getUserId());
        if (!$value) {
            msg::showMsg('O campo user_id deve ser preenchido corretamente.'
                . '<script>focusOn("user_id");</script>', 'danger');
            return $this;
        }
    }

    protected function validateCriado()
    {
        $value = v::intVal()->notEmpty()->length(1, 15)->validate($this->getCriado());
        if (!$value) {
            msg::showMsg('O campo criado deve ser preenchido corretamente.'
                . '<script>focusOn("criado");</script>', 'danger');
            return $this;
        }
    }

}
