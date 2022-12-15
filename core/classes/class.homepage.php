<?php

class Homepage extends Connection
{

    public function pending()
    { 
      $rows = array();
      $result = $this->select('tbl_documents as d, tbl_recipients as r', 'd.doc_id,d.doc_name,d.doc_type_id, d.user_id as owner_id, r.user_id, r.status, d.date_added', 'r.user_id='.$_SESSION['cdms_user_id'].' AND d.doc_id=r.doc_id AND r.status != 1');
      $Users = new Users();
      $DocumentType = new DocumentType();
      while ($row = $result->fetch_assoc()) {
          $row['doc_type'] = $DocumentType->name($row['doc_type_id']);
          $row['owner'] = $Users->fullname($row['owner_id']);
          $row['date_added'] = date('F d,Y h:m A', strtotime($row['date_added']));
          $rows[] = $row;
      }
      return $rows;
    }

    public function total_documents(){
        $result = $this->select("tbl_documents", "count(doc_id)", "user_id=$_SESSION[cdms_user_id]");
        $row = $result->fetch_array();
        return $row[0];
    }

    public function total_pending(){
        $result = $this->select('tbl_documents as d, tbl_recipients as r', 'count(d.doc_id)', 'r.user_id='.$_SESSION['cdms_user_id'].' AND d.doc_id=r.doc_id AND r.status != 1');
        $row = $result->fetch_array();
        return $row[0];
    }

    public function total_shared_documents(){
        $result = $this->select('tbl_documents as d, tbl_recipients as r', 'count(d.doc_id)', 'r.user_id='.$_SESSION['cdms_user_id'].' AND d.doc_id=r.doc_id');
        $row = $result->fetch_array();
        return $row[0];
    }
}

?>
