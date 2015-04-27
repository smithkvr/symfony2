<?php
namespace Acme\DemoBundle\Service\WebServices;

use Symfony\Component\HttpFoundation\Request;

/**
 * @package PuntClubBundle
 * @subpackage Service
 */
class MailgunService {
	protected $apiKey;
	protected $apiUrl;
	protected $apiDomain;
	protected $toEmail;
	protected $fromEmail;
	protected $msgBody = array();
	protected $subject;
	protected $bcc = array();
	protected $cc = array();
	
	public function __construct($apiKey, $apiUrl, $apiDomain) {
		$this->apiKey = $apiKey;
		$this->apiUrl = $apiUrl;
		$this->apiDomain = $apiDomain;
	}
	
	/**
	 * Function for sending email to mail gun
	 * @param string $toEmail
	 * @param string $fromEmail
	 * @param string $subject
	 * @param array $msgBody - This need to have either key ['text'] or ['html'] or both
	 * @param array $cc
	 * @param array $bcc
	 */
	public function sendEmail($toEmail, $fromEmail, $subject, $msgBody, $cc = null, $bcc = null) {
		$this->toEmail = $toEmail;
		$this->fromEmail = $fromEmail;
		$this->subject = $subject;
		$this->msgBody = $msgBody;
		$this->cc = $cc;
		$this->bcc = $bcc;
		$response = $this->processEmail();
		
	}
	
	protected function processEmail() {
		$mailArray = array();
		if($this->generateCC() != false) {
			$mailArray['cc'] = $this->generateCC();
		}
		if($this->generateBCC() != false) {
			$mailArray['bcc'] = $this->generateBCC();
		}
		$mailArray['from'] = $this->fromEmail;
		$mailArray['to'] = $this->toEmail;
		$mailArray['subject'] = $this->subject;
		if(isset($this->msgBody['text']) && !empty($this->msgBody['text'])) {
			$mailArray['text'] = $this->msgBody['text'];
		}
		if(isset($this->msgBody['html']) && !empty($this->msgBody['html'])) {
			$mailArray['html'] = $this->msgBody['html'];
		}
		$response = $this->sendEmailToMailgun($mailArray);
		return $response;
	}
	
	protected function sendEmailToMailgun($mailArray) {
		$ch = curl_init();
  		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  		curl_setopt($ch, CURLOPT_USERPWD, 'api:'.$this->apiKey);
  		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  		curl_setopt($ch, CURLOPT_URL, $this->apiUrl.'/'.$this->apiDomain.'/messages');
  		curl_setopt($ch, CURLOPT_POSTFIELDS, $mailArray);
  		$result = curl_exec($ch);
  		curl_close($ch);
  		return $result;
	}
	
	protected function generateBCC() {
		$bccEmailIds = '';
		if(!empty($this->bcc)) {
			$cnt = count($this->bcc);
			$i = 1;
			foreach( $this->bcc as $emailId) {
				$bccEmailIds = ($i==$cnt) ? $emailId : $emailId.',';
				$i++;
			}
			return $bccEmailIds;
		}
		return false;
	}
	
	protected function generateCC() {
		$ccEmailIds = '';
		if(!empty($this->cc)) {
			$cnt = count($this->cc);
			$i = 1;
			foreach( $this->cc as $emailId) {
				$ccEmailIds .= ($i==$cnt) ? $emailId : $emailId.',';
				$i++;
			}
			return $ccEmailIds;
		}
		return false;
	}

    public function getApiDomain(){
        return $this->apiDomain;
    }
}