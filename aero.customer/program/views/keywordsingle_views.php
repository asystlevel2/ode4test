<div class="content">
		<table class="table">
          <tbody>
			<?if($hawb):?>
			<tr>
			<td><strong>Connote&nbsp;</strong></td>
			<td><?=$hawb?></td>
			</tr>
			<tr>
			<td><strong>Shipper&nbsp;</strong></td>
			<td><?=$trnName?></td>
			</tr>
			
			<tr>
			<td><strong>City Origin&nbsp;</strong></td>
			<td><?=$trnOrg?></td>
			</tr>
			
			<tr>
			<td><strong>Shipment Date&nbsp;</strong></td>
			<td><?=$trnDate?></td>
			</tr>
			
			<tr>
			<td><strong>Consignee&nbsp;</strong></td>
			<td><?=$trnConsName?></td>
			</tr>
			
			<tr>
			<td><strong>Consignee Address&nbsp;</strong></td>
			<td><?=$trnConsAlm1?></td>
			</tr>
			
			<tr>
			<td>&nbsp;</td>
			<td><?=$trnConsAlm2?></td>
			</tr>
			
			<tr>
			<td>&nbsp;</td>
			<td><?=$trnConsAlm3?></td>
			</tr>
			
			<tr>
			<td><strong>Consignee City&nbsp;</strong></td>
			<td><?=$trnConsCity?></td>
			</tr>
			
			<tr>
			<td><strong>Weight&nbsp;</strong></td>
			<td><?=$trnWeight?> Kg</td>
			</tr>
			
			<tr>
<<<<<<< HEAD
=======
			<td><strong>Pcs&nbsp;</strong></td>
			<td><?=$pcs?> </td>
			</tr>
			
			<tr>
>>>>>>> d1fa3799bd29c62ddbe760aacdcb5a23586dca51
			<td><strong>Package&nbsp;</strong></td>
			<td><?=$trnTypeOfPackage?></td>
			</tr>
			
			<tr>
			<td><strong>Service&nbsp;</strong></td>
			<td><?=$trnTypeOfService?></td>
			</tr>
			
			<tr>
			<td><strong>Receiver</strong></td>
			<td ><?=$trnDeliveredByName?></td>
			</tr>
			
			<tr>
			<td><strong>Delivered date&nbsp;</strong></td>
			<td ><?=$trnDeliveredDate?></td>
			</tr>
			
			<tr>
			<td><strong>Delivered time&nbsp;</strong></td>
			<td ><?=$trnDeliveredTime?></td>
			</tr>
			<tr>
			<td><strong>Ref Customer&nbsp;</strong></td>
			<td><?=$trnReffInstruction?></td>
			</tr>
			<tr>
			<td><strong>Notes</strong></td>
			<td><?=$trnSpecialInstruction?></td>
			</tr>
			
			<? if(!empty($picture_data)):?>
			<tr>
			<td><strong>Upload Delivery</strong></td>
			<td><img src="<?=$picture_data?>" width="100"></td>
			</tr>
			<?endif;?>
			
			<? if(!empty($signature_data)):?>
			<tr>
			<td><strong>Upload Signature</strong></td>
			<td><img src="<?=$signature_data?>" width="100"></td>
			</tr>
			<?endif;?>
			
			<tr>
				<td colspan="2">
				<strong>Checkpoint</strong>
					<table class="table table-striped">
						<thead>
							<tr>
<<<<<<< HEAD
								<th>No</th>
								<th>Header</th>
								<th>Remarks</th>
								<th>Stamp Date</th>
								<th>Stamp Time</th>
								<th>Map View</th>
							</tr>
						</thead>
						<tbody>
						<? if(!empty($checkpoint)):?>
						<?foreach($checkpoint as $kunci => $key):?>
						<tr>
								<td><?=$key["no"]?></td>
								<td><?=$key["header"]?></td>
								<td><?=$key["status"]?></td>
								<td><?=$key["stampdate"]?></td>
								<td><?=$key["stamptime"]?></td>
								<td>
