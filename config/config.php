<?PHP
if ( ! function_exists('is_https'))
{
    function is_https()
    {
        if ( ! empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off')
        {
            return TRUE;
        }
        elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https')
        {
            return TRUE;
        }
        elseif ( ! empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off')
        {
            return TRUE;
        }

        return FALSE;
    }
}

$is_https = is_https();

if ($is_https) {
    $base_url = "https://" . $_SERVER['HTTP_HOST'];
    $base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
} else {
    $base_url = "http://" . $_SERVER['HTTP_HOST'];
    $base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
}

$config['base_url'] = $base_url;
$config['site']['base_url'] = $base_url;

# Info Bar Config
$config['site']['info_bar_active'] = true;

# Using Ajax Field Validation, this is important if you want to use ajax check in your create account.
$config['site']['sqlHost'] = "localhost";
$config['site']['sqlUser'] = "root";
$config['site']['sqlPass'] = "pedrorlx94";
$config['site']['sqlBD'] = "otserv";

$config['site']['outfit_images_url'] = 'http://outfit-images.ots.me/animatedOutfits1099/outfit.php';
$config['site']['item_images_url'] = 'http://item-images.ots.me/1099/';
$config['site']['equipaments_images_url'] = 'http://35.203.45.186/images/equipaments/';
$config['site']['item_images_extension'] = '.gif';
$config['site']['flag_images_url'] = 'http://flag-images.ots.me/';
$config['site']['flag_images_extension'] = '.png';
$config['site']['encryptionType'] = 'sha1';

# Config Shop
$outfits_list = array();
$loyalty_title = array(
    50 => 'Scout',
    100 => 'Sentinel',
    200 => 'Steward',
    400 => 'Warden',
    1000 => 'Squire',
    2000 => 'Warrior',
    3000 => 'Keeper',
    4000 => 'Guardian',
    5000 => 'Sage
');
$config['shop']['newitemdays'] = 1;

# Configure your active payment method with this
$config['paymentsMethods'] = [
    'pagseguro' => true,
    'paypal' => false,
    'transfer' => false
];

# Pagseguro configs
$config['pagseguro']['testing'] = true;
$config['pagseguro']['lightbox'] = true;
$config['pagseguro']['tokentest'] = "";

$config['pagseguro']['email'] = "pedrogiampietro@hotmail.com";
$config['pagseguro']['token'] = "3a6a2f65-c3d6-4a50-88cd-13435aff221097319a3b4b50ac35c2e89270a5bb99cce050-4a28-4d46-8220-f02d796de8d7";
$config['pagseguro']['produtoNome'] = 'Tibia Coins';
$config['pagseguro']['urlRedirect'] =  $config['base_url'];
$config['pagseguro']['urlNotification'] = $config['base_url'].'retpagseguro.php';
$config['donate']['offers'] = [
    500=>50,
    800=>125,
    1500=>250,
    2800=>500,
    4900=>1000
];

# Bank transfer data
$config['banktransfer']['bank'] = "Caixa Econômica";
$config['banktransfer']['agency'] = "";
$config['banktransfer']['account'] = "";
$config['banktransfer']['name'] = "";
$config['banktransfer']['operation'] = 003;

# PayPal configs
$config['paypal']['email'] = "";

# Social Networks
$config['social']['facebook'] = "https://www.facebook.com/tibia";
$config['social']['discord'] = "";

# Character Former name, time in days to show the former names
$config['site']['formerNames'] = 10;
$config['site']['formerNames_amount'] = 10;

# PAGE: characters.php
$config['site']['quests'] = array();
$config['site']['show_skills_info'] = true;
$config['site']['show_vip_storage'] = 0;
$config['site']['showTasks'] = true;
$config['site']['showQuests'] = true;

$config["site"]["quests"] = array(
        "Obsidian Knife"     => array("storageid" => 70003,     "startvalue" => 0,     "endvalue" => 1),
        "Firewalker Boots"     => array("storageid" => 70099,     "startvalue" => 0,     "endvalue" => 1),		
		"Pits of Inferno"     => array("storageid" => 70005,     "startvalue" => 0,     "endvalue" => 1),		
		"Newbie Quest"     => array("storageid" => 70014,     "startvalue" => 0,     "endvalue" => 1),	
		"Annihilator"     => array("storageid" => 70020,     "startvalue" => 0,     "endvalue" => 1),	
		"Yalaharian Quest"     => array("storageid" => 70041,     "startvalue" => 0,     "endvalue" => 1),	
		"Demon Helmet Quest"     => array("storageid" => 70025,     "startvalue" => 0,     "endvalue" => 1),	
		"Wrath of the Emperor Quest"     => array("storageid" => 70024,     "startvalue" => 0,     "endvalue" => 1),	
		"Demon Oak"     => array("storageid" => 70021,     "startvalue" => 0,     "endvalue" => 1),	
		"Inquisition"     => array("storageid" => 12117,     "startvalue" => 0,     "endvalue" => 1),		
		"Nifhleim Arena I"     => array("storageid" => 70052,     "startvalue" => 0,     "endvalue" => 1),		
		"Nifhleim Arena II"     => array("storageid" => 70053,     "startvalue" => 0,     "endvalue" => 1),		
		"Nifhleim Arena III"     => array("storageid" => 70054,    "startvalue" => 0,     "endvalue" => 1),			
		"Blue Legs Quest"     => array("storageid" => 70084,     "startvalue" => 0,     "endvalue" => 1),		
		"Wyat Mission"     => array("storageid" => 60200,     "startvalue" => 0,     "endvalue" => 1),		
		"Omar Mission"     => array("storageid" => 60083,     "startvalue" => 0,     "endvalue" => 1),			
		"Umbral Master Quest"     => array("storageid" => 70012,     "startvalue" => 0,     "endvalue" => 1),			
		"Tomes of Knowledge Quest"     => array("storageid" => 959595,     "startvalue" => 0,     "endvalue" => 1),			
);
$config["site"]["tasks"] = array(
					"Fairus" => array("storageid" => 23122, "startvalue" => 0, "endvalue" => 40000),
					"Soul Dead" => array("storageid" => 23123, "startvalue" => 0, "endvalue" => 15000),
					"Soul Guard" => array("storageid" => 23124, "startvalue" => 0, "endvalue" => 30000),
					"Comander Nomad" => array("storageid" => 23125, "startvalue" => 0, "endvalue" => 7000),
					"Comandos" => array("storageid" => 23126, "startvalue" => 0, "endvalue" => 17000),
					"Comander Jack Sparrow" => array("storageid" => 23127, "startvalue" => 0, "endvalue" => 30000)
			);


# PAGE: whoisonline.php
$config['site']['private-servlist.com_server_id'] = 0;

# Account Maker Config
$config['site']['serverPath'] = "/home/otserv/";
$config['site']['encryptionType'] = 'sha1';
$config['site']['useServerConfigCache'] = false;
$towns_list = array(
	1 => 'Venore',
	2 => 'Thais',
	3 => 'Kazordoon',
	4 => 'Carlin',
	5 => 'Ab\'Dendriel',
	6 => 'Rookgaard',
	7 => 'Liberty Bay',
	8 => 'Port Hope',
	9 => 'Ankrahmun',
	10 => 'Darashia',
	11 => 'Edron',
	12 => 'Svargrond',
	13 => 'Yalahar',
	14 => 'Farmine',
	28 => 'Gray Beach',
	29 => 'Roshamuul',
	33 => 'Rathleton',
	34 => 'Krailos',
	51 => 'Dawnport',
	52 => 'Feyrist'
);

# Create Account Options
$config['site']['one_email'] = true;
$config['site']['create_account_verify_mail'] = false;
$config['site']['verify_code'] = true;
$config['site']['email_days_to_change'] = 3;
$config['site']['newaccount_premdays'] = 0;
$config['site']['send_register_email'] = true;
$config['site']['flash_client_enabled'] = false;

# Create Character Options
$config['site']['newchar_vocations'] = array(0 => 'Rook Sample');
$config['site']['newchar_towns'] = array(1);
$config['site']['max_players_per_account'] = 7;

# Emails Config
$config['site']['send_emails'] = true;
$config['site']['mail_address'] = "";
$config['site']['mail_senderName'] = "";
$config['site']['smtp_enabled'] = true;
$config['site']['smtp_host'] = "ssl://smtp.gmail.com";
$config['site']['smtp_port'] = 465;
$config['site']['smtp_auth'] = true;
$config['site']['smtp_user'] = "";
$config['site']['smtp_pass'] = "";
$config['site']['smtp_secure'] = true;

# PAGE: accountmanagement.php
$config['site']['send_mail_when_change_password'] = true;
$config['site']['send_mail_when_generate_reckey'] = true;
$config['site']['email_time_change'] = 7;
$config['site']['daystodelete'] = 7;

# PAGE: guilds.php
$config['site']['guild_need_level'] = 150;
$config['site']['guild_need_pacc'] = false;
$config['site']['guild_image_size_kb'] = 50;
$config['site']['guild_description_chars_limit'] = 2000;
$config['site']['guild_description_lines_limit'] = 6;
$config['site']['guild_motd_chars_limit'] = 250;

# PAGE: adminpanel.php
$config['site']['access_admin_panel'] = 6;

# PAGE: latestnews.php
$config['site']['news_limit'] = 6;

# PAGE: killstatistics.php
$config['site']['last_deaths_limit'] = 40;

# PAGE: team.php
$config['site']['groups_support'] = array(2, 3, 4, 5);

# PAGE: highscores.php
$config['site']['groups_hidden'] = array(3, 4, 5);
$config['site']['accounts_hidden'] = array(1);

# PAGE: lostaccount.php
$config['site']['email_lai_sec_interval'] = 180;

# Layout Config
$config['site']['layout'] = 'custom';
$config['site']['vdarkborder'] = '#505050';
$config['site']['darkborder'] = '#D4C0A1';
$config['site']['lightborder'] = '#F1E0C6';
