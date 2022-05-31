// $(document).ready(function(){
//   $(".home-product-slider").slick({
//     slidesToShow: 4,
//     slidesToScroll: 1,
//   });

// });

$(document).ready(function(){  //дожидаемся загрузки страницы
  $('#click_btn').on("click", function(){  //вешаем событие на клик по кнопке id="btn1"
      $('#menu').toggle(); //включает/выключает элемент id="text"
  });
  $('#dropbtn').on("click", function(){  //вешаем событие на клик по кнопке id="btn1"
    $('#dropdown').toggle(); //включает/выключает элемент id="text"
});
});
