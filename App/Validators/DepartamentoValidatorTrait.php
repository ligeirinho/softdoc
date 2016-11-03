<?php
/**
 * @validator DepartamentoValidatorTrait
 * @created at 03-11-2016 12:52:11
 * - Criado Automaticamente pelo HTR Assist
 */

namespace App\Validators;

use HTR\Helpers\Mensagem\Mensagem as msg;
use Respect\Validation\Validator as v;

trait DepartamentoValidatorTrait
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

    protected function validateNomeDepartamento()
    {
        $value = v::stringType()->notEmpty()->length(1, 200)->validate($this->getNomeDepartamento());
        if (!$value) {
            msg::showMsg('O campo Departamento deve ser preenchido corretamente.'
                . '<script>focusOn("nome_departamento");</script>', 'danger');
            return $this;
        }
    }

}
