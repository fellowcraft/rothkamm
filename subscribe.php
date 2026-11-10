<?php
// Subscribe handler: adds the address to the Sender.net audience.
// Token lives OUTSIDE the web root: <docroot>/../sender-api-token
header('Content-Type: text/html; charset=utf-8');

$email = isset($_POST['EMAIL']) ? trim($_POST['EMAIL']) : '';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    exit("That address does not look valid. Please go back and try again.");
}

$tokenFile = dirname(__DIR__) . '/sender-api-token';
if (!is_readable($tokenFile)) {
    http_response_code(500);
    exit("Signup is temporarily unavailable. Please try again later.");
}
$token = trim(file_get_contents($tokenFile));

$ch = curl_init('https://api.sender.net/v2/subscribers');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 20);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $token,
    'Content-Type: application/json',
    'Accept: application/json',
));
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(
    'email' => $email,
    'groups' => array('dR0Kgq'),
    'trigger_automation' => false,
)));
$resp = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
?>
<HTML>
<HEAD>
<TITLE>Subscribed — ROTHKAMM</TITLE>
<LINK HREF="css.css" REL="stylesheet" TYPE="text/css">
</HEAD>
<BODY>
<DIV ALIGN="center" CLASS="style2c"><BR><BR>
<?php if ($code === 200) { ?>
<STRONG>Thank you — you are on the list.</STRONG>
<?php } else { ?>
<STRONG>Something went wrong (<?php echo intval($code); ?>). Please try again later.</STRONG>
<?php } ?>
<BR><BR><A HREF="index">back to rothkamm.com</A>
</DIV>
<?php include("navbar.php"); ?>
</BODY>
</HTML>
