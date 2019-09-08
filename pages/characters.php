<link href="<?PHP echo $layout_name; ?>/assets/css/custom.css" rel="stylesheet" type="text/css">

<?php
if(!defined('INITIALIZED'))
	exit;

function getTimeString($seconds)
{
	$text = "";
	$days = floor(($seconds / 3600) / 24);
	$hours = floor(($seconds / 3600) % 24);
   	$minutes = floor(($seconds / 3600) % 60);
	if ($days != 0) {

		if ($days > 1) {
 			$text .= $days . " days";
		} else {
			 $text .= "1 day";
		}
	}

    if ($hours != 0) {
		if ($days != 0) {
			$text .= ", ";
		}

		if ($hours > 1) {
	        $text .= $hours . " hours";
	    } else {
	        $text .= "1 hour";
	    }
    }

    if ($minutes != 0) {
        if ($days != 0 || $hours != 0) {
            $text .= " and ";
        }

        if ($minutes > 1) {
            $text .= $minutes ." minutes";
        } else {
            $text .= "1 minute";
        }
    }

    return $text;
}

$name = '';
if (isset($_REQUEST['name']))
	$name = (string) $_REQUEST['name'];

$showSearch = true;
if(!empty($name))
{
	$player = new Player();
	$player->find($name);
	if($player->isLoaded())
	{
		$showSearch = false;
		$number_of_rows = 0;
		$account = $player->getAccount();

		// Character Information - Start
		$main_content .= '<div class="panel panel-default"><div class="panel-heading"><h3 class="panel-title">Character Information</h3></div><div class="panel-body"><table class="table table-striped table-condensed table-content"><tbody>';
		$main_content .= '<tr><td width="20%">Name:</td><td>' . htmlspecialchars($player->getName()); 	
		if($player->isBanned() || $account->isBanned())
			$main_content .= '<span style="color:red">[BANNED]</span>';
		if($player->isNamelocked())
			$main_content .= '<span style="color:red">[NAMELOCKED]</span>';
		$main_content .= '</td></tr>';

		if(in_array($player->getGroup(), $config['site']['groups_support']))
		{
			$main_content .= '<tr><td>Position:</td><td>' . htmlspecialchars(Website::getGroupName($player->getGroup())) . '</td></tr>';
		}

		$main_content .= '<tr><td>Sex:</td><td>' . htmlspecialchars((($player->getSex() == 0) ? 'female' : 'male')) . '</td></tr>';
		$main_content .= '<tr><td>Profession:</td><td>' . htmlspecialchars(Website::getVocationName($player->getVocation())) . '</td></tr>';
		$main_content .= '<tr><td>Level:</td><td>' . htmlspecialchars($player->getLevel()) . '</td></tr>';
		$main_content .= '<tr><td>Crown Tokens:</td><td>'.$account->getTokens().'</td></tr>';
		$main_content .= '<tr><td>Residence:</td><td>' . htmlspecialchars($towns_list[$player->getTownID()]) . '</td></tr>';

		$rank_of_player = $player->getRank();
		if(!empty($rank_of_player))
		{
			$main_content .= '<tr><td>Guild Membership:</td><td>' . htmlspecialchars($rank_of_player->getName()) . ' of the <a href="?view=guilds&action=show&guild='. $rank_of_player->getGuild()->getID() .'">' . htmlspecialchars($rank_of_player->getGuild()->getName()) . '</a></td></tr>';
		}

		$comment = $player->getComment();
		$newlines = array("\r\n", "\n", "\r");
		$comment_with_lines = str_replace($newlines, '<br />', $comment, $count);
		if($count < 50)
			$comment = $comment_with_lines;
		if(!empty($comment))
		{
			$main_content .= '<tr><td>Comment:</td><td>' . $comment . '</td></tr>';
		}




		// Character Information - }
		$main_content .= '</tbody></table></div>';


		$verifica_item_id = function ($pid) use ($player) {
            $kalabok = (array_keys($player->getItems()->getItem($pid)) === []?'':array_keys($player->getItems()->getItem($pid))[0]);
            if ($player->getItems()->getItem($pid)[$kalabok]->data['itemtype'] == NULL) {
                return $pid;
            } else {
                $item_id = $player->getItems()->getItem($pid)[$kalabok]->data['itemtype'];
                return $item_id;
            }
        };

		$player_info = $player->data;
        $mount_id = $player->getStorage('10002011');
        $cur_outfit = "<img style='text-decoration:none;margin: 0 0 0 -13px;' class='outfitImgsell2' src='http://outfit-images.ots.me/animatedOutfits1099/animoutfit.php?id={$player_info['looktype']}&addons={$player_info['lookaddons']}&head={$player_info['lookhead']}&body={$player_info['lookbody']}&legs={$player_info['looklegs']}&feet={$player_info['lookfeet']}&mount=" . ($mount_id == NULL ? 0 : $mount_id) . "' alt='' name=''>";

        $hpPercent = max(0, min(100, $player->getHealth() / max(1, $player->getHealthMax()) * 100));
        $manaPercent = max(0, min(100, $player->getMana() / max(1, $player->getManaMax()) * 100));
		 $staminaDefault = 151200000;
                    $staminaPlayer = $player->getCustomField("stamina");
                    $currentlevelexp = (50 * ($player->getLevel() - 1) * ($player->getLevel() - 1) * ($player->getLevel() - 1) - 150 * ($player->getLevel() - 1) * ($player->getLevel() - 1) + 400 * ($player->getLevel() - 1)) / 3;
                    function getTime($value)
                    {
                        //1hora = 60
                        //60min = 3600
                        //$value = 1255;
                        $h = floor($value / 60);
                        //41 =          2510/60
                        $m = floor(($value - $h * 60));
                        //x = floor((2510 - 41*60));
                        //x = floor(2510 - 2460)
                        //x = 50
                        
                        if ($m == '0') {
                            $m = '00';
                        }
                        
                        return $h . ':' . $m;
                    }

                    if($staminaPlayer >= 2400){
                        //40horas = 2400
                        $colorbg = 'lime';
                    }elseif($staminaPlayer >= 1200){
                        //20horas = 1200
                        $colorbg = 'orange';
                    }elseif($staminaPlayer >= 600){
                        //10horas = 600
                        $colorbg = 'yellow';
                    }else{
                        //menos que 10horas 
                        $colorbg = 'red';
                    }
                    $stamminaPer = ($staminaPlayer / $staminaDefault) * 100;

		$expCurrent = Functions::getExpForLevel($player->getLevel());
        $expNext = Functions::getExpForLevel($player->getLevel() + 1);
        $expLeft = bcsub($expNext, $player->getExperience(), 0);
        $expLeftPercent = max(0, min(100, ($player->getExperience() - $expCurrent) / ($expNext - $expCurrent) * 100));
        
		$main_content .= '
		<br>
		<div class="panel panel-default">
	<div class="panel-heading">
		Additional Information
	</div>
	<div class="nk-tabs">		
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" href="#Extra" role="tab" data-toggle="tab">Equipment/Skills</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#Quests" role="tab" data-toggle="tab">Quests</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#Achievements" role="tab" data-toggle="tab">Achievements</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#Tasks" role="tab" data-toggle="tab">Tasks</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#Deaths" role="tab" data-toggle="tab">Deaths</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#Outfits" role="tab" data-toggle="tab">Outfits</a>
                                </li>
                            </ul>

		<div class="tab-content">
			<div class="tab-pane active" id="Extra">
				<div class="row">
					<br>
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-heading">Statistics</div>
							<div class="panel-body panel-player-extra">
								<div align="center">Health</div>
								<div class="progress">
									<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="49224" aria-valuemin="0" aria-valuemax="49224" style="width: 100%;">
										<td style="background-color: #30363e align="left"><font color="white">'.$player->getHealth().' / '.$player->getHealthMax().'<div style="width: 100%; height: 5px; border: 1px solid #000;"><div style="background-image: url(../images/skills/hp.png); width: ' . $hpPercent . '%; height: 3px;"></font></td></tr></div></div>
									</div>
								</div>
								<div align="center">Mana</div>
								<div class="progress">
									<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="8790" aria-valuemin="0" aria-valuemax="8790" style="width: 100%">
										 <tr><td style="background-color: #30363e align="left"><b></b></td><td style="background-color: #30363e align="left"><font color="white">' . $player->getMana() . ' / ' . $player->getManaMax() . '<div style="width: 100%; height: 5px; border: 1px solid #000;"><div style="background-image: url(../images/skills/mana.png); width: '.$manaPercent.'%; height: 3px;"></font></td></tr></div></div>
									</div>
								</div>
								<div align="center">Soul</div>
								<div class="progress">
									<div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="200" aria-valuemin="0" aria-valuemax="200" style="width: 100%">
										<span style="color:white">' . $player->getSoul() . '</span>
									</div>
								</div>
								<div align="center">Stamina</div>
								<div class="progress">
									<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="2520" aria-valuemin="0" aria-valuemax="2520" style="width: 100%">
										<span style="color:white"><div class="stamina"><font style="text-shadow: -1px -1px 0 rgba(0,0,0,0.50),1px -1px 0 rgba(0,0,0,0.50),-1px 1px 0 rgba(0,0,0,0.50),1px 1px 0 rgba(0,0,0,0.50);" color="' . $colorbg . '">' . getTime($staminaPlayer) . '</font></div></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						
						<div class="panel panel-default">
							<div class="panel-heading">Equipment</div>
							<div class="panel-body panel-player-extra">
								<table class="table table-striped table-hover table-fixed">
									<tbody><tr>
										<td style="background-color: #0e0e0e; text-align: center;"><img src="images/equipaments/'.$verifica_item_id(2).'.gif" class="CharItems"></td>
										<td style="background-color: #0e0e0e; text-align: center;"><img src="images/equipaments/'.$verifica_item_id(1).'.gif" class="CharItems"></td>
										<td style="background-color: #0e0e0e; text-align: center;"><img src="images/equipaments/'.$verifica_item_id(3).'.gif" class="CharItems"></td>
									</tr>
									<tr>
											<td style="background-color: #0e0e0e; text-align: center;"><img src="images/equipaments/'.$verifica_item_id(6).'.gif" class="CharItems"></td>
											<td style="background-color: #0e0e0e; text-align: center;"><img src="images/equipaments/'.$verifica_item_id(4).'.gif" class="CharItems"></td>
											<td style="background-color: #0e0e0e; text-align: center;"><img src="images/equipaments/'.$verifica_item_id(5).'.gif" class="CharItems"></td>
									</tr>
									<tr>
											<td style="background-color: #0e0e0e; text-align: center;"><img src="images/equipaments/'.$verifica_item_id(9).'.gif" class="CharItems"></td>
											<td style="background-color: #0e0e0e; text-align: center;"><img src="images/equipaments/'.$verifica_item_id(7).'.gif" class="CharItems"></td>
											<td style="background-color: #0e0e0e; text-align: center;"><img src="images/equipaments/'.$verifica_item_id(10).'.gif" class="CharItems"></td>
									</tr>
									<tr>
										<td align="center">Soul: ' . $player->getSoul() . '</td>
										</td><td style="background-color: #0e0e0e; text-align: center;"><img src="images/equipaments/'.$verifica_item_id(8).'.gif" class="CharItems"></td>
										<td align="center">Cap: ' . $player->getCapacity() . '</td>
									</tr>
								</tbody></table>
							</div>
						</div>
						
					</div>
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-heading">Skills</div>
							<div class="panel-body panel-player-extra">
								<table class="table table-striped table-hover table-fixed">
									<tbody><tr>
										<td class="left">Magic Level</td>
										<td class="right">' . $player->getMagLevel().'</td>
									</tr>
									<tr>
										<td class="left">Club</td>
										<td class="right">' . $player->getSkill(1) . '</td>
									</tr>
									<tr>
										<td class="left">Sword</td>
										<td class="right">' . $player->getSkill(2) . '</td>
									</tr>
									<tr>
										<td class="left">Axe</td>
										<td class="right">' . $player->getSkill(3) . '</td>
									</tr>
									<tr>
										<td class="left">Distance</td>
										<td class="right">' . $player->getSkill(4) . '</td>
									</tr>
									<tr>
										<td class="left">Shielding</td>
										<td class="right">' . $player->getSkill(5) . '</td>
									</tr>
									<tr>
										<td class="left">Fishing</td>
										<td class="right">' . $player->getSkill(6) . '</td>
									</tr>
								</tbody></table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="Quests">
				<table class="table table-striped table-hover table-fixed">
				<tbody><tr> ';
				
				        // Quest list show
            if ($config['site']['showQuests']) {
                $main_content .= '';
                $quests = $config['site']['quests'];
                $questCount = count($config['site']['quests']);
                $questCountDone = 0;
                $number_of_rows = 0;
                $bgcolor = $config['site']['lightborder'];

                foreach($quests as $storage => $name) {

                    $quest = $SQL->query('SELECT * FROM player_storage WHERE player_id = ' . $player->getId() . ' AND `key` = ' . $name['storageid'] . ';')->fetch();

                    if (is_int($number_of_rows / 2)) {
                        if ($bgcolor == $config['site']['darkborder']) {
                            $questList .= '<TR bgcolor="#0e0e0e">';
                            $bgcolor = $config['site']['lightborder'];
                        } else {
                            $questList .= '<TR bgcolor="#0e0e0e">';
                            $bgcolor = $config['site']['darkborder'];
                        }
                    }

                    if ($quest == false) {
                        $questList .= '<TD bgcolor="#0e0e0e"><img src="images/false.png"/></TD>';
                        $questList .= '<TD bgcolor="#0e0e0e" WIDTH=49%>&nbsp;&nbsp;' . $storage . '</TD>';
                    } else {
                        $questList .= '<TD bgcolor="#0e0e0e"><img src="images/true.png"/></TD>';
                        $questList .= '<TD bgcolor="#0e0e0e" WIDTH=49%><b><font color="green">&nbsp;&nbsp;&nbsp;' . $storage . '</font></b></TD>';
                        $questCountDone++;
                    }
                    if (!is_int($questCount/2)) {

                        if (!is_int($number_of_rows / 2) || $number_of_rows + 1 == $questCount) {

                            if ($number_of_rows + 1 == $questCount) {
                                if ($bgcolor == $config['site']['darkborder']) {

                                    $questList .= '<td colspan="2">&nbsp;</td>';

                                } else {
                                    $questList .= '<td colspan="2">&nbsp;</td>';
                                }
                            }
                            $questList .= '</TR>';
                        }
                    }
                    $number_of_rows++;
                }                
            }

            if ($config['site']['showQuests'] || $config['site']['showTasks']) {

                $main_content .= '<BR>
				<table class="table table-striped table-condensed table-content" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="InnerTableContainer">
                                            
                                                ';
                if ($config['site']['showQuests']) {
                    $ilosc_procent = ($questCountDone / $questCount) * 100;
                    $main_content .= '
                    <table style="width:100%;">
                        <tbody>
                                                    <tr>
                                                        <td>
                                                     ';
                                    
                                    $main_content .='
                                    <table border="0" cellspacing="1" cellpadding="4" width="100%">
                                        <tbody>
                                        <tr bgcolor="#0e0e0e">
												<td bgcolor="#0e0e0e" colspan="2" width="15%">
                                                    <b>Quests: </b>
                                                </td>
                                                <td>
                                                    <progress max="100" value="' . $ilosc_procent . '"></progress>
                                                </td>
                                                <td bgcolor="#0e0e0e">
                                                    <b>' . intval($ilosc_procent < 10 ? 0 ."". $ilosc_procent : $ilosc_procent) . '%</b>
                                                </td>
                                        </tr>
                                        </tbody>
                                    </table>';
                                    $main_content .='                                                            
                                    <table class="table table-striped table-condensed table-content" BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>
                                    ' . $questList . '
                                    </TABLE></span>

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        
                    ';
                }
                $main_content .= '
                           
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                ';

            }
				
				
				
				$main_content .= '</tr></tbody></table>
			</div>
			<div class="tab-pane" id="Achievements">
				<table class="table table-striped table-hover table-fixed">
				
					
					<tbody><tr>
						<td>The Very Best, Like No One Ever Was
							
						</td>
						<td class="col-md-2" align="right">
							
								<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
							
						</td>
					</tr>
					
					<tr>
						<td>The Forge Key
							
						</td>
						<td class="col-md-2" align="right">
							
								<i class="fa fa-star" aria-hidden="true"></i>
							
						</td>
					</tr>
				
				
				</tbody></table>
			</div>
			<div class="tab-pane" id="Tasks">
				<table class="table table-striped table-hover table-fixed">
				
					<tbody>';
					
					 // Task list show

	   //GARBAGE FUNC
			$getStorageValueTask = function ($pid, $key) use ($SQL){
				if($storage->rowCount() > 0){
					return $storage->fetchAll();
				}else{
					return FALSE;
				}
			};
	
			$showKillValue = function ($pid, $key) use ($SQL){

				$storage = $SQL->prepare("SELECT * FROM `player_storage` WHERE `player_id` = :id AND `key` = :key");
				
				$storage->execute(['id' => $pid, 'key' => $key]);
				$kill = $storage->fetch();
				if(!$kill){return "0";}
				if ($kill[0]['value'] == 1){					
					return $kill[0]['value']. ' Kill';
				}else{
					return $kill[0]['value']. ' Kills';
				}
			};

			//var_dump($player->getId());
			//$storage = $SQL->query("SELECT * FROM `player_storage` WHERE `player_id` = '583' AND `key` = '21122'")->fetchAll();
			//$storage->execute(['id' => 583, 'key' => 21122]);
			$teste = $showKillValue((int)$player->getId(), 65000);
			$hotimg = "<img style='margin-left:10px;' src='".$layout_name."/assets/images/hot2-fix.gif' />";
			$btstorage = 35000;
			$tasks["tasks"] = array(
					"<b>Trolls</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+1)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+1), "startvalue" => 0, "endvalue" => 20000),
					"<b>Goblins</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+2)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+2), "startvalue" => 0, "endvalue" => 20000),
					"<b>Crocodiles</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+3)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+3), "startvalue" => 0, "endvalue" => 20000),
					"<b>Badgers</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+4)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+4), "startvalue" => 0, "endvalue" => 20000),
					"<b>Tarantulas</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+5)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+5), "startvalue" => 0, "endvalue" => 20000),
					"<b>Carniphilas</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+6)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+6), "startvalue" => 0, "endvalue" => 20000),
					"<b>Stone Golems</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+7)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+7), "startvalue" => 0, "endvalue" => 20000),
					"<b>Mammoths</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+8)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+8), "startvalue" => 0, "endvalue" => 20000),
					"<b>Gnarlhounds</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+9)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+9), "startvalue" => 0, "endvalue" => 20000),
					"<b>Terramites</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+10)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+10), "startvalue" => 0, "endvalue" => 20000),
					"<b>Apes</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+11)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+11), "startvalue" => 0, "endvalue" => 20000),
					"<b>Thornback Tortoises</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+12)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+12), "startvalue" => 0, "endvalue" => 20000),
					"<b>Gargoyles</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+13)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+13), "startvalue" => 0, "endvalue" => 20000),
					"<b>Ice Golems</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+14)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+14), "startvalue" => 0, "endvalue" => 20000),
					"<b>Quara Scouts</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+15)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+15), "startvalue" => 0, "endvalue" => 20000),
					"<b>Mutated Rats</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+16)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+16), "startvalue" => 0, "endvalue" => 20000),
					"<b>Ancient Scarabs</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+17)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+17), "startvalue" => 0, "endvalue" => 20000),
					"<b>Wyverns</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+18)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+18), "startvalue" => 0, "endvalue" => 20000),
					"<b>Lancer Beetles</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+19)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+19), "startvalue" => 0, "endvalue" => 20000),
					"<b>Wailing Widows</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+20)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+20), "startvalue" => 0, "endvalue" => 20000),
					"<b>Killer Caimans</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+21)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+21), "startvalue" => 0, "endvalue" => 20000),
					"<b>Bonebeasts</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+22)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+22), "startvalue" => 0, "endvalue" => 20000),
					"<b>Crystal Spider</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+23)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+23), "startvalue" => 0, "endvalue" => 20000),
					"<b>Mutated Tigers</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+24)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+24), "startvalue" => 0, "endvalue" => 20000),
					"<b>Underwater Quara</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+25)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+25), "startvalue" => 0, "endvalue" => 20000),
					"<b>Giant Spiders</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+26)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+26), "startvalue" => 0, "endvalue" => 20000),
					"<b>Werewolves</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+27)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+27), "startvalue" => 0, "endvalue" => 20000),
					"<b>Nightmares</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+28)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+28), "startvalue" => 0, "endvalue" => 20000),
					"<b>Hellspawns</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+29)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+29), "startvalue" => 0, "endvalue" => 20000),
					"<b>High Class Lizards</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+30)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+30), "startvalue" => 0, "endvalue" => 20000),
					"<b>Stampors</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+31)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+31), "startvalue" => 0, "endvalue" => 20000),
					"<b>Brimstone Bugs</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+32)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+32), "startvalue" => 0, "endvalue" => 20000),
					"<b>Mutated Bats</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+33)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+33), "startvalue" => 0, "endvalue" => 20000),
					"<b>Hydras</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+34)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+34), "startvalue" => 0, "endvalue" => 20000),
					"<b>Serpent Spawns</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+35)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+35), "startvalue" => 0, "endvalue" => 20000),
					"<b>Medusas</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+36)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+36), "startvalue" => 0, "endvalue" => 20000),
					"<b>Behemoths</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+37)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+37), "startvalue" => 0, "endvalue" => 20000),
					"<b>Sea Serpents and Young Sea Serpent</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+38)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+38), "startvalue" => 0, "endvalue" => 20000),
					"<b>Hellhounds</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+39)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+39), "startvalue" => 0, "endvalue" => 20000),
					"<b>Ghastly Dragons</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+40)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+40), "startvalue" => 0, "endvalue" => 20000),
					"<b>Drakens</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+41)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+41), "startvalue" => 0, "endvalue" => 250),
					"<b>Destroyers</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+42)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+42), "startvalue" => 0, "endvalue" => 20000),
					"<b>Undead Dragons</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+43)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+43), "startvalue" => 0, "endvalue" => 20000),
					"<b>Demons</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+44)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+44), "startvalue" => 0, "endvalue" => 20000),
					"<b>Green Djinns or Efreets</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+45)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+45), "startvalue" => 0, "endvalue" => 20000),
					"<b>Blue Djinns or Marids</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+46)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+46), "startvalue" => 0, "endvalue" => 20000),
					"<b>Pirates</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+47)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+47), "startvalue" => 0, "endvalue" => 20000),
					"<b>Pirates Second Task</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+48)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+48), "startvalue" => 0, "endvalue" => 20000),
					"<b>Minotaurs</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+49)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+49), "startvalue" => 0, "endvalue" => 20000),
					"<b>Necromancers and Priestess</b>".$hotimg."<br><small>&nbsp;&nbsp;Status: ".($showKillValue($player->getId(), ($btstorage+50)))." </nobr></small><br><br></nobr>" => array("storageid" => ($btstorage+50), "startvalue" => 0, "endvalue" => 20000)

			);
            if ($config['site']['showTasks']) {
                $main_content .= '';
                $tasks = $tasks['tasks'];
                $taskCount = count($tasks);
                $taskCountDone = 0;
                $number_of_rows = 0;
                $bgcolor = $config['site']['lightborder'];

                foreach($tasks as $storage => $name) {
					
                    $task = $SQL->query('SELECT * FROM player_storage WHERE player_id = ' . $player->getId() . ' AND `key` = ' . $name['storageid'] . ';')->fetch();

                    if (is_int($number_of_rows / 2)) {
                        if ($bgcolor == $config['site']['darkborder']) {
                            $taskList .= '<TR bgcolor="#0e0e0e">';
                            $bgcolor = $config['site']['lightborder'];
                        } else {
                            $taskList .= '<TR bgcolor="#0e0e0e">';
                            $bgcolor = $config['site']['darkborder'];
                        }
                    }

                    if ($showKillValue($player->getId(), $name['storageid']) < $name['endvalue']) {
                        $taskList .= '<TD bgcolor="#0e0e0e"><img src="images/star.png"  width="16" height="16"/></TD>';
                        $taskList .= '<TD bgcolor="#0e0e0e" WIDTH=49%>' . $storage . '</TD>';
                    } else {
                        $taskList .= '<TDbgcolor="#0e0e0e" ><img src="images/true.png"/></TD>';
                        $taskList .= '<TD bgcolor="#0e0e0e" WIDTH=49%><b><font color="green">' . $storage . '</font></b></TD>';
                        $taskCountDone++;
                    }
                    if (!is_int($taskCount/2)) {
                        if (!is_int($number_of_rows / 2) || $number_of_rows + 1 == $taskCount) {

                            if ($number_of_rows + 1 == $taskCount) {
                                if ($bgcolor == $config['site']['darkborder']) {

                                    $taskList .= '<td colspan="2">&nbsp;</td>';

                                } else {
                                    $taskList .= '<td colspan="2">&nbsp;</td>';
                                }
                            }
                            $taskList .= '</TR>';
                        }
                    }
                    $number_of_rows++;
                }                
            }
			
			 if ($config['site']['showQuests'] || $config['site']['showTasks']) {

                $main_content .= '<BR>
				<table class="table table-striped table-condensed table-content" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="InnerTableContainer">
                                            
                                                ';
                if ($config['site']['showTasks']) {
                    $task_ilosc_procent = ($taskCountDone / $taskCount) * 100;
                    $main_content .= '
                    <table style="width:100%;">
                    <tbody>
                                                    <tr>
                                                        <td>';
                                    $main_content .='
                                    <table border="0" cellspacing="1" cellpadding="4" width="100%">
                                        <tbody>
                                        <tr bgcolor="#f9f9f9">
                                                <td colspan="2" width="15%" class="white">
                                                    <b>Tasks: </b>
                                                </td>
                                                <td>
                                                    <progress max="100" value="' . $task_ilosc_procent . '"></progress>
                                                </td>
                                                <td class="white">
                                                    <b>' . intval($task_ilosc_procent  < 10 ? 0 ."". $task_ilosc_procent : $task_ilosc_procent) . '%</b>
                                                </td>
                                        </tr>
                                        </tbody>
                                    </table>'; 

                                    $main_content .='
                                    <table class="table table-striped table-condensed table-content" BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>
                                    ' . $taskList . '
                                    </TABLE>
                                    </span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
											';
                }
                $main_content .= '
                           
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                ';

            }
		
				
				$main_content .= '</tbody></table>
			</div>
			<div class="tab-pane" id="Dungeons">
				<table class="table table-striped table-hover table-fixed">
					<thead>
						<tr>
							<th>Dungeon</th>
							<th>Level</th>
							<th>Time</th>
							<th>Team</th>
							<th>Mods</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
					
					
						<tr>
							<td>Tomb of Anubis</td>
							<td>+31</td>
							<td>10:46:40</td>
							<td>
							
								<a href="/community/player/Sztuka Baki">Sztuka Baki</a> (Level 1604, Arcane Sorcerer)<br>
							
								<a href="/community/player/Lord Asiquar">Lord Asiquar</a> (Level 1547, Divine Paladin)<br>
							
								<a href="/community/player/Anidax">Anidax</a> (Level 1512, Supreme Knight)<br>
							
								<a href="/community/player/Wood">Wood</a> (Level 1708, Supreme Knight)
							
							</td>
							<td>
							
							
								<a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Monsters have a chance to spawn a magic field on death that will heal nearby monsters and deal damage to players.">Sanguine</a><br>
							
								<a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Players periodically receive damage when below a certain health treshold.">Grievous</a><br>
							
								<a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Monsters have more health and deal increased damage.">Fortified</a>
							
							
							</td>
							<td>03/05/19 06:31 PM</td>
						</tr>
					
					
					</tbody>
				</table>
			</div>
			<div class="tab-pane" id="Deaths">
				<table class="table table-striped table-hover table-fixed">
				
					<tbody>
					<tr>
						<td class="col-md-3">';
							
							$deads = 0;
		//deaths list
		$player_deaths = new DatabaseList('PlayerDeath');
		$player_deaths->setFilter(new SQL_Filter(new SQL_Filter(new SQL_Field('player_id'), SQL_Filter::EQUAL, $player->getId()), SQL_Filter::CRITERIUM_AND,new SQL_Filter(new SQL_Field('id', 'players'), SQL_Filter::EQUAL, new SQL_Field('player_id', 'player_deaths'))));
		$player_deaths->addOrder(new SQL_Order(new SQL_Field('time'), SQL_Order::DESC));
		$player_deaths->setLimit(8);

		foreach($player_deaths as $death)
		{

			$deads++;
			$dead_add_content .= "<tr><td width=\"20%\" align=\"center\">".date("j M Y, H:i", $death->getTime())."</td><td>Died at level " . $death->getLevel() . " by " . $death->getKillerString();
			if($death->getMostDamageString() != '' && $death->getKillerString() != $death->getMostDamageString())
				$dead_add_content .= ' and ' . $death->getMostDamageString();
			$dead_add_content .= ".</td></tr>";
		}
							if ($deads > 0)
			$main_content .= '<table class="table table-striped table-condensed table-content"><tbody>' . $dead_add_content . '</tbody></TABLE>';
						$main_content .= '</td>
					</tr>
				
					
				
				
				</tbody></table>
			</div>
			
			<div class="tab-pane" id="Outfits">
				<table class="table table-striped table-hover table-fixed">
					<tbody>';
			
			$outfitsfemale = array(
					8912899 => 136, 
					8978435 => 137, 
					9043971 => 138, 
					9109507 => 139, 
					9175043 => 140, 
					9240579 => 141, 
					9306115 => 142, 
					9633795 => 147, 
					9699331 => 148, 
					9764867 => 149, 
					9830403 => 150, 
					10158083 => 155, 
					10223619 => 156, 
					10289155 => 157, 
					10354691 => 158, 
					16515075 => 252, 
					17629187 => 269, 
					17694723 => 270, 
					18284547 => 279, 
					18874371 => 288, 
					21233667 => 324, 
					22020099 => 336, 
					23986179 => 366,
					28246019 => 431, //Afflicted
					28377091 => 433, //Elementalist
					30408707 => 464, //Deepling
					30539779 => 466, //Insectoid
					30867459 => 471, //Entrepreneur
					33619971 => 513, //Crystal Warlord
					33685507 => 514, //Soil Guardian					
					37683203 => 542, //Demon Outfit
					35520515 => 575, //Cave Explorer**
					37879811 => 578, //Dream Warden
					40501251 => 618, //Glooth Engineer
					41418755 => 632, //Champion
					41615363 => 635, //Conjurer
					41680899 => 636, //Beastmaster
					43515907 => 664, //Chaos Acolyte					
					43646979 => 666, //Death Herald
					44761091 => 683, //Ranger
					45481987 => 694, //Ceremonial Garb
					45613059 => 696, //Puppeteer
					45744131 => 698, //Spirit Caller
					47448067 => 724, //Evoker
					47972355 => 732, //Seaweaver
					48824323 => 745, //Recruiter
					49086467 => 749, //Sea Dog					
					49741827 => 759, //Royal Pumpkin
					55377923 => 845, //Rift Warrior
					55836675 => 852, //Winter Warden
					57278467 => 874, //Philosopher
					57999363 => 885, //Arena Champion
					58982403 => 900, //Lupine Warden
					59572227 => 909, //Grove Keeper
					/*60882947 => 929, //Festive Outfit		
					62652419 => 956, //Pharaoh
					62783491 => 958, //Trophy Hunter
					63111171 => 963, //Retro Warrior
					63242243 => 965, //Retro Summoner
					63373315 => 967, //Retro Nobleman
					63504387 => 969, //Retro Wizard					
					63635459 => 971, //Retro Knight
					63766531 => 973, //Retro Hunter
					63766531 => 975, //Retro Citizen
					66846723 => 1020, //Herbalist
					67043331 => 1023, //Sun Priest
					68354051 => 1043, //Makeshift Warrior
					68812803 => 1050, //Siege Master
					69271555 => 1057, //Mercenary					
					70123523 => 1070, //Battle Mage
					71761923 => 1095, //Discoverer
					72286211 => 1103 //Sinister Archer*/
				); // storages
				
				$outfitsmale = array(
					8388611 => 128, //citizen
					8454147 => 129, //hunter
					8519683 => 130, //mage
					8585219 => 131, //knight
					8650755 => 132, //nobleman
					8716291 => 133, //summoner
					8781827 => 134, //warrior
					9371651 => 143, //barbarian
					9437187 => 144, //druid
					9502723 => 145, //wizard
					9568259 => 146, //oriental
					9895939 => 151, //pirate
					9961475 => 152, //assassin
					10027011 => 153, //beggar
					10092547 => 154, //shaman
					16449539 => 251, //norseman
					17563651 => 268, //nightmare
					17891331 => 273, //jester
					18219011 => 278, //brotherhood
					18939907 => 289, //demonhunter
					21299203 => 325, //yalaharian
					21954563 => 335, //warmaster
					28180483 => 430, //Afflicted
					28311555 => 432, //Elementalist
					30343171 => 463, //Deepling
					30474243 => 465, //Insectoid
					30932995 => 472, //Entrepreneur
					33554435 => 512, //Crystal Warlord
					33816579 => 516, //Soil Guardian					
					35454979 => 541, //Demon Outfit
					37814275 => 577, //Dream Warden
					39976963 => 610, //Glooth Engineer
					41484291 => 633, //Champion
					41549827 => 634, //Conjurer
					41746435 => 637, //Beastmaster
					43581443 => 665, //Chaos Acolyte					
					43712515 => 667, //Death Herald
					44826627 => 684, //Ranger
					45547523 => 695, //Ceremonial Garb
					45678595 => 697, //Puppeteer
					45809667 => 699, //Spirit Caller
					47513603 => 725, //Evoker
					48037891 => 733, //Seaweaver
					48889859 => 746, //Recruiter
					49152003 => 750, //Sea Dog					
					49807363 => 760, //Royal Pumpkin
					55443459 => 846, //Rift Warrior
					55902211 => 853, //Winter Warden
					57212931 => 873, //Philosopher
					57933827 => 884, //Arena Champion
					58916867 => 899, //Lupine Warden
					59506691 => 908, //Grove Keeper
					/*61014019 => 931, //Festive Outfit					
					62586883 => 955, //Pharaoh
					62717955 => 957, //Trophy Hunter
					62652419 => 962, //Retro Warrior
					63045635 => 964, //Retro Summoner
					63176707 => 966, //Retro Nobleman
					63307779 => 968, //Retro Wizard					
					63438851 => 970, //Retro Knight
					63569923 => 972, //Retro Hunter
					63700995 => 974, //Retro Citizen
					63832067 => 1021, //Herbalist
					66912259 => 1024, //Sun Priest
					67108867 => 1042, //Makeshift Warrior
					68288515 => 1051, //Siege Master
					68878339 => 1056, //Mercenary					
					69206019 => 1069, //Battle Mage
					70057987 => 1094, //Discoverer
					71696387 => 1102 //Sinister Archer*/
										
				); // storages	
				
				if ($player->getSex() == 1) $outfitskeys = $outfitsmale;
				else $outfitskeys = $outfitsfemale;
				
				$contentEquipment .= '	
				<table>
					<div id="equipment" class="OutfitBgrnd">';
					
						$contentEquipment .= '
						<div style="text-align: center;margin-top: -10x;">';
							foreach ($outfitskeys as $outfits => $id) 
							{
								$outfitquery = $SQL->query("SELECT * FROM `player_storage` WHERE `player_id` = ".$SQL->quote($player->getId())." AND `player_storage`.`value` = ".$SQL->quote($outfits).";")->fetch();
								
								if ($outfitquery == true )
								{	
									$contentEquipment .= '<img src="'. $config['site']['outfit_images_url'] .'?id='.$id.'&addons=3&head='.$player->getCustomField("lookhead").'&body='.$player->getCustomField("lookbody").'&legs='.$player->getCustomField("looklegs").'&feet='.$player->getCustomField("lookfeet").'">';
								} else {
									$contentEquipment .= '<img class="grayimg" src="'. $config['site']['outfit_images_url'] .'?id='.$id.'&addons=3&head=0&body=0&legs=0&feet=0">';
								}
								
							}
							$contentEquipment .= '	
				</table>';
				
				$main_content .= '
                    <TR bgcolor="#30363e">
                        <td>
                                <br>
                                <th><center>' . $contentEquipment . '</th>
                        </td>
                    </tr>';
				
				$main_content .='</tbody></table>
			</div>
			
		</div>
	</div>
</div>
		
		';

		
		// Account Information
		if (!$player->getHideChar()) {
			$main_content .= '<div class="panel panel-default"><div class="panel-heading"><h3 class="panel-title">Account Information</h3></div><div class="panel-body"><table class="table table-striped table-condensed table-content"><tbody>';
			if ($account->getRLName()) {
				$main_content .= '<tr><td width=20%>Real Name:</td><td>' . $account->getRLName() . '</td></tr>';
			}
			if ($account->getLocation()) {
				$main_content .= '<tr><td width=20%>Location:</td><td>' . $account->getLocation() . '</td></tr>';
			}

			if ($account->getLastLogin())
				$main_content .= '<tr><td width=20%>Last Login:</td><td>' . date("j F Y, g:i a", $account->getLastLogin()) . '</td></tr>';
			else
				$main_content .= '<tr><td width=20%>Last Login:</td><td>Never logged in.</td></tr>';
			if ($account->getCreateDate()) {

				$main_content .= '<tr><td width=20%>Created:</td><td>' . date("j F Y, g:i a", $account->getCreateDate()) . '</td></tr>';
			}

			$main_content .= '<tr><td>Account&#160;Status:</td><td>';
			$main_content .= ($account->isPremium() > 0) ? '<span class="label label-success">Premium Account</span>' : '<span class="label label-danger">Free Account</span>';
			if ($account->isBanned()) {
				if ($account->getBanTime() > 0)
					$main_content .= '<font color="red"> [Banished until '.date("j F Y, G:i", $account->getBanTime()).']</font>';
				else
					$main_content .= '<font color="red"> [Banished FOREVER]</font>';
			}
			$main_content .= '</td></tr></tbody></table></div></div>';

			// Characters
			$main_content .= '<div class="panel panel-default"><div class="panel-heading"><h3 class="panel-title">Characters</h3></div><div class="panel-body"><table class="table table-condensed table-content table-striped">';
			$main_content .= '<thead><tr><th>Name</th><th>Level</th><th>Status</th><th></th></tr></thead><tbody>';
			$account_players = $account->getPlayersList();
			$player_number = 0;
			foreach($account_players as $player_list) {
				if(!$player_list->getHideChar()) {
					$player_number++;

					if(!$player_list->isOnline())
						$player_list_status = '<span class="label label-danger">Offline</span>';
					else
						$player_list_status = '<span class="label label-success">Online</span>';
					$main_content .= '<tr><td style="width:52%;'.($name == $player_list->getNAme() ? 'font-weight:bold;' : '').'">'.htmlspecialchars($player_list->getName());
					$main_content .= ($player_list->isDeleted()) ? ' <span class="label label-danger">Deleted</span>' : '';
					$main_content .= '</td><td width=25%>'.$player_list->getLevel().' '.htmlspecialchars($vocation_name[$player_list->getVocation()]).'</td>';
					$main_content .= '<td width="8%"><b>'.$player_list_status.'</b></td><td><a class="btn btn-xs btn-primary btn-block" href="?view=characters&name='.htmlspecialchars($player_list->getName()).'">View</a></td></tr>';
				}
			}
			$main_content .= '</tbody></TABLE></div></div></div>';
		}
	}
	else
		$search_errors[] = 'Character <b>'.htmlspecialchars($name).'</b> does not exist.';
}

