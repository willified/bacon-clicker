
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Bacon Clicker">
    <meta name="author" content="William Huang">
    <title>Bacon Clicker</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/store.min.js"></script>
  </head>
  <body>      
  <style>
	.egg-stuff{display:none}
	table{counter-reset:section;}
	.count:before{counter-increment:section;content:counter(section);}
	}
  </style>
  <script type="text/javascript">
	  var bacon = 0;
	  var egg = 0;
	  var additionalClicks = 0;
	  var additionalClicks_egg = 0;
	  var baconClickMultiplier = 1;
	  var eggClickMultiplier = 1;
	  var init = 0;
	  var save_version = "1.1";
  </script>
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
									<span id="loadBacon">
										<ul class="media-list"></ul>
									</span>
								</div>
							</div>
							<div class="tab-pane scrollable" id="eggs">
								<div id="eggContent">
									<span id="loadEggs">
										<ul class="media-list"></ul>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-primary">
					<div class="panel-heading"><h4 class="panel-title">Upgrades</h4></div>
					<div class="panel-body scrollable large" style="height:50vh;overflow-y:scroll;">
						<span id="moarupgradelimit" style="color:darkred;display:none;">You may not purchase this item anymore because the limit has been reached.</span>
							<span id="loadUpgrades">
								<ul class="media-list media-list-no-margin"></ul>
							</span>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading"><h4 class="panel-title">Achievements <span class="badge">2500 Points</span></h4></div>
					<div class="panel-body scrollable large" style="height:24vh;overflow-y:scroll;" id="achievements">
						<ul class="list-group"></ul>
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
            <ul><li>Achievements</li><li>Account creation / Save IDs</li></ul>
            <h4>Changelog</h4>
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				  <div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingFive">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#changelog5" aria-expanded="true" aria-controls="changelog5">
						  Version 0.5 (May 7, 2015 12:50AM PDT)
						</a>
					  </h4>
					</div>
					<div id="changelog5" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFive">
					  <div class="panel-body">
							 <b>*Note: This update changed a large bit of the code, many things may have been unintentionally broken.<br /><br />This version wipes saves and leaderboards from pre-existing versions.</b><ul><li>(Partial) Achievements were added, only the UI exists for now</li><li>Prices for items in the Upgrades shop have been raised slightly</li><li>Limits for upgrades has been added for all multiplier items</li><li>Efforts were made to make the code easier to manage</li><li>Shop item information have been moved to the server side<li>Added a message that will now appear while the game is loading</li><li>Fixed an issue where the game would not remember that you unlocked Eggs if you had 0 EPS</li><li>Fixed an issue where the notice telling you to click your bacon would still show if it was not your first time/a new save after a refresh</li><li>Fixed an issue where All Aboard the Segway would give the wrong amount of EPS</li></ul>
					  </div>
					</div>
				  </div>
				  <div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingFour">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#changelog4" aria-expanded="true" aria-controls="changelog4">
						  Version 0.4 (May 4, 2015 11:10PM PDT)
						</a>
					  </h4>
					</div>
					<div id="changelog4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
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

    <div class="modal fade" id="patience" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="patienceModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="patienceModalLabel">Please wait while the game loads...</h4>
          </div>
          <div class="modal-body">
			<p><big>Sorry about this, but there's a lot of stuff going on in the background while the game loads. As soon as we're done loading, I'll be out of your way!</big></p>
          </div>
        </div>
      </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
	$(window).ready(function() {
		$('#patience').modal('show');
	});
	$( document ).ajaxComplete(function() {
		$('#patience').modal('hide');
	});
	</script>
    <script src="js/game.js"></script>
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