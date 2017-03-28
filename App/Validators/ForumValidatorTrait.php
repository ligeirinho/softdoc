<?php
/**
 * @validator ForumValidatorTrait
 * @created at 27-03-2017 21:02:24
 * - Criado Automaticamente pelo HTR Assist
 */

namespace App\Validators;

use HTR\Helpers\Mensagem\Mensagem as msg;
use Respect\Validation\Validator as v;

trait ForumValidatorTrait
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

    protected function validateDocumentosId()
    {
        $value = v::intVal()->notEmpty()->length(1, 11)->validate($this->getDocumentosId());
        if (!$value) {
            msg::showMsg('O campo Documento deve ser preenchido corretamente.'
                . '<script>focusOn("documentos_id");</script>', 'danger');
            return $this;
        }
    }

    protected function validateUserId()
    {
        $value = v::intVal()->notEmpty()->length(1, 5)->validate($this->getUserId());
        if (!$value) {
            msg::showMsg('O campo user_id deve ser preenchido corretamente.'
                . '<script>focusOn("user_id");</script>', 'danger');
            return $this;
        }
    }

    protected function validateTexto()
    {
        $value = v::stringType()->length(1, 65535)->validate($this->getTexto());
        if (!$value) {
            msg::showMsg('O campo Texto deve ser preenchido corretamente.'
                . '<script>focusOn("texto");</script>', 'danger');
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

}
