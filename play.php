
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Bacon Clicker">
    <meta name="author" content="William Huang">
    <title>Bacon Clicker</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
  </head>
  <body>  
  <script type="text/javascript">
	  var bacon = 0;
	  var egg = 0;
	  var additionalClicks = 0;
	  var additionalClicks_eggs = 0;
	  var init = 0;
  </script>
  <style>
	.egg-stuff{display:none}
  </style>
    <div class="container-fluid">
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Bacon Clicker</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="index">Home</a></li>
				<li class="active"><a href="play">Play</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" data-toggle="modal" data-target="#myModal">About</a></li>
				<li><a>Rankings (Coming Soon)</a></li><!-- todo: show modal with a json table with results -->
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Settings<span class="caret"></span>   </a>
				<ul class="dropdown-menu" role="menu"> <!-- todo: create login system -->
					<li><a href="#" data-toggle="modal" data-target="#resetModal">Reset Game</a></li>
				</ul>
				</li>
			</ul>
			</div><!--/.nav-collapse -->
		</nav>
		<div class="row" style="margin-top:50px;"> <!-- using inline css because yolo -->
			<div class="col-md-6" style="text-align:center;"><!-- bacon image -->
				<div style="margin-bottom:30px"></div><!--empty space -->
				<p id="firstrun" class="bg-primary" style="padding:10px;font-size:2em">Why haven't you clicked the bacon yet? It's freaking bacon!!!1111</p>
				<div id="firstrun" style="margin-bottom:30px;"></div><!--empty space -->
				<img id="bacon" class="img-responsive" style="margin: 0 auto;" src="img/bacon.png">
				<div class="egg-stuff">
					<div class="col-md-6" style="text-align:right;font-size:3em;">
						<img id="bacon2" class="img-responsive" style="margin: 0 auto;" src="img/bacon.png">
					</div>
					<div class="col-md-6" style="text-align:right;font-size:3em;">
						<img id="egg" class="img-responsive" style="margin: 0 auto;" src="img/egg.png">
					</div>
				</div>
				<div style="margin-bottom:30px"></div><!--empty space -->
				<div class="col-md-6" style="text-align:right;font-size:3em;">
					<div><span id="plusone" style="color:darkgreen;display:none;">+1</span> <span id="bacon-value">0</span></div>
				</div>
				<div class="col-md-6" style="text-align:left;font-size:3em;">
					<strong>Bacons</strong>
				</div>
				<div class="egg-stuff">
					<div class="col-md-6" style="text-align:right;font-size:3em;">
						<div><span id="plusone_egg" style="color:darkgreen;display:none;">+1</span> <span id="egg-value">0</span></div>
					</div>
					<div class="col-md-6" style="text-align:left;font-size:3em;">
						<strong>Eggs</strong>
					</div>
				</div>
				<div class="col-md-12" style="text-align:center;font-size:1.5em;">
					<span id="moarbacon" style="color:darkred;display:none;">Not enough bacon, click the bacon for more bacon!</strong>
				</div>
				<div class="col-md-12" style="text-align:center;font-size:1.5em;">
					<span id="moareggs" style="color:darkred;display:none;">Not enough eggs, click the egg for more eggs!</strong>
				</div>
				<div class="col-md-12">
					<p>BPS (Bacon Per Second): <span id="debug-click">0</span><span class="egg-stuff"> / EPS (Eggs Per Second): <span id="debugEgg-click">0</span></span></p>
				</div>
			</div>
			<div class="col-md-3"><!-- shop section -->
				<div class="panel panel-primary" style="max-height: 80%;overflow-y: scroll;">
					<div class="panel-heading"><h4 class="panel-title">Shop</h4></div>
					<div class="panel-body scrollable large">
						<ul class="media-list media-list-no-margin">
							<li class="media">
								<div class="media-body">
									<h4 class="media-heading">Bacon bits</h4>
									<p>The more bacon the better, no matter how big the bits are.</p>
									<p class="small">+0.1 BPS</p>
									<button class="btn btn-primary" onclick="buyItem('bacon', 10, 0.1);">Use 10 Bacons</button>
								</div>
								<div class="media-body">
									<h4 class="media-heading">Scrambled Eggs</h4>
									<p>Tiny chunks of eggs are scrambling all over the place, yikes!</p>
									<p class="small">+0.5 EPS</p>
									<button class="btn btn-primary" onclick="buyItem('egg', 30, 0.5);">Use 30 Eggs</button>
								</div>
							</li>
							<li class="media">
								<div class="media-body">
									<h4 class="media-heading">Bacon chef</h4>
									<p>A chef hired specifically to make more bacon.</p>
									<p class="small">+1 BPS</p>
									<button class="btn btn-primary" onclick="buyItem('bacon', 15, 1);">Use 15 Bacons</button>
								</div>
								<div class="media-body">
									<h4 class="media-heading">Omelette du Fromage</h4>
									<p>Omelette du Fromage.</p>
									<p class="small">+3 EPS</p>
									<button class="btn btn-primary" onclick="buyItem('egg', 50, 3);">Use 50 Eggs</button>
								</div>
							</li>
							<li class="media">
								<div class="media-body">
									<h4 class="media-heading">Super Bacon Man</h4>
									<p>Use the power of the glorious bacon man to help you get some more of the dagnabbin' bacon!</p>
									<p class="small">+3 BPS</p>
									<button class="btn btn-primary" onClick="buyItem('bacon', 20, 3);">Use 20 Bacons</button>
								</div>
								<div class="media-body">
									<h4 class="media-heading">Eggcellent Eggs</h4>
									<p>Only the most eggceptional eggs of them all are worthy of your time.</p>
									<p class="small">+6 EPS</p>
									<button class="btn btn-primary" onclick="buyItem('egg', 85, 6);">Use 85 Eggs</button>
								</div>
							</li>
							<li class="media">
								<div class="media-body">
									<h4 class="media-heading">Crazy Bacon Lady</h4>
									<p>Call forth the crazy bacon lady to get a ridiculous amount of bacon.</p>
									<p class="small">+15 BPS</p>
									<button class="btn btn-primary" onClick="buyItem('bacon', 35, 15);">Use 35 Bacons</button>
								</div>
								<div class="media-body">
									<h4 class="media-heading">Eggsperimental Eggs</h4>
									<p>Is it just me or are these eggs glowing red?</p>
									<p class="small">+18.5 EPS</p>
									<button class="btn btn-primary" onclick="buyItem('egg', 100, 18.5);">Use 100 Eggs</button>
								</div>
							</li>
							<li class="media">
								<div class="media-body">
									<h4 class="media-heading">Bacon Launcher</h4>
									<p>Launch cannons filled with barrels of bacon into the air.</p>
									<p class="small">+35 BPS</p>
									<button class="btn btn-primary" onClick="buyItem('bacon', 50, 35);">Use 50 Bacons</button>
								</div>
								<div class="media-body">
									<h4 class="media-heading">[insert punny egg joke here]</h4>
									<p>[insert lame description]</p>
									<p class="small">+40 EPS</p>
									<button class="btn btn-primary" onclick="buyItem('egg', 100, 18.5);">Use 120 Eggs</button>
								</div>
							</li>
							<li class="media">
								<div class="media-body">
									<h4 class="media-heading">Bakin' Pig</h4>
									<p>Why did the pig go into the kitchen? He felt like bacon.</p>
									<p class="small">+65 BPS</p>
									<button class="btn btn-primary" onClick="buyItem('bacon', 85, 65);">Use 85 Bacons</button>
								</div>
								<div class="media-body">
									<h4 class="media-heading">Chicken or the Egg?</h4>
									<p>Which comes first?</p>
									<p class="small">+65 EPS</p>
									<button class="btn btn-primary" onClick="buyItem('egg', 85, 65);">Use 150 Eggs</button>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-3"><!-- TODO: upgrades section -->
				<div class="panel panel-primary">
					<div class="panel-heading"><h4 class="panel-title">Upgrades</h4></div>
					<div class="panel-body scrollable large">
						<ul class="media-list media-list-no-margin">
							<li class="egg-stuff text-center"><p>No upgrades are available.</p></li>
							<li class="media hide-egg">
								<div class="media-body">
									<h4 class="media-heading">IT'S TIME FOR EGGS</h4>
									<p>THE END IS NEAR. EGGS. ERRMERRGERD.</p>
									<p class="small">EGGS.</p>
									<button class="btn btn-primary" onClick="buyUpgrade(1000, 0, 1);">Use 1000 Bacons</button>
								</div>
							</li>
							<!-- TODO
							<li class="media">
								<div class="media-body">
									<h4 class="media-heading">The Old Switcheroo</h4>
									<p>Lightning strikes and things are switched around temporarily. Bacons are now eggs! Eggs are now bacons! IT'S MADNESS.</p>
									<p class="small">BPS and EPS gain in the Shop switch places temporarily (Ex: Bacon bits give +0.1 EPS)</p>
									<button class="btn btn-primary" onClick="blablablablablabla">Use 800 Bacons and 950 Eggs</button>
								</div>
							</li>
							-->
							<!--
							<li class="media">
								<div class="media-body">
									<h4 class="media-heading">BPS X2</h4>
									<p>All bacon gain is X2</p>
									<p class="small">BPS X2 for </p>
									<button class="btn btn-primary" onClick="">Use 500 Bacons</button>
								</div>
								<div class="media-body">
									<h4 class="media-heading">EPS X2 (temp)</h4>
									<p>Eggs X2</p>
									<p class="small">EPS X2</p>
									<button class="btn btn-primary" onClick="">Use 650 Eggs</button>
								</div>
							</li>
							<li class="media">
								<div class="media-body">
									<h4 class="media-heading">BPS X3 (temp)</h4>
									<p>Bacon X3</p>
									<p class="small">BPS X3</p>
									<button class="btn btn-primary" onClick="">Use 700 Bacons</button>
								</div>
								<div class="media-body">
									<h4 class="media-heading">EPS X3 (temp)</h4>
									<p>Eggs X3</p>
									<p class="small">EPS X3</p>
									<button class="btn btn-primary" onClick="">Use 850 Eggs</button>
								</div>
							</li>
							-->
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-12 text-center">
				<p>&copy; <script type="text/javascript">var year = new Date();document.write(year.getFullYear());</script> William Huang. All Rights Reserved.</p>
			</div>
      </div>

    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Bacon Clicker</h4>
          </div>
          <div class="modal-body">
            <h4>About</h4>
            <p class="small">Version: 0.2 (Last update: May 1, 2015 12:40AM PDT)</p>
            <p class="small bg-warning">Warning: This game is still in development.</p>
            <p>Bacon Clicker is a (you guessed it!) bacon clicking game created by William Huang for a project for a class in Oakland Technical High School. The inspiration for Bacon Clicker is from <a href="http://orteil.dashnet.org/cookieclicker/">Cookie Clicker</a>, a cookie clicking game.</p>
            <h4>Todo</h4>
            <ul><li>Rankings</li></ul>
            <h4>Changelog</h4>
            <ul><li>Game data is now saved on your browser as localstorage</li><li>Reset game setting added to Settings (will wipe localstorage)</li><li>Added Upgrades section (Egg upgrade)</li><li>Added Eggs alongside with Bacons</li><li>Changed "Incoming Bacon from Shop items" to BPS</li><li>Bacon gain is no longer half a second (changed to per sec.)</li><li>Changed the "+1" text animation to force finish after another click (so it no longer queues up)</ul>
            <h4>Source Code</h4>
            <p>The source code is available for at <a href="https://github.com/wowmuchcreativity/Bacon-Clicker" target="_blank">GitHub</a> for your personal viewing.</p>
            <h4>Contact</h4>
            <p>Please contact me for any reasons either via <a href="mailto:wowmuchcreativity@gmail.com">wowmuchcreativity@gmail.com</a> or <a href="mailto:me@whuang.net">me@whuang.net</a>.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="resetModalLabel">Reset Game</h4>
          </div>
          <div class="modal-body">
            <p>Are you sure you would like to reset your progress?</p>
          </div>
            <div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-primary" id="resetGame">Delete</button>
				<button type="button" data-dismiss="modal" class="btn">Cancel</button>
            </div>
        </div>
      </div>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/store.min.js"></script>
	<script type="text/javascript">
	//messy js code
    $(window).load(function(){
        $('#myModal').modal('show');
    });
	
	$(function() {
		$('#bacon').click(function(){
			$("#plusone").finish();
			plusOne("bacon");
			baconClick(1);
		});
		$('#bacon2').click(function(){
			$("#plusone").finish();
			plusOne("bacon");
			baconClick(1);
		});
		$('#egg').click(function(){
			$("#plusone_egg").finish();
			plusOne("egg");
			eggClick(1);
		});
		$('#resetGame').click(function(){
			resetGame();
		});
		function plusOne(type) {
			if (type == "bacon") {
				$("#plusone").fadeIn("fast");
				$("#plusone").fadeOut("fast");
			} else {
				$("#plusone_egg").fadeIn("fast");
				$("#plusone_egg").fadeOut("fast");
			}
			$("#firstrun").fadeOut("fast");
			store.set('status', 'yes');
		}
	});
	function resetGame() {
		store.clear();
		location.reload();
	}
	function baconClick(number){
		bacon = bacon + number;
        document.getElementById('bacon-value').innerHTML = Math.ceil(bacon * 100) / 100;
		store.set('baconAmount', Math.ceil(bacon * 100) / 100);
	};
	function eggClick(number){
		egg = egg + number;
        document.getElementById('egg-value').innerHTML = Math.ceil(egg * 100) / 100;
		store.set('eggAmount', Math.ceil(egg * 100) / 100);
	};
	function buyItem(type, number, additional){
		if (type == "bacon") {
			if (bacon >= number) {
				bacon = bacon - number;
				additionalClicks = additionalClicks + additional;
				document.getElementById('bacon-value').innerHTML = Math.ceil(bacon * 100) / 100;
				document.getElementById('debug-click').innerHTML = Math.ceil(additionalClicks * 100) / 100;
			} else {
				$("#moarbacon").finish();
				$("#moarbacon").fadeIn(3);
				$("#moarbacon").fadeOut(800);
			}
		} else if (type == "egg") {
			if (egg >= number) {
				egg = egg - number;
				additionalClicks_eggs = additionalClicks_eggs + additional;
				document.getElementById('egg-value').innerHTML = Math.ceil(egg * 100) / 100;
				document.getElementById('debugEgg-click').innerHTML = Math.ceil(additionalClicks_eggs * 100) / 100;
			} else {
				$("#moareggs").finish();
				$("#moareggs").fadeIn(3);
				$("#moareggs").fadeOut(800);
			}
		}
		store.set('baconAmount', Math.ceil(bacon * 100) / 100);
		store.set('eggAmount', Math.ceil(egg * 100) / 100);
		store.set('additionalClicks', Math.ceil(additionalClicks * 100) / 100);
		store.set('additionalClicks_eggs', Math.ceil(additionalClicks_eggs * 100) / 100);
	};
	function buyUpgrade(baconCost, eggCost, upgrade){
		if (bacon >= baconCost && egg >= eggCost) {
			bacon = bacon - baconCost;
			document.getElementById('bacon-value').innerHTML = Math.ceil(bacon * 100) / 100;
			egg = egg - eggCost;
			document.getElementById('egg-value').innerHTML = Math.ceil(egg * 100) / 100;
			if (upgrade == 1) {
				unlockEggs();
			}
		} else {
			$("#moarbacon").finish();
			$("#moarbacon").fadeIn(3);
			$("#moarbacon").fadeOut(800);
			//$("#moareggs").finish();
			//$("#moareggs").fadeIn(3);
			//$("#moareggs").fadeOut(800);
		}
		store.set('baconAmount', Math.ceil(bacon * 100) / 100);
		store.set('eggAmount', Math.ceil(egg * 100) / 100);
		store.set('additionalClicks', Math.ceil(additionalClicks * 100) / 100);
		store.set('additionalClicks_eggs', Math.ceil(additionalClicks_eggs * 100) / 100);
	};
	function unlockEggs() {
		$(".egg-stuff").fadeIn(300);
		$(".hide-egg").hide();
		$("#bacon").hide();
	}
	function check() {
		if (init == 0) {
			if (store.get('status') == "yes") {
				bacon = store.get('baconAmount');
				egg = store.get('eggAmount');
				additionalClicks = store.get('additionalClicks');
				additionalClicks_eggs = store.get('additionalClicks_eggs');
			}
			init = 1;
		}
	}
	window.setInterval(function(){	
		check();
		if (egg >= 0.1 || additionalClicks_eggs >= 0.1) {
			unlockEggs();
		}
		baconClick(additionalClicks);	
		if (egg >= 1 || additionalClicks_eggs >= 0.1) {
			eggClick(additionalClicks_eggs);	
		}
        document.getElementById('debug-click').innerHTML = Math.ceil(additionalClicks * 100) / 100;
        document.getElementById('debugEgg-click').innerHTML = Math.ceil(additionalClicks_eggs * 100) / 100;
	}, 1000);//changed from half a sec to one sec
	</script>
		<!-- Google Analytics -->
		<script>
			//add google analytics here
		</script>
		<!-- END: Google Analytics -->
  </body>
</html>