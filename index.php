<?php
	// User Details Start
	$fname      = "Shasuddeen";
	$lname      = "Omacy";
	$email      = "omacys2@gmail.com";
	$phone      = "07033870337"; 
	// User Details End
	$amount 	= 300; // Amount in Naira

	$public_key = "875c0cec3a1fae52b5ce536d0e4ec3790d751033"; // You can get it at https://dashboard.payant.ng or https://dashboard.demo.payant.ng for Demo use only
	$status		= "demo"; // You can switch between demo or live
?>
<!DOCTYPE html>
<html>
<head>
	<title>Payant Pay</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
</head>
<body>
	<div class="container">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<form>
				<?php if($status == 'demo'){ ?>
				    <script src="https://api.demo.payant.ng/assets/js/inline.min.js"></script>
				<?php }else{ ?>
				    <script src="https://api.payant.ng/assets/js/inline.min.js"></script>
				<?php } ?>
				<button type="button" onclick="payWithPayant()" class="btn btn-sm"> 
				    <img src="assets/images/payant-cards.png" class="img-responsive" alt="Pay with Payant">
				 </button> 
			</form>
		                        
			<script>
				function payWithPayant() {
				    var handler = Payant.invoice({
					    "key": "<?php echo $public_key; ?>",
					    "client": {
					        "first_name": "<?php echo $fname; ?>",
					        "last_name": "<?php echo $lname; ?>",
					        "email": "<?php echo $email; ?>",
					        "phone": "<?php echo $phone; ?>"
					    },
					    "due_date": "<?php echo date('d/m/Y'); ?>",
					    "fee_bearer": "account",
					    "items": [
					        {
								"item": "Testing PayantPay",
								"description": "Product order via GitHub on <?php echo date('d/m/Y'); ?>",
								"unit_cost": "<?php echo $amount; ?>",
								"quantity": "1"
							}
						],
						callback: function(response) {
						    alert('Success. Your Transaction reference is: ' + response.reference_code);
						    window.location = "verify.php?reference=" + response.reference_code;
						    // console.log(response);
						},
						onClose: function() {
						    alert('Payment Closed. Transaction Cancelled!');                                
						}
					});
					handler.openIframe();
				}
			</script>
		</div>
		<div class="col-md-4"></div>

	</div>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
</body>
</html>