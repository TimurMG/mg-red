<?php 
/*
Template Name: Voute
*/
get_header(); 
?>

<div class="mfo" id="mfo">



<img src="http://mgorod.kz/wp-content/uploads/2015/04/close-mfo.png" onClick="document.getElementById('mfo').style.display='none';" style="position:absolute; cursor:pointer; top:207px; right: 20px; z-index:1000;">

<div  onClick="document.getElementById('zakaz-onur').style.display='block';" style="position:absolute; cursor:pointer; top:198px; right: 180px; z-index:1000;  width:100px; height:30px;">

&nbsp;

</div>

<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="100%" height="100%" id="test" align="middle">

	<param name="allowScriptAccess" value="sameDomain" />

	<param name="allowFullScreen" value="true" />

    <param name="wmode" value="opaque">

	<param name="movie" value="http://mgorod.kz/wp-content/uploads/2015/04/mfo-home2.swf" /><param name="menu" value="false" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />	<embed src="http://mgorod.kz/wp-content/uploads/2015/04/mfo-home2.swf" menu="false" WMODE="transparent" quality="high" bgcolor="#ffffff" width="300" height="250" name="test" align="middle" allowScriptAccess="sameDomain" allowFullScreen="true" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer_ru" />

	</object>



</div>









<div id="zakaz-onur" style=" z-index:1000; display:none; font-family:Tahoma, Geneva, sans-serif; background-color:rgba(0,0,0,0.5); padding:20px; position:fixed; top:0px; left:0px; width:100%; height:100%;"> 















<table border="0" align="center" style="width:100%; height:100%;"> 







<tr> 







<td width="33%">&nbsp; 







 







</td> 







<td> 







<div style="width:560px; background-color:#EEE; border-radius:10px; border:10px #FFF solid; box-shadow:0 0 4px -1px #000; overflow:hidden;"> 















<div style="position:relative; display:block; padding:10px; height:20px; background-color:#FFF;"> 







<h3 style="float:left; left: 10px; position: relative; font-weight: bold; margin-top:0px;">Заполните форму</h3> <span style="cursor: pointer; float: right; font-size: 12px; padding: 5px; border-radius: 50px; color: #FFF; position: relative; top: -10px; right: -10px; background-color: rgb(194, 49, 49);" onClick="document.getElementById('zakaz-onur').style.display='none';"><img src="http://mgorod.kz/wp-content/uploads/2015/01/close-MFO.png" width="20"></span> 







</div> 















<div style="padding:20px;"> 















<p> 







<div style="padding:15px; background-color:#D02C2A; color:#fff; font-size:12px;">







<img src="http://mgorod.kz/wp-content/uploads/2015/01/attention.png" style="float:left; padding: 5px; margin-right: 5px;">тел. для справок 24-30-04,  50-93-46   <br>сот. +7 777 8724377  +77762244101  <br>ул.Д.Нурпейсовой 12/1







</div>























<script type='text/javascript'>







function validate(){







   //Считаем значения из полей name и email в переменные x и y







   var x=document.forms['form']['fio'].value;







   var y=document.forms['form']['tel'].value;







   var z=document.forms['form']['summa'].value;















   if (x.length==0){







      document.getElementById('fiof').innerHTML='*Заполните это поле';







      return false;







   }















   if (y.length==0){







      document.getElementById('telf').innerHTML='*Заполните это поле';







      return false;







   }















   if (z.length==0){







      document.getElementById('summaf').innerHTML='*Заполните это поле';







      return false;







   }







   







}







</script>







<form name="form" onSubmit="return validate(this)" method="post" action="../../add_online.php"> 







<table border="0" cellpadding="0" cellspacing="0" width='100%'> 







<tr> 







<td style='padding:10px 0; width:100%;'> 







Имя:







<br><small class="smal-txt">Пример: Федоров Федор Федорович</small>







</td> 







<td style='padding:10px 0;'> 







<input type="text" name="fio" class="form-in"> 







<span style="color:red; font-size:12px;" id="fiof"></span>







</td> 







</tr> 







<tr> 







<td style='padding:10px 0;'> 







Тел/Сот: <br>







<small class="smal-txt">Пример: 8(000) 000-00-00</small>







</td> 







<td style='padding:10px 0;'> 







<input type="text" name="tel" class="form-in"> 







<span style="color:red; font-size:12px;" id="telf"></span>







</td> 







</tr> 







<tr> 







<td style='padding:10px 0;'> 







Сумма кредита:<br>







<small class="smal-txt">от 100 тыс до 15 млн</small> 







</td> 







<td style='padding:10px 0;'> 







<input type="text" name="summa" class="form-in">







<span style="color:red; font-size:12px;" id="summaf"></span> 







</td> 







</tr>  







<tr> 







<td style='padding:10px 0;'> 







Срок: 







</td> 







<td style='padding:10px 0;'> 







<select class="form-in" name="srok" >







<option value="3 месяца">3 месяца</option>







<option value="6 месяцев">6 месяцев</option>







