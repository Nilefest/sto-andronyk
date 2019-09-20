<?php

class stockModel extends Model {
    public function addDet($id, $count = 0){
        
        $sql = "UPDATE `".$this->table."` SET `count` = `count` + ".$count." WHERE `id` = ".$id;
		$query = $this->db->query($sql);
        
		return $sql;
    }
    public function remDet($id, $count = 0){
        
        $sql = "UPDATE `".$this->table."` SET `count` = `count` - ".$count." WHERE `id` = ".$id;
		$query = $this->db->query($sql);
        //echo '<hr>'.$sql;
		return $sql;
    }
}
?>
