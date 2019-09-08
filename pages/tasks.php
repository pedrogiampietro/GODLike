<script type="text/javascript" src="<?php echo $layout_name; ?>/assets/js/jquery.tablesorter.min.js"></script>
<script>
$(function() {
	var active = $(".selected-btn").attr('id');
	$("#"+ active + "list").show()
	
	$(".selectLevel").on('click', 'button', function() {
		var id = $(this).attr('id');
		
		$(".selected-btn").removeClass("selected-btn");
		$('#'+id).addClass('selected-btn');
		$(".selectTask tbody").hide();
		$("#"+ id + "list").show();
	});	
	
	$("#period-group").on('click', function() {
		var fantasie = $("label.active .linkLanguage").attr('id');
		$( ".selectTask a" ).hide(300);
		$( ".selectTask a" ).show(300);
	});
	
	
	$(".tasksTable td").on('click', 'a', function(e) {
		e.preventDefault();
		e.stopPropagation();
		
		var href = $(this).attr('href');
		var fantasie = $("label.active .linkLanguage").attr('id');
		
		// "special links" that do not match on wikia sites
		if(href == "Ron_the_Ripper" && fantasie == "http://tibiawiki.com.br/wiki/")
			href = "Ron_The_Ripper";

		var target = fantasie + href;
		window.open(target);
	});
	
	var creatureName = $("div.selectTask tbody td:nth-child(1)")
	var bossName = $("div.selectTask tbody td:nth-child(4)");
	// creatures which from you can't strip"s" away.
	var nostrip = ["Demodras", "Werewolves", "High Class Lizards"]
	
	// creatures with "difficult names", easier just to type the name here than make the code more complicated.
	// just add class ="manual" to td and manually add the links (this script won't execute)
	// example text (manual) = <a target='0' href="kongra">Kongra</a>
	creatureName.each(function() {
		var name = $(this).text();
		var link = name.replace(/ /g, '_');
		var len = link.length
		var s = link.charAt(len -1);
		
		if(s == "s" && nostrip.indexOf(name) == "-1") {
			link = link.substring(0, len-1);
		}
		
		var newText
		if(name.indexOf(" ,") != '-1') {
			newText = "<a target='0' href="+ link +">"+ name +"</a>";
		} else 
			newText = "<a target='0' href="+ link +">"+ name +"</a>";
	
		
		if($(this).hasClass('manual')) {
			return;
		}
		$(this).html(newText);
	});
	
	bossName.each(function() {
		var name = $(this).text();
		if($(this).hasClass('manual') || name == "-") {
			return;
		}
		
		var link = name.replace(/ /g, '_');
		
		var newText
		if(name.indexOf(" ,") != '-1') {
			newText = "<a target='0' href="+ link +">"+ name +"</a>";
		} else 
			newText = "<a target='0' href="+ link +">"+ name +"</a>";
		$(this).html(newText);
	});
});
</script>
<div class="col-md-9 col-sm-12" id="wrapper">
	<div class="page-header" style="margin-bottom:-35px;"><h3>Tasks</h3></div><hr>
	You can do hunting tasks on Grizzly Adams by joining the Paw and Fur - hunting elite.<br>
	On GodLike you are <i>required</i> to kill the boss (if any) to complete a task, if you fail on your mission on defeating the boss, you will be able to try again and again until you success.
	<br><br>
	Here's list of the tasks you can do at the moment <small class="pull-right">Updated 27.10.2015</small>.<br>
	<div class="selectLevel">
		<div>
			<button id="49tasks" style="margin-left:3px;" class="btn btn-default">Level 6-49 Tasks</button>
			<button id="79tasks" class="btn btn-default">Level 50-79 Tasks</button>
			<button id="129tasks" class="btn btn-default">Level 80-129 Tasks</button>
			<button id="130tasks" class="btn btn-default">Level 130+ Tasks</button>
			<button id="others"class="btn btn-default">Special</button>
		</div>
	</div>
	<div class="linkDiv pull-right">
		  <div id="period-group" class="btn-group" data-toggle="buttons">
				<label class="btn-sm pull-left">
					Links: 
				</label>
				<label class="btn btn-primary btn-sm active">
					<input type="radio" class="linkLanguage active" id="http://www.tibia.wikia.com/wiki/"> Tibia.wikia.com (English)
				</label>
				<label class="btn btn-primary btn-sm">
					<input type="radio" class="linkLanguage" id="http://tibiawiki.com.br/wiki/"> Tibiawiki.com.br (Portugese)
				</label>
		  </div>
	</div>
	<div class="selectTask">
	<br><br>
		<table style="margin-top: 0px;" class="table table-striped table-condensed tasksTable table-hover">
			<thead>
				<tr>
					<th width="250px">Creature</th>
					<th width="65px">Amount</th>
					<th width="105px">Reward</th>
					<th>Boss</th>
				</tr>
			</thead>
			<tbody id="49taskslist">
				<tr>
					<td>Crocodiles</td>
					<td>300</td>
					<td>800 exp</td>
					<td>The Snapper</td>
				</tr>
				<tr>
					<td>Badgers</td>
					<td>300</td>
					<td>500 exp</td>
					<td>-</td>
				</tr>
				<tr>
					<td>Tarantulas</td>
					<td>300</td>
					<td>1500 exp</td>
					<td>Hide</td>
				</tr>
				<tr>
					<td>Carniphilas</td>
					<td>150</td>
					<td>2500 exp</td>
					<td>Deathbine</td>
				</tr>
				<tr>
					<td>Stone Golems</td>
					<td>200</td>
					<td>2000 exp</td>
					<td>-</td>
				</tr>
				<tr>
					<td>Mammoths</td>
					<td>300</td>
					<td>5000 exp</td>
					<td>The Bloodtusk</td>
				</tr>
				<tr>
					<td>Gnarlhounds</td>
					<td>300</td>
					<td>1000 exp</td>
					<td>-</td>
				</tr>
				<tr>
					<td>Terramites</td>
					<td>300</td>
					<td>2500 exp</td>
					<td>-</td>
				</tr>
				<tr>
					<td class="manual customImg" id="Kongra">
						<a href="kongra">Kongras</a>,
						<a href="sibang">Sibangs</a>,
						<a href="merklin">Merklins</a>
					</td>
					<td>300</td>
					<td>1000 exp</td>
					<td>-</td>
				</tr>
				<tr>
					<td>Thornback Tortoises</td>
					<td>300</td>
					<td>1500 exp</td>
					<td>-</td>
				</tr>
				<tr>
					<td>Gargoyles</td>
					<td>200</td>
					<td>1500 exp</td>
					<td>-</td>
				</tr>
			</tbody>
			<tbody style="display:none" id="79taskslist">
				<tr>
					<td>Ice Golems</td>
					<td>300</td>
					<td>12000 exp</td>
					<td>Shardhead</td>
				</tr>
				<tr>
					<td class="customImg" id="Quara_Constrictor_Scout">
						Quara Scouts
					</td>
					<td>400</td>
					<td>10000 exp</td>
					<td>-</td>
				</tr>
				<tr>
					<td>Mutated Rats</td>
					<td>400</td>
					<td>10000 exp</td>
					<td>Esmeralda</td>
				</tr>
				<tr>
					<td>Ancient Scarabs</td>
					<td>250</td>
					<td>15000 exp</td>
					<td>Fleshcrawler</td>
				</tr>
				<tr>
					<td>Wyverns</td>
					<td>300</td>
					<td>12000 exp</td>
					<td>-</td>
				</tr>
				<tr>
					<td>Lancer Beetles</td>
					<td>300</td>
					<td>8000 exp</td>
					<td>-</td>
				</tr>
				<tr>
					<td>Wailing Widows</td>
					<td>400</td>
					<td>12000 exp</td>
					<td>-</td>
				</tr>
				<tr>
					<td>Killer Caimans</td>
					<td>250</td>
					<td>10000 exp</td>
					<td>-</td>
				</tr>
				<tr>
					<td>Bonebeasts</td>
					<td>300</td>
					<td>12000 exp</td>
					<td>Ribstride</td>
				</tr>
				<tr>
					<td>Crystal Spiders</td>
					<td>300</td>
					<td>15000 exp</td>
					<td>Bloodweb</td>
				</tr>
				<tr>
					<td>Mutated Tigers</td>
					<td>250</td>
					<td>12000 exp</td>
					<td>-</td>
				</tr>
			</tbody>
			<tbody style="display:none" id="129taskslist">
				<tr>
					<td class="manual customImg" id="Quara_Pincher">
						<a href="quara">Underwater Quara</a>
					</td>
					<td>600</td>
					<td>15000 exp</td>
					<td>Thul</td>
				</tr>
				<tr>
					<td>Giant Spider</td>
					<td>500</td>
					<td>20000 exp</td>
					<td>The Old Widow</td>
				</tr>
				<tr>
					<td class="customImg" id="Werewolf">
						Werewolves
					</td>
					<td>300</td>
					<td>30000 exp</td>
					<td>Hemming</td>
				</tr>
				<tr>
					<td class="manual customImg" id="Nightmare">
						<a target='0' href="Nightmare">Nightmare</a>,
						<a target='0' href="Nightmare_Scion">Nightmare Scion</a>
					</td>
					<td>400</td>
					<td>25000 exp</td>
					<td>Tormentor</td>
				</tr>
				<tr>
					<td>Hellspawns</td>
					<td>600</td>
					<td>25000 exp</td>
					<td>Flameborn</td>
				</tr>
				<tr>
					<td class="customImg" id="Lizard_High_Guard">
						High Class Lizards
					</td>
					<td>800</td>
					<td>30000 exp</td>
					<td>Fazzrah</td>
				</tr>
				<tr>
					<td>Stampors</td>
					<td>600</td>
					<td>20000 exp</td>
					<td>Tromphonyte</td>
				</tr>
				<tr>
					<td>Brimstone Bugs</td>
					<td>500</td>
					<td>15000 exp</td>
					<td>Sulphur Scuttler</td>
				</tr>
				<tr>
					<td>Mutated Bats</td>
					<td>400</td>
					<td>20000 exp</td>
					<td>Bruise Payne</td>
				</tr>
			</tbody>
			<tbody style="display:none" id="130taskslist">
				<tr>
					<td>Hydras</td>
					<td>650</td>
					<td>30000 exp</td>
					<td>The Many</td>
				</tr>
				<tr>
					<td>Serpent Spawns</td>
					<td>800</td>
					<td>30000 exp</td>
					<td>The Noxious Spawn</td>
				</tr>
				<tr>
					<td class="manual customImg" id="Medusa">
						<a href="medusa">Medusae</a>
					</td>
					<td>500</td>
					<td>40000 exp</td>
					<td>Gorgo</td>
				</tr>
				<tr>
					<td>Behemoths</td>
					<td>700</td>
					<td>30000 exp</td>
					<td>Stonecracker</td>
				</tr>
				<tr>
					<td>Sea Serpents</td>
					<td>900</td>
					<td>30000 exp</td>
					<td>Leviathan</td>
				</tr>
				<tr>
					<td>Hellhounds</td>
					<td>250</td>
					<td>40000 exp</td>
					<td>Kerberos</td>
				</tr>
				<tr>
					<td>Ghastly Dragons</td>
					<td>500</td>
					<td>30000 exp</td>
					<td>Ethershreck</td>
				</tr>
				<tr>
					<td class="customImg" id="Draken_Elite">
						Drakens
					</td>
					<td>900</td>
					<td>30000 exp</td>
					<td>Paiz the Pauperizer</td>
				</tr>
				<tr>
					<td>Destroyers</td>
					<td>900</td>
					<td>30000 exp</td>
					<td>Bretzecutioner</td>
				</tr>
				<tr>
					<td>Undead Dragons</td>
					<td>650</td>
					<td>50000 exp</td>
					<td>Zanakeph</td>
				</tr>
			</tbody>
			<tbody style="display:none" id="otherslist">
				<tr>
					<td>Tiquandas Revenge</td>
					<td>1</td>
					<td colspan="2">None, requires trophy hunter rank and level 90</td>
				</tr>
				<tr>
					<td>Demodras</td>
					<td>1</td>
					<td colspan="2">None, requires trophy hunter rank and level 100</td>
				</tr>
				<tr>
					<td>Demons</td>
					<td>666</td>
					<td colspan="2">
						None, requires elite hunter rank and level 130.<br>
						<a href="Holy_Icon">Holy Icon</a> and ability to start <a href="The_Demon_Oak_Quest">the demon oak quest</a>.
					</td>
				</tr>
				<tr>
					<td>Necromancer</td>
					<td>4000</td>
					<td colspan="2">Ability to kill a <a href="Necropharus">Necropharus</a>, task starts at <a href="lugri">Lugri</a>.</td>
				</tr>
				<tr>
					<td class="customImg manual" id="Pirate_Marauder">
						<a href="Pirate_Marauder">Pirate Marauders</a>,<br>
						<a href="Pirate_Cutthroat">Pirate Cutthroats</a>,<br>
						<a href="Pirate_Buccaneer">Pirate Buccaneers</a> and <br>
						<a href="Pirate_Corsair">Pirate Corsairs</a>
					</td>
					<td>3000</td>
					<td class="manual" colspan="2">Ability to kill a one of the following bosses:<br>
						<a href="Brutus_Bloodbeard">Brutus Bloodbeard</a>, 
						<a href="Deadeye_Devious">Deadeye Devious</a>,
						<a href="Lethal_Lissy">Lethal Lissy</a> or 
						<a href="Ron_the_Ripper">Ron the Ripper</a>.
						Task starts at <a href="Raymond_Striker">Raymond Striker</a>.</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
	<!-- side panels here -->
	<style>
.panel-default>.panel-heading {
    border-color: #403E3E;	
}
.headingP {
	min-height:42px;
	padding:0px;
}
.headingP>span.focused {
    background: linear-gradient(#337AB7, #103f67);
}
.headingP>span:not(.focused) {
	cursor:pointer;
}
.headingP>span {
    width: 50%;
    padding-left: 13px;
    vertical-align: middle;
    line-height: 41px;
}
.headingP > i.fa {
    margin-right: -15px;
    font-size: 18px;
    margin-top: -10px;
    background-color: rgba(183, 183, 183, 0.1);
    padding: 11.5px;
    padding-left: 15px;
    border-left: 1px solid #403E3E;
	cursor:pointer;
}
#topGuilds, #events {
	display:none;
}
.panel1 {
	height:203px;
}
.score {
    margin: 0;
    font-weight: 600;
    font-size: 15px;
}
.warinfoJe {
	cursor:pointer;
}
.qw {
	display:none;
}
.fb-page iframe {
	height: 155px !important;
}
</style>
