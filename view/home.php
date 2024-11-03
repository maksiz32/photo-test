<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление сообщений</title>
    <style><?php require_once ('style/css/main.css'); ?></style>
</head>
<body>
    <section class="container">
        <form class="form">
            <div class="form-inner">
                <label for="title">Введите Имя:</label>
                <input class="form-control" type="text" name="name" title="Имя" required />

                <label for="title">Введите Электронную почту:</label>
                <input class="form-control" type="text" name="email" title="Электронная почта" required />

                <label for="title">Введите Сообщение:</label>
                <textarea class="form-control" name="message" title="Сообщение" required></textarea>

                <input class="form-control" type="submit" id="send" value="Отправить" />
            </div>
            <div id="informer"></div>
        </form>
    </section>

    <script>
        const send = document.getElementById('send');
        send.addEventListener('click', function(event) {
            event.preventDefault();
            const request_data_line = document.querySelectorAll('.form-control:not(#send)');
            let request = {};

            Object.values(request_data_line).forEach(element => {
                request[element.getAttribute('name')] = element.value;
            });
            if (Object.keys(request).length) {
                (
                    async function() {
                        let resp = await fetch('http://kotofoto.lc/', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify(request)
                        })
                        const answer = await resp.json();
                        const informer = document.getElementById('informer');
                        if (informer) {
                            informer.innerHTML = '';
                        }
                        informer.removeAttribute('class');

                        if (answer.res !== 0) {
                            const inputs = document.querySelectorAll('.form-control:not(#send');
                            Object.values(inputs).forEach(item => item.value = '');

                            informer.classList.add('success');
                            informer.innerHTML = answer.message;
                        } else {
                            informer.classList.add('alert');
                            informer.innerHTML = answer.error;
                        }
                    }
                )();
            }
        });
    </script>
</body>
</html>
