<div class="container">
    <div class="content-padded">
        <h3><i class="fa fa-vr-cardboard"></i>&nbsp; Port to Port</h3>
    </div>
    <div class="card">
        <div class="card-content">
            <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
                <li class="tab"><a href="#test1">Report Booking PTP</a></li>
                <li class="tab"><a href="#test2">Report Reservation</a></li>
            </ul>
            <div id="test1" class="col s12">
                <div class="card">
                    <div class="card-title">
                        <div class="row">
                            <div class="col 2">
                                <label>Start Date</label>
                            </div>
                            <div class="col 4">
                                <label><input type="date" name="start_date_booking" id="start_date_booking" class="validate" value="<?= date('Y-m-d') ?>"></label>
                            </div>
                            <div class="col 2">
                                <label>End Date</label>
                            </div>
                            <div class="col 4">
                                <label><input type="date" name="end_date_booking" id="end_date_booking" class="validate" value="<?= date('Y-m-d') ?>"></label>
                            </div>
                            <a class="btn" id="bk_search_booking">Search</a>
                        </div>
                    </div>
                    <div class="card-content">
                        <table id="bookingTable" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>No</th>
                                <th>Booking Code</th>
                                <th>Booking Date</th>
                                <th>Shipper Name</th>
                                <th>Shipper Contact</th>
                                <th>Org</th>
                                <th>Consignee Name</th>
                                <th>Dest</th>
                                <th>Colly</th>
                                <th>Actual Weight</th>
                                <th>Volume Weight</th>
                                <th>Chargeable Weight</th>
                                <th>Service</th>
                                <th>Flight / Schedule Request</th>
                                <th>Nature Of Goods - NOG</th>
                                <th>SHC</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div id="test2" class="col s12">
                <div class="card">
                    <div class="card-title">
                        <div class="row">
                            <div class="col 2">
                                <label>Start Date</label>
                            </div>
                            <div class="col 4">
                                <label><input type="date" name="start_date" id="start_date" class="validate" value="<?= date('Y-m-d') ?>"></label>
                            </div>
                            <div class="col 2">
                                <label>End Date</label>
                            </div>
                            <div class="col 4">
                                <label><input type="date" name="end_date" id="end_date" class="validate" value="<?= date('Y-m-d') ?>"></label>
                            </div>
                            <a class="btn" id="bk_search">Search</a>
                        </div>
                    </div>
                    <div class="card-content">
                        <table id="reportTable" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>No</th>
                                <th>Connote</th>
                                <th>Line Haul Number</th>
                                <th>Booking Code</th>
                                <th>Booking Date</th>
                                <th>Shipper Name</th>
                                <th>Shipper Contact</th>
                                <th>Org</th>
                                <th>Consignee Name</th>
                                <th>Dest</th>
                                <th>Colly</th>
                                <th>Actual Weight</th>
                                <th>Volume Weight</th>
                                <th>Chargeable Weight</th>
                                <th>Nature of Goods</th>
                                <th>Flight / Schedule Request</th>
                                <th>SHC</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($extra_js)):
    foreach($extra_js as $x_js):
        echo'<script type="text/javascript" src="'.site_url("assets/js/".$x_js."").'"></script>';
    endforeach;
endif;
?>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<script>
    function template(child) {
        var template = `<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">`
        template += `<thead>`
        template += `<tr>`
        template += `<td style="text-align: center">Length</td>`
        template += `<td style="text-align: center">Width</td>`
        template += `<td style="text-align: center">Height</td>`
        template += `<td style="text-align: center">Volume Weight</td>`
        template += `<td style="text-align: center">Actual Weight</td>`
        template += `<td style="text-align: center">Chargeable Weight</td>`
        template += `<tr>`
        template += `</thead>`
        template += `<tbody>`
        Object.keys(child).forEach((val) => {
            template += `<tr>`
            template += `<td style="text-align: right">${child[val].bkDimensi_L}</td>`
            template += `<td style="text-align: right">${child[val].bkDimensi_W}</td>`
            template += `<td style="text-align: right">${child[val].bkDimensi_H}</td>`
            template += `<td style="text-align: right">${child[val].bkVolumeWeight}</td>`
            template += `<td style="text-align: right">${child[val].bkWeight}</td>`
            template += `<td style="text-align: right">${child[val].bkActualWeight}</td>`
            template += `<tr>`
        })
        template += `</tbody>`
        template += `</table>`
        return (template)
    }
