<?php

class Paypal{
    protected $proxy_host = '127.0.0.1';
    protected $proxy_port = '808';
    protected $user = "UTXCLMBRTM";
    protected $passord = "JKPPR13XLVOG8TJ3";
    protected $vendor = "30JRECAMD8";
    protected $partner = "PayPal";
    protected $bncode = "PF-CCWizard";
    protected $endpoint;
    protected $url;
    protected $mode;


    public function __construct($mode){
        $this->mode = $mode;
        if($mode==='test'){
            $this->endpoint = "https://pilot-payflowpro.paypal.com";
            $this->url = "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=";
        }else{
            $this->endpoint = "https://payflowpro.paypal.com";
            $this->url = "https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=";
        }
    }
    public function payment($post){
        $res = self::directPayment("Sale", $post['tour_full'], $post['creditcard'], $post['ccnumber'], $post['expdate'], $post['cvv2'], $post['fname'], $post['lname'], $post['street'], $post['city'], $post['state'], $post['zip'], "US", "USD", "", "", "");
        $ack = $res['RESULT'];
        
        if($ack!==0){
            return self::displayErrors($ack);
        }else{
            return $res;
        }
    }
    protected static function directPayment($paymentType, $paymentAmount, $creditCardType, $creditCardNumber, $expDate, $cvv2, $firstName, $lastName, $street, $city, $state, $zip, $countryCode, $currencyCode, $orderdescription, $itemName, $email ){
        // Construct the parameter string that describes the credit card payment
	$replaceme = array("-", " ");
	$card_num = str_replace($replaceme,"",$creditCardNumber);
	
	$nvpstr = "&TENDER=C";
	if ("Sale" === $paymentType)
	{
		$nvpstr .= "&TRXTYPE=S";
	}
	elseif ("Authorization" === $paymentType)
	{
		$nvpstr .= "&TRXTYPE=A";
	}
	else //default to sale
	{
		$nvpstr .= "&TRXTYPE=S";
	}

	// Other information
	$ipaddr = filter_input(INPUT_SERVER, 'REMOTE_ADDR');
			
	$nvpstr .= '&ACCT='.$card_num.'&CVV2='.$cvv2.'&EXPDATE='.$expDate.'&ACCTTYPE='.$creditCardType.'&AMT='.$paymentAmount.'&CURRENCY='.$currencyCode;
	$nvpstr .= '&FIRSTNAME='.$firstName.'&LASTNAME='.$lastName.'&STREET='.$street.'&CITY='.$city.'&STATE='.$state.'&ZIP='.$zip.'&COUNTRY='.$countryCode;
	$nvpstr .= '&CLIENTIP='. $ipaddr . '&ORDERDESC=' . $orderdescription . '&L_NAME1=' . $itemName . '&EMAIL=' . $email;
	// Transaction results (especially values for declines and error conditions) returned by each PayPal-supported
	// processor vary in detail level and in format. The Payflow Verbosity parameter enables you to control the kind
	// and level of information you want returned. 
	// By default, Verbosity is set to LOW. A LOW setting causes PayPal to normalize the transaction result values. 
	// Normalizing the values limits them to a standardized set of values and simplifies the process of integrating 
	// the Payflow SDK.
	// By setting Verbosity to MEDIUM, you can view the processor's raw response values. This setting is more â€œverboseâ€�
	// than the LOW setting in that it returns more detailed, processor-specific information. 
	// Review the chapter in the Developer's Guides regarding VERBOSITY and the INQUIRY function for more details.
	// Set the transaction verbosity to MEDIUM.
	$nvpstr .= '&VERBOSITY=HIGH';

	// The $unique_id field is storing our unique id that we'll use in the request id header.
	$unique_id = date('ymd-H').rand(1000,9999);		
	
	/*'-------------------------------------------------------------------------------------------
	' Make the call to Payflow to finalize payment
	' If an error occured, show the resulting errors
	'-------------------------------------------------------------------------------------------
	*/
	$resArray = self::hashCall($nvpstr,$unique_id);
	
	return $resArray;
    }
    protected static function hashCall($nvpStr, $unique_id){
        $len = strlen($nvpStr);
	$headers[] = "Content-Type: text/namevalue";
	$headers[] = "Content-Length: " . $len;
	// Set the server timeout value to 45, but notice below in the cURL section, the timeout
	// for cURL is set to 90 seconds.  Make sure the server timeout is less than the connection.
	$headers[] = "X-VPS-CLIENT-TIMEOUT: 45";
	$headers[] = "X-VPS-REQUEST-ID:" . $unique_id;
        
        if($this->mode==='test'){
            $headers[] = "Host: pilot-payflowpro.paypal.com";
        }else{
            $headers[] = "Host: payflowpro.paypal.com";
        }
        
        //setting the curl parameters.
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,  $this->endpoint);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);

	//turning off the server and peer verification(TrustManager Concept).
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 90); 		// times out after 90 secs
	curl_setopt($ch, CURLOPT_POST, 1);
        
        //NVPRequest for submitting to server
	$nvpreq = "USER=".$API_User.'&VENDOR='.$API_Vendor.'&PARTNER='.$API_Partner.'&PWD='.$API_Password . $nvpStr . "&BUTTONSOURCE=" . urlencode($sBNCode);
        
        //setting the nvpreq as POST FIELD to curl
	curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
        
        //getting response from server
	$response = curl_exec($ch);
        
        //convrting NVPResponse to an Associative Array
	$nvpResArray=self::deformatNVP($response);
	$nvpReqArray=self::deformatNVP($nvpreq);
        
        curl_close($ch);
        
        return $nvpResArray;
		        
    }
    protected static function deformatNVP($nvpstr){
        $intial=0;
	$nvpArray = array();

	while(strlen($nvpstr))
	{
		//postion of Key
		$keypos= strpos($nvpstr,'=');
		//position of value
		$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);

		/*getting the Key and Value values and storing in a Associative Array*/
		$keyval=substr($nvpstr,$intial,$keypos);
		$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
		//decoding the respose
		$nvpArray[urldecode($keyval)] =urldecode( $valval);
		$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
	}
	return $nvpArray;
    }
    protected static function generateCharacter (){
        $possible = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
	return $char;
    }
    protected static function generateGUID () {
	$GUID = generateCharacter().generateCharacter().generateCharacter().generateCharacter().generateCharacter().generateCharacter().generateCharacter().generateCharacter().generateCharacter()."-";
	$GUID = $GUID .generateCharacter().generateCharacter().generateCharacter().generateCharacter()."-";
	$GUID = $GUID .generateCharacter().generateCharacter().generateCharacter().generateCharacter()."-";
	$GUID = $GUID .generateCharacter().generateCharacter().generateCharacter().generateCharacter()."-";
	$GUID = $GUID .generateCharacter().generateCharacter().generateCharacter().generateCharacter().generateCharacter().generateCharacter().generateCharacter().generateCharacter().generateCharacter().generateCharacter().generateCharacter().generateCharacter();
	return $GUID;
    }
    private static function displayErrors($ack){
        $error = 'Error Code: '.$ack;
        switch ($ack){
            default :
                $error .= '';
        }
        return $error;
    }
}