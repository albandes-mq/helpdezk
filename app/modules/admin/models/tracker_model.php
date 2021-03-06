<?php

if(class_exists('Model')) {
    class DynamicTracker_model extends Model {}
} elseif(class_exists('cronModel')) {
    class DynamicTracker_model extends cronModel {}
} elseif(class_exists('apiModel')) {
    class DynamicTracker_model extends apiModel {}
}

class tracker_model extends DynamicTracker_model{



    public function insertEmail($idmodule,$from,$to,$subject,$body){
        $query = "	INSERT INTO tbemail (idmodule, `from`, `to`, subject, body)
					VALUES
					  (
						$idmodule,
						'$from',
						'$to',
						'$subject',
						'$body'
					  ) ;
					";

        $ret = $this->db->Execute($query);
        if (!$ret) {
            $sError = "File: " . __FILE__ . " Line: " . __LINE__ . "DB ERROR: " . $this->db->ErrorMsg() . " QUERY: " . $query;
            $this->error($sError);
            return false;
        } else {
            return $this->db->Insert_ID();
        }

    }

    public function insertMadrillID($idemail,$idmandrill){
        $query = "	INSERT INTO tbemail_has_mandrill (idemail, idmandrill)
					VALUES($idemail,'$idmandrill')
					";

        $ret = $this->db->Execute($query);
        if (!$ret) {
            $sError = "File: " . __FILE__ . " Line: " . __LINE__ . "DB ERROR: " . $this->db->ErrorMsg() . " QUERY: " . $query;
            $this->error($sError);
            return false;
        } else {
            return $ret;
        }

    }

    public function updateEmailSendTime($idemail){
        $query = "	UPDATE tbemail
                       SET ts = UNIX_TIMESTAMP()
					 WHERE idemail = $idemail
					";

        $ret = $this->db->Execute($query);
        if (!$ret) {
            $sError = "File: " . __FILE__ . " Line: " . __LINE__ . "DB ERROR: " . $this->db->ErrorMsg() . " QUERY: " . $query;
            $this->error($sError);
            return false;
        } else {
            return $ret;
        }

    }











}
?>
