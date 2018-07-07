// $ = jQuery.noConflict();

function initPostingForm(){
	$(document).on('change','.cat-drpdwn',function(){
		var categoryId = $(this).val();
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

function uploadForm(input,file_type)
{
	if(input.files.length == 0) {
		alert('not selected');
          return false;
    }

    var selectedpdf = new FormData();
    var postUrl = "/CmsController/uploadPdf";
    if(file_type == 'img')
    {
      postUrl ="/CmsController/uploadMedia";
    }
    var FileList = input.files;
       for (var i = 0, length = FileList.length; i < length; i++) {
         selectedpdf.append("uploads[]",FileList.item(i), FileList.item(i).name);
    }
    $.ajax({
    	type : 'POST',
    	url : postUrl,
    	data : selectedpdf,
    	processData: false,
		contentType: false,
    	xhr: function () {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function (evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = evt.loaded / evt.total;
                                    percentComplete = parseInt(percentComplete * 100);
                                    $(input).parent().find('.progress-bar').text(percentComplete + '%');
                                    $(input).parent().find('.progress-bar').css('display','block');
                                    $(input).parent().find('.progress-bar').css('width', percentComplete + '%');
                                }
                            }, false);
                            return xhr;
                        },
    success : function(response){
    	response = JSON.parse(response);
        if(file_type == 'img')
        {
          uploadMultipleFiles(file_type,input,response);
        }
        else
        {
          uploadPdfForm(input,response);  
        }
    },
    error : function(jqXHR, textStatus, errorThrown)
    {
    	alert(errorThrown);
    	if(typeof file_type == 'undefined')
    	{
    		clearFileData('#samplepdf');
    	}
    	$(input).parent().find('.progress-bar').css('width', '0%');
    	$(input).parent().find('.progress-bar').css('display','none');
		return;
    } 
});
}

var uploadedImages = [];
function uploadMultipleFiles(file_type,object,response)
{
  //var response = uploadForm(object);
  if(response['data']['error'])
  {
    alert(response['data']['error']['msg']);
    $(object).parent().find('.progress-bar').css('width', '0%');
      $(object).parent().find('.progress-bar').css('display','none');
    return;
  }
  else
  {
      var no_of_img = Object.keys(uploadedImages).length + 1;
      uploadedImages[no_of_img-1] = {'img_url' : response['data']['imageurl'],'position':no_of_img};  
      updateSortOptions();
      $(object).parent().find('.progress-bar').css('width', '0%');
      $(object).parent().find('.progress-bar').css('display','none');
  }
}
function updateSortOptions()
{
  var html = '';
    var no_of_img = Object.keys(uploadedImages).length;
    for(i in uploadedImages)
    {
       html += createHTML(no_of_img,uploadedImages[i],parseInt(i)+1);
    }
    $('#imagelist').html(html); 
}

function createHTML(no_of_files,obj,selected)
{
  console.log('obj',obj);
  var id = 'img_'+selected;
  $html = '<div id="'+id+'" class="cms-div">';
  $html += '<select id="'+id+'_select" class="cms-dropdown" name="position" onchange="changePosition('+selected+',\'img_'+selected+'_select\')">';
  for(var i=1 ;i <= no_of_files ; i++)
  {
    if(typeof selected != 'undefined' && i == selected)
    {
      $html += '<option value="'+i+'" selected>'+i+'</option>';
    }
    else
    {
      $html += '<option value="'+i+'">'+i+'</option>';  
    }
    
  }
  $html += '</select>';
  $html += '<span class="viewform cms-inline" id="viewform"><a class="btn cmsButton cmsFont" target="_blank" href="'+obj['img_url']+'">View</a></span>';
  $html += '<span class="cms-inline" id="cross"><a class="btn btn-default" target="_blank" onclick="removeFileFromMultiple('+selected+')">X</a></span>';
  $html += '</div>';
  return $html;
}

function clearFileData(input) {
    $(input).parent().find('.cms-div > #viewform > a').attr('href','');
    $(input).parent().find('.cms-div').css('display','none');
    $(input).parent().find('.progress-bar').css('width', '0%');
    $(input).parent().find('.progress-bar').css('display','none');
    uploadedFiles = {};
}

var uploadedFiles = [];
function uploadPdfForm(input,response)
{
  if(response['data']['error'])
  {
    uploadedFiles = [];
    alert(response['data']['error']['msg']);
    $(input).parent().find('.progress-bar').css('width', '0%');
      $(input).parent().find('.progress-bar').css('display','none');
    return;
  }
  else
  {

    uploadedFiles = {'file_url' : response['data']['file_url'],'file_name' : response['data']['file_name'],'file_relative_url' : response['data']['file_relative_url']};
    $(input).parent().find('.cms-div').css('display','block');
    $(input).parent().find('.cms-div > #uploaded_name').val(response['data']['file_name']);
    $(input).parent().find('.cms-div > #viewform > a').attr('href',response['data']['file_url']);
    $(input).parent().find('.progress-bar').css('width', '0%');
      $(input).parent().find('.progress-bar').css('display','none');
  }
}

function changePosition(currentPosition,ele){
  valueObj = uploadedImages;
  var newPosition = parseInt($('#'+ele).val());
  var currentPosition = parseInt(currentPosition);
console.log(uploadedImages,currentPosition,newPosition);
        if(currentPosition < newPosition){
          for(var pdf in valueObj){
            if(valueObj[pdf].position > currentPosition && valueObj[pdf].position <= newPosition){
              --valueObj[pdf].position;
            }
          }
          valueObj[currentPosition-1]['position'] = newPosition;  
        }else{
          for(var pdf in valueObj){
            if(valueObj[pdf].position >= newPosition && valueObj[pdf].position < currentPosition){
              ++valueObj[pdf].position;
            }
          }
          valueObj[currentPosition-1]['position'] = newPosition;
        }

        valueObj.sort(function(a,b){
          return (a['position'] < b['position']) ? -1 : (a['position'] > b['position']) ? 1 : 0;
        });
        updateSortOptions();
}

function removeFileFromMultiple(index,file_type)
{
  var object = {};
  $.each(uploadedImages,function(file){
      if(uploadedImages[file].position > index)
        --uploadedImages[file].position;
    });
    uploadedImages.splice(index-1,1);
    updateSortOptions();
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