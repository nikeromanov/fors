jQuery.extend(jQuery.validator.messages, {
        required: "Это поле необходимо заполнить.",
        remote: "Пожалуйста, введите правильное значение.",
        email: "Пожалуйста, введите корретный адрес электронной почты.",
        url: "Пожалуйста, введите корректный URL.",
        date: "Пожалуйста, введите корректную дату.",
        dateISO: "Пожалуйста, введите корректную дату в формате ISO.",
        number: "Пожалуйста, введите число.",
        digits: "Пожалуйста, вводите только цифры.",
        creditcard: "Пожалуйста, введите правильный номер кредитной карты.",
        equalTo: "Пожалуйста, введите такое же значение ещё раз.",
        accept: "Пожалуйста, выберите файл с правильным расширением.",
        maxlength: jQuery.validator.format("Пожалуйста, введите не больше {0} символов."),
        minlength: jQuery.validator.format("Пожалуйста, введите не меньше {0} символов."),
        rangelength: jQuery.validator.format("Пожалуйста, введите значение длиной от {0} до {1} символов."),
        range: jQuery.validator.format("Пожалуйста, введите число от {0} до {1}."),
        max: jQuery.validator.format("Пожалуйста, введите число, меньшее или равное {0}."),
        min: jQuery.validator.format("Пожалуйста, введите число, большее или равное {0}.")
});
function conv_size(b){

	fsizekb = b / 1024;
    fsizemb = fsizekb / 1024;
	fsizegb = fsizemb / 1024;
	fsizetb = fsizegb / 1024;

	if (fsizekb <= 1024) {
        fsize = fsizekb.toFixed(3) + ' кб';
	} else if (fsizekb >= 1024 && fsizemb <= 1024) {
		fsize = fsizemb.toFixed(3) + ' мб';
	} else if (fsizemb >= 1024 && fsizegb <= 1024) {
		fsize = fsizegb.toFixed(3) + ' гб';
	} else {
		fsize = fsizetb.toFixed(3) + ' тб';
	}

    return fsize;

}
$(document).ready(function(){
	$(document).on("click",'[data-service]',function(){

		let lnk = $(this).attr("href");
		$(lnk).find('[name="service"]').val($(this).attr("data-service"));
	});
	$('.phone,[name="phone"]').inputmask("+7 (999) 999-99-99",{clearMaskOnLostFocus: true,clearIncomplete: true, showMaskOnHover:false });
	$(".standart_form").each(function(){
		$(this).validate({
                        rules:{
                                        email:{
                                                email:true
                                        },
                                        policy:{
                                                required:true
                                        }
                                },
                        submitHandler: function( form ){
				if( $( form ).valid() ){
					var dataf = new FormData();

					var form_data = $( form ).serializeArray();
					$.each(form_data, function (key, input) {
						dataf.append(input.name, input.value);
					});
					if($(form).find(".file_upload").length>0){
						$(form).find(".file_upload").each(function(){
							var file_data = $(this)[0].files;
							for (var i = 0; i < file_data.length; i++) {
								dataf.append("file", file_data[i]);
							}
						});
					}
                                        $.ajax({
                                                type: "POST",
                                                url: "/local/ajax/actions.php",
                                                data: dataf,
                                                processData: false,
                                                contentType: false,
                                        }).done(function( answ ){
						var data = JSON.parse(answ);
                                                if(data.result=="success"){
                                                        var formContainer = $(form).closest('.consult-form');
                                                        var successBlock = formContainer.find('.consult-form__success');
                                                        var countdownValue = successBlock.find('.consult-form__success-countdown-value');

                                                        var previousTimeout = formContainer.data('successHideTimeout');
                                                        var previousInterval = formContainer.data('successCountdownInterval');

                                                        if(previousTimeout){
                                                                clearTimeout(previousTimeout);
                                                        }

                                                        if(previousInterval){
                                                                clearInterval(previousInterval);
                                                        }

                                                        $(form).find('.answer_form').html("");

                                                        if(formContainer.length>0 && successBlock.length>0){
                                                                var countdownSeconds = 3;

                                                                formContainer.addClass('consult-form--success');
                                                                successBlock.addClass('is-visible');
                                                                successBlock.attr('aria-hidden','false');

                                                                if(countdownValue.length>0){
                                                                        countdownValue.text(countdownSeconds);

                                                                        var countdownInterval = setInterval(function(){
                                                                                countdownSeconds -= 1;

                                                                                if(countdownSeconds >= 0){
                                                                                        countdownValue.text(countdownSeconds);
                                                                                }

                                                                                if(countdownSeconds <= 0){
                                                                                        clearInterval(countdownInterval);
                                                                                }
                                                                        },1000);

                                                                        formContainer.data('successCountdownInterval', countdownInterval);
                                                                }

                                                                var successHideTimeout = setTimeout(function(){
                                                                        if(countdownValue.length>0){
                                                                                countdownValue.text('0');
                                                                        }

                                                                        var savedInterval = formContainer.data('successCountdownInterval');

                                                                        if(savedInterval){
                                                                                clearInterval(savedInterval);
                                                                        }

                                                                        successBlock.removeClass('is-visible');
                                                                        successBlock.attr('aria-hidden','true');
                                                                        formContainer.removeClass('consult-form--success');

                                                                        formContainer.removeData('successHideTimeout');
                                                                        formContainer.removeData('successCountdownInterval');
                                                                },3000);

                                                                formContainer.data('successHideTimeout', successHideTimeout);
                                                        }else{
                                                                $(form).find('.answer_form').append(data.message);
                                                        }

                                                        $(form).find('input[type="text"]').val('');
                                                        $(form).find('input[type="tel"]').val('');
                                                        $(form).find('input[type="email"]').val('');
                                                        $(form).find('input[type="checkbox"]').prop('checked', false);
                                                        $(form).find('textarea').val('');

                                                        if($(form).hasClass('cars-gallery__contact-form') && typeof ym === 'function'){
                                                                ym(11787892, 'reachGoal', 'form_car');
                                                        }


                                                }else{
                                                        $(form).find('.answer_form').html("");
                                                        $(form).find('.answer_form').append(data.message);
                                                }

						
					}).fail(function() {
						console.log('error!!!');
						
					});
					
				}
			},
			 errorPlacement: function (error, element) {

					var customError = $([
						'<div class="invalid-feedback">',
						'  <span class="error-box">',
						'',
						'  </span>',
						'</div>'
					].join(""));

					// Add `form-error-message` class to the error element
					error.addClass("form-error-message");

					// Insert it inside the span that has `mb-0` class
					error.appendTo(customError.find('.error-box'));

					// Insert your custom error
					customError.insertBefore(element);
				},focusInvalid: true,
				highlight: function (element, errorClass, validClass) {
					$(element).addClass('is-invalid');
					$(element).closest('.form_line').find('.invalid-feedback').remove();
					$(element).closest('.invalid-feedback').remove();
				},
				unhighlight: function (element, errorClass, validClass) {
					$(element).removeClass('is-invalid');
					$(element).closest('.form_line').find('.invalid-feedback').remove();
					$(element).closest('.invalid-feedback').remove();
				},
		} );
	});
});
