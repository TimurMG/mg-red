/* Author: AGP */

var sliderOptions = {
    container:'',
    type:'static',
    leftLabel:'before',
    rightLabel:'after',
    leftContent:'',
    rightContent:''

};

var mapOptions = {
    thezoom: 0,
    thecenter: 0,
    initialzoom:9,
    maxzoom:10,
    minzoom:4
}

var map = null;
var map2 = null;
var randID =  Math.round(Math.random()*100000000);
var imgWidth;
var imgHeight;
var baGroupTop;
var changing = false;
var leftPos = 0;

function sliderBegin() {

    jQuery(sliderOptions.container).css('overflow','hidden');
    leftPos = jQuery(sliderOptions.container).offset().left;

    sliderOptions.container.append('<div id="baGroup" baType="map" style="width:'+sliderOptions.container.width()+'px;height:'+sliderOptions.container.height()+'px;">'
        +'<div id="canvas1" class="baCanvas top" ></div>'
        +'<div id="canvas2" class="baCanvas bottom" ></div>'
        +'</div>'
    );

    imgWidth = jQuery('#baGroup').width();
    imgHeight = jQuery('#baGroup').height();

    jQuery('#canvas1').css({'width':imgWidth+'px','height':imgHeight+'px'});
    jQuery('#canvas2').css({'width':imgWidth+'px','height':imgHeight+'px'});
    jQuery('#canvas1 > .mapHold').css({'width':imgWidth+'px','height':imgHeight+'px'});
    jQuery('#canvas2 > .mapHold').css({'width':imgWidth+'px','height':imgHeight+'px'});


    baGroupTop = jQuery('#baGroup').offset().top;
    if (sliderOptions.type == 'tiles'){
        initializeMaps();
    } else if (sliderOptions.type == 'static'){
        initializeImages();
    }

    setDragger();
    //animates in the dragging mechanism
    jQuery('#canvas1').width(10).delay(400).animate({
        width: imgWidth*0.75
    }, 1000, function() {
        // Animation complete.
        jQuery(this).animate({
            width: imgWidth*0.5
        },500)
    });
    jQuery('#dragwrapper').css({'left':'2px'}).delay(400).animate({
        left: imgWidth*0.75 - 10
    }, 1000, function() {
        // Animation complete.
        jQuery(this).animate({
            left: imgWidth*0.5 - 4
        },500)
        jQuery('#baLabel1').offset({ left:jQuery('#dragBG').offset().left-jQuery('#baLabel1').width()-10 })
    });


};

function initializeImages() {
    jQuery('#canvas1').html('<img src="'+sliderOptions.leftContent+'"/>');
    jQuery('#canvas2').html('<img src="'+sliderOptions.rightContent+'"/>');
}

function initializeMaps() {

    map = L.map('canvas1', {
        center: [mapOptions.centerLat, mapOptions.centerLng],
        zoom: mapOptions.thezoom,
        zoomControl: false,
        attributionControl: false
    });
    map2 = L.map('canvas2', {
        center: [mapOptions.centerLat, mapOptions.centerLng],
        zoom: mapOptions.thezoom,
        zoomControl: true,
        attributionControl: true
    });
    map2.zoomControl.setPosition("topright");

    /* L.tileLayer('http://{s}.tile.cloudmade.com/BC9A493B41014CAABB98F0471D759707/997/256/{z}/{x}/{y}.png', {
     attribution: 'WSJ.com',
     maxZoom: 10
     }).addTo(map); */
    L.tileLayer(sliderOptions.leftContent+"/{z}-{x}_{y}.png", {
        maxZoom: mapOptions.maxzoom,
        minZoom: mapOptions.minzoom,
        errorTileUrl: 'images/blanktile.png'

    }).addTo(map);

    L.tileLayer(sliderOptions.rightContent+"/{z}-{x}_{y}.png", {
        attribution: 'WSJ.com',
        maxZoom: mapOptions.maxzoom,
        minZoom: mapOptions.minzoom,
        errorTileUrl: 'images/blanktile.png'
    }).addTo(map2);

    //Listeners: when one map changes, we coordinate them both
    map2.on('drag', function(e) {
        mapOptions.thecenter = map2.getCenter();
        changeAll(map2);
    });
    map.on('drag', function(e) {
        mapOptions.thecenter = map.getCenter();
        changeAll(map);
    });
    map2.on('move', function(e) {
        //mapOptions.thecenter = map2.getCenter();
        //changeAll(map2);
    });
    map.on('move', function(e) {
        //mapOptions.thecenter = map.getCenter();
        //changeAll(map);
    });
    map2.on('zoomend', function(e) {
        mapOptions.thezoom = map2.getZoom();
        changeAll(map2);
    });
    map.on('zoomend', function(e) {
        mapOptions.thezoom = map.getZoom();
        changeAll(map);
    });

    //sets the limits based on provided positions
    //var southWest = new L.LatLng(mapOptions.maxS, mapOptions.maxW),
    // northEast = new L.LatLng(mapOptions.maxN, mapOptions.maxE),
    // bounds = new L.LatLngBounds(southWest, northEast);
    //map.setMaxBounds( bounds );
    //map2.setMaxBounds( bounds );


};


