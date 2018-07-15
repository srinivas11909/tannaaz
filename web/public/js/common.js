

$(function(){
     $('.flex_navbar li.flex_li').each(function(){
        $(this).find('.nav-title').on({
          mouseover: function(event) {
            event.preventDefault();
            var self = $(this).closest('.flex_li');
            $(self).addClass('active')
            $('.bgLayer').addClass('show');
            setTimeout(function(){
              var CategoryShow = $(self).find('.categeory_block');
              $(CategoryShow).addClass('show');
              $(CategoryShow).on({
                 mouseover: function(){
                   $(self).addClass('active')
                   $(this).addClass('show');
                 },
                 mouseout: function(){
                   $(self).removeClass('active');
                   $(this).removeClass('show');
                 }
              })
            }, 200);
          },
          mouseout: function(event){
            event.preventDefault();
            var self = $(this).closest('.flex_li');
            $(self).removeClass('active');
            $('.bgLayer').removeClass('show');
            setTimeout(function(){
              $(self).find('.categeory_block').removeClass('show');
            }, 200);
          }
        });
    });

    //contact page tabs

   // $('.about_title').each(function(){
   //   var self = $(this).find('a');
   //   $(self).on('click', function(e){
   //     e.preventDefault();
   //     if ($(self).closest('.about_title').hasClass('active')) {
   //       $(self).closest('.about_title').siblings().removeClass('active');
   //     }else {
   //         $(self).closest('.about_title').siblings().addClass('active')
   //     }
   //
   //   });
   // });

   $('.about_title > .sub_cat').on('click', function(e){
     e.preventDefault();
     $(this).closest('.about_title').toggleClass('active');
   });

   //mobile menu
   $('.ham').on('click', function(){
     $('.mobile_drop').toggleClass('active');
     $('.sub_li').removeClass('active');
     $('.child_ul').removeClass('ac');
   });

       $('.sub_li > a').on('click', function(e){
         e.stopPropagation();
         var self = $(this).closest('.sub_li');
         $(self).toggleClass('active');
         if ($(self).hasClass("active")) {
           $(self).find('.child_ul').addClass('ac');
           $(self).find('.inner_ul').addClass('ac');
         }else {
            $(self).find('.child_ul').removeClass('ac');
            $(self).find('.inner_ul').removeClass('ac');
         }
   });
});

   $('.about_title > .sub_cat').on('click', function(e){
     e.preventDefault();
     $(this).closest('.about_title').toggleClass('active');
   });

   //mobile menu
   $('.ham').on('click', function(){
     $('.mobile_drop').toggleClass('active');
     $('.sub_li').removeClass('active');
     $('.child_ul').removeClass('ac');
   });

       $('.sub_li > a').on('click', function(e){
         e.stopPropagation();
         var self = $(this).closest('.sub_li');
         $(self).toggleClass('active');
         if ($(self).hasClass("active")) {
           $(self).find('.child_ul').addClass('ac');
           $(self).find('.inner_ul').addClass('ac');
         }else {
            $(self).find('.child_ul').removeClass('ac');
            $(self).find('.inner_ul').removeClass('ac');
         }
   });


