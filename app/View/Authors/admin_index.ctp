<?php echo $this->element('top_menu', array('top_menu_title'=>'Администрирование непосредственных авторов'));?>

<div id="line">
    <?php echo $this->element('admin_menu');?>
</div>

<div id="listcontent">

    <div id="caption" class="green">Список непосредственных авторов - <?php echo $countauthors;?></div>

    <table width="100%" border="0" cellspacing="1" cellpadding="5" id="green">
        <tr>
            <th width="5">№</th>
            <th><?php echo $this->Paginator->sort('Author.name', 'Непосредственный автор', array('title' => 'сортировка согласно непосредственному автору'));?></th>
            <th width="50">Редактирование</th>
            <th width="50">Удаление</th>
        </tr>
        <?php
        $i = intval($this->Paginator->counter(array('format'=>'%start%')));
        foreach ($authors as $author) {?>
        <tr valign="top">
            <td align="center"><?php echo $i.'.'; $i++;?></td>
            <td><?php echo $author['Author']['name'];?></td>
            <td align="center"><?php echo $this->element('editlink', array('editlink'=>'/admin/authors/edit/'.$author['Author']['id']));?></td>
            <td align="center"><?php echo $this->element('deletelink', array('deletelink'=>'/admin/authors/delete/'.$author['Author']['id'], 'deletelinkquestion'=>'непосредственный автор'));?></td>
        </tr>
        <?php }?>
    </table>

    <?php
        echo $this->element('paginator');
        echo $this->element('addlink', array('addlink'=>'/admin/authors/add', 'addtitle'=>' Добавить непосредственного автора'));
        echo $this->element('simple_legend');
        echo $this->element('error_messages');
        echo $this->element('sponsor');
    ?>

</div>
