<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Callback extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$appsecret = 'EAAN3JpaaveABAL2wkcHglsnEemN72Pd566LZCLljqZAp2Em2qhzqb9qzvgdq333lnZBdIxBddvtjCyENX0nW9Wx2Vovg7gPYV9ByOcDYM451vdbkOQ1M6vh97INpWjGaRsrb2WxaT8MJ1i56a7h4B0LhtLNDD7QvQnZCNZAhrd7No3XW7udFotFziiSZCgfXkZD';
		$raw_post_data = file_get_contents('php://input');
		$header_signature = $headers['X-Hub-Signature'];

		// Signature matching
		$expected_signature = hash_hmac('sha1', $raw_post_data, $appsecret);

		$signature = '';
		if(
		    strlen($header_signature) == 45 &&
		    substr($header_signature, 0, 5) == 'sha1='
		  ) {
		  $signature = substr($header_signature, 5);
		}
		if (hash_equals($signature, $expected_signature)) {
		  echo('SIGNATURE_VERIFIED');
		}
	}
}
