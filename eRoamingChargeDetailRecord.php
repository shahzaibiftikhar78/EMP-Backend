<?php
header('Content-Type: application/json'); // Data Processed Will Be In Json Format
header('Access-Control-Allow-Origin: *'); // Any Platform Request Can Be Handle

$data = json_decode(file_get_contents("php://input"), true); // To Convert The Input Values in Array Format 

//Request Variables
$SessionID           = ((trim($data['SessionID']) == '') ? '' : trim($data['SessionID'])); // This Will Be Must
$CPOPartnerSessionID = ((trim($data['CPOPartnerSessionID']) == '') ? '' : trim($data['CPOPartnerSessionID']));
$EMPPartnerSessionID = ((trim($data['EMPPartnerSessionID']) == '') ? '' : trim($data['EMPPartnerSessionID']));
$PartnerProductID    = ((trim($data['PartnerProductID']) == '') ? '' : trim($data['PartnerProductID']));
$EvseID              = ((trim($data['EvseID']) == '') ? '' : trim($data['EvseID']));// This Will Be Must
$Identification      = ((trim($data['Identification']) == '') ? '' : trim($data['Identification']));// This Will Be Must
$ChargingStart       = ((trim($data['ChargingStart']) == '') ? '' : trim($data['ChargingStart']));
$ChargingEnd         = ((trim($data['ChargingEnd']) == '') ? '' : trim($data['ChargingEnd']));
$SessionStart        = ((trim($data['SessionStart']) == '') ? '' : trim($data['SessionStart'])); //This Will Be Must
$SessionEnd          = ((trim($data['SessionEnd']) == '') ? '' : trim($data['SessionEnd'])); //This Will Be Must
$MeterValueStart     = ((trim($data['MeterValueStart']) == '') ? '' : trim($data['MeterValueStart']));
$MeterValueEnd       = ((trim($data['MeterValueEnd']) == '') ? '' : trim($data['MeterValueEnd']));
$MeterValueInBetween = ((trim($data['MeterValueInBetween']) == '') ? '' : trim($data['MeterValueInBetween']));
$ConsumedEnergy      = ((trim($data['ConsumedEnergy']) == '') ? '' : trim($data['ConsumedEnergy']));
$MeetingSignature    = ((trim($data['MeetingSignature']) == '') ? '' : trim($data['MeetingSignature']));
$HubOperatorID       = ((trim($data['HubOperatorID']) == '') ? '' : trim($data['HubOperatorID']));

include "connection.php"; // Database Connection
$verify_sessionstart = check_date_time_format($SessionStart); // Verification of session start format
$verify_sessionend   = check_date_time_format($SessionEnd);   // Verification of session end format

