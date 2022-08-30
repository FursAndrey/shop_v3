$( document ).ready(function() {
    $(".js-range-slider").ionRangeSlider({
        type: "double",
        min: 0,
        max: 200,
        from: 10,
        to: 50,
        grid: true
    });
});