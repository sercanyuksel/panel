<?php
$sth=$conn->prepare("SELECT * from requests ORDER BY id DESC");
$sth->execute();
$requests=$sth->fetchAll();
?>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> Talepler
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Talep No</th>
                                                <th>Araç Kodu</th>
                                                <th>Talebi Açan</th>
                                                <th>Talebi Üstlenen</th>
                                                <th>Açılma Tarihi</th>
                                                <th>Durumu</th>
                                                <th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                           <?php foreach($requests as $request){
                                            $oDate = new DateTime($request['created_at']);
                                            $create_date = $oDate->format("d-m-Y H:i:s");
                                            $sth=$conn->prepare("SELECT * from users WHERE id=?");
                                            $sth->execute(array($request['creator_id']));   
                                            $creator=$sth->fetch(PDO::FETCH_ASSOC);
                                            $exist=false;
                                            if($request['handler_id']!=0)
                                            {
                                             $exist=true;
                                             $sth->execute(array($request['handler_id']));
                                             $handler=$sth->fetch(PDO::FETCH_ASSOC);                                                   
                                            }
                                            $sth=$conn->prepare("SELECT * from cars WHERE id=?");
                                            $sth->execute(array($request['car_id']));
                                            $car=$sth->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                                 <tr>
                                                <td><a href="index.php?islem=talep-duzenle">#<?=$request['id']?></a></td>
                                                <td><?=$car['code']?></td>
                                                <td><?=$creator['name']?> <?=$creator['surname']?></td>
                                                <td><?php if($exist){echo $handler['name'].' '.$handler['surname'];} else{echo 'Henüz Talep Üstlenilmedi.';}?></td>
                                                <td><?=$create_date?></td>
                                                <td><?=$request['status']?></td>
                                                <td class="text-center"><a href="index.php?islem=talep-duzenle&id=<?=$requestid?>" title="incele"><i class="icon-magnifier"></i></a></td>
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

