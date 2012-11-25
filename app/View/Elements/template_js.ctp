<script type="text/javascript">
    tinyMCE.init({
        //mode : 'textareas',
        theme : 'advanced',
        plugins: 'table,advhr,advimage,advlink,inlinepopups,contextmenu',
        theme_advanced_buttons1 : 'bold,italic,underline,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,bullist,numlist,separator,link,unlink,image,separator,code,cleanup',
        theme_advanced_buttons2 : 'tablecontrols',
        theme_advanced_buttons3 : '',
        theme_advanced_toolbar_location : 'top',
        theme_advanced_toolbar_align : 'left',
        file_browser_callback : 'ajaxfilemanager',
        entity_encoding : 'raw',
        gecko_spellcheck : true,
        paste_use_dialog : false,
        theme_advanced_resizing : true,
        theme_advanced_resize_horizontal : true,
        apply_source_formatting : true,
        //force_br_newlines : true,
        //force_p_newlines : true,
        relative_urls : false,
        //document_base_url : tinymce_baseurl,
        setup : function(ed) {
            ed.onChange.add(function(ed) {
                ed.save();
            });
        },
        language : 'ru',
        width: 740,
        height: 100
    });

    function ajaxfilemanager(field_name, url, type, win) {
        var ajaxfilemanagerurl = '/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php';
        switch (type) {
            case "image":
                break;
            case "media":
                break;
            case "flash":
                break;
            case "file":
                break;
            default:
                return false;
        }
        tinyMCE.activeEditor.windowManager.open(
            {
                url: '/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php',
                width: 782,
                height: 440,
                close_previous : 'no'
            },
            {
                window : win,
                input : field_name
            });
    }

    jQuery(document).ready(function($){
        jQuery('#TemplateDatetext').datepicker({
            altField: '#TemplateDate',
            altFormat: 'yy-mm-dd'
        });

        $('#submitbutton').click(function(){
            tinyMCE.triggerSave();
            jQuery('.tinymceeditor').each(function () {
                tinyMCE.execCommand('mceRemoveControl', false, $(this).attr('id'));
            });
        });

        jQuery('.tinymceeditor').each(function () {
            tinyMCE.execCommand('mceAddControl', false, $(this).attr('id'));
        });

    });
</script>
