<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class PDFConverter
{
    private $com;

    /**
     * need to install openoffice and run in the background
     * soffice -headless-accept="socket,host=127.0.0.1,port=8100;urp;" -nofirststartwizard
     */
    public function __construct()
    {
        try {
            $this->com = new COM('com.sun.star.ServiceManager');
        } catch (Exception $e) {
            die('Please be sure that OpenOffice.org is installed.');
        }
    }

    /**
     * Execute PDF file(absolute path) conversion
     * @param $source [source file]
     * @param $export [export file]
     */
    public function execute($source, $export)
    {
        $source = 'file:///' . str_replace('\\', '/', $source);
        $export = 'file:///' . str_replace('\\', '/', $export);
        $this->convertProcess($source, $export);
    }

    /**
     * Get the PDF pages
     * @param $pdf_path [absolute path]
     * @return int
     */
    public function getPages($pdf_path)
    {
        if (!file_exists($pdf_path)) return 0;
        if (!is_readable($pdf_path)) return 0;
        if ($fp = fopen($pdf_path, 'r')) {
            $page = 0;
            while (!feof($fp)) {
                $line = fgets($fp, 255);
                if (preg_match('/\/Count [0-9]+/', $line, $matches)) {
                    preg_match('/[0-9]+/', $matches[0], $matches2);
                    $page = ($page < $matches2[0]) ? $matches2[0] : $page;
                }
            }
            fclose($fp);
            return $page;
        }
        return 0;
    }

    private function setProperty($name, $value)
    {
        $struct = $this->com->Bridge_GetStruct('com.sun.star.beans.PropertyValue');
        $struct->Name = $name;
        $struct->Value = $value;
        return $struct;
    }

    private function convertProcess($source, $export)
    {
        $desktop_args = array($this->setProperty('Hidden', true));
        $desktop = $this->com->createInstance('com.sun.star.frame.Desktop');
        $export_args = array($this->setProperty('FilterName', 'writer_pdf_Export'));
        $program = $desktop->loadComponentFromURL($source, '_blank', 0, $desktop_args);
        $program->storeToURL($export, $export_args);
        $program->close(true);
    }
}

