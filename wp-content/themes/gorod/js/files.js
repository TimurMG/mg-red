var upFiles = {

    objects: null,
    cl:null,

    init: function (cl) {

        if (!window.FormData) return false;

        upFiles.cl = cl;
        upFiles.objects = jQuery("." + cl);

        if(upFiles.objects.length == 0) return false;

        var formData = new FormData();

        upFiles.objects.each(function (n, elem) {
            elem.addEventListener('change', function (e) {
                var file = this.files[0];

                if (!!file.type.match(/image.*/)) {

                    jQuery(e.target).attr('disabled', 'disabled');
                    jQuery(elem).parent().addClass('wait');

                    formData.append("image", file);
                    formData.append("action", 'insert_attach');
                    formData.append("nonce", ajax_obj.nonce);

                    jQuery.ajax({
                        url: ajax_obj.ajax_url,
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: 'text',
                        success: function (res) {
                            var arr = res.split('_@_')[1];
                            var obj = eval('('+arr+')');

                            jQuery(elem).parent().removeClass('wait');
                            jQuery(elem).parent().append("<img id='img_" + obj['id'] + "' src='" + obj['url'] + "'>");
                            jQuery(elem).parent().append("<input type='hidden' name='images[]' value='" + obj['id'] + "' id='img_val_" + obj['id'] + "' >");
                            jQuery(elem).parent().append("<div class='delete-btn' id='" + obj['id'] + "'></div>");

                            jQuery(elem).parent().find('.delete-btn').click(upFiles.deleteAttach);
                        }
                    });
                }
            }, false);
            jQuery(elem).parent().find('.delete-btn').click(upFiles.deleteAttach);
        });

        return true;
    },

    deleteAttach:function(e) {
        var obj = jQuery(e.target);
        var id = obj.attr('id');

        obj.parent().addClass('wait');
        jQuery("#img_"+id).hide();
        jQuery("#img_val_"+id).hide();
        obj.hide();

        jQuery.post(ajax_obj.ajax_url, {ad_id: id, action: 'delete_attach', nonce: ajax_obj.nonce}, function (responce) {

            obj.parent().find('.'+upFiles.cl).removeAttr('disabled');
            obj.parent().removeClass('wait');
            jQuery("#img_"+id).remove();
            jQuery("#img_val_"+id).remove();
            obj.remove();

            return true;
        });
        return false;
    }
}