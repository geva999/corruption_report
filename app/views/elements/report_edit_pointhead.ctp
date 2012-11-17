<?php
    echo '<br>';
    if (isset($headtext)) {
        echo '<p><span class="h3">';
        if (isset($letter)) echo '<span class="digit">'.$letter.'. </span>';
        echo $headtext.'</span>';
        if (isset($headcontent)) echo $headcontent;
        echo '</p>';
    }
    if (isset($headsmalltext))
        echo '<p><small>'.$headsmalltext.'</small></p>';
    if (isset($textareanotrequired)) $textareaclass = NULL;
    else $textareaclass = 'required_dependent';
    if (isset($textareaname))
        echo '<span class="green" style="float:right;margin-bottom:-10px;"></span>'.$form->input($textareaname, array('type'=>'textarea', 'class'=>$textareaclass, 'label'=>false));
?>
