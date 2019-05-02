$(function validate() {
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
				minlength: 6,
				chars: true
			},
			passwordagain: {
				required: true,
				equalTo: "#password"
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
				minlength: "Паролата трябва да бъде поне 6 символа."
			},
			passwordagain: {
				required: "Трябва да потвърдите паролата.",
				equalTo : "Паролите трябва да съвпадат."
			},
		},

		submitHandler: function (form) {
			$.ajax({
				url: form.action,
				type: form.method,
				data: $(form).serialize(),
				dataType: "json",
				success: function (response) {
					$("#register-form")[0].reset();
				}
			});
		}
	});

	jQuery.validator.addMethod("specialchars", function (value, element) {
		return this.optional(element) || /^[a-zA-Z0-9_]+$/i.test(value);
	}, "Само букви, цифри и _.");
	jQuery.validator.addMethod("chars", function (value, element) {
		return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{6,}$/i.test(value);
	}, "Паролата трябва да съдържа задължително поне 1 главна, 1 малка буква и 1 цифра.");
});