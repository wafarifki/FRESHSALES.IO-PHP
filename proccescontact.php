<!--Created By Wafa Rifqi Anafin-->
<!--Use this for learn-->
<!--give issues if you want to get help from me-->

<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.

}
$name = $_POST['first_name'];
$lastname = $_POST['last_name'];
$number = $_POST['mobile_number'];

//Validate first
if(empty($name)||empty($lastname) ||empty($number) ) 
{
    echo "<script type='text/javascript'>
window.location.href='index.php'; 
alert('Please fill all needed form');
</script>";
    exit;
}



$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://DOMAIN.freshsales.io/api/contacts'); //change DOMAIN with your domain freshsales.io
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"contact\":{\"first_name\":\"$name\", \"last_name\":\"$lastname\", \"mobile_number\":\"$number\"}}"); //change what data you want to integration with freshsales.io



$headers = array();
$headers[] = 'Authorization: Token token=AAAAAAAAAAAAAA'; //change AAAAAAAAAAAAAA with your apikey
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
	echo "<script type='text/javascript'>
window.location.href='/'; 
alert('Success, Our team will call back you directly.');
</script>";
	curl_close($ch);
}

// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 