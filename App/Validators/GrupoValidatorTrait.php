<?php
/**
 * @validator GrupoValidatorTrait
 * @created at 27-03-2017 21:04:36
 * - Criado Automaticamente pelo HTR Assist
 */

namespace App\Validators;

use HTR\Helpers\Mensagem\Mensagem as msg;
use Respect\Validation\Validator as v;

trait GrupoValidatorTrait
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

    protected function validateNomeGrupo()
    {
        $value = v::stringType()->notEmpty()->length(1, 90)->validate($this->getNomeGrupo());
        if (!$value) {
            msg::showMsg('O campo Classificação deve ser preenchido corretamente.'
                . '<script>focusOn("nome_grupo");</script>', 'danger');
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

}
