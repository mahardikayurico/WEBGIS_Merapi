<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Nama</th>
                    <th>File</th>
                    <th>Action</th>
                </tr>
             </thead>
             <tbody>
             <?php $no=1; foreach ($mitigasi as $key=> $value ){?>
             <tr class="odd gradeX">
                 <td><?=$no++ ?></td>
                <td><?=$value->nama?></td>
                <td><a href="<?= base_url("assets/file/$value->file") ?>"><?= $value->file ?></a></td>  
                <td>
				<a href="<?=site_url('home/delete_krb/'.$value->id);?>" class="btn btn-xs btn-danger">Hapus</a>
            </tr>
        <?php } ?> 
            </tbody>
            </table>
                <a href="<?=site_url('home/add');?>" class="btn btn-xs btn-success">Add Data</a>
         
               
         
         