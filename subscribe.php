<?php
// Subscribe handler: adds the address to the Sender.net audience.
// Token lives OUTSIDE the web root: <docroot>/../sender-api-token
// Uses plain PHP streams (no curl dependency).
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

$ctx = stream_context_create(array('http' => array(
    'method' => 'POST',
    'timeout' => 20,
    'ignore_errors' => true,
    'header' => "Authorization: Bearer " . $token . "\r\n" .
                "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n",
    'content' => json_encode(array(
        'email' => $email,
        'groups' => array('dR0Kgq'),
        'trigger_automation' => false,
    )),
)));
$resp = @file_get_contents('https://api.sender.net/v2/subscribers', false, $ctx);
$code = 0;
if (isset($http_response_header[0]) && preg_match('/\s(\d{3})\s/', $http_response_header[0], $m)) {
    $code = intval($m[1]);
}
?>
<HTML>
<HEAD>
<TITLE>Subscribed — ROTHKAMM</TITLE>
<LINK HREF="css.css" REL="stylesheet" TYPE="text/css">
</HEAD>
<BODY>
<DIV ALIGN="center" CLASS="style2c"><BR><BR>
<?php if ($code === 200 || $code === 201) { ?>
<STRONG>Thank you — you are on the list.</STRONG>
<?php } else { ?>
<STRONG>Something went wrong (<?php echo intval($code); ?>). Please try again later.</STRONG>
<?php } ?>
<?php
$back = 'index.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
    $ref = parse_url($_SERVER['HTTP_REFERER']);
    if (!empty($ref['host']) && preg_match('/(^|\.)rothkamm\.com$/', $ref['host'])) {
        $back = $ref['path'] . (!empty($ref['query']) ? '?' . $ref['query'] : '');
    }
}
?>
<BR><BR><A HREF="<?php echo htmlspecialchars($back, ENT_QUOTES, 'UTF-8'); ?>">back to rothkamm.com</A>
</DIV>
<?php include("navbar.php"); ?>
</BODY>
</HTML>
