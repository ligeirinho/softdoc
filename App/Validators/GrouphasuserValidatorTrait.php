<?php
/**
 * @validator GrouphasuserValidatorTrait
 * @created at 27-03-2017 21:01:11
 * - Criado Automaticamente pelo HTR Assist
 */

namespace App\Validators;

use HTR\Helpers\Mensagem\Mensagem as msg;
use Respect\Validation\Validator as v;

trait GrouphasuserValidatorTrait
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

    protected function validateGrupoId()
    {
        $value = v::intVal()->notEmpty()->length(1, 5)->validate($this->getGrupoId());
        if (!$value) {
            msg::showMsg('O campo grupo_id deve ser preenchido corretamente.'
                . '<script>focusOn("grupo_id");</script>', 'danger');
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

}
