$(document).ready(function () {

    $('.up-icon').hide();

    $(window).scroll(function () {
        if ($(this).scrollTop() > 0) {
            $('.up-icon').fadeIn();
        } else {
            $('.up-icon').fadeOut();
        }
    });

    // Скролити вверх при кліку на .up-icon
    $('.up-icon').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 'slow');
        return false;
    });
});
$(document).ready(function () {
    $('.loader').fadeOut(100);
});

$('.feedback-checkbox-none').on('click', function () {

    $(this).closest('.feedback-check').toggleClass('active');
});

$('.feedback-phone-option-header').click(function () {
    $(this).closest('.feedback-phone-option').find('.feedback-phone-option-footer').slideToggle(300);
    $(this).find('.feedback-phone-option-header-arrow').toggleClass('active');
});
$('.feedback-phone-option-footer .feedback-phone-option-item').on('click', function () {
    var $this = $(this);
    var $first = $('.feedback-phone-option-header .feedback-phone-option-item');
    var firstHTML = $first.html();
    $first.html($this.html());
    $this.html(firstHTML);
    $('.feedback-phone-option-footer').slideToggle(300);
    $(this).closest('.feedback-phone-option').find('.feedback-phone-option-header-arrow').removeClass('active');
});


$('.video-play-block').click(function () {

    var videoId = $(this).closest('.video-block').find('video').attr('data-video');
    $(this).closest('.video-block').find('video')[videoId].play();
    $(this).fadeOut(50);



});
$('video').click(function () {

    if (this.paused) {
        // this.play();
        // $(this).closest('.video-block').find('.video-play-block').fadeOut(50);
    } else {
        this.pause();
        $(this).closest('.video-block').find('.video-play-block').fadeIn(50);
    }

});

$('.our-slider').slick({
    slidesToShow: 4,
    autoplay: true,
    prevArrow: $('.our-slider-left-arrow'),
    nextArrow: $('.our-slider-right-arrow'),
    autoplaySpeed: '2000',
    responsive: [{
        breakpoint: 1200,
        settings: {
            slidesToShow: 3,

        }
    },

    {
        breakpoint: 768,
        settings: {
            slidesToShow: 2,
        }
    }

    ]
});


$(window).scroll(function () {
    var element = $('.our-slider');
    var element_top = element.offset().top;
    var element_bottom = element.offset().top + element.height();
    var w_height = $(window).height();
    if (($(window).scrollTop() < element_top - w_height) || ($(window).scrollTop() > element_bottom)) {
        $('.our-slider').slick('slickGoTo', 0);
    } else { }
})




$('.quiz-btn-item.first').not($('.quiz-btn-item.deactivated')).click(function () {
    $(this).closest('.quiz-item').prev().addClass('active');
    $(this).closest('.quiz-item').removeClass('active');
});
$('.quiz-btn-item.last').not($('.quiz-btn-item.deactivated')).click(function () {
    if ($(this).closest('.quiz-item').find('.quiz-input').hasClass('quiz-war')) {

    } else {
        $(this).closest('.quiz-item').next().addClass('active');
        $(this).closest('.quiz-item').removeClass('active');
    }
});

$('.quiz-five-close').click(function () {
    $(this).closest('.quiz-five').removeClass('active')
    $('.quiz-one').addClass('active');
    $('.calculator-img img').toggleClass('active');
});

var mySlider = new rSlider({
    target: '#sampleSlider',
    values: ['day', '3 months', '6 months', 'year'],
    range: false,
    tooltip: false,
    scale: true,
    labels: true,
    set: [0, 9999999],

});


$('.quiz-input').mouseleave(function () {
    var inputVal = $(this).find('input').val();
    if (inputVal < 250) {
        $(this).addClass('quiz-war');
    } else {
        $(this).removeClass('quiz-war');
    }
});

$('.quiz-option-item-radio').click(function () {
    $('.quiz-option-item-radio').removeClass('active');
    $(this).addClass('active');
})


$('.customer-slider').slick({
    slidesToShow: 1,
    autoplay: true,
    prevArrow: $('.customer-slider-left-arrow'),
    nextArrow: $('.customer-slider-right-arrow'),
    autoplaySpeed: '5000',
});


$('.review-slider').slick({
    slidesToShow: 3,
    prevArrow: $('.review-slider-left-arrow'),
    nextArrow: $('.review-slider-right-arrow'),
    autoplaySpeed: '5000',
    responsive: [{
        breakpoint: 1200,
        settings: {
            slidesToShow: 1,
            centerMode: false,
            centerPadding: '0',

        }
    },

    {
        breakpoint: 480,
        settings: {
            slidesToShow: 1,
        }
    }

    ]

});

$(".scroll-btn").click(function () {
    var scrollId = $(this).attr('data-scroll');
    $('html, body').animate({
        scrollTop: $(scrollId).offset().top
    }, 100);
});


$('.m-close').click(function () {
    $(this).closest('.page-modal').fadeOut(300);
});

$('form').submit(function () {
    $('#modal-first').fadeIn(200);
});

jQuery(function ($) {
    $(document).mouseup(function (e) { // событие клика по веб-документу
        var div = $(".page-modal-content"); // тут указываем ID элемента
        if (!div.is(e.target) // если клик был не по нашему блоку
            &&
            div.has(e.target).length === 0) { // и не по его дочерним элементам
            div.closest('.page-modal').fadeOut(300);
        }
    });
});

$('.modal-btn').click(function () {
    var modalId = $(this).attr('data-modal');
    $(modalId).fadeIn(300);
});


document.querySelector(".quiz-select select").addEventListener('change', function (e) {
    $(this).closest('.quiz-select-container').find('.quiz-percent span').html(e.target.value);
})

$('.quiz-three .quiz-btn-item.last').click(function () {
    $({ numberValue: 0 }).animate({ numberValue: 100 }, {

        duration: 1000,
        easing: "linear",

        step: function (val) {

            $(".quiz-slogan i").html(Math.ceil(val)); // Блок, где необходимо сделать анимацию

        }

    });
    setTimeout(function () {
        $('.quiz-icon .quiz-icon-loader').fadeOut(0);
        $('.quiz-icon .quiz-icon-item').fadeIn(0);
        $('.quiz-four .quiz-btn-item').css('opacity', '1');
        $('.quiz-rocket').fadeIn(100);

    }, 1000);


});


$('.quiz-four .quiz-btn-item').click(function () {
    $('.calculator-img img').toggleClass('active');
});




$('.quiz-rocket').bind('animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd', function (e) { $(this).hide(); });
jQuery.fn.extend({
    toggleText: function (a, b) {
        var that = this;
        if (that.text() != a && that.text() != b) {
            that.text(a);
        }
        else
            if (that.text() == a) {
                that.text(b);
            }
            else
                if (that.text() == b) {
                    that.text(a);
                }
        return this;
    }
});
$('.our-show-btn').click(function () {
    $('.gen-text-block').find('.gen-text').not($(this).closest('.gen-text-block').find('.gen-text')).removeClass('active');
    $(this).closest('.gen-text-block').find('.gen-text').toggleClass('active');
    $(this).toggleText('Hide all', 'Show all');
});



$('.feedback-row-slogan').click(function () {
    $(this).closest('.feedback-row').find('.feedback-check').click();
    $(this).closest('.feedback-row').find('.feedback-check').toggleClass('active');
});

$('.quiz-option-item-text').click(function () {
    $(this).closest('.quiz-option-item').find('.quiz-option-item-radio').click();
});