function changeAll(whichMap){

    map2.setView(mapOptions.thecenter,mapOptions.thezoom);
    map.setView(mapOptions.thecenter,mapOptions.thezoom);

    /*if (allowedBounds.contains(map2.getCenter())) return;
     // Out of bounds - Move the map back within the bounds
     var c = map2.getCenter(),
     x = c.lng(),
     y = c.lat(),
     maxX = allowedBounds.getNorthEast().lng(),
     maxY = allowedBounds.getNorthEast().lat(),
     minX = allowedBounds.getSouthWest().lng(),
     minY = allowedBounds.getSouthWest().lat();

     if (x < minX) x = minX;
     if (x > maxX) x = maxX;
     if (y < minY) y = minY;
     if (y > maxY) y = maxY;

     map2.setCenter(new google.maps.LatLng(y, x));
     map.setCenter(new google.maps.LatLng(y, x));
     */

};



function setDragger(){
    //once maps are initialized, we add in the control handle
    jQuery('#baGroup').append('<div id="dragwrapper">'
        +'<img width="13" height="36" src="/wp-content/themes/gorod/js/beforeafter/images/barHand1.png" title="Перетащите влево или вправо" id="handle" />'
        +'<img width="10" height="12" src="/wp-content/themes/gorod/js/beforeafter/images/leftArrow.png" id="leftArrow"/>'
        +'<img width="10" height="12" src="/wp-content/themes/gorod/js/beforeafter/images/rightArrow.png" id="rightArrow"/>'
        +'<div id="dragBG"></div>'
        +'<div id="dragBG2"></div>'
        +'<div id="dragBG3"></div>'
        +'</div>'); // Create drag handle

    jQuery('#baGroup').css({'overflow':'hidden'}).width(imgWidth).height(imgHeight);

    jQuery('#dragwrapper').height(imgHeight);
    jQuery('#dragBG').height(imgHeight);
    jQuery('#dragBG2').height(imgHeight);
    jQuery('#dragBG3').height(imgHeight);
    jQuery('#leftArrow').css({'z-index':'99','position':'absolute','top':((imgHeight-(imgHeight/4)))-8+'px','left':'0px'}).hide();
    jQuery('#rightArrow').css({'z-index':'99','position':'absolute','top':((imgHeight-(imgHeight/4)))-8+'px','left':'0px'}).hide();

    jQuery('#handle').css({'z-index':'100','position':'relative','cursor':'pointer','top':((imgHeight-(imgHeight/4))-(jQuery('#handle').height()/2)-2)+'px','left':'0px','opacity':'1'});


    if(sliderOptions.leftLabel) jQuery('#dragwrapper').append('<div id="baLabel1" class="baLabels unselectable">'+sliderOptions.leftLabel+'</div>');
    if(sliderOptions.rightLabel) jQuery('#dragwrapper').append('<div id="baLabel2" class="baLabels unselectable">'+sliderOptions.rightLabel+'</div>');
    jQuery('#baLabel1').offset({ top:baGroupTop+imgHeight-24, left:jQuery('#dragBG').offset().left-jQuery('#baLabel1').width()-10 })
    jQuery('#baLabel2').offset({ top:baGroupTop+imgHeight-24, left:jQuery('#handle').offset().left+8 })

    //testing for touch device
    if (Modernizr.touch){
        // bind to touchstart, touchmove, etc and watch `event.streamId`
        dragControlTouch();
    } else {
        // bind to normal click, mousemove, etc
        dragControlNoTouch();
    }

}

