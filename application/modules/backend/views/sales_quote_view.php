<?php
$customer = json_decode($sales_quote->customer);
$products = json_decode($sales_quote->products);
$data = json_decode($sales_quote->data);
?>
<!DOCTYPE html>
<html lang="en">
    <title>Quote-SQ-<?=sprintf('%06d', $sales_quote->id)?></title>
<link rel="stylesheet" href="<?= base_url("assets/backend/css/mpdf-bootstrap.css") ?>">
<style>
    .col-xs-1,
    .col-sm-1,
    .col-md-1,
    .col-lg-1,
    .col-xs-2,
    .col-sm-2,
    .col-md-2,
    .col-lg-2,
    .col-xs-3,
    .col-sm-3,
    .col-md-3,
    .col-lg-3,
    .col-xs-4,
    .col-sm-4,
    .col-md-4,
    .col-lg-4,
    .col-xs-5,
    .col-sm-5,
    .col-md-5,
    .col-lg-5,
    .col-xs-6,
    .col-sm-6,
    .col-md-6,
    .col-lg-6,
    .col-xs-7,
    .col-sm-7,
    .col-md-7,
    .col-lg-7,
    .col-xs-8,
    .col-sm-8,
    .col-md-8,
    .col-lg-8,
    .col-xs-9,
    .col-sm-9,
    .col-md-9,
    .col-lg-9,
    .col-xs-10,
    .col-sm-10,
    .col-md-10,
    .col-lg-10,
    .col-xs-11,
    .col-sm-11,
    .col-md-11,
    .col-lg-11,
    .col-xs-12,
    .col-sm-12,
    .col-md-12,
    .col-lg-12 {
        border: 0;
        padding: 0;
        margin-left: -0.00001;
    }

    .divider {
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    table tr th,
    table tr td {
        padding: 10px;

    }

    table tr th {
        background: #dadada;
    }

    table tr {
        margin: 0;
    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>

<body style="font-size: 10px; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif">
    <div>
        <div class="row">
            <div class="col-xs-2">
                Customer Detail
            </div>
            <div class="col-xs-10">
                <b><?= $customer->name ?></b><br>
                <?= $customer->address ?><br>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-2">
                Email
            </div>
            <div class="col-xs-10">
                <?= $customer->email ?><br>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-2">
                Phone
            </div>
            <div class="col-xs-10">
                <?= $customer->phone ?><br>
            </div>
        </div>
        <div class="divider"></div>
        <div class="row">
            <div class="col-12">
                <table style="width: 100%; padding: 0;" cellspacing="0" cellpadding="0">>
                    <thead>
                        <tr>
                            <th>Sales Rep</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?= @$sales_quote->name ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="divider"></div>
        <div class="row">
            <div class="col-12">
                <table style="width: 100%; padding: 0;" cellspacing="0" cellpadding="0">>
                    <thead>
                        <tr>
                            <th width="150">ITEM</th>
                            <th width="200">DESCRIPTION</th>
                            <th width="50" class="text-right">QUANTITY</th>
                            <th width="50" class="text-right">UNIT PRICE</th>
                            <th width="50" class="text-right">DISCOUNT</th>
                            <th width="50" class="text-right">SUB-TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) { ?>
                            <tr>
                                <td>
                                    <?= $product->name ?>
                                </td>
                                <td>
                                    <?= $product->description ?>
                                </td>
                                <td class="text-right">
                                    <?= $product->qty ?>
                                </td>
                                <td class="text-right">
                                    <?= $ctr->toRupiah($product->price) ?>
                                </td>
                                <td class="text-right">
                                    <?= $product->discount ?>%
                                </td>
                                <td class="text-right">
                                    <?= $ctr->toRupiah(($product->price * $product->qty) - (($product->price * $product->qty) * $product->discount / 100)) ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <?php
                    if (@$data) {
                        $subTotal = array_sum(array_map(function ($item) {
                            return $item->price * $item->qty;
                        }, $products));

                        $discountValue = 0;
                        if ($data->discountType == 1) {
                            $discountValue = $subTotal * $data->discount / 100;
                        } else {
                            $discountValue = $data->discount;
                        }
                    }
                    ?>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-right"><strong>SUB-TOTAL</strong></td>
                            <td class="text-right"><strong><?= $ctr->toRupiah($subTotal) ?></strong></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right"><strong>DISCOUNT (<?= $data->discountType == 1 ? "%" : "Rp" ?>)</strong></td>
                            <td class="text-right"><strong><?= $data->discountType == 1 ? "$data->discount%" : $ctr->toRupiah($data->discount) ?></strong></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right"><strong>TAX <?= $data->tax ?>%</strong></td>
                            <td class="text-right"><strong><?= $ctr->toRupiah($subTotal * ($data->tax / 100)) ?></strong></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right"><strong style="font-size: 12px;">TOTAL</strong></td>
                            <td class="text-right"><strong style="font-size: 12px;"><?= $ctr->toRupiah($subTotal - $discountValue) ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="divider"></div>
            <div class="col-xs-1">
                <strong>Remarks</strong>
            </div>
            <div class="col-xs-7">
                <div style="border: 1px solid black; padding: 10px;">
                    Syarat dan Ketentuan:<br>
                    <ol style="list-style: numeric; margin-left: 17px; padding-left: 0; margin-top: 5px; margin-bottom: 0;">
                        <li>Harga belum termasuk pajak 11%</li>
                        <li>Garansi alat 2 tahun (Produk Hikvision) dan pemasangan 90 Hari</li>
                        <li>Penawaran ini berlaku 15 Hari dari tanggal yg terteran diatas</li>
                        <li>Tidak termasuk Arde Grounding</li>
                        <li>Garansi tidak berlaku akibat Force Majeure</li>
                        <li>Perhitungan kabel menggunakan estimasi, dapat berubah setelah pemasangan</li>
                        <li>Pembayaran 50% setelah penawaran disetujui, 50% bila sudah terpasang dan berfungsi dengan baik</li>
                    </ol>
                </div>
            </div>
            <div class="col-xs-4">

            </div>
            <div class="col-xs-1">
                &nbsp;
            </div>
            <div class="col-xs-11">
                <p>BCA 7820306362 - Mandiri 0310088000800 - Bri 218201000573508 - Bni 8855588852 A.N Ronald Gunawan</p>
            </div>
        </div>
    </div>

</body>

</html>