function getPdfPages($path)
{
    if (!file_exists($path)) return array(false, "文件\"{$path}\"不存在！");
    if (!is_readable($path)) return array(false, "文件\"{$path}\"不可读！");
// 打开文件
    $fp = @fopen($path, "r");
    if (!$fp) {
        return array(false, "打开文件\"{$path}\"失败");
    } else {
        $max = 0;
        while (!feof($fp)) {
            $line = fgets($fp, 255);
            if (preg_match('/\/Count [0-9]+/', $line, $matches)) {
                preg_match('/[0-9]+/', $matches[0], $matches2);
                if ($max < $matches2[0]) $max = $matches2[0];
            }
        }
        fclose($fp);
// 返回页数
        return array(true, $max);
    }
}
function escape($str) {
    preg_match_all ( "/[\xc2-\xdf][\x80-\xbf]+|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}|[\x01-\x7f]+/e", $str, $r );
    //匹配utf-8字符，
    $str = $r [0];
    $l = count ( $str );
    for($i = 0; $i < $l; $i ++) {
        $value = ord ( $str [$i] [0] );
        if ($value < 223) {
            $str [$i] = rawurlencode ( utf8_decode ( $str [$i] ) );
            //先将utf8编码转换为ISO-8859-1编码的单字节字符，urlencode单字节字符.
            //utf8_decode()的作用相当于iconv("UTF-8","CP1252",$v)。
        } else {
            $str [$i] = "%u" . strtoupper ( bin2hex ( iconv ( "UTF-8", "UCS-2", $str [$i] ) ) );
        }
    }
    return join ( "", $str );
}
function unescape($str) {
    $ret = '';
    $len = strlen ( $str );
    for($i = 0; $i < $len; $i ++) {
        if ($str [$i] == '%' && $str [$i + 1] == 'u') {
            $val = hexdec ( substr ( $str, $i + 2, 4 ) );
            if ($val < 0x7f)
                $ret .= chr ( $val );
            else if ($val < 0x800)
                $ret .= chr ( 0xc0 | ($val >> 6) ) . chr ( 0x80 | ($val & 0x3f) );
            else
                $ret .= chr ( 0xe0 | ($val >> 12) ) . chr ( 0x80 | (($val >> 6) & 0x3f) ) . chr ( 0x80 | ($val & 0x3f) );
            $i += 5;
        } else if ($str [$i] == '%') {
            $ret .= urldecode ( substr ( $str, $i, 3 ) );
            $i += 2;
        } else
            $ret .= $str [$i];
    }
    return $ret;
}
session_start();
if (isset($_SESSION["user"]) == false)
{
    echo "<script type='text/javascript'>alert(\"请重新登陆。\");</script>";
    echo "<script>window.location.href='/index.php';</script> ";
}
if(isset($_FILES['file'])){
    if ($_FILES["file"]["error"] > 0)
    {
        echo "错误: " . $_FILES["file"]["error"] . "<br>";
    }
    else {
        $hashname = hash_file('sha256', $_FILES["file"]["tmp_name"], false);
        $hashPath = "upload/" . "$hashname." . substr($_FILES["file"]["name"], strrpos($_FILES["file"]["name"], '.') + 1);
        $fileType = substr($_FILES["file"]["name"], strrpos($_FILES["file"]["name"], '.') + 1);
        $fileNmae = escape($_FILES["file"]["name"]);
        $orderId = mysql_escape_string($_POST['orderId']);

        if (file_exists($hashPath) == false) {
            move_uploaded_file($_FILES["file"]["tmp_name"], "../../$hashPath");
        }
        $con = mysql_connect("localhost", "root", "wslzd9877");
        if (!$con) {
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db("user", $con);
        if (mysql_num_rows(mysql_query("SELECT * FROM fileinfo where orderId = '$orderId' and filename = '$fileNmae'")) == 0 ) {
            mysql_query("INSERT INTO fileinfo (orderId, filePath,filename)VALUES (\"$orderId\", \"$hashPath\",\"$fileNmae\")");
        }
        
        $canTypes = array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx');
        $converter = new PDFConverter();
        if(
                strcasecmp($fileType,"bmp") == 0  || strcasecmp($fileType,"jpg") == 0  ||
                strcasecmp($fileType,"jpeg") == 0 || strcasecmp($fileType,"gif") == 0  ||
                strcasecmp($fileType,"tiff") == 0 || strcasecmp($fileType,"png") == 0 
        )
        {
            $paperNum = 1;
            mysql_query("update fileinfo set paperNum='$paperNum' where orderId='$orderId' and filename='$fileNmae'");
        }
        else if($fileType == 'pdf')
        {
            $paperNum = getPdfPages("C:/phpStudy/PHPTutorial/upload/"."$hashname." . substr($_FILES["file"]["name"], strrpos($_FILES["file"]["name"], '.') + 1))[1];
            mysql_query("update fileinfo set paperNum='$paperNum' where orderId='$orderId' and filename='$fileNmae'");
        }
        else {
            foreach ($canTypes as $each )
            {
                if(strcasecmp($each,$fileType) == 0)
                {

                    $source = "C:/phpStudy/PHPTutorial/upload/"."$hashname." . substr($_FILES["file"]["name"], strrpos($_FILES["file"]["name"], '.') + 1);
                    $export = "C:/phpStudy/PHPTutorial/convertTemp/"."$hashname.pdf";
                    $converter->execute($source, $export);
                    $paperNum = getPdfPages($export)[1];
                    unlink($export);
                    mysql_query("update fileinfo set paperNum='$paperNum' where orderId='$orderId' and filename='$fileNmae'");
                    break;
                }
            }
        }

        mysql_close($con);
    }
}


?>