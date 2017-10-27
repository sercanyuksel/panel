<?php
$troubles=$conn->query("SELECT ct.*, t.trouble, c.code as car, d.name, d.surname  from car_troubles ct INNER JOIN troubles t ON t.id = ct.trouble_id
                                                                                                      INNER JOIN cars c ON c.id = ct.car_id
                                                                                                      INNER JOIN drivers d ON d.id = ct.driver_id",PDO::FETCH_ASSOC);
                                                                                             
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
                                                <th>Arıza Numarası</th> 
                                                <th>Arıza Başlığı</th>
                                                <th>Arıza Tipi</th>
                                                <th>Araç Kodu</th>
                                                <th>Arıza Tarihi</th>
                                                <th>Şoför</th>
                                                <th>Açıklama</th>
                                           </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($troubles as $trouble){?>
                                           <tr>
                                                <td><?=$trouble['id']?></td>
                                                <td><?=$trouble['title']?></td>
                                                <td><?=$trouble['trouble']?></td>
                                                <td><?=$trouble['car']?></td>
                                                <td><?=$trouble['trouble_date']?></td>
                                                <td><?php {echo $trouble['name'].' '.$trouble['surname'];}?></td>
                                                <td><?=$trouble['description']?></td>
                                                <td class="text-center"><a href="index.php?islem=trouble&id=<?=$area['id']?>" title="incele"><i class="icon-magnifier"></i></a>| <a id="delete" href="index.php?islem=trouble&id=<?=$area['id']?>" title="Sil"><i class="icon-close"></i></a></td>
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

