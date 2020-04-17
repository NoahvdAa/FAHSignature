<?php

header("Content-Type: image/png");
$im = @imagecreate(500, 100)
	or die("Cannot Initialize new GD image stream");

switch ($_GET["t"]) {
	case "light_bg":
		$background_color = imagecolorallocatealpha($im, 255, 255, 255, 0);
		$primary = imagecolorallocate($im, 0, 0, 0);
		break;
	case "dark_bg":
		$background_color = imagecolorallocatealpha($im, 0, 0, 0, 0);
		$primary = imagecolorallocate($im, 255, 255, 255);
		break;
	case "light_txt":
		$background_color = imagecolorallocatealpha($im, 0, 0, 0, 127);
		$primary = imagecolorallocate($im, 255, 255, 255);
		break;
	case "dark_txt":
		$background_color = imagecolorallocatealpha($im, 0, 0, 0, 127);
		$primary = imagecolorallocate($im, 0, 0, 0);
		break;
	default:
		$background_color = imagecolorallocatealpha($im, 0, 0, 0, 0);
		$primary = imagecolorallocate($im, 255, 0, 255);
		break;
}

$error_color = imagecolorallocate($im, 255, 0, 0);

if (!isset($_GET["u"]) || strlen($_GET["u"]) === 0) {
	imagestring($im, 5, 0, 0,  "Invalid request.", $error_color);
} else {
	$user = $_GET["u"];
	$d = @file_get_contents("https://stats.foldingathome.org/api/donor/" . $user);
	if (!$d) {
		imagestring($im, 3, 5, 5,  "Something went wrong. This can happen because of three reasons:", $error_color);
		imagestring($im, 3, 5, 15,  "1) A server error occured at FAHSignature.", $error_color);
		imagestring($im, 3, 5, 25,  "2) A server error occured at the F@H servers.", $error_color);
		imagestring($im, 3, 5, 35,  "3) The user you tried to query doesn't exist.", $error_color);
	} else {
		$data = json_decode($d, true);

		imagerectangle($im, 5, 5, 495, 95, $primary);

		$username = $data["name"];
		imagestring($im, 5, 10, 10, cutOffExcess($username, 20) . "'s Folding@Home Stats:", $primary);

		$rank = $data["rank"];
		if ($rank !== 0) {
			$ranklength = strlen(number_format($rank));
			imagestring($im, 5, 430 - ($ranklength * 8), 10, "Rank #" . number_format($rank), $primary);
		}

		$units = $data["wus"];
		imagestring($im, 5, 10, 25, number_format($units) . " Work Unit" . ($units === 1 ? "" : "s") . " completed", $primary);

		$credits = $data["credit"];
		imagestring($im, 5, 10, 40, number_format($credits) . " credit" . ($credits === 1 ? "" : "s") . " earned.", $primary);

		$team = $data["teams"][0];
		imagestring($im, 5, 10, 55, "Team: " . cutOffExcess($team["name"], 30), $primary);

		$wus = $team["wus"];
		$percent = round(($wus / $units) * 100);
		imagestring($im, 5, 10, 70, number_format($wus) . " Work Unit" . ($wus === 1 ? "" : "s") . " completed for this team (" . $percent . "%).", $primary);
	}
}

if (!isset($_GET["c"]) || $_GET["c"] !== "false") {
	$creditcolor = imagecolorallocate($im, 150, 150, 150);
	imagestring($im, 1, 325, 85, "https://noahvdaa.me/FAHSignature/", $creditcolor);
}

imagepng($im);
imagedestroy($im);

function cutOffExcess($string, $lim)
{
	if (strlen($string) <= $lim) {
		return $string;
	} else {
		return substr($string, 0, $lim - 20) . "...";
	}
}
