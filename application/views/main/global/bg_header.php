<html>
<head>
	<title><?php echo $title;?></title>
	<link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/AdminLTE.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/user.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/default.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/component.css" />
	<script src="<?php echo base_url(); ?>assets/js/modernizr.custom.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/choosen/docsupport/prism.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/choosen/chosen.css">

	<script type="text/javascript">
			window.setTimeout("renderDate()",1);
			days = new Array(
				"Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu"
			);
			months = new Array(
				"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"
			);

			function renderDate(){
				var mydate = new Date();
				var year = mydate.getYear();
				if (year < 2000) {
				if (document.all)
				year = "19" + year;
				else
				year += 1900;
			}
				var day = mydate.getDay();
				var month = mydate.getMonth();
				var daym = mydate.getDate();
				if (daym < 10)
					daym = "0" + daym;
					var hours = mydate.getHours();
					var minutes = mydate.getMinutes();
					var seconds = mydate.getSeconds();
					var dn = "AM";
				if (hours >= 12) {
					dn = "PM";
					hours = hours - 12;
				}
				if (hours == 0)
					hours = 12;
				if (minutes <= 9)
					minutes = "0" + minutes;
				if (seconds <= 9)
					seconds = "0" + seconds;
					document.getElementById("jam").innerHTML = "<B>"+days[day]+" "+daym+" "+months[month]+" "+year+"</B> | "+hours+":"+minutes+":"+seconds+" "+dn;
					setTimeout("renderDate()",1000)
			}
	</script>
</head>
<body>
	