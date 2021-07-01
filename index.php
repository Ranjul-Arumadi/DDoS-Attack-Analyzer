<html>

<head>
	<title>DDoS Analyzer</title>
	<link rel="stylesheet" href="style.css"> </head>

<body>
	<div id="title">
		<h1>DDoS Attack Analyzer</h1> </div>
	<div id="desc">
		<h2>A web app featuring a back-end algorithm to parse through .csv files containing SDN report and to identify IP's of machines which might
		have carried out DDoS attack on servers and generate reports based on it.</h2> </div>
	<div id="main">
		<form action="analyzer.php" method="POST" enctype="multipart/form-data">
			<label class="input-file">
				<input type="file" value="Click to browse" name="the_file" id="fileToUpload" accept=".csv" id="btn1" /> </label>
			<input type="submit" name="submit" value="Analyze" id="btn2" /> </form>
	</div>
	<div id="info">
		<h3>Read More</h3>
		<ul>
			<li>What is DDoS ? : <a href="https://www.cloudflare.com/en-in/learning/ddos/what-is-a-ddos-attack/" target="_blank">https://www.cloudflare.com/en-in/learning/ddos/what-is-a-ddos-attack/</a></li>
			<li>Dataset used : <a href="https://data.mendeley.com/datasets/jxpfjc64kr/1" target="_blank">https://data.mendeley.com/datasets/jxpfjc64kr/1</a></li>
			<li>Blacklisted IP's : <a href="https://sslbl.abuse.ch/blacklist/sslipblacklist.txt" target="_blank">https://sslbl.abuse.ch/blacklist/sslipblacklist.txt</a></li>
			<li>API used in this : <a href="https://my.whoapi.com/documentation" target="_blank">https://my.whoapi.com/documentation</a></li>
		</ul>
	</div>
	<script src="script.js"></script>
</body>

</html>