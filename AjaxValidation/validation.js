$(function () {
	$("#register-form").validate({
		rules: {
			username: {
				required: true,
				minlength: 3,
				maxlength: 10,
				specialchars: true
			},
			password: {
				required: true,
				chars: true,
				minlength: 6
			},
			passwordagain: {
				match: true
			}
		},
		messages: {
			username: {
				required: "Потребителското име е задължително поле.",
				minlength: "Моля въведете поне 3 символа.",
				maxlength: "Моля въведете най-много 10 символа.",
				specialchars: "Моля въведете само букви, цифри и _."
			},
			password: {
				required: "Паролата е задължително поле.",
				chars: "Паролата трябва да съдържа задължително поне 1 главна, 1 малка буква и 1 цифра.",
				minlength: "Паролата трябва да бъде поне 6 символа.",
			},
			passwordagain: {
				match: "Паролите трябва да съвпадат."
			},
		},

		submitHandler: function (form) {
			$.ajax({
				url: form.action,
				type: form.method,
				data: $(form).serialize(),
				dataType: "json",
				success: function (response) {
					alert(response.message);
					location.reload();
				}
			});
		}
	});

	jQuery.validator.addMethod("specialchars", function (value, element) {
		return this.optional(element) || /^[a-zA-Z_]+$/i.test(value);
	}, "Само букви, цифри и _.");
	jQuery.validator.addMethod("chars", function (value, element) {
		return this.optional(element) || /^[a-z]+[A-Z]+[0-9]+$/i.test(value);
	}, "Паролата трябва да съдържа задължително поне 1 главна, 1 малка буква и 1 цифра.");
	jQuery.validator.addMethod("match", function (value, element) {
		return this.password.value == this.passwordagain.value;
	}, "Паролите трябва да съвпадат.");
});
