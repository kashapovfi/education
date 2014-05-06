function expander(){
    $('.posts-list-block-text').expander({
        slicePoint: 500,
        expandText: 'Read more',
        userCollapseText: 'Read less',
        preserveWords: false,
        expandSpeed: 500
    });

    //Styling read more button
    $('span.read-less, span.read-more').wrap('<ul class="pager"><li class="next"></li></ul>');
}
$(document).ready(function () {
    $('a[disabled="disabled"]').on('click', function (e) {
        e.preventDefault();
    });


    expander();

    $('#reports_month').selectric();

    $('#reports_month').on('change', function () {
        var month = $(this).val();
        var year = $('#reports_year').val();

        $.ajax({
            url: baseUrl + '/?r=blog/post/month',
            type: 'POST',
            cache: false,
            data: {month: month, year: year},
            dataType: 'json',


            success: function (result) {
                if (result.status == 200) {
                    $('.post_content').hide('slow').show('slow').html(result.data);
                    expander();
                }
            }
        });

    });
});