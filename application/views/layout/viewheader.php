<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 12px;"> dibuat oleh : &nbsp;

<?php if ($this->session->userdata('username') == "") { ?>
			<a href="<?= site_url('auth/login') ?>" class="btn btn-danger square-btn-adjust"> Mahardika Yurico</a>
		<?php } else { ?>
		
			<a href="<?= site_url('auth/logout') ?>" class="btn btn-danger square-btn-adjust">Logout</a>
		<?php } ?> 
</div>
   <div style="color: orange;
padding: 15px 50px 5px 50px;
float: left;
font-size: 25px;"> WEBGIS KAWASAN RAWAN BENCANA GUNUNG MERAPI  </div>    
    </nav>   