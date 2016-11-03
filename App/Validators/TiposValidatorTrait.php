<?php
/**
 * @validator TiposValidatorTrait
 * @created at 03-11-2016 12:53:20
 * - Criado Automaticamente pelo HTR Assist
 */

namespace App\Validators;

use HTR\Helpers\Mensagem\Mensagem as msg;
use Respect\Validation\Validator as v;

trait TiposValidatorTrait
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

    protected function validateNomeTipo()
    {
        $value = v::stringType()->notEmpty()->length(1, 30)->validate($this->getNomeTipo());
        if (!$value) {
            msg::showMsg('O campo Tipo deve ser preenchido corretamente.'
                . '<script>focusOn("nome_tipo");</script>', 'danger');
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

    protected function validateAtualizado()
    {
        $value = v::intVal()->length(null, 15)->validate($this->getAtualizado());
        if (!$value) {
            msg::showMsg('O campo Atualizado deve ser preenchido corretamente.'
                . '<script>focusOn("atualizado");</script>', 'danger');
            return $this;
        }
    }

}
