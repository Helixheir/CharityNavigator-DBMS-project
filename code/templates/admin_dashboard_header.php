
<head>
	<title>CHARITY </title>
		<!-- Compiled and minified CSS -->
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	    <style type="text/css">
	    	.brand{
	    		background: #cbb09c !important;
	    	}
	    	.brand-text{
	    		color:#cbb09c !important;;
	    	}
	    	form{
	    		max-width: 460px;
	    		margin:20px auto;
	    		padding: 20px;
	    	}
	    	 .pizza{
      width: 100px;
      margin: 40px auto -30px;
      display: block;
      position: relative;
      top: -30px;
    }
.topnav {
  background-color: lightgrey;
  overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Add a color to the active/current link */
.topnav a.active {
  background-color: #cbb09c;
  color: white;
}
	    </style>
</head>
<div class="topnav">
  <a class="active" href="admin_dashboard.php">Admin</a>
  <a href="addadmin.php">Add Admin</a>
  <a href="addorg.php">Add Organization</a>
  <a href="trigger.php">Current Admins</a>
</div>
<body class="grey lighten-4">
	<nav class="white ">
		<div class="container">
		 <a  href="admin_dashboard.php"class="brand-logo brand-text">Charity Navigator</a>
		 <ul id="nav-mobile" class="right hide-on-small-and-down">
		 	<li><a href="addorg.php" class="btn brand ">Add Organisation</a></li>
		 	
		 </ul>	
		</div>
	</nav>