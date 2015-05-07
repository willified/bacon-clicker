/*
game.js
@Author: William Huang
@Description: Javascript file used for Bacon Clicker game
*/

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
	function calculateFormulaForDisplay(type, item, price) {
		if (store.get('itemFormula['+item+']') >= 0.1) {
			var formula = store.get('itemFormula['+item+']');
		} else {
			var formula = 0;
		}
		result = parseFloat(price) + parseFloat(formula);
		return result;
	}
    $(window).load(function(){
        $('#myModal').modal('show');//for about
		check();
		writeShopData(1);//for bacon shop
		writeShopData(2);//for egg shop
		writeShopData(9);//for upgrades shop
    });
	function writeShopData(type) {
		$.getJSON("data/shop?type="+type+"", function(data){
			$.each(data, function(index, val){
				if (type == 1) {
					$("#loadBacon ul").append("<li class=\"media\"><div class=\"media-body\"><h4 class=\"media-heading\"><span class=\"badge\" id=\"badgebacon"+val.id+"\"><script>var amount = store.get(\'item_bacon["+val.id+"]\'); if (amount != undefined || amount != null) { document.getElementById('badgebacon"+val.id+"').innerHTML = amount;} else { document.getElementById('badgebacon"+val.id+"').innerHTML = \"0\";}</script></span> "+val.name+"</h4><p>"+val.desc+"</p><p class=\"small\">+"+val.bps+" BPS</p><button class=\"btn btn-primary\" onclick=\"buyItem("+val.id+")\" id=\"calculatebacon"+val.id+"\"><script type=\"text/javascript\">document.getElementById('calculatebacon"+val.id+"').innerHTML = \"Use "+calculateFormulaForDisplay("bacon", val.id, val.cost)+" Bacons\";</script></button></div></li>");
				}
				if (type == 2) {
					$("#loadEggs ul").append("<li class=\"media\"><div class=\"media-body\"><h4 class=\"media-heading\"><span class=\"badge\" id=\"badgeegg"+val.id+"\"><script>var amount = store.get(\'item_egg["+val.id+"]\'); if (amount != undefined || amount != null) { document.getElementById('badgeegg"+val.id+"').innerHTML = amount;} else { document.getElementById('badgeegg"+val.id+"').innerHTML = \"0\";}</script></span> "+val.name+"</h4><p>"+val.desc+"</p><p class=\"small\">+"+val.eps+" EPS</p><button class=\"btn btn-primary\" onclick=\"buyItem("+val.id+")\" id=\"calculateegg"+val.id+"\"><script type=\"text/javascript\">document.getElementById('calculateegg"+val.id+"').innerHTML = \"Use "+calculateFormulaForDisplay("egg", val.id, val.cost)+" Eggs\";</script></button></div></li>");
				}
				if (type == 9) {
					var eggUpgrade = false;
					if (val.type_cost == 2) {
						eggUpgrade = true;
					}
					var hideEgg = false;
					if (val.id == 17) {
						hideEgg = true;
					}
					$("#loadUpgrades ul").append(""+(eggUpgrade == true ? "<div class=\"egg-stuff\" style=\"margin-top:10px\">" : "")+"<li class=\"media "+(hideEgg == true ? "hide-egg" : "")+"\"><div class=\"media-body\"><h4 class=\"media-heading\"><span class=\"badge\" id=\"badgeupgrade"+val.id+"\"><script>var amount = store.get(\'item_upgrade["+val.id+"]\'); if (amount != undefined || amount != null) { document.getElementById('badgeupgrade"+val.id+"').innerHTML = amount;} else { document.getElementById('badgeupgrade"+val.id+"').innerHTML = \"0\";}</script></span> "+val.name+"</h4><p>"+val.desc+"</p><p class=\"small\">"+val.extra_desc+"</p><button class=\"btn btn-primary\" onclick=\"buyItem("+val.id+")\" id=\"calculateegg"+val.id+"\"><script type=\"text/javascript\">document.getElementById('calculateegg"+val.id+"').innerHTML = \"Use "+calculateFormulaForDisplay("upgrade", val.id, val.cost)+" "+(eggUpgrade == true ? "Eggs" : "Bacons")+"\";</script></button></div></li>"+(eggUpgrade == true ? "</div>" : "")+"");
				}
			});
		});
	}
	$(function() {
		$('#bacon').click(function(){
			$("#plusone").finish();
			plusOne("bacon");
			click(1, 1*baconClickMultiplier);
			document.getElementById('plusone').innerHTML = "+"+1*baconClickMultiplier+"";
		});
		$('#bacon2').click(function(){
			$("#plusone").finish();
			plusOne("bacon");
			click(1, 1*baconClickMultiplier);
			document.getElementById('plusone').innerHTML = "+"+1*baconClickMultiplier+"";
		});
		$('#egg').click(function(){
			$("#plusone_egg").finish();
			plusOne("egg");
			click(2, 1*eggClickMultiplier);
		});
		$('#resetGame').click(function(){
			resetGame();
		});
		$('#forceScore').click(function(){
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
	function click(type, number) {
		if (type == 1) {
			bacon = bacon + number;
			store.set('baconAmount', Math.ceil(bacon * 100) / 100);
			document.getElementById('bacon-value').innerHTML = Math.ceil(bacon * 100) / 100;
		} else if (type == 2) {
			egg = egg + number;
			store.set('eggAmount', Math.ceil(egg * 100) / 100);
			document.getElementById('egg-value').innerHTML = Math.ceil(egg * 100) / 100;
		}
	}
	function buyItem(item) {
		//$("#calculatebacon"+item+"").attr('disabled','disabled');
		//$("#calculateegg"+item+"").attr('disabled','disabled');
		$.getJSON("data/shop?id="+item+"", function(data){
			$.each(data, function(index, val){
				var type = val.type;
				var bps = parseFloat(val.bps);
				var eps = parseFloat(val.eps);
				var upgradeType = val.type_cost;
				var purchaseLimit = val.purchase_limit;
				var cost = parseFloat(val.cost);
				var amountPurchased_b = store.get('item_bacon['+item+']');
				var amountPurchased_e = store.get('item_egg['+item+']');
				var amountPurchased_u = store.get('item_upgrade['+item+']');
				if (type == 1 || type == 2) { // handler to buy bacon/egg items
					if (store.get('itemFormula['+item+']') >= 0.1) {
						var formula = store.get('itemFormula['+item+']');
					} else {
						var formula = 0;
					}
					if (bacon >= cost+formula) {
						if (type == 1) {
							bacon -= cost+formula;
							additionalClicks += bps;
							document.getElementById('bacon-value').innerHTML = Math.ceil(bacon * 100) / 100;
							document.getElementById('debug-click').innerHTML = Math.ceil(additionalClicks * 100) / 100;
							store.set('itemFormula['+item+']', formula+(cost*0.25));
							if (amountPurchased_b >= 1) {
								store.set('item_bacon['+item+']', amountPurchased_b+1);
							} else {
								store.set('item_bacon['+item+']', 1);
							}
							$('button#calculatebacon'+item+'').text('Use '+Math.ceil(calculateFormulaForDisplay("bacon", item, cost) * 100) / 100+' Bacons');
							$('span#badgebacon'+item+'').text(store.get('item_bacon['+item+']'));
						}
					} else {
						if (type == 1) {
							showInsufficientMsg("bacon");
						}
					}
					if (egg >= cost+formula) {
						if (type == 2) {
							egg -= cost+formula;
							additionalClicks_egg += eps;
							document.getElementById('egg-value').innerHTML = Math.ceil(egg * 100) / 100;
							document.getElementById('debugEgg-click').innerHTML = Math.ceil(additionalClicks_egg * 100) / 100;
							store.set('itemFormula['+item+']', formula+(cost*0.65));
							if (amountPurchased_e >= 1) {
								store.set('item_egg['+item+']', amountPurchased_e+1);
							} else {
								store.set('item_egg['+item+']', 1);
							}
							$('button#calculateegg'+item+'').text('Use '+Math.ceil(calculateFormulaForDisplay("egg", item, cost) * 100) / 100+' Bacons');
							$('span#badgeegg'+item+'').text(store.get('item_egg['+item+']'));
						}
					} else {
						if (type == 2) {
							showInsufficientMsg("eggs");
						}
					}
					store.set('baconAmount', Math.ceil(bacon * 100) / 100);
					store.set('eggAmount', Math.ceil(egg * 100) / 100);
					store.set('additionalClicks', Math.ceil(additionalClicks * 100) / 100);
					store.set('additionalClicks_egg', Math.ceil(additionalClicks_egg * 100) / 100);
					$("#calculatebacon"+item+"").removeAttr('disabled');
					$("#calculateegg"+item+"").removeAttr('disabled');
				} else if (type == 9) {//handler to buy upgrade items (not complete)
					if (store.get('item_upgrade['+item+']') >= purchaseLimit) {
						showInsufficientMsg("upgradelimit");
					} else {
						if (store.get('itemFormula['+item+']') >= 0.1) {
							var formula = store.get('itemFormula['+item+']');
						} else {
							var formula = 0;
						}
						if (upgradeType == 1) {
							if (bacon >= cost+formula) {
								bacon -= cost+formula;
								document.getElementById('bacon-value').innerHTML = Math.ceil(bacon * 100) / 100;
								store.set('itemFormula['+item+']', formula+(cost*4));
								if (amountPurchased_u >= 1) {
									store.set('item_upgrade['+item+']', amountPurchased_u+1);
								} else {
									store.set('item_upgrade['+item+']', 1);
								}
								$('button#calculateupgrade'+item+'').text('Use '+Math.ceil(calculateFormulaForDisplay("upgrade", item, cost) * 100) / 100+' Bacons');
								$('span#badgeupgrade'+item+'').text(store.get('item_upgrade['+item+']'));
								if (item == 17) {
									store.set('eggUnlocked', 1);
									unlockEggs();
								}
								if (item == 18) {
									store.set('baconClickMultiplier', baconClickMultiplier*2);
									baconClickMultiplier = baconClickMultiplier * 2;
									document.getElementById('plusone').innerHTML = "+"+1*baconClickMultiplier+"";
								}
								if (item == 20) {
									additionalClicks = additionalClicks + (additionalClicks * 0.5);
									store.set('additionalClicks', Math.ceil(additionalClicks * 100) / 100);
									document.getElementById('debug-click').innerHTML = Math.ceil(additionalClicks * 100) / 100;
								}
								if (store.get('item_upgrade['+item+']') >= purchaseLimit) {
									$('button#calculateupgrade'+item+'').text('Disabled');
									$('button#calculateupgrade'+item+'').prop('disabled', true);
								}
								store.set('baconAmount', Math.ceil(bacon * 100) / 100);
								store.set('eggAmount', Math.ceil(egg * 100) / 100);
								store.set('additionalClicks', Math.ceil(additionalClicks * 100) / 100);
								store.set('additionalClicks_egg', Math.ceil(additionalClicks_egg * 100) / 100);
							} else {
								showInsufficientMsg("bacon");
							}
						} else if (upgradeType == 2) {
							if (egg >= cost+formula) {
								egg -= cost+formula;
								document.getElementById('egg-value').innerHTML = Math.ceil(egg * 100) / 100;
								store.set('itemFormula['+item+']', formula+(cost*4));
								if (amountPurchased_u >= 1) {
									store.set('item_upgrade['+item+']', amountPurchased_u+1);
								} else {
									store.set('item_upgrade['+item+']', 1);
								}
								$('button#calculateupgrade'+item+'').text('Use '+Math.ceil(calculateFormulaForDisplay("upgrade", item, cost) * 100) / 100+' Eggs');
								$('span#badgeupgrade'+item+'').text(store.get('item_upgrade['+item+']'));
								if (item == 19) {
									store.set('eggClickMultiplier', eggClickMultiplier*2);
									eggClickMultiplier = eggClickMultiplier * 2;
									document.getElementById('plusone').innerHTML = "+"+1*eggClickMultiplier+"";
								}
								if (item == 21) {
									additionalClicks_egg = additionalClicks_egg + (additionalClicks_egg * 0.5);
									store.set('additionalClicks_egg', Math.ceil(additionalClicks_egg * 100) / 100);
									document.getElementById('debugEgg-click').innerHTML = Math.ceil(additionalClicks_egg * 100) / 100;
								}
								if (store.get('item_upgrade['+item+']') >= purchaseLimit) {
									$('button#calculateupgrade'+item+'').text('Disabled');
									$('button#calculateupgrade'+item+'').prop('disabled', true);
								}
								store.set('baconAmount', Math.ceil(bacon * 100) / 100);
								store.set('eggAmount', Math.ceil(egg * 100) / 100);
								store.set('additionalClicks', Math.ceil(additionalClicks * 100) / 100);
								store.set('additionalClicks_egg', Math.ceil(additionalClicks_egg * 100) / 100);
							} else {
								showInsufficientMsg("eggs");
							}
						}
					}
				}
			});
		});
	};
	function showInsufficientMsg(type) {
		$("#moar"+type+"").finish();
		$("#moar"+type+"").fadeIn(3);
		$("#moar"+type+"").fadeOut(1000);
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
					additionalClicks_egg = store.get('additionalClicks_egg');
					if (store.get('baconClickMultiplier') >= 1) {
						baconClickMultiplier = store.get('baconClickMultiplier');
					}
					if (store.get('eggClickMultiplier') >= 1) {
						eggClickMultiplier = store.get('eggClickMultiplier');
					}
					/* disable upgrades from being used, todo: hide them */
					if (store.get('item_upgrade[18]') >= 5) {
						$('button#calculateupgrade2').text('Disabled');
						$('button#calculateupgrade2').prop('disabled', true);
					}
					if (store.get('item_upgrade[19]') >= 5) {
						$('button#calculateupgrade3').text('Disabled');
						$('button#calculateupgrade3').prop('disabled', true);
					}
					if (store.get('item_upgrade[20]') >= 1) {
						$('button#calculateupgrade4').text('Disabled');
						$('button#calculateupgrade4').prop('disabled', true);
					}
					if (store.get('item_upgrade[21]') >= 1) {
						$('button#calculateupgrade5').text('Disabled');
						$('button#calculateupgrade5').prop('disabled', true);
					}
					$("#firstrun").fadeOut("fast");
				}
			}
			init = 1;
		}
	}
	function updateAchievements() {
		$("#achievements ul").append('<li class="list-group-item"><span class="badge">+5 Points</span> <b>Eggtastic!</b> <i><small>Eggs unlocked!</small></i></li>');
		jQuery(document).ready(function(){      
			var $t = $('div#achievements');
			$t.animate({"scrollTop": $('div#achievements')[0].scrollHeight}, "slow");
		});
	}
	window.setInterval(function(){	
					if (store.get('eggUnlocked') == 1) {
						unlockEggs();
					}
		click(1, additionalClicks);	
		if (egg >= 1 || additionalClicks_egg >= 0.1) {
			click(2, additionalClicks_egg);	
		}
        document.getElementById('debug-click').innerHTML = Math.ceil(additionalClicks * 100) / 100;
        document.getElementById('debugEgg-click').innerHTML = Math.ceil(additionalClicks_egg * 100) / 100;
		updateAchievements();
	}, 1000);