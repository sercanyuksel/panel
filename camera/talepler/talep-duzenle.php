<?php
$id=$_GET['id'];
$sth=$conn->prepare("SELECT * from requests WHERE id=?");
$sth->execute(array($id));
$request=$sth->fetch(PDO::FETCH_ASSOC);
$sth=$conn->prepare("SELECT * from users WHERE id=?");
$sth->execute(array($request['creator_id']));
$creator=$sth->fetch(PDO::FETCH_ASSOC);
if($request['handler_id']!=0){
$sth->execute(array($request['handler_id']));
$handler=$sth->fetch(PDO::FETCH_ASSOC);
}
else{
    $handler=["name"=>"Talep Henüz ","surname"=>"Üstlenilmedi."];
}
$oDate = new DateTime($request['created_at']);
$create_date = $oDate->format("d-m-Y H:i:s");
if($request['taken_at']>0){
    $oDate = new DateTime($request['taken_at']);
    $taken_date = $oDate->format("d-m-Y H:i:s");    
}
else $taken_date="*******";
if($request['solved_at']>0){
    $oDate = new DateTime($request['solved_at']);
    $solved_date = $oDate->format("d-m-Y H:i:s");    
}
else $solved_date="*******";
$sth=$conn->prepare("SELECT * from cars WHERE id=?");
$sth->execute(array($request['car_id']));
$selected_car=$sth->fetch(PDO::FETCH_ASSOC);
if($_POST)
{
    $dt=new DateTime();
    $created_at = $dt->format('Y-m-d H:i:s');
    $desc=$_POST['desc'];
    $car_id=$_POST['car_id'];
    $creator_id=$_SESSION['user_id'];
    $camera_id=$_POST['camera'];
    if(empty($desc) || empty($car_id))
    {
        echo '
      
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="alert alert-danger" style="padding:60px;">
        <h1><i class="fa fa-warning"></i> Açıklama ve Araç Bölümlerini Boş Bırakamazsanız.</h1><br/>
        Yönlendiriliyorsunuz...
        </div>
        </div>
        </div>
        	
        ';
     header("Refresh:2; url=index.php?islem=talep-ekle");
    }
    else
    {
        $sth=$conn->prepare("INSERT INTO requests (car_id,description,created_at,creator_id,status,camera_id) VALUES (?,?,?,?,?,?)");
        $sth=$sth->execute(array(
            $car_id,$desc,$created_at,$creator_id,0,$camera_id
        ));
        if($sth)
        {
            echo '
            
              <div class="row justify-content-center">
              <div class="col-md-12">
              <div class="alert alert-success" style="padding:60px;">
              <h1><i class="fa fa-check-circle-o"></i> Talep Ekleme Başarılı .</h1><br/>
              Yönlendiriliyorsunuz...
              </div>
              </div>
              </div>
                  
              ';
           header("Refresh:2; url=index.php?islem=talepler");
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
           header("Refresh:2; url=index.php?islem=talep-ekle");
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
                    <strong>Talep Ekle</strong>                
                </div>
                <div class="card-body">
                <form method="POST">

                    <div class="form-group">
                        <label for="company">Talebin Durumu :</label>
                        <input type="text" disabled value="<?=$request['status']?>" />
                    </div>

                    <div class="form-group">
                        <label for="company">Talep Tarihi :</label>
                        <input type="text" disabled value="<?=$create_date?>" />
                    </div>

                    <div class="form-group">
                        <label for="company">Araç :</label>
                        <select disabled class="form-control" name="car_id" id="car_id"> 
                            <option value="<?=$selected_car['id']?>"><?=$selected_car['code']?></option>                      
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="company">Talebi Açan :</label>
                        <input type="text" disabled value="<?=$creator['name']?> <?=$creator['surname']?>" />
                    </div>

                    <div class="form-group">
                        <label for="company">Talebi Üstlenen :</label>
                        <input type="text" disabled value="<?=$handler['name']?> <?=$handler['surname']?>" />                        
                    </div>

                    <div class="form-group">
                        <label for="desc">Talep Açıklama :</label>
                        <textarea disabled rows="4" name="desc" class="form-control" id="desc"><?=$request['description']?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="company">Talep İşleme Alınma Tarihi :</label>
                        <input type="text" disabled value="<?=$taken_date?>" />
                    </div>

                    <div class="form-group">
                        <label for="company">Talep Sonlanma Tarihi :</label>
                        <input type="text" disabled value="<?=$solved_date?>" />
                    </div>

                    <div class="form-group">
                        <label for="desc">Talep Cevap :</label>
                        <textarea  rows="4" name="resp" class="form-control" id="desc"><?=$request['response']?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary px-4">Ekle</button>
                            <button type="submit" class="btn btn-success px-4">İşleme Al</button>
                            <button type="submit" class="btn btn-danger px-4">Cevapla</button>
                        </div>
                    </div>

                </form>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript" src="talepler/handle.js"></script>
<?php }
?>