<div style="/*float: right;*/
  width: 297px;
  /*margin-top: -1116px;*/
  display: block;
  overflow: hidden;
  height: 1120px;">
<div style="overflow:hidden; height: 1095px;">
<div style=" display:block; padding:0px; margin-bottom:20px; height:90px;  border: 1px #E8E8E8 solid;">        
<?php get_banner("som1min"); ?>
</div>

<div style="display:block; margin-bottom: 20px;  height: 353px; overflow: hidden;">
<?php get_banner("som3"); ?>
</div>

<div style=" display:block; padding:10px 20px; background-color:#EEE;">        
<?php if( function_exists('democracy_poll') ){ ?>
        <ul>
            <li><?php democracy_poll();?></li>
        </ul>
<?php } ?>
</div>
</div>
</div>