<?php 
/**
 * Template Name: Page Test
 */
get_header(); 
include("sms.class.php");
if ($_POST['test01'] == 'passed') {
    $_REQUEST['username']= '0897474552';
	$_REQUEST['password'] = 'Bb123456';
	$_REQUEST['msisdn'] = '+66625970504';
	$_REQUEST['sender'] = 'THAIBULKSMS';
	$_REQUEST['ScheduledDelivery'] = '1207011545 ';
    $_REQUEST['force'] = 'premium';
    
    $username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$msisdn = $_REQUEST['msisdn'];
	$message = $_REQUEST['message'];
	$sender = $_REQUEST['sender'];
	$ScheduledDelivery = $_REQUEST['ScheduledDelivery'];
	$force = $_REQUEST['force'];
	
	$result = sms::send_sms($username,$password,$msisdn,$message,$sender,$ScheduledDelivery,$force);
	echo $result;
}
?>
<form id="send_sms" name="send_sms" method="post" action="">
Username<br/>
<input type="text" id="username" name="username" value="" /><br/>
Password<br/>
<input type="text" id="password" name="password" value="" /><br/>
Credit Type<br/>
<select id="force" name="force">
<option value="standard" selected="selected">Standard</option>
<option value="premium">Premium</option>
</select><br/>
Sender Name<br/>
<select id="sender" name="sender">
<option value="THAIBULKSMS" selected="selected">THAIBULKSMS</option>
</select><br/>
Phone Number<br/>
<input type="text" id="msisdn" name="msisdn" value="" /><br/>
Message<br/>
<textarea id="message" name="message"></textarea><br/>
ScheduledDelivery<br/>
<input type="text" id="ScheduledDelivery" name="ScheduledDelivery" value="" /> 
* 1207011545 (ปีเดือนวันชั่วโมงนาที)<br/>
<input type="hidden" name="test01" value="passed">
<input type="submit" value="Send Now"/> <input type="reset" value="Reset" />
</form>
<?php get_footer(); ?>