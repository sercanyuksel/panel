<?php
$cars=$conn->query("SELECT c.*,a.name as area, b.brand as brand from cars c INNER JOIN area a ON a.id = c.area_id 
                                                                            INNER JOIN brand b ON b.id = c.brand_id",PDO::FETCH_ASSOC);
                                                                                             
?>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> Araçlar
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Araç Kodu</th>
                                                <th>Plaka</th>
                                                <th>Bölge</th>
                                                <th>Marka</th>
                                                <th>Model</th>
                                                <th>Kamera Sayısı</th>
                                                <th>Kamera Durumu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($cars as $car){?>
                                           <tr>
                                                <td><?=$car['code']?></td>
                                                <td><?=$car['license']?></td>
                                                <td><?=$car['area']?></td>
                                                <td><?=$car['brand']?></td>
                                                <td><?=$car['model']?></td>
                                                <td><?=$car['camera_count']?></td>
                                                <td><?=$car['camera_status']?></td>
                                                <td class="text-center"><a href="index.php?islem=arac-duzenle&id=<?=$area['id']?>" title="incele"><i class="icon-magnifier"></i></a>| <a id="delete" href="index.php?islem=bolge-sil&id=<?=$area['id']?>" title="Sil"><i class="icon-close"></i></a></td>
                                           </tr>
                                        <?php } ?>
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

