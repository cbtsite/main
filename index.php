<?php
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(-1);
    function validateRecaptcha($recaptcha) {
        $sendData['secret'] = '6LcdfIAhAAAAAMQ29Q4wCL7ne_lMg-_SxHDAd4R9';
        $sendData['response'] = $recaptcha;
        $sendData['remoteip'] = $_SERVER['REMOTE_ADDR'];

        $url = "https://www.google.com/recaptcha/api/siteverify";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $sendData);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $url);
        
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);

        return $response['success'];
    }

    if (isset($_POST) && count($_POST) > 0){
        if($_POST['sendit']=='1' && $_POST['g-recaptcha-response']!=null) {
            $response = validateRecaptcha($_POST['g-recaptcha-response']);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            
            $to = "travnmorris@gmail.com";
            $subject = "CBTS Pemesanan";
        
            $message = "
            <html>
            <head>
            <title>Pesan dari CBTS</title>
            </head>
            <body>
            <p>Ini adalah pesan dari web cbts.site</p>
            <p>Silahkan balas ke email berikut ".$email."</p>
            <table>
            <tr>
            <th>Nama</th>
            <td>".$_POST['name']."</td>
            </tr>
            <tr>
            <th>Email</th>
            <td>".$email."</td>
            </tr>
            <tr>
            <th>Sekolah</th>
            <td>".$_POST['school']."</td>
            </tr>
            <tr>
            <th>Pesan</th>
            <td>".$_POST['message']."</td>
            </tr>
            </table>
            </body>
            </html>
            ";
        
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <contact@cbts.site>' . "\r\n";
            $headers .= 'Cc: contact@cbts.site' . "\r\n";

            if($response==1) {
                if(mail($to,$subject,$message,$headers)){
                    echo '<script>alert("Terimakasih atas respon Anda. Silahkan menunggu balasan dari kami.");window.location.replace("'.$_SERVER['REQUEST_URI'].'");</script>';
                } else {
                    echo '<script>alert("Server error");</script>';
                }
            }
        } else {
            echo '<script>alert("Please confirm the Captcha!")</script>';
        }
    }