<option value="9 месяцев">9 месяцев</option>







<option value="12 месяцев">12 месяцев</option>















<option value="15 месяца">15 месяца</option>







<option value="18 месяцев">18 месяцев</option>







<option value="21 месяц">21 месяц</option>







<option value="24 месяца">24 месяца</option>















<option value="27 месяцев">27 месяцев</option>







<option value="30 месяцев">30 месяцев</option>















</select> 







</td> 







</tr> 







</table> 







<input type="submit" name="submit" value="Расчитать кредит" style="padding:10px; border:1px #069 solid; background-color:#06C; cursor:pointer; color:#FFF;">







<noindex><a rel="nofollow" href="http://credital.kz/" style="margin-left:135px; font-size:12px;">www.Credital.kz</a></noindex>







</form> 







</p> 







</div> 















</div> 







</td> 







<td width="33%">&nbsp; 







 







</td> 







</tr> 







</table> 















</div>























































    <div class="main"> 































        <div class="left"> 















            <div class="single single-news"> 







                <?php while (have_posts()) : the_post(); ?> 







                    <div class="breadcrumbs"><?php get_news_breadcrumbs(); ?></div> 







                    <h1 class="title"><?php the_title(); ?></h1> 







                    <div class="tools"> 







                        <span class="date"><?php echo get_date_formatted(get_the_date('d.m.Y.H.i')); ?></span> 







                        <span class="comments"><i class="comments-ico"></i><?php comments_number('0', '1', '%'); ?></span> 















<? 















$db = mysql_connect("localhost","mgorod_kz","BepSjq2YyAMLzTpJ");







mysql_select_db("mgorod_kz",$db);















function vernut_tekuchii_URL() {







    $tekuchaiya_ssilka  = 'http';







    $https_servera = $_SERVER["HTTPS"];







    $imya_servera  = $_SERVER["SERVER_NAME"];







    $port_servera  = $_SERVER["SERVER_PORT"];







    $ssika_zaprosa  = $_SERVER["REQUEST_URI"];







    if ($https_servera == "on") 







        $tekuchaiya_ssilka .= "s";







    $tekuchaiya_ssilka .= "://";







    if ($port_servera != "80") {







        $tekuchaiya_ssilka .= $imya_servera . ":" . $port_servera . $ssika_zaprosa;







    } else {







        $tekuchaiya_ssilka .= $imya_servera . $ssika_zaprosa;







    }







    return $tekuchaiya_ssilka;







}







 







// Вызов:







$tit = vernut_tekuchii_URL();















if($tit == 'http://mgorod.kz/nitem/studenty-evrazii-umeyut-xorosho-provodit-vremya-2/') {echo'<span class="views"><i class="views-ico"></i> 2096</span>';}







else { 







?>















<span class="views"><i class="views-ico"></i><?php $views = get_post_meta(get_the_ID(), 'views', true); echo (empty($views)) ? '0' : $views; ?></span> 















<? } ?>







                        <span class="print"><a href="/"><i class="print-ico"></i>Версия для печати</a></span> 







                    </div> 







                    <?php global $post; ?>












                    <?php if(has_excerpt() && !has_term('other','ncategory', $post)) :  ?>







                    <div class="excerpt"><?php the_excerpt(); ?></div> 







                    <?php endif; ?> 















                    <div class="single-news-content"><?php the_content(); ?></div>




<?php if( function_exists('democracy_poll') ){ ?>
    
        
        <ul>
            <li><?php democracy_poll();?></li>
        </ul>
    
<?php } ?>


<script type="text/javascript">(function() {
  if (window.pluso)if (typeof window.pluso.start == "function") return;
  if (window.ifpluso==undefined) { window.ifpluso = 1;
    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
    var h=d[g]('body')[0];
    h.appendChild(s);
  }})();</script>
<div class="pluso" data-background="transparent" data-options="medium,square,line,horizontal,nocounter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir"></div>
<div style=" padding:20px; display:block; height:10px; width:100%;">
&nbsp;
</div>

                    <div style="margin-left: -5000px;"><?php echo get_post_meta(get_the_ID(), 'nws_links', true) ?></div>















                    <?php $tags = wp_get_post_terms( get_the_ID(), 'ntag');  ?> 







                    <?php if(count($tags) > 0 ) : ?> 







                        <div class="tags"> 







                            <?php foreach($tags as $tag) : ?> 







                                <a href="<?php echo get_term_link($tag->slug, 'ntag') ?>"><?php echo $tag->name; ?></a> 







                            <?php endforeach; ?> 







                        </div> 







                    <?php endif; ?> 















                <?php endwhile; ?> 







                <div class="banner banner-880x110" id="banner-880x110"> 







                    <?php get_banner("banner-880x110"); ?> 







                </div> 







            </div> 







            <?php get_template_part('related-news'); ?> 















            <?php comments_template(); ?> 







        </div> 







        <div class="right"> 







            <?php get_template_part('right-sidebar'); ?> 







        </div> 







    </div> 















<?php 







get_footer();