// общие методы, используемые во всей админке. могут использоваться на морде сайта, но там может быть другая верстка,
// окна и тд.. так что там лучше отдельные версии этих методов держать.

/* функция, которую стоит добавлять ко всем ошибочным ответам аякса */
function ajaxError(xhr, initiator) {
    console.log('Ошибка. Ответ сервера:', xhr);

    if (xhr.status < 400) { return false; }
    var message = "<b>Без паники!</b> <br>Всего лишь небольшая ошибка сервера...<br>Зачинщик этого безобразия: <strong>" + initiator +"</strong>";

    if (initiator == undefined) {
        if (xhr.status == 413) {
            message = "<b>Почти всё нормально!</b> <br>Только сервер не может обработать такой большой запрос. Попробуйте отправить файл поменьше.";
        } else if (xhr.status == 413) {
            message = "<b>403: Доступ запрещен</b> <br>Вы пытаетесь сделать недопустимое действие. Не стоит. Если Вы совершаете обычную операцию, значит этот запрет наша ошибка, сообщите как у Вас получилось дойти до нее.";
        } else {
            message = "<b>Без паники!</b> <br>Всего лишь небольшая ошибка сервера...<br>Код ошибки: <strong>" + xhr.status +"</strong>";
        }
    }

    message = message + '<br>' + xhr.responseText;

    Swal.fire({
        toast: true,
        type: 'error',
        position: 'bottom-end',
        icon: 'error',
        html: message
    });
}


/* обработчик который запускает предварительный свиталерт подтверждения или обработки произвольного действия */
function initSwalConfirmation() {
    /*$('[data-action=confirmation][data-action-url]').on('click', function () {
        alert(321321321);
        return false;
    });*/

    //
    $('body').on('click', '[data-action=confirmation][data-action-url]', function (event) {

        event.preventDefault();
        var element        = $(event.target).closest('[data-action]');
        var titleText      = element.data('action-title');
        var textText       = element.data('action-text');
        var actionUrl      = element.data('action-url');
        var actionMethod   = (element.data('method') == 'post') ? 'POST' : 'GET';
        var confirmColor   = element.data('confirm-color') ? element.data('confirm-color') : '#f8bb86';
        var confirmBtnText = element.data('action-confirm-btn');
        swal.fire({
            title: titleText,
            text: textText,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: confirmColor,
            cancelButtonColor: '#cccccc',
            cancelButtonText: 'Отменить',
            confirmButtonText: confirmBtnText ? confirmBtnText : 'Да'
        }).then(function (result) {
            if (result.value == true) {
                swal.fire({
                    title: 'Подождите...',
                    timer: 6000,
                    onOpen: function () {
                        swal.showLoading();
                    }
                });
                $.ajax({
                    type: actionMethod,
                    url: actionUrl,
                    success: function(data) {
                        if (data.status == 'error') {
                            swal.fire('Ошибка!', data.text, 'error');
                        }
                        if (data.status == 'deleted') {
                            swal.fire('', data.text, 'success');
                            afterConfirmationDelete(element);
                        }
                        if (data.status == 'success') {
                            swal.fire('', data.text, 'success');
                        }
                    },
                    error: function (data, b) {
                        if( data.status >= 400 && data.status < 600) {
                            ajaxError(data, 'initSwalConfirmation()');
                        }
                    }
                });
            }
        });

        return false;
    });
}

function afterConfirmationDelete(element) {
    element.closest('._deletable-block').addClass('opacity-30');
    element.closest('._deletable-block').removeClass('opacity-60');
    element.closest('._deletable-block').find('._disable-on-delete').attr('disabled', true);
}


function submitWaiter(message) {
    if (!message) { message = 'подождите...'; }
    Swal.fire({
        title: message,
        timer: 15000,
        onBeforeOpen: () => {
            Swal.showLoading();
        },
    });
}


/* обработчик копирования текста в буфер обмена */
function initActionCopyPaste()
{
    $('body').on('click', '[data-action=copypaste]', function (event) {
        event.preventDefault();
        var element  = $(event.target).closest('[data-action]');
        var copyText = element.data('copy');
        var actionType = element.data('action-type');
        if (actionType == 'url') {
            var originUrlPrefix = element.data('origin-url') ? window.location.origin : '';
        }

        var resultMessage   = element.data('result-text');

        var tmp   = document.createElement('INPUT'), // Создаём новый текстовой input
            focus = document.activeElement; // Получаем ссылку на элемент в фокусе (чтобы не терять фокус)

        tmp.value = originUrlPrefix + copyText; // Временному input вставляем текст для копирования
        document.body.appendChild(tmp); // Вставляем input в DOM
        tmp.select(); // Выделяем весь текст в input
        document.execCommand('copy'); // Магия! Копирует в буфер выделенный текст (см. команду выше)
        document.body.removeChild(tmp); // Удаляем временный input
        focus.focus(); // Возвращаем фокус туда, где был

        swal.fire({
            title: 'Скопировано в буфер!',
            html: resultMessage,
            type: 'success',
            showCancelButton: false,
            confirmButtonColor: '#a5dd86',
            confirmButtonText: 'OK'
        });
    });
}


initSwalConfirmation();
initActionCopyPaste();




document.addEventListener('DOMContentLoaded', function(){ // Аналог $(document).ready(function(){
    $(function () {
        $('[data-toggle="tooltip"]').tooltip({
            html: true
        });
    });

});