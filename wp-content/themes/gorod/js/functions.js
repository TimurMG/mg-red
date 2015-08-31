jQuery(function ($) {

    var galleries = $('.am-gallery').adGallery({
        loader_image: '/wp-content/themes/gorod/js/ad_gallery/loader.gif',
        width: 568,
        height: 328,
        display_back_and_forward: true,
        effect: 'fade',
        slideshow: {
            enable: true,
            autostart: true,
            speed: 5000
        }
    });

    $(".tabs").tabs();
    $(".footer-menu").autocolumnlist({ columns: 4, min: 4 });

    if($('.single-news-content').length > 0) {
        setTimeout(function(){ $('div[id*="mediaplayer"]').css('overflow','hidden'); }, 200);
        add_colorbox_effect('.single-news-content');
    }
    if($('.single-competition-content').length > 0) {
        add_colorbox_effect('.single-competition-content');
        competition_images();
    }
    if($('.single-item').length > 0) add_colorbox_effect('.single-item');
    if($('.page-content').length > 0) add_colorbox_effect('.page-content');

    $(".default-val").each(function(n, el){
        $(el).blur(function(e){
            if(this.value=='') this.value = this.defaultValue;
        });
        $(el).focus(function(e){
            if(this.value==this.defaultValue) this.value = '';
        });
    });

    $("#commentform").bind("submit", function () {
        if (!$("#comment_rule").is(':checked')) {
            alert("Для размещения комментария необходимо согласиться с условиями сайта!");
            return false;
        }
    });

    $("#new_post.abc").bind("submit", function () {
        if (!$("#conf_rule").is(':checked')) {
            alert("Для размещения объявления необходимо согласиться с условиями сайта!");
            return false;
        }
    });

    $(".print a").click(function(e){
        window.print();
        return false;
    });

    if($('.attaches').length > 0) upFiles.init('attaches');

    if($('.adc-cats').length > 0)  adObj.init('adc-cats', '#category', '#cat-name');

    $('#new_post').validate();

    var source_link = '<p>Подробнее: <a href="' + location.href + '">' + location.href + '</a></p>'
        + '<p>Любое использование материалов допускается только при наличии гиперссылки на mgorod.kz</p>';

    if (window.getSelection) jQuery('.single-news .single-news-content').bind(
        'copy',
        function () {
            var selection = window.getSelection();
            var range = selection.getRangeAt(0);

            var magic_div = jQuery('<div>').css({ overflow: 'hidden', width: '1px', height: '1px', position: 'absolute', top: '-10000px', left: '-10000px' });
            magic_div.append(range.cloneContents(), source_link);
            jQuery('body').append(magic_div);

            var cloned_range = range.cloneRange();
            selection.removeAllRanges();

            var new_range = document.createRange();
            new_range.selectNode(magic_div.get(0));
            selection.addRange(new_range);

            window.setTimeout(
                function () {
                    selection.removeAllRanges();
                    selection.addRange(cloned_range);
                    magic_div.remove();
                }, 0
            );
        }
    );

    uLogin.customInit("uLogin1","uLogin2");

    add_placeholder_fix();

    if($('.org-menu').length > 0) customize_abc_menu('org-menu');

    if($('#new_post').length > 0) $('#new_post').validate();

    if($('#beforeafter').length > 0) {
        sliderOptions.container = $('#beforeafter');

        var imgs = sliderOptions.container.find('img');

        $(sliderOptions.container).css({'width': imgs.eq(0).width(), 'height': imgs.eq(0).height()});

        sliderOptions.type = 'static'; //"tiles" for tiles, set to "static" if this is not tiles
        sliderOptions.leftContent = imgs.eq(0).attr('src'); //image file name or tile set directory name
        sliderOptions.rightContent = imgs.eq(1).attr('src'); //image file name or tile set directory name

        sliderOptions.leftLabel = (imgs.eq(0).attr('title')) ? imgs.eq(0).attr('title') : null;
        sliderOptions.rightLabel = (imgs.eq(1).attr('title')) ? imgs.eq(1).attr('title') : null;

        sliderOptions.container.empty();

        //initialize the slider
        sliderBegin();
    }

    jQuery(window).scroll(function () {
        if (jQuery(window).scrollTop() > 100) {
            jQuery("#totop").fadeIn();
        } else {
            jQuery("#totop").fadeOut();
        }
    });

    jQuery("#totop").hide();

    jQuery('#totop').click(function () {
        jQuery('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });
    jQuery(window).scroll();

    /*
     if (jQuery("#respond").children().eq(1).is('div')) {
     jQuery("#respond").children().eq(1).css('position', 'absolute').css('right', '0');
     }



     jQuery(".comment-reply-link").attr("title", "Ответить на комментарий");

     jQuery(".scroll-news").jScrollPane({autoReinitialise: true, mouseWheelSpeed:20});
     jQuery(".scroll-aditems").jScrollPane({autoReinitialise: true, mouseWheelSpeed:20});

     jQuery(window).resize(function () {
     get_resolution();
     });


     */
});

jQuery(window).load(function() {
    set_grayscale();
});

function competition_images() {
    var links = jQuery('.likes').not('.disabled').find('a');
    links.click(function(){
        jQuery(this).unbind('click').click(function(){ alert('Ваш голос уже принят.'); });

        var fileId = jQuery(this).attr('href').split('-')[1];
        var count = jQuery(this).next('.count');

        jQuery.post(ajax_obj.ajax_url, {id: fileId, action: 'competition_like', nonce: ajax_obj.nonce}, function(responce){
            if(responce['likes'])
                count.text(responce['likes']);
                count.parent().addClass('disabled');
            if(responce['error'])
                alert(responce['error']);
        }, "json");

        return false;
    });
}

function add_placeholder_fix() {
    var objs = jQuery('[placeholder]');
    objs.focus(function() {
        var input = jQuery(this);
        if (input.val() == input.attr('placeholder')) {
            input.val('');
            input.removeClass('placeholder');
        }
    }).blur(function() {
            var input = jQuery(this);
            if (input.val() == '' || input.val() == input.attr('placeholder')) {
                input.addClass('placeholder');
                input.val(input.attr('placeholder'));
            }
        }).blur();

    objs.parents('form').submit(function() {
        jQuery(this).find('[placeholder]').each(function() {
            var input = jQuery(this);
            if (input.val() == input.attr('placeholder')) {
                input.val('');
            }
        })
    });
}

function set_grayscale() {
    jQuery("img.grayscale").each(function(){
        grayscale.prepare(this);
        jQuery(this).bind("mouseover", function(){
            grayscale.reset(this);
        });
        jQuery(this).bind("mouseout", function(){
            if(!jQuery(this).parent().hasClass('am-active'))grayscale(this);
        });
        if(!jQuery(this).parent().hasClass('am-active'))grayscale(this);
    });
}

function customize_abc_menu(cl) {
    var obj = jQuery('.'+cl);
    obj.find('.children').hide();
    obj.children('li').each(function (n, element) {
        if (jQuery(element).find('ul').length > 0) {
            jQuery('<a href="" class="close-icon"></a>').prependTo(jQuery(element).children('div'));
            jQuery('.close-icon').bind('click', function () {
                open_children(this);
                return false;
            });
            if (jQuery(element).hasClass('current-cat') || jQuery(element).hasClass('current-cat-parent')) open_children(jQuery(element).find('.close-icon'));
        }
        else {
            jQuery('<a href="" class="empty-icon"></a>').prependTo(jQuery(element).children('div'));
        }
    })

    function open_children(el) {
        jQuery(el).parents('li').children('.children').show('high');
        jQuery(el).removeClass('close-icon').addClass('open-icon');
        jQuery('.open-icon').unbind('click').bind('click', function () {
            close_children(this);
            return false;
        });
    }

    function close_children(el) {
        jQuery(el).parents('li').children('.children').hide('high');
        jQuery(el).removeClass('open-icon').addClass('close-icon');
        jQuery('.close-icon').unbind('click').bind('click', function () {
            open_children(this);
            return false;
        });
    }
}

function new_window(url) {
    width_screen = (screen.width - 700) / 2;
    height_screen = (screen.height - 400) / 2;
    params = 'menubar=0, toolbar=0, location=0, directories=0, status=0, scrollbars=0, resizable=0, width=700, height=400, left=' + width_screen + ', top=' + height_screen;
    window.open(url, 'newwin', params);
}

function add_colorbox_effect(selector) {

    jQuery(selector).find('img').each(function (n, element) {
        if (jQuery(element).parent().is('a')) {
            var link = jQuery(element).parent();

            if (link.attr('href').indexOf('.jpg') != -1 || link.attr('href').indexOf('.png') != -1 || link.attr('href').indexOf('.gif') != -1 || link.attr('href').indexOf('.jpeg') != -1) {
                link.addClass("group");
                link.attr('title', jQuery(element).attr('alt'));
            }
        }
    });
    jQuery(selector).find(".group").colorbox({rel: "group", maxWidth: "90%", maxHeight: "90%"});
}

function remove_attachment(el, id) {
    jQuery(el).attr("disabled", "disabled");
    jQuery.post(ajax_obj.ajax_url, {ad_id: id, action: 'delete_attach', nonce: ajax_obj.nonce}, function (responce) {
        jQuery(el).parent().remove();
        multi_selector.count--;
        multi_selector.current_element.disabled = false;
    });
}

function confirm_del_action() {
    if (!confirm('Вы уверены что хотите удалить запись?')) return false;
}

function t_block(id) {
    jQuery('#' + id).toggle('fast');
    return false;
}


(function($) {
    var defaults = { /*значения по умолчанию (если при вызове скрипта не указывалось никаких параметров)*/
        columns: 4,
        classname: 'column', /*класс для обертки колонок*/
        min: 1
    };
    $.fn.autocolumnlist = function(params){
        var options = $.extend({}, defaults, params);
        return this.each(function() {
            var els = $(this).find('li, p');
            var dimension = els.size();
            if (dimension > 0) {
                var elCol = Math.ceil(dimension/options.columns);
                if (elCol < options.min) {
                    elCol = options.min;
                }
                var start = 0;
                var end = elCol;

                for (i=0; i<options.columns; i++) {
                    // Add "last" class for last column
                    if ((i + 1) == options.columns) {
                        els.slice(start, end).wrapAll('<div class="'+options.classname+' last" />');
                    } else {
                        els.slice(start, end).wrapAll('<div class="'+options.classname+'" />');
                    }
                    start = start+elCol;
                    end = end+elCol;
                }
            }
        });
    };
})(jQuery);