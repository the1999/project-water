<?php
class MainClass{
    
    //GET DATA
    function load_data($table_name,$order_by){
        
        $sql = "SELECT * FROM $table_name ORDER BY $order_by;";
        //echo $sql;
        
        $rs = mysql_query($sql) or die(mysql_error());
        $i = 0;
        $c = 0;
        $data = array();
        $columnName = array();
        
        $sql2 = "SHOW COLUMNS FROM $table_name;";
        $rs2 = mysql_query($sql2) or die(mysql_error()." At Line ".__LINE__);
        
        while($row2 = mysql_fetch_array($rs2)){
            
            $columnName[$c]['column_name'] = $row2['Field'];
            $c++;
        }
        
        while($row = mysql_fetch_array($rs)){
            
            foreach($columnName as $c_name){
                $data[$i][$c_name['column_name']] = $row[$c_name['column_name']];
                
            }
            $i++;
            
        }
        
        $this->data = $data;
        
    }
    //END GET DATA
    
    function getUserName($user_id){
        $sql = "SELECT user_type,ref_id FROM tbl_user WHERE user_id = '$user_id';";
        $rs = mysql_query($sql) or die(mysql_error());
        $row = mysql_fetch_array($rs);
        $ref_id = $row['ref_id'];
        $user_type = $row['user_type'];
        $i = 0;
        $c = 0;
        $data = array();
        $columnName = array();
        
        switch ($user_type) {
            case 1: $sql3 = "SELECT * FROM tbl_student WHERE ref_id = '$ref_id';";break;
			case 2: $sql3 = "SELECT * FROM tbl_teacher WHERE ref_id = '$ref_id';";break;
			case 3: $sql3 = "SELECT * FROM tbl_staff WHERE ref_id = '$ref_id';";break;
		}
                
		$rs3 = mysql_query($sql3) or die(mysql_error());
		$row3 = mysql_fetch_array($rs3);
                
		$this->username = $row3['f_name']." ".$row3['s_name']." ( ".$row3['n_name']." )";
	}
            
            
	//GET DATA
	function load_data_where($table_name,$where_cause,$order_by){
		$first = 0;
		$sql = "SELECT * FROM $table_name WHERE ";
		
		while ($row = each($where_cause)){
			
			//SET WHERE
			if($first == 0){
				$sql .= $row[0]." ".$row[1];
				$first = 1;
			}
			else{
				$sql .= " AND ".$row[0]." ".$row[1];
			}
			
			
			
		}
		
		
		$sql .= " ORDER BY $order_by;";
		
		
		$rs = mysql_query($sql) or die(mysql_error());
		$i = 0;
		$c = 0;
		$data = array();
		$columnName = array();
		
		$sql2 = "SHOW COLUMNS FROM $table_name;";
		$rs2 = mysql_query($sql2) or die(mysql_error()." At Line ".__LINE__);
		
		while($row2 = mysql_fetch_array($rs2)){
			
			$columnName[$c]['column_name'] = $row2['Field'];
			$c++;
		}
		
		while($row = mysql_fetch_array($rs)){
			
			foreach($columnName as $c_name){
				$data[$i][$c_name['column_name']] = $row[$c_name['column_name']];
				
			}
			$i++;
			
		}
		
		$this->data = $data;
		
	}
	//END GET DATA
            
            
            
	//UPDATE FUNCTION
	function update_data($table_name,$update_data){
		
		$sql = "UPDATE $table_name SET ";
		
		$last = count($update_data);
		$loop_count = 0;
		$first = 0;
		while ($row = each($update_data)){
			$loop_count++;
			
			if($loop_count == count($update_data)){
				// WHERE
				$sql .= " WHERE ".$row[0]." = ".$row[1].";";
			}
			else{
				
				//SET UPDATE
				if($first == 0){
					$sql .= $row[0]." = '".$row[1]."'";
					$first = 1;
				}
				else{
					$sql .= " , ".$row[0]." = '".$row[1]."'";
				}
				
			}
			
		}
		//echo $sql;
		$rs = mysql_query($sql) or die(mysql_error());
		
		
	}
	//END UPDATE
            
            
            
            
	// INSERT FUNCTION
	function insert_data($table_name,$data){
		
		$sql = "INSERT INTO $table_name(";
		
		$first = 0;
		$value = " VALUES";
		while($row = each($data)){
			
			if($first == 0){
				$sql .= $row[0];
				$value .= "('".$row[1]."'";
				$first = 1;
			}
			else{
				$sql .= " , ".$row[0];
				$value .= ", '".$row[1]."'";
			}
			
		}
		
		$sql .= ") ";
		$value .= ");";
		
		$sql2 = $sql.$value;
		//echo $sql2;
		$rs = mysql_query($sql2) or die(mysql_error());
		
		$this->insert_id = mysql_insert_id();
		
	}
	//END INSERT
			
}