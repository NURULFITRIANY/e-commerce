<section class="sidebar text-center">
    <div class="avatar">
		<a href="index.php">
            <img src="img/user.png" alt="Profil">
        </a>
	</div>

	<h1>Hai, <?php echo $_SESSION['nama']; ?> </h1>
	<ul class="menu">
		<li><a href="logout.php">Logout</a></li>
	</ul>

	<hr>

	<p>
		<?php 
		// Day of the month, 2 digits with leading zeros (01 to 31) --> d
		// A full textual representation of a month, such as January through December
		// A full numeric representation of a year, 4 digits (2016)
		echo date('1, d F Y') 
		?>
	</p>

	<hr>

	<ul class="menu">
        <li><a href="order.php">Order</a></li>
		<li><a href="productbackend.php">Sales</a></li>    
		<li><a href="salary_payment.php">Salary</a></li>
		<li><a href="marketing.php">Promotion</a></li>
        <li><a href="management_efficiency.php">Efficiency</a></li>
        <li><a href="member.php">Member</a></li>
        <li><a href="paketkredit.php">Credit Package</a></li>
        <li><a href="manualtransaction.php">Transaction</a></li>
        <li><a href="graphicdss.php">Report</a></li>
        <li><a href="blog.php">Blog</a></li>
        <li><a href="user.php">User</a></li>
	</ul>
</section>