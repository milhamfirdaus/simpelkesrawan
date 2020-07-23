<?php $this->load->view('_part/user/_head')?>
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.0.0/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.0.0/mapbox-gl.css' rel='stylesheet' />
<style>
    .marker {
        display: block;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        padding: 0;
        background-position: center;
        background-size:cover;
        width: 40px;
        height: 40px;
    }
    .img-responsive {
        background-size: cover;
        background-position: center;
        width: 100%;
        height: 150px;
    }
    #filter-form{
        position: absolute;
        z-index: 1;
        top: 50px;
        left: 20px;
        background-color: #e6e4e0d6;
        padding: 12px;
        color:#ed145b;
    }
    #filter-form Input{
        font-size: 12px;
        height: 27px;
        margin: 4px;
    }
    #filter-form p{
        height: 27px;
        margin: 4px;
    }
    #filter-form Select{
        margin: 4px;
        font-size: 12px;
        height: 27px;
    }
    .slidecontainer {
      width: 100%;
    }
    
    .slider {
      -webkit-appearance: none;
      width: 100%;
      height: 25px;
      background: #d3d3d3;
      outline: none;
      opacity: 0.7;
      -webkit-transition: .2s;
      transition: opacity .2s;
    }
    
    .slider:hover {
      opacity: 1;
    }
    
    .slider::-webkit-slider-thumb {
      -webkit-appearance: none;
      appearance: none;
      width: 25px;
      height: 25px;
      background:   #00BFFF;
      cursor: pointer;
    }
    
    .slider::-moz-range-thumb {
      width: 25px;
      height: 25px;
      background:   #00BFFF;
      cursor: pointer;
    }
    .mapboxgl-popup-content{
        background: #FFFFFF;
        color:#20B2AA;
        width: 200px;
        height: 160px;
        overflow-y: auto;
    }
    .mapboxgl-popup-content h4{
        color:#20B2AA;
        text-transform: uppercase;
        text-align: center;
    }
    
