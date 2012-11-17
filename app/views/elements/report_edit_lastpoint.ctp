<?php
    $rowid = 0;
    //if (empty($this->data['subraport']))
        //echo $this->element('report_edit_point13_content', array('rowid'=>$rowid));
    //else
        foreach ($this->data['subraport'] as $tempsubraportkey => $tempsubraportvalue) {
            echo $this->element('report_edit_lastpoint_content', array('rowid'=>$rowid));
            $rowid++;
        }
?>
