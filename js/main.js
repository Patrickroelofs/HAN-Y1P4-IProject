/* Make offer modal */
$(function(){
    $("#makeOffer").click(function(){
        $(".makeOffer").modal('show');
    });
    $(".makeOffer").modal({
        closable: true
    });
});

/* Contact seller modal */
$(function(){
    $("#contactSeller").click(function(){
        $(".contactSeller").modal('show');
    });
    $(".contactSeller").modal({
        closable: true
    });
});

/* Category select */
$('.ui.dropdown')
    .dropdown()
;

$(function() {
    $('.ui.dropdown.select').dropdown({
        action: 'select'
    });
});

$('a#mobile_item').click(function () {
    $('#sidebar').sidebar('toggle')
});

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

$(".press-register-modal").click(function(){
    $(".register-modal").modal('show');
});

$(".register-modal").modal({
    closable: true
});

$('#dob_calendar')
    .calendar({
        type: 'date',
        startMode: 'year'
    })
;

$('.categories .item.dropdown-hover').popup({
    inline     : true,
    hoverable  : true,
    position   : 'bottom left'
});

$('.tabular.menu .item').tab();

$("#cat-toggle").click(function(){
    $(".cat-list").toggleClass('toggled');
});

$('.ui.accordion')
    .accordion()
;

/* Image change on productpage */
const activeImage = document.querySelector(".product-image .active");
const productImages = document.querySelectorAll(".image-list img");
function changeImage(e) {
    activeImage.src = e.target.src;
}
productImages.forEach(image => image.addEventListener("click", changeImage));