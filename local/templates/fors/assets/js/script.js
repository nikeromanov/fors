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
		var serviceValue = $(this).attr("data-service");
		var goalValue = $(this).attr("data-goal");
		window._lastMetrikaGoal = goalValue ? goalValue : "";
		window._lastMetrikaService = serviceValue ? serviceValue : "";
		var targetForm = $(lnk);
		targetForm.find('[name="service"]').val(serviceValue);
		if(targetForm.find('[name="goal"]').length === 0){
			targetForm.append('<input type="hidden" name="goal" value="">');
		}
		targetForm.find('[name="goal"]').val(goalValue ? goalValue : "");
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
                                                dataType: "json",
                                        }).done(function( answ ){
						var data = answ || {};
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

                                                                var formServiceValue = ($(form).find('[name="service"]').val() || '').toString().trim();
        var formGoalValue = ($(form).find('[name="goal"]').val() || '').toString().trim();
        if (!formGoalValue && window._lastMetrikaGoal) {
                formGoalValue = window._lastMetrikaGoal;
        }
        if (!formServiceValue && window._lastMetrikaService) {
                formServiceValue = window._lastMetrikaService;
        }
        var locationPath = window.location && window.location.pathname ? window.location.pathname : '';
        var normalizedLocationPath = locationPath ? locationPath.replace(/\/+$/, '') + '/' : '';
        var isCategoryRootPage = normalizedLocationPath === '/category/';

        var goalByPathMap = {
                '/category/kategoriya-a/': 'form_A',
                '/category/kategoriya-a1/': 'form_A1',
                '/category/kategoriya-v-v1/': 'form_B',
                '/category/kategoriya-c-s1/': 'form_C',
                '/category/kategoriya-d-d1/': 'form_D',
                '/category/kategoriya-e/': 'form_E',
                '/category/kategoriya-m/': 'form_M',
                '/category/kategoriya-kvadrotsikly/': 'form_kvadro',
                '/category/pereobuchenie-s-v-na-s/': 'form_BC',
                '/category/pereobuchenie-s-v-na-d-s-s-na-d/': 'form_CD',
                '/gifts/': 'form_sert'
        };

        var activeCategoryService = '';
        var activeCategoryGoal = '';
        if (isCategoryRootPage) {
                activeCategoryService = ($('.categories__slider .swiper-slide-active [data-service]').first().attr('data-service') || '').toString().trim();
                var activeCategoryTitle = $('.categories__slider .swiper-slide-active .price-card__title').first().text();
                var activeCategoryLink = $('.categories__slider .swiper-slide-active .price-card__title').first().attr('href') || '';
                var activeCategoryPath = activeCategoryLink ? activeCategoryLink.replace(/\/+$/, '') + '/' : '';
                activeCategoryGoal = goalByPathMap[activeCategoryPath] ? goalByPathMap[activeCategoryPath] : '';

                if (!formServiceValue && (activeCategoryService || activeCategoryTitle)) {
                        formServiceValue = (activeCategoryService || activeCategoryTitle || '').toString().trim();
                }
                if (!formGoalValue && activeCategoryGoal) {
                        formGoalValue = activeCategoryGoal;
                }
        }

        var normalizedServiceValue = formServiceValue
                .toLowerCase()
                .replace(/a/g, 'а')
                .replace(/b/g, 'в')
                .replace(/c/g, 'с')
                .replace(/d/g, 'д')
                .replace(/e/g, 'е')
                .replace(/k/g, 'к')
                .replace(/m/g, 'м')
                .replace(/n/g, 'н')
                .replace(/o/g, 'о')
                .replace(/p/g, 'р')
                .replace(/v/g, 'в');
        var hasServiceValue = normalizedServiceValue.length > 0;
        var isCategoryA1Service = normalizedServiceValue.indexOf('категория а1') !== -1 || normalizedServiceValue.indexOf('категории а1') !== -1;
        var isCategoryAService = (normalizedServiceValue.indexOf('категория а') !== -1 || normalizedServiceValue.indexOf('категории а') !== -1) && !isCategoryA1Service;
        var isCategoryBService = normalizedServiceValue.indexOf('категория в') !== -1 || normalizedServiceValue.indexOf('категории в') !== -1;
        var isCategoryCService = normalizedServiceValue.indexOf('категория с') !== -1 || normalizedServiceValue.indexOf('категории с') !== -1;
        var isCategoryDService = normalizedServiceValue.indexOf('категория д') !== -1 || normalizedServiceValue.indexOf('категории д') !== -1;
        var isCategoryEService = normalizedServiceValue.indexOf('категория е') !== -1 || normalizedServiceValue.indexOf('категории е') !== -1;
        var isCategoryMService = normalizedServiceValue.indexOf('категория м') !== -1 || normalizedServiceValue.indexOf('категории м') !== -1;
        var isCategoryKvadroService = normalizedServiceValue.indexOf('квадроцик') !== -1 || normalizedServiceValue.indexOf('квадрацик') !== -1;
        var isCategoryBCService = normalizedServiceValue.indexOf('переобучение с в на с') !== -1;
        var isCategoryCDService = normalizedServiceValue.indexOf('переобучение с в на д') !== -1 || normalizedServiceValue.indexOf('переобучение с с на д') !== -1;
        var isGiftCertificateService = normalizedServiceValue.indexOf('подарочн') !== -1;

        var shouldUsePageFallback = !hasServiceValue;
        var isCategoryAPage = shouldUsePageFallback && normalizedLocationPath === '/category/kategoriya-a/';
        var isCategoryA1Page = shouldUsePageFallback && normalizedLocationPath === '/category/kategoriya-a1/';
        var isCategoryBPage = shouldUsePageFallback && normalizedLocationPath === '/category/kategoriya-v-v1/';
        var isCategoryCPage = shouldUsePageFallback && normalizedLocationPath === '/category/kategoriya-c-s1/';
        var isCategoryDPage = shouldUsePageFallback && normalizedLocationPath === '/category/kategoriya-d-d1/';
        var isCategoryEPage = shouldUsePageFallback && normalizedLocationPath === '/category/kategoriya-e/';
        var isCategoryMPage = shouldUsePageFallback && normalizedLocationPath === '/category/kategoriya-m/';
        var isCategoryKvadroPage = shouldUsePageFallback && normalizedLocationPath === '/category/kategoriya-kvadrotsikly/';
        var isCategoryBCPage = shouldUsePageFallback && normalizedLocationPath === '/category/pereobuchenie-s-v-na-s/';
        var isCategoryCDPage = shouldUsePageFallback && normalizedLocationPath === '/category/pereobuchenie-s-v-na-d-s-s-na-d/';
        var isGiftsPage = shouldUsePageFallback && normalizedLocationPath === '/gifts/';

        if(typeof ym === 'function'){
                var isConsultForm = $(form).hasClass('consult-form__form');

                var pagePath = window.location && window.location.pathname ? window.location.pathname : '';
                var logGoal = function(goalName){
                        if(!goalName){
                                return;
                        }
                        var now = new Date();
                        var pad = function(num){ return String(num).padStart(2, '0'); };
                        var stamp = now.getFullYear() + '-' + pad(now.getMonth() + 1) + '-' + pad(now.getDate())
                                + ' ' + pad(now.getHours()) + ':' + pad(now.getMinutes()) + ':' + pad(now.getSeconds());
                        console.log('[metrika goal]', stamp, 'goal=' + goalName, 'page=' + pagePath);
                };

                if(formGoalValue){
                        ym(11787892, 'reachGoal', formGoalValue);
                        logGoal(formGoalValue);
                }else if(isCategoryA1Service || isCategoryA1Page){
                        ym(11787892, 'reachGoal', 'form_A1');
                        logGoal('form_A1');
                }else if(isCategoryAService || isCategoryAPage){
                        ym(11787892, 'reachGoal', 'form_A');
                        logGoal('form_A');
                }else if(isGiftCertificateService || isGiftsPage){
                        ym(11787892, 'reachGoal', 'form_sert');
                        logGoal('form_sert');
                }else if(isCategoryBCService || isCategoryBCPage){
                        ym(11787892, 'reachGoal', 'form_BC');
                        logGoal('form_BC');
                }else if(isCategoryCDService || isCategoryCDPage){
                        ym(11787892, 'reachGoal', 'form_CD');
                        logGoal('form_CD');
                }else if(isCategoryBService || isCategoryBPage){
                        ym(11787892, 'reachGoal', 'form_B');
                        logGoal('form_B');
                }else if(isCategoryCService || isCategoryCPage){
                        ym(11787892, 'reachGoal', 'form_C');
                        logGoal('form_C');
                }else if(isCategoryDService || isCategoryDPage){
                        ym(11787892, 'reachGoal', 'form_D');
                        logGoal('form_D');
                }else if(isCategoryEService || isCategoryEPage){
                        ym(11787892, 'reachGoal', 'form_E');
                        logGoal('form_E');
                }else if(isCategoryMService || isCategoryMPage){
                        ym(11787892, 'reachGoal', 'form_M');
                        logGoal('form_M');
                }else if(isCategoryKvadroService || isCategoryKvadroPage){
                        ym(11787892, 'reachGoal', 'form_kvadro');
                        logGoal('form_kvadro');
                }else if(isConsultForm){
                        ym(11787892, 'reachGoal', 'form_general');
                        logGoal('form_general');
                }

                                                                        if($(form).hasClass('cars-gallery__contact-form')){
                                                                                ym(11787892, 'reachGoal', 'form_car');
                                                                                logGoal('form_car');
                                                                        }

                                                                        if(window.location && (window.location.pathname === '/online-traning/' || window.location.pathname === '/online-traning')){
                                                                                ym(11787892, 'reachGoal', 'online_ok');
                                                                                logGoal('online_ok');
                                                                        }

                                                                        ym(11787892, 'reachGoal', 'all_form');
                                                                        logGoal('all_form');
                                                                }
                                                                $(form).find('[name="goal"]').val('');


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
