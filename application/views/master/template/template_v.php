<!DOCTYPE html>
<html lang="en">

<head>
	<title>Sistem Manajemen Seminar</title>

    <link rel="shortcut icon" href="<?php echo base_url('assets/images/fav.png') ?>" />

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<?php $this->load->view('template/css') ?>

</head>
<style>
	.bg{
		background-color: #fffff;
	}
	
</style>
<body class="bg">


  
</div>


	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<?php $this->load->view('master/template/navbar') ?>
	<?php $this->load->view('master/template/header') ?>


	<div class="pcoded-main-container" id="padding">
		<div class="pcoded-wrapper">
			<div class="pcoded-content">
				<div class="pcoded-inner-content">
					<div class="main-body">
						<div class="page-wrapper">


						<!-- start content here -->
							<?php echo $contents ?>
						<!-- end content -->

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('template/js') ?>
</body>

</html>