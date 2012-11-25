<table id="attachmentsdiv" border="0" cellpadding="5" cellspacing="0" width="100%">
    <?php
        foreach ($this->request->data['Attachment'] as $attachmentkey => $attachmentvalue) {
            $this->countattachment++;
    ?>
            <tr id="Attachment<?php echo $attachmentkey;?>">
                <td valign="top">
                    <?php
                        echo $this->Form->hidden('Attachment.'.$attachmentkey.'.id');
                        echo $this->Form->hidden('Attachment.'.$attachmentkey.'.report_id');
                        echo $this->Form->hidden('Attachment.'.$attachmentkey.'.filename');
                        echo $this->Form->hidden('Attachment.'.$attachmentkey.'.todelete', array('id'=>'Attachment'.$attachmentkey.'todelete'));
                        echo $this->Form->input('Attachment.'.$attachmentkey.'.name', array('label'=>'Имя приложения: ', 'div'=>false, 'style'=>'width:350px'));
                    ?>
                </td>
                <td width="180" valign="top">
                    <?php
                        if ($attachmentvalue['filename'] != '')
                            echo $this->Html->link($attachmentvalue['filename'], '/uploaded/annexes/'.$attachmentvalue['filename']);
                        else echo 'Для этого приложения нет файла';
                    ?>
                </td>
                <td width="200" valign="top"><?php echo $this->Form->input('Attachment.'.$attachmentkey.'.attachmentfile', array('type'=>'file', 'label'=>false));?></td>
                <td width="30" valign="top"><a href="javascript:void(0);" onclick="return confirmDeleteattachment('<?php echo 'Attachment'.$attachmentkey;?>');"><img src="/images/delete.png" width="20" height="20" border="0" title="удалить приложение"/></a></td>
            </tr>
    <?php }?>
</table>
