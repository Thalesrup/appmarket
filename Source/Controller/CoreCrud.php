<?php

namespace Source\Controller;

class CoreCrud{

    protected $pdo;
    private   $msgErrorDelete = ['error' => true, 'message' => 'Erro ao Tentar Remover Registro'];

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * Altera uma tabela camelCase ou nome de campo para minúsculas,
     * nome com espaçamento de sublinhado
     *
     * @param  string $string camelCase string
     * @return string sublinhado string
     */
    protected function camelCaseToUnderscore($string)
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $string));
    }

    /**
     * Retorna o ID da última linha inserida ou valor de sequência
     *
     * @param $param String Nome do objeto de sequência do qual o ID deve ser retornado.
     * @return string representando o ID da linha da última linha que foi inserida no banco de dados.
     */
    public function lastInsertId($param = null)
    {
        return $this->pdo->lastInsertId($param);
    }

    /**
     * Abstração para os métodos CRUD de forma dinâmica
     *
     * Formato para nomes de métodos dinâmicos
     * Criar: insertTableName ($arrData)
     * Recuperar: getTableNameByFieldName ($value)
     * Atualizar: updateTableNameByFieldName ($value, $arrUpdate)
     * Excluir: deleteTableNameByFieldName ($value)
     *
     * @param  string     $function
     * @param  array      $arrParams
     * @return array|bool
     */
    public function __call($function, array $params = array())
    {
        if (! preg_match('/^(get|update|insert|delete)(.*)$/', $function, $matches)) {
            throw new \BadMethodCallException($function.' é um metodo Inválido, Te liga Magrão');
        }

        if ('insert' == $matches[1]) {
            if (!is_array($params[0]) || count($params[0]) < 1) {
                throw new \InvalidArgumentException('Necessário ser do Tipo Array');
            }
            return $this->insert($this->camelCaseToUnderscore($matches[2]), $params[0]);
        }

        list($tableName, $fieldName) = explode('By', $matches[2], 2);
        if (! isset($tableName, $fieldName)) {
            throw new \BadMethodCallException($function.' é um metodo Inválido, Te liga Magrão');
        }

        if ('update' == $matches[1]) {
            if (! is_array($params[1]) || count($params[1]) < 1) {
                throw new \InvalidArgumentException('Necessário ser do Tipo Array');
            }
            return $this->update(
                $this->camelCaseToUnderscore($tableName),
                $params[1],
                array($this->camelCaseToUnderscore($fieldName) => $params[0])
            );
        }

        //select and delete method
        return $this->{$matches[1]}(
            $this->camelCaseToUnderscore($tableName),
            array($this->camelCaseToUnderscore($fieldName) => $params[0])
        );
    }

    /**
     * Metodo Responsável por Resgatar Dados do Banco
     *
     * @param  string     $nomeTabela Nome da Tabela
     * @param  array      $where     Array deve conter a coluna e o valor para serem usados como Filtro
     * Exemplo do array ('produtos', ['id_categoria' => 2]);
     * @return array = array Associativo para registros Unicos e Multidimenssional para mais registros
     */
    public function get($nomeTabela,  $whereAnd  =   array(), $whereOr   =   array(), $whereLike =   array())
    {
        $cond   =   '';
        $s=1;
        $params =   array();
        foreach($whereAnd as $key => $val)
        {
            $cond   .=  " And ".$key." = :a".$s;
            $params['a'.$s] = $val;
            $s++;
        }
        foreach($whereOr as $key => $val)
        {
            $cond   .=  " OR ".$key." = :a".$s;
            $params['a'.$s] = $val;
            $s++;
        }
        foreach($whereLike as $key => $val)
        {
            $cond   .=  " OR ".$key." like '% :a".$s."%'";
            $params['a'.$s] = $val;
            $s++;
        }
        $stmt = $this->pdo->prepare("SELECT  $nomeTabela.* FROM $nomeTabela WHERE 1 ".$cond);
        try {
            $stmt->execute($params);
            $res = $stmt->fetchAll();

            if (! $res || count($res) != 1) {
                return $res;
            }
            return $res;
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

    public function getAllRecords($nomeTabela, $fields='*', $cond='', $orderBy='', $limit='')
    {

        $stmt = $this->pdo->prepare("SELECT $fields FROM $nomeTabela WHERE 1 ".$cond." ".$orderBy." ".$limit);

        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $rows;
    }

    public function getRecordsForPagination(string $fields, string $nomeTabela,$where = '', $limit, $offset)
    {
        $stmt = $this->pdo->prepare("SELECT $fields FROM $nomeTabela $where LIMIT $limit, $offset");

        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $rows;
    }

    public function getRecFrmQry($query)
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getRecFrmQryStr($query)
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return array();
    }

    public function getRecordFromQueryCustom(string $query, $reset = false)
    {
        $stmt = $this->pdo->prepare($query);
        try{
            $stmt->execute();
            $return = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return ($reset) ? reset($return) : $return;
        }catch (\PDOException $e){
            throw new \RuntimeException("Erro ao Obter os dados :".$query);
        }
    }


    public function getQueryCount($nomeTabela, $field, $cond='')
    {
        $stmt = $this->pdo->prepare("SELECT count($field) as total FROM $nomeTabela WHERE 1 ".$cond);
        try {
            $stmt->execute();
            $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if (!$res || count($res) != 1) {
                return $res;
            }

            return reset($res);
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

    /**
     * Metodo Responsável por Atualizar os Dados no banco de dados
     *
     * @param  string $nomeTabela
     * @param  array  $set       Um array associativo contendo chave e valor; chave = coluna;
     * Exemplo ['nome' => 'Sabonete', 'id_categoria' => 5, 'valorUnitario' => '2,45'];
     * @param  array  $where     Array Associativo aonde a chave é a coluna usada como parametro where
     * Exemplo ['id' => 7]; Neste exemplo o registro 7 é do sabonete que etamos atualizando o valor Uniotário dele
     * @return int    Numero de Colunas atualizadas
     */
    public function update($nomeTabela, array $set, array $where)
    {
        $arrSet = array_map(
            function($value) {
                return $value . '=:' . $value;
            },
            array_keys($set)
        );

        $chaveWhere = key($where);
        $valorWhere = reset($where);

        $stmt = $this->pdo->prepare(
            "UPDATE $nomeTabela SET ". implode(',', $arrSet)." WHERE $chaveWhere=:$chaveWhere");

        foreach ($set as $field => $value) {
            $stmt->bindValue(':'.$field, $value);
        }
//        die(var_dump($set));
//
//        $stmt->bindValue(':'.key($where), current($where));

        try {
            $stmt->execute($set);

            return $stmt->rowCount();
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }

    /**
     * Metodo Delete
     *
     * @param  string $nomeTabela
     * @param  array  $where     array assosiativo
     * @return int    Numero de Registros Excluidos
     */
    public function delete($nomeTabela, array $where)
    {
        $stmt = $this->pdo->prepare("DELETE FROM $nomeTabela WHERE ".key($where) . ' = ?');
        try {
            $stmt->execute(array(current($where)));

            return $stmt->rowCount();
        } catch (\PDOException $e) {
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }


    public function deleteQry($query)
    {
        $stmt = $this->pdo->prepare($query);
        try{
            $stmt->execute();
            echo json_encode(['error' => false, 'message' => 'Registro Removido com Sucesso']);
            exit();
        }catch (\PDOException $e){
            echo json_encode($this->msgErrorDelete);
            exit();
        }

    }


    /**
     * Metodo Inserir dados
     *
     * @param  string $nomeTabela
     * @param  array  $arrData  Array associativo contendo as colunas e seus respectivos valores
     * @return int    Numero de Registros Criados
     */
    public function insert($nomeTabela, array $data, $returnCustom = false, $returnErrorCustom = false)
    {
        $stmt = $this->pdo->prepare("INSERT INTO $nomeTabela (".implode(',', array_keys($data)).")
            VALUES (".implode(',', array_fill(0, count($data), '?')).")"
        );
        try{
            $stmt->execute(array_values($data));
            return is_bool($returnCustom) ? $stmt->rowCount() : $this->pdo->lastInsertId($returnCustom);
        } catch (\PDOException $e) {
            if(is_array($returnErrorCustom)){
                echo json_encode($returnErrorCustom);
                exit();
            }
            throw new \RuntimeException("[".$e->getCode()."] : ". $e->getMessage());
        }
    }
    /**
     * Exibe um Array
     *
     * @param  array
     */
    public function arprint($array){
        print"<pre>";
        print_r($array);
        print"</pre>";
    }

    /**
     * Metodo Cache
     *
     * @param  string QUERY
     * @param  Int Por Padrão é 0
     */
    public function getCache($sql,$cache_min=0)
    {
        $f = 'cache/'.md5($sql);
        if ($cache_min!=0 and file_exists($f) and ( (time()-filemtime($f))/60 < $cache_min )) {
            $arr = unserialize(file_get_contents($f));
        }
        else {
            unlink($f);
            $arr = self::getRecFrmQry($sql);
            if ($cache_min!=0) {
                $fp = fopen($f,'w');
                fwrite($fp,serialize($arr));
                fclose($fp);
            }
        }
        return $arr;
    }

    public function getDataById(string $nomeTabela, $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $nomeTabela WHERE id = $id");
        $stmt->execute();

        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $dados;
    }


}
?>