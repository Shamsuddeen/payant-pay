<?php
  $secret_key = "YOUR_PAYANT_PRIVATE_KEY"; // You can get it at https://dashboard.payant.ng
  // Confirm that reference has not already gotten value
  // This would have happened most times if you handle the charge.success event.
  // If it has already gotten value by your records, you may call 
  // perform_success()
  require_once 'vendor/autoload.php';
  use PayantNG\Payant;
  $reference = $_REQUEST['reference'];
  $Payant = new Payant\Payant($secret_key);
  
  $trx = $Payant->getPayment($reference);

  // status should be true if there was a successful call
  if(!$trx->status){
    exit($trx->message);
  }

  // print_r($trx);
  // full sample verify response is here: https://payant.dev
  if('success' == $trx->data->status){
  	// use trx info including metadata and session info to confirm that cartid
    // matches the one for which we accepted payment

    echo json_encode($trx);
    $channel      = $trx->data->channel;
    $amount       = $trx->data->amount;
    if(0 == $trx->data->fraud_status){
      //if there is no fraud status perform execute below functions
      // give_value($reference, $trx);
      // perform_success();
    }else{
      //if fraud status do not perform the operation

    }
    
  }else{
    echo "Error: ";
  }

  // provide value to the customer
  function give_value($reference, $trx){
    // Be sure to log the reference as having gotten value
    // write code to give value
  }

  function perform_success(){
    // popup
    // echo json_encode(['verified'=>true]);
    // standard
    header('Location: ./success.php');
    exit();
  }
?>