?> 
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Template Mo">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

    <title>CBT Online - Ujian Tanpa Ribet</title>

    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
    <meta name="apple-mobile-web-app-title" content="CBT Online - Ujian Tanpa Ribet">
    <meta name="application-name" content="CBT Online - Ujian Tanpa Ribet">
    <meta name="msapplication-TileColor" content="#603cba">
    <meta name="theme-color" content="#ffffff">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="assets/css/templatemo-art-factory.css">
    <link rel="stylesheet" type="text/css" href="assets/css/owl-carousel.css">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        .accordion{
            border: 1px solid #0000000f;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.04);
            border-radius: 10px;
            margin: 10px 0;
        }
        .tln{
            font-size: 1.2rem;
            font-weight: 400;
        }
        .contact-form {
            border: 1px solid #0000000f;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.29);
            border-radius: 10px;

        }
        .contact-form input,
        .contact-form textarea {
            border-radius: 10px;
        }
        .g-recaptcha {
            display: inline-block;
            margin-bottom: 10px;
        }
    </style>
    </head>
    
    <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->
    
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="#" class="logo"><img src="favicon-32x32.png"> CBT Online</a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#welcome" class="active">Beranda</a></li>
                            <li class="scroll-to-section"><a href="#about">Tentang</a></li>
                            <li class="scroll-to-section"><a href="#services">Fitur</a></li>
                            <li class="scroll-to-section"><a href="#pricing-plans">Paket</a></li>
                            <li class="scroll-to-section"><a href="#frequently-question">Pertanyaan</a></li>
                            <!-- <li class="submenu">
                                <a href="javascript:;">Drop Down</a>
                                <ul>
                                    <li><a href="">About Us</a></li>
                                    <li><a href="">Features</a></li>
                                    <li><a href="">FAQ's</a></li>
                                    <li><a href="">Blog</a></li>
                                </ul>
                            </li> -->
                            <li class="scroll-to-section"><a href="#contact-us">Kontak Kami</a></li>
                        </ul>
                        <!-- <a class='menu-trigger'>
                            <span>Menu</span>
                        </a> -->
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->


    <!-- ***** Welcome Area Start ***** -->
    <div class="welcome-area" id="welcome">

        <!-- ***** Header Text Start ***** -->
        <div class="header-text">
            <div class="container">
                <div class="row">
                    <div class="left-text col-lg-6 col-md-6 col-sm-12 col-xs-12" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                        <h1><strong>CBT Online</strong><br>Ujian Tanpa Ribet</h1>
                        <p>Portal ujian online berbasis website yang dapat diakses secara offline. Tidak perlu ribet. Ujian dimana saja kapan saja.</p>
                        <!-- <a href="#" onclick="window.open('https://demo.cbts.site', '_self').focus();" class="main-button-slider">Akses Demo</a> -->
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                        <img src="assets/images/slider-icon.png" class="rounded img-fluid d-block mx-auto" alt="First Vector Graphic">
                    </div>
                </div>
            </div>
        </div>
        <!-- ***** Header Text End ***** -->
    </div>
    <!-- ***** Welcome Area End ***** -->


    <!-- ***** Features Big Item Start ***** -->
    <section class="section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <img src="assets/images/left-image.png" class="rounded img-fluid d-block mx-auto" alt="App">
                </div>
                <div class="right-text col-lg-5 col-md-12 col-sm-12 mobile-top-fix">
                    <div class="left-heading">
                        <h5>Tentang Kami</h5>
                    </div>
                    <div class="left-text">
                        <p>CBT Online merupakan portal ujian online berbasis website yang dapat diakses menggunakan browser di semua perangkat.<br><br>
                            Sekolah dapat menggunakan platform ini untuk mengadakan ujian berbasis komputer (CBT) guna mempermudah kegiatan ujian di sekolah mereka.<br><br>
                            Cukup klik satu tombol hasil ujian langsung ditampilkan tanpa perlu mengkoreksi jawaban siswa satu-persatu.<br><br>
                            <a href="#services" class="main-button-slider">Pelajari lebih</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="hr"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Big Item End ***** -->

    <!-- ***** Features Small Start ***** -->
    <section class="section" id="services">
        <div class="container">
            <div class="row">
                <div class="owl-carousel owl-theme">
                    <div class="item service-item" style="height: 350px">
                        <div class="icon">
                            <i><img src="assets/images/qrlogin.png" alt=""></i>
                        </div>
                        <h5 class="service-title">QR Login</h5>
                        <p>Scan kode QR untuk percepat proses login dan pindah perangkat tanpa perlu mengetik ulang username dan password.</p>
                        <!-- <a href="#" class="main-button">Read More</a> -->
                    </div>
                    <div class="item service-item" style="height: 350px">
                        <div class="icon">
                            <i><img src="assets/images/livechat.png" alt=""></i>
                        </div>
                        <h5 class="service-title">LiveChat</h5>
                        <p>Laporkan langsung kepada pengawas ujian saat mengalami kendala ditengah ujian melalui LiveChat. </p>
                        <!-- <a href="#" class="main-button">Discover More</a> -->
                    </div>
                    <div class="item service-item" style="height: 350px">
                        <div class="icon">
                            <i><img src="assets/images/pantau.png" alt=""></i>
                        </div>
                        <h5 class="service-title">Pantau Progress Ujian</h5>
                        <p>Pemantauan progress ujian dilakukan pengawas ujian untuk memastikan siswa melaksanakan ujian sesuai jadwal.</p>
                        <!-- <a href="#" class="main-button">More Detail</a> -->
                    </div>
                    <div class="item service-item" style="height: 350px">
                        <div class="icon">
                            <i><img src="assets/images/share.png" alt=""></i>
                        </div>
                        <h5 class="service-title">Berbagi Materi</h5>
                        <p>Bagikan materi pelajaran yang akan diujikan dan siswa dapat melihat atau mendownload materi pelajaran yang dibagikan.</p>
                        <!-- <a href="#" class="main-button">Read More</a> -->
                    </div>
                    <div class="item service-item" style="height: 350px">
                        <div class="icon">
                            <i><img src="assets/images/question.png" alt=""></i>
                        </div>
                        <h5 class="service-title">Tipe Soal</h5>
                        <p>Terdapat tiga macam tipe soal yakni pilgan, isian, dan uraian. Soal ujian dapat memuat media gambar, suara, dan video.</p>
                        <!-- <a href="#" class="main-button">Read More</a> -->
                    </div>
                    <div class="item service-item" style="height: 350px">
                        <div class="icon">
                            <i><img src="assets/images/service-icon-02.png" alt=""></i>
                        </div>
                        <h5 class="service-title">Acak Soal & Pilihan</h5>
                        <p>Semua tipe soal ujian dan pilihan jawaban bisa di acak tanpa mengubah posisi kunci jawaban satu persatu.</p>
                        <!-- <a href="#" class="main-button">Discover</a> -->
                    </div>
                    <div class="item service-item" style="height: 350px">
                        <div class="icon">
                            <i><img src="assets/images/service-icon-03.png" alt=""></i>
                        </div>
                        <h5 class="service-title">Ekspor & Impor Soal</h5>
                        <p>Download nilai dan soal ujian dalam bentuk pdf dan excel untuk dokumentasi sekolah atau pengolahan lebih lanjut.</p>
                        <!-- <a href="#" class="main-button">Detail</a> -->
                    </div>
                    <div class="item service-item" style="height: 350px">
                        <div class="icon">
                            <i><img src="assets/images/schedule.png" alt=""></i>
                        </div>
                        <h5 class="service-title">Auto Reschedule Ujian</h5>
                        <p>Buat jadwal ujian otomatis untuk siswa yang tidak dapat mengikuti ujian di jadwal ujian yang sudah terlewat.</p>
                        <!-- <a href="#" class="main-button">Read More</a> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Small End ***** -->

    <!-- ***** Pricing Plans Start ***** -->
    <section class="section" id="pricing-plans">
        <div class="container">
            <!-- ***** Section Title Start ***** -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2 class="section-title">Pilihan Paket</h2>
                    </div>
                </div>
                <div class="offset-lg-3 col-lg-6">
                    <div class="section-heading">
                        <p>Berikut adalah pilihan paket tahunan termasuk hosting dan domain</p>
                    </div>
                </div>
            </div>
            <!-- ***** Section Title End ***** -->

            <div class="row">
                <!-- ***** Pricing Item Start ***** -->
                <div class="col-lg-4 col-md-6 col-sm-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                    <div class="pricing-item">
                        <div class="pricing-header">
                            <h3 class="pricing-title">Ringan</h3>
                        </div>
                        <div class="pricing-body">
                            <div class="price-wrapper">
                                <span class="currency">Rp</span>
                                <span class="price">6.000.000</span>
                                <span class="period">pertahun</span>
                            </div>
                            <ul class="list">
                                <li class="active">Penyimpanan 60 GB</li>
                                <li class="active">Siswa 300-400</li>
                                <li>Kustom Domain</li>
                                <li class="active">Fitur Lengkap</li>
                                <li class="active">LiveChat Support</li>
                            </ul>
                        </div>
                        <div class="pricing-footer">
                            <a href="#contact-us" class="main-button">Hubungi Kami</a>
                        </div>
                    </div>
                </div>
                <!-- ***** Pricing Item End ***** -->

                <!-- ***** Pricing Item Start ***** -->
                <div class="col-lg-4 col-md-6 col-sm-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">
                    <div class="pricing-item active">
                        <div class="pricing-header">
                            <h3 class="pricing-title">Menengah</h3>
                        </div>
                        <div class="pricing-body">
                            <div class="price-wrapper">
                                <span class="currency">Rp</span>
                                <span class="price">8.000.000</span>
                                <span class="period">pertahun</span>
                            </div>
                            <ul class="list">
                                <li class="active">Penyimpanan 80 GB</li>
                                <li class="active">Siswa 500-600</li>
                                <li>Kustom Domain</li>
                                <li class="active">Fitur Lengkap</li>
                                <li class="active">LiveChat Support</li>
                            </ul>
                        </div>
                        <div class="pricing-footer">
                            <a href="#contact-us" class="main-button">Hubungi Kami</a>
                        </div>
                    </div>
                </div>
                <!-- ***** Pricing Item End ***** -->

                <!-- ***** Pricing Item Start ***** -->
                <div class="col-lg-4 col-md-6 col-sm-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.6s">
                    <div class="pricing-item">
                        <div class="pricing-header">
                            <h3 class="pricing-title">Tinggi</h3>
                        </div>
                        <div class="pricing-body">
                            <div class="price-wrapper">
                                <span class="currency">Rp</span>
                                <span class="price">10.000.000</span>
                                <span class="period">pertahun</span>
                            </div>
                            <ul class="list">
                                <li class="active">Penyimpanan 120 GB</li>
                                <li class="active">Siswa 700 - 1000</li>
                                <li class="active">Kustom Domain</li>
                                <li class="active">Fitur Lengkap</li>
                                <li class="active">LiveChat Support</li>
                            </ul>
                        </div>
                        <div class="pricing-footer">
                            <a href="#contact-us" class="main-button">Hubungi Kami</a>
                        </div>
                    </div>
                </div>
                <!-- ***** Pricing Item End ***** -->

                <!-- ***** Pricing Item Start ***** -->
                <div class="col-lg-4 col-md-6 col-sm-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.6s" style="margin: auto;">
                    <div class="pricing-item">
                        <div class="pricing-header">
                            <h3 class="pricing-title">CBT Lokal VHD</h3>
                        </div>
                        <div class="pricing-body">
                            <div class="price-wrapper" style="background: #d74affb8;">
                                <span class="currency">Rp</span>
                                <span class="price">800.000</span>
                                <span class="period">Lisensi 1 tahun</span>
                            </div>
                            <ul class="list">
                                <li class="active">Penyimpanan Bebas</li>
                                <li class="active">Siswa Tanpa Batas</li>
                                <li class="active">Server Lokal</li>
                                <li class="active">Fitur Lengkap</li>
                                <li>LiveChat Support</li>
                            </ul>
                        </div>
                        <div class="pricing-footer">
                            <a href="#" onclick="window.open('https://drive.google.com/file/d/1gKEcWtHnbQkFlGS-dkRvbPBxdO4dPQUq/view?usp=sharing', '_blank').focus();" class="main-button">Download Gratis</a>
                            <a href="#contact-us" class="main-button">Hubungi Kami</a>
                        </div>
                    </div>
                </div>
                <!-- ***** Pricing Item End ***** -->
            </div>
        </div>
    </section>
    <!-- ***** Pricing Plans End ***** -->


    <!-- ***** Features Big Item Start ***** -->
    <!-- <section class="section" id="about2">
        <div class="container">
            <div class="row">
                <div class="left-text col-lg-5 col-md-12 col-sm-12 mobile-bottom-fix">
                    <div class="left-heading">
                        <h5>Curabitur aliquam eget tellus id porta</h5>
                    </div>
                    <p>Proin justo sapien, posuere suscipit tortor in, fermentum mattis elit. Aenean in feugiat purus.</p>
                    <ul>
                        <li>
                            <img src="assets/images/about-icon-01.png" alt="">
                            <div class="text">
                                <h6>Nulla ultricies risus quis risus</h6>
                                <p>You can use this website template for commercial or non-commercial purposes.</p>
                            </div>
                        </li>
                        <li>
                            <img src="assets/images/about-icon-02.png" alt="">
                            <div class="text">
                                <h6>Donec consequat commodo purus</h6>
                                <p>You have no right to re-distribute this template as a downloadable ZIP file on any website.</p>
                            </div>
                        </li>
                        <li>
                            <img src="assets/images/about-icon-03.png" alt="">
                            <div class="text">
                                <h6>Sed placerat sollicitudin mauris</h6>
                                <p>If you have any question or comment, please <a rel="nofollow" href="https://templatemo.com/contact">contact</a> us on TemplateMo.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="right-image col-lg-7 col-md-12 col-sm-12 mobile-bottom-fix-big" data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                    <iframe src="https://www.youtube.com/embed/2RXBZ9efPSM" width="550px" height="400px" class="rounded d-block mx-auto" alt="App" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section> -->
    <!-- ***** Features Big Item End ***** -->


    <!-- ***** Frequently Question Start ***** -->
    <section class="section" id="frequently-question">
        <div class="container">
            <!-- ***** Section Title Start ***** -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Pertanyaan yang sering diajukan</h2>
                    </div>
                </div>
            </div>
            <br>
            <!-- ***** Section Title End ***** -->

            <div class="row">
                <div class="col-md-12">
                    <div class="accordions">
                        <article class="accordion">
                            <div class="accordion-head">
                                <h5 class="tln">Apakah CBT Online support pada semua perangkat ?<span class="icon"><i class="icon fa fa-chevron-right"></i></span></h5>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p>CBT Online bisa diakses menggunakan browser Chrome pada semua perangkat dengan berbagai OS.
                                    Untuk ujian yang lebih aman Anda dapat melakukan konfigurasi CBT Online menggunakan SafeExamBrowser.</p>
                                </div>
                            </div>
                        </article>
                        <article class="accordion">
                            <div class="accordion-head">
                                <h5 class="tln">Berapa maksimal siswa yang dapat melakukan ujian di CBT Online ?<span class="icon"><i class="icon fa fa-chevron-right"></i></span></h5>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p>Total user pada CBT Online adalah tidak dibatasi. Akan tetapi total peserta yang dapat melakukan ujian tergantung dari spesifikasi server yang digunakan.
                                </div>
                            </div>
                        </article>
                        <article class="accordion">
                            <div class="accordion-head">
                                <h5 class="tln">Bisakah CBT Online menggunakan sub-domain milik sekolah ?<span class="icon"><i class="icon fa fa-chevron-right"></i></span></h5>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p>Bagi sekolah yang sudah memiliki domain maka tidak perlu membeli domain baru. CBT Online dapat menggunakan sub-domain yang sudah ada.</p>
                                </div>
                            </div>
                        </article>
                        <article class="accordion">
                            <div class="accordion-head">
                                <h5 class="tln">Sekolah saya belum mempunyai hosting dan domain ?<span class="icon"><i class="icon fa fa-chevron-right"></i></span></h5>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p>Paket pembelian CBT Online sudah termasuk lisensi 1 tahun, domain, dan server hosting sesuai dengan paket yang dipilih.<br>
                                    Anda dapat memilih paket CBT Lokal VHD jika ingin menggunakan CBT Online pada server lokal.</p>
                                </div>
                            </div>
                        </article>
                        <article class="accordion">
                            <div class="accordion-head">
                                <h5 class="tln">Spesifikasi server yang dibutuhkan CBT Online ?<span class="icon"><i class="icon fa fa-chevron-right"></i></span></h5>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p>Berikut adalah spesifikasi yang kami rekomendasikan untuk 400 siswa dengan 3 sesi ujian sehari.<br>Spesifikasi server yang dibutuhkan adalah CPU 4 core & RAM 4 GB.</p>
                                </div>
                            </div>
                        </article>
                        <article class="accordion">
                            <div class="accordion-head">
                                <h5 class="tln">Apakah CBT Online bisa menggunakan server lokal ?<span class="icon"><i class="icon fa fa-chevron-right"></i></span></h5>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p>CBT Online dapat digunakan pada server lokal. Anda dapat melakukan konfigurasi CBT Lokal VHD pada jaringan LAN di sekolah.<br>
                                        Proses konfigurasi CBT pada server lokal dapat dilihat <a href="https://youtu.be/iTHzG9fCpG4">disini</a>.
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Frequently Question End ***** -->


    <!-- ***** Contact Us Start ***** -->
    <section class="section" id="contact-us">
        <div class="container">
            <!-- ***** Section Title Start ***** -->
            <div class="row">
                <div class="left-text col-lg-6 col-md-6 col-sm-12">
                    <h5>Hubungi Kami</h5>
                    <div class="accordion-text">
                        <p>Anda dapat kontak kami melalui form disamping atau melalui email untuk pemesanan dan pembelian lisensi CBT Online.</p>
                        <p>Sertakan informasi nama lengkap, email, nama sekolah, dan paket yang diinginkan. Silahkan menunggu balasan untuk info lebih lebih lanjut.</p>
                        <p>Kami akan sangat senang menerima masukkan dari Anda.</p>
                        <!-- <span>Email: <a href="mailto:contact@cbts.site">contact@cbts.site</a><br></span> -->
                    </div>
                </div>
                <!-- ***** Contact Form Start ***** -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="contact-form">
                        <form id="contact" action="" method="post">
                            <input type="hidden" name="sendit" value='1'>
                          <div class="row">
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <input name="name" type="text" id="name" placeholder="Nama" required="" class="contact-field">
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <input name="email" type="text" id="email" placeholder="Email" required="" class="contact-field">
                              </fieldset>
                            </div>
                            <div class="col-lg-12">
                              <fieldset>
                                <input name="school" type="text" id="school" placeholder="Sekolah" required="" class="contact-field">
                              </fieldset>
                            </div>
                            <div class="col-lg-12">
                              <fieldset>
                                <textarea name="message" rows="6" id="message" placeholder="Halo, saya ingin melakukan pemesanan cbt online paket ......" required="" class="contact-field"></textarea>
                              </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <div class="g-recaptcha" data-sitekey="6LcdfIAhAAAAAB0Haasqd7iJiZpf--Ma1UkI-qu3"></div>
                                </fieldset>
                            </div>
                            <br>
                            <div class="col-lg-12">
                              <fieldset>
                                <button class='main-button' onclick="event.preventDefault();onSubmit()">Kirim</button>
                              </fieldset>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
                <!-- ***** Contact Form End ***** -->
            </div>
        </div>
    </section>
    <!-- ***** Contact Us End ***** -->
    
    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12">
                    <p class="copyright">Copyright &copy; <?=date('Y')?> CBT Online</p>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12">
                    <ul class="social copyright">
                        Design by <a rel="nofollow" href="https://templatemo.com">TemplateMo</a>
                        <!-- <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>

    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

    <script>
        function onSubmit() {
            var valid = false;
            if ($('#g-recaptcha-response').val() != "") {
                $('input[type="text"]').each(function() {
                    if ($(this).val() != "") {
                        valid=true
                    }
                });
                if ($('#message').val() != "") {
                    if( !validateEmail($('#email').val())) { 
                        valid = true;
                    }
                }
            } else {
                alert("Please confirm the Captcha!");
            }

            if (valid) {
                document.getElementById("contact").submit();
            } else {
                alert("Kolom tidak boleh kosong!");
            }
        }
        function validateEmail(email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test( email );
        }

    </script>


  </body>
</html>