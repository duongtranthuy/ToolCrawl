<?php  
    	$url = $_GET["inputURL"];
    	//h1[@class='coffeehouse']//span
    	$pattern = $_GET["wrapper"];
    	$patternShowroom = $_GET["showroom"];
    	$patternMaker = $_GET["maker"];
    	$patternSale = $_GET["sale"];
    	$patternArea = $_GET["area"];
    	$patternEmail = $_GET["email"];
    	$patternPhone = $_GET["phone"];
		echo $pattern."<br>";
		echo $url;
		// getDOMContent($url, $pattern, $patternShowroom, $patternMaker, $patternSale, $patternArea, $patternEmail, $patternPhone);
		// $rs = getDOMContent($url, $pattern);
		// echo "<pre>".print_r($rs)."</pre>";

		function getSource($url_getcontent) {
			$arrContextOptions=array(
			    "ssl"=>array(
			        "verify_peer"=>false,
			        "verify_peer_name"=>false,
			    ),
			);
			// get source from URL
			$source = file_get_contents($url_getcontent, false, stream_context_create($arrContextOptions));
			return $source;
		}
		function getDOMContent($url, $pattern, $patternShowroom, $patternMaker, $patternSale, $patternArea, $patternEmail, $patternPhone) {
			// define before line
			$html = getSource($url);
			$dom = new DOMDocument();
			@$dom->loadHtml($html);
			$x_path = new DOMXPath($dom);
			// "//h1[@class='coffeehouse']//span"
			$nodes = $x_path->query($pattern);
			$nodesShowroom = $x_path->query($patternShowroom);
			$nodesMaker = $x_path->query($patternMaker);
			$nodesSale = $x_path->query($patternSale);
			$nodesArea = $x_path->query($patternArea);
			$nodesEmail = $x_path->query($patternEmail);
			$nodesPhone = $x_path->query($patternPhone);
			// var_dump($nodesShowroom);
			// echo $nodesShowroom->nodeValue;
			$result[] = [];
			foreach($nodes as $key=>$el){
				// var_dump($el->nodeValue); $dom->getElementsByTagName($tag)->item(0)->nodeValue
				$result[$key] = $el;
				$n = $key + 1;
				// echo "<p>".$key."=>".$el->nodeValue."</p>";
				// "//h1[@class='coffeehouse']//span"
				
				echo mb_convert_encoding($nodesShowroom, "UTF-8"); die;
				echo "<tr><th scope='row'>".$n."</th>
							<td>".$nodesShowroom[$key]->nodeValue."</td>
							<td>".$nodesMaker[$key]->nodeValue."</td>
							<td>".$nodesSale[$key]->nodeValue."</td>
							<td>".$nodesPhone[$key]->nodeValue."</td>
							<td>".$nodesEmail[$key]->nodeValue."</td>
							<td>".$nodesArea[$key]->nodeValue."</td>
					    </tr>";
				// echo "<br>Showroom: ".$nodesShowroom[$key]->nodeValue.
				// 		"<br>Maker: ".$nodesMaker[$key]->nodeValue.
				// 		"<br>Area: ".$nodesArea[$key]->nodeValue.
				// 		"<br>Sale: ".$nodesSale[$key]->nodeValue.
				// 		"<br>phone: ".$nodesPhone[$key]->nodeValue.
				// 		"<br>Email: ".$nodesEmail[$key]->nodeValue.
				// 		"<br>wra: <br>".$el->nodeValue."<br><br><br><br>";
			}
			return $result;
		}
	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Crawl DB</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <style>
    	body {
    		background: #ccc;
    	}
    	h1 {
		    color: #009688;
		    text-align: center;
    	}
    </style>    
</head>
<body>
	<div class="container">
		<h1>Help you crawl DB ^_<</h1>
		<form action="" method="GET">
			<div class="form-group">
				<label for="inputURL">Domain</label>
				<input type="text" class="form-control" name="inputURL" id="inputURL" aria-describedby="url" placeholder="Enter domain" value="<?php echo isset($_GET['inputURL']) ? $_GET['inputURL'] : '' ?>">
				<small id="url" class="form-text text-muted">Enter domain which you want to crawl DB</small>
			</div>
			<div class="row">
				<div class="pattern-wrapper col-md-12">
					<div class="form-group">
						<label for="wrapper">Wrapper Pattern | HTLM Structure</label>
						<input type="text" class="form-control wrapper" name="wrapper" placeholder="wrapper" value="<?php echo isset($_GET['showroom']) ? $_GET['wrapper'] : '' ?>">
						<small class="form-text text-muted">
							<strong>Note:</strong> <br>
									//parentTag[@class='class-parentTag']//childTag <br>
									//*[@class='class-parentTag'] <br>
							<strong>Example:</strong> //h1[@class='coffeehouse']//span
						</small>
					</div>
				</div>
				<div class="pattern-showroom col-md-6">
					<div class="form-group">
						<label for="showroom"><strong>Showroom</strong> <small>Pattern | HTLM Structure</small></label>
						<input type="text" class="form-control showroom" name="showroom" placeholder="showroom" value="<?php echo isset($_GET['showroom']) ? $_GET['showroom'] : '' ?>">
					</div>
				</div>
				<div class="pattern-maker col-md-6">
					<div class="form-group">
						<label for="maker"><strong>Maker</strong> <small>Pattern | HTLM Structure</small></label>
						<input type="text" class="form-control maker" name="maker" placeholder="maker" value="<?php echo isset($_GET['maker']) ? $_GET['maker'] : '' ?>">
					</div>
				</div>
				<div class="pattern-sale col-md-6">
					<div class="form-group">
						<label for="maker"><strong>Sale</strong> <small>Pattern | HTLM Structure</small></label>
						<input type="text" class="form-control sale" name="sale" placeholder="sale" value="<?php echo isset($_GET['sale']) ? $_GET['sale'] : '' ?>">
					</div>
				</div>
				<div class="pattern-area col-md-6">
					<div class="form-group">
						<label for="area"><strong>Area/City</strong> <small>Pattern | HTLM Structure</small></label>
						<input type="text" class="form-control area" name="area" placeholder="area" value="<?php echo isset($_GET['area']) ? $_GET['area'] : '' ?>">
					</div>
				</div>
				<div class="pattern-phone col-md-6">
					<div class="form-group">
						<label for="phone"><strong>Phone</strong> <small>Pattern | HTLM Structure</small></label>
						<input type="text" class="form-control phone" name="phone" placeholder="phone" value="<?php echo isset($_GET['phone']) ? $_GET['phone'] : '' ?>">
					</div>
				</div>
				<div class="pattern-email col-md-6">
					<div class="form-group">
						<label for="email"><strong>Email</strong> <small>Pattern | HTLM Structure</small></label>
						<input type="text" class="form-control email" name="email" placeholder="email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : '' ?>">
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-primary">Crawl</button>
		</form>
	    <table class="table">
		    <thead class="thead-inverse">
			    <tr>
					<th>#</th>
					<th>Showroom</th>
					<th>Maker</th>
					<th>Sale Name</th>
					<th>phone</th>
					<th>Email</th>
					<th>Area/City</th>	
			    </tr>
		    </thead>
		    <tbody>
		    	<?php getDOMContent($url, $pattern, $patternShowroom, $patternMaker, $patternSale, $patternArea, $patternEmail, $patternPhone);?>
		 	</tbody>
		</table>
	</div>
</body>
</html>