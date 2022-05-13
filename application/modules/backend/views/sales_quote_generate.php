<?php
$customer = json_decode($sales_quote->customer);
$products = json_decode($sales_quote->products);
$data = json_decode($sales_quote->data);
?>
<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            Sales Quote
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Data Customer</h5>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group mb-3">
                                <label for="">Nama</label>
                                <input type="text" class="form-control customer-input-editable" value="<?= $customer->name ?>" name="name">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-3">
                                <label for="">Telepon</label>
                                <input type="text" class="form-control customer-input-editable" value="<?= $customer->phone ?>" name="phone">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input type="text" class="form-control customer-input-editable" value="<?= $customer->email ?>" name="email">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="">Alamat</label>
                                <textarea class="form-control customer-input-editable" rows="3" name="address"><?= $customer->address ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Products</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="products" class="table table-striped border w-100">
                            <thead>
                                <tr>
                                    <th width="1"><button class="btn btn-primary btn-sm text-white add-product"><i class="fa fa-fw fa-plus-circle"></i></button></th>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Unit Price (Rp)</th>
                                    <th>Disc (%)</th>
                                    <th width="250">Sub-Total</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <button class="btn btn-primary  mb-3 save-generate-sales-quote float-end"> <i class="fa fa-save me-1"></i> Simpan Sales Quote</button>
        </div>
    </div>
</div>

