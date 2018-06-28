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
	});

	$(document).on('click','.addattr',function(){
		var selectedAttributes = $('.attr-opts').val();
		if(selectedAttributes && selectedAttributes.length > 0){
			for (var i = 0; i < selectedAttributes.length; i++) {
				var attributeId = selectedAttributes[i];
				console.log(attributeId);
				$('.smple-attr').find('.attr-div').attr("attributeId",attributeId);
				$('.smple-attr').find('.control-label').get(0).innerHTML = attributeList[attributeId]['attributeName'];
				$('.attr-cntner').html($('.attr-cntner').html() + $('.smple-attr').find('.attr-div').get(0).outerHTML);
				$('.attr-opts').val("");
				$('.attr-opts').children().each(function(index,ele){
					if($(this).val() == attributeId){
						$(this).remove();
					}
				});
			}
		}
	});
	$(document).on('click','.rmvattr',function(){
		var attrDiv = $(this).closest('.attr-div');
		var attributeId = attrDiv.attr('attributeId');
		attrDiv.remove();
		$('.attr-opts').prepend('<option value="attributeId">'+attributeList[attributeId]['attributeName']+'</option>');
	});

	function addListing(event){
		console.log('submit clicked');
		return false;
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