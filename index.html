<!DOCTYPE HTML>
<html>

<head>
	<title>FAHSignature</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>

<body>
	<br>
	<div class="container">
		<noscript>Please enable JavaScript to use the generator.</noscript>
		<div id="pageContent" style="display: none;">
			<div class="form-group">
				<label for="username">Folding@Home Username</label>
				<input type="text" class="form-control" id="username" placeholder="e.g. Anonymous">
			</div>
		</div>
		<div class="form-group">
			<label for="theme">Theme</label>
			<select class="form-control" id="theme">
				<option value="light_bg">White Background, Black Text</option>
				<option value="dark_bg">Black Background, White Text</option>
				<option value="dark_txt">No Background, Black Text</option>
				<option value="light_txt">No Background, White Text</option>
			</select>
		</div>
		<div class="form-group">
			<div class="form-check">
				<label class="form-check-label">
					<input class="form-check-input" type="checkbox" value="" checked="" id="credit">
					Show FAHSignature link. (Right-hand corner)
				</label>
			</div>
		</div>
		<button onclick="generate();" class="btn btn-primary">Generate signature</button>
		<br><br>
		<div id="previewBox" style="display: none;"></div>
	</div>
</body>
<script>
	document.getElementById("pageContent").style.display = "block";
	function generate() {
		var user = document.getElementById("username").value.replace(/<\/?[^>]+(>|$)/g, "");
		if (user === "") {
			user = "Anonymous";
		}
		document.getElementById("previewBox").style.display = "block";
		var theme = document.getElementById("theme").value;
		if (theme === "light_bg" || theme === "dark_txt") {
			document.getElementById("previewBox").style.background = "#888889";
		} else if (theme === "dark_bg" || theme === "light_txt") {
			document.getElementById("previewBox").style.background = "#5b5b5b";
		} else {
			document.write("No. Just no.");
		}

		var credit = document.getElementById("credit").checked ? "true" : "false";

		var args = "?u=" + user + "&t=" + theme + "&c=" + credit;

		var embedOptions = "<p>Embed this image in your forum signature:</p>";

		var url = "https://fahsignature.herokuapp.com/sig.php" + args;

		embedOptions += "<input type=\"text\" value=\"[img]" + url + "[/img]\" disabled>";

		document.getElementById("previewBox").innerHTML = "<p id=\"imageLoading\">Your image is loading. This can take a while, especially for accounts that are looked up for the first time.</p><img onload=\"hideLoad();\" src=\"sig.php" + args + "\">" + embedOptions;
	}
	function hideLoad() {
		document.getElementById("imageLoading").remove();
	}
</script>
<style>
	#previewBox {
		width: 100%;
		border-radius: 5px;
		border: 1px solid gray;
		background: white;
		color: white;
	}

	input:disabled {
		width: 80%;
		margin-left: 10%;
		margin-right: 10%;
	}
</style>

</html>