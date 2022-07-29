<div id="map" style="height:450px" class="map"></div>

	
	<script>
		var map = L.map('map', {
			center: [-7.6138,110.4302], 
			zoom: 11,
			zoomControl: false
		});
		
		
		var bidang= L.layerGroup();
		var krb_I= L.layerGroup();
		var krb_II= L.layerGroup();
		var krb_III= L.layerGroup();
		var desa_terdampak = L.layerGroup();
		var posko = L.layerGroup();
		var sungai = L.layerGroup();
		var radius = L.layerGroup();
		var posko_wonokerto = L.layerGroup();
		
		
	
	
		$.getJSON("<?= base_url() ?>geojson/krb_I.geojson",function(data){
 	L.geoJson( data , {
 		style: function(feature){
 			var fillColor,
 				Data = feature.properties.descriptio;
 			
			return { color: "#f3ff01", weight: 1, fillColor: fillColor, fillOpacity: .7 };
	},
	onEachFeature: function( feature, layer ){
	  layer.bindPopup( "<strong>" + feature.properties.descriptio + "</strong>")
	}
	} ).addTo(krb_I);
	})		
    
	$.getJSON("<?= base_url() ?>geojson/krb_II.geojson",function(data){
 	L.geoJson( data , {
 		style: function(feature){
 			var fillColor,
 				Data = feature.properties.descriptio;
 			
			return { color: "#fb9a99", weight: 1, fillColor: fillColor, fillOpacity: .7 };
	},
	onEachFeature: function( feature, layer ){
	  layer.bindPopup( "<strong>" + feature.properties.descriptio + "</strong>")
	}
	} ).addTo(krb_II);
	})

	
	$.getJSON("<?= base_url() ?>geojson/krb_III.geojson",function(data){
 	L.geoJson( data , {
 		style: function(feature){
 			var fillColor,
 				Data = feature.properties.descriptio;
 			
			return { color: "#f30612", weight: 1, fillColor: fillColor, fillOpacity: .7 };
	},
	onEachFeature: function( feature, layer ){
	  layer.bindPopup( "<strong>" + feature.properties.descriptio + "</strong>")
	}
	} ).addTo(krb_III);
	})
	$.getJSON("<?= base_url() ?>geojson/posko.geojson",function(data){
 	L.geoJson( data , {
 		style: function(feature,latlng){
 			//var fillColor,
 				Data = feature.properties.Nama;
 			
			return { color: "#f30612", weight: 1, fillColor: fillColor, fillOpacity: .5 };
	},
	onEachFeature: function( feature, layer ){
	//   layer.bindPopup( "<strong>" + feature.properties.Image + "</strong>")
	layer.bindPopup(`<div class="text-center">
						<img src="http://localhost/krb/assets/img/${feature.properties.Image}" alt="yurico kintil" width="150" height="100">
						<br>
						<strong>${feature.properties.Nama}</strong>
					</div>`)
	}
	} ).addTo(posko);
	})
	


	$.getJSON("<?= base_url() ?>geojson/desa_terdampak.geojson",function(data){
 	L.geoJson( data , {
 		style: function(feature){
 			var fillColor,
 				Data = feature.properties.data;
 			
			return { color: "#ff0000", weight: 1, fillColor: fillColor, fillOpacity: .5 };
	},
	onEachFeature: function( feature, layer ){
	  layer.bindPopup( "<strong>"+ feature.properties.DESA + "</strong>")
	}
	} ).addTo(desa_terdampak);
	})

	$.getJSON("<?= base_url() ?>geojson/sungai.geojson",function(data){
 	L.geoJson( data , {
 		style: function(feature){
 			var fillColor,
 				Data = feature.properties.data;
 			
			return { color: "#29a1f0", weight: 1, fillColor: fillColor, fillOpacity: .5 };
	},
	onEachFeature: function( feature, layer ){
	  layer.bindPopup( "<strong>"+ feature.properties.Shape_Leng + "</strong>")
	}
	} ).addTo(sungai);
	})

	$.getJSON("<?= base_url() ?>geojson/radius.geojson",function(data){
 	L.geoJson( data , {
 		style: function(feature){
 			var fillColor,
 				Data = feature.properties.data;
 			
			return { color: "#29a1f0", weight: 1, fillColor: fillColor, fillOpacity: .5 };
	},
	onEachFeature: function( feature, layer ){
	  layer.bindPopup( "<strong>"+ feature.properties.Shape_Leng + "</strong>")
	}
	} ).addTo(radius);
	})
		var control = L.control.zoomBox({modal: true});
        map.addControl(control);

		
	     
	  var gunung = new L.Icon({
		iconUrl: 'http://localhost/webgis_krb/template/assets/img/15.PNG',
		
	  	iconSize:     [25, 25],
	  	
		});
    L.marker([-7.5396, 110.4469], {icon: gunung}).bindPopup('GUNUNG MERAPI').addTo(map);
	
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
        
		var defaultLayer = L.tileLayer.provider('Esri.WorldImagery').addTo(map);

		var baseLayers = { 
			
            'Esri WorldImagery': defaultLayer,
			'OpenStreetMap ': L.tileLayer.provider('OpenStreetMap.DE'),
			
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
			//'Radius' : radius,
			'Kawasan Rawan Bencana I' : krb_I,
			'Kawasan Rawan Bencana II' : krb_II,
			'Kawasan Rawan Bencana III' : krb_III,
			'Sungai Utama' : sungai,
			'Desa Terdampak' : desa_terdampak,
			//'Titik Kejadian Longsor' : bidang, 
			'Barak Pengungsian ' : posko
			
			
		};

		var layerControl = L.control.layers( baseLayers, overlayLayers, {collapsed: false}).addTo(map);
		<?php foreach ($mitigasi as $key => $value) { ?>
        mitigasi = L.geoJSON(<?= $value->geojson; ?>, {
            style: {
                color: 'red',
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
	 <p>JANGAN LUPA DIISI</p>  
</figure>

</body>