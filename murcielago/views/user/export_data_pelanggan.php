<?php
 
  header("Content-type: application/vnd-ms-excel");
 
  header("Content-Disposition: attachment; filename=$title.xls");
 
  header("Pragma: no-cache");
 
  header("Expires: 0");
 
 ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body style="border:1px solid #ddd;border-collapse: collapse;">
 <table border="1" width="100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Pelanggan</th>
            <th>Nama Pembeli</th>
            <th>Sumber Dana</th>
            <th>Status Keanggotaan</th>
          </tr>
        </thead>
        <tbody>
          <?
          $no=0;
          foreach($pembeli as $p):
          $no++;
          ?>
          <tr>
            <td><?= $no ?></td>
            <td><?= $p->kd_pelanggan ?></td>
            <td><?= $p->nama_pembeli ?></td>
            <td><?= $p->sumber_dana ?></td>
            <td><?= $p->status_keanggotaan ?></td>
          </tr>
              <? endforeach; ?>
              </tbody>
            </table>
</body>
</html>