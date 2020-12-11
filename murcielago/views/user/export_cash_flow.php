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
<body style="border:1px solid #ccc;border-collapse: collapse;">
<table border="1" width="100%">
    <thead>
        <tr>
            <td style="width:50px;"><b>No.</b></td>
            <td><b>Tanggal Transaksi</b></td>
            <td><b>Debet</b></td>
            <td><b>Kredit</b></td>
        </tr>
    </thead>
    <tbody>
        <?
            $no=0;
            foreach($kas as $k){
            $no++;
        ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= tgl_indo(date('Y-m-d', strtotime($k->tanggal_transaksi))) ?></td>
            <td><? if(empty($k->debet)){echo'-';}else{echo 'Rp. '.'<span class="pull-right">'.number_format($k->debet).'</span>';} ?></td>
            <td><? if(empty($k->kredit)){echo'-';}else{echo 'Rp. '.'<span class="pull-right">'.number_format($k->kredit).'</span>';} ?></td>
        </tr>
        <? } ?>
    </tbody>
</table>
<br>
<br>
<br>
<br>
                          
                                <?
                                    $no = 0;
                                    $total_debet=0;
                                    $total_kredit=0;
                                    foreach($kas as $d){
                                        $no++;
                                        $totaldebet[$no] = $d->debet;
                                        $total_debet += $totaldebet[$no];
                                        
                                        $totalkredit[$no] = $d->kredit;
                                        $total_kredit += $totalkredit[$no];
                                    }
                                ?>
                                <table border="1" width="100%">
                                	<tbody>
                                		<tr>
                                			<td>Total Debet : </td>
                                			<td>Rp. <?= number_format($total_debet) ?></td>
                                		</tr>
                                		<tr>
                                			<td>Total Kredit : </td>
                                			<td>Rp. <?= number_format($total_kredit) ?></td>
                                		</tr>
                                <? $total_kas = $total_debet-$total_kredit; ?>
                                		
                                		<tr>
                                			<td>Total Kas : </td>
                                			<td>Rp. <?= number_format($total_kas) ?></td>
                                		</tr>
                                	</tbody>
                                </table>   
</body>
</html>