if($verify_sessionstart == "False"){ // To verify that SessionStart has correct format
		echo json_encode(array(
			'Message'=> 'Session Start Format Is Incorrect',
			'StatusCode'=> '022')
		);
}else if($verify_sessionend == "False"){ // To verify that SessionEnd has correct format
		echo json_encode(array(
			'Message'=> 'Session End Format Is Incorrect',
			'StatusCode'=> '022')
		);
}
if($SessionID == ''){ // To verify that ProviderID not null
		echo json_encode(array(
			'Message'=> 'Session ID Is Missing',
			'StatusCode'=> '022')
		);
}
else if($EvseID == ''){ // To verify that EvseID not null

			echo json_encode(array(
			'Message'=> 'Evse ID Is Missing',
			'StatusCode'=> '022')
		);
}
else if($verify_sessionstart == "True" && $verify_sessionend == "True" && $SessionID != "" && $EvseID != ""){ // This Block will execute if both SessionID && EvseID && SessionStart && SessionEnd will not be null
if($Identification == "RFIDMifareFamilyIdentification"){ // RFIDMifareFamilyIdentification Identification
	$UID    = ((trim($data['UID']) == '') ? '' : $data['UID']); //Must
	$array = array(
			"UID" => $UID
	); // Array of essential parameters for RFIDMifareFamilyIdentification 
	$verification = verification("RFIDMifareFamilyIdentification", $array); // Verifcation authenfication function with parameters essential for verification
	if($verification['AuthorizationStatus'] == "Success"){ // Block for authentic verification information from request 
		$query = "INSERT INTO eroamingchargedetailrecord(SessionID, CPOPartnerSessionID, EMPPartnerSessionID, PartnerProductID, EvseID, Identification, ChargingStart, ChargingEnd, SessionStart, SessionEnd, MeterValueStart, MeterValueEnd, MeterValueInBetween, ConsumedEnergy,MeetingSignature, HubOperatorID) VALUES ('$SessionID', '$CPOPartnerSessionID', '$EMPPartnerSessionID', '$PartnerProductID', '$EvseID', '$Identification', '$ChargingStart', '$ChargingEnd', '$SessionStart', '$SessionEnd', '$MeterValueStart', '$MeterValueEnd', '$MeterValueInBetween', '$ConsumedEnergy','$MeetingSignature', '$HubOperatorID')"; // To record request information
		$result = mysqli_query($db, $query) or die("SQL Query Failed");
}
}

else if($Identification == "RFIDIdentification"){ // RFIDIdentification Identification
	$UID                = ((trim($data['UID']) == '') ? '' : $data['UID']); //Must
	$EvcoID             = ((trim($data['EvcoID']) == '') ? '' : $data['EvcoID']);
	$RFID               = ((trim($data['RFID']) == '') ? '' : $data['RFID']); // Must
	$PrintedNumber      = ((trim($data['PrintedNumber']) == '') ? '' : $data['PrintedNumber']);
	$ExpiryDate         = ((trim($data['ExpiryDate']) == '') ? '' : $data['ExpiryDate']);
	$array = array(
			"UID"           => $UID,
			"EvcoID"        => $EvcoID,
			"RFID"          => $RFID,
			"PrintedNumber" => $PrintedNumber,
			"ExpiryDate"    => $ExpiryDate

	); // Array of essential parameters for RFIDIdentification 
	$verification = verification("RFIDIdentification", $array); // Verifcation authenfication function with parameters essential for verification

	if($verification['AuthorizationStatus'] == "Success"){ // Block for authentic verification information from request
		$query = "INSERT INTO eroamingchargedetailrecord(SessionID, CPOPartnerSessionID, EMPPartnerSessionID, PartnerProductID, EvseID, Identification, ChargingStart, ChargingEnd, SessionStart, SessionEnd, MeterValueStart, MeterValueEnd, MeterValueInBetween, ConsumedEnergy,MeetingSignature, HubOperatorID) VALUES ('$SessionID', '$CPOPartnerSessionID', '$EMPPartnerSessionID', '$PartnerProductID', '$EvseID', '$Identification', '$ChargingStart', '$ChargingEnd', '$SessionStart', '$SessionEnd', '$MeterValueStart', '$MeterValueEnd', '$MeterValueInBetween', '$ConsumedEnergy','$MeetingSignature', '$HubOperatorID')"; // To record request information
		$result = mysqli_query($db, $query) or die("SQL Query Failed");

}
}

else if($Identification == "QRCodeIdentification"){ // QRCodeIdentification Identification
	$EvcoID             = ((trim($data['EvcoID']) == '') ? '' : $data['EvcoID']);
    $PIN                = ((trim($data['PIN']) == '') ? '' : $data['PIN']);
	$HashedPIN          = ((trim($data['HashedPIN']) == '') ? '' : $data['HashedPIN']);
	$array = array(
			"EvcoID"        => $EvcoID,
			"PIN"           => $PIN,
			"HashedPIN"     => $HashedPIN

	); // Array of essential parameters for QRCodeIdentification 
	$verification = verification("QRCodeIdentification", $array); // Verifcation authenfication function with parameters essential for verification
	if($verification['AuthorizationStatus'] == "Success"){ // Block for authentic verification information from request
		$query = "INSERT INTO eroamingchargedetailrecord(SessionID, CPOPartnerSessionID, EMPPartnerSessionID, PartnerProductID, EvseID, Identification, ChargingStart, ChargingEnd, SessionStart, SessionEnd, MeterValueStart, MeterValueEnd, MeterValueInBetween, ConsumedEnergy,MeetingSignature, HubOperatorID) VALUES ('$SessionID', '$CPOPartnerSessionID', '$EMPPartnerSessionID', '$PartnerProductID', '$EvseID', '$Identification', '$ChargingStart', '$ChargingEnd', '$SessionStart', '$SessionEnd', '$MeterValueStart', '$MeterValueEnd', '$MeterValueInBetween', '$ConsumedEnergy','$MeetingSignature', '$HubOperatorID')"; // To record request information
		$result = mysqli_query($db, $query) or die("SQL Query Failed");
}
}

else if($Identification == "PlugAndChargeIdentification"){ // PlugAndChargeIdentification Identification
	$EvcoID             = ((trim($data['EvcoID']) == '') ? '' : $data['EvcoID']);
	$array = array(
			"EvcoID" => $EvcoID
	); // Array of essential parameters for PlugAndChargeIdentification 
	$verification = verification("PlugAndChargeIdentification", $array); // Verifcation authenfication function with parameters essential for verification
	if($verification['AuthorizationStatus'] == "Success"){ // Block for authentic verification information from request
		$query = "INSERT INTO eroamingchargedetailrecord(SessionID, CPOPartnerSessionID, EMPPartnerSessionID, PartnerProductID, EvseID, Identification, ChargingStart, ChargingEnd, SessionStart, SessionEnd, MeterValueStart, MeterValueEnd, MeterValueInBetween, ConsumedEnergy,MeetingSignature, HubOperatorID) VALUES ('$SessionID', '$CPOPartnerSessionID', '$EMPPartnerSessionID', '$PartnerProductID', '$EvseID', '$Identification', '$ChargingStart', '$ChargingEnd', '$SessionStart', '$SessionEnd', '$MeterValueStart', '$MeterValueEnd', '$MeterValueInBetween', '$ConsumedEnergy','$MeetingSignature', '$HubOperatorID')"; // To record request information
		$result = mysqli_query($db, $query) or die("SQL Query Failed");
}
}

else if($Identification == "RemoteIdentification"){ // RemoteIdentification Identification
	$EvcoID             = ((trim($data['EvcoID']) == '') ? '' : $data['EvcoID']);
	$array = array(
			"EvcoID" => $EvcoID
	); // Array of essential parameters for RemoteIdentification 
	$verification = verification("RemoteIdentification", $array); // Verifcation authenfication function with parameters essential for verification
	if($verification['AuthorizationStatus'] == "Success"){ // Block for authentic verification information from request
		$query = "INSERT INTO eroamingchargedetailrecord(SessionID, CPOPartnerSessionID, EMPPartnerSessionID, PartnerProductID, EvseID, Identification, ChargingStart, ChargingEnd, SessionStart, SessionEnd, MeterValueStart, MeterValueEnd, MeterValueInBetween, ConsumedEnergy,MeetingSignature, HubOperatorID) VALUES ('$SessionID', '$CPOPartnerSessionID', '$EMPPartnerSessionID', '$PartnerProductID', '$EvseID', '$Identification', '$ChargingStart', '$ChargingEnd', '$SessionStart', '$SessionEnd', '$MeterValueStart', '$MeterValueEnd', '$MeterValueInBetween', '$ConsumedEnergy','$MeetingSignature', '$HubOperatorID')"; // To record request information
		$result = mysqli_query($db, $query) or die("SQL Query Failed");
}
}
    if($result){
		echo json_encode(array( // response array
			'Result'              => "true",
			'AuthorizationStatus' => 'Success',
			'StatusCode'          => '000',
			'SESSIONID'           => $SessionID,
		    'CPOPartnerSessionID' => $CPOPartnerSessionID,
		    'EMPPartnerSessionID' => $EMPPartnerSessionID 
		));
	}
	else{ // Block for unauthentic verification information from request
		echo json_encode(array(
			'Result'             => 'false',
			'AuthorizationStatus'=> 'Unauthorized Access.',
			'StatusCode'         => '017')
	);
	}
}