</style>
</head>
<body>

    <!--[if lte IE 8]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="<?= site_url('assets/user/')?>http://browsehappy.com/">upgrade your browser</a>.</p>
    <![endif]-->

    <div class="layer"></div>
    <!-- Menu mask -->

    <!-- Header ================================================== -->
    <header id="plain">
        <div class="container-fluid">
            <div class="row">
              <?php $this->load->view('_part/user/_nav.php')?>
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </header>
    <!-- End Header =============================================== -->
    <div class="container-fluid full-height">
        <div class="row row-height">
            <div class="col-lg-4 col-md-4 col-sm-12 content-left" style="overflow-x:hidden;overflow-y:auto;">
                <div id="position">
                	<div class="container">
                        <ul>
                            <li>Page</li>
                            <li>Data Hewan Penular Rabies (HPR)</li>
                        </ul>
                    </div>
                </div>
                <br>
                <div class="row">
                <script type="text/javascript">
                var data = [];
                </script>
                
                <?php 
                if($semuaDataHewan):
                foreach ($semuaDataHewan as $cat):
                ?>
                <script type="text/javascript">
            		data.push({"type":"Feature","properties": {"hewanID":<?= $cat->hewanID?>,"hewanNama": "<?= $cat->hewanNama?>","hewanLINK": "<?= site_url('hewan/').$cat->hewanID?>","hewanGambar": "<?= site_url('assets/img/').$cat->hewanGambar?>","desaID":"<?= $cat->desaID?>","namaDesa":"<?= $cat->namaDesa?>","kecamatanID":"<?= $cat->kecamatanID?>","kecamatanNama":"<?= $cat->kecamatanNama?>","hewanJK": "<?= $cat->hewanJenisKelamin?>","hewanSpesies": "<?= $cat->spesiesNama?>","hewanKeterangan":String.raw`<?= $cat->hewanKeterangan?>`,"spesiesID":"<?= $cat->spesiesID?>","uniqueID":"<?= $cat->uniqueID?>"},"geometry": {"coordinates": [<?= $cat->hewanLng?>,<?= $cat->hewanLat?>]}});    
            	</script>
                <?php 
                endforeach;
                ?>
                <?php foreach ($dataBySpesiesID as $dt):?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="img_wrapper">
                            <div class="tools_i">
                                <div class="directions_list_map" onclick="onHtmlClick([<?= $dt->hewanLng?>,<?= $dt->hewanLat?>])">
                                    <a class="tooltip_styled tooltip-effect-4"><span class="tooltip-item"></span>
								<div onclick="onHtmlClick('Hotels', 7   )" class="tooltip-content">Fokus</div>
								</a>
                                </div>
                            </div>
                            <!-- End tool_i -->
                            <div class="img_container">
                                <a href="<?= site_url('hewan/'.$dt->hewanID)?>">
                                    <img src="<?= site_url('assets/img/').$dt->hewanGambar?>" class="img-responsive" alt="">
                                    <div class="short_info">
                                        
                                        <h3><?= $dt->hewanNama?> | <strong><?= $dt->spesiesNama?></strong></h3>
                                        <em><?= $dt->kecamatanNama?> | <strong> <?= $dt->memberID == ''? 'Admin':$dt->memberUsername?></strong></em>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End img_wrapper -->
                        
                    </div>
                    <?php 
                    endforeach;
                    else:?>
                        <b>Data yang anda cari tidak ditemukan, coba gunakan kata kunci lain !</b>
                    <?php endif;?>
                </div>
                <!-- End row -->
                <nav>
      		<?php echo $this->pagination->create_links();?>
                </nav>
            </div>
            <!-- End content-left-->

            <div class="col-lg-8 col-md-8 map-right">
                <div class="map" id="map"></div>
                    <div id="filter-form" class="col-md-4" style="top: 70px">
                        <b style="color:#668cff;">Cari Hewan Berdasarkan :</b>
                        <input type="text" id="namaHewan" placeholder="Nama / Kode Unik" class="form-control">
                        <select class="form-control" id="kecamatanID" name="spesies">
                            <option value="0">- Pilih Kecamatan -</option>
                            <?php foreach ($kecamatanList as $d):?>
                            <option value="<?= $d->kecamatanID?>"><?= $d->kecamatanNama?></option>
                            <?php endforeach;?>
                        </select>
                        <select class="form-control" id="desaID" name="desaID">
                            <option value="0">- Pilih Kelurahan -</option>
                        </select>
                        <select class="form-control" id="spesiesID" name="spesies">
                            <option value="0">- Pilih Spesies -</option>
                            <?php foreach ($spesiesList as $d):?>
                            <option value="<?= $d->spesiesID?>"><?= $d->spesiesNama?></option>
                            <?php endforeach;?>
                        </select>
                        <p id="jumlahData" style="color:#668cff;"></p>
                        <input type="button" id="pin" class="form-control" value="Buat Pin" style="display: none;">
                        <div id="slider-section" style="display: none;">
                            <input class="slider" type="range" id="myRange" value="5" name="myRange" min="1" max="10">
                            <p>Radius <b><span id="demo"></span></b> Km</p>
                        </div>
                    </div>
                
            </div>
        </div>
        <!-- End row-->
    </div>
    <!-- COMMON SCRIPTS -->
	<?php $this->load->view('_part/user/_jsfoot')?>
	<script type="text/javascript" src="<?= base_url('assets/turf/turf.min.js')?>"></script>
    <script>

    $("#kecamatanID").change(function(){
        var id = $(this).val();
        $.ajax({
            url : "<?= site_url('Desa/getByKecamatan')?>",
            data : {kecamatan:id},
            dataType: 'json',
            type: 'POST',
            success : function(response){
                $('#desaID option').remove();
                $("#desaID").append('<option value="0">-Pilih Kelurahan-</option>');
                if(response.data_desa != ""){
                    $.each(response.data_desa, function(key, value){
                        $("#desaID").append('<option value=' + value.desaID + '>' + value.namaDesa + '</option>');
                    });
                }
                else{
                    $("#hewanDesa").append('<option value="0">-Pilih Kelurahan-</option>');
                }
            }
        });
    });

    var slider = document.getElementById("myRange");
    var output = document.getElementById("demo");
    output.innerHTML = slider.value;

    slider.oninput = function() {
      output.innerHTML = this.value;
    }
    var geoJson = {
	    "type" : "FeatureCollection",
	    "features" : data
    }
    mapboxgl.accessToken = 'pk.eyJ1IjoibmJiMTI4MDUiLCJhIjoiY2o3eTN4Y3R5NXQ3ZDJ3cW5yMnVwYzVmdyJ9.rA_Z0QLuHzufgnxn-Fgvqw';
    var map = new mapboxgl.Map({
    container: 'map', 
    style: 'mapbox://styles/mapbox/streets-v9',
    center: [106.92638707689855,-6.920110746180313],
    zoom: 13 
    });

    map.addControl(new mapboxgl.FullscreenControl({container: 'map'}),'bottom-right');
    map.addControl(new mapboxgl.GeolocateControl({
        positionOptions: {
        enableHighAccuracy: true
        },
        trackUserLocation: true
    }),'bottom-right');

	var marks = [];
	var pin = false;

	geoJson.features.forEach(function(marker){
		var el = document.createElement('div');
	    el.setAttribute('hewanNama', marker.properties.hewanNama);
	    el.className = 'marker';
	    el.style.backgroundImage = 'url('+marker.properties.hewanGambar+')';

	    var popup = new mapboxgl.Popup({ offset: 25 })
		.setHTML('<h4><b>'+marker.properties.hewanNama+'</b></h4><p>'+marker.properties.namaDesa+',<br> Kec. '+marker.properties.kecamatanNama+'. Kota Sukabumi</p><a href="'+marker.properties.hewanLINK+'"style="text-align: center;">Detail Hewan</a>');
		marks[marker.properties.hewanID] = [new mapboxgl.Marker(el).setPopup(popup).setLngLat(marker.geometry.coordinates).addTo(map),marker];
	});

	function buatPin()
	{
		if(pin){
			pin.remove();
			btnPin.value = 'Buat Pin';
			pin = false;
    		document.getElementById("slider-section").style.display = 'none';
		}else{
    		pin = new mapboxgl.Marker().setDraggable(true).setLngLat([106.928726,-6.923700]).addTo(map);
    		pin.on('dragend',filterMarker);
    		document.getElementById("slider-section").style.display = 'block';
			btnPin.value = 'Hapus Pin';
		}
	}
	var popup;
	function onHtmlClick(lng){
		map.flyTo({center: lng, zoom: 16,curve: 2,easing(t) {return t;}});
	}

	function filterMarker()
	{
		var i_nama = inputNamaHewan.value.trim().toLowerCase();
		var i_spesies = selectSpesies.value;
		var i_desa = selectDesa.value;
		var i_kecamatan = selectKecamatan.value;
		var i_radius = inputRadius.value || 1;
        var a = 0;
		for(var d in marks){
			if((marks[d][1].properties.hewanNama.toLowerCase().match(i_nama)||marks[d][1].properties.uniqueID.toLowerCase().match(i_nama)) && (i_spesies == marks[d][1].properties.spesiesID || i_spesies==0) && (i_kecamatan == marks[d][1].properties.kecamatanID || i_kecamatan==0) && (i_desa == marks[d][1].properties.desaID || i_desa==0)){
                a = a + 1;
				if(pin){
					if(turf.distance(turf.point([pin._lngLat.lng,pin._lngLat.lat]), turf.point([marks[d][0]._lngLat.lng,marks[d][0]._lngLat.lat]), {units:'kilometers'}) <= i_radius){
						var popup = new mapboxgl.Popup({ offset: 25 })
						.setHTML('<h4><b>'+marks[d][1].properties.hewanNama+'</b></h4><p>'+marks[d][1].properties.namaDesa+',<br> Kec. '+marks[d][1].properties.kecamatanNama+'. Kota Sukabumi</p><a href="'+marks[d][1].properties.hewanLINK+'">Detail Hewan</a>');
						marks[d] = [new mapboxgl.Marker(marks[d][0]._element).setLngLat(marks[d][1].geometry.coordinates).setPopup(popup).addTo(map),marks[d][1]];
					}else{
        				marks[d][0].remove();
					}	
				}else{
					var popup = new mapboxgl.Popup({ offset: 25 })
					.setHTML('<h4><b>'+marks[d][1].properties.hewanNama+'</b></h4><p>'+marks[d][1].properties.namaDesa+',<br> Kec. '+marks[d][1].properties.kecamatanNama+'. Kota Sukabumi</p><a href="'+marks[d][1].properties.hewanLINK+'">Detail Hewan</a>');
					marks[d] = [new mapboxgl.Marker(marks[d][0]._element).setLngLat(marks[d][1].geometry.coordinates).setPopup(popup).addTo(map),marks[d][1]];
				}
			}else{
				marks[d][0].remove();
			}
		}
        $("#jumlahData").text("Jumlah Data yang tersedia : "+a);
	}
	var inputNamaHewan = document.getElementById("namaHewan");
	var selectSpesies = document.getElementById("spesiesID");
	var selectKecamatan = document.getElementById("kecamatanID");
	var selectDesa = document.getElementById("desaID");
	var btnPin = document.getElementById("pin");
	var inputRadius = document.getElementById("myRange");
	inputNamaHewan.addEventListener('keyup',filterMarker);
	selectSpesies.addEventListener('change',filterMarker);
	selectKecamatan.addEventListener('change',filterMarker);
	selectDesa.addEventListener('change',filterMarker);
	btnPin.addEventListener('click',buatPin);
	inputRadius.addEventListener('click',filterMarker);
	
    </script>
</body>
<?php $this->load->view('_part/user/__footerpage')?>

</html>