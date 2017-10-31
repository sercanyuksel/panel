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
                                                <th>Araç Şoförü</th>
                                                <th>Arıza Tarihi</th>
                                                <th>Arıza Tipi</th>
                                                <th>Konu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($car_troubles as $car_trouble){
                                            $oDate = new DateTime($car_trouble['trouble_date']);
                                            $trouble_date = $oDate->format("d-m-Y");
                                            $sth=$conn->prepare("SELECT * from cars WHERE id=?");
                                            $sth->execute(array($car_trouble['car_id']));
                                            $car=$sth->fetch(PDO::FETCH_ASSOC);
                                            $sth=$conn->prepare("SELECT * from drivers WHERE id=?");
                                            $sth->execute(array($car_trouble['driver_id']));
                                            $driver=$sth->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <tr>
                                        <td><?=$car['code']?></td>
                                        <td><?=$driver['name']?> <?=$driver['surname']?></td>    
                                        <td><?=$trouble_date?></td>
                                        <td><?=$car_trouble['title']?></td>
                                        <td><?=$car_trouble['description']?></td>
                                        </tr>
                                        <?php }?>
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