<script>
    var data = <?= json_encode($data) ?>;
    var discount, discountType, tax;
    if (data) {
        discount = data.discount;
        discountType = data.discountType;
        tax = data.tax;
    } else {
        discount = 0;
        discountType = 1;
        tax = 11;
    }
    var products = <?= json_encode($products) ?>;
    var customer = <?= json_encode($customer) ?>;

    products = products.map(item => {
        item.isDeleted = false;
        return item;
    });

    $(".save-generate-sales-quote").on("click", function() {
        const data = new FormData();

        data.append("id", <?= $sales_quote->id ?>);
        data.append("customer", JSON.stringify(customer));
        data.append("products", JSON.stringify(products.map(item => {
            if (item.isDeleted) {
                return null;
            }
            return item;
        }).filter(item => item !== null)));
        data.append("data", JSON.stringify({
            discount: discount,
            discountType: discountType,
            tax: tax
        }));

        $.ajax({
            url: "<?= base_url("api/generate_sales_quote") ?>",
            type: "POST",
            data: data,
            contentType: false,
            processData: false,
            beforeSend: () => $.LoadingOverlay("show"),
            complete: () => $.LoadingOverlay("hide"),
            success: function(data) {
                if (data.success) {
                    Swal.fire({
                        title: "Berhasil",
                        text: data.message,
                        icon: "success",
                        confirmButtonText: "OK",
                    }).then(() => {
                        smoothState.load(data.data.redirect);
                    });
                } else {
                    Swal.fire({
                        title: "Gagal",
                        text: data.message,
                        icon: "error",
                    });
                }
            }
        });
    });

    $(document).ready(function() {
        renderProducts();
    });

    $(".customer-input-editable").on("keyup change", function() {
        customer[$(this).attr("name")] = $(this).val();
    });

    $(".add-product").on("click", function() {
        const product = {
            id: "",
            name: "",
            price: 0,
            qty: 1,
            discount: 0,
            description: ""
        }
        products.push(product);
        renderProducts();
    });

    $(document).on("keyup change", ".editable", function() {
        const index = $(this).parents("tr").data("index");
        const key = $(this).data("key");
        let value;
        if (key == "name" || key == "description") {
            value = $(this).val();
        } else {
            value = parseInt($(this).val().replace(/\./g, ""));
        }
        products[index][key] = value;
        const updatedProduct = products[index];
        const total = (updatedProduct.price * updatedProduct.qty) - (updatedProduct.price * updatedProduct.qty * (updatedProduct.discount ? updatedProduct.discount : 0) / 100).toFixed(0);

        $(`tr[data-index=${index}] .total-price`).val(
            formatRupiah(total)
        ).trigger("change");

        updateTotal();
    });

    $(document).on("keyup change", ".discount-sales-quote", function() {
        if ($(this).val() == "") {
            discount = 0;
        } else {
            discount = parseInt($(this).val().replace(/\./g, ""));
        }
        updateTotal();
    });

    $(document).on("change", ".discount-type", function() {
        discountType = $(this).val();
        $(".discount-sales-quote").val("0").trigger("change");
        updateDiscountType();
        updateTotal();
    });

    $(document).on("click", ".delete-product", function() {
        const index = $(this).parents("tr").data("index");
        products[index].isDeleted = true;
        $(this).parents("tr").remove();
        updateTotal();
    })

    function updateTotal() {
        const subTotal = products.reduce(function(acc, item) {
            if (!item.isDeleted) {
                return acc + (item.price * item.qty) - (item.price * item.qty * (item.discount ? item.discount : 0) / 100).toFixed(0);
            } else {
                return acc;
            }
        }, 0);

        let discountValue = 0;
        if (discountType == 1) {
            discountValue = subTotal * (discount / 100);
        } else {
            discountValue = discount.toFixed(0);
        }

        const ttax = (subTotal * (tax / 100))

        $(".tax-sales-quote").val(formatRupiah(ttax.toFixed(0))).trigger("change");

        const total = subTotal - discountValue;

        $(".sub-total-sales-quote").val(formatRupiah(subTotal.toFixed(0))).trigger("change");
        $(".total-sales-quote").val(formatRupiah(total.toFixed(0))).trigger("change");
    }

    function renderProducts() {
        const table = $("#products tbody");
        table.empty();
        $.each(products, function(index, value) {
            if (!value.isDeleted) {
                $('#products tbody').append(`
                <tr data-index="${index}">
                    <td>
                        <button class="btn btn-danger btn-sm text-white delete-product"><i class="fa fa-fw fa-trash"></i></button>
                    </td>
                    <td><input data-key="name" class="form-control editable" value="${value.name}" style="min-width: 250px;"></td>
                    <td>
                        <textarea data-key="description" class="form-control editable" style="min-width: 250px; height: 64px !important;">${value.description}</textarea>
                    </td>
                    <td><input data-key="qty" class="form-control editable" value="${value.qty}" style="min-width: 50px;"></td>
                    <td><input data-key="price" class="form-control mask-rupiah editable" value="${value.price}" style="min-width: 100px;"></td>
                    <td><input data-key="discount" class="form-control editable" value="${value.discount}" style="min-width: 70px;"></td>
                    <td><input class="form-control mask-rupiah total-price" value="${(value.price * value.qty) - ((value.price * value.qty) * value.discount / 100)}" style="min-width: 100px;" disabled></td>
                </tr>
            `);
            }
        });

        if (!$(".total-sales-quote").length) {
            $("#products tfoot").append(`
            <tr>
                <td colspan="6" class="text-end fw-bold">
                    Sub-Total
                </td>
                <td>
                    <input type="text" class="form-control mask-rupiah sub-total-sales-quote" value="0" style="min-width: 100px;" disabled>
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="6" class="text-end fw-bold">
                    Disc
                </td>
                <td>
                    <div class="input-group" style="min-width: 100px;">
                        <input type="text" class="form-control discount-sales-quote" value="${discount}">
                        <input type="radio" class="btn-check discount-type" name="discount-type" id="percent" value="1" ${discountType == 1 ? 'checked' : ''}>
                        <label class="btn btn-outline-danger" for="percent">%</label>

                        <input type="radio" class="btn-check discount-type" name="discount-type" id="amount" value="2" ${discountType == 2 ? 'checked' : ''}>
                        <label class="btn btn-outline-danger" for="amount">Rp</label>
                    </div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="6" class="text-end fw-bold">
                    TAX ${tax}%
                </td>
                <td>
                    <input type="text" class="form-control tax-sales-quote" value="0" style="min-width: 100px;" disabled>
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="6" class="text-end fw-bold">
                    Total
                </td>
                <td>
                    <input type="text" class="form-control mask-rupiah total-sales-quote" value="0" style="min-width: 100px;" disabled>
                </td>
                <td></td>
            </tr>
            `)
        }

        updateTotal();
        updateDiscountType();

        $(".mask-rupiah").mask("000.000.000.000.000", {
            reverse: true
        });
        $("[data-key=qty], [data-key=discount]").mask("000", {
            reverse: true
        });
    }

    function updateDiscountType() {
        if (discountType == 1) {
            $(".discount-sales-quote").mask("000", {
                reverse: true
            });
        } else {
            $(".discount-sales-quote").mask("000.000.000.000.000", {
                reverse: true
            });
        }
    }
</script>