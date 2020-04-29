/* Search bar ---------------- */

$('.ui.search')
    .search({
        apiSettings: {
            url: '//api.github.com/search/repositories?q={query}'
        },
        fields: {
            results : 'items',
            title   : 'name',
            url     : 'html_url'
        },
        minCharacters : 3
    })
;

/* Category select */
$(function() {
    $('.ui.dropdown').dropdown({
        action: 'select'
    });
});

/* slider */
$('.ui.slider')
    .slider()
;

$('.ui.range.slider')
    .slider({
        min: 0,
        max: 100,
        start: 0,
        end: 100,
        step: 0
    })
;

$('a#mobile_item').click(function () {
    $('#sidebar').sidebar('toggle')
});

$("#login-modal").click(function(){
    $(".login-modal").modal('show');
});
$(".login-modal").modal({
    closable: true
});