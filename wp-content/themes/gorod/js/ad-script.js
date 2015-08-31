var adObj = {

    obj: null,
    objClass: null,
    valElem: null,
    nameElem: null,
    popup: null,
    popupWait: null,
    isFirst: true,
    current: 0,
    cache:[],

    init: function (objCl, valSel, nameSel) {

        adObj.obj = jQuery('.'+objCl);

        if(adObj.obj.length == 0) return false;

        adObj.objClass = objCl;
        adObj.popup = adObj.obj.find('.cats');
        adObj.popupWait = adObj.popup.find('.wait');
        adObj.valElem = jQuery(valSel);
        adObj.nameElem = jQuery(nameSel);

        adObj.obj.click(adObj.showWindow);
    },

    showWindow: function (e) {
        adObj.popup.show();

        jQuery(document).bind('click', adObj.closeWindow);

        if(adObj.isFirst) {
            adObj.popup.find("li").each(function(n, elem) {
                jQuery(elem).find('a').click(adObj.selectCategory);
            });
            adObj.isFirst = false;
        }
    },

    closeWindow: function (e) {
        if (!jQuery(e.target).hasClass(adObj.objClass) && !jQuery(e.target).parents('.'+adObj.objClass).length) {
            var subCats = adObj.popup.find('.sub-cats');
            subCats.empty();
            adObj.popup.removeClass('list');
            adObj.popup.hide();
            jQuery(document).unbind('click', adObj.closeWindow);
        }
    },

    selectCategory: function(e) {
        var cur = jQuery(e.target);
        var catId = cur.attr('id');

        if(adObj.current == catId) return false;

        adObj.current = catId;

        cur.parent().parent().find('.current').removeClass('current');
        cur.parent().addClass('current');

        adObj.popupWait.show();
        if(adObj.cache[adObj.current] == undefined) {
            jQuery.post(ajax_obj.ajax_url, {id: catId, action: 'get_sub_cats', nonce: ajax_obj.nonce}, adObj.generateSubCuts, "json");
        }
        else {
            adObj.generateSubCuts(adObj.cache[adObj.current]);
        }


        return false;
    },

    generateSubCuts: function(responce) {
        var subCats = adObj.popup.find('.sub-cats');
        if(subCats.length > 0) subCats.remove();

        if(adObj.cache[adObj.current] == undefined) adObj.cache[adObj.current] = responce;

        adObj.popupWait.hide();

        if(responce.length > 0) {
            if(!adObj.popup.hasClass('list')) adObj.popup.addClass('list');

            adObj.popup.append('<ul class="sub-cats"></ul>');
            subCats = adObj.popup.find('.sub-cats');

            for(var i = 0; i < responce.length; i++) {
                subCats.append("<li><a href='' id='"+responce[i].id+"'>"+responce[i].name+"</a></li>");
            }

            subCats.find("li").each(function(n, elem) {
                jQuery(elem).find('a').click(function(){
                    var id = jQuery(this).attr('id');
                    var name = jQuery(this).text();
                    adObj.setCategory(id, name);
                    return false;
                });
            });
        }
        else {
            var name = jQuery("#"+adObj.current).text();
            adObj.setCategory(adObj.current, name);
        }
    },

    setCategory: function(id, name) {
        adObj.valElem.val(id);
        adObj.nameElem.text(name);
        jQuery(document).click();
    }
}