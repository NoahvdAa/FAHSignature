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
	$d = file_get_contents("https://stats.foldingathome.org/api/donor/" . $user);
	if (!$d) {
		imagestring($im, 1, 0, 0,  "That user doesn't exist.", $error_color);
	} else {
		$data = json_decode($d, true);

		imagerectangle($im, 5, 5, 495, 95, $primary);

		$username = $data["name"];
		imagestring($im, 5, 10, 10, cutOffExcess($username, 20) . "'s Folding@Home Stats:", $primary);

		$rank = $data["rank"];
		if ($rank !== 0) {
			imagestring($im, 5, 400, 10, "Rank #" . $rank, $primary);
		}

		$units = $data["wus"];
		imagestring($im, 5, 10, 25, $units . " work unit" . ($units == 1 ? "" : "s") . " completed.", $primary);

		$credits = $data["credit"];
		imagestring($im, 5, 10, 40, $credits . " credit" . ($credits == 1 ? "" : "s") . " earned.", $primary);

		$team = $data["teams"][0];
		imagestring($im, 5, 10, 55, "Team: " . cutOffExcess($team["name"], 30), $primary);

		$wus = $team["wus"];
		imagestring($im, 5, 10, 70, $wus . " work unit" . ($wus == 1 ? "" : "s") . " completed for this team", $primary);
	}
}

if (!isset($_GET["c"]) || $_GET["c"] !== "false") {
	$creditcolor = imagecolorallocate($im, 150, 150, 150);
	imagestring($im, 1, 290, 85, "https://noahvdaa.github.io/FAHSignature/", $creditcolor);
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
