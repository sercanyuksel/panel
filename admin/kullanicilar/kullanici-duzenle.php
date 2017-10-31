<?php
$id=$_GET['id'];
$sth=$conn->prepare("SELECT * from users WHERE id=?");
$sth->execute(array(
    $id
));
$user=$sth->fetch(PDO::FETCH_ASSOC);

$sth=$conn->prepare("SELECT * from type");
$sth->execute();
$type=$sth->fetchAll(PDO::FETCH_ASSOC);

if($_POST)
{
    $ad=$_POST['ad'];
    $soyad=$_POST['soyad'];
    $kullanici_adi=$_POST['kullanici_adi'];
    $sifre=$_POST['sifre'];
    $kullanici_tipi=$_POST['kullanici_tipi'];
 

    if(empty($kullanici_adi) || empty($sifre) || empty($kullanici_adi) || empty($sifre))
    {
        echo '
      
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="alert alert-danger" style="padding:60px;">
        <h1><i class="fa fa-warning"></i> Ad, Soyad, Kullanıcı Adı veya Şifreyi Boş Bırakamazsanız.</h1><br/>
        Yönlendiriliyorsunuz...
        </div>
        </div>
        </div>
        	
        ';
     header("Refresh:2; url=index.php?islem=kullanici-duzenle&id=".$id);
    }
    else
    {
        $sth=$conn->prepare("UPDATE users SET name=?,surname=?,username=?,password=?,type_id=? WHERE id=?");
        $sth=$sth->execute(array(
            $ad,$soyad,$kullanici_adi,$sifre,$kullanici_tipi
        ));
        if($sth)
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Kullanıcı Düzenleme Başarılı .</h1><br/>
              Yönlendiriliyorsunuz...
              </div>
              </div>
              </div>
                  
              ';
           header("Refresh:2; url=index.php?islem=kullanicilar");
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
           header("Refresh:2; url=index.php?islem=kullanici-duzenle");
        }
    }
    
}else{
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12   ">

            <div class="card">
                <div class="card-header">
                    <strong>Kullanıcı Düzenle</strong>                
                </div>
                <div class="card-body">
                <form METHOD="POST">
                    <div class="form-group">
                        <label for="company">Ad :</label>
                        <input type="text" name="ad" value="<?=$user['name']?>" class="form-control" id="company">
                    </div>

                    <div class="form-group">
                        <label for="company">Soyad :</label>
                        <input type="text" name="soyad" value="<?=$user['surname']?>" class="form-control" id="company" >
                    </div>

                    <div class="form-group">
                        <label for="street">Kullanıcı Adı :</label>
                        <input type="mail" name="kullanici_adi" value="<?=$user['username']?>" class="form-control" id="street">
                    </div>

                    <div class="form-group">
                        <label for="company">Şifre :</label>
                        <input type="password" name="sifre" value="<?=$user['password']?>" class="form-control" id="company" >
                    </div>

                    <div class="form-group">
                    <label for="company">Kullanıcı Tipi :</label>
                    <select name="kullanici_tipi" class="form-control" id="company">
                    <?php foreach($type as $type) {
                    ?>
                    <option <?php if($users['type_id']==$type['id']) echo 'selected="selected"'; ?> value="<?=$type['id']?>">
                    <?=$type['title']?>
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