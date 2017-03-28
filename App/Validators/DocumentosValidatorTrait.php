<?php
/**
 * @validator DocumentosValidatorTrait
 * @created at 03-11-2016 12:49:35
 * - Criado Automaticamente pelo HTR Assist
 */

namespace App\Validators;

use HTR\Helpers\Mensagem\Mensagem as msg;
use Respect\Validation\Validator as v;

trait DocumentosValidatorTrait
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

    protected function validateTitulo()
    {
        $value = v::stringType()->notEmpty()->length(1, 70)->validate($this->getTitulo());
        if (!$value) {
            msg::showMsg('O campo Título deve ser preenchido corretamente.'
                . '<script>focusOn("titulo");</script>', 'danger');
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

    protected function validateGrupoId()
    {
        $value = v::intVal()->notEmpty()->length(1, 5)->validate($this->getGrupo());
        if (!$value) {
            msg::showMsg('O campo Grupo deve ser preenchido corretamente.'
                . '<script>focusOn("grupo");</script>', 'danger');
            return $this;
        }
    }

}
