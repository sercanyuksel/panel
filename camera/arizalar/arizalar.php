<?php
$car_troubles=$conn->query("SELECT * from car_troubles",PDO::FETCH_ASSOC);

$sth=$conn->prepare("SELECT * from cars");
$sth->execute(array());
$cars=$sth->fetchAll(PDO::FETCH_ASSOC);

$sth=$conn->prepare("SELECT * from drivers");
$sth->execute(array());
$drivers=$sth->fetchAll(PDO::FETCH_ASSOC);

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
                                                <th>Müdahale Saati</th>
                                                <th>Müdahale Yeri</th>
                                                <th>Dönüş Saati</th>
                                                <th>Araç Şoförü</th>
                                                <th>Talimat Veren</th>
                                                <th>Arıza Nedeni</th>
                                                <th>Sonuç</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        if($car_troubles->rowCount()>0){
                                        foreach($car_troubles as $car_trouble){ 
                                            ?>
                                           <tr>
                                                <td><a href="index.php?islem=ariza-duzenle&id=<?=$car_trouble['id']?>"><?=$car_trouble['name']?></a></td>
                                                <td><?=$car_trouble['code']?></td>
                                                <td><?=$car_trouble['notice_date']?></td> 
                                                <td class="text-center"><a  href="index.php?islem=ariza-duzenle" title="incele"><i class="icon-magnifier"></i></a> | <a id="delete" href="index.php?islem=ariza-sil&id=<?=$car_trouble['id']?>" title="Sil"><i class="icon-close"></i></a></td>
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