=======
								<th width="5%">No</th>
								<th width="15%">Status</th>
								<th width="47%">Remarks</th>
								<th width="15%">Stamp Date</th>
								<th width="8%">Stamp Time</th>
								<th width="10%">Map View</th>
							</tr>
						</thead>
						<tbody style="font-size:13.5px">
						<? if(!empty($checkpoint)):?>
						<?foreach($checkpoint as $kunci => $key):?>
						<tr>
								<td valign="top" style="vertical-align: top;"><?=$key["no"]?></td>
								<td valign="top" style="vertical-align: top;"><?=$key["header"]?></td>
								<td valign="top" style="vertical-align: top;"><?=$key["remarks"]?></td>
								<td valign="top" style="vertical-align: top;"><?=$key["stampdate"]?></td>
								<td valign="top" style="vertical-align: top;"><?=$key["stamptime"]?></td>
								<td valign="top" style="vertical-align: top;">
>>>>>>> d1fa3799bd29c62ddbe760aacdcb5a23586dca51
												<?if(!empty($key["gpsview"])):?>
												<span class="location">
												<a href="https://maps.google.com/maps?q=<?=$key["gpslat"]?>,<?=$key["gpslng"]?>&amp;hl=en&amp;t=v&amp;hnear=<?=$key["gpslat"]?>,<?=$key["gpslng"]?>" target="_blank">					
												<img src="http://maps.google.com/maps/api/staticmap?center=<?=$key["gpslat"]?>,<?=$key["gpslng"]?>&zoom=15&markers=color:green|<?=$key["gpslat"]?>,<?=$key["gpslng"]?>&path=color:0x0000FF80|weight:5|<?=$key["gpslat"]?>,<?=$key["gpslng"]?>&size=300x200&sensor=false&key=<?=$token_map?>">
												<br><?=$key["gpsview"]?>
												</span>
												<?endif;?>
								</td>
							</tr>
						<?endforeach;?>
						<?endif;?>
						</tbody>
					</table>
					
				</td>
			</tr>
			<tr>
			<td><strong>Geolocation</strong></td>
			<td >Latitude: <?php echo $trnLatitudeGps;?>, Longitude: <?php echo $trnLongitudeGps;?>, Accuracy: <?php echo $accuracy;?> M</td>
			</tr>
			<?if(!empty($trnLatitudeGps) && !empty($accuracy)):?>
			<tr>
			<td colspan="2">
			<a href="https://maps.google.com/maps?q=<?=$trnLatitudeGps?>,<?=$trnLongitudeGps?>&amp;hl=en&amp;t=v&amp;hnear=<?=$trnLatitudeGps?>,<?=$trnLongitudeGps?>" target="_blank">					
			<img src="http://maps.google.com/maps/api/staticmap?center=<?=$trnLatitudeGps?>,<?=$trnLongitudeGps?>&zoom=15&markers=color:green|<?=$trnLatitudeGps?>,<?=$trnLongitudeGps?>&path=color:0x0000FF80|weight:5|<?=$trnLatitudeGps?>,<?=$trnLongitudeGps?>&size=600x300&sensor=false&key=<?=$token_map?>">
			</a>
			</td>
			</tr>
			<?endif;?>
<?endif;?>
			
          </tbody>
        </table>
</div>
<!--
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>
					var latlng = new google.maps.LatLng(<?php echo $trnLatitudeGps;?>, <?php echo $trnLongitudeGps;?>);
                        var myOptions = {
                            zoom: 15,
                            center: latlng,
                            mapTypeControl: false,
                            navigationControlOptions: {
                                style: google.maps.NavigationControlStyle.SMALL
                            },
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                        function marker (){ 
							new google.maps.Marker({
								position: latlng,
								map: map
							});
						}
						marker();
</script>
-->