$(document).ready(function () {

    // Нажатие на кнопку "Сообщить о пропаже" -> отобразить модалку
    document.getElementById('reportMissing')
        .addEventListener('click', (event) => {
            document.querySelector('.form__modal').style.display = 'block';
        });

    let modalForm = $('#post_missing_person');

    modalForm.on('submit', function (event) {
        event.preventDefault();

        let canContinue = true;
        let data = [];
        modalForm.find('input, textarea, select').each(function () {
            let value = $(this).val();
            if (canContinue) {
                if (this.name === "city_id" && value === "") {
                    alert('Выберите город');
                    canContinue = false;
                }
                data[this.name] = value;
            }
        });

        if (canContinue) {
            $.ajax({
                url: modalForm.attr('action'),
                data: data,
                dataType: "json",
                type: "POST",
                success: function () {
                    alert('Ваши данные успешно отправлены!');
                    //спрятать и очистить модалку
                    document.querySelector('.form__modal').style.display = 'none';
                    modalForm.find('input, textarea, select').each(function () {
                        $(this).setAttribute('value', '');
                    });
                },
                error: function () {
                    alert("Произошла ошибка! Попробуйте позже");
                    //спрятать модалку
                    document.querySelector('.form__modal').style.display = 'none';
                }
            });
        }
    });
});