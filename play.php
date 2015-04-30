
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
  var additionalClicks = 0;
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
				<li><a href="#">Rankings (Coming Soon)</a></li><!-- todo: show modal with a json table with results -->
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Settings (Coming Soon)<span class="caret"></span>   </a>
				<ul class="dropdown-menu" role="menu"> <!-- todo: create login system -->
					<li><a href="#">Save Game</a></li>
					<li><a href="#">Load Game</a></li>
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
				<img id="bacon" class="img-responsive" style="margin: 0 auto;" src="bacon.png">
				<div style="margin-bottom:30px"></div><!--empty space -->
				<div class="col-md-6" style="text-align:right;font-size:3em;">
					<div><span id="plusone" style="color:darkgreen;display:none;">+1</span> <span id="bacon-value">0</span></div>
				</div>
				<div class="col-md-6" style="text-align:left;font-size:3em;">
					<strong>Bacons</strong>
				</div>
				<div class="col-md-12" style="text-align:center;font-size:1.5em;">
					<span id="moarbacon" style="color:darkred;display:none;">Not enough bacon, click the bacon for more bacon!</strong>
				</div>
				<div class="col-md-12">
					<p>Incoming Bacon from Shop items: <span id="debug-click">0</span></p>
				</div>
			</div>
			<div class="col-md-3"><!-- shop section -->
				<div class="panel panel-default">
					<div class="panel-heading"><h4 class="panel-title">Shop</h4></div>
					<div class="panel-body scrollable large">
						<ul class="media-list media-list-no-margin">
							<li class="media">
								<div class="media-body">
									<h4 class="media-heading">Bacon bits</h4>
									<p>The more bacon the better, no matter how big the bits are.</p>
									<p class="small">+0.1 bacon per half a second</p>
									<button class="btn btn-primary" onclick="buyItem(10, 0.1);">Use 10 Bacons</button>
								</div>
							</li>
							<li class="media">
								<div class="media-body">
									<h4 class="media-heading">Bacon chef</h4>
									<p>A chef hired specifically to make more bacon.</p>
									<p class="small">+1 bacon per half a second</p>
									<button class="btn btn-primary" onclick="buyItem(15, 1);">Use 15 Bacons</button>
								</div>
							</li>
							<li class="media">
								<div class="media-body">
									<h4 class="media-heading">Super Bacon Man</h4>
									<p>Use the power of the glorious bacon man to help you get some more of the dagnabbin' bacon!</p>
									<p class="small">+3 bacon per half a second</p>
									<button class="btn btn-primary" onClick="buyItem(20, 3);">Use 20 Bacons</button>
								</div>
							</li>
							<li class="media">
								<div class="media-body">
									<h4 class="media-heading">Crazy Bacon Lady</h4>
									<p>Call forth the crazy bacon lady to get a ridiculous amount of bacon.</p>
									<p class="small">+55 bacon per half a second</p>
									<button class="btn btn-primary" onClick="buyItem(35, 55);">Use 35 Bacons</button>
								</div>
							</li>
							<li class="media">
								<div class="media-body">
									<h4 class="media-heading">SUPER 3LITE HAAXXXER</h4>
									<p>HAAAAX BACON</p>
									<p class="small">+9001 bacon per half a second</p>
									<button class="btn btn-primary" onClick="buyItem(2, 9001);">Use 2 Bacons</button>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-3"><!-- TODO: upgrades section -->
				<div class="panel panel-default">
					<div class="panel-heading"><h4 class="panel-title">Upgrades</h4></div>
					<div class="panel-body scrollable large">
						<ul class="media-list media-list-no-margin">
							<li class="media">
								<div class="media-body text-center">
									<h3>COMING SOON</h3>
									<p>This is still a work-in-progress!</p>
								</div>
							</li>
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
            <p class="small">Version: 0.1 (Last update: Apr. 29, 2015 11:00PM PDT)</p>
            <p class="small bg-warning">Warning: This game is still in development.</p>
            <p>Bacon Clicker is a (you guessed it!) bacon clicking game created by William Huang for a project for a class in Oakland Technical High School. The inspiration for Bacon Clicker is from <a href="http://orteil.dashnet.org/cookieclicker/">Cookie Clicker</a>, a cookie clicking game.</p>
            <h4>Todo</h4>
            <ul><li>Load/save game</li><li>Rankings</li><li>Upgrades section</li><li>More shop items</li></ul>
            <h4>Source Code</h4>
            <p>Coming soon to GitHub.</p>
            <h4>Contact</h4>
            <p>Please contact me for any reasons either via <a href="mailto:wowmuchcreativity@gmail.com">wowmuchcreativity@gmail.com</a> or <a href="mailto:me@whuang.net">me@whuang.net</a>.</p>
          </div>
        </div>
      </div>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
    $(window).load(function(){
        $('#myModal').modal('show');
    });
	
	$(function() {
		$('#bacon').click(function(){
			plusOne();
			baconClick(1);
		});
		function plusOne() {
			$("#plusone").fadeIn("fast");
			$("#plusone").fadeOut("fast");
			$("#firstrun").fadeOut("fast");
		}
	});
	function baconClick(number){
		bacon = bacon + number;
        document.getElementById('bacon-value').innerHTML = Math.ceil(bacon * 100) / 100;
	};
	function buyItem(number, additional){
		if (bacon >= number) {
			bacon = bacon - number;
			additionalClicks = additionalClicks + additional;
			document.getElementById('bacon-value').innerHTML = Math.ceil(bacon * 100) / 100;
			document.getElementById('debug-click').innerHTML = Math.ceil(additionalClicks * 100) / 100;
		} else {
			$("#moarbacon").fadeIn(3);
			$("#moarbacon").fadeOut(500);
		}
	};
	window.setInterval(function(){	
		baconClick(additionalClicks);	
        document.getElementById('debug-click').innerHTML = Math.ceil(additionalClicks * 100) / 100;
	}, 500);
	</script>
  </body>
</html>