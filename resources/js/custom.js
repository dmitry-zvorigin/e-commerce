$(document).ready(function() {
    
    // Обработчик клика на кнопке "Загрузить комментарии"
    $('.load-comments-btn').on('click', function() {
        const reviewId = $(this).data('review-id'); // Получаем ID отзыва из кнопки
        const commentsBlock = $('#comments-block-' + reviewId); // Находим блок комментарев
        const commentsForm = $('#comments-form-' + reviewId); // Находим блок формы


        if (commentsBlock.is(':visible')) {
            commentsBlock.hide();
            commentsForm.hide();
        } else {
            // Отправляем AJAX-запрос на сервер для получения комментариев
            $.ajax({
                type: 'GET',
                url: '/load-comments/' + reviewId, // Маршрут для получения комментариев
                success: function(response) {
                    // Добавляем полученные комментарии в блок под отзывом
                    commentsBlock.html(response);
                    // $('.comments-block').html(response);
                    commentsBlock.show();
                    commentsForm.show();
                },
                error: function() {
                    alert('Произошла ошибка при загрузке комментариев');
                }
            });
        }
    });

    // Обработчик клика на кнопке "Загрузить комментарии"
    $('.load-comments-child-btn').on('click', function() {
        const commentParentId = $(this).data('load-comments-parent-id'); // Получаем ID отзыва из кнопки
        const commentsChildBlock = $('#block-comments-child' + commentParentId); // Находим блок комментарев

        if (commentsChildBlock.is(':visible')) {
            commentsChildBlock.hide();
        } else {
            // Отправляем AJAX-запрос на сервер для получения комментариев
            $.ajax({
                type: 'GET',
                url: '/load-comments-child/' + commentParentId, // Маршрут для получения комментариев
                success: function(response) {
                    // Добавляем полученные комментарии в блок под отзывом
                    commentsChildBlock.html(response);
                    // $('.comments-block').html(response);
                    commentsChildBlock.show();
                },
                error: function() {
                    alert('Произошла ошибка при загрузке комментариев');
                }
            });
        }
    });

    $('.form-comment-parent-btn').on('click', function() {
        const commentId = $(this).data('form-comment-parent-id'); // Получаем ID комментария из кнопки
        const commentsForm = $('#block-comment-parent-form' + commentId); // Находим блок формы

        // Скрываем все другие блоки форм, кроме текущего
        $('[id^="block-comment-parent-form"]').not(commentsForm).hide();

        // Показываем или скрываем текущую форму в зависимости от её текущего состояния
        commentsForm.toggle();
    });

    $('.form-comment-child-btn').on('click', function() {
        const commentId = $(this).data('form-comment-child-id');
        const commentForm = $('#block-comment-child-form' + commentId);

        // Скрываем все другие блоки форм, кроме текущего
        $('[id^="block-comment-child-form"]').not(commentForm).hide();

        // Показываем или скрываем текущую форму в зависимости от её текущего состояния
        commentForm.toggle();
    });



});