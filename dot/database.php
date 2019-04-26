<?php
  require_once ( "safepdo.php" );
  
  class database {
    
    private $SafePDO = null;
    
    public function __construct ( ) {
      if ( $this->SafePDO == null ) {
        $this->SafePDO = new SafePDO ( "mysql:host=localhost;dbname=place", 'root', '', array(
          PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ) );
      }
    }
    
    public function __destruct ( ) {
      $this->SafePDO = null;
    }
    
    public function connected ( ) {
      return ( $this->SafePDO !== null );
    }
    
    public function delete ( $table, $wheres = array ( ), $values = array ( ) ) {
      
      $sql = "DELETE FROM {$table}";
      $sql = $sql . " WHERE ";
      foreach ( $wheres as $key => $value ) {
        $sql .= "{$value} = :{$value}, ";
      }
      $sql = rtrim ( $sql, ', ' );
      $statement = $this->SafePDO->prepare( $sql );
      $statement->execute ( $values );
      
    }
    
     public function sql ( $sql, $values = array ( ) ) {
      $statement = $this->SafePDO->prepare ( $sql );
      $statement->execute ( $values );
      $result = $statement->fetchAll ( \PDO::FETCH_ASSOC );
      $statement = null;
      return $result;
    }
    
    public function select ( $table, $columns = array ( ), $wheres = array ( ), $values = array ( ) ) {
      $sql = "SELECT " . implode ( ", ", $columns ) . " FROM {$table}";
      $sql = $sql . " WHERE ";
      foreach ( $wheres as $key => $value ) {
        $sql .= "{$value} = :{$value}, ";
      }
      $sql = rtrim ( $sql, ', ' );
      $statement = $this->SafePDO->prepare ( $sql );
      $statement->execute ( $values );
      $result = $statement->fetchAll ( \PDO::FETCH_ASSOC );
      $statement = null;
      return $result;
    }
    
    public function update ( $table, $columns = array ( ), $wheres = array ( ), $values = array ( ) ) {
      if ( ( sizeof ( $columns ) + sizeof ( $wheres ) ) == sizeof ( $values ) ) {
        $sql = "UPDATE {$table} SET ";
        foreach ( $columns as $key => $value ) {
          $sql .= "{$value} = :{$value}, ";
        }
        $sql = trim ( $sql, ", " ) . " WHERE ";
        foreach ( $wheres as $key => $value ) {
          $sql .= "{$value} = :{$value}, ";
        }
        $sql = trim ( $sql, ", " );
        echo $sql;
        $statement = $this->SafePDO->prepare ( $sql );
        $number_of_rows = $statement->execute ( $values );
        $statement = null;
        return $number_of_rows;
      }
      return false;
    }
    
    public function insert ( $table, $columns = array ( ), $values = array ( ) ) {
      if ( sizeof ( $columns ) == sizeof ( $values ) ) {
        $sql = "INSERT INTO {$table}";
        $sql .= "(" . implode ( ', ', $columns ) . ") VALUES(:" . implode ( ', :', $columns ) . ")";
        $statement = $this->SafePDO->prepare ( $sql );
        $statement->execute ( $values );
        $statement = null;
        return $this->SafePDO->lastInsertId ( );
      }
      return false;
    }
    
    public function create_table ( $table, $columns = array ( ), $temporary = false ) {
      $sql = "CREATE" . ( $temporary ? " TEMP" : "" ) . " TABLE IF NOT EXISTS {$table}";
      $columnsql = "";
      foreach ( $columns as $key => $value ) {
        $columnsql .= $this->table_column ( $value [ 0 ], $value [ 1 ], $value [ 2 ] ) . ", ";
      }
      if ( !empty ( $columnsql ) ) {
        $sql .= "( " . trim ( $columnsql, ", " ) . " )";
      }
      $statement = $this->SafePDO->prepare ( $sql );
      $statement->execute ( );
      $statement = null;
    }
    
    public function table_column ( $name, $type, $value ) {
      return "{$name} {$this->column_type ( ( isset ( $type [ 0 ] ) ? $type [ 0 ] : $type ), ( isset ( $type [ 1 ] ) ? $type [ 1 ] : null ) )}" . ( strlen ( $value ) ? " {$value}" : "" );
    }
    
    public function column_type ( $name, $value = null ) {
      $name = strtoupper ( $name );
      switch ( $name ) {
        case "CHARACTER":
        case "VARCHAR":
        case "VARYING CHARACTER":
        case "NCHAR":
        case "NATIVE CHARACTER":
        case "NVARCHAR":
        case "DECIMAL":
          return $name . " ( " . intval ( $value ) . " )";
          break;
        case "INT":
        case "INTEGER":
        case "TINYINT":
        case "SMALLINT":
        case "MEDIUMINT":
        case "BIGINT":
        case "UNSIGNED BIG INT":
        case "INT2":
        case "INT8":
        case "TEXT":
        case "CLOB":
        case "REAL":
        case "DOUBLE":
        case "DOUBLE PRECISION":
        case "FLOAT":
        case "NUMERIC":
        case "BOOLEAN":
        case "DATE":
        case "DATETIME":
        case "BLOB":
        default:
          return $name;
          break;
      }
    }
    
    public function getTableList() {
        $statement = $this->SafePDO->query("SELECT name FROM sqlite_master WHERE type = 'table' ORDER BY name");
        $tables = [];
        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $tables[] = $row['name'];
        }
        return $tables;
    }
    
  }