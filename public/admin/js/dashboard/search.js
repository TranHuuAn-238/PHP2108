$(function() {
    $('#btnSearchText').on('click', function() {
        let keyword = $('#keywordText').val().trim(); // lấy dl của thẻ input và xóa khoảng trắng
        if(keyword.length > 0) {
            $.ajax({
                url: routeSearchDashboard,
                type: "post",
                data: { key: keyword },
                success: function(response) {
                    console.log(response);
                }
            });
        }
    });
});