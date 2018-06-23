<!DOCTYPE html>
<html>
<head>
<style><!--Стили-->
input[type="submit"]{height: 30;}
button{height: 30;}
.sma  {/*margin-bottom:-15px;*/padding: 8px 5px;}
.ok   {background: #F0E4E4;border: 1px solid #D6CBCB;}
.nav1  {background: #C0F7FF;border: 1px solid #3C6BFF;}
.check{background: #e4f0e8;border: 1px solid #D6CBCB;}
.smen {background: #D7F3EB;border: 1px solid #cbd6cf;}
.sbor {background: #F0F0E4;border: 1px solid #cbd6cf;}
.bri  {background: #CEC6BA;border: 1px solid #D4BCBC;}
#cont {padding: 30px;background: #ffffff;}
html { overflow:  hidden; }
img {margin: 10px;display: inline-block;}
.img-polaroid {padding: 4px;background-color: #fff;border: 1px solid #ccc;border: 1px solid rgba(0, 0, 0, 0.2);-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);}
.img{display:block;}
.img1{display:none;}
@charset "UTF-8";
@import url(http://fonts.googleapis.com/css?family=Montserrat);
.flat {
  font-family: 'Montserrat';
  text-transform: uppercase;
  border: none;
  text-align: center;
  outline: none;
  cursor: pointer;
  color: #fafafa;
  margin-bottom: 5px;
}
.flat.xs {
  padding: 3px 9px;
  font-size: 13px;
}
.flat.sm {
  padding: 9px 12px;
  font-size: 13px;
}
.flat.md {
  padding: 12px 15px;
  font-size: 13px;
}
.flat.lg {
  padding: 15px 24px;
  font-size: 15px;
}
.flat:active {
  position: relative;
  top: 2px;
}
.flat.grey {
  background-color: #5a5a5a;
  -webkit-box-shadow: 0px 3px 0px #484848;
  -moz-box-shadow: 0px 3px 0px #484848;
  box-shadow: 0px 3px 0px #484848;
}
.flat.grey:active {
  -webkit-box-shadow: 0px 1px 0px #5a5a5a;
  -moz-box-shadow: 0px 1px 0px #5a5a5a;
  box-shadow: 0px 1px 0px #5a5a5a;
}
.flat.grey:hover {
  background-color: #555555;
}
.flat.green {
  background-color: #0aa699;
  -webkit-box-shadow: 0px 3px 0px #08847a;
  -moz-box-shadow: 0px 3px 0px #08847a;
  box-shadow: 0px 3px 0px #08847a;
}
.flat.green:active {
  -webkit-box-shadow: 0px 1px 0px #0aa699;
  -moz-box-shadow: 0px 1px 0px #0aa699;
  box-shadow: 0px 1px 0px #0aa699;
}
.flat.green:hover {
  background-color: #099d91;
}
.flat.purple {
  background-color: #6a598d;
  -webkit-box-shadow: 0px 3px 0px #544770;
  -moz-box-shadow: 0px 3px 0px #544770;
  box-shadow: 0px 3px 0px #544770;
}
.flat.purple:active {
  -webkit-box-shadow: 0px 1px 0px #6a598d;
  -moz-box-shadow: 0px 1px 0px #6a598d;
  box-shadow: 0px 1px 0px #6a598d;
}
.flat.purple:hover {
  background-color: #645485;
}
.flat.navy-blue {
  background-color: #22262e;
  -webkit-box-shadow: 0px 3px 0px #1b1e24;
  -moz-box-shadow: 0px 3px 0px #1b1e24;
  box-shadow: 0px 3px 0px #1b1e24;
}
.flat.navy-blue:active {
  -webkit-box-shadow: 0px 1px 0px #22262e;
  -moz-box-shadow: 0px 1px 0px #22262e;
  box-shadow: 0px 1px 0px #22262e;
}
.flat.navy-blue:hover {
  background-color: #20242b;
}
.flat.pink {
  background-color: #f35958;
  -webkit-box-shadow: 0px 3px 0px #c24746;
  -moz-box-shadow: 0px 3px 0px #c24746;
  box-shadow: 0px 3px 0px #c24746;
}
.flat.pink:active {
  -webkit-box-shadow: 0px 1px 0px #f35958;
  -moz-box-shadow: 0px 1px 0px #f35958;
  box-shadow: 0px 1px 0px #f35958;
}
.flat.pink:hover {
  background-color: #e65453;
}
.flat.blue {
  background-color: #0090d9;
  -webkit-box-shadow: 0px 3px 0px #0073ad;
  -moz-box-shadow: 0px 3px 0px #0073ad;
  box-shadow: 0px 3px 0px #0073ad;
}
.flat.blue:active {
  -webkit-box-shadow: 0px 1px 0px #0090d9;
  -moz-box-shadow: 0px 1px 0px #0090d9;
  box-shadow: 0px 1px 0px #0090d9;
}
.flat.blue:hover {
  background-color: #0088ce;
}
.flat.yellow {
  background-color: #fdd01c;
  -webkit-box-shadow: 0px 3px 0px #caa616;
  -moz-box-shadow: 0px 3px 0px #caa616;
  box-shadow: 0px 3px 0px #caa616;
}
.flat.yellow:active {
  -webkit-box-shadow: 0px 1px 0px #fdd01c;
  -moz-box-shadow: 0px 1px 0px #fdd01c;
  box-shadow: 0px 1px 0px #fdd01c;
}
.flat.yellow:hover {
  background-color: #f0c51a;
}
</style>
</head>
<body style="background-color: #DDDCEE;">
<meta http-equiv="content-type" content="charset=utf-8">

<center>
<span style="font-family:comic sans ms,cursive;color: #FF0A0A;cursor: context-menu;">Меню</span>
<div class="bri sma">  
	<a href='index.php' onMouseOver="document.getElementById('index').className='img img-polaroid'" onMouseOut="document.getElementById('index').className='img1'"><input type='submit' class="flat sm blue" value='Работа с фейками'></a>
	<a href='brigada.php' onMouseOver="document.getElementById('brigada').className='img img-polaroid'" onMouseOut="document.getElementById('brigada').className='img1'"><input type='submit' class="flat sm blue" value='Работа с бригадами'></a><br>
	<a href='activ.php' onMouseOver="document.getElementById('activ').className='img img-polaroid'" onMouseOut="document.getElementById('activ').className='img1'"><input type='submit' class="flat sm blue" value='Работа с активом'></a>
	<a href='free_n.php' onMouseOver="document.getElementById('free_n').className='img img-polaroid'" onMouseOut="document.getElementById('free_n').className='img1'"><input type='submit' class="flat sm blue" value='Получить 100 нычек'></a><br>
	<a href='podogrev.php' onMouseOver="document.getElementById('podogrev').className='img img-polaroid'" onMouseOut="document.getElementById('podogrev').className='img1'"><input type='submit' class="flat sm blue" value='Отправка подогрева'></a>
	<a href='obshak_checker.php' onMouseOver="document.getElementById('obshak_checker').className='img img-polaroid'" onMouseOut="document.getElementById('obshak_checker').className='img1'"><input type='submit' class="flat sm blue" value='Чекер общака'></a><br>
	<a href='vpar.php' onMouseOver="document.getElementById('vpar').className='img img-polaroid'" onMouseOut="document.getElementById('vpar').className='img1'"><input type='submit' class="flat sm blue" value='Впарить нычки'></a>
	<a href='chest.php' onMouseOver="document.getElementById('chest').className='img img-polaroid'" onMouseOut="document.getElementById('chest').className='img1'"><input type='submit' class="flat sm blue" value='Открыть сундуки с воркуты'></a><br>
	<br>
		<a href='/index.php'><input type='submit' class="flat sm green" value='На главную'></a><br>
	<br>
	<center>
		<img id='activ' src='scr/activ.PNG' class='img1'>
		<img id='brigada' src='scr/brigada.PNG' class='img1'>
		<img id='index' src='scr/index.PNG' class='img1'>
		<img id='free_n' src='scr/free_n.PNG' class='img1'>
		<img id='podogrev' src='scr/podogrev.PNG' class='img1'>
		<img id='obshak_checker' src='scr/obshack_check.PNG' class='img1'>
		<img id='vpar' src='scr/vpar.PNG' class='img1'>
		<img id='chest' src='scr/chest.PNG' class='img1'>
	</center>
</div>
</center>

	<div class="ok sma">
		<a href="http://vk.com/rzn_fantik" target="_blank">
			<font color=red>[RZN]Fantik</font>
		</a>  
	</div>
</body>
</html>