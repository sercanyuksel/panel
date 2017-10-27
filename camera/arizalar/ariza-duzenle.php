<?php
$id=$_GET['id'];
$sth=$conn->prepare("SELECT * from car_troubles WHERE id=?");
$sth->execute(array(
    $id
));
$car_trouble=$sth->fetch(PDO::FETCH_ASSOC);

$sth=$conn->prepare("SELECT * from cars");
$sth->execute(array(
    $id
));
$cars=$sth->fetchAll(PDO::FETCH_ASSOC);

$sth=$conn->prepare("SELECT * from drivers");
$sth->execute(array(
    $id
));
$drivers=$sth->fetchAll(PDO::FETCH_ASSOC);


if($_POST)
{
    $arac_kodu=$_POST['arac_kodu'];
    $ihbar_saati=$_POST['ihbar_saati'];
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
     header("Refresh:2; url=index.php?islem=ariza-duzenle");
    }
    else
    {
        $sth=$conn->prepare("UPDATE car_troubles SET code=?,surname=?,no=?,phone=?,adress=? WHERE id=?");
        $sth=$sth->execute(array(
            $arac_kodu,$soyad,$tc,$telefon,$adres,$id
        ));
        if($sth)
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Arıza Düzenleme Başarılı .</h1><br/>
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
           header("Refresh:2; url=index.php?islem=ariza-duzenle");
        }
    }
    
}else{
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12   ">

            <div class="card">
                <div class="card-header">
                    <strong>Arıza Düzenle</strong>                
                </div>
                <div class="card-body">
                <form METHOD="POST">
                    <div class="form-group">
                        <label for="company">Araç Kodu :</label>
                        <select name="arac_kodu" class="form-control" id="company">
                        <?php foreach($cars as $car) {
                        ?>
                        <option <?php if($car_trouble['car_id']==$car['id']) echo 'selected="selected"'; ?> value="<?=$car['id']?>">
                        <?=$car['code']?>
                        </option>
                        <?php }
                        ?>
                        </select>
                    </div>

                    <div class="form-group">
                    <label for="company">Araç Şoförü :</label>
                    <select name="arac_soforu" class="form-control" id="company">
                    <?php foreach($drivers as $driver) {
                    ?>
                    <option <?php if($car_trouble['car_id']==$driver['id']) echo 'selected="selected"'; ?> value="<?=$driver['id']?>">
                    <?=$driver['name']?>
                    </option>
                    <?php }
                    ?>
                    </select>
                </div>


                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary px-4">Düzenle</button>
                        </div>
                    </div>
                    </form>
                </div>
                
               

            </div>

        </div>
    </div>
</div>
<?php } ?>