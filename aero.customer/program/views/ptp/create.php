<div class="container">
    <div class="content-padded">
        <h3><i class="fa fa-vr-cardboard"></i>&nbsp; Port to Port</h3>
    </div>
    <div class="card">
        <div class="card-title">
            <div class="card red" id="errorPanel" style="display: none">
                <div class="card-content" style="color: white; font-size: 12px">

                </div>
            </div>
        </div>
        <div class="card-content">
            <form name="bk_form" id="bk_form">
                <table>
                    <tr>
                        <td width="16%">Account Customer</td>
                        <td><input name="bk_shipper_account" id="bk_shipper_account" type="text"
                                   value="<?= $account_customer['custAcc'] ?>" style="text-align: right"></td>
                        <td><input name="bk_shipper_name" id="bk_shipper_account" type="text"
                                   value="<?= $account_customer['custName'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Tanggal Booking</td>
                        <td colspan="2"><input type="date" name="bk_date" id="bk_date" value="<?= date('Y-m-d') ?>">
                        </td>
                    </tr>
                </table>
                <div class="row">
                    <table class="col s6">
                        <tr>
                            <td></td>
                            <td><strong>Informasi Shipper</strong></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><input name="bk_shipper_name" id="bk_shipper_name" type="text" tabindex="1"></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><input type="text" name="bk_shipper_alamat1" tabindex="2"></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><input type="text" name="bk_shipper_alamat2" id="bk_shipper_alamat2" tabindex="3">
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><input type="text" name="bk_shipper_alamat3" id="bk_shipper_alamat3" tabindex="4">
                            </td>
                        </tr>
                        <tr>
                            <td>Hub</td>
                            <td>
                                <input type="text" name="bk_shipper_origin" id="bk_shipper_origin" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Port</td>
                            <td>
                                <div class="input-field"><input type="text" name="bk_shipper_city" id="bk_shipper_city"
                                                                class="autocomplete" tabindex="5"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>CodeCity/KodePos</td>
                            <td>
                                <div class="row">
                                    <div class="col s4">
                                        <input type="text" name="bk_shipper_kd_city" id="bk_shipper_kd_city"
                                               tabindex="6">
                                    </div>
                                    <div class="col s4">
                                        <input type="text" name="bk_shipper_kd_pos" id="bk_shipper_kd_pos"
                                               tabindex="7">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Contact Person</td>
                            <td><input type="text" name="bk_shipper_contact" id="bk_shipper_contact" tabindex="8"
                                       value="<?= $account_customer['custContact'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Telephone</td>
                            <td>
                                <input type="text" name="bk_shipper_phone" id="bk_shipper_phone"
                                       tabindex="9">
                            </td>
                        </tr>
                    </table>
                    <table class="col s6">
                        <tr>
                            <td width="10%"></td>
                            <td><strong>Informasi Consignee</strong></td>
                        </tr>
                        <tr>
                            <td width="10%">Name</td>
                            <td colspan="2"><input name="bk_consignee_name" id="bk_consignee_name" type="text" tabindex="10"></td>
                        </tr>
                        <tr>
                            <td width="10%">Address</td>
                            <td><input type="text" name="bk_consignee_alamat1" tabindex="11"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="text" name="bk_consignee_alamat2" id="bk_consignee_alamat2"
                                       tabindex="12"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="text" name="bk_consignee_alamat3" id="bk_consignee_alamat3"
                                       tabindex="13"></td>
                        </tr>
                        <tr>
                            <td width="10%">Hub</td>
                            <td><input type="text" name="bk_consignee_destination" id="bk_consignee_destination" readonly></td>
                        </tr>
                        <tr>
                            <td width="10%">Port</td>
                            <td>
                                <div class="input-field"><input type="text" name="bk_consignee_city"
                                                                id="bk_consignee_city" class="autocomplete" tabindex="14"></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="row">
                                    <div class="col s4">
                                        <input type="text" name="bk_consignee_kd_city" id="bk_consignee_kd_city"
                                               tabindex="15">
                                    </div>
                                    <div class="col s4">
                                        <input type="text" name="bk_consignee_kd_pos" id="bk_consignee_kd_pos"
                                               tabindex="16">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="text" name="bk_consignee_contact" id="bk_consignee_contact"
                                                   tabindex="17"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="text" name="bk_consignee_phone" id="bk_consignee_phone"
                                       tabindex="18">
                            </td>
                        </tr>
                    </table>
                </div>
                <table>
                    <tr>
                        <td width="16%">Service</td>
                        <td>
                            <select name="bk_service" id="bk_service" tabindex="19">
                                <option></option>
                                <?php
                                foreach ($servicelist as $key => $service) {
                                    echo "<option value='$service->serviceField'>$service->serviceName</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Payment</td>
                        <td>
                            <select name="bk_payment" id="bk_payment" tabindex="20">
                                <option></option>
                                <?php
                                foreach ($paymentlist as $key => $payment) {
                                    echo "<option value='$payment->paymentField'>$payment->paymentName</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <div style="width:auto; height: auto;overflow-x:auto;">
                    <table width="100%" id="dimensionalTable">
                        <thead>
                        <tr align="center">
                            <td bgcolor="#e0ecff" style="font-weight:bold;color:#0e2d5f;" rowspan="2">
                                COL
                            </td>
                            <td bgcolor="#e0ecff" align="center" style="font-weight:bold;color:#0e2d5f;"
                                colspan="3">
                                DIMENSI
                            </td>
                            <td bgcolor="#e0ecff" style="font-weight:bold;color:#0e2d5f;" rowspan="2">
                                VOL<br>M
                            </td>
                            <td bgcolor="#e0ecff" style="font-weight:bold;color:#0e2d5f;" rowspan="2">W.<br>AC
                            </td>
                            <td bgcolor="#e0ecff" style="font-weight:bold;color:#0e2d5f;" rowspan="2">W.<br>CH
                            </td>
                            <td bgcolor="#e0ecff" style="font-weight:bold;color:#0e2d5f;" rowspan="2">
                                REQUEST<br>PACKING
                            </td>
                            <td bgcolor="#e0ecff" style="font-weight:bold;color:#0e2d5f;" rowspan="2">
                                SHC
                            </td>
                            <td rowspan="2"></td>
                        </tr>
                        <tr align="center">
                            <td bgcolor="#e0ecff" style="font-weight:bold;color:#0e2d5f;">L</td>
                            <td bgcolor="#e0ecff" style="font-weight:bold;color:#0e2d5f;">W</td>
                            <td bgcolor="#e0ecff" style="font-weight:bold;color:#0e2d5f;">H</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input type="text" name="bk_colly[]" id="bk_colly" class="validate" value="1" size="1"
                                       style="text-align: right;"></td>
                            <td><input type="text" name="bk_dimensi_L[]" class="validate" size="2"
                                       onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '')"
                                       onchange="defineActualWeight(this)" style="text-align: right"></td>
                            <td><input type="text" name="bk_dimensi_W[]" class="validate" size="2"
                                       onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '')"
                                       onchange="defineActualWeight(this)" style="text-align: right"></td>
                            <td><input type="text" name="bk_dimensi_H[]" class="validate" size="2"
                                       onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '')"
                                       onchange="defineActualWeight(this)" style="text-align: right"></td>
                            <td><input type="text" name="bk_volume_weight[]" class="validate" size="2"
                                       style="text-align: right" readonly></td>
                            <td><input type="text" name="bk_weight[]" class="validate" size="2"
                                       onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '')"
                                       onchange="defineActualWeight(this)" style="text-align: right"></td>
                            <td><input type="text" name="bk_actual_weight[]" class="validate" size="2"
                                       style="text-align: right"></td>
                            <td><?= form_dropdown('bk_type_pac[]', $packinglist, '', '') ?></td>
                            <td><div class="input-field"><input type="text" name="bk_surcharge_list[]" class="autocomplete"></div></td>
                            <td><a id="addRow"><span class="fa fa-plus"></span></a></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td><input type="text" name="bk_total_colly" id="bk_total_colly"
                                       class="validate" size="1" value="1" style="text-align: right;"></td>
                            <td colspan="3" style="text-align: center">Total</td>
                            <td><input type="text" name="bk_total_volume" id="bk_total_volume" size="2" readonly></td>
                            <td><input type="text" name="bk_total_actual" id="bk_total_actual" size="2" readonly></td>
                            <td><input type="text" name="bk_total_weight" id="bk_total_weight" size="2"
                                       style="text-align: right" readonly></td>
                            <td colspan="2"></td>
                        </tr>
                        </tfoot>
                    </table>
                    <p style="font-size:9px;text-align: center;"><b>*</b> Rumus Volume = ((Height X
                        Width X Length)/ Volume) X Jumlah Koli </p>
                </div>
                <fieldset style="margin-top: 20px">
                    <div class="col s12">
                        <div>FLIGHT / SCHEDULE REQUEST</div>
                        <textarea name="bk_special_instruction" id="bk_special_instruction"></textarea>
                    </div>
                    <div class="col s12">
                        <div>NATURE OF GOODS</div>
                        <textarea name="bk_content_of_goods" id="bk_content_of_goods"></textarea>
                    </div>
                    <div class="col s12">
                        <div>COMMODITY</div>
                        <div class="input-field"><input type="text" name="bk_commodity" id="bk_commodity"
                                                        class="autocomplete"></div>
                    </div>
                </fieldset>
                <a class="waves-effect btn" id="bk_btn_save">Save</a>
                <a href="<?= base_url('ptp') ?>">Back</a>
            </form>
        </div>
    </div>
