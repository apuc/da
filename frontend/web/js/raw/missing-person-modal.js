$(document).ready(function () {

    /* Закрытие модалки */
    const modal = document.querySelector('.form__modal')

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = 'none'
        }
    }


    // Нажатие на кнопку "Сообщить о пропаже" -> отобразить модалку
    document.getElementById('reportMissing')
        .addEventListener('click', (event) => {
            document.querySelector('.form__modal').style.display = 'block';
        });

    let modalForm = $('#post_missing_person');

    modalForm.on('submit', function (event) {
        event.preventDefault();

        let canContinue = true;
        let data = {};
        modalForm.find('input, textarea, select').each(function () {
            let value = $(this).val();
            if (canContinue) {
                // Проверка на выбранный город. На остальных полях работает required.
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
                type: "POST",
                success: function () {
                    //TODO заменить содержание модалки на сообщение с кнопкой ОК,
                    // заменить ивенты закрытия и нажатия на кнопку на релоад
                    alert('Ваши данные успешно отправлены!');
                    // перезагрузить страницу
                    location.reload();
                },
                error: function (response) {
                    alert(response.responseText !== '' ? response.responseText : "Произошла ошибка! Попробуйте позже");
                    //спрятать модалку
                    document.querySelector('.form__modal').style.display = 'none';
                }
            });
        }
    });
});