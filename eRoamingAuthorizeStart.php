<?php
header('Content-Type: application/json'); // Data Processed Will Be In Json Format
header('Access-Control-Allow-Origin: *'); // Any Platform Request Can Be Handle

$data = json_decode(file_get_contents("php://input"), true); // To Convert The Input Values in Array Format 

//Request Variables
$SessionID           = ((trim($data['SessionID']) == '') ? '' : trim($data['SessionID']));
$CPOPartnerSessionID = ((trim($data['CPOPartnerSessionID']) == '') ? '' : trim($data['CPOPartnerSessionID']));
$EMPPartnerSessionID = ((trim($data['EMPPartnerSessionID']) == '') ? '' : trim($data['EMPPartnerSessionID']));
$OperatorID          = ((trim($data['OperatorID']) == '') ? '' : trim($data['OperatorID']));         // This Will Be Must
$EvseID              = ((trim($data['EvseID']) == '') ? '' : trim($data['EvseID']));
$Identification      = ((trim($data['Identification']) == '') ? '' : trim($data['Identification'])); // This Will Be Must
$PartnerProductID    = ((trim($data['PartnerProductID']) == '') ? '' : trim($data['PartnerProductID']));

include "connection.php"; // Database Connection
if($OperatorID != ''){
if($Identification == "RFIDMifareFamilyIdentification"){
	$UID    = ((trim($data['UID']) == '') ? '' : $data['UID']); //Must
	$array = array(
			"UID" => $UID
	);
	$verification = verification("RFIDMifareFamilyIdentification", $array);
	if($verification['AuthorizationStatus'] == "Success"){
		$query = "INSERT INTO eroamingauthorizestart(SessionID, CPOPartnerSessionID, EMPPartnerSessionID, OperatorID, EvseID, Identification, PartnerProductID) VALUES ('$SessionID', '$CPOPartnerSessionID', '$EMPPartnerSessionID', '$OperatorID', '$EvseID', '$Identification', '$PartnerProductID')";
		$result = mysqli_query($db, $query) or die("SQL Query Failed");
		if($result){
		echo json_encode(array(
			'SESSIONID'           => $SessionID,
		    'CPOPartnerSessionID' => $CPOPartnerSessionID,
		    'EMPPartnerSessionID' => $EMPPartnerSessionID,
		    'OperatorID'          => $OperatorID,
		    'ProviderID'          => $verification['ProviderID'],
		    'AuthorizationStatus' => 'Success', 
			'StatusCode'          => '000'
		)
	);
	}

	}else{
		echo json_encode(array(
			'AuthorizationStatus'=> 'Unauthorized Access.',
			'StatusCode'=> '017'));
	}
}
else if($Identification == "RFIDIdentification"){
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

	);
	$verification = verification("RFIDIdentification", $array);

	if($verification['AuthorizationStatus'] == "Success"){
		$query = "INSERT INTO eroamingauthorizestart(SessionID, CPOPartnerSessionID, EMPPartnerSessionID, OperatorID, EvseID, Identification, PartnerProductID) VALUES ('$SessionID', '$CPOPartnerSessionID', '$EMPPartnerSessionID', '$OperatorID', '$EvseID', '$Identification', '$PartnerProductID')";
		$result = mysqli_query($db, $query) or die("SQL Query Failed");
		if($result){
		echo json_encode(array(
			'SESSIONID'           => $SessionID,
		    'CPOPartnerSessionID' => $CPOPartnerSessionID,
		    'EMPPartnerSessionID' => $EMPPartnerSessionID,
		    'OperatorID'          => $OperatorID,
		    'ProviderID'          => $verification['ProviderID'],
		    'AuthorizationStatus' => 'Success', 
			'StatusCode'          => '000'
		));
	}
	}else{
		echo json_encode(array(
			'AuthorizationStatus'=> 'Unauthorized Access.',
			'StatusCode'=> '017'));
	}
}
else if($Identification == "QRCodeIdentification"){
	$EvcoID             = ((trim($data['EvcoID']) == '') ? '' : $data['EvcoID']);
    $PIN                = ((trim($data['PIN']) == '') ? '' : $data['PIN']);
	$HashedPIN          = ((trim($data['HashedPIN']) == '') ? '' : $data['HashedPIN']);
	$array = array(
			"EvcoID"        => $EvcoID,
			"PIN"           => $PIN,
			"HashedPIN"     => $HashedPIN

	);
	$verification = verification("QRCodeIdentification", $array);
	if($verification['AuthorizationStatus'] == "Success"){
		$query = "INSERT INTO eroamingauthorizestart(SessionID, CPOPartnerSessionID, EMPPartnerSessionID, OperatorID, EvseID, Identification, PartnerProductID) VALUES ('$SessionID', '$CPOPartnerSessionID', '$EMPPartnerSessionID', '$OperatorID', '$EvseID', '$Identification', '$PartnerProductID')";
		$result = mysqli_query($db, $query) or die("SQL Query Failed");
		if($result){
		echo json_encode(array(
			'SESSIONID'           => $SessionID,
		    'CPOPartnerSessionID' => $CPOPartnerSessionID,
		    'EMPPartnerSessionID' => $EMPPartnerSessionID,
		    'OperatorID'          => $OperatorID,
		    'ProviderID'          => $verification['ProviderID'],
		    'AuthorizationStatus' => 'Success', 
			'StatusCode'          => '000'
		));
	 }	
	}else{
		echo json_encode(array(
			'AuthorizationStatus'=> 'Unauthorized Access.',
			'StatusCode'=> '017'));
	}
}
else if($Identification == "PlugAndChargeIdentification"){
	$EvcoID             = ((trim($data['EvcoID']) == '') ? '' : $data['EvcoID']);
	$array = array(
			"EvcoID" => $EvcoID
	);
	$verification = verification("PlugAndChargeIdentification", $array);
	if($verification['AuthorizationStatus'] == "Success"){
		$query = "INSERT INTO eroamingauthorizestart(SessionID, CPOPartnerSessionID, EMPPartnerSessionID, OperatorID, EvseID, Identification, PartnerProductID) VALUES ('$SessionID', '$CPOPartnerSessionID', '$EMPPartnerSessionID', '$OperatorID', '$EvseID', '$Identification', '$PartnerProductID')";
		$result = mysqli_query($db, $query) or die("SQL Query Failed");
		if($result){
		echo json_encode(array(
			'SESSIONID'           => $SessionID,
		    'CPOPartnerSessionID' => $CPOPartnerSessionID,
		    'EMPPartnerSessionID' => $EMPPartnerSessionID,
		    'OperatorID'          => $OperatorID,
		    'ProviderID'          => $verification['ProviderID'],
		    'AuthorizationStatus' => 'Success', 
			'StatusCode'          => '000'
		));
	}
	}else{
		echo json_encode(array(
			'AuthorizationStatus'=> 'Unauthorized Access.',
			'StatusCode'=> '017'));
	}

}
else if($Identification == "RemoteIdentification"){
	$EvcoID             = ((trim($data['EvcoID']) == '') ? '' : $data['EvcoID']);
	$array = array(
			"EvcoID" => $EvcoID
	);
	$verification = verification("RemoteIdentification", $array);
	if($verification['AuthorizationStatus'] == "Success"){
		$query = "INSERT INTO eroamingauthorizestart(SessionID, CPOPartnerSessionID, EMPPartnerSessionID, OperatorID, EvseID, Identification, PartnerProductID) VALUES ('$SessionID', '$CPOPartnerSessionID', '$EMPPartnerSessionID', '$OperatorID', '$EvseID', '$Identification', '$PartnerProductID')";
		$result = mysqli_query($db, $query) or die("SQL Query Failed");
		if($result){
		echo json_encode(array(
			'SESSIONID'           => $SessionID,
		    'CPOPartnerSessionID' => $CPOPartnerSessionID,
		    'EMPPartnerSessionID' => $EMPPartnerSessionID,
		    'OperatorID'          => $OperatorID,
		    'ProviderID'          => $verification['ProviderID'],
		    'AuthorizationStatus' => 'Success', 
			'StatusCode'          => '000'
		));
	}
	}else{
		echo json_encode(array(
			'AuthorizationStatus'=> 'Unauthorized Access.',
			'StatusCode'=> '017'));
	}
}
}else{
			echo json_encode(array(
			'Message'=> 'Charge Point Operator ID not Found.',
			'StatusCode'=> '022')
		);
}
// verification function from the identification provided through request
function verification($identification_type, $array){

	if($identification_type=="RFIDMifareFamilyIdentification"){
		include "connection.php";
		$UID = $array['UID'];
		$query = "SELECT * FROM eroamingauthentificationdata WHERE UID = '$UID' AND Identification='RFIDMifareFamilyIdentification'";
		$result = mysqli_query($db, $query) or die("SQL Query Failed");
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

	}else if($identification_type=="RFIDIdentification"){
		include "connection.php";
		$UID           = $array['UID']; // Must
		$EvcoID        = $array['EvcoID'];
		$RFID          = $array['RFID']; //Must
		$PrintedNumber = $array['PrintedNumber'];
		$ExpiryDate    = $array['ExpiryDate'];
		if($EvcoID == "" AND $PrintedNumber == "" AND $ExpiryDate == ""){
		$query = "SELECT * FROM eroamingauthentificationdata WHERE UID = '$UID' AND RFID ='$RFID' AND Identification='RFIDIdentification'";
	    }else if($EvcoID !=""){
		$query = "SELECT * FROM eroamingauthentificationdata WHERE UID = '$UID' AND EvcoID ='$EvcoID' AND RFID ='$RFID' AND Identification='RFIDIdentification'";	    	
	    }else if($PrintedNumber !=""){
		$query = "SELECT * FROM eroamingauthentificationdata WHERE UID = '$UID' AND  PrintedNumber='$PrintedNumber' AND RFID ='$RFID' AND Identification='RFIDIdentification'";	    	
	    }else if($ExpiryDate !=""){
		$query = "SELECT * FROM eroamingauthentificationdata WHERE UID = '$UID' AND  ExpiryDate='$ExpiryDate' AND RFID ='$RFID' AND Identification='RFIDIdentification'";	    	
	    }else if($EvcoID !="" && $PrintedNumber !=""){
		$query = "SELECT * FROM eroamingauthentificationdata WHERE UID = '$UID' AND  EvcoID='$EvcoID' AND PrintedNumber='$PrintedNumber' AND RFID ='$RFID' AND Identification='RFIDIdentification'";	    	
	    }else if($EvcoID !="" && $ExpiryDate !=""){
		$query = "SELECT * FROM eroamingauthentificationdata WHERE UID = '$UID' AND  EvcoID='$EvcoID' AND ExpiryDate='$ExpiryDate' AND RFID ='$RFID' AND Identification='RFIDIdentification'";	    	
	    }else if($PrintedNumber !="" && $ExpiryDate !=""){
		$query = "SELECT * FROM eroamingauthentificationdata WHERE UID = '$UID' AND  PrintedNumber='$PrintedNumber' AND ExpiryDate='$ExpiryDate' AND RFID ='$RFID' AND Identification='RFIDIdentification'";	    	
	    }else if($EvcoID !="" && $PrintedNumber!="" && $ExpiryDate !=""){
		$query = "SELECT * FROM eroamingauthentificationdata WHERE UID = '$UID' AND  EvcoID ='$EvcoID' AND PrintedNumber='$PrintedNumber' AND ExpiryDate='$ExpiryDate' AND RFID ='$RFID' AND Identification='RFIDIdentification'";
	    }
		$result = mysqli_query($db, $query) or die("SQL Query Failed");
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
	}else if($identification_type=="QRCodeIdentification"){
		include "connection.php";
		$EvcoID        = $array['EvcoID']; // Must
		$PIN           = $array['PIN'];
		$HashedPIN     = $array['HashedPIN'];

		if($PIN == "" AND $HashedPIN == ""){
		$query = "SELECT * FROM eroamingauthentificationdata WHERE EvcoID = '$EvcoID' AND Identification='QRCodeIdentification'";
	    }else if($PIN !=""){
		$query = "SELECT * FROM eroamingauthentificationdata WHERE EvcoID = '$EvcoID' AND PIN='$PIN' AND Identification='QRCodeIdentification'";	    	
	    }else if($HashedPIN != ""){
	    $query = "SELECT * FROM eroamingauthentificationdata WHERE EvcoID = '$EvcoID' AND HashedPIN ='$HashedPIN' AND Identification='QRCodeIdentification'";	  
	    }else if($PIN != "" AND $HashedPIN != ""){
	    $query = "SELECT * FROM eroamingauthentificationdata WHERE EvcoID = '$EvcoID' AND PIN='$PIN' AND HashedPIN ='$HashedPIN' AND Identification='QRCodeIdentification'"; 	
	    }
		$result = mysqli_query($db, $query) or die("SQL Query Failed");
		if(mysqli_num_rows($result)>0){
			$query_ans = mysqli_fetch_all($result, MYSQLI_ASSOC);
			$response_array = array(
				"AuthorizationStatus" => "Success",
			    "StatusCode"          => "000",
			    "ProviderID"          => $query[0]['ProviderID']
			);
		}
		else{
			$response_array = array(
				"AuthorizationStatus" => "Unauthorized Access.",
			    "StatusCode"          => "017"
			);
		}
	}else if($identification_type=="PlugAndChargeIdentification"){
        include "connection.php";
		$EvcoID = $array['EvcoID'];
		$query = "SELECT * FROM eroamingauthentificationdata WHERE EvcoID = '$EvcoID' AND Identification='PlugAndChargeIdentification'";
		$result = mysqli_query($db, $query) or die("SQL Query Failed");
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

	}else if($identification_type=="RemoteIdentification"){
        include "connection.php";
		$EvcoID = $array['EvcoID'];
		$query = "SELECT * FROM eroamingauthentificationdata WHERE EvcoID = '$EvcoID' AND Identification='RemoteIdentification'";
		$result = mysqli_query($db, $query) or die("SQL Query Failed");
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

	}
	return $response_array;

	}

?>