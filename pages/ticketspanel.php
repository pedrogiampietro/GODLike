<?php
	if(!defined('INITIALIZED'))
		exit;
	if($group_id_of_acc_logged < $config['site']['access_admin_panel']) {
		header("location:index.php?subtopic=latestnews");
		return false;
	}
	if($group_id_of_acc_logged >= $config['site']['access_admin_panel']) {		
		$main_content .= '
				<div class="TableContainer">
					<div class="CaptionContainer">
							<div class="CaptionInnerContainer">							
								<div class="Text"> Open Tickets </div>
							</div>
						</div><table class="table table-striped table-condensed table-bordered">
						
						<tbody><tr>
							<td>
								<div class="InnerTableContainer">
									<table class="table table-striped table-condensed table-bordered">
										<tbody><tr>
											<td><div class="TableShadowContainerRightTop">
													<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);"></div>
												</div>
												<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);">
													<div class="TableContentContainer">
														<table class="table table-striped table-condensed table-bordered">
															<tbody><tr style="background-color:#e6e6e6;">
																	<td><font color="black">Ticket</font></td>
																	<td><font color="black">Player</font></td>
																	<td><font color="black">Subject</font></td>
																	<td><font color="black">Status</font></td>
																	<td><font color="black">Last answer</font></td>
																	<td><font color="black">Category</font></td>
															</tr>';
															$accId = $account_logged->getID();
															$ticketsOpen = $SQL->query("SELECT * FROM tickets WHERE ticket_status = 'Waiting' AND ticket_admin_reply = 0");
															foreach($ticketsOpen as $resultadoOpen){
															$main_content .= '<tr bgcolor="">
																		<td width="75%">
																			<a href="?subtopic=ticket&amp;action=showticket&amp;do=number&amp;id='.$resultadoOpen['ticket_id'].'">#'.$resultadoOpen['ticket_id'].'</a>
																		</td>
																		<td>
																			<nobr>
																				<small>
																				<a href="?subtopic=characters&amp;name='.$resultadoOpen['ticket_author'].'">'.$resultadoOpen['ticket_author'].'</a>
																				</small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<font color="black"><small>'.$resultadoOpen['ticket_subject'].'</font></small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<small><font color="black"><b>'.$resultadoOpen['ticket_status'].'</font></font>
																				</small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<font color="black"><small>'.$resultadoOpen['ticket_last_reply'].'</font></small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<font color="black"><small>'.$resultadoOpen['ticket_category'].'</font></small>
																			</nobr>
																		</td>
																	</tr>';
																}
																
															$main_content .= '</tbody>
														</table>
													</div>
												</div>
												<div class="TableShadowContainer">
													<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);">
														<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);"></div>
														<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);"></div>
													</div>
												</div>
											</td>
										</tr>
									</tbody></table>
								</div>
							</td>
						</tr>
					</tbody></table>
				</div>
				<br>
				
				<div class="TableContainer">
					<div class="CaptionContainer">
							<div class="CaptionInnerContainer">							
								<div class="Text"> Tickets aguardando resposta do player</div>
							</div>
						</div><table class="table table-striped table-condensed table-bordered">
						
						<tbody><tr>
							<td>
								<div class="InnerTableContainer">
									<table class="table table-striped table-condensed table-bordered">
										<tbody><tr>
											<td><div class="TableShadowContainerRightTop">
													<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);"></div>
												</div>
												<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);">
													<div class="TableContentContainer">
														<table class="table table-striped table-condensed table-bordered">
															<tbody><tr style="background-color:#e6e6e6;">
																	<td><font color="black">Ticket</font></td>
																	<td><font color="black">Player</font></td>
																	<td><font color="black">Subject</font></td>
																	<td><font color="black">Status</font></td>
																	<td><font color="black">Last answer</font></td>
																	<td><font color="black">Category</font></td>
															</tr>';
															$accId = $account_logged->getID();
															$ticketsOpen = $SQL->query("SELECT * FROM tickets WHERE ticket_status = 'Waiting' AND ticket_admin_reply = 1");
															foreach($ticketsOpen as $resultadoOpen){
															$main_content .= '<tr bgcolor="">
																		<td width="75%">
																			<a href="?subtopic=ticket&amp;action=showticket&amp;do=number&amp;id='.$resultadoOpen['ticket_id'].'">#'.$resultadoOpen['ticket_id'].'</a>
																		</td>
																		<td>
																			<nobr>
																				<small>
																					<a href="?subtopic=characters&amp;name='.$resultadoOpen['ticket_author'].'">'.$resultadoOpen['ticket_author'].'</a>
																				</small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<small><font color="black">'.$resultadoOpen['ticket_subject'].'</font></small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<small><font color="black"><b>'.$resultadoOpen['ticket_status'].'</font></font>
																				</small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<font color="black"><small>'.$resultadoOpen['ticket_last_reply'].'</font></small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<font color="black"><small>'.$resultadoOpen['ticket_category'].'</font></small>
																			</nobr>
																		</td>
																	</tr>';
																}
																
															$main_content .= '</tbody>
														</table>
													</div>
												</div>
												<div class="TableShadowContainer">
													<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);">
													</div>
												</div>
											</td>
										</tr>
									</tbody></table>
								</div>
							</td>
						</tr>
					</tbody></table>
				</div>
				<br>
				
				<div class="TableContainer">
					<div class="CaptionContainer">
							<div class="CaptionInnerContainer">							
								<div class="Text"> Closed Tickets </div>
							</div>
						</div><table class="table table-striped table-condensed table-bordered">
						
						<tbody><tr>
							<td><div class="InnerTableContainer">
									<table class="table table-striped table-condensed table-bordered">
										<tbody><tr>
											<td><div class="TableShadowContainerRightTop">
													<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);"></div>
												</div>
												<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);">
													<div class="TableContentContainer">
														<table class="table table-striped table-condensed table-bordered">
															<tbody><tr style="background-color:#e6e6e6;">
																	<td><font color="black">Ticket</font></td>
																	<td><font color="black">Player</font></td>
																	<td><font color="black">Subject</font></td>
																	<td><font color="black">Status</font></td>
																	<td><font color="black">Last answer</font></td>
																	<td><font color="black">Category</font></td>
															</tr>';
															$accId = $account_logged->getID();
															$ticketsClosed = $SQL->query("SELECT * FROM tickets WHERE ticket_status = 'Closed'");
															foreach($ticketsClosed as $resultadoClosed){
															$main_content .= '<tr bgcolor="">
																		<td width="75%">
																			<a href="?subtopic=ticket&amp;action=showticket&amp;do=number&amp;id='.$resultadoClosed['ticket_id'].'">#'.$resultadoClosed['ticket_id'].'</a>
																		</td>
																		<td>
																			<nobr>
																				<small>
																					<a href="?subtopic=characters&amp;name='.$resultadoClosed['ticket_author'].'">'.$resultadoClosed['ticket_author'].'</a>
																				</small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<small>'.$resultadoClosed['ticket_subject'].'</small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<small><font color="red"><b>'.$resultadoClosed['ticket_status'].'</font>
																				</small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<small>'.$resultadoClosed['ticket_last_reply'].'</small>
																			</nobr>
																		</td>
																		<td>
																			<nobr>
																				<small>'.$resultadoClosed['ticket_category'].'</small>
																			</nobr>
																		</td>
																	</tr>';
																}
															$main_content .= '</tbody>
														</table>
													</div>
												</div>
												<div class="TableShadowContainer">
													<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);">
													</div>
												</div>
											</td>
										</tr>
									</tbody></table>
								</div>
							</td>
						</tr>
					</tbody>
					</table>
			</div>';	
	}		
?>