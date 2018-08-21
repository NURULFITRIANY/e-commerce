<?php $page = "MANAGEMENT OF MARKETING";?>

<?php include('inc/headerbackend.php'); ?>

<?php include('inc/sidebarbackend.php'); ?>

<!-- induk plugin jquery -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<!-- jequery utk date picker start- end -->

<link rel="stylesheet" type="text/css" href="js/jquery-ui.css">
<script src="js/external/jquery/jquery.js"></script>
<script src="js/jquery-ui.js"></script>



<script>
	$(function() {
		$("#datepicker"). datepicker ({
			dateFormat: "yy-mm-dd"
		});
		$("#datepicker2"). datepicker ({
			dateFormat: "yy-mm-dd"
		});
	});
</script>

<section class="main">
	<h1>eCom iFrame</h1>
	
	<br>

	<!-- form input -->
	<hr>
	<h2>Form</h2>
		<div>
			<form name="" id="" method-"GET" action=""> 
				<select name="query">
					<option value="sales">Top Sales by revenue</option>
					<option value="kategori">Top Categories by units sold</option>
					<option value="produk">Top Products by units sold</option>
				</select>
				<select name="by">
					<option value="tahun">Yearly sales comparison</option>
					<option value="bulan">Monthly sales comparison</option>
					<option value="hari">Daily sales comparison</option>
				</select>
				<button type="submit" value="" name="">
					Result
				</button>
			</form>
		</div>
	<br>

	<?php 
		if (isset($_GET['query']) AND $_GET['query'] == 'sales' 
			AND isset($_GET['by']) AND $_GET['by']=='tahun') {
			$query = mysql_query("SELECT YEAR(tanggal) as SalesYear, SUM(harga) AS TotalSales 
							FROM pesanan 
							GROUP BY YEAR(tanggal)");
			// This is a simple example on how to draw a chart using FusionCharts and PHP.
			// We have included includes/fusioncharts.php, which contains functions
			// to help us easily embed the charts.
			include("fusioncharts/fusioncharts.php");
			// Create the chart - Column 2D Chart with data given in constructor parameter 
			// Syntax for the constructor - 
			if ($query) {
  
			// The `$arrData` array holds the chart attributes and data

			$arrData = array(
			  "chart" => array
			  (
				"caption" => "Top Sales Yearly by Revenue",

				"paletteColors" => "#0075c2",
				"bgColor" => "#ffffff",
				"borderAlpha"=> "20",
				"canvasBorderAlpha"=> "0",
				"usePlotGradientColor"=> "0",
				"plotBorderAlpha"=> "10",
				"showXAxisLine"=> "1",
				"xAxisLineColor" => "#999999",
				"showValues" => "0",
				"divlineColor" => "#999999",
				"divLineIsDashed" => "1",
				"showAlternateHGridColor" => "0"
			  )
			);

			$arrData["data"] = array();

			// Push the data into the array

			while($row = mysql_fetch_array($query)) {
			array_push($arrData["data"], array(
			  "label" => $row['SalesYear'],
			  "value" => $row['TotalSales']
			  )
			);
			}

			/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

			$jsonEncodedData = json_encode($arrData);

			/*
			 Create an object for the column chart using the FusionCharts PHP class constructor. 
			 Syntax for the constructor is 
			 `FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. 
			 Because we are using JSON data to render the chart, the data format will be `json`. 
			 The variable `$jsonEncodeData` holds all the JSON data for the chart, 
			 and will be passed as the value for the data source parameter of the constructor.
			*/

			$columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chartContainer", "json", $jsonEncodedData);

			// Render the chart

			$columnChart->render();
			}
			// Close the database connection
		} elseif (isset($_GET['query']) AND $_GET['query'] == 'sales' 
			AND isset($_GET['by']) AND $_GET['by']=='bulan') {
			$query = mysql_query("SELECT MONTH(tanggal) as SalesMonth, SUM(harga) AS TotalSales 
							FROM pesanan 
							GROUP BY MONTH(tanggal)");
			
			// This is a simple example on how to draw a chart using FusionCharts and PHP.
			// We have included includes/fusioncharts.php, which contains functions
			// to help us easily embed the charts.
			include("fusioncharts/fusioncharts.php");
			// Create the chart - Column 2D Chart with data given in constructor parameter 
			// Syntax for the constructor - 
			if ($query) {
  
			// The `$arrData` array holds the chart attributes and data

			$arrData = array(
			  "chart" => array
			  (
				"caption" => "Top Sales Monthly by Revenue",
				
				"paletteColors" => "#0075c2",
				"bgColor" => "#ffffff",
				"borderAlpha"=> "20",
				"canvasBorderAlpha"=> "0",
				"usePlotGradientColor"=> "0",
				"plotBorderAlpha"=> "10",
				"showXAxisLine"=> "1",
				"xAxisLineColor" => "#999999",
				"showValues" => "0",
				"divlineColor" => "#999999",
				"divLineIsDashed" => "1",
				"showAlternateHGridColor" => "0"
			  )
			);

			$arrData["data"] = array();

			// Push the data into the array

			while($row = mysql_fetch_array($query)) {
			array_push($arrData["data"], array(
			  "label" => $row['SalesMonth'],
			  "value" => $row['TotalSales']
			  )
			);
			}

			/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

			$jsonEncodedData = json_encode($arrData);

			/*
			 Create an object for the column chart using the FusionCharts PHP class constructor. 
			 Syntax for the constructor is 
			 `FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. 
			 Because we are using JSON data to render the chart, the data format will be `json`. 
			 The variable `$jsonEncodeData` holds all the JSON data for the chart, 
			 and will be passed as the value for the data source parameter of the constructor.
			*/

			$columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chartContainer", "json", $jsonEncodedData);

			// Render the chart

			$columnChart->render();
			}
			// Close the database connection
		} elseif (isset($_GET['query']) AND $_GET['query'] == 'sales' 
			AND isset($_GET['by']) AND $_GET['by']=='hari') {
			$query = mysql_query("SELECT tanggal as SalesDaily, SUM(harga) AS TotalSales 
							FROM pesanan 
							GROUP BY tanggal");
						// This is a simple example on how to draw a chart using FusionCharts and PHP.
			// We have included includes/fusioncharts.php, which contains functions
			// to help us easily embed the charts.
			include("fusioncharts/fusioncharts.php");
			// Create the chart - Column 2D Chart with data given in constructor parameter 
			// Syntax for the constructor - 
			if ($query) {
  
			// The `$arrData` array holds the chart attributes and data

			$arrData = array(
			  "chart" => array
			  (
				"caption" => "Top Sales Daily by Revenue",
				
				"paletteColors" => "#0075c2",
				"bgColor" => "#ffffff",
				"borderAlpha"=> "20",
				"canvasBorderAlpha"=> "0",
				"usePlotGradientColor"=> "0",
				"plotBorderAlpha"=> "10",
				"showXAxisLine"=> "1",
				"xAxisLineColor" => "#999999",
				"showValues" => "0",
				"divlineColor" => "#999999",
				"divLineIsDashed" => "1",
				"showAlternateHGridColor" => "0"
			  )
			);

			$arrData["data"] = array();

			// Push the data into the array

			while($row = mysql_fetch_array($query)) {
			array_push($arrData["data"], array(
			  "label" => $row['SalesDaily'],
			  "value" => $row['TotalSales']
			  )
			);
			}

			/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

			$jsonEncodedData = json_encode($arrData);

			/*
			 Create an object for the column chart using the FusionCharts PHP class constructor. 
			 Syntax for the constructor is 
			 `FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. 
			 Because we are using JSON data to render the chart, the data format will be `json`. 
			 The variable `$jsonEncodeData` holds all the JSON data for the chart, 
			 and will be passed as the value for the data source parameter of the constructor.
			*/

			$columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chartContainer", "json", $jsonEncodedData);

			// Render the chart

			$columnChart->render();
			}
			// Close the database connection
		} elseif (isset($_GET['query']) AND $_GET['query'] == 'kategori' 
			AND isset($_GET['by']) AND $_GET['by']=='tahun') {
			$query = mysql_query("SELECT pesanan.id_pesanan, pesanan.tanggal, pesanan_detail.id_produk, max(pesanan_detail.jumlah), produk.judul, produk.id_kategori, kategori.kategori 
									FROM pesanan 
									INNER JOIN pesanan_detail ON pesanan.id_pesanan=pesanan_detail.id_pesanan_detail
									INNER JOIN produk ON pesanan_detail.id_produk=produk.id_produk 
									INNER JOIN kategori ON produk.id_kategori=kategori.id_kategori 
									GROUP BY year(pesanan.tanggal)");
						// This is a simple example on how to draw a chart using FusionCharts and PHP.
			// We have included includes/fusioncharts.php, which contains functions
			// to help us easily embed the charts.
			include("fusioncharts/fusioncharts.php");
			// Create the chart - Column 2D Chart with data given in constructor parameter 
			// Syntax for the constructor - 
			if ($query) {
  
			// The `$arrData` array holds the chart attributes and data

			$arrData = array(
			  "chart" => array
			  (
				"caption" => "Top Categories Yearly by Units Sold",
				"paletteColors" => "#0075c2",
				"bgColor" => "#ffffff",
				"borderAlpha"=> "20",
				"canvasBorderAlpha"=> "0",
				"usePlotGradientColor"=> "0",
				"plotBorderAlpha"=> "10",
				"showXAxisLine"=> "1",
				"xAxisLineColor" => "#999999",
				"showValues" => "0",
				"divlineColor" => "#999999",
				"divLineIsDashed" => "1",
				"showAlternateHGridColor" => "0"
			  )
			);

			$arrData["data"] = array();

			// Push the data into the array

			while($row = mysql_fetch_array($query)) {
			array_push($arrData["data"], array(
			  "label" => $row['kategori'],
			  "value" => $row['max(pesanan_detail.jumlah)']
			  )
			);
			}

			/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

			$jsonEncodedData = json_encode($arrData);

			/*
			 Create an object for the column chart using the FusionCharts PHP class constructor. 
			 Syntax for the constructor is 
			 `FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. 
			 Because we are using JSON data to render the chart, the data format will be `json`. 
			 The variable `$jsonEncodeData` holds all the JSON data for the chart, 
			 and will be passed as the value for the data source parameter of the constructor.
			*/

			$columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chartContainer", "json", $jsonEncodedData);

			// Render the chart

			$columnChart->render();
			}
			// Close the database connection
		} elseif (isset($_GET['query']) AND $_GET['query'] == 'kategori' 
			AND isset($_GET['by']) AND $_GET['by']=='bulan') {
			$query = mysql_query("SELECT pesanan.id_pesanan, pesanan.tanggal, pesanan_detail.id_produk, max(pesanan_detail.jumlah), produk.judul, produk.id_kategori, kategori.kategori 
									FROM pesanan 
									INNER JOIN pesanan_detail ON pesanan.id_pesanan=pesanan_detail.id_pesanan_detail
									INNER JOIN produk ON pesanan_detail.id_produk=produk.id_produk 
									INNER JOIN kategori ON produk.id_kategori=kategori.id_kategori 
									GROUP BY month(pesanan.tanggal)");
						// This is a simple example on how to draw a chart using FusionCharts and PHP.
			// We have included includes/fusioncharts.php, which contains functions
			// to help us easily embed the charts.
			include("fusioncharts/fusioncharts.php");
			// Create the chart - Column 2D Chart with data given in constructor parameter 
			// Syntax for the constructor - 
			if ($query) {
  
			// The `$arrData` array holds the chart attributes and data

			$arrData = array(
			  "chart" => array
			  (
				"caption" => "Top Categories Monthly by Units Sold",
				
				"bgColor" => "#ffffff",
				"borderAlpha"=> "20",
				"canvasBorderAlpha"=> "0",
				"usePlotGradientColor"=> "0",
				"plotBorderAlpha"=> "10",
				"showXAxisLine"=> "1",
				"xAxisLineColor" => "#999999",
				"showValues" => "0",
				"divlineColor" => "#999999",
				"divLineIsDashed" => "1",
				"showAlternateHGridColor" => "0"
			  )
			);

			$arrData["data"] = array();

			// Push the data into the array

			while($row = mysql_fetch_array($query)) {
			array_push($arrData["data"], array(
			  "label" => $row['kategori'],
			  "value" => $row['max(pesanan_detail.jumlah)']
			  )
			);
			}

			/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

			$jsonEncodedData = json_encode($arrData);

			/*
			 Create an object for the column chart using the FusionCharts PHP class constructor. 
			 Syntax for the constructor is 
			 `FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. 
			 Because we are using JSON data to render the chart, the data format will be `json`. 
			 The variable `$jsonEncodeData` holds all the JSON data for the chart, 
			 and will be passed as the value for the data source parameter of the constructor.
			*/

			$columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chartContainer", "json", $jsonEncodedData);

			// Render the chart

			$columnChart->render();
			}
			// Close the database connection
		} elseif (isset($_GET['query']) AND $_GET['query'] == 'kategori' 
			AND isset($_GET['by']) AND $_GET['by']=='hari') {
			$query = mysql_query("SELECT pesanan.id_pesanan, pesanan.tanggal, pesanan_detail.id_produk, max(pesanan_detail.jumlah), produk.judul, produk.id_kategori, kategori.kategori 
								FROM pesanan 
								INNER JOIN pesanan_detail ON pesanan.id_pesanan=pesanan_detail.id_pesanan_detail 
								INNER JOIN produk ON pesanan_detail.id_produk=produk.id_produk 
								INNER JOIN kategori ON produk.id_kategori=kategori.id_kategori 
								GROUP BY pesanan.tanggal
				");
			// This is a simple example on how to draw a chart using FusionCharts and PHP.
			// We have included includes/fusioncharts.php, which contains functions
			// to help us easily embed the charts.
			include("fusioncharts/fusioncharts.php");
			// Create the chart - Column 2D Chart with data given in constructor parameter 
			// Syntax for the constructor - 
			if ($query) {
  
			// The `$arrData` array holds the chart attributes and data

			$arrData = array(
			  "chart" => array
			  (
				"caption" => "Top Categories Daily by Units Sold",
				
				"paletteColors" => "#0075c2",
				"bgColor" => "#ffffff",
				"borderAlpha"=> "20",
				"canvasBorderAlpha"=> "0",
				"usePlotGradientColor"=> "0",
				"plotBorderAlpha"=> "10",
				"showXAxisLine"=> "1",
				"xAxisLineColor" => "#999999",
				"showValues" => "0",
				"divlineColor" => "#999999",
				"divLineIsDashed" => "1",
				"showAlternateHGridColor" => "0"
			  )
			);

			$arrData["data"] = array();

			// Push the data into the array

			while($row = mysql_fetch_array($query)) {
			array_push($arrData["data"], array(
			  "label" => $row['kategori'],
			  "value" => $row['max(pesanan_detail.jumlah)']
			  )
			);
			}

			/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

			$jsonEncodedData = json_encode($arrData);

			/*
			 Create an object for the column chart using the FusionCharts PHP class constructor. 
			 Syntax for the constructor is 
			 `FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. 
			 Because we are using JSON data to render the chart, the data format will be `json`. 
			 The variable `$jsonEncodeData` holds all the JSON data for the chart, 
			 and will be passed as the value for the data source parameter of the constructor.
			*/

			$columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chartContainer", "json", $jsonEncodedData);

			// Render the chart

			$columnChart->render();
			}
			// Close the database connection

		} elseif (isset($_GET['query']) AND $_GET['query'] == 'produk' 
			AND isset($_GET['by']) AND $_GET['by']=='tahun') {
			$query = mysql_query("SELECT pesanan.id_pesanan, pesanan.tanggal, pesanan_detail.id_produk, max(pesanan_detail.jumlah), produk.judul, produk.id_kategori, kategori.kategori 
									FROM pesanan 
									INNER JOIN pesanan_detail ON pesanan.id_pesanan=pesanan_detail.id_pesanan_detail
									INNER JOIN produk ON pesanan_detail.id_produk=produk.id_produk 
									INNER JOIN kategori ON produk.id_kategori=kategori.id_kategori 
									GROUP BY month(pesanan.tanggal)");
			
			// This is a simple example on how to draw a chart using FusionCharts and PHP.
			// We have included includes/fusioncharts.php, which contains functions
			// to help us easily embed the charts.
			include("fusioncharts/fusioncharts.php");
			// Create the chart - Column 2D Chart with data given in constructor parameter 
			// Syntax for the constructor - 
			if ($query) {
  
			// The `$arrData` array holds the chart attributes and data

			$arrData = array(
			  "chart" => array
			  (
				"caption" => "Top Products Yearly by Units Sold",
				
				"paletteColors" => "#0075c2",
				"bgColor" => "#ffffff",
				"borderAlpha"=> "20",
				"canvasBorderAlpha"=> "0",
				"usePlotGradientColor"=> "0",
				"plotBorderAlpha"=> "10",
				"showXAxisLine"=> "1",
				"xAxisLineColor" => "#999999",
				"showValues" => "0",
				"divlineColor" => "#999999",
				"divLineIsDashed" => "1",
				"showAlternateHGridColor" => "0"
			  )
			);

			$arrData["data"] = array();

			// Push the data into the array

			while($row = mysql_fetch_array($query)) {
			array_push($arrData["data"], array(
			  "label" => $row['judul'],
			  "value" => $row['max(pesanan_detail.jumlah)']
			  )
			);
			}

			/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

			$jsonEncodedData = json_encode($arrData);

			/*
			 Create an object for the column chart using the FusionCharts PHP class constructor. 
			 Syntax for the constructor is 
			 `FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. 
			 Because we are using JSON data to render the chart, the data format will be `json`. 
			 The variable `$jsonEncodeData` holds all the JSON data for the chart, 
			 and will be passed as the value for the data source parameter of the constructor.
			*/

			$columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chartContainer", "json", $jsonEncodedData);

			// Render the chart

			$columnChart->render();
			}
			// Close the database connection
		} elseif (isset($_GET['query']) AND $_GET['query'] == 'produk' 
			AND isset($_GET['by']) AND $_GET['by']=='bulan') {
			$query = mysql_query("SELECT pesanan.id_pesanan, pesanan.tanggal, pesanan_detail.id_produk, max(pesanan_detail.jumlah), produk.judul, produk.id_kategori, kategori.kategori 
									FROM pesanan 
									INNER JOIN pesanan_detail ON pesanan.id_pesanan=pesanan_detail.id_pesanan_detail
									INNER JOIN produk ON pesanan_detail.id_produk=produk.id_produk 
									INNER JOIN kategori ON produk.id_kategori=kategori.id_kategori 
									GROUP BY month(pesanan.tanggal)");

			// This is a simple example on how to draw a chart using FusionCharts and PHP.
			// We have included includes/fusioncharts.php, which contains functions
			// to help us easily embed the charts.
			include("fusioncharts/fusioncharts.php");
			// Create the chart - Column 2D Chart with data given in constructor parameter 
			// Syntax for the constructor - 
			if ($query) {
  
			// The `$arrData` array holds the chart attributes and data

			$arrData = array(
			  "chart" => array
			  (
				"caption" => "Top Products Monthly by Units Sold",
								
				"paletteColors" => "#0075c2",
				"bgColor" => "#ffffff",
				"borderAlpha"=> "20",
				"canvasBorderAlpha"=> "0",
				"usePlotGradientColor"=> "0",
				"plotBorderAlpha"=> "10",
				"showXAxisLine"=> "1",
				"xAxisLineColor" => "#999999",
				"showValues" => "0",
				"divlineColor" => "#999999",
				"divLineIsDashed" => "1",
				"showAlternateHGridColor" => "0"
			  )
			);

			$arrData["data"] = array();

			// Push the data into the array

			while($row = mysql_fetch_array($query)) {
			array_push($arrData["data"], array(
			  "label" => $row['id_produk'],
			  "value" => $row['max(pesanan_detail.jumlah)']
			  )
			);
			}

			/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

			$jsonEncodedData = json_encode($arrData);

			/*
			 Create an object for the column chart using the FusionCharts PHP class constructor. 
			 Syntax for the constructor is 
			 `FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. 
			 Because we are using JSON data to render the chart, the data format will be `json`. 
			 The variable `$jsonEncodeData` holds all the JSON data for the chart, 
			 and will be passed as the value for the data source parameter of the constructor.
			*/

			$columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chartContainer", "json", $jsonEncodedData);

			// Render the chart

			$columnChart->render();
			}
			// Close the database connection
		} elseif (isset($_GET['query']) AND $_GET['query'] == 'produk' 
			AND isset($_GET['by']) AND $_GET['by']=='hari') {
			$query = mysql_query("SELECT pesanan.id_pesanan, pesanan.tanggal, pesanan_detail.id_produk, max(pesanan_detail.jumlah), produk.judul, produk.id_kategori, kategori.kategori 
									FROM pesanan 
									INNER JOIN pesanan_detail ON pesanan.id_pesanan=pesanan_detail.id_pesanan_detail
									INNER JOIN produk ON pesanan_detail.id_produk=produk.id_produk 
									INNER JOIN kategori ON produk.id_kategori=kategori.id_kategori 
									GROUP BY month(pesanan.tanggal)
							");

			// This is a simple example on how to draw a chart using FusionCharts and PHP.
			// We have included includes/fusioncharts.php, which contains functions
			// to help us easily embed the charts.
			include("fusioncharts/fusioncharts.php");
			// Create the chart - Column 2D Chart with data given in constructor parameter 
			// Syntax for the constructor - 
			if ($query) {
  
			// The `$arrData` array holds the chart attributes and data

			$arrData = array(
			  "chart" => array
			  (
				"caption" => "Top Products Daily by Units Sold",
				
				"paletteColors" => "#0075c2",
				"bgColor" => "#ffffff",
				"borderAlpha"=> "20",
				"canvasBorderAlpha"=> "0",
				"usePlotGradientColor"=> "0",
				"plotBorderAlpha"=> "10",
				"showXAxisLine"=> "1",
				"xAxisLineColor" => "#999999",
				"showValues" => "0",
				"divlineColor" => "#999999",
				"divLineIsDashed" => "1",
				"showAlternateHGridColor" => "0"
			  )
			);

			$arrData["data"] = array();

			// Push the data into the array

			while($row = mysql_fetch_array($query)) {
			array_push($arrData["data"], array(
			  "label" => $row['id_produk'],
			  "value" => $row['max(pesanan_detail.jumlah)']
			  )
			);
			}

			/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

			$jsonEncodedData = json_encode($arrData);

			/*
			 Create an object for the column chart using the FusionCharts PHP class constructor. 
			 Syntax for the constructor is 
			 `FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. 
			 Because we are using JSON data to render the chart, the data format will be `json`. 
			 The variable `$jsonEncodeData` holds all the JSON data for the chart, 
			 and will be passed as the value for the data source parameter of the constructor.
			*/

			$columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chartContainer", "json", $jsonEncodedData);

			// Render the chart

			$columnChart->render();
			}
			// Close the database connection
		}
	 ?>
	
	<!-- utk menampilkan graphic -->
	<div>
		<hr>
		<h2>Result</h2>
		<br>
	</div>
	<div id="chartContainer"> 
		<hr>
	</div>
</section>

<section class="main">
	<h1>Salary Report</h1>
	
	<br>

	<!-- form input -->
	<hr>
	<h2>Form</h2>
		<div>
			<form name="" id="" method-"GET" action="print2.php?table=info_pesan"> 
				<p>
                	Start Date: <input type='text' name='startdate' id='datepicker' />
                </p>
				<p>
                	End Date: <input type='text' name='enddate' id='datepicker2' />
                </p>

                <p> Nama Karyawan :
                	<select name='id_employees'>
		        		<?php  
			        			$employee = mysql_query("SELECT * FROM employee");
							        while ($opsi=mysql_fetch_array($employee)) {
							            echo "<option value='$opsi[id_employee]'>$opsi[employee_name]</option>";
							    }
		        		?>
               		</select>  
                </p>
                <!-- tombol type submit untuk mengeksekusi action utk method GET -->
				<button type='submit'>Print</button>
			</form>
		</div>
	<br>

<?php include('inc/footerbackend.php');?>