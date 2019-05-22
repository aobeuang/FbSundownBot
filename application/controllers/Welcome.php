<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		$access_token = "EAAN3JpaaveABAL2wkcHglsnEemN72Pd566LZCLljqZAp2Em2qhzqb9qzvgdq333lnZBdIxBddvtjCyENX0nW9Wx2Vovg7gPYV9ByOcDYM451vdbkOQ1M6vh97INpWjGaRsrb2WxaT8MJ1i56a7h4B0LhtLNDD7QvQnZCNZAhrd7No3XW7udFotFziiSZCgfXkZD";
		$verify_token = "fbsundown";
		$hub_verify_token = null;
		if(isset($_REQUEST['hub_challenge'])) {
		 $challenge = $_REQUEST['hub_challenge'];
		 $hub_verify_token = $_REQUEST['hub_verify_token'];
		}
		if ($hub_verify_token === $verify_token) {
		 echo $challenge;
		}
		$input = json_decode(file_get_contents('php://input'), true);
		$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
		$message = $input['entry'][0]['messaging'][0]['message']['text'];
		$message_to_reply = 'ssss';

		//API Url
		$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;
		//Initiate cURL.
		$ch = curl_init($url);
		//The JSON data.
		$jsonData = '{
		    "recipient":{
		        "id":"'.$sender.'"
		    },
		    "message":{
		        "text":"'.$message_to_reply.'"
		    }
		}';
		//Encode the array into JSON.
		$jsonDataEncoded = $jsonData;
		//Tell cURL that we want to send a POST request.
		curl_setopt($ch, CURLOPT_POST, 1);
		//Attach our encoded JSON string to the POST fields.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
		//Set the content type to application/json
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		//Execute the request
		if(!empty($input['entry'][0]['messaging'][0]['message'])){
		    $result = curl_exec($ch);
		}
	}
}
