<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		header('Access-Control-Allow-Origin: *');
		$this->load->library('fbConn/facebook');
		date_default_timezone_set('Asia/Kolkata');
		$this->load->library('session');
	}
	
	
		function sendChat() {
				$from = $this->session->userdata('chat_username');
				$to = $this->input->post('to');
				$message = $this->input->post('message');
				$setdate=array($to => date('Y-m-d H:i:s', time()));
                //$this->session->set_userdata('openChatBoxes',$to);
				$oc=$this->session->userdata('openChatBoxes');
				$oc[$to]=date('Y-m-d H:i:s', time());
				$this->session->set_userdata('openChatBoxes',$oc);
				$messagesan = $this->sanitize($message);
				
				$se=$this->session->userdata('chatHistory');
				if (!isset($se[$to])) {
				$se[$to]='';
					
			}
			$se[$to]=$se[$to];
			//$this->session->userdata('chatHistory')
			//$to1[$to]='';
			$se[$to].=<<<EOD
					   {
			"s": "1",
			"f": "{$to}",
			"m": "{$messagesan}"
	   },
EOD;
			$this->session->set_userdata('chatHistory',$se);
		//	$this->session->set_userdata('chat_username',$setdate); 
				
				$this->session->set_userdata('tsChatBoxes',array($to =>''));
				//unset($_SESSION['tsChatBoxes'][$_POST['to']]);

	$sql = "insert into chat (chat.from,chat.to,message,sent) values ('".mysql_real_escape_string($from)."', '".mysql_real_escape_string($to)."','".mysql_real_escape_string($message)."',NOW())";
				$query = $this->db->query($sql);
				echo "1";
				exit(0);
			}
			
			
			
				function startChatSession() {
				$items = '';
				$se=$this->session->userdata('openChatBoxes');
				//echo "sd";
				print_r($se);
				//exit;
				if (!empty($se)) {
				//print_r($this->session->userdata('openChatBoxes'));
					foreach ($se as $chatbox => $void) {
						$items .= $this->chatBoxSession($chatbox);
					}
				}


				if ($items != '') {
					$items = substr($items, 0, -1);
				}

			header('Content-type: application/json');
			?>
			{
					"chat_username": "<?php echo $this->session->userdata('chat_username');?>",
					"items": [
						<?php echo $items;?>
					]
			}

			<?php


				exit(0);
			}
	
			
			
	function chatHeartbeat() {
	
	$sql = "select * from chat where (chat.to = '".mysql_real_escape_string($this->session->userdata('chat_username'))."' AND recd = 0) order by id ASC";
	$query = mysql_query($sql);
	$items = '';

	$chatBoxes = array();

	while ($chat = mysql_fetch_array($query)) {
     $s1=$this->session->userdata('openChatBoxes');
	 $s2=$this->session->userdata('chatHistory');
		if (!isset($s1[$chat['from']]) && isset($s2[$chat['from']])) {
			$items = $s2[$chat['from']];
		}

		$chat['message'] = $this->sanitize($chat['message']);

		$items .= <<<EOD
					   {
			"s": "0",
			"f": "{$chat['from']}",
			"m": "{$chat['message']}"
	   },
EOD;

	if (!isset($s2[$chat['from']])) {
		$s2[$chat['from']] = '';
		$this->session->set_userdata('chatHistory',$s2);
	}
$s2[$chat['from']]=$s2[$chat['from']];
	$s2[$chat['from']].= <<<EOD
				  {
			"s": "0",
			"f": "{$chat['from']}",
			"m": "{$chat['message']}"
	   },
EOD;
	$this->session->set_userdata('chatHistory',$s2);
	//$s2[$chat['from']] 
		
		$this->session->set_userdata($s2,array($chat['from']=>''));
		//$this->session->set_userdata('openChatBoxes',array($chat['from']=>$chat['sent']));
		//$s1[$chat['from']] = $chat['sent'];
	}

	if (!empty($s1)) {
	$s3=$this->session->userdata('tsChatBoxes');
	foreach ($s1 as $chatbox => $time) {
		if (!isset($s[$chatbox])) {
			$now = time()-strtotime($time);
			$time = date('g:iA M dS', strtotime($time));

			$message = "Sent at $time";
			if ($now > 180) {
				$items .= <<<EOD
{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;

	if (!isset($s2[$chatbox])) {
	$s2[$chatbox] = '';
	   $this->session->set_userdata('chatHistory',$s2);
		
	}
$s_h=$this->session->userdata('chatHistory');
	$s_h[$chatbox] .= <<<EOD
		{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;
			$s3[$chatbox] = 1;
		}
		}
	}
}

	$sql = "update chat set recd = 1 where chat.to = '".mysql_real_escape_string($this->session->userdata('chat_username'))."' and recd = 0";
	$query = mysql_query($sql);

	if ($items != '') {
		$items = substr($items, 0, -1);
	}
header('Content-type: application/json');
?>
{
		"items": [
			<?php echo $items;?>
        ]
}

<?php
			exit(0);
}		
			
			
			
function chatBoxSession($chatbox) {
	
	$items = '';
	 $s11=$this->session->userdata('chatHistory');
	if (isset($s11[$chatbox])) {
		$items = $s11[$chatbox];
	}

	return $items;
}			
			
function closeChat() {

	$s4=$this->session->userdata('openChatBoxes');
	$this->session->set_userdata($s4,array($_POST['chatbox']=>''));
	echo "1";
	exit(0);
}

function sanitize($text) {
	$text = htmlspecialchars($text, ENT_QUOTES);
	$text = str_replace("\n\r","\n",$text);
	$text = str_replace("\r\n","\n",$text);
	$text = str_replace("\n","<br>",$text);
	return $text;
}			
			
			
function hello()
{
print_r($this->session->userdata('chatHistory'));
}			
			
			
			
			
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */