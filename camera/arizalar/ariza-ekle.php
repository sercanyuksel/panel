<?php

$sth=$conn->prepare("SELECT * from cars");
$sth->execute(array());
$cars=$sth->fetchAll(PDO::FETCH_ASSOC);

$sth=$conn->prepare("SELECT * from drivers");
$sth->execute(array());
$drivers=$sth->fetchAll(PDO::FETCH_ASSOC);


if($_POST)
{
    $arac_kodu=$_POST['arac_kodu'];
    $ihbar_tarihi=$_POST['ihbar_tarihi'];
    $mudahale_saati=$_POST['mudahale_saati'];
    $mudahale_yeri=$_POST['mudahale_yeri'];
    $donus_saati=$_POST['donus_saati'];
    $arac_soforu=$_POST['arac_soforu'];
    $talimat_veren=$_POST['talimat_veren'];
    $ariza_nedeni=$_POST['ariza_nedeni'];
    $sonuc=$_POST['sonuc'];

    if(empty($arac_kodu))
    {
        echo '
      
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="alert alert-danger" style="padding:60px;">
        <h1><i class="fa fa-warning"></i> Arac Kodunu Boş Bırakamazsanız.</h1><br/>
        Yönlendiriliyorsunuz...
        </div>
        </div>
        </div>
        	
        ';
     header("Refresh:2; url=index.php?islem=ariza-ekle");
    }
    else
    {
        $sth=$conn->prepare("INSERT INTO car_troubles (notice_date) VALUES (?)");
        $sth=$sth->execute(array(
            $ihbar_tarihi
        ));
        if($sth)
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Arıza Ekleme Başarılı .</h1><br/>
              Yönlendiriliyorsunuz...
              </div>
              </div>
              </div>
                  
              ';
           header("Refresh:2; url=index.php?islem=arizalar");
        }
        else
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-danger" style="padding:60px;">
              <h1><i class="fa fa-warning"></i>Beklenmeyen bir hata oluştu.</h1><br/>
              Yönlendiriliyorsunuz...
              </div>
              </div>
              </div>
                  
              ';
           header("Refresh:2; url=index.php?islem=ariza-ekle");
        }
    }
    
}
else{
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12   ">

            <div class="card">
                <div class="card-header">
                    <strong>Arıza Ekle</strong>                
                </div>
                <div class="card-body">
                <form method="POST">

                <div class="form-group">
                <label for="company">Araç Kodu :</label>
                <select name="arac_kodu" class="form-control" id="company">
                <option value="seciniz">Araç Kodu Seçiniz...</option>
                <?php foreach($cars as $car) {
                ?>
                <option value="<?=$car['id']?>">
                <?=$car['code']?>
                </option>
                <?php }
                ?>
                </select>
            </div>

             <div class="form-group">
                    <label for="company">Araç Şoförü :</label>
                    <select name="arac_soforu" class="form-control" id="company">
                    <option value="seciniz">Araç Şoförü Seçiniz...</option>
                    <?php foreach($drivers as $driver) {
                    ?>
                    <option value="<?=$driver['id']?>">
                    <?=$driver['name']?>
                    </option>
                    <?php }
                    ?>
                    </select>
                </div>
                   
             <div class="form-group">
                <label for="company">İhbar Tarihi :</label>
                <input type="date" name="ihbar_tarihi" class="form-control col-sm-12 col-md-4" id="company" placeholder="İhbar tarihini Giriniz.">
            </div>
  

                    <div class="form-group">
                       
                            <div class="alert alert-danger" style="padding:20px;">
                                <h2><i class="fa fa-warning"></i> Beklenmeyen bir hata oluştu.</h2>
                            </div>
                
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary px-4">Ekle</button>
                        </div>
                    </div>

                </form>
                </div>
            </div>

        </div>
    </div>
</div>
<?php } ?>