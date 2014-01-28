$(document).ready(function () {
    $('a[disabled="disabled"]').on('click', function (e) {
        e.preventDefault();
    });

    $('.posts-list-block-text').expander({
        slicePoint: 500,
        expandText: 'Read more',
        userCollapseText: 'Read less',
        preserveWords: false,
        expandSpeed: 500
    });

    $('span.read-less, span.read-more').wrap('<ul class="pager"><li class="next"></li></ul>');
});