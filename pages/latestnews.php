					<!--
					<script>
						function openNewsTicker(tickerId) {
							var tickerClosed = document.getElementById(tickerId+'-closed');
							var tickerOpened = document.getElementById(tickerId+'-opened');
							tickerClosed.style.display = "none";
							tickerOpened.style.display = "";
						}
						function closeNewsTicker(tickerId) {
							var tickerClosed = document.getElementById(tickerId+'-closed');
							var tickerOpened = document.getElementById(tickerId+'-opened');
							tickerClosed.style.display = "";
							tickerOpened.style.display = "none";
						}
					</script>
					<style>
					.ticker-text-closed {
						white-space: nowrap;
						overflow: hidden;
						text-overflow: ellipsis;
						width: 576px;
					}
					.ticker-text-opened {
						width: 576px;
					}
					.news-ticker:nth-child(4n) {
						padding: 4px;
						background-color: #DBE2E4;
					}
					.news-ticker:nth-child(4n+1) {
						padding: 4px;
						background-color: #C5D0D3;
					}
					.news-ticker:nth-child(4n+2) {
						padding: 4px;
						background-color: #C5D0D3;
					}
					.news-ticker:nth-child(4n+3) {
						padding: 4px;
						background-color: #DBE2E4;
					}

					.ticker-icon {
						width: 4%;
					}

					.ticker-date {
						width: 14.6%;
						padding-right: 0px;
					}

					#news-ticker-content {
						border: 0px;
						padding: 0;
					}

				</style>
				<div class="box">
					<div class="head">News Ticker</div>
					<div class="box-content" id="news-ticker-content">



					</div>
				</div> -->
				
				
<?php
if(!defined('INITIALIZED'))
    exit;

function replaceSmile($text, $smile)
{
    $smileys = array(';D' => 1, ':D' => 1, ':cool:' => 2, ';cool;' => 2, ':ekk:' => 3, ';ekk;' => 3, ';o' => 4, ';O' => 4, ':o' => 4, ':O' => 4, ':(' => 5, ';(' => 5, ':mad:' => 6, ';mad;' => 6, ';rolleyes;' => 7, ':rolleyes:' => 7, ':)' => 8, ';d' => 9, ':d' => 9, ';)' => 10);
    if($smile == 1)
        return $text;
    else
    {
        foreach($smileys as $search => $replace)
            $text = str_replace($search, '<img src="images/forum/smile/'.$replace.'.gif" />', $text);
        return $text;
    }
}

function replaceAll($text, $smile)
{
    $rows = 0;
    while(stripos($text, '[code]') !== false && stripos($text, '[/code]') !== false )
    {
        $code = substr($text, stripos($text, '[code]')+6, stripos($text, '[/code]') - stripos($text, '[code]') - 6);
        if(!is_int($rows / 2)) { $bgcolor = 'ABED25'; } else { $bgcolor = '23ED25'; } $rows++;
        $text = str_ireplace('[code]'.$code.'[/code]', '<i>Code:</i><br /><table cellpadding="0" style="background-color: #'.$bgcolor.'; width: 480px; border-style: dotted; border-color: #CCCCCC; border-width: 2px"><tr><td>'.$code.'</td></tr></table>', $text);
    }
    $rows = 0;
    while(stripos($text, '[quote]') !== false && stripos($text, '[/quote]') !== false )
    {
        $quote = substr($text, stripos($text, '[quote]')+7, stripos($text, '[/quote]') - stripos($text, '[quote]') - 7);
        if(!is_int($rows / 2)) { $bgcolor = 'AAAAAA'; } else { $bgcolor = 'CCCCCC'; } $rows++;
        $text = str_ireplace('[quote]'.$quote.'[/quote]', '<table cellpadding="0" style="background-color: #'.$bgcolor.'; width: 480px; border-style: dotted; border-color: #007900; border-width: 2px"><tr><td>'.$quote.'</td></tr></table>', $text);
    }
    $rows = 0;
    while(stripos($text, '[url]') !== false && stripos($text, '[/url]') !== false )
    {
        $url = substr($text, stripos($text, '[url]')+5, stripos($text, '[/url]') - stripos($text, '[url]') - 5);
        $text = str_ireplace('[url]'.$url.'[/url]', '<a href="'.$url.'" target="_blank">'.$url.'</a>', $text);
    }
    while(stripos($text, '[player]') !== false && stripos($text, '[/player]') !== false )
    {
        $player = substr($text, stripos($text, '[player]')+8, stripos($text, '[/player]') - stripos($text, '[player]') - 8);
        $text = str_ireplace('[player]'.$player.'[/player]', '<a href="?view=characters&name='.urlencode($player).'">'.$player.'</a>', $text);
    }
    while(stripos($text, '[img]') !== false && stripos($text, '[/img]') !== false )
    {
        $img = substr($text, stripos($text, '[img]')+5, stripos($text, '[/img]') - stripos($text, '[img]') - 5);
        $text = str_ireplace('[img]'.$img.'[/img]', '<img src="'.$img.'">', $text);
    }
    while(stripos($text, '[b]') !== false && stripos($text, '[/b]') !== false )
    {
        $b = substr($text, stripos($text, '[b]')+3, stripos($text, '[/b]') - stripos($text, '[b]') - 3);
        $text = str_ireplace('[b]'.$b.'[/b]', '<b>'.$b.'</b>', $text);
    }
    while(stripos($text, '[i]') !== false && stripos($text, '[/i]') !== false )
    {
        $i = substr($text, stripos($text, '[i]')+3, stripos($text, '[/i]') - stripos($text, '[i]') - 3);
        $text = str_ireplace('[i]'.$i.'[/i]', '<i>'.$i.'</i>', $text);
    }
    while(stripos($text, '[u]') !== false && stripos($text, '[/u]') !== false )
    {
        $u = substr($text, stripos($text, '[u]')+3, stripos($text, '[/u]') - stripos($text, '[u]') - 3);
        $text = str_ireplace('[u]'.$u.'[/u]', '<u>'.$u.'</u>', $text);
    }
    return replaceSmile($text, $smile);
}

