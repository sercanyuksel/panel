<?php
 ob_start();
 header("content-type: text/html; charset=utf-8");
 require('include/ayar.php');
 session_start();
if(!$_SESSION['user']||$_SESSION['authority']!=3)
{
    header('Location:../');
}
?>
   <?php include('include/header.php'); ?>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
   <?php include('include/navbar.php'); ?>

    <div class="app-body">
      <?php $page=@$_GET['islem']; 
        switch(substr($page,0,3))
        {
           case "sof";
           $active="Şoförler";
           break;

           default;
           $active="Anasayfa";
           break;
        } 
      include('include/side.php'); 
      ?>

        <!-- Main content -->
        <main class="main">

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><?=$active?></li>
            </ol>

            <?php

switch($page){
    case 'araclar';
    include 'araclar/araclar.php';
    break;
    
    case 'arac-ekle';
    include 'araclar/arac-ekle.php';
    break;

    case 'arac-kamera';
    include 'araclar/arac-kamera.php';
    break;

    case 'arac-sil';
    include 'araclar/arac-sil.php';
    break;
    
    case 'arac-duzenle';
    include 'araclar/arac-duzenle.php';
    break;   
    case 'talepler';
    include 'talepler/talepler.php';
    break;
    
    case 'talep-ekle';
    include 'talepler/talep-ekle.php';
    break;

    case 'talep-sil';
    include 'talepler/talep-sil.php';
    break;
    
    case 'talep-duzenle';
    include 'talepler/talep-duzenle.php';
    break;

    case 'soforler';
    include 'soforler/soforler.php';
    break;
    
    case 'sofor-ekle';
    include 'soforler/sofor-ekle.php';
    break;

    case 'sofor-sil';
    include 'soforler/sofor-sil.php';
    break;
    
    case 'sofor-duzenle';
    include 'soforler/sofor-duzenle.php';
    break;

    default;
    include 'talepler/talepler.php';
    break;

    case 'arizalar';
    include 'arizalar/arizalar.php';
    break;
    
    case 'ariza-ekle';
    include 'arizalar/ariza-ekle.php';
    break;

    case 'ariza-sil';
    include 'arizalar/ariza-sil.php';
    break;
    
    case 'ariza-duzenle';
    include 'arizalar/ariza-duzenle.php';
    break;
    }
?>    
        </main>
    </div>

   <?php include('include/footer.php'); ?>