if (!empty($search_errors)) {
	foreach($search_errors as $search_error) {
		$main_content .= '<div class="alert alert-danger">'.$search_error.'</div>';
	}
}

if ($showSearch) {

	$main_content .= '<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Search Character</h3>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" role="form" action="?view=characters" method="post">
		      		<div class="form-group">
			<label for="name" class="col-lg-1 control-label">Name:</label>
		      		<div class="col-lg-4">
			        <input type="text" maxlength="35" class="form-control" name="name" placeholder="" required>
			    </div>
	</div>
	<div class="text-center">
			<button type="submit" class="btn btn-primary">Submit</button>
			</form>
			</div>
			</div>
			</div>';

	/*$main_content .= '<div class="panel panel-default"><div class="panel-heading"><h3 class="panel-title">Search Character</h3></div><div class="panel-body"><table class="table table-striped table-condensed"><tbody>';
	$main_content .= '';
	$main_content .= '<FORM ACTION="?view=characters" METHOD=post><TABLE WIDTH=100% BORDER=0 CELLSPACING=1 CELLPADDING=4><tr><TD BGCOLOR="'.$config['site']['vdarkborder'].'" CLASS=white><B>Search Character</B></td></tr><tr><td style="background-color: #30363e><TABLE BORDER=0 CELLPADDING=1><tr><td>Name</td><td><INPUT NAME="name" VALUE=""SIZE=29 MAXLENGTH=29></td><td><INPUT TYPE=image NAME="Submit" SRC="'.$layout_name.'/images/buttons/sbutton_submit.gif" BORDER=0 WIDTH=120 HEIGHT=18></td></tr></TABLE></td></tr></TABLE></FORM>';
	$main_content .= '</tbody></table></div></div>';*/
}