/* Document ready */
$(document).ready(function() {

    // Notifications
    $("#showNotifications").click(function(){
        $(".showNotifications").modal('show');
    });

    $(".showNotifications").modal({
        closable: true
    });


    // Make offer modal
    $("#makeOffer").click(function(){
        $(".makeOffer").modal('show');
    });

    $(".makeOffer").modal({
        closable: true
    });

    // Contact seller modal
    $("#contactSeller").click(function(){
        $(".contactSeller").modal('show');
    });

    $(".contactSeller").modal({
        closable: true
    });

    // Sidebar navigation
    $('a#mobile_item').click(function () {
        $('#sidebar').sidebar('toggle')
    });

    // Login modal
    $(".press-login-modal").click(function(){
        $(".login-modal").modal('show');
        $("#login-register-modal").click(function(){
            $(".register-modal").modal('show');
            $(".login-modal").modal('hide');
        });
    });

    $(".login-modal").modal({
        closable: true
    });

    // Register modal
    $(".press-register-modal").click(function(){
        $(".register-modal").modal('show');
    });

    $(".register-modal").modal({
        closable: true
    });

    // UI Dropdown
    $('.ui.dropdown').dropdown();

    // UI Dropdown Select
    $('.ui.dropdown.select').dropdown({
        action: 'select'
    });

    // DOB Calendar
    $('#dob_calendar').calendar({
        type: 'date',
        startMode: 'year'
    });

    // Categories dropdown
    $('.categories .item.dropdown-hover').popup({
        inline     : true,
        hoverable  : true,
        position   : 'bottom left'
    });

    // Tabs
    $('.tabular.menu .item').tab();

    // Category toggle
    $("#cat-toggle").click(function(){
        $(".cat-list").toggleClass('toggled');
    });

    // UI accordion
    $('.ui.accordion').accordion();





    // Image changes
    const activeImage = document.querySelector(".product-image .active");
    const productImages = document.querySelectorAll(".image-list img");

    function changeImage(e) {
        activeImage.src = e.target.src;
    }

    productImages.forEach(image => image.addEventListener("click", changeImage));

});

$(document).ready(function() {
    let dt = new Date();

    // Timers
    $("[data-countdown]").each(function() {
        let $this = $(this),
            finalDate = $(this).attr("data-countdown"),
            end = "Product wordt gesloten...",
            basic = $(this).attr("data-basic");
        $this
            .countdown(finalDate, function(event) {
                if (event.offset.totalSeconds === 0) {
                    $this.html(end);
                }
            })
            .on("update.countdown", function(event) {
                let format = "%-D day%!D %H:%M:%S";
                if (!basic) {
                    format = createFormat(event, end);
                }

                $this.html(event.strftime(format));
            })
            .on("finish.countdown", function() {
                $this.html(end);
            })
            .on("stop.countdown", function() {})
            .countdown("start");
    });

    function createFormat(event, end) {
        let format = "";
        if (event.offset.totalDays === 0) {
            format = "%H:%M:%S";
        } else if (event.offset.totalDays < 7 && event.offset.totalDays >= 2) {
            format = "%-d dagen";
        } else if (event.offset.totalDays < 2) {
            format = "%-d dag %H:%M:%S";
        }
        if (event.offset.weeks > 0) {
            format = "%-W %!W:week,weken; " + format;
        }
        if (event.offset.months > 0 && event.offset.months < 12) {
            format = "%-m %!m:maand,maanden; " + format;
        }

        return format;
    }
});
