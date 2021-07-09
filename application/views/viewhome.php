<div id="map" style="height:500px" class="map"></div>

	
	<script>
		var map = L.map('map', {
			center: [-7.0390939,110.1877784], 
			zoom: 10,
			zoomControl: false
		});
		
		
		var bidang= L.layerGroup();
		var longsorsedang= L.layerGroup();
		var longsorrendah= L.layerGroup();
		var longsortinggifix= L.layerGroup();
		var longsorsangattinggi= L.layerGroup();
	
	
		$.getJSON("<?= base_url() ?>geojson/longsorsedang.geojson",function(data){
 	L.geoJson( data , {
 		style: function(feature){
 			var fillColor,
 				Data = feature.properties.data;
 			
			return { color: "#e5eb34", weight: 1, fillColor: fillColor, fillOpacity: .5 };
	},
	onEachFeature: function( feature, layer ){
	  layer.bindPopup( "<strong>" + feature.properties.NAMOBJ + "</strong>")
	}
	} ).addTo(longsorsedang);
	})		
    
	$.getJSON("<?= base_url() ?>geojson/longsorrendah.geojson",function(data){
 	L.geoJson( data , {
 		style: function(feature){
 			var fillColor,
 				Data = feature.properties.data;
 			
			return { color: "#1cfc03", weight: 1, fillColor: fillColor, fillOpacity: .5 };
	},
	onEachFeature: function( feature, layer ){
	  layer.bindPopup( "<strong>" + feature.properties.NAMOBJ + "</strong>")
	}
	} ).addTo(longsorrendah);
	})

	
	$.getJSON("<?= base_url() ?>geojson/longsorsangattinggi.geojson",function(data){
 	L.geoJson( data , {
 		style: function(feature){
 			var fillColor,
 				Data = feature.properties.data;
 			
			return { color: "#fc8403", weight: 1, fillColor: fillColor, fillOpacity: .5 };
	},
	onEachFeature: function( feature, layer ){
	  layer.bindPopup( "<strong>" + feature.properties.NAMOBJ + "</strong>")
	}
	} ).addTo(longsorsangattinggi);
	})

	$.getJSON("<?= base_url() ?>geojson/longsortinggifix.geojson",function(data){
 	L.geoJson( data , {
 		style: function(feature){
 			var fillColor,
 				Data = feature.properties.data;
 			
			return { color: "#ff0000", weight: 1, fillColor: fillColor, fillOpacity: .5 };
	},
	onEachFeature: function( feature, layer ){
	  layer.bindPopup( "<strong>" + feature.properties.NAMOBJ + "</strong>")
	}
	} ).addTo(longsortinggifix);
	})

		var control = L.control.zoomBox({modal: true});
        map.addControl(control);

		var redMarker = L.AwesomeMarkers.icon({
    	icon: 'coffee',
    	markerColor: 'red'
 		});
		 
  	L.marker([51.941196,4.512291], {icon: redMarker}).addTo(map);

		var options = {
          position: 'topleft',
          lengthUnit: {
            factor: 0.539956803,    //  from km to nm
            display: 'Nautical Miles',
            decimal: 2
          }
        };
	L.control.ruler(options).addTo(map);	

        var c = new L.Control.Coordinates();
		c.addTo(map);

		function onMapClick(e) {
			c.setCoordinates(e);
		}

		map.on('click', onMapClick);
        
		var defaultLayer = L.tileLayer.provider('OpenStreetMap.Mapnik').addTo(map);

		var baseLayers = {
			'OpenStreetMap Default': defaultLayer,
            'Esri WorldImagery': L.tileLayer.provider('Esri.WorldImagery'),
            'Esri WorldTerrain': L.tileLayer.provider('Esri.WorldTerrain'),
            'Esri WorldShadedRelief': L.tileLayer.provider('Esri.WorldShadedRelief'),
            'Esri OceanBasemap': L.tileLayer.provider('Esri.OceanBasemap'),
			
		};

			

	var options = {
    	modal: false,
    	position: "topleft",
   		title: "Zoom to specific area"
		};


		var zoom_bar = new L.Control.ZoomBar({position: 'topleft'}).addTo(map);

		L.control.scale ({maxWidth:240, metric:true, imperial:false, position: 'bottomleft'}).addTo (map);
            let polylineMeasure = L.control.polylineMeasure ({position:'topleft', unit:'metres', showBearings:true, clearMeasurementsOnStop: false, showClearControl: true, showUnitControl: true})
            polylineMeasure.addTo (map);

            function debugevent(e) { console.debug(e.type, e, polylineMeasure._currentLine) }

            map.on('polylinemeasure:toggle', debugevent);
            map.on('polylinemeasure:start', debugevent);
            map.on('polylinemeasure:resume', debugevent);
            map.on('polylinemeasure:finish', debugevent);
            map.on('polylinemeasure:clear', debugevent);
            map.on('polylinemeasure:add', debugevent);
            map.on('polylinemeasure:insert', debugevent);
            map.on('polylinemeasure:move', debugevent);
            map.on('polylinemeasure:remove', debugevent);

	var c = new L.Control.Coordinates();
		c.addTo(map);

		function onMapClick(e) {
			c.setCoordinates(e);
		}

		map.on('click', onMapClick);

		var overlayLayers = {
			'Potensi Longsor Rendah' : longsorrendah,
			'Potensi Longsor Sedang' : longsorsedang,
			'Potensi Longsor Tinggi' : longsortinggifix,
			'Potensi Longsor Sangat Tinggi' : longsorsangattinggi,
			'Titik Kejadian Longsor' : bidang 
		};

		var layerControl = L.control.layers(baseLayers, overlayLayers, {collapsed: false}).addTo(map);
		<?php foreach ($mitigasi as $key => $value) { ?>
        mitigasi = L.geoJSON(<?= $value->geojson; ?>, {
            style: {
                color: 'white',
                dashArray: '1',
                lineCap: 'butt',
                lineJoin: 'miter',
                fillColor: '<?= $value->warna ?>',
                fillOpacity: 0.50,
            },
        }).addTo(bidang).bindPopup(
                "Waktu : <?= $value->waktu ?></br>" +
                "Desa : <?= $value->nama_daerah?></br>" +
                "Kecamatan: <?= $value->ancaman_mitigasi?></br>" +
                "Kota : <?= $value->kapasitas_mitigasi?></br>" +
                "Longtitude: <?= $value->kerentanan_mitigasi ?><br>"+ 
                "Latitude : <?= $value->resiko_mitigasi ?></br>" );     
	    <?php } ?>
	</script>
	<body>
 
 <figure class="card">
   <figcaption>
	 <h2>INFORMASI PETA</span></h2>
	 <p>Kabupaten Kendal, Jawa Tengah memiliki riwayat longsor 206 kejadian pada 2010-2020, menyebabkan 41 bangunan rusak dan 28 warga mengungsi. Ini menunjukkan bahwa longsor adalah permasalahan yang tidak dapat dianggap remeh. Peta resmi kerentanan longsor oleh  PVMBG dan Badan BPBD  Kabupaten Kendal yang berskala regional perlu diperbarui untuk kelengkapan data dan informasi.  Penelitian ini bertujuan untuk membuat zona potensi longsor untuk rekomendasi perencanaan dan pembangunan selanjutnya. Data yang digunakan meliputi citra Landsat 8 untuk identifikasi penggunaan lahan, curah hujan dari citra Himawari-8 2019, interpretasi litologi dan kelurusan yang divalidasi dengan data Pusat Survei Geologi 2013 dan validasi lapangan, serta kemiringan lereng dari DEM. Kalkulasi didasarkan pada kombinasi klasifikasi DVMBG 2004, BBPPSDLP 2009, dan PVMBG 2015 yang menunjukkan hasil bahwa potensi longsor rendah (44,05% atau 44.220 Ha) meliputi Kendal bagian utara dan sekitarnya. Potensi longsor sedang (50,47% atau 50.661 Ha) meliputi Kaliwungu Selatan, Boja, Gemuh dan sekitarnya. Potensi longsor tinggi (5,48% atau 5.500 Ha) meliputi Singorojo bagian utara dan barat, Sukorejo bagian selatan, Limbangan dan sekitarnya. Potensi longsor sangat tinggi (0,001% atau 1,3 Ha) meliputi daerah Sumber Rahayu dan Sriwulan Limbangan.</p>  
</figure>

</body>