<?php

$sth=$conn->query("SELECT * from cars");
$cars=$sth->fetchAll(PDO::FETCH_ASSOC);

$sth=$conn->query("SELECT * from drivers");
$drivers=$sth->fetchAll(PDO::FETCH_ASSOC);

$sth=$conn->query("SELECT * from troubles");
$troubles=$sth->fetchAll(PDO::FETCH_ASSOC);

if($_POST)
{
    $arac_kodu=$_POST['arac_kodu'];
    $aciklama=$_POST['aciklama'];
    $surucu_adi=$_POST['surucu_adi'];
    $konu=$_POST['konu'];
    $dt=new DateTime();
    $created_at = $dt->format('Y-m-d H:i:s');
    $ariza_tipi=$_POST['ariza_tipi'];

    if(empty($arac_kodu) || empty($konu))
    {
        echo '
      
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="alert alert-danger" style="padding:60px;">
        <h1><i class="fa fa-warning"></i> Araç Kodu veya Konu Boş Bırakamazsanız.</h1><br/>
        Yönlendiriliyorsunuz...
        </div>
        </div>
        </div>
        	
        ';
     header("Refresh:2; url=index.php?islem=ariza-ekle");
    }
    else
    {
        $sth=$conn->prepare("INSERT INTO car_troubles (car_id,description,driver_id,title,trouble_date,trouble_id) VALUES (?,?,?,?,?,?)");
        $sth=$sth->execute(array(
            $arac_kodu,$aciklama,$surucu_adi,$konu,$created_at,$ariza_tipi
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
                <label for="company">Araç Kodu :</label><br>
                <select name="arac_kodu" class="form-control col-sm-12 col-md-6">
                <option disabled selected="selected"> Araç kodu seçiniz... </option>
                <?php foreach($cars as $car){ ?>
                <option value="<?=$car['id']?>"><?=$car['code']?></option>
                <?php } ?>
                </select>
            </div> 
               

                    <div class="form-group">
                    <label for="company">Sürücü Adı :</label><br> 
                    <select name="surucu_adi" class="form-control col-sm-12 col-md-6">
                    <option disabled selected="selected"> Sürücü adı seçiniz... </option>
                    <?php foreach($drivers as $driver){ ?>
                    <option value="<?=$driver['id']?>"><?=$driver['name']?> <?=$driver['surname']?></option>
                    <?php } ?>
                    </select>
                </div> 

                    <div class="form-group">
                        <label for="company">Arıza Tarihi :</label>
                        <input type="date" name="ariza_tarihi" class="form-control col-sm-12 col-md-6" id="company" placeholder="Arıza Tarihini Giriniz.">
                    </div>

                    <div class="form-group">
                    <label for="company">Arıza Tipi :</label><br>
                    <select name="ariza_tipi" class="form-control col-sm-12 col-md-6">
                    <option disabled selected="selected"> Arıza tipi seçiniz... </option>
                    <?php foreach($troubles as $trouble){ ?>
                    <option value="<?=$trouble['id']?>"><?=$trouble['trouble']?></option>
                    <?php } ?>
                    </select>
                </div> 

                    <div class="form-group">
                        <label for="street">Konu :</label>
                        <input type="text" name="konu" class="form-control" id="street" placeholder="Konu Giriniz.">
                    </div>
 
                    <div class="form-group">
                        <label for="aciklama">Açıklama :</label>
                        <textarea rows="4" name="aciklama" class="form-control" id="aciklama" placeholder="Arıza Açıklamasını Girin."></textarea>
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