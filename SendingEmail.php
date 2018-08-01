<?php 
//mail('joyrakesh09@gmail.com','Testing','This is just a check','From: joyrakesh09@gmail.com');
$emailTo="ehrm1747225@gmail.com";
$subject="testing";
$body="Lets Checks its working";
$headers="From:ehrm1747225@gmail.com";
if(mail($emailTo, $subject, $body, $headers)){
	echo "Mail Sent ";
	}else{
		echo "Mail not sent";
	}

?>