function dragControlTouch(){
    jQuery('#dragwrapper').bind("touchstart touchmove", function(e) {
        //Disable scrolling by preventing default touch behaviour
        e.preventDefault();
        jQuery('#handle').show();
        var orig = e.originalEvent;
        var x = orig.changedTouches[0].pageX;
        var y = orig.changedTouches[0].pageY;
        //alert(orig+": "+x+", "+y);
        if (x > jQuery('#canvas2').offset().left + 26 && x < jQuery('#canvas2').offset().left + jQuery('#canvas2').width()-20){
            jQuery('#dragwrapper').css({left: x});
            jQuery('#canvas1').width(x+0);
        }
    });
    jQuery('#dragwrapper').bind("touchend", function(e) {
        //jQuery('#handle').delay(1000).fadeOut(500);
        checkAlignment();
        runArrows();
    });

    ScaleFix.init();

    window.onorientationchange = function(){
        //resets the slider if the orientation changes
        jQuery(sliderOptions.container).html('');
        sliderBegin();
    }


}

function dragControlNoTouch(){

    jQuery('#handle').delay(4000).fadeOut(500);
    jQuery('#handle').hover(function(){
        jQuery(this).css("cursor","url('/wp-content/themes/gorod/js/beforeafter/images/sCurs.png'), move")}, function(){
        jQuery(this).css("cursor","auto");
    });
    jQuery('#baGroup').mouseenter(function() {
        runArrows();
    });
    jQuery('#baGroup').mouseleave(function() {
        jQuery('#leftArrow').hide();
        jQuery('#rightArrow').hide();
    });
    jQuery('#dragwrapper').hover(function() {
        jQuery('#handle').show();
    });
    jQuery('#dragwrapper').draggable({
        containment: "parent",
        scroll: false,
        axis:'x',
        drag:function(e, ui){
            var barPosition = jQuery(this).offset().left + 6 - 0 - leftPos;
            jQuery('#canvas1').width(barPosition);

        },
        stop:function(e, ui){
            checkAlignment();
        }
    });

    window.onresize = function(event) {
        leftPos = jQuery(sliderOptions.container).offset().left;
    }
    //jQuery('#container').mouseup(function() {
    //checkAlignment();
    //});
}

function checkAlignment(){
    leftPos = jQuery(sliderOptions.container).offset().left;

    var barPosition = jQuery('#dragwrapper').offset().left + 6 - 0 - leftPos;
    jQuery('#canvas1').width(barPosition);

    if (barPosition >= jQuery(sliderOptions.container).width() - 30){
        jQuery('#canvas1').animate({
            width: imgWidth*0.85
        }, 200);
        jQuery('#dragwrapper').animate({
            left: imgWidth*0.85 - 10
        }, 200);
    } else if (barPosition <= 30){
        jQuery('#canvas1').animate({
            width: imgWidth*0.15
        }, 200);
        jQuery('#dragwrapper').animate({
            left: imgWidth*0.15 - 10
        }, 200);
    }
}

function runArrows(){
    jQuery('#leftArrow').css({'left':'0px'});
    jQuery('#rightArrow').css({'left':'0px'});
    jQuery('#handle').show();
    jQuery('#leftArrow').fadeIn(400).animate({
        left: '-30',
        'filter': ''
    }, 400, function() {
        jQuery(this).fadeOut(800);
    });
    jQuery('#rightArrow').fadeIn(400).animate({
        left: '32',
        'filter': ''
    }, 400, function() {
        jQuery(this).fadeOut(800);
    });
}

var ScaleFix = {
    viewportmeta : document.querySelector && document.querySelector('meta[name="viewport"]'),
    ua : navigator.userAgent,
    gestureStart : function() {
        ScaleFix.viewportmeta.content = "width=device-width, minimum-scale=0.25, maximum-scale=1.6";
    },
    init : function() {
        if(ScaleFix.viewportmeta && /iPhone|iPad/.test(ScaleFix.ua) && !/Opera Mini/.test(ScaleFix.ua)) {
            ScaleFix.viewportmeta.content = "width=device-width, minimum-scale=1.0, maximum-scale=1.0";
            document.addEventListener("gesturestart", ScaleFix.gestureStart, false);
        }
        window.onorientationchange = function() {
            document.body.scrollLeft = 0;
        };
    }
};
