<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Nama Posko</th>
                    <th>Kapasitas</th>
                    <th>Jumlah Pengungsi</th>
                    <th>Penanggung Jawab</th>
                    <th>Longtitude</th>
                    <th>Latitude</th>
                    <th>Foto</th>
                </tr>
             </thead>
             <tbody>
             <?php $no=1; foreach ($mitigasi as $key=> $value ){?>
             <tr class="odd gradeX">
                 <td><?=$no++ ?></td>
                <td><?=$value->waktu?></td>
                <td><?=$value->nama_daerah?></td>
                <td><?=$value->ancaman_mitigasi?></td>
                <td><?=$value->kapasitas_mitigasi?></td>
                <td><?=$value->kerentanan_mitigasi?></td>
                <td><?=$value->resiko_mitigasi?></td>
                <td>
				<a href="<?=site_url('home/edit');?>" class="btn btn-xs btn-warning">Edit</a>
				<a href="<?=site_url('home/delete/'.$value->id_mitigasi);?>" class="btn btn-xs btn-danger">Hapus</a>
				<a href="<?=site_url('home/add');?>" class="btn btn-xs btn-success">Add Data</a>
            </tr>
        <?php } ?> 
            </tbody>
            </table>
                <a href="<?=site_url('home/add');?>" class="btn btn-xs btn-success">Add Data</a>
         
               
         
         