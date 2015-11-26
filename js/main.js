var myModule = (function () {

//Инициализирует наш модуль
  var init = function () {
    _SetUpListners();
  };

  var _SetUpListners = function () {
    _ToUp();
    _KeyPress();
    _Auth();
  };

      var _ToUp = function() {
      
      var 
        $this = $(this),
        $window = $(window),
        upCaption = $('.scroll'),
        scrollHeight = 300

        // скролл кнопки по клику
        upCaption.on('click', function(){
            upCaption.animate({scrollTop: 0}, 300);
        });

        //спрятать кнопку при загрузке страницы
        if ($window.scrollTop() <= scrollHeight ) {
            upCaption.fadeOut()
          } else {
            upCaption.fadeIn('fast')
        };

        //спрятать кнопку по скролу < 300
        $window.scroll(function () {
          if ($window.scrollTop() <= scrollHeight ) {
            upCaption.stop(true,false).fadeOut('fast');
          } else {
            upCaption.stop(true,false).fadeIn('fast');
          };
        });
              
    };

    var _KeyPress = function(event) {
            var inputArea = $('.auth_name');
        if($('.main').keydown(function(event) {
            var text = String.FromCharCode(event.keycode);
            inputArea.value += text;
            console.log(inputArea.value);
        }));
    }

    var _Auth = function() {
        $('.form__input').focus(function(event) {
        event.preventDefault;
        $('.form__input').removeClass('incorectName');
        $('.form__incorrect-div').hide('slow');
        });
    }


  return {
    init: init
  };


})();

myModule.init();













    // ajax
    // var _ajaxRequest = function(){

    //   $('.form-ajax').submit(function(event) {
    //     event.preventDefault();

    //     var dataInfo = $(this).serialize();
    //         input = $('.form__input');
    //         validName = input.eq(0);
    //         validSurname = input.eq(1);
    //         validMail = input.eq(2);
    //         validPass = input.eq(3);
    //         validConfirmpass = input.eq(4);
    //         incorrectDiv = $(".form__incorrect-div");
    //         wrapIncorrect = $('.div-input');

    //         arr = [validName, validSurname, validMail, validMail, validPass, validConfirmpass];

    //         $.each(arr, function(index, val) {

    //             if (val.val().length <= 2) {
    //               val.addClass('incorectName');
    //               val.next(incorrectDiv).css('display', 'inline-block');

    //               val.focus(function(event) {
    //                 event.preventDefault;
    //                 input.removeClass('incorectName');
    //                 incorrectDiv.hide('slow');
    //               });
    //             }
                
    //         });

    //     $.ajax({
    //       url: './controllers/form.php',
    //       type: 'POST',
    //       dataType: 'json',
    //       data: dataInfo
    //     }).done(function(data) {
    //         console.log("success");
    //         alert('Здравствуйте, '+data.name+' '+data.surname+'!');
    //         // window.open("http://google.com/search?q="+data.name+' '+data.secname);
    //         // window.open("http://yandex.ru/search/?text="+data.name+' '+data.secname);
    //       })
    //       .fail(function(data) {
    //         console.log("error");
    //         console.log(data.name+' '+data.secname+' '+data.surname+' '+data.mail+' '+data.pass);
    //       })
         
    //   })
    // }
