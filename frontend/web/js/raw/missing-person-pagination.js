$(document).ready(function () {
    var page = 1;
    let loadButton = $('#load_missing_persons');
    loadButton.on('click', function () {
        $('#load-btn__text').toggle();
        $('#load-btn__text').prop('disabled', 'true');
        $('#load-btn__gif').toggle();

        $.ajax({
            url: '/missing_person/missing-person/page',
            data: {'page': page},
            type: "GET",
            success: function (data) {
                data = JSON.parse(data);

                if (data.length > 0) {
                    let tableBody = $('#missing-person__table-body');

                    for (let i = 0; i < data.length; i++) {
                        tableBody.append(`
                            <tr>
                                <td>${data[i]["FIO"]}</td>
                                <td>${data[i]["date_of_birth"]}</td>
                                <td>${data[i]["city_name"]}</td>
                                <td>${data[i]["additional_info"]}</td>
                            </tr>
                        `);
                    }
                    page++;

                    $('#load-btn__gif').toggle();
                    $('#load-btn__text').prop('disabled', 'false');
                    $('#load-btn__text').toggle();
                } else {
                    loadButton.remove();
                }
            },
            error: function (response) {
                alert(response.responseText !== '' ? response.responseText : "Произошла ошибка! Попробуйте позже");
            }
        });
    });
});
//missing-person__table-body