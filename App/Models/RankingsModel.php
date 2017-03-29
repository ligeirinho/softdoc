<?php
/**
 * @model RankingsModel
 * @created at 23-10-2016 18:56:45
 * - Criado Automaticamente pelo HTR Assist
 */

namespace App\Models;

use HTR\System\ModelCRUD;
use App\Models\DocumentosModel;

class RankingsModel extends ModelCRUD
{

    /**
     * Entidade padrão do Model
     */
    protected $entidade = 'softdoc_rankings';

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
    
    public function returnAllRankingByClassificacao($classificacaoId)
    {
        $arrRanking = [];
        $queryString = 'SELECT doc.id, COUNT(ran.id) AS ranking FROM `softdoc_documentos` AS doc
            INNER JOIN softdoc_rankings AS ran ON ran.documento_id = doc.id
            WHERE doc.grupo_id = ?
            GROUP BY doc.id';
        $stmt = $this->pdo->prepare($queryString);
        $stmt->execute([$classificacaoId]);
        $rankings = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        foreach ($rankings as $ranking) {
            $arrRanking[$ranking['id']] = $ranking['ranking'];
        }
        
        return $arrRanking;
    }
}
