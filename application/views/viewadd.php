<div class="content">
	<!-- general form elements -->
	<div class="card card-primary">
		<div class="card-header">
			<h4 class="card-title">Add Data Kejadian Longsor</h4>
		</div>
		<!-- /.card-header -->
		<!-- form start -->
		<div class="card-body">
			<div class="row">
				<div class="col-sm-7">
					<!-- peta -->
					<div id="map" style="width: 100%; height: 600px;"></div>
					<!-- end peta -->
				</div>

				<div class="col-sm-5">
				<?php
					//notifikasi pesan validasi
					echo validation_errors('<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fas fa-ban"></i> ', '</div>');

					//notifikasi gagal upload
					if (isset($error_upload)) {
						echo '<div class="alert alert-warning alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fas fa-exclamation-triangle"></i> ' . $error_upload . '</div>';
					}

					//notifikasi sukses simpan data
					if ($this->session->flashdata('sukses')) {
						echo '<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fas fa-check"></i> ';
						echo $this->session->flashdata('sukses');
						echo '</div>';
					}
					echo form_open_multipart('home/add'); ?>
				
					<div class="row">
                    <div class="col-sm-7">
							<div class="form-group">
								<label>Waktu</label>
								<input type="datetime-local" name="waktu" class="form-control" placeholder="Waktu">
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label>Desa</label>
								<input type="text" name="nama_daerah" class="form-control" placeholder="Desa">
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label>Kecamatan</label>
								<input type="text" name="ancaman_mitigasi" class="form-control" placeholder="Kecamatan">
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label>Kota</label>
								<input type="text" name="kapasitas_mitigasi" class="form-control" placeholder="Kota">
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label>Longtitude</label>
								<input type="text" name="kerentanan_mitigasi" class="form-control" placeholder="Longtitude">
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label>Latitude</label>
								<input type="text" name="resiko_mitigasi" class="form-control" placeholder="latitude">
							</div>
						</div>

						<div class="col-sm-6">	
							<div class="form-group">
								<label>Geojson</label>
								<textarea name="geojson" rows="4" class="Geojson"></textarea>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label>Warna</label>
									<input type="text" name="warna" class="Warna">
								</div>
							</div>
						</div>
					</div>
				

					<div class="form-group">
						<button type="submit" class="btn btn-primary">Simpan</button>
						<button type="reset" class="btn btn-warning">Reset</button>
					</div>

					<?php echo form_close(); ?>

				</div>
			</div>
		</div>
	</div>
</div>



<script>
	var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11'
	});


	var peta2 = L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {
		attribution: 'google'
	});

	var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	});

	var map = L.map('map', {
			center: [-7.336469, 110.199144],
			zoom: 15,
			zoomControl: false
		});

	var baseLayers = {
		"Grayscale": peta1,
		"Satelite": peta2,
		"Streets": peta3
	};

	var overlays = {

	};

	L.control.layers(baseLayers).addTo(map);


	// FeatureGroup is to store editable layers
	var drawnItems = new L.FeatureGroup();
	map.addLayer(drawnItems);
	var drawControl = new L.Control.Draw({
		draw: {
			polygon: true,
			marker: false,
			circle: false,
			circlemarker: false,
			rectangle: false,
			polyline: false,
		},
		edit: {
			featureGroup: drawnItems
		}
	});
	map.addControl(drawControl);

	//membuat draw
	map.on('draw:created', function(event) {
		var layer = event.layer;
		var feature = layer.feature = layer.feature || {};
		feature.type = feature.type || "Feature";
		var props = feature.properties = feature.properties || {};
		drawnItems.addLayer(layer);
		$("[name=geojson]").html(JSON.stringify(drawnItems.toGeoJSON()));
	});

	//edit draw
	map.on('draw:edited', function(e) {
		$("[name=geojson]").html(JSON.stringify(drawnItems.toGeoJSON()));
	});

	//delete draw
	map.on('draw:deleted', function(e) {
		$("[name=geojson]").html(JSON.stringify(drawnItems.toGeoJSON()));
	});
</script>



<script>
	$(function() {


		//color picker with addon
		$('.my-colorpicker2').colorpicker()

		$('.my-colorpicker2').on('colorpickerChange', function(event) {
			$('.my-colorpicker2 .fa-square').css('color', event.color.toString());
		});

	})
</script>