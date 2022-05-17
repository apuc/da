$(document).ready(function () {
    var page = 1;
    $('#load_missing_persons').on('click', function () {
        $.ajax({
            url: '/missing_person/missing-person/page',
            data: {'page': page},
            type: "GET",
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
                if (data.length > 0) {
                    let tableBody = $('#issing-person__table-body');

                    for (let i = 0; i < data.length; i++) {
                        tableBody.append(`
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        `);
                    }

                    page++;
                }
            },
            error: function (response) {
                alert(response.responseText !== '' ? response.responseText : "Произошла ошибка! Попробуйте позже");
            }
        });
    });
});
//missing-person__table-body