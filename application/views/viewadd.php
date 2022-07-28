<div class="content">
	<!-- general form elements -->
	<div class="card card-primary">
		<div class="card-header">
			<h4 class="card-title">Add Data KRB</h4>
			<form style="width: 30%" action="<?php echo site_url('home/add_krb') ?>" method="post" enctype="multipart/form-data" >
				<div class="form-group">
					<label for="nama">Nama</label>
					<input type="text" class="form-control" id="nama" placeholder="Nama" name="nama">
				</div>
				<div class="form-group">
					<label for="exampleInputFile">File input</label>
					<input type="file" id="exampleInputFile" name="file">
				</div>
				<button type="submit" class="btn btn-success">Submit</button>
				<!-- <input class="btn btn-success" type="submit" name="btn" value="Save" /> -->
			</form>
		</div>
	</div>
</div>