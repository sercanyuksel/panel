<?php
$cars=$conn->query("SELECT * from cars",PDO::FETCH_ASSOC);

?>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> Şöförler
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Araç Kodu</th>
                                                <th>Araç Plakası</th>
                                                <th>Bölge</th>
                                                <th>Marka</th>
                                                <th>Model</th>
                                                <th>Kamera Adedi</th>
                                                <th>Kamera Durumu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        if($cars->rowCount()>0){
                                        foreach($cars as $car){ 
                                            ?>
                                           <tr>
                                                <td><?=$car['code']?></td>
                                                <td><?=$car['license']?></td>
                                                <td><?=$car['area_id']?></td>
                                                <td><?=$car['brand_id']?></td>
                                                <td><?=$car['model_id']?></td>
                                                <td><?=$car['camera_count']?></td>
                                                <td><?=$car['camera_status']?></td>
                                                <td class="text-center"><a  href="index.php?islem=arac-duzenle" title="incele"><i class="icon-magnifier"></i></a>
                                        <?php }}else{
                                           echo' Kayıt Bulunamadı.';
                                        } ?>
                                        </tbody>
                                    </table>
                                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="#">Prev</a>
                                            </li>
                                            <li class="page-item active">
                                                <a class="page-link" href="#">1</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">2</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">3</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">4</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                         
                            </div>
                            </div>
                    </div>
            </div>

 

            <script src="araclar/handle.js"></script>