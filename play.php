
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Bacon Clicker">
    <meta name="author" content="William Huang">
    <title>Bacon Clicker</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/store.min.js"></script> <!-- has to be called on head b/c formula display needs it -->
  </head>
  <body>      
  <script type="text/javascript">
	  var bacon = 0;
	  var egg = 0;
	  var additionalClicks = 0;
	  var additionalClicks_eggs = 0;
	  var baconClickMultiplier = 1;
	  var eggClickMultiplier = 1;
	  var init = 0;
	  var save_version = "1.0";
	function calculateFormulaForDisplay(type, item, price) {
		if (type == "bacon") {
			if (store.get('itemFormula_bacon['+item+']') >= 0.1) {
				var formula = store.get('itemFormula_bacon['+item+']');
			} else {
				var formula = 0;
			}
			result = price + formula;
		} else if (type == "egg") {
			if (store.get('itemFormula_egg['+item+']') >= 0.1) {
				var formula = store.get('itemFormula_egg['+item+']');
			} else {
				var formula = 0;
			}
			result = price + formula;
		} else if (type == "upgrade") {
			if (store.get('itemFormula_upgrade['+item+']') >= 0.1) {
				var formula = store.get('itemFormula_upgrade['+item+']');
			} else {
				var formula = 0;
			}
			result = price + formula;
		}
		return result;
	}
  </script>
  <style>
	.egg-stuff{display:none}
	table{counter-reset:section;}
	.count:before{counter-increment:section;content:counter(section);}

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
				<li><a href="#" data-toggle="modal" data-target="#rankingModal">Leaderboard</a></li>
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Settings<span class="caret"></span>   </a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="#" data-toggle="modal" data-target="#submitScores" id="forceScore">Submit to Leaderboard</a></li>
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
				<div class="panel panel-primary">
					<div class="panel-heading"><h4 class="panel-title">Shop</h4></div>
					<div class="panel-body scrollable large" style="height:80vh;overflow-y:scroll;">
						<div class="egg-stuff">
							<ul id="shopTab" class="nav nav-tabs no-margin" role="tablist" style="margin-top:-10px">
							  <li class="active"><a href="#tab_a" role="tab" data-toggle="tab" aria-expanded="false">Bacon</a></li>
							  <li class=""><a href="#eggs" role="tab" data-toggle="tab" aria-expanded="false">Eggs</a></li>
							</ul>
						</div>
						<div id="TabContent" class="tab-content" style="margin-top:5px;">
						  <div class="tab-pane scrollable active" id="tab_a">
							  <div id="baconContent">
								  <ul class="media-list">
								  <!--
									<li class="media">
										<div class="media-body">
											<h4 class="media-heading"><span class="badge" id="badgebacon99"><script type="text/javascript">var amount = store.get('item_bacon[99]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> [Hack] Bacon</h4>
											<p>This is a cheat.</p>
											<p class="small">+8000 BPS</p>
											<button class="btn btn-primary" onclick="buyItem('bacon', 99, 0, 8000);" id="calculatebacon1">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("bacon", 99, 0));</script> Bacons</button>
										</div>
									</li>
									-->
									<li class="media">
										<div class="media-body">
											<h4 class="media-heading"><span class="badge" id="badgebacon1"><script type="text/javascript">var amount = store.get('item_bacon[1]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> Bacon bits</h4>
											<p>The more bacon the better, no matter how big the bits are.</p>
											<p class="small">+0.1 BPS</p>
											<button class="btn btn-primary" onclick="buyItem('bacon', 1, 15, 0.1);" id="calculatebacon1">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("bacon", 1, 15));</script> Bacons</button>
										</div>
									</li>
									<li class="media">
										<div class="media-body">
											<h4 class="media-heading"><span class="badge" id="badgebacon2"><script type="text/javascript">var amount = store.get('item_bacon[2]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> Bacon chef</h4>
											<p>A chef hired specifically to make more bacon.</p>
											<p class="small">+1 BPS</p>
											<button class="btn btn-primary" onclick="buyItem('bacon', 2, 275, 1);" id="calculatebacon2">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("bacon", 2, 275));</script> Bacons</button>
										</div>
									</li>
									<li class="media">
										<div class="media-body">
											<h4 class="media-heading"><span class="badge" id="badgebacon3"><script type="text/javascript">var amount = store.get('item_bacon[3]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> Super Bacon Man</h4>
											<p>Use the power of the glorious bacon man to help you get some more of the dagnabbin' bacon!</p>
											<p class="small">+3 BPS</p>
											<button class="btn btn-primary" onClick="buyItem('bacon', 3, 2500, 3);" id="calculatebacon3">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("bacon", 3, 2500));</script> Bacons</button>
										</div>
									</li>
									<li class="media">
										<div class="media-body">
											<h4 class="media-heading"><span class="badge" id="badgebacon4"><script type="text/javascript">var amount = store.get('item_bacon[4]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> Crazy Bacon Lady</h4>
											<p>Call forth the crazy bacon lady to get a ridiculous amount of bacon.</p>
											<p class="small">+15 BPS</p>
											<button class="btn btn-primary" onClick="buyItem('bacon', 4, 6425, 15);" id="calculatebacon4">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("bacon", 4, 6425));</script> Bacons</button>
										</div>
									</li>
									<li class="media">
										<div class="media-body">
											<h4 class="media-heading"><span class="badge" id="badgebacon5"><script type="text/javascript">var amount = store.get('item_bacon[5]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> Bacon Launcher</h4>
											<p>Launch cannons filled with barrels of bacon into the air.</p>
											<p class="small">+35 BPS</p>
											<button class="btn btn-primary" onClick="buyItem('bacon', 5, 8500, 35);" id="calculatebacon5">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("bacon", 5, 8500));</script> Bacons</button>
										</div>
									</li>
									<li class="media">
										<div class="media-body">
											<h4 class="media-heading"><span class="badge" id="badgebacon6"><script type="text/javascript">var amount = store.get('item_bacon[6]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> Bakin' Pig</h4>
											<p>Why did the pig go into the kitchen? He felt like bacon.</p>
											<p class="small">+45 BPS</p>
											<button class="btn btn-primary" onClick="buyItem('bacon', 6, 10500, 45);" id="calculatebacon6">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("bacon", 6, 10500));</script> Bacons</button>
										</div>
									</li>
									<li class="media">
										<div class="media-body">
											<h4 class="media-heading"><span class="badge" id="badgebacon7"><script type="text/javascript">var amount = store.get('item_bacon[7]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> Xtra Large Bacon</h4>
											<p>This piece of bacon comes extra large!</p>
											<p class="small">+65 BPS</p>
											<button class="btn btn-primary" onClick="buyItem('bacon', 7, 18000, 65);" id="calculatebacon7">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("bacon", 7, 18000));</script> Bacons</button>
										</div>
									</li>
									<li class="media">
										<div class="media-body">
											<h4 class="media-heading"><span class="badge" id="badgebacon8"><script type="text/javascript">var amount = store.get('item_bacon[8]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> Bacon Gods</h4>
											<p>The bacon gods demand your prayers.</p>
											<p class="small">+90 BPS</p>
											<button class="btn btn-primary" onClick="buyItem('bacon', 8, 24500, 90);" id="calculatebacon8">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("bacon", 8, 24500));</script> Bacons</button>
										</div>
									</li>
								  </ul>
								</div>
							</div>
							<div class="tab-pane scrollable" id="eggs">
								<div id="eggContent">
									<ul class="media-list">
									<!--
									<li class="media">
										<div class="media-body">
											<h4 class="media-heading"><span class="badge" id="badgeegg99"><script type="text/javascript">var amount = store.get('item_egg[99]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> [Hack] Egg</h4>
											<p>This is a cheat.</p>
											<p class="small">+8000 EPS</p>
											<button class="btn btn-primary" onclick="buyItem('egg', 99, 0, 8000);" id="calculatebacon1">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("egg", 99, 0));</script> Eggs</button>
										</div>
									</li>
									-->
										<li class="media">
											<div class="media-body">
												<h4 class="media-heading"><span class="badge" id="badgeegg1"><script type="text/javascript">var amount = store.get('item_egg[1]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> Scrambled Eggs</h4>
												<p>Tiny chunks of eggs are scrambling all over the place, yikes!</p>
												<p class="small">+0.5 EPS</p>
												<button class="btn btn-primary" onclick="buyItem('egg', 1, 35, 0.5);" id="calculateegg1">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("egg", 1, 35));</script> Eggs</button>
											</div>
										</li>
										<li class="media">
											<div class="media-body">
												<h4 class="media-heading"><span class="badge" id="badgeegg2"><script type="text/javascript">var amount = store.get('item_egg[2]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> Omelette du Fromage</h4>
												<p>Omelette du Fromage.</p>
												<p class="small">+2 EPS</p>
												<button class="btn btn-primary" onclick="buyItem('egg', 2, 3000, 2);" id="calculateegg2">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("egg", 2, 3000));</script> Eggs</button>
											</div>
										</li>
										<li class="media">
											<div class="media-body">
												<h4 class="media-heading"><span class="badge" id="badgeegg3"><script type="text/javascript">var amount = store.get('item_egg[3]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> Eggcellent Eggs</h4>
												<p>Only the most eggceptional eggs of them all are worthy of your time.</p>
												<p class="small">+5 EPS</p>
												<button class="btn btn-primary" onclick="buyItem('egg', 3, 4500, 5);" id="calculateegg3">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("egg", 3, 4500));</script> Eggs</button>
											</div>
										</li>
										<li class="media">
											<div class="media-body">
												<h4 class="media-heading"><span class="badge" id="badgeegg4"><script type="text/javascript">var amount = store.get('item_egg[4]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> Eggsperimental Eggs</h4>
												<p>Is it just me or are these eggs glowing?</p>
												<p class="small">+8.5 EPS</p>
												<button class="btn btn-primary" onclick="buyItem('egg', 4, 11000, 8.5);" id="calculateegg4">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("egg", 4, 11000));</script> Eggs</button>
											</div>
										</li>
										<li class="media">
											<div class="media-body">
												<h4 class="media-heading"><span class="badge" id="badgeegg5"><script type="text/javascript">var amount = store.get('item_egg[5]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> Egg-straordinarly Bad Puns</h4>
												<p>It's so bad, that it cracks me up!</p>
												<p class="small">+14 EPS</p>
												<button class="btn btn-primary" onclick="buyItem('egg', 5, 18000, 14);" id="calculateegg5">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("egg", 5, 18000));</script> Eggs</button>
											</div>
										</li>
										<li class="media">
											<div class="media-body">
												<h4 class="media-heading"><span class="badge" id="badgeegg6"><script type="text/javascript">var amount = store.get('item_egg[6]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> Chicken or the Egg?</h4>
												<p>Which comes first?</p>
												<p class="small">+30 EPS</p>
												<button class="btn btn-primary" onClick="buyItem('egg', 6, 26500, 30);" id="calculateegg6">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("egg", 6, 26500));</script> Eggs</button>
											</div>
										</li>
										<li class="media">
											<div class="media-body">
												<h4 class="media-heading"><span class="badge" id="badgeegg7"><script type="text/javascript">var amount = store.get('item_egg[7]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> All Aboard the Segway!</h4>
												<p>What is the best way for an egg to travel? On a sEGGway. <i>*badoomtss*</i></p>
												<p class="small">+50 EPS</p>
												<button class="btn btn-primary" onClick="buyItem('egg', 7, 36500, 30);" id="calculateegg7">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("egg", 7, 36500));</script> Eggs</button>
											</div>
										</li>
										<li class="media">
											<div class="media-body">
												<h4 class="media-heading"><span class="badge" id="badgeegg8"><script type="text/javascript">var amount = store.get('item_egg[8]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> Egg-splosive Eggs</h4>
												<p>These eggs are so strong that they will literally melt your face off.</p>
												<p class="small">+75 EPS</p>
												<button class="btn btn-primary" onClick="buyItem('egg', 8, 42500, 75);" id="calculateegg8">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("egg", 8, 42500));</script> Eggs</button>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3"><!-- TODO: upgrades section -->
				<div class="panel panel-primary">
					<div class="panel-heading"><h4 class="panel-title">Upgrades</h4></div>
					<div class="panel-body scrollable large" style="height:80vh;overflow-y:scroll;">
						<ul class="media-list media-list-no-margin">
							<li class="media hide-egg">
								<div class="media-body">
									<h4 class="media-heading">IT'S TIME FOR EGGS</h4>
									<p>THE END IS NEAR. EGGS. ERRMERRGERD.</p>
									<p class="small">EGGS.</p>
									<button class="btn btn-primary" onClick="buyUpgrade(50000, 0, 1, 0);">Use 50000 Bacons</button>
								</div>
							</li>
							<li class="media">
								<div class="media-body">
									<h4 class="media-heading"><span class="badge" id="badgeupgrade2"><script type="text/javascript">var amount = store.get('item_upgrade[2]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> Bacon Multiplier 5000</h4>
									<p>We've finally found the answer to the life, the universe and everything! The great Bacon Mutliplier 5000! You can't possibly tell us that this is a bad idea.</p>
									<p class="small"><b>Double</b> your bacon per click.</p>
									<button class="btn btn-primary" onClick="buyUpgrade(55000, 0, 2, 1);" id="calculateupgrade2">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("upgrade", 2, 55000));</script> Bacons</button>
								</div>
							</li>
							<div class="egg-stuff" style="margin-top:10px"><!-- 10px to match the rest -->
								<li class="media">
									<div class="media-body">
										<h4 class="media-heading"><span class="badge" id="badgeupgrade3"><script type="text/javascript">var amount = store.get('item_upgrade[3]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> Egg Multiplier 6400</h4>
										<p>What is this? An egg multiplier? How many more multipliers do we possibly need?</p>
										<p class="small"><b>Double</b> your eggs per click.</p>
										<button class="btn btn-primary" onClick="buyUpgrade(0, 65000, 3, 1);" id="calculateupgrade3">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("upgrade", 3, 65000));</script> Eggs</button>
									</div>
								</li>
							</div>
							<li class="media">
								<div class="media-body">
									<h4 class="media-heading"><span class="badge" id="badgeupgrade4"><script type="text/javascript">var amount = store.get('item_upgrade[4]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> The Ultimate Bacon Generator</h4>
									<p>This is life. This is what it means to be alive, to make bacon out of thin air.</p>
									<p class="small">Adds an <b>additional half</b> of your current BPS.</p>
									<button class="btn btn-primary" onClick="buyUpgrade(80000, 0, 4, 1);" id="calculateupgrade4">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("upgrade", 4, 80000));</script> Eggs</button>
								</div>
							</li>
							<div class="egg-stuff" style="margin-top:10px"><!-- 10px to match the rest -->
								<li class="media">
									<div class="media-body">
										<h4 class="media-heading"><span class="badge" id="badgeupgrade5"><script type="text/javascript">var amount = store.get('item_upgrade[5]'); if (amount != undefined || amount != null) { document.write(amount);} else { document.write(0);}</script></span> The Ultimate Egg Generator</h4>
										<p>Will we ever run out of eggs? Holy crapola!</p>
										<p class="small">Adds an <b>additional half</b> of your current EPS.</p>
										<button class="btn btn-primary" onClick="buyUpgrade(0, 100000, 5, 1);" id="calculateupgrade5">Use <script type="text/javascript">document.write(calculateFormulaForDisplay("upgrade", 5, 100000));</script> Eggs</button>
									</div>
								</li>
							</div>
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
            <p class="large bg-warning">Warning: This game is still in development.</p>
            <p>Bacon Clicker is a (you guessed it!) bacon clicking game created by William Huang for a project for a class in Oakland Technical High School. The inspiration for Bacon Clicker is from <a href="http://orteil.dashnet.org/cookieclicker/">Cookie Clicker</a>, a cookie clicking game.</p>
            <h4>Todo</h4>
            <ul><li>Achievements</li><li>Account creation (for saves/better rankings)</li></ul>
            <h4>Changelog</h4>
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				  <div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingFour">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#changelog4" aria-expanded="true" aria-controls="changelog4">
						  Version 0.4 (May 4, 2015 11:10PM PDT)
						</a>
					  </h4>
					</div>
					<div id="changelog4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFour">
					  <div class="panel-body">
							<ul><li>Added Bacon Multiplier 5000, Egg Multiplier 6400, The Ultimate Bacon Generator and The Ultimate Egg Generator to the Upgrades panel</li><li>Prices for items in the Shop have been raised considerably to raise the game difficulty</li><li>Price increase per purchase rate has been modified for items in the Shop</li><li>Added Xtra Bacon (+65 BPS), Bacon Gods (+90 BPS), All Aboard the Segway (+50 EPS), Egg-splosive Eggs (+75 EPS) to the Shop</li><li>Formula for determining the rankings on the Leaderboard have been tweaked slightly</li><li>Fixed an issue where the Bacon tab will no longer work after clicking on the Eggs tab</li><li>Fixed an issue where the Leaderboard submission window would allow blank names</li></ul>
					  </div>
					</div>
				  </div>
				  <div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingThree">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#changelog3" aria-expanded="true" aria-controls="changelog3">
						  Version 0.3 (May 4, 2015 3:35AM PDT)
						</a>
					  </h4>
					</div>
					<div id="changelog3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
					  <div class="panel-body">
							 <b>This version wipes saves from pre-existing versions.</b><ul><li>Modified Shop UI, Eggs are separated from the Bacon via tabs (and Eggs are also now hidden until unlocked)</li><li>Shop and Upgrade panels will now scale to user resolution</li><li>Save versions are added, allowing for better management of save data in the future</li><li>Shop items have been balanced, difficulty of level has been raised</li><li>Bacon and Egg cost will now increase per purchase to increase the difficulty of the game</li><li>An indicator for how many of x items you have purchased has been added</li><li>You can now submit your scores on the leaderboard</li><li>The Leaderboard is now available</li></ul>
					  </div>
					</div>
				  </div>
				  <div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingTwo">
					  <h4 class="panel-title">
						<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#changelog2" aria-expanded="false" aria-controls="changelog2">
						  Version 0.2 (May 1, 2015 12:40AM PDT)
						</a>
					  </h4>
					</div>
					<div id="changelog2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
					  <div class="panel-body">
							 <ul><li>Game data is now saved as local storage (via store.js)</li><li>Reset game is now available in Settings</li><li>Added Eggs</li><li>Added Eggs in Upgrade section</li><li>BPS (and EPS) is now the name for 'Incoming Bacon from Shop items'</li><li>Bacon/egg gain lengthened to one second (instead of half a second)</li><li>Changed "+1" text animation to force finish after clicking</li><li>Added 'About' modal link on nav bar</li></ul>
					  </div>
					</div>
				  </div>
				</div>
            <h4>Source Code</h4>
            <p>The source code is available at <a href="https://github.com/wowmuchcreativity/Bacon-Clicker" target="_blank">GitHub</a> for your personal viewing.</p>
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
    <div class="modal fade" id="submitScores" tabindex="-1" role="dialog" aria-labelledby="submitScoresLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="submitScoresLabel">Reset Game</h4>
          </div>
          <div class="modal-body">
				<p class="text-center">Are you sure you want to submit your score?<br />Only the top 10 will appear on the leaderboard.</p>
				<form class="submitscore text-center" name="submitscore">
					Display Name: 
					<input type="text" placeholder="Display Name" name="name" required autofocus><br>
					<input type="hidden" id="baconValueSubmit" name="bacon" value="">
					<input type="hidden" id="eggValueSubmit" name="egg" value="">
				</form>
          </div>
            <div class="modal-footer">
				<input class="btn btn-success" type="submit" value="Submit" id="submit">
				<button type="button" data-dismiss="modal" class="btn">Cancel</button>
            </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="rankingModal" tabindex="-1" role="dialog" aria-labelledby="rankingModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="rankingModalLabel">Leaderboard</h4>
          </div>
          <div class="modal-body">
			<p class="text-center">Only the top 10 will be shown, because they are the most worthy!</p>
			<p class="text-center small">(Formula for #: ((Bacon*0.9)+(Eggs*1.2))/Bacon+Egg)</p>
			<table id="rankingData" class="table table-striped">
			  <thead>
				<tr>
				  <th>#</th>
				  <th>Name</th>
				  <th>Bacons</th>
				  <th>Eggs</th>
				  <th>Date/Time Achieved</th>
				</tr>
			  </thead>
			</table>
          </div>
        </div>
      </div>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
	//messy js code

	$(document).ready(function () {
		$("input#submit").click(function(){
			$.ajax({
				type: "POST",
				url: "ranking.process.php", 
				data: $('form.submitscore').serialize(),
				success: function(msg){
					$("#submitScores").modal('hide');	
				},
				error: function(){
					alert("Uh oh, spaghettios! Something went wrong. Please contact the administrator at wowmuchcreativity@gmail.com or me@whuang.net.");
				}
			});
		});
	});
	$.ajax({
		url: 'ranking.data.php',
		type: "post",
		dataType: "json",
		data: {
			json: [],
			delay: 0
		},
		success: function(data, textStatus, jqXHR) {
			drawTable(data);
		}
	});
	function drawTable(data) {
		for (var i = 0; i < data.length; i++) {
			drawRow(data[i]);
		}
	}
	function drawRow(rowData) {
		var row = $("<tr />")
		$("#rankingData").append(row); //this will append tr element to table... keep its reference for a while since we will add cels into it
		row.append($("<th scope=\"row\" class=\"count\"></td>"));
		row.append($("<td>" + rowData.name + "</td>"));
		row.append($("<td>" + rowData.bacon + "</td>"));
		row.append($("<td>" + rowData.egg + "</td>"));
		row.append($("<td>" + rowData.date + "</td>"));
	}

    $(window).load(function(){
        $('#myModal').modal('show');
    });

	$(function() {
		$('#bacon').click(function(){
			$("#plusone").finish();
			plusOne("bacon");
			baconClick(1*baconClickMultiplier);
			document.getElementById('plusone').innerHTML = "+"+1*baconClickMultiplier+"";
		});
		$('#bacon2').click(function(){
			$("#plusone").finish();
			plusOne("bacon");
			baconClick(1*baconClickMultiplier);
			document.getElementById('plusone').innerHTML = "+"+1*baconClickMultiplier+"";
		});
		$('#egg').click(function(){
			$("#plusone_egg").finish();
			plusOne("egg");
			eggClick(1*eggClickMultiplier);
		});
		$('#resetGame').click(function(){
			resetGame();
		});
		$('#forceScore').click(function(){
			//alert(''+store.get('baconAmount')+', '+store.get('eggAmount')+''); (debug)
			document.getElementById('baconValueSubmit').value = store.get('baconAmount');
			document.getElementById('eggValueSubmit').value = store.get('eggAmount');
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
			store.set('save_version', save_version);
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
	function buyItem(type, item, number, additional){
		if (type == "bacon") {
			if (bacon >= number) {
				if (store.get('itemFormula_bacon['+item+']') >= 0.1) {
					var formula = store.get('itemFormula_bacon['+item+']');
				} else {
					var formula = 0;
				}
				if (store.get('item_bacon['+item+']') >= 1) {
					var amountPurchased = store.get('item_bacon['+item+']');
				} else {
					var amountPurchased = 0;
				}
				if (bacon >= number + formula) {
					bacon = bacon - (number + formula);
					additionalClicks = additionalClicks + additional;
					document.getElementById('bacon-value').innerHTML = Math.ceil(bacon * 100) / 100;
					document.getElementById('debug-click').innerHTML = Math.ceil(additionalClicks * 100) / 100;
					store.set('itemFormula_bacon['+item+']', formula+(number*0.25));
					store.set('item_bacon['+item+']', amountPurchased+1);
					$('button#calculate'+type+''+item+'').text('Use '+Math.ceil(calculateFormulaForDisplay("bacon", item, number) * 100) / 100+' Bacons');
					$('span#badge'+type+''+item+'').text(store.get('item_bacon['+item+']'));
				} else {
					showInsufficientMsg("bacon");
				}
			} else {
				showInsufficientMsg("bacon");
			}
		} else if (type == "egg") {
			if (egg >= number) {
				if (store.get('itemFormula_egg['+item+']') >= 0.1) {
					var formula = store.get('itemFormula_egg['+item+']');
				} else {
					var formula = 0;
				}
				if (store.get('item_egg['+item+']') >= 1) {
					var amountPurchased = store.get('item_egg['+item+']');
				} else {
					var amountPurchased = 0;
				}
				if (egg >= number + formula) {
					egg = egg - (number + formula);
					additionalClicks_eggs = additionalClicks_eggs + additional;
					document.getElementById('egg-value').innerHTML = Math.ceil(egg * 100) / 100;
					document.getElementById('debugEgg-click').innerHTML = Math.ceil(additionalClicks_eggs * 100) / 100;
					store.set('itemFormula_egg['+item+']', formula+(number*0.65));
					store.set('item_egg['+item+']', amountPurchased+1);
					$('button#calculate'+type+''+item+'').text('Use '+Math.ceil(calculateFormulaForDisplay("egg", item, number) * 100) / 100+' Eggs');
					$('span#badge'+type+''+item+'').text(store.get('item_egg['+item+']'));
				} else {
					showInsufficientMsg("eggs");
				}
			} else {
				showInsufficientMsg("eggs");
			}
		}
		store.set('baconAmount', Math.ceil(bacon * 100) / 100);
		store.set('eggAmount', Math.ceil(egg * 100) / 100);
		store.set('additionalClicks', Math.ceil(additionalClicks * 100) / 100);
		store.set('additionalClicks_eggs', Math.ceil(additionalClicks_eggs * 100) / 100);
	};
	function buyUpgrade(baconCost, eggCost, upgrade, useFormula){
										// 4 = bacon generator (BPS+(BPS*1/2))
										// 5 = egg generator (EPS+(EPS*1/2))
		if (useFormula == 0) {
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
		} else {
			if (baconCost >= 1) {// if it's bacon
				if (bacon >= baconCost) {
					if (store.get('itemFormula_upgrade['+upgrade+']') >= 0.1) {
						var formula = store.get('itemFormula_upgrade['+upgrade+']');
					} else {
						var formula = 0;
					}
					if (store.get('item_upgrade['+upgrade+']') >= 1) {
						var amountPurchased = store.get('item_upgrade['+upgrade+']');
					} else {
						var amountPurchased = 0;
					}
					if (bacon >= baconCost + formula) {
						bacon = bacon - (baconCost + formula);
						store.set('itemFormula_upgrade['+upgrade+']', formula+(baconCost*4));
						store.set('item_upgrade['+upgrade+']', amountPurchased+1);
						$('button#calculateupgrade'+upgrade+'').text('Use '+Math.ceil(calculateFormulaForDisplay("upgrade", upgrade, baconCost) * 100) / 100+' Bacons');
						$('span#badgeupgrade'+upgrade+'').text(store.get('item_upgrade['+upgrade+']'));
						if (upgrade == 2) {
							store.set('baconClickMultiplier', baconClickMultiplier*2);
							baconClickMultiplier = baconClickMultiplier * 2;
							document.getElementById('plusone').innerHTML = "+"+1*baconClickMultiplier+"";
						}
						if (upgrade == 4) {
							additionalClicks = additionalClicks + (additionalClicks * 0.5);
							store.set('additionalClicks', Math.ceil(additionalClicks * 100) / 100);
							document.getElementById('debug-click').innerHTML = Math.ceil(additionalClicks * 100) / 100;
						}
					} else {
						showInsufficientMsg("bacon");
					}
				} else {
					showInsufficientMsg("bacon");
				}
			}
			if (eggCost >= 1) {// if it's eggs
				if (egg >= eggCost) {
					if (store.get('itemFormula_upgrade['+upgrade+']') >= 0.1) {
						var formula = store.get('itemFormula_upgrade['+upgrade+']');
					} else {
						var formula = 0;
					}
					if (store.get('item_upgrade['+upgrade+']') >= 1) {
						var amountPurchased = store.get('item_upgrade['+upgrade+']');
					} else {
						var amountPurchased = 0;
					}
					if (egg >= eggCost + formula) {
						egg = egg - (eggCost + formula);
						store.set('itemFormula_upgrade['+upgrade+']', formula+(eggCost*5));
						store.set('item_upgrade['+upgrade+']', amountPurchased+1);
						$('button#calculateupgrade'+upgrade+'').text('Use '+Math.ceil(calculateFormulaForDisplay("upgrade", upgrade, eggCost) * 100) / 100+' Eggs');
						$('span#badgeupgrade'+upgrade+'').text(store.get('item_upgrade['+upgrade+']'));
						if (upgrade == 3) {
							store.set('eggClickMultiplier', eggClickMultiplier*2);
							eggClickMultiplier = eggClickMultiplier * 2;
							document.getElementById('plusone_egg').innerHTML = "+"+1*eggClickMultiplier+"";
						}
						if (upgrade == 5) {
							additionalClicks_eggs = additionalClicks_eggs + (additionalClicks_eggs * 0.5);
							store.set('additionalClicks_eggs', Math.ceil(additionalClicks_eggs * 100) / 100);
							document.getElementById('debugEgg-click').innerHTML = Math.ceil(additionalClicks_eggs * 100) / 100;
						}
					} else {
						showInsufficientMsg("eggs");
					}
				} else {
					showInsufficientMsg("eggs");
				}
			}
		}
	};
	function showInsufficientMsg(type) {
		$("#moar"+type+"").finish();
		$("#moar"+type+"").fadeIn(3);
		$("#moar"+type+"").fadeOut(800);
	}
	function unlockEggs() {
		$(".egg-stuff").fadeIn(300);
		$(".hide-egg").hide();
		$("#bacon").hide();
	}
	function check() {
		if (init == 0) {
			if (store.get('status') == "yes") {
				if (store.get('save_version') == save_version) {
					bacon = store.get('baconAmount');
					egg = store.get('eggAmount');
					additionalClicks = store.get('additionalClicks');
					additionalClicks_eggs = store.get('additionalClicks_eggs');
					if (store.get('baconClickMultiplier') >= 1) {
						baconClickMultiplier = store.get('baconClickMultiplier');
					}
					if (store.get('eggClickMultiplier') >= 1) {
						eggClickMultiplier = store.get('eggClickMultiplier');
					}
				}
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
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			
			ga('create', 'UA-59953172-1', 'auto');
			ga('send', 'pageview');
		</script>
		<!-- END: Google Analytics -->
  </body>
</html>