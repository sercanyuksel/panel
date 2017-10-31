<?php

$sth=$conn->query("SELECT * from type");
$users=$sth->fetchAll(PDO::FETCH_ASSOC);

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
<h1><i class="fa fa-warning"></i> Ad, Soyad, Kullanıcı Adı veya Şifre Boş Bırakamazsanız.</h1><br/>
Yönlendiriliyorsunuz...
</div>
</div>
</div>
    
';
header("Refresh:2; url=index.php?islem=kullanici-ekle");
}
else
{
$sth=$conn->prepare("INSERT INTO users (name,surname,username, password, type_id) VALUES (?,?,?,?,?)");
$sth=$sth->execute(array(
$ad,$soyad,$kullanici_adi,$sifre,$kullanici_tipi
));
if($sth)
{
echo '
<div class="row justify-content-center">
<div class="col-md-12">
<div class="alert alert-success" style="padding:60px;">
<h1><i class="fa fa-check-circle-o"></i> Kullanıcı Ekleme Başarılı .</h1><br/>
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
header("Refresh:2; url=index.php?islem=kullanici-ekle");
}
}
}
else{
?>
<div class="container-fluid">
<div class="row">
<div class="col-sm-12 ">
<div class="card">
<div class="card-header">
<strong>Kullanıcı Ekle</strong> 
</div>
<div class="card-body">
<form method="POST">
<div class="form-group">
<label for="company">Ad :</label>
<input type="text" name="ad" class="form-control" id="company" placeholder="Ad Giriniz.">
</div>
<div class="form-group">
<label for="company">Soyad :</label>
<input type="text" name="soyad" class="form-control" id="company" placeholder="Soyad Giriniz.">
</div>
<div class="form-group">
<label for="company">Kullanıcı Adı :</label>
<input type="mail" name="kullanici_adi" class="form-control" id="company" placeholder="Kullanıcı Adı Giriniz.">
</div>

<div class="form-group">
<label for="street">Şifre :</label>
<input type="password" name="sifre" class="form-control" id="street" placeholder="Şifre Giriniz.">
</div>

<div class="form-group">
<label for="company">Kullanıcı Tipi :</label><br>
<select name="kullanici_tipi" class="form-control col-sm-12 col-md-6">
<option disabled selected="selected"> Kullanıcı tipi seçiniz... </option>
<?php foreach($users as $user){ ?>
<option value="<?=$user['id']?>"><?=$user['title']?></option>
<?php } ?>
</select>
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