function showPost($topic, $text, $smile)
{
    $text = $text;
    $post = '';
    if(!empty($topic))
        $post .= '<b>'.replaceSmile($topic, $smile).'</b>';
    $post .= replaceAll($text, $smile);
    return $post;
}



$last_threads = $SQL->query('SELECT ' . $SQL->tableName('players') . '.' . $SQL->fieldName('name') . ', ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('post_text') . ', ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('post_topic') . ', ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('post_smile') . ', ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('id') . ', ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('replies') . ', ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('post_date') . ' FROM ' . $SQL->tableName('players') . ', ' . $SQL->tableName('z_forum') . ' WHERE ' . $SQL->tableName('players') . '.' . $SQL->fieldName('id') . ' = ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('author_guid') . ' AND ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('section') . ' = 1 AND ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('first_post') . ' = ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('id') . ' ORDER BY ' . $SQL->tableName('z_forum') . '.' . $SQL->fieldName('last_post') . ' DESC LIMIT ' . $config['site']['news_limit'])->fetchAll();
if (isset($last_threads[0])) {
    foreach($last_threads as $thread) {
        $main_content .= '
		
		<div class="text-xs-center">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="nk-title h3">
				
                    ' . htmlspecialchars($thread['post_topic']) . '
                    <h4 class="nk-sub-title">
                        <i class="fa fa-clock-o"></i> ' . date("H:i - F j, Y", $thread['post_date']) . '
                    </h4>
                </h2>
            </div>
			</div>
            <div class="panel-body">
                ' . showPost('', $thread['post_text'], $thread['post_smile']) . '
            </div>
        </div>';
    }
} else {
    $main_content .= '<div class="alert alert-info">No newsletters found.</div>';
}


$main_content .= '


<!-- START: About -->
			<div class="nk-box bg-dark-1">
				<div class="container text-xs-center">
				
					<div class="nk-title-sep-icon">
                        <span class="icon">
                            <span class="ion-fireball"></span>
                        </span>
					</div>
				
					<div class="nk-gap-2"></div>
					<h2 class="nk-title h1">About The Game</h2>
					<div class="nk-gap-3"></div>

					<p class="lead">Together face In. His called Two lesser given divide. From, cattle saying be was doesnt set. Creature bearing life wherein dominion in saying them moveth first have. Under set darkness over light beast face fill from in after isnt first own all fowl itself evening also, grass doesnt Sea. Created very likeness herb wherein from lesser was bring brought above. Bearing tree a grass very.</p>

					<div class="nk-gap-2"></div>
					<div class="row equal-height no-gap multi-columns-row">
						<div class="col-md-4">
							<div class="nk-box-2 nk-box-line">
								<!-- START: Counter -->
								<div class="nk-counter-3">
									<div class="nk-count">65</div>
									<h3 class="nk-counter-title h4">Custom Bosses</h3>
									<div class="nk-gap-1"></div>
								</div>
								<!-- END: Counter -->
							</div>
						</div>
						<div class="col-md-4">
							<div class="nk-box-2 nk-box-line">
								<!-- START: Counter -->
								<div class="nk-counter-3">
									<div class="nk-count">145</div>
									<h3 class="nk-counter-title h4">Quests</h3>
									<div class="nk-gap-1"></div>
								</div>
								<!-- END: Counter -->
							</div>
						</div>
						<div class="col-md-4">
							<div class="nk-box-2 nk-box-line">
								<!-- START: Counter -->
								<div class="nk-counter-3">
									<div class="nk-count">35</div>
									<h3 class="nk-counter-title h4">Events</h3>
									<div class="nk-gap-1"></div>
								</div>
								<!-- END: Counter -->
							</div>
						</div>
					</div>
					<div class="nk-gap-2"></div>
					
					<div class="nk-title-sep-icon">
                        <span class="icon">
                            <span class="ion-fireball"></span>
                        </span>
					</div>
					
					<div class="nk-gap-6"></div>
				</div>
			</div>
			<!-- END: About -->
			

						
		<!-- START: Features -->
			<div class="container">
				<div class="row vertical-gap lg-gap">
					<div class="col-md-4">
						<div class="nk-ibox">
							<div class="nk-ibox-icon nk-ibox-icon-circle">
								<span class="ion-ios-game-controller-b"></span>
							</div>
							<div class="nk-ibox-cont">
								<h2 class="nk-ibox-title">Incredible Atmosphere</h2>
								Second Made make spirit green divide lesser creeping void and night replenish cattle dont was female first their day open.
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="nk-ibox">
							<div class="nk-ibox-icon nk-ibox-icon-circle">
								<span class="ion-fireball"></span>
							</div>
							<div class="nk-ibox-cont">
								<h2 class="nk-ibox-title">Catchy Battles</h2>
								Image their gathered. Every. Called together signs winged, unto midst sea life air them. Us sea them shall you saw.
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="nk-ibox">
							<div class="nk-ibox-icon nk-ibox-icon-circle">
								<span class="ion-ribbon-a"></span>
							</div>
							<div class="nk-ibox-cont">
								<h2 class="nk-ibox-title">28 Awards</h2>
								Moveth fruitful it appear wherein man dont firmament set blessed. Beast seas god itself. Made night image male. Own night.
							</div>
						</div>
					</div>
				</div>
				<div class="nk-gap-2"></div>
				<div class="nk-gap-6"></div>
			</div>
			<!-- END: Features -->



';
