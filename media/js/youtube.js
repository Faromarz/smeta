var i,c,y,v,s,n,skrin;
v=document.getElementsByClassName("youtube");

if(v.length>0){s=document.createElement("style");
    s.type="text/css";
    s.innerHTML='.youtube{background-color:#000;max-width:100%;overflow:hidden;position:relative;cursor:hand;cursor:pointer}.youtube .thumb{bottom:0;display:block;left:0;margin:auto;max-width:100%;position:absolute;right:0;top:0;width:100%;height:auto}.youtube .play{filter:alpha(opacity=80);opacity:1;height:82px;left:50%;margin-left:-41px;margin-top:-41px;position:absolute;top:50%;width:82px;background:url("media/img/play.png") no-repeat}';
    document.body.appendChild(s)}

for(n=0;n<v.length;n++){y=v[n]; if (y.id == 'c4XskGvAM4k') {skrin='video1';} else {skrin='video2'} i=document.createElement("img");i.setAttribute("src","media/img/"+skrin+".jpg"); i.setAttribute("class","thumb");c=document.createElement("div");c.setAttribute("class","play");y.appendChild(i);y.appendChild(c);y.onclick=function(){var a=document.createElement("iframe");a.setAttribute("src","https://www.youtube.com/embed/"+this.id+"?autoplay=1&autohide=1&border=0&wmode=opaque&enablejsapi=1");
    a.style.width=this.style.width;a.style.height=this.style.height;this.parentNode.replaceChild(a,this)}};