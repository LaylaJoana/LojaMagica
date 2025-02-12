<?php

namespace Src\Models;

use PDO;
use Src\Database\Connection;

abstract class Model
{
    protected $table;

    protected $attributes;

    public static function find($id)
    {     
        $con = Connection::getConn();
        $sql = "SELECT * FROM " . (new static)->table . " WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();

        $resultado = $sql->fetchObject(get_class(new static));

        return $resultado;
    }

    public static function all()
    {
        $con = Connection::getConn();

        $sql = "SELECT * FROM " . (new static)->table . " ORDER BY id ASC";
        $sql = $con->prepare($sql);
        $sql->execute();

        $resultado = array();

        while ($row = $sql->fetchObject(get_class(new static))) {
            $resultado[] = $row;
        }

        return $resultado;
    }

    public static function create($dados, $columns = null): bool|object
    {

        
        $con = Connection::getConn();

        $attrs = self::getAttrs($columns);
        $binds = self::getBinds($columns);

        $sql = $con->prepare(
            'INSERT INTO ' . (new static)->table . " ( $attrs ) VALUES ( $binds )"
        );
      

        $sql = self::bindValues($sql, $dados);
      
        $res = $sql->execute();
     
        if ($res) {
            return self::find($con->lastInsertId());
        }

        return new \Exception('Ocorreu um erro ao salvar ' . get_class(new static));
    }

    public static function update($dados, $columns = null): bool|object
    {

       
        $con = Connection::getConn();
        $attrsBinds = self::getAttrsBinds($columns);
        $sql = "UPDATE " . (new static)->table . " SET " . $attrsBinds . " WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql = self::bindValues($sql, $dados);

        $res = $sql->execute();

        if ($res) {
            return self::find($dados['id']);
        }

        return new \Exception('Ocorreu um erro ao atualizar ' . get_class(new static));
    }

    public static function delete($id): bool
    {
        $con = Connection::getConn();

        $sql = "DELETE FROM " . (new static)->table . " WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $id);
        $resultado = $sql->execute();

        if ($resultado == 0) {
            return false;
        }

        return true;
    }

    public static function beginTransaction()
    {
        $db = Connection::getConn();
        $db->beginTransaction();
    }

    public static function commit()
    {
        $db = Connection::getConn();
        $db->commit();
    }

    public static function rollBack()
    {
        $db = Connection::getConn();
        $db->rollBack();
    }

    private static function bindValues($prepare, $values): mixed
    {
        foreach ($values as $key => $value) {
            if (is_array($value)) {
                $value = implode(',', $value);
            }
            $bind = ':' . $key;
            $prepare->bindValue($bind, $value);
        }

        return $prepare;
    }

    private static function getAttrsBinds($columns = null): string
    {
        $attributes = $columns ?? (new static)->attributes;
        $attrsBinds = '';

        foreach ($attributes as $attribute) {
            $attrsBinds .= $attribute . ' = :' . $attribute . ',';
        }

        return rtrim($attrsBinds, ',');
    }

    private static function getAttrs($columns = null): string
    {
        $attributes = $columns ?? (new static)->attributes;
        $attrs = '';

        foreach ($attributes as $attribute) {
            $attrs .= ' ' . $attribute . ',';
        }

        return rtrim($attrs, ',');
    }

    private static function getBinds($columns = null): string
    {
        $attributes = $columns ?? (new static)->attributes;
        $attrs = '';

        foreach ($attributes as $attribute) {
            $attrs .= ' :' . $attribute . ',';
        }

        return rtrim($attrs, ',');
    }

    public static function getColumns(): array
    {
        $con = Connection::getConn();
        $sql = $con->prepare('show columns from ' . (new static)->table);
        $sql->execute();

        $res = [];

        while ($row = $sql->fetch()) {
            $res[$row['Field']] = true;
        }

        return $res;
    }

    // relacionamentos

    public function belongsTo($class, $localKey, $foreignKey): bool|object
    {
        $con = Connection::getConn();
        $sql = $con->prepare("SELECT * FROM " . (new $class)->table . " where " . $foreignKey . " = " . $this->$localKey);
        $sql->execute();

        $result = $sql->fetchObject($class);

        return $result;
    }

    public function hasOne($class, $foreignKey, $onwerKey): bool|object
    {
        $con = Connection::getConn();
        $sql = $con->prepare("SELECT * FROM " . (new $class)->table . " where " . $onwerKey . " = " . $this->$foreignKey);
        $sql->execute();

        $result = $sql->fetchObject($class);

        return $result;
    }

    public function hasMany($class, $foreignKey, $onwerKey): array
    {
        $con = Connection::getConn();
        $sql = $con->prepare("SELECT * FROM " . (new $class)->table . " where " . $onwerKey . " = " . $this->$foreignKey);
        $sql->execute();

        $result = [];
        while ($row = $sql->fetchObject($class)) {
            $result[] = $row;
        }

        return $result;
    }

    // metodos

    public function save(): bool|object
    {
        $columns = self::getColumns();
        $attrsAll = $this->getAllAttrs();

        foreach ($attrsAll as $key => $value) {
            if (!array_key_exists($key, $columns)) {
                unset($attrsAll[$key]);
            }
        }

        if (empty($attrsAll['id'])) {
            return self::create($attrsAll, array_keys($attrsAll));
        } else {
            return self::update($attrsAll, array_keys($attrsAll));
        }
    }

    private function getAllAttrs(): array
    {
        $array = [];

        foreach ($this as $key => $value) {
            $array[$key] = $value;
        }

        return $array;
    }

    public static function where($column, $value)
    {
        $con = Connection::getConn();
        $sql = "SELECT * FROM " . (new static)->table . " WHERE $column = :value";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':value', $value);
        $stmt->execute();

        $result = [];
        while ($row = $stmt->fetchObject(get_class(new static))) {
            $result[] = $row;
        }

        return $result;
    }
}
