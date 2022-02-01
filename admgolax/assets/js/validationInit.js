function formValidation() {
    "use strict";
    /*----------- BEGIN validationEngine CODE -------------------------*/
    $('#popup-validation').validationEngine();
    /*----------- END validationEngine CODE -------------------------*/

    /*----------- BEGIN validate CODE -------------------------*/
 
	$('#frm-add-teknisi').validate({
        rules: {
            nama_t: {
				required: true,
				maxlength: 40
			},
			kontak_t: {
				required: true,
				digits: true,
				minlength: 6,
				maxlength: 13
			},
			user_t: {
				required: true,
				minlength: 6,
				maxlength: 40
			},
			pass_t: {
				required: true,
				minlength: 6,
				maxlength: 15
			}
        },
        errorClass: 'help-block',
        errorElement: 'span',
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
        }
    });
    /*----------- END validate CODE -------------------------*/
	
	$('#frm-add-customer').validate({
        rules: {
            nama_br: {
				required: true,
				maxlength: 70
			},
			telp_br: {
				required: true,
				digits: true,
				minlength: 6,
				maxlength: 13
			},
			alamat_br: {
				required: true,
				maxlength: 250
			}			
        },
        errorClass: 'help-block',
        errorElement: 'span',
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
        }
    });
    /*----------- END validate CODE -------------------------*/
	
    $('#frm-login').validate({
        rules: {
            userax: {
				required: true,
				minlength: 6,
				maxlength: 40
			},
			passax: {
				required: true,
				minlength: 6,
				maxlength: 15
			},
			plh_gudang: "required",
			captcha: {
				required: true,
				minlength: 6,
				maxlength: 6,
				digits: true
			}
        },
        errorClass: 'help-block',
        errorElement: 'span',
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
        }
    });
    /*----------- END validate CODE -------------------------*/

	$('#uploadForm').validate({
        rules: {
			userImage: "required"
        },
        errorClass: 'help-block',
        errorElement: 'span',
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
        }
    });
    /*----------- END validate CODE -------------------------*/
	
	$('#form-profile').validate({
        rules: {
			user_adm: {
				required: true,
				minlength: 6,
				maxlength: 40
			},
			pass_adm: {
				required: true,
				minlength: 6,
				maxlength: 15
			}
        },
        errorClass: 'help-block',
        errorElement: 'span',
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
        }
    });
    /*----------- END validate CODE -------------------------*/

	$('#frm-block').validate({
        rules: {
			plh_kategori: "required",
			plh_type: "required",
			plh_brand: "required",
			karakter: {
				required: true,
				maxlength: 200
			},
			sub_keg: {
				required: true,
				maxlength: 800
			},
            judul: {
				required: true,
				maxlength: 70
			},
			memo: {
				required: true,
				maxlength: 300
			},
			harga: {
				required: true,
				digits: true,
				maxlength: 8
			},
			nominal: {
				required: true,
				digits: true,
				maxlength: 9
			},
			qty_return: {
				required: true,
				digits: true,
				maxlength: 4
			},
			harga1: {
				required: true,
				digits: true,
				maxlength: 8
			},
			desk: {
				required: true,
				maxlength: 1000
			},
			value150: {
				required: true,
				maxlength: 150
			},
			gambar: "required",
			nama_kar: {
				required: true,
				minlength: 6,
				maxlength: 40
			},
			so: {
				required: true,
				maxlength: 40
			},
			user_kar: {
				required: true,
				minlength: 6,
				maxlength: 40
			},
			pas_kar: {
				required: true,
				minlength: 6,
				maxlength: 12
			},
			value6_13: {
				required: true,
				digits: true,
				minlength: 6,
				maxlength: 13
			},
			id_cus: {
				required: true,
				maxlength: 6,
				minlength: 6
			},
			div_kar: "required",
			sts_cus: "required",
			sn_brg: {
				required: true,
				maxlength: 100
			},
			sn_baru: {
				required: true,
				maxlength: 100
			},
			kate_brg: {
				required: true,
				maxlength: 10
			},
			type_brg: {
				required: true,
				maxlength: 70
			},
			brand: "required",
			jenis: "required",
			file: "required",
			nama_cus: {
				required: true,
				maxlength: 80
			},
			almt_cus: {
				required: true,
				maxlength: 250
			},			
			kontak_cus: {
				required: true,
				digits: true,
				minlength: 10,
				maxlength: 13				
			},
			keluhan: {
				required: true,
				maxlength: 300
			},
			komplain: {
				required: true,
				maxlength: 300
			},
			ket_retur: {
				required: true,
				maxlength: 350
			},
			no_invoice: {
				required: true,
				maxlength: 25
			},
			no_return: {
				required: true,
				maxlength: 25
			},
			nm_cus: {
				required: true,
				maxlength: 80
			},
			email_cus: {
				required: true,
				email: true,
				maxlength: 70
			},
			alamat_cus: {
				required: true,
				maxlength: 250
			},
			plh_kate: {
				required: true,
				maxlength: 100
			},
			garansi: {
				required: true,
				digits: true
			},
			txt_kategori: {
				required: true,
				maxlength: 50
			},
			teknisi: {
				required: true,
				maxlength: 80
			},
			technician: {
				required: true,
				maxlength: 1000
			},
			diagnose: {
				required: true,
				maxlength: 1000
			},
			kegiatan: {
				required: true,
				maxlength: 800
			}
        },
        errorClass: 'help-block',
        errorElement: 'span',
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
        }
    });
	
	$('#frm-block-1').validate({
        rules: {
			komplain: {
				required: true,
				maxlength: 800
			},
			keterangan: {
				required: true,
				maxlength: 200
			},
			brand_brg: {
				required: true,
				maxlength: 30
			},
			kode_service: {
				required: true,
				maxlength: 12
			},
			nm_lokasi: {
				required: true,
				maxlength: 70
			},
			sn_brg: {
				required: true,
				maxlength: 100
			},
			no_invoice_1: {
				required: true,
				maxlength: 25
			},
			no_return_1: {
				required: true,
				maxlength: 25
			},
			ket_retur_1: {
				required: true,
				maxlength: 350
			},
			gambar: "required"
        },
        errorClass: 'help-block',
        errorElement: 'span',
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
        }
    });
	
	
	$('#frm-block-edt').validate({
        rules: {
			nm_lokasi_edt: {
				required: true,
				maxlength: 70
			},
			gambar_edt: "required"
        },
        errorClass: 'help-block',
        errorElement: 'span',
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
        }
    });
	
	$('#frm_add_produk').validate({
        rules: {
			gambar1: "required",
			gambar2: "required",
			gambar3: "required",
			type_prd: "required",
			harga: {
				required: true,
				digits: true,
				maxlength: 10
			},
			desk: {
				required: true,
				maxlength: 400
			}
        },
        errorClass: 'help-block',
        errorElement: 'span',
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
        }
    });
    /*----------- END validate CODE -------------------------*/
}