
<div class="form">
    <div class="form__header">
        <div class="form__text">
            <h3>Оперативное оповещение о пропавших</h3>
            <p>
                Центр поиска пропавших людей - ежедневно публикуется информация о
                разыскиваемых лицах, а также правовая информация и полезные советы по
                безопасности.
            </p>
        </div>
        <button class="form__button" id="reportMissing">Сообщить о пропаже</button>
    </div>
    <div class="form__content">
        <div class="form__content-left">
            <form method="post" action="#" class="form__form-block">
                <div class="form__inputSelects">
                    <div class="inputSelect">
                        <select class="age-select" style="width: 330px">
                            <option value="до 5 лет">Дети до 5 лет</option>
                            <option value="от 5 до 18 лет">Дети от 5 до 18 лет</option>
                            <option value="более 18 лет">Люди старше 18 лет</option>
                        </select>
                    </div>
                    <div class="inputSelect">
                        <select class="select_place-select" style="width: 330px">
                            <option value="" disabled selected>
                                Выберите местоположение
                            </option>
                            <option value="Донецк">Донецк</option>
                            <option value="Макеевка">Макеевка</option>
                        </select>
                    </div>
                </div>
                <div class="form__down-block">
                    <div class="form__inputName">
                        <input type="text" placeholder="Введите ФИО" />
                    </div>
                    <button type="submit">Поиск</button>
                </div>
                <div class="g-recaptcha" data-sitekey="К"></div>
            </form>
        </div>
        <div class="form__content-right">
            <div class="form__i-block">
                <img src="img/new-search-people-form/i.png" />
            </div>
            <div class="form__text-block">
                <p class="form__info">
                    <span>В министерствах и ведомствах Донецкой Народной Республики</span>
                    создано несколько баз данных, с помощью которых происходит поиск
                    пропавших без вести людей в связи с боевыми действиями.
                </p>
                <h5>для звонков:</h5>
                <h3>277</h3>
                <h3>+38 062 303 27 72</h3>
                <h3>+38 071 099 72 77</h3>
                <h3>+7 863 318 25 44</h3>
                <p class="form__source">Источник: https://mzdnr.ru/poisk © mzdnr.ru</p>
            </div>
        </div>
    </div>
    <form class="form__modal">
        <div class="form__modal-content">
            <div class="form__modal-date">
                <label for="modalInputDate">Дата рождения</label>
                <input id="modalInputDate" type="date" placeholder="Введите ФИО" />
            </div>
            <div class="form__modal-place">
                <span><b>Местоположение</b></span>
                <select>
                    <option value="" disabled selected>Выберите местоположение</option>
                    <option value="Донецк">Донецк</option>
                    <option value="Макеевка">Макеевка</option>
                </select>
            </div>
            <div class="form__modal-name">
                <label for="modalInputName">ФИО</label>
                <input id="modalInputName" type="text" placeholder="Введите ФИО" />
            </div>
            <div class="form__modal-additional-information">
                <span><b>Дополнительная информация</b></span>
                <textarea cols="100" rows="5"></textarea>
            </div>
            <div class="form__modal-okButton">
                <button id="modalOkButton">Сообщить</button>
            </div>
        </div>
    </form>
</div>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.age-select').select2({
            selectionCssClass: 'up-selects',
            width: 'resolve'
        })
        $('.select_place-select').select2({
            selectionCssClass: 'up-selects'
        })
        $('b[role="presentation"]').hide()
    })

    // Модальное окно

    const modal = document.querySelector('.form__modal')

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = 'none'
        }
    }

    // Кнопка закрытия модального окна

    const modalOkButton = document.getElementById('modalOkButton')

    modalOkButton.addEventListener('click', (event) => {
        event.preventDefault()
        modal.style.display = 'none'
    })

    // Нажатие на кнопку "Сообщить о пропаже" на форме search-people-form

    const reportMissing = document.getElementById('reportMissing')

    reportMissing.addEventListener('click', (event) => {
        modal.style.display = 'block'
    })
</script>