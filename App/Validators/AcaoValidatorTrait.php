<?php
/**
 * @validator AcaoValidatorTrait
 * @created at 27-03-2017 21:03:31
 * - Criado Automaticamente pelo HTR Assist
 */

namespace App\Validators;

use HTR\Helpers\Mensagem\Mensagem as msg;
use Respect\Validation\Validator as v;

trait AcaoValidatorTrait
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

    protected function validateNomeAcao()
    {
        $value = v::stringType()->length(null, 45)->validate($this->getNomeAcao());
        if (!$value) {
            msg::showMsg('O campo Nome deve ser preenchido corretamente.'
                . '<script>focusOn("nome_acao");</script>', 'danger');
            return $this;
        }
    }

}
