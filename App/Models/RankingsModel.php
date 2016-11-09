<?php
/**
 * @model RankingsModel
 * @created at 23-10-2016 18:56:45
 * - Criado Automaticamente pelo HTR Assist
 */

namespace App\Models;

use HTR\System\ModelCRUD;
use HTR\Helpers\Mensagem\Mensagem as msg;
use App\Models\DocumentosModel;

class RankingsModel extends ModelCRUD
{

    /**
     * Entidade padrão do Model
     */
    protected $entidade = 'rankings';

    /**
     * @param \PDO $pdo Recebe uma instância do PDO
     */
    public function __construct(\PDO $pdo = null)
    {
        parent::__construct($pdo);
    }

    /**
     * Método responsável por salvar os registros
     */
    public function novo($documentoId)
    {

        $documentosModel = new DocumentosModel($this->pdo);
        // consulta pelo ID da publicação
        $documento = $documentosModel->findById($documentoId);
        // verifica se publicação é válida
        // caso false retorna false
        if (!isset($documento['id'])) {
            return false;
        }

        $dados = [
            'documento_id' => $documentoId,
            'timestamp' => time(),
        ];

        // insere um novo registro no ranking
        $this->insert($dados);

        return $documentosModel->loadPublicacao($documento);
    }
}
