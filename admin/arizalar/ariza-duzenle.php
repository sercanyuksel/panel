<?php
$id=$_GET['id'];
$sth=$conn->prepare("SELECT c.*,d.name as dname,d.surname as dsurname,t.trouble as ctrouble,ca.code as code from car_troubles c INNER JOIN drivers d ON c.driver_id=d.id INNER JOIN troubles t ON c.trouble_id=t.id INNER JOIN cars ca ON c.car_id=ca.id WHERE c.id=?");
$sth->execute(array(
    $id
));
$car_trouble=$sth->fetch(PDO::FETCH_ASSOC);

$sth=$conn->prepare("SELECT * from cars");
$sth->execute();
$cars=$sth->fetchAll(PDO::FETCH_ASSOC);

$sth=$conn->prepare("SELECT * from drivers");
$sth->execute();
$drivers=$sth->fetchAll(PDO::FETCH_ASSOC);

$sth=$conn->prepare("SELECT * from troubles");
$sth->execute();
$troubles=$sth->fetchAll(PDO::FETCH_ASSOC);

if($_POST)
{
    $arac_kodu=$_POST['arac_kodu'];
    $ihbar_saati=$_POST['ihbar_saati'];
    $arac_soforu=$_POST['arac_soforu'];
    $ariza_nedeni=$_POST['ariza_nedeni'];
    $sonuc=$_POST['baslik'];

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
                        <select disabled name="arac_kodu" class="form-control" id="company">
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
                    <select disabled name="arac_soforu" class="form-control" id="company">
                    <?php foreach($drivers as $driver) {
                    ?>
                    <option <?php if($car_trouble['car_id']==$driver['id']) echo 'selected="selected"'; ?> value="<?=$driver['id']?>">
                    <?=$driver['name']?> <?=$driver['surname']?>
                    </option>
                    <?php }
                    ?>
                    </select>
                    </div>

                    <div class="form-group">
                        <label for="company">İhbar Saati :</label>
                        <input disabled type="text" name="ariza_tarihi" class="form-control col-sm-12 col-md-6" id="company"  value="<?=$car_trouble['trouble_date']?>">
                    </div>
                    
                    <div class="form-group">
                    <label for="company">Arıza Nedeni :</label>
                    <select disabled name="ariza" class="form-control" id="company">
                    <?php foreach($troubles as $trouble) {
                    ?>
                    <option <?php if($car_trouble['trouble_id']==$trouble['id']) echo 'selected="selected"'; ?> value="<?=$trouble['id']?>">
                    <?=$trouble['trouble']?>
                    </option>
                    <?php }
                    ?>
                    </select>
                    </div>

                    <div class="form-group">
                        <label for="company">Arıza Başlığı :</label>
                        <input disabled type="text" name="baslik" class="form-control col-sm-12 col-md-6" id="company"  value="<?=$car_trouble['title']?>">
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