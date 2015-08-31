
/* определим тип браузера */   
	var bIE=0;bOp=0;bFF=0;
	var verBr=navigator.userAgent;
	if (verBr.indexOf("Opera")!=-1)
	     bOp=1;
	  else 
	   {
	   if (verBr.indexOf("MSIE")!=-1)
	      bIE=1;
	    else
		 {
	      //if (verBr.indexOf("Firefox")!=-1)
	        bFF=1;
		 }
	   }

function move_div(id_div_okno,id_div_zagol)
  {
    this.id_div_okno=id_div_okno;
    this.id_div_zagol=id_div_zagol;
    this.obj_okno=document.getElementById(this.id_div_okno);

    this.obj_zagol_okno=document.getElementById(this.id_div_zagol);
    this.delta_x=0;
    this.delta_y=0;
    
    this.setup_mouse = function()
      {
       var self=this;
       this.obj_zagol_okno.onmousedown=function(o){ self.save_delta_koor(self,o) };
       if (bOp || bFF)
         {
          this.obj_zagol_okno.addEventListener("onmousedown",self.save_delta_koor,false);
          
         }
       
       //this.obj_zagol_okno.onmouseup=self.clear_delta_koor;
       document.onmouseup=self.clear_delta_koor;
      }
    
    this.save_delta_koor = function(obj_move,obj_evt)
      {
       
       
       if (obj_evt)
         {
          x=obj_evt.pageX;
          y=obj_evt.pageY;
         }
        else
          {
           x=window.event.clientX;
           y=window.event.clientY;
           if (bIE)
             {
              y-=2;
              x-=2;
             }
           
          }
           
       x_okno=obj_move.obj_okno.offsetLeft;
       y_okno=obj_move.obj_okno.offsetTop;
       
       obj_move.delta_x=x_okno-x;
       obj_move.delta_y=y_okno-y;
       
       
       document.onmousemove=function(o){ obj_move.motor_okno(obj_move,o) };
       if (bOp || bFF)
         document.addEventListener("onmousemove",obj_move.motor_okno,false);
       
      }
     
    this.clear_delta_koor = function()
      {
       document.onmousemove=null;
       //setup_mouse();
       
      }
     
    this.motor_okno = function(obj_move,obj_event)
      {
       
       if (obj_event)
         {
          x=obj_event.pageX;
          y=obj_event.pageY;
         }
        else
          {
           x=window.event.clientX;
           y=window.event.clientY;
           if (bIE)
             {
              y-=2;
              x-=2;
             }
           
          }
       new_x=obj_move.delta_x+x;
       new_y=obj_move.delta_y+y;
       
       //window.status=new_x+" "+new_y;
       
       obj_move.obj_okno.style.top=new_y+"px";
       obj_move.obj_okno.style.left=new_x+"px";
       
      }
   
   this.setup_mouse();
  }