$(document).on('click','.aboutus',function(event){
    var clickedElement = $(this).attr('id');
    $('.show_about').addClass('hide');
    $('.show_about').removeClass('show');
    $('.about_title').removeClass('active');
    $('#'+clickedElement).parent('div.about_title').addClass('active');
    $('#'+clickedElement+"_s").addClass('show');
});
$(document).on('click','.contactus',function(event){
    var clickedElement = $(this).attr('id');
    $('.show_contact').addClass('hide');
    $('.show_contact').removeClass('show');
    $('.about_title').removeClass('active');
    $('#'+clickedElement).parent('div.about_title').addClass('active');
    $('#'+clickedElement+"_s").addClass('show');
});
$(document).on('click','#contact_submit',function(event){
    if(validateFields(document.getElementById('contact_form')))
    {
      var objForm = document.getElementById('contact_form');   
      var postData = {};
      for(var formElementsCount=0; formElementsCount<objForm.elements.length; formElementsCount++) {
          var formElement = objForm.elements[formElementsCount];
          var  textBoxContent = $.trim(formElement.value);
          var elementName = formElement.getAttribute('name');
          postData[elementName] = textBoxContent;
      }
      makeCustomAjaxCall('/HomePage/postContactUsForm',postData,'contactpostCallback');
    }
    event.preventDefault();
});
function contactpostCallback(msg)
{
  if(typeof msg.data != 'undefined' && msg.data == "success")
  {
    alert("success");
    window.location.reload();
  }
  else
  {
      alert("some error occured");
      window.location.reload();
  }
}


function validateFields(objForm) {
    var returnFlag = true;
    for(var formElementsCount=0; formElementsCount<objForm.elements.length; formElementsCount++) {
        var formElement = objForm.elements[formElementsCount];
        console.log('came');
        var  textBoxContent = $.trim(formElement.value);
        var elementName = formElement.getAttribute('name');
        if(formElement.getAttribute('type') == 'email')
        {
          console.log('===',validateEmail(textBoxContent));
            if(!validateEmail(textBoxContent))
            {
                $('#'+elementName+'_error').text(elementName +"  is invalid");
                $('#'+elementName+'_error').css({'display':'block','color':'red'});
                returnFlag = false;
            }
            else
            {
                $('#'+elementName+'_error').css({'display':'none'}); 
            }
        }
        else if(formElement.getAttribute('type') == 'number' && formElement.getAttribute('name') == "mobile")
        {
            if(!validatePhoneNumber(textBoxContent))
            {
                $('#'+elementName+'_error').text(elementName +"number is invalid");
                $('#'+elementName+'_error').css({'display':'block','color':'red'});
                returnFlag = false;
            } 
            else
            {
              $('#'+elementName+'_error').css({'display':'none'});
            }
        }
        else if(formElement.getAttribute('min') || formElement.getAttribute('max')) {
            var minValue = formElement.getAttribute('min');
            var maxValue = formElement.getAttribute('max')
            console.log(minValue,maxValue,textBoxContent.length);
            if(minValue && textBoxContent.length < minValue)
            {
              $('#'+elementName+'_error').text(elementName +" can't be lessthan "+ minValue +" characters");
              $('#'+elementName+'_error').css({'display':'block','color':'red'});
              returnFlag = false;
            }
            else if( maxValue && textBoxContent.length > maxValue)
            {
              $('#'+elementName+'_error').text(elementName +" can't be greaterthan "+ maxValue +" characters");
              $('#'+elementName+'_error').css({'display':'block','color':'red'});
              returnFlag = false;
            }
            else
            {
                $('#'+elementName+'_error').css({'display':'none'});
            }
        }
  }
  return returnFlag;
}

function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function validatePhoneNumber(number)
{
  var phoneno = /^\d{10}$/;
  if((number.match(phoneno)))
      return true;

  return false;
}

function activeRespsectiveTab()
{
  var hashString= location.hash.slice(1);
  var aboutUsTabs = ['patina','process'];
  $('.show_about').addClass('hide');
  $('.show_about').removeClass('show');
  if(aboutUsTabs.indexOf(hashString) > -1)
  {
    $('#'+hashString+'_s').addClass('show');
  }
  else
  {
    $('#history_s').addClass('show');
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
function getSearchText(e,obj)
{
  var code = (e.keyCode ? e.keyCode : e.which);
  window.obj = obj;
      console.log(event);
  if(code == 13)
  {
      var searchText = $(obj).val();
      searchText = $.trim(searchText);
      if(searchText != '' && typeof searchText != 'undefined')
      {
          window.location = '/search/?q='+searchText;
      }
  }
  else
  {
      return;
  }

}