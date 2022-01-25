<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

ob_start();

$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);

// Set default timezone to WITA
date_default_timezone_set('Asia/Makassar');

// set locale language
setlocale(LC_ALL, 'IND.UTF-8');

// list of set locale 
// setlocale(LC_ALL, 'id_ID.UTF8', 
// 'id_ID.UTF-8', 
// 'id_ID.8859-1', 
// 'id_ID', 
// 'IND.UTF8', 
// 'IND.UTF-8', 
// 'IND.8859-1', 
// 'IND', 
// 'Indonesian.UTF8', 
// 'Indonesian.UTF-8', 
// 'Indonesian.8859-1', 
// 'Indonesian', 'Indonesia', 'id', 'ID');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo URLROOT  ?>/public/css/print.css" >
  <title>Cetak Laporan </title>
</head>
<body>
  <div class="kop-surat">
    <h4>POLRI DAERAH KALIMANTAN TIMUR</h4>
    <h4>RESOR PASER</h4>
    <h4>SEKTOR TANAH GROGOT</h4>
    <p><u>Jalan Negara KM. 09 Tanah Grogot Telp 0543-76211</u></p>
    <h4>" PRO JUSTITIA "</h4>
  </div>

  <div class="head-report">
    <h4><u>LAPORAN POLISI</u></h4>
    <p>Nomor: LP/A-02/X/2017/KALTIM/RES PASER/SEK TANAH GROGOT</p>
    <hr>    
  </div>

  <div class="content">
    <h4><u> PERISTIWA YANG TERJADI</u></h4>
    <table class="table-1" align="left" border="0">
      <tbody>
        <tr>
          <td><p><strong>Waktu Kejadian</strong></p></td>
          <td><?php echo ': ' . strftime('%A %d %B %Y, %H:%M', strtotime($data['report']->waktu_kejadian) ) ?></td>
        </tr>
        <tr>
          <td><p><strong>Tempat Kejadian</strong></p></td>
          <td><?php echo ': ' . $data['report']->tempat_kejadian ?></td>

        </tr>
        <tr>
          <td><p><strong>Apa yang terjadi</strong></p></td>
          <td><?php echo ': ' . $data['report']->pelanggaran ?></td>
        </tr>
        <tr>
          <td><p><strong>Pelaku</strong></p></td>
          <td> <?php echo ': ' . $data['report']->pelaku ?></td>
        </tr>
        <tr>
          <td><p><strong>Korban</strong></p></td>
          <td> <?php echo ': ' . $data['report']->korban ?></td>
        </tr>
        <tr>
          <td><p><strong>Bagaimana Terjadi</strong></p></td>
          <td><?php echo ': ' . $data['report']->deskripsi_kejadian ?></td>
        </tr>
        <tr>
          <td><p><strong>Waktu Dilaporkan</strong></p></td>
          <!-- Change the format to Day-Month-Year -->
          <!-- <td><?php echo date('l, j F Y H:i', strtotime($data['report']->waktu_dilaporkan)) ?></td> -->

          <!-- Change format to locale indonesia -->
          <td><?php echo ': ' . strftime('%A %d %B %Y, %H:%M', strtotime($data['report']->waktu_dilaporkan) ) ?></td>
        </tr>

      </tbody>
    </table>

    <hr>
    
    <table class="table-2" align="left" border="0">
      <thead>
        <tr>
          <th><u> TINDAK PIDANA APA</u></th>
          <th><u> NAMA DAN ALAMAT PARA SAKSI</u></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <p><?php echo $data['report']->tindak_pidana ?></p>
          </td>
          <td>
            <p><?php echo $data['report']->nama_saksi ?></p>
            <p><?php echo $data['report']->alamat_saksi ?></p>
          </td>
        </tr>
        
      </tbody>
    </table>

    <hr>

    <table class="table-3" align="left" border="0">
      <thead>
        <tr>
          <th><u>BARANG BUKTI</u></th>
          <th><u>URAIAN SINGKAT KEJADIAN</u></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $data['report']->barang_bukti ?></td>
          <td><?php echo $data['report']->uraian_kejadian ?></td>
        </tr>
      </tbody>
    </table>

    <hr>

    <table class="table-tanda-tangan" align="center" border="0">
      <thead>
        <tr>
          <td>MENGETAHUI</td>
          <!-- <td>Tana Paser, <?php echo date('j F Y'); ?></td> -->
          <?php 
            $today = new DateTime();
          ?>
          <td>Tana Paser, <?php echo strftime('%d %B %Y', $today->getTimestamp()); ?></td>
        </tr>
        <tr>
          <td>KEPALA KEPOLISIAN SEKTOR TANAH GROGOT</td>
          <td>YANG MEMBUAT LAPORAN</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>NUR ASKIN B</td>
          <td>MUCHAMAD ARIFIN</td>
        </tr>
        
      </tbody>
      <tfoot>
        <tr>
          <td>AJUN KOMISARIS POLISI NRP. 67040398</td>
          <td>BRIPDA NRP. 94110310</td>     
        </tr>
      </tfoot>
    </table>

  </div>
</body>
</html>

<?php

$html = ob_get_contents();
ob_end_clean();

$mpdf->WriteHTML($html);
$mpdf->Output('data-laporan.pdf', \Mpdf\Output\Destination::INLINE);


?>



