<?php 
/**
 * Script retranslates queries to telegram bot API
 */
class TelegramApiProxy {
	private $url;
	private $ch;
	private $log = false;

	public function __construct(){
		$this->getUrl();
		$this->initCurl();
	}

	public function setLog(bool $log){
		$this->log = $log;
	}

	private function log(string $m){
		if(!$this->log) return;
		file_put_contents('proxy.log', $m . PHP_EOL, FILE_APPEND);
	}

	public function start(){
		$this->log('[' . date('Y-m-d H:i:s') . '] Query init. URL: ' . $this->url);
		$this->sendRequest();

		$response = curl_exec($this->ch);
		$debug = curl_getinfo($this->ch);
		$this->log('Response headers: code=' . $debug['http_code'] . '; content_type=' . $debug['content_type'] . '; size_upload=' . $debug['size_upload'] . '; size_download=' . $debug['size_upload'] . ';');
		$this->log('Response body: ' . $response);
		$this->log(' ');

		$this->sendResponse($response, $debug['content_type'], $debug['http_code']);
	}

	private function sendResponse(string $response, string $type, int $code){
		header('Content-type: ' . $type, $code);
		die($response);
	}

	public function getUrl(){
		$dir = dirname($_SERVER['SCRIPT_NAME']); // detect path to dir
		if(strpos($_SERVER['REQUEST_URI'], $dir) === 0){
			$uri = substr($_SERVER['REQUEST_URI'], strlen($dir));
		} else {
			$uri = $_SERVER['REQUEST_URI'];
		}

		if(substr($uri, 0, 1) != '/'){
			$uri = '/' . $uri;
		}
		
		return $this->url = "https://api.telegram.org" . $uri;
	}

	private function initCurl(){
		$this->ch = curl_init($this->url);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);			
		return $this->ch;
	}

	private function sendRequest(){
		$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
		$this->log('HTTP Request: ' . $method);

		if($method == 'POST'){
			curl_setopt($this->ch, CURLOPT_POST, true);
		
			if(sizeof($_FILES) > 0){
				$post = [];
				foreach ($_FILES as $name => $file) {
					$post[$name] = new CURLFile($file['tmp_name'], $file['type'], $file['name']);	
				}

				foreach ($_POST as $name => $value) {
					$post[$name] = $value;	
				}

			} else {
				$post = file_get_contents('php://input');
				$ct = $_SERVER['HTTP_CONTENT_TYPE'] ?? $_SERVER['CONTENT_TYPE'];
				curl_setopt($this->ch, CURLOPT_HTTPHEADER, ['Content-type: ' . $ct]);
			}

			curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post);
			$this->log('Send data: ' . var_export($post, true));

		} else {
			curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $method);
		}
	}
}

$proxy = new TelegramApiProxy;
$proxy->setLog(false); // use logs only for debug
$proxy->start();
?>