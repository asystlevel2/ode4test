<?
    header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$namafile" );
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");
	
?>


            <table class="table table-striped footable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Connote</th>
                        <th>Date</th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>No Accnt.</th>
                        <th>ConsigneeName</th>
                        <th>ConsigneeAddress</th>
                        <th>ConsigneeCity</th>
                        <th>Colly</th>
<<<<<<< HEAD
=======
                        <th>Pcs</th>
>>>>>>> d1fa3799bd29c62ddbe760aacdcb5a23586dca51
                        <th>Weight</th>
                        <th>Service</th>
						<th>Moda</th>
                        <th>Product</th>
                        <th>Insurance</th>
                        <th>Packing</th>
						<th>Amount</th>
                        <th>Receiver</th>
                        <th align="center" colspan='3'><b>Received</th>
                        <th>Lead Time</th>
						<th>Reff Customer</th>
                        <th>Special Instructioan</th>
						<th>Status</th>
						
                    </tr>
                </thead>
                <tbody>
                    <?if($row):?>
					<?foreach($row as $x=>$z):?>
							<tr>
							<td nowrap>&nbsp;<?=$z["no"]?>&nbsp;</td>
							<td nowrap <?=$z["style"]?>><?=$z["trnNumberAwb"]?></td>
							<td nowrap>&nbsp;<?=$z["trnDate"]?>&nbsp;</td>
							<td nowrap>&nbsp;<?=$z["trnorg"]?>&nbsp;</td>
							<td nowrap>&nbsp;<?=$z["trndest"]?>&nbsp;</td>
							<td nowrap>&nbsp;<?=$z["trnAcc"]?>&nbsp;</td>
							<td nowrap>&nbsp;<?=$z["trnConsName"]?>&nbsp;</td>
							<td nowrap>&nbsp;<?=$z["trnConsAlm1"]?>&nbsp;</td>
							<td nowrap><?=$z["trnConsCity"]?></td>
							<td nowrap><?=@number_format($z["trnColi"],0)?></td>
<<<<<<< HEAD
=======
							<td nowrap><?=@number_format($z["pcs"],0)?></td>
>>>>>>> d1fa3799bd29c62ddbe760aacdcb5a23586dca51
							<td nowrap><?=@number_format($z["trnWeight"],0)?></td>
							<td nowrap><?=$z["trnTypeOfService"]?></td>
							<td nowrap><?=$z["trnTypeVolume"]?></td>
							<td nowrap><?=$z["trnTypeOfPackage"]?></td>
							<td nowrap><?=$z["trnChargeInsurance"]?></td>
							<td nowrap><?=$z["trnChargePacking"]?></td>
							<td nowrap><?=$z["trnPriceAll"]?></td>
							<td nowrap>&nbsp;<?=$z["trnDeliveredByName"]?>&nbsp;</td>
							<td nowrap>&nbsp;<?=$z["trnDeliveredDate"]?>&nbsp;</td>
							<td nowrap>&nbsp;<?=$z["trnDeliveredTime"]?>&nbsp;</td>
							<td nowrap>&nbsp;<?=$z["informasi"]?>&nbsp;</td>
							<td nowrap><?=$z["serviceLeadTime"]?></td>
							<td nowrap>&nbsp;<?=$z["trnReffInstruction"]?></td>
							<td nowrap>&nbsp;<?=$z["trnSpecialInstruction"]?></td>
							<td nowrap  <?=$z["style"]?>>&nbsp;<?=$z["lastpost"]?></td>
							</tr>			
					<?endforeach;?>
					<?endif;?>
                </tbody>
            </table>
