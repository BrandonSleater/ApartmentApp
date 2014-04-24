<?php

class sqldb {

  public $conn;
  
  
  function __construct($args = FALSE) {
    
    //If mysqli config is passed, use it. Else use default
    $args = ($args !== FALSE) ? $args : $this->getConfig(); 
    
    $this->conn = @new mysqli($args['HOST'], $args['USER'], $args['PW'], $args['DB'], $args['PORT']);
		
    //If we can't connect, alert the user, else return a successful connection
    if ($this->conn->connect_errno) {
      
      //Build error message
      throw new Exception($this->conn->connect_errno);
		} else {
      
      return $this->conn;
    }
  }
  
  
  /**
   * Common DB config relating to our init script
   * 
   * @return type array
   */
  private function getConfig() {
    return [
      'HOST' => 'localhost',
      'USER' => 'selenium_test',
      'PW'   => '2K00L4SKOOL',
      'DB'   => 'selenium',
      'PORT' => 3306
    ];
  }
  
  
  /**
   * This function is used for preparing our SQL statements
   * then returning an associative array of results
   * 
   * @param type $link      DB Connection
   * @param type $sql       Actual SQL Query code
   * @param type $typeDef   Data type of passed parameter
   * @param type $params    Values we pass into the sql statement
   * 
   * @return boolean/array  Can either be passed False for a bad query or array for single/multiple queries
   */
  public function prepSQL($link, $sql, $typeDef = FALSE, $params = FALSE){ 
    
    if ($stmt = mysqli_prepare($link, $sql)) { 
      
      if (count($params) == count($params, 1)) { 
        $params     = [$params]; 
        $multiQuery = FALSE; 
      } else { 
        $multiQuery = TRUE; 
      }  

      if ($typeDef){ 
        
        $bindParams = [];    
        $bindParamsReferences = []; 
        
        $bindParams = array_pad($bindParams, (count($params, 1) - count($params)) / count($params), "");
        
        foreach($bindParams as $key => $value) { 
          $bindParamsReferences[$key] = &$bindParams[$key];  
        } 
        
        array_unshift($bindParamsReferences, $typeDef); 
        
        $bindParamsMethod = new ReflectionMethod('mysqli_stmt', 'bind_param'); 
        $bindParamsMethod->invokeArgs($stmt, $bindParamsReferences); 
      } 

      $result = []; 
      
      foreach($params as $queryKey => $query) { 
        
        foreach($bindParams as $paramKey => $value) { 
          $bindParams[$paramKey] = $query[$paramKey]; 
        } 
        
        $queryResult = []; 
        
        if (mysqli_stmt_execute($stmt)) { 
          
          $resultMetaData = mysqli_stmt_result_metadata($stmt); 
          
          if ($resultMetaData) {
            
            $stmtRow = [];   
            $rowReferences = []; 
            
            while ($field = mysqli_fetch_field($resultMetaData)) { 
              $rowReferences[] = &$stmtRow[$field->name]; 
            }                 
            
            mysqli_free_result($resultMetaData); 
            
            $bindResultMethod = new ReflectionMethod('mysqli_stmt', 'bind_result'); 
            $bindResultMethod->invokeArgs($stmt, $rowReferences); 
            
            while(mysqli_stmt_fetch($stmt)){ 
              
              $row = []; 
              
              foreach($stmtRow as $key => $value){ 
                $row[$key] = $value;           
              } 
              
              $queryResult[] = $row; 
            } 
            
            mysqli_stmt_free_result($stmt); 
          } else { 
            $queryResult[] = mysqli_stmt_affected_rows($stmt); 
          } 
        } else { 
          $queryResult[] = FALSE; 
        } 
        
        $result[$queryKey] = $queryResult; 
      }
      
      mysqli_stmt_close($stmt);   
    } else { 
      $result = FALSE; 
    } 

    if ($multiQuery) { 
      return $result; 
    } else { 
      return $result[0]; 
    } 
  } 
}
