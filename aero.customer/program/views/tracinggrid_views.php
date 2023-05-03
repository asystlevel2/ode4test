<div class="long-data">
    <div class="container">
        <h2><i class="fa fa-chart-bar"></i> Delivery Details Report</h2>
        <div class="form">
            <div class="row">
                <div class="col s3">
                    <strong>No Account</strong>
                </div>
                <div class="col s9">
                    <?=$nomor_account?>
                </div>
            </div>
            <div class="row">
                <div class="col s3">
                    <strong>Name Account</strong>
                </div>
                <div class="col s9"><?=$name_account?></div>
            </div>
            <div class="row">
                <div class="col s3">
                    <strong>Periode</strong>
                </div>
                <div class="col s9"><?=$start?>&nbsp;<sup>S</sup>/<sub>D</sub>&nbsp;<?=$end?></div>
            </div>
            <div class="row">
                <div class="col s3">
                    <strong>City Origin</strong>
                </div>
                <div class="col s9">ALL</div>
            </div>
            <div class="row">
                <div class="col s4">
                    <strong>Total Received Ontime</strong> <?=$ontime?>
                </div>
                <div class="col s4">
                    <strong>Total Received Overtime</strong> <?=$overtime?></div>

                <div class="col s4">
                    <strong>Total Not Received</strong> <?=$delay?></div>
            </div>
            <?if(!empty($moda)):?>
            <?foreach($moda as $key => $kun):?>
            <div class="row">
                <div class="col s4">
                    <strong>Total Moda Transport <?=$key?></strong>
                </div>
                <div class="col s4"><?=array_sum($kun)?></div>
            </div>
            <?endforeach;?>
            <?endif;?>

            <div class="row">
                <form class="col s12">
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="fa fa-search prefix"></i>
                            <input id="filter" type="text" class="validate">
                            <label for="icon_prefix">Search</label>
                        </div>
                        <div class="input-field col s6">
                            <a href="#clear" class="clear-filter waves-effect waves-light btn-flat" title="clear filter">Clear</a>
                            &nbsp;
                            <a href="<?=$export?>" target="_blank" class="waves-effect waves-light btn-flat">[Export Excel]</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <table class="table table-striped footable" data-filter="#filter" data-filter-minimum="3" data-page-size="30" data-page-navigation=".pagination">
        <thead>
            <tr>
                <th>No</th>
                <th>Connote</th>
                <th nowrap>Date</th>
                <th data-hide="phone">Origin</th>
                <th data-hide="phone">Destination</th>
                <th data-hide="phone">No Accnt.</th>
                <th data-hide="phone">ConsigneeName</th>
                <th data-hide="phone">ConsigneeAddress</th>
                <th data-hide="phone,tablet">ConsigneeCity</th>
                <th data-hide="phone,tablet">Colly</th>
<<<<<<< HEAD
=======
                <th data-hide="phone,tablet">Pcs</th>
>>>>>>> d1fa3799bd29c62ddbe760aacdcb5a23586dca51
                <th data-hide="phone,tablet">Weight<br>Kg</th>
                <th data-hide="phone,tablet">Service</th>
                <th data-hide="phone,tablet">Moda</th>
                <th data-hide="phone,tablet">Product</th>
                <th data-hide="phone,tablet">Insurance</th>
                <th data-hide="phone,tablet">Packing</th>
                <th data-hide="phone,tablet">Amount</th>
                <th data-hide="phone,tablet">Receiver</th>
                <th align="center" colspan='3' data-hide="phone,tablet"><b>Received</th>
                <th data-hide="phone,tablet">Lead Time</th>
                <th data-hide="phone,tablet">Reff Customer</th>
                <th data-hide="phone,tablet">Special Instructioan</th>
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
                <td nowrap style="text-align:right;"><?=$z["trnChargeInsurance"]?></td>
                <td nowrap style="text-align:right;"><?=$z["trnChargePacking"]?></td>
                <td nowrap style="text-align:right;"><?=$z["trnPriceAll"]?></td>
                <td nowrap>&nbsp;<?=$z["trnDeliveredByName"]?>&nbsp;</td>
                <td nowrap>&nbsp;<?=$z["trnDeliveredDate"]?>&nbsp;</td>
                <td nowrap>&nbsp;<?=$z["trnDeliveredTime"]?>&nbsp;</td>
                <td nowrap style="<?=$z["style"]?>">&nbsp;<?=$z["informasi"]?>&nbsp;</td>
                <td nowrap><?=$z["serviceLeadTime"]?></td>
                <td nowrap>&nbsp;<?=$z["trnReffInstruction"]?></td>
                <td nowrap>&nbsp;<?=$z["trnSpecialInstruction"]?></td>
                <td nowrap>&nbsp;<?=$z["lastpost"]?></td>
            </tr>
            <?endforeach;?>
            <?endif;?>
        </tbody>
    </table>
    <div class="pagination pagination-centered hide-if-no-paging"></div>
</div>
