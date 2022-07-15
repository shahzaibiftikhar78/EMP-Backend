<?php
header('Content-Type: application/json'); // Data Processed Will Be In Json Format
header('Access-Control-Allow-Origin: *'); // Any Platform Request Can Be Handle

$data = json_decode(file_get_contents("php://input"), true); // To Convert The Input Values in Array Format 

//Request Variables
$SessionID           = ((trim($data['SessionID']) == '') ? '' : trim($data['SessionID'])); // This Will Be Must
$CPOPartnerSessionID = ((trim($data['CPOPartnerSessionID']) == '') ? '' : trim($data['CPOPartnerSessionID']));
$EMPPartnerSessionID = ((trim($data['EMPPartnerSessionID']) == '') ? '' : trim($data['EMPPartnerSessionID']));
$ProviderID          = ((trim($data['ProviderID']) == '') ? '' : trim($data['ProviderID']));// This Will Be Must
$EvseID              = ((trim($data['EvseID']) == '') ? '' : trim($data['EvseID']));// This Will Be Must

include "connection.php"; // Database Connection
if($ProviderID == ''){ // To verify that ProviderID not null

			echo json_encode(array(
			'Message'=> 'Provider ID Is Missing',
			'StatusCode'=> '022')
		);
}
else if($EvseID == ''){ // To verify that EvseID not null

			echo json_encode(array(
			'Message'=> 'Evse ID Is Missing',
			'StatusCode'=> '022')
		);
}else if($SessionID == ''){ // To verify that SessionID not null


			echo json_encode(array(
			'Message'=> 'Session ID Is Missing',
			'StatusCode'=> '022')
		);

}else{
// When Provider ID, Evse ID & Session ID will not be empty then this else will run
$request_start_verification_query = "SELECT * FROM eroamingauthorizeremotestart WHERE SessionID = '$SessionID' AND ProviderID ='$ProviderID' AND EvseID = '$EvseID'";
$result = mysqli_query($db, $request_start_verification_query) or die("SQL Query Failed");
if(mysqli_num_rows($result)>0){
		$query = "INSERT INTO eroamingauthorizeremotestop(SessionID, CPOPartnerSessionID, EMPPartnerSessionID, ProviderID, EvseID) VALUES ('$SessionID', '$CPOPartnerSessionID', '$EMPPartnerSessionID', '$ProviderID', '$EvseID')"; // To record request information
		$result = mysqli_query($db, $query) or die("SQL Query Failed");
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
}
else{ // Block for unauthentic verification information from request
		echo json_encode(array(
			'Result'             => 'false',
			'AuthorizationStatus'=> 'Unauthorized Access.',
			'StatusCode'         => '017')
		);
}

}


?>