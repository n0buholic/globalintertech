jQuery.validator.addMethod("karakter01", function(value, element) {
	return this.optional(element) || /^([A-Za-z0-9]+)$/.test(value);
}, "karakter salah");