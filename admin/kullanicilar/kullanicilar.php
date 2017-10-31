<?php
$users=$conn->query("SELECT * from users",PDO::FETCH_ASSOC);

?>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> Kullanıcılar
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Ad</th>
                                                <th>Soyad</th>
                                                <th>Kullanıcı Adı</th>
                                                <th>Şifre</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        if($users->rowCount()>0){
                                        foreach($users as $user){ 
                                            ?>
                                           <tr>
                                                <td><a href="index.php?islem=kullanici-duzenle&id=<?=$user['id']?>"><?=$user['name']?></a></td>
                                                <td><?=$user['surname']?></td>
                                                <td><?=$user['username']?></td>
                                                <td><?=$user['password']?></td>
  
                                                <td class="text-center"><a  href="index.php?islem=kullanici-duzenle" title="incele"><i class="icon-magnifier"></i></a> | <a id="delete" href="index.php?islem=kullanici-sil&id=<?=$user['id']?>" title="Sil"><i class="icon-close"></i></a></td>
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

 

            <script src="kullanicilar/handle.js"></script>