// verification function from the identification provided through request
function verification($identification_type, $array){

	if($identification_type=="RFIDMifareFamilyIdentification"){
		include "connection.php";
		$UID = $array['UID'];
		$query = "SELECT * FROM eroamingauthentificationdata WHERE UID = '$UID' AND Identification='RFIDMifareFamilyIdentification'"; // To verify identification data through request
		$result = mysqli_query($db, $query) or die("SQL Query Failed");
	}else if($identification_type=="RFIDIdentification"){
		include "connection.php";
		$UID           = $array['UID']; // Must
		$EvcoID        = $array['EvcoID'];
		$RFID          = $array['RFID']; //Must
		$PrintedNumber = $array['PrintedNumber'];
		$ExpiryDate    = $array['ExpiryDate'];
		if($EvcoID == "" AND $PrintedNumber == "" AND $ExpiryDate == ""){
		$query = "SELECT * FROM eroamingauthentificationdata WHERE UID = '$UID' AND RFID ='$RFID' AND Identification='RFIDIdentification'"; // To verify identification data through request
	    }else if($EvcoID !=""){
		$query = "SELECT * FROM eroamingauthentificationdata WHERE UID = '$UID' AND EvcoID ='$EvcoID' AND RFID ='$RFID' AND Identification='RFIDIdentification'"; // To verify identification data through request	    	
	    }else if($PrintedNumber !=""){
		$query = "SELECT * FROM eroamingauthentificationdata WHERE UID = '$UID' AND  PrintedNumber='$PrintedNumber' AND RFID ='$RFID' AND Identification='RFIDIdentification'";// To verify identification data through request	    	
	    }else if($ExpiryDate !=""){
		$query = "SELECT * FROM eroamingauthentificationdata WHERE UID = '$UID' AND  ExpiryDate='$ExpiryDate' AND RFID ='$RFID' AND Identification='RFIDIdentification'"; // To verify identification data through request	    	
	    }else if($EvcoID !="" && $PrintedNumber !=""){
		$query = "SELECT * FROM eroamingauthentificationdata WHERE UID = '$UID' AND  EvcoID='$EvcoID' AND PrintedNumber='$PrintedNumber' AND RFID ='$RFID' AND Identification='RFIDIdentification'"; // To verify identification data through request	    	
	    }else if($EvcoID !="" && $ExpiryDate !=""){
		$query = "SELECT * FROM eroamingauthentificationdata WHERE UID = '$UID' AND  EvcoID='$EvcoID' AND ExpiryDate='$ExpiryDate' AND RFID ='$RFID' AND Identification='RFIDIdentification'"; // To verify identification data through request	    	
	    }else if($PrintedNumber !="" && $ExpiryDate !=""){
		$query = "SELECT * FROM eroamingauthentificationdata WHERE UID = '$UID' AND  PrintedNumber='$PrintedNumber' AND ExpiryDate='$ExpiryDate' AND RFID ='$RFID' AND Identification='RFIDIdentification'"; // To verify identification data through request	    	
	    }else if($EvcoID !="" && $PrintedNumber!="" && $ExpiryDate !=""){
		$query = "SELECT * FROM eroamingauthentificationdata WHERE UID = '$UID' AND  EvcoID ='$EvcoID' AND PrintedNumber='$PrintedNumber' AND ExpiryDate='$ExpiryDate' AND RFID ='$RFID' AND Identification='RFIDIdentification'"; // To verify identification data through request
	    }
		$result = mysqli_query($db, $query) or die("SQL Query Failed");
	}else if($identification_type=="QRCodeIdentification"){
		include "connection.php";
		$EvcoID        = $array['EvcoID']; // Must
		$PIN           = $array['PIN'];
		$HashedPIN     = $array['HashedPIN'];

		if($PIN == "" AND $HashedPIN == ""){
		$query = "SELECT * FROM eroamingauthentificationdata WHERE EvcoID = '$EvcoID' AND Identification='QRCodeIdentification'"; // To verify identification data through request
	    }else if($PIN !=""){
		$query = "SELECT * FROM eroamingauthentificationdata WHERE EvcoID = '$EvcoID' AND PIN='$PIN' AND Identification='QRCodeIdentification'"; // To verify identification data through request    	
	    }else if($HashedPIN != ""){
	    $query = "SELECT * FROM eroamingauthentificationdata WHERE EvcoID = '$EvcoID' AND HashedPIN ='$HashedPIN' AND Identification='QRCodeIdentification'"; // To verify identification data through request	  
	    }else if($PIN != "" AND $HashedPIN != ""){
	    $query = "SELECT * FROM eroamingauthentificationdata WHERE EvcoID = '$EvcoID' AND PIN='$PIN' AND HashedPIN ='$HashedPIN' AND Identification='QRCodeIdentification'"; // To verify identification data through request	
	    }
		$result = mysqli_query($db, $query) or die("SQL Query Failed");
	}else if($identification_type=="PlugAndChargeIdentification"){
        include "connection.php";
		$EvcoID = $array['EvcoID'];
		$query = "SELECT * FROM eroamingauthentificationdata WHERE EvcoID = '$EvcoID' AND Identification='PlugAndChargeIdentification'"; // To verify identification data through request
		$result = mysqli_query($db, $query) or die("SQL Query Failed");
	}else if($identification_type=="RemoteIdentification"){
        include "connection.php";
		$EvcoID = $array['EvcoID'];
		$query = "SELECT * FROM eroamingauthentificationdata WHERE EvcoID = '$EvcoID' AND Identification='RemoteIdentification'"; // To verify identification data through request
		$result = mysqli_query($db, $query) or die("SQL Query Failed");
	}

	if(mysqli_num_rows($result)>0){
			$query_ans = mysqli_fetch_all($result, MYSQLI_ASSOC);
			$response_array = array(
				"AuthorizationStatus" => "Success",
			    "StatusCode"          => "000",
			    "ProviderID"          => $query_ans[0]['ProviderID']
			);
	}
	else{
			$response_array = array(
				"AuthorizationStatus" => "Unauthorized Access.",
			    "StatusCode"          => "017"
			);
	}
	return $response_array; // response array return from verification function

	}
function check_date_time_format($datetime_variable){ // function for checking the datetime format

    $parts = explode(" ", $datetime_variable);
    list($y, $m, $d) = explode("-", $parts[0]);

    if(checkdate($m, $d, $y) && isTime($parts[1]) ){
        return "True";
    } else {
        return "False";
    }
}
function isTime($time) {
        if (preg_match("/^([1-2][0-3]|[01]?[1-9]):([0-5]?[0-9]):([0-5]?[0-9])$/", $time))
            return true;
        return false;
    }
?>