</script>
<script>
    $('.tabs').tabs()
    function formatChild(d) {
        var child = $.ajax({
            url: `ptpreport/getChildDetail`,
            type: `POST`,
            data: {bkCodeId: d.bkCodeId},
            global: false,
            async: false,
            success: function (response) {
                return response
            }
        }).responseJSON
        return template(child)
    }

    $("#reportTable").on("click", "tbody td.dt-control", function () {
        var tr = $(this).closest('tr')
        var row = tblReport.row(tr)

        if (row.child.isShown()) {
            row.child.hide()
            tr.removeClass('shown')
        } else {
            row.child(formatChild(row.data())).show()
            tr.addClass('shown')
        }
    })
    var tblReport = $("#reportTable").DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        info: false,
        scrollX: true,
        responsive: false,
        lengthChange: false,
        deferRender: true,
        ajax: {
            type: "POST",
            url: "<?= base_url() . 'ptpreport/dataTablesReservation' ?>",
            data: function (e) {
                e.start_date = $("#start_date").val()
                e.end_date = $("#end_date").val()
            },
        },
        columns: [
            {
                className: 'dt-control',
                orderable: false,
                data: null,
                defaultContent: '',
            },
            {
                searchable: false,
                data: function (row, type, val, meta)
                {
                    return meta.row + 1
                }
            },
            {data: 'trnNumberAwb'},
            {data: 'trnSmuNumber'},
            {data: 'trnReffInstruction'},
            {data: 'trnDate'},
            {data: 'trnShipperName'},
            {data: 'trnShipperContact'},
            {data: 'trnBranch'},
            {data: 'trnConsigneeName'},
            {data: 'trnDestination'},
            {data: 'trnRequestColi'},
            {data: 'trnWeight'},
            {data: 'trnsVolumeKg'},
            {data: 'trnsActualKg'},
            {data: 'trnContentsOfGoods'},
            {data: 'trnSpecialInstruction'},
            {data: 'trnCodeSubCharges'},
            {data: function (row, type, val, meta)
                {
                    return (parseInt(row.trnVoidFlag)) ? 'Void' : 'Active'
                }
            }
        ],
        order: [[1, 'asc']]
    })
    new $.fn.dataTable.Buttons(tblReport,  {
        buttons: [
            {
                text: 'New Booking',
                className: 'btn',
                action: function ( e, dt, node, config ) {
                    window.location.href = "ptp/create"
                }
            },
            {
                extend: 'collection',
                className: 'btn',
                text: 'Export',
                buttons: [
                    {
                        extend:    'copyHtml5',
                        text:      'Copy Table',
                        titleAttr: 'Copy'
                    },
                    {
                        extend:    'excelHtml5',
                        text:      '<i class="l-btn-icon eicon-excel"></i> Export ke Excel',
                        titleAttr: 'Excel'
                    },
                    {
                        extend:    'csvHtml5',
                        text:      '<i class="l-btn-icon eicon-csv"></i> Export ke CSV',
                        titleAttr: 'CSV'
                    },
                    {
                        extend:    'pdfHtml5',
                        text:      '<i class="l-btn-icon eicon-pdf"></i> Export ke PDF',
                        titleAttr: 'PDF'
                    }
                ]
            },
        ],
    })
    tblReport.buttons(0, null).container().insertBefore(
        $(".dataTables_filter")
    )
    document.getElementById('bk_search').addEventListener('click', function (e) {
        e.preventDefault()
        tblReport.ajax.reload()
    })
    document.getElementById('bk_search_booking').addEventListener('click', function (e) {
        e.preventDefault()
        tblBooking.ajax.reload()
    })
</script>
<script>
    var tblBooking = $("#bookingTable").DataTable({
        processing: true,
        serverSide: false,
        searching: true,
        info: false,
        scrollX: true,
        responsive: false,
        lengthChange: false,
        dom: 'Bfrtip',
        ajax: {
            type: "POST",
            url: "<?= base_url() . 'ptpreport/dataTablesBooking' ?>",
            data: function (e) {
                e.start_date = $("#start_date_booking").val()
                e.end_date = $("#end_date_booking").val()
            },
        },
        buttons: [
            {
                text: 'New Booking',
                className: 'btn',
                action: function ( e, dt, node, config ) {
                    window.location.href = "ptp/create"
                }
            },
            {
                extend: 'collection',
                className: 'btn',
                text: 'Export',
                buttons: [
                    {
                        extend:    'copyHtml5',
                        text:      'Copy Table',
                        titleAttr: 'Copy'
                    },
                    {
                        extend:    'excelHtml5',
                        text:      '<i class="l-btn-icon eicon-excel"></i> Export ke Excel',
                        titleAttr: 'Excel'
                    },
                    {
                        extend:    'csvHtml5',
                        text:      '<i class="l-btn-icon eicon-csv"></i> Export ke CSV',
                        titleAttr: 'CSV'
                    },
                    {
                        extend:    'pdfHtml5',
                        text:      '<i class="l-btn-icon eicon-pdf"></i> Export ke PDF',
                        titleAttr: 'PDF'
                    }
                ]
            },
        ],
        columns: [
            {
                className: 'dt-control',
                orderable: false,
                data: null,
                defaultContent: '',
            },
            {
                searchable: false,
                data: function (row, type, val, meta)
                {
                    return meta.row + 1
                }
            },
            {data: 'bkCodeId'},
            {data: 'bkBookingDate'},
            {data: 'bkShipperName'},
            {data: 'bkShipperContact'},
            {data: 'bkBranch'},
            {data: 'bkConsigneeName'},
            {data: 'bkDestination'},
            {data: 'bkTotalColly'},
            {data: 'actualWeight'},
            {data: 'volumeWeight'},
            {data: 'chargeableWeight'},
            {data: 'serviceName'},
            {data: 'bkSpecialInstruction'},
            {data: 'bkContentOfGoods'},
            {data: 'subCharge'},
        ],
        order: [[1, 'asc']],
    })

    $("#bookingTable").on("click", "tbody td.dt-control", function () {
        var tr = $(this).closest('tr')
        var row = tblBooking.row(tr)

        if (row.child.isShown()) {
            row.child.hide()
            tr.removeClass('shown')
        } else {
            row.child(formatChildBooking(row.data())).show()
            tr.addClass('shown')
        }
    })

    function formatChildBooking(d) {
        var child = $.ajax({
            url: `ptpreport/getChildDetailBooking`,
            type: `POST`,
            data: {bkCodeId: d.bkCodeId},
            global: false,
            async: false,
            success: function (response) {
                return response
            }
        }).responseJSON
        return template(child)
    }
</script>
<style>
    .validate {
        height: 0rem;
    }
</style>