</div>
<?php
if (isset($extra_js)):
    foreach ($extra_js as $x_js):
        echo '<script type="text/javascript" src="' . site_url("assets/js/" . $x_js . "") . '"></script>';
    endforeach;
endif;
?>
<script>
    $('.tabs').tabs();
    $('#bk_transporter').val('UDARA')
    $('#bk_payment').val('CR');
    $('#bk_package').val('SPS');
</script>
<script>
    var rowTR = document.getElementById("dimensionalTable").children[1].children[0].innerHTML

    document.addEventListener('DOMContentLoaded', function () {
        var data = $.ajax({
            url: `<?= base_url() ?>master/masterdirectory/autocomplete`,
            global: false,
            async: false,
            success: function (data) {
                return data
            }
        })
        var commoditylist = $.ajax({
            url: `<?= base_url() ?>master/mastercommodity/autocomplete`,
            global: false,
            async: false,
            success: function (data) {
                return data
            }
        })
        var surchargeslist = $.ajax({
            url: `<?= base_url() ?>master/mastersurcharges/autocomplete`,
            global: false,
            async: false,
            success: function (data) {
                return data
            }
        })

        var customerCity = document.getElementById('bk_shipper_city')
        var consigneeCity = document.getElementById('bk_consignee_city')
        var commodity = document.getElementById('bk_commodity')
        var surcharges = document.getElementsByName('bk_surcharge_list[]')

        var instanceCustomer = M.Autocomplete.init(customerCity, {
            data: data.responseJSON,
            minLength: 0,
            onAutocomplete: (e) => {
                $('#bk_shipper_kd_city').val(e.split('@')[1])
                var hub = $.ajax({
                    url: `<?= base_url() ?>master/Masterdirectory/getHubDirectoryPtp`,
                    type: 'POST',
                    data: {kd_city: e.split('@')[1]},
                    global: false,
                    async: false,
                    success: function (response) {
                        return response
                    }
                }).responseJSON
                $('#bk_shipper_origin').val(hub.Hub)
            }
        });

        var instanceConsignee = M.Autocomplete.init(consigneeCity, {
            data: data.responseJSON,
            minLength: 0,
            onAutocomplete: (e) => {
                $('#bk_consignee_kd_city').val(e.split('@')[1])
                var hub = $.ajax({
                    url: `<?= base_url() ?>master/Masterdirectory/getHubDirectoryPtp`,
                    type: 'POST',
                    data: {kd_city: e.split('@')[1]},
                    global: false,
                    async: false,
                    success: function (response) {
                        return response
                    }
                }).responseJSON
                $('#bk_consignee_destination').val(hub.Hub)
            }
        })

        var instanceCommodity = M.Autocomplete.init(commodity, {
            data: commoditylist.responseJSON,
            minLength: 0,
        })

        var instanceSurcharges = M.Autocomplete.init(surcharges, {
            data: surchargeslist.responseJSON,
            minLength: 0
        })
    });

    document.getElementById('bk_btn_save').addEventListener('click', function (e) {
        this.disabled = true
        var data = $('#bk_form').serializeArray()
        $.post("save", data, function (response) {
            if (!response.status) {
                // $('#errorPanel').css('display', 'block')
                var template = `<ul>`;
                response.message.forEach((val) => {
                    Object.keys(val).forEach((v) => {
                        template += `<li>${val[v]}</li>`
                    })
                    this.disabled = false
                })
                template += `</ul>`;
                M.toast({html: template})
                // $('#errorPanel').find('.card-content').html(template)
                // window.scrollTo(0,0)
            } else {
                M.toast({html: `<div>${response.message}</div>`})
                $('#bk_form')[0].reset()
            }
        }, 'json')
    })

    $("#dimensionalTable tbody").on('click', 'tr td a#addRow', addRow)
    $("#dimensionalTable tbody").on('click', 'tr td a#removeRow', removeRow)
    $("#dimensionalTable tbody").on('change', 'tr td input#bk_colly', calculateColly)
    
    function removeRow() {
        $(this).parents('tr').remove()
        calculateColly()
        totalWeightActual()
        totalWeight()
        totalVolume()
    }

    function addRow()
    {
        var html = `<tr>`
        html += `<td><input type="text" name="bk_colly[]" id="bk_colly" class="validate" value="1" size="1" style="text-align: right;"></td>`
        html += `<td><input type="text" name="bk_dimensi_L[]" class="validate" size="2" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '')" onchange="defineActualWeight(this)" style="text-align: right"></td>`
        html += `<td><input type="text" name="bk_dimensi_W[]" class="validate" size="2" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '')" onchange="defineActualWeight(this)" style="text-align: right"></td>`
        html += `<td><input type="text" name="bk_dimensi_H[]" class="validate" size="2" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '')" onchange="defineActualWeight(this)" style="text-align: right"></td>`
        html += `<td><input type="text" name="bk_volume_weight[]" class="validate" size="2" style="text-align: right" readonly></td>`
        html += `<td><input type="text" name="bk_weight[]" class="validate" size="2" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '')" onchange="defineActualWeight(this)" style="text-align: right"></td>`
        html += `<td><input type="text" name="bk_actual_weight[]" class="validate" size="2" style="text-align: right"></td>`
        html += `<td><?= form_dropdown('bk_type_pac[]', $packinglist, '', ''); ?></td>`
        html += `<td><div class="input-field"><input type="text" name="bk_surcharge_list[]" class="autocomplete"></div></td>`
        html += `<td><a id="addRow" class="fa fa-plus"></span></a>&nbsp;<a id="removeRow" class="red-text"><span class="fa fa-minus"></span></a></td>`
        html += `</tr>`

        $(this).parents('tbody').append(html)
        var surcharges = document.getElementsByName('bk_surcharge_list[]')[document.getElementsByName('bk_surcharge_list[]').length - 1]
        if (['GENCO REGULAR / NORMAL', undefined, ''].includes($(`input[name='bk_surcharge_list[]']`).eq(0).val())) {
            var surchargeslist = $.ajax({
                url: `<?= base_url() ?>master/mastersurcharges/autocomplete`,
                global: false,
                async: false,
                success: function (data) {
                    return data
                }
            }).responseJSON
        } else {
            var surchargeslist = new Map()
            surchargeslist.set('GENCO REGULAR / NORMAL', null)
            surchargeslist.set($(`input[name='bk_surcharge_list[]']`).eq(0).val(), null)
            surchargeslist = Object.fromEntries(surchargeslist)
        }
        M.Autocomplete.init(surcharges, {
            data: surchargeslist,
            minLength: 0,
        })
        $('select').formSelect()

        calculateColly()
        totalWeightActual()
        totalWeight()
        totalVolume()
    }

    function defineActualWeight(e) {
        var row = e.parentNode.parentNode
        calculateGoods(row)
        totalWeightActual()
        totalWeight()
        totalVolume()
    }

    function calculateGoods(row) {
        var dimensional_L = isNaN(parseInt(row.children[1].children[0].value)) ? 0 : parseInt(row.children[1].children[0].value)
        var dimensional_W = isNaN(parseInt(row.children[2].children[0].value)) ? 0 : parseInt(row.children[2].children[0].value)
        var dimensional_H = isNaN(parseInt(row.children[3].children[0].value)) ? 0 : parseInt(row.children[3].children[0].value)
        var dimensional_weight = isNaN(parseInt(row.children[5].children[0].value)) ? 0 : parseInt(row.children[5].children[0].value)
        var customer_information = JSON.parse(`<?= json_encode($account_customer) ?>`)
        var transport = 'UDARA'
        var volume = JSON.parse(`<?= json_encode((array)$volumelist) ?>`)
        var volumeSatuan = volume.filter((v) => v.volumeField === transport)[0].volumeSatuan
        var volume_weight = (dimensional_L * dimensional_W * dimensional_H) / volumeSatuan
        var actual_weight = 0
        var custWeightActual = parseInt(customer_information.custWeightActual)
        var custWeightRound = parseInt(customer_information.custWeightRound)
        var custWeightRoundValue = parseFloat(customer_information.custWeightRoundValue).toFixed(2)

        if (custWeightActual || dimensional_weight > volume_weight) {
            actual_weight = dimensional_weight
            if (custWeightRound && custWeightRoundValue > 0) {
                actual_weight = custom_round(dimensional_weight, custWeightRoundValue)
            } else if (custWeightRound) {
                actual_weight = Math.round(dimensional_weight)
            }
        } else {
            actual_weight = volume_weight
            if (custWeightRound && custWeightRoundValue > 0) {
                actual_weight = custom_round(volume_weight, custWeightRoundValue)
            } else if (custWeightRound) {
                actual_weight = Math.round(volume_weight)
            }
        }

        row.children[4].children[0].value = parseFloat(volume_weight).toFixed(2)
        row.children[6].children[0].value = parseFloat(actual_weight).toFixed(2)
    }

    function calculateColly() {
        var data = $("input[name='bk_colly[]'")
        var colly = []

        for (var i = 0; i < data.length; i++) {
            colly.push(parseInt(data.eq(i).val()))
        }

        $("#bk_total_colly").val(colly.reduce((a, b) => a + b))
    }

    function custom_round(number, initialdigit) {
        var nilai_real = parseInt(numbers)
        var nilai_decimal = parseFloat((numbers % 1).toFixed(2))
        var nilai_akhir = nilai_real
        var initialdigit = parseFloat(initialdigit.toFixed(2))

        if (initialdigit > 0) {
            if ((nilai_decimal * 100) > (initialdigit * 100)) {
                nilai_akhir += 1
            }
        }

        if (parseFloat(numbers) > 0 && parseFloat(numbers) < 1) {
            nilai_akhir = 1
        }
        return nilai_akhir
    }

    function totalWeightActual() {
        var rowTotal = document.querySelectorAll(`input[type='text'][name='bk_actual_weight[]']`)
        var total_weight_actual = loopRow(rowTotal)

        $('#bk_total_weight').val(total_weight_actual)
    }

    function totalWeight() {
        var rowTotal = document.querySelectorAll(`input[type='text'][name='bk_weight[]'`)
        var total_weight = loopRow(rowTotal)

        $('#bk_total_actual').val(total_weight)
    }

    function totalVolume() {
        var rowTotal = document.querySelectorAll(`input[type='text'][name='bk_volume_weight[]'`)
        var total_volume = loopRow(rowTotal)

        $('#bk_total_volume').val(total_volume)
    }

    function loopRow(rowTotal) {
        var total = []

        for (var i = 0; i < rowTotal.length; i++) {
            total.push(isNaN(parseFloat(rowTotal[i].value)) ? 0 : parseFloat(rowTotal[i].value))
        }

        return parseFloat(total.reduce((a, b) => a + b)).toFixed(2)
    }
</script>
<style>
    .validate {
        height: 0rem;
    }
</style>
