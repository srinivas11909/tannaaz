// $ = jQuery.noConflict();

function initPostingForm(){
	$(document).on('change','.cat-drpdwn',function(){
		var categoryId = $(this).val();
		console.log(categoryId);
		if(categoryId){
			$(this).closest('.form-group').find('.subcat-drpdwn').children().each(function(index,ele){
				if($(this).attr('categoryId') == categoryId){
					$(this).show();
				}
				else{
					$(this).hide();
				}
			});
		}
		else{
			$(this).closest('.form-group').find('.subcat-drpdwn').children().each(function(index,ele){
				$(this).show();
			});
		}
		$(this).closest('.form-group').find('.subcat-drpdwn').val('');
	});

	$(document).on('click','.addattr',function(){
		var selectedAttributes = $('.attr-opts').val();
		if(selectedAttributes && selectedAttributes.length > 0){
			for (var i = 0; i < selectedAttributes.length; i++) {
				var attributeId = selectedAttributes[i];
				console.log(attributeId);
				$('.smple-attr').find('.attr-div').attr("attributeId",attributeId);
				$('.smple-attr').find('.control-label').get(0).innerHTML = attributeList[attributeId]['attributeName'];
				$('.attr-cntner').append($('.smple-attr').find('.attr-div').get(0).outerHTML);
				$('.attr-opts').val("");
				$('.attr-opts').children().each(function(index,ele){
					if($(this).val() == attributeId){
						$(this).remove();
					}
				});
			}
		}
		if(submitClicked){
			validateCmsForm();
		}
	});
	$(document).on('click','.rmvattr',function(){
		var attrDiv = $(this).closest('.attr-div');
		var attributeId = attrDiv.attr('attributeId');
		attrDiv.remove();
		$('.attr-opts').prepend('<option value="attributeId">'+attributeList[attributeId]['attributeName']+'</option>');
		if(submitClicked){
			validateCmsForm();
		}
	});

	$(document).on('click','.btn-sbmt', function(){
		submitClicked = true;
		addListing();
	});

	$(document).on('change','.form-control', function(){
		if(submitClicked){
			validateCmsForm();	
		}
	});

	var submitClicked = false;

	function validateCmsForm(){
		var errors = false;
		var productName = $('#product-name').val().trim();
		if(productName == ""){
			errors = true;
			$('#product-name').addClass('error');
			$('#product-name_error').show();
		}
		else{
			$('#product-name').removeClass('error');
			$('#product-name_error').hide();
		}
		var productDesc = $('#product-desc').val().trim();
		if(productDesc == ""){
			errors = true;
			$('#product-desc').addClass('error');
			$('#product-desc_error').show();
		}
		else{
			$('#product-desc').removeClass('error');
			$('#product-desc_error').hide();
		}
		var category = $('.cat-drpdwn').val();
		if(category == ''){
			errors = true;
			$('.cat-drpdwn').addClass('error');
			$('#cat-drpdwn_error').show();
		}
		else{
			$('.cat-drpdwn').removeClass('error');
			$('#cat-drpdwn_error').hide();
		}
		var subcategory = $('.subcat-drpdwn').val();
		if(subcategory == ''){
			errors = true;
			$('.subcat-drpdwn').addClass('error');
			$('#subcat-drpdwn_error').show();
		}
		else{
			$('.subcat-drpdwn').removeClass('error');
			$('#subcat-drpdwn_error').hide();
		}

		if($('.attr-cntner').find('.attr-div').length == 0){
			errors = true;
			$('.attr-opts').addClass('error');
			$('#attr-opts_error').show();
		}
		else{
			$('.attr-opts').removeClass('error');
			$('#attr-opts_error').hide();	
		}
		return errors;
	}

	function addListing(){
		var errorsPresent = validateCmsForm();
		if(!errorsPresent){
			var postData = {};
			postData['productName'] = $('#product-name').val().trim();
			postData['productDesc'] = $('#product-desc').val().trim();
			postData['category'] = $('.cat-drpdwn').val();
			postData['subcategory'] = $('.subcat-drpdwn').val();

			var attributes = {};
			$('.attr-cntner').find('.attr-div').each(function(index,ele){
				var attributeId = $(this).attr('attributeId');
				var attribute = {};
				attribute['val1'] = $(this).find('input.val1').val();
				attribute['val2'] = $(this).find('input.val2').val();
				attribute['val3'] = $(this).find('input.val3').val();

				attributes[attributeId] = attribute;
			});
			postData['attributes'] = attributes;
			console.log(postData);

			makeCustomAjaxCall('/cmsPosting/saveListing',postData, 'addListingCallback');
		}
	}

	function addListingCallback(){

	}
}

var makeCustomAjaxCall = function(methodUrl, postParams, callBack, callBackCustomParams) {
  var params = {};
  for(var key in postParams){
        if(postParams.hasOwnProperty(key)){
      params[key] = postParams[key];
        }
    }
  var request = $.ajax({
    url   : methodUrl,
    type  : "POST",
    data  : params
  });
  request.done(function(data) {
    if (typeof callBack != 'undefined' && callBack != '') {
      var fn = window[callBack];
      var response = eval('(' + data + ')');
      if(typeof fn === 'function') {
        fn(response, callBackCustomParams);
      }
    }
  });
  request.fail(function(xhrObject, status){});
}