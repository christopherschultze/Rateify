$(function () {

    // init feather icons
    feather.replace();

    // init tooltip & popovers
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();

    //page scroll
    $('a.page-scroll').bind('click', function (event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 20
        }, 1000);
        event.preventDefault();
    });

    // slick slider
    $('.slick-about').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        dots: true,
        arrows: false
    });

    //toggle scroll menu
    var scrollTop = 0;
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        //adjust menu background
        if (scroll > 80) {
            if (scroll > scrollTop) {
                $('.smart-scroll').addClass('scrolling').removeClass('up');
            } else {
                $('.smart-scroll').addClass('up');
            }
        } else {
            // remove if scroll = scrollTop
            $('.smart-scroll').removeClass('scrolling').removeClass('up');
        }

        scrollTop = scroll;

        // adjust scroll to top
        if (scroll >= 600) {
            $('.scroll-top').addClass('active');
        } else {
            $('.scroll-top').removeClass('active');
        }
        return false;
    });

    // scroll top top
    $('.scroll-top').click(function () {
        $('html, body').stop().animate({
            scrollTop: 0
        }, 1000);
    });

    /**Theme switcher - DEMO PURPOSE ONLY */
    $('.switcher-trigger').click(function () {
        $('.switcher-wrap').toggleClass('active');
    });
    $('.color-switcher ul li').click(function () {
        var color = $(this).attr('data-color');
        $('#theme-color').attr("href", "css/" + color + ".css");
        $('.color-switcher ul li').removeClass('active');
        $(this).addClass('active');
    });

    $(".dropdown-menu li a").click(function(){
        $(this).parents(".dropdown").find('.btn').html($(this).text() + ' <span class="caret"></span>');
        $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
      });

      var grid = new ej.grids.Grid({
        dataSource: data,
        columns: [
                 { field: 'OrderID', headerText: 'Order ID', width: 120, textAlign: 'Right' },
                 { field: 'EmployeeID', headerText: 'Employee ID', width: 150, textAlign: 'Right' },
                 { field: 'Freight', width: 120, format: 'C2', textAlign: 'Right' },
                 { field: 'ShipCountry', headerText: 'Ship Country', width: 150 }
             ]
     });
     grid.appendTo('#Grid');
      
     document.getElementById("Gridform").addEventListener("submit", (e) => {
     e.preventDefault();
       var value = parseInt(document.getElementById('multiplier').value, 10);
      
      // Filtering the data with user input value
       data = new ej.data.DataManager(window.hierarchyOrderdata).executeLocal(new ej.data.Query().where("EmployeeID", "equal", value).take(15));
      
       // Assigning to DataGrid
       grid.dataSource = data;
      
       document.getElementById("userinput").style.display = "none";
       document.getElementById("mtable").style.display = "";
       document.getElementById("Gridform").reset();
     });
     document.getElementById("close").addEventListener("click", (e)=>{
     document.getElementById("mtable").style.display = "none";
     document.getElementById("userinput").style.display = "";
     });


      
});