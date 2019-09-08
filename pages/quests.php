<table>
			<div style="text-align: center; font-weight: bold;"><h2>Recommended Quests</h2></div>
		</table>
		<div style="border: 1px solid #5f4d41; padding: 1px 0;">
			<table>
				<tr>
					<th style="text-align: center; width: 20%;"><b>Name</b></th>
					<th style="text-align: center; width: 20%;"><b>Recommended Lvl.</b></th>
					<th style="text-align: center; width: 60%;"><b>Reward</b></th>
				</tr>
			</table>
			<table>
	
			<tr> 
				<td style="text-align: center; width: 20%;"><a href="?subtopic=quests&action=teste">Newbie Quest</a></td>
				<td style="text-align: center; width: 20%;"> 8-35 lv</td>
				<td style="text-align: center; width: 60%;">
				<p class="text-success">wyvern fang, knight axe, diamond sceptre, modified crossbow.</p>
				</td>
			</tr>
	
			</table>
		</div>
			</br>
			</br>
			
		<table>
			<div style="text-align: center; font-weight: bold;"><h2>Quests</h2></div>
		</table>
		<div style="border: 1px solid #5f4d41; padding: 1px 0;">
			<table>
				<tr>
					<th style="text-align: center; width: 20%;"><b>Name</b></th>
					<th style="text-align: center; width: 20%;"><b>Recommended Lvl.</b></th>
					<th style="text-align: center; width: 60%;"><b>Reward</b></th>
				</tr>
			</table>
			<table>
	
			<tr> 
				<td style="text-align: center; width: 20%;"><a href="#">Ethand Quest</a></td>
				<td style="text-align: center; width: 20%;">8lv</td>
				<td style="text-align: center; width: 60%;">20 red mushroom - 9.000 exp
				</td>
			</tr>
			</br>
		

		
			</table>
		</div>
		
		<!--
		<table>
			<div style="text-align: center; font-weight: bold;"><h2>Quests</h2></div>
		</table>
		<div style="border: 1px solid #5f4d41; padding: 1px 0;">
			<table>
				<tr>
					<th style="text-align: center; width: 20%;"><b>Name</b></th>
					<th style="text-align: center; width: 20%;"><b>Required Lvl.</b></th>
					<th style="text-align: center; width: 60%;"><b>Reward</b></th>
				</tr>
			</table>
			<table>
	
			</table>
		</div>
-->


<!-- aqui começa as actions das quests -->

<?php 

if($action == 'teste')
{
	$main_content .= '
		
		
		<div style="border: 1px solid #5f4d41; padding: 1px 0;">
							<tr>
						<th style="width:25%;"><a href="?subtopic=quests" style="color: white;">< Back to mission list</a></th>
						<th></th>
					</tr>
					
				<table>
					<tr>
						<td style="width:25%;"><b>Name:</b></td>
						<td>Newbie Quest</td>
					</tr>
					<tr>
						<td style="width:25%;"><b>Requirements:</b></td>
						<td>Lvl: 30</td>
					</tr>
					<tr>
						<td style="width:25%;"><b>Rewards:</b></td>
						<td>
						<p class="text-success">wyvern fang, knight axe, diamond sceptre, modified crossbow.</p>
						</td>
					</tr>
					<tr>
						<td style="width:25%;"><b>Short Description:</b></td>
						<td>Trata-se de um quest simples, a fim de ajudar o inicio da aventura do jogador, podendo localizar a quest embaixo do templo.</td>
					</tr>
				</table>
				</br>
				</br>
				<div style="border: solid 1px red; background: white; color: red; width: 70%; line-height: 5em; height: 5em; text-align: center; margin: auto;"><b>Essa quest não tem vídeo no momento.</b></div><br/><div style="margin: 5px;"></div>
			</div>
		
		
	';
}










?>



</body>
</html>