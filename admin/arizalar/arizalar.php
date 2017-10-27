<?php
$car_troubles=$conn->query("SELECT c.*,d.name as dname,d.surname as dsurname,t.trouble as ctrouble from car_troubles c INNER JOIN drivers d ON c.driver_id=d.id INNER JOIN troubles t ON c.trouble_id=t.id",PDO::FETCH_ASSOC);



?>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> Arızalar
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Araç Kodu</th>
                                                <th>İhbar Saati</th>
                                                <th>Araç Şoförü</th>
                                                <th>Arıza Nedeni</th>
                                                <th>Başlık</th>
                                                <th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        if($car_troubles->rowCount()>0){
                                        foreach($car_troubles as $car_trouble){ 
                                            $dt=new DateTime($car_trouble['trouble_date']);
                                            $created_at = $dt->format('d-m-Y H:i:s');
                                            ?>
                                           <tr>
                                                <td><a href="index.php?islem=ariza-duzenle&id=<?=$car_trouble['id']?>"><?=$car_trouble['id']?></a></td>
                                                <td><?=$created_at?></td>
                                                <td><?=$car_trouble['dname']?> <?=$car_trouble['dsurname']?></td> 
                                                <td><?=$car_trouble['ctrouble']?></td>
                                                <td><?=$car_trouble['title']?></td>  
                                                <td class="text-center"><a  href="index.php?islem=ariza-duzenle&id=<?=$car_trouble['id']?>" title="incele"><i class="icon-magnifier"></i></a> | <a id="delete" href="index.php?islem=ariza-sil&id=<?=$car_trouble['id']?>" title="Sil"><i class="icon-close"></i></a></td>
                                           </tr>
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

 

            <script src="arizalar/handle.js"></script>