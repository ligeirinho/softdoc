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

    protected function validateUserId()
    {
        $value = v::intVal()->notEmpty()->length(1, 5)->validate($this->getUserId());
        if (!$value) {
            msg::showMsg('O campo Usuário deve ser preenchido corretamente.'
                . '<script>focusOn("user_id");</script>', 'danger');
            return $this;
        }
    }

    protected function validateLogId()
    {
        $value = v::intVal()->notEmpty()->length(1, 5)->validate($this->getLogId());
        if (!$value) {
            msg::showMsg('O campo Log deve ser preenchido corretamente.'
                . '<script>focusOn("log_id");</script>', 'danger');
            return $this;
        }
    }

    protected function validateExtensao()
    {
        $value = v::stringType()->length(null, 10)->validate($this->getExtensao());
        if (!$value) {
            msg::showMsg('O campo Extensão deve ser preenchido corretamente.'
                . '<script>focusOn("extensao");</script>', 'danger');
            return $this;
        }
    }

    protected function validateRevisao()
    {
        $value = v::intVal()->length(null, 11)->validate($this->getRevisao());
        if (!$value) {
            msg::showMsg('O campo Revisão deve ser preenchido corretamente.'
                . '<script>focusOn("revisao");</script>', 'danger');
            return $this;
        }
    }

    protected function validateTamanho()
    {
        $value = v::stringType()->length(null, 20)->validate($this->getTamanho());
        if (!$value) {
            msg::showMsg('O campo Tamanho deve ser preenchido corretamente.'
                . '<script>focusOn("tamanho");</script>', 'danger');
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

    protected function validateClassificacaoId()
    {
        $value = v::intVal()->notEmpty()->length(1, 5)->validate($this->getClassificacaoId());
        if (!$value) {
            msg::showMsg('O campo Classificação deve ser preenchido corretamente.'
                . '<script>focusOn("classificacao_id");</script>', 'danger');
            return $this;
        }
    }

}
