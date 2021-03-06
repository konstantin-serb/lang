@extends('layouts.app')
@section('title', $title = '9. Статистика ')
@section('content')

    <div class="container">
        <h2 class="b">{{ $title }}</h2>

        <div class="mt-4 help">
            <p>
            1. А теперь давайте поговорим о приятном. Ведь мало того, что очень хорошо само по себе учить иностранный
                язык, а еще приятней смотреть и радоваться своим результатам, отраженным графически.
                <br>
                Для этого на Сайте предусмотрен раздел Статистика. Раздел довольно объемный и многогранный.
                Для демонстрации статистики я перешел в свой аккаунт, так как на вновь созданном для демонстрации мало данных.
                <br>
                Давайте перейдем в меню в "Статистика".
                <br>
                Мы видим общую  статистику по каждому изучаемому языку. В статистику попадают многие параметры. Я не буду
                их перечислять, они и так понятны. Ссылки эти кликабельны, но если какая-либо не кликабельна, то значит
                для них еще не достаточно данных. Поэтому не расстраивайтесь, все будет открываться дальше, по ходу изучения.

            </p>
            <div class="img">
                <img class="image" src="/img/help/09_01.jpg">
            </div>

            <p>
            2. Я перешел по ссылке "Добавлено сегодня" и попал на странцу добавления новых фраз и новых слов за 20 последних дней
                <br>
                Название говорит само за себя. На странцие 2 графика. В верхней части график так называемый прогрессивный, то есть
                количество постоянно сумируется: к предыдущеу результату прибавляется сегодняшний.
                <br>
                В нижней части второй график, в абсолютных величинах по каждому дню.
                <br>
                Нажав на кнопку "Еще за 20 дней", мы получим графики за предыдущие 20 дней, там опять будет кнопка "Еще
                за 20 дне", и так далее.
                <br>
                Теперь перейдем по кнопке "График повторения и чтения"
            </p>
            <div class="img">
                <img class="image" src="/img/help/09_02.jpg">
            </div>

            <div class="img">
                <img class="image" src="/img/help/09_03.jpg">
            </div>

            <p>
            3. График повторения и чтения. Если нажать на кнопку "График фраз и слов", можно вернуться обратно.
                <br>
            На этой странице дана статистика повторения и чтения фраз за 20 дней. Хотите еще за 20 дней? Жмите на
                кнопку "Еще за 20 дней".
                <br>
                Также можно посмотреть статистику за 105 дней. Для этого кликаем кнопку "График за 105 дней".
            </p>
            <div class="img">
                <img class="image" src="/img/help/09_04.jpg">
            </div>

            <div class="img">
                <img class="image" src="/img/help/09_05.jpg">
            </div>

            <p>
            4. График за 105 дней.
                <br>
                Почему за 105 дней, а не за 100? Все просто. Горизонтальные временные интервалы графика идут через
                каждые 7 дней, потому и 105 дней, так как 100 на 7 не делится без остатка.
                <br>
                Если же хотите посмотреть на график за все время обучения, нужно кликнуть голубую кнопку "За все
                время"
            </p>
            <div class="img">
                <img class="image" src="/img/help/09_06.jpg">
            </div>

            <p>
            5. Статистика повторения и чтения фраз за все время обучения.
                <br>
                Здесь мы видим график за весь период. Горизонтальные интервалиы расчитываются сайтом автоматически, для
                максимально удобного показа.
                <br>
                Если вы не видите кнопок: "График за 105 дней" и "За все время", это значит, что вы пока занимаетесь мало времени.
                Со временем эти кнопки появятся.
            </p>
            <div class="img">
                <img class="image" src="/img/help/09_07.jpg">
            </div>

            <p>
            6. Статистика затраченного времени за 20 последних дней.
                <br>
                Сайт считает не только количество повторений и чтения, добавления фраз и слов, но и время, проведенное при обучении.
                Время учитывается только при добавлении и редактировании фраз, при повторении и чтении. На других страницах
                время не учитывается.
                <br>Алгоритм учитывания времени устроен таким образом, что если вы отошли во время упражнения или добавления фразы и
                не предпринимали никаких действий на сайте в течении более 3-х минут, то это время не учитывается.
                <br>
                Ваш результат - только чистое время учебы.
            </p>
            <div class="img">
                <img class="image" src="/img/help/09_08.jpg">
            </div>

            <p>

            </p>
            <div class="img">
                <img class="image" src="/img/help/09_09.jpg">
            </div>




            <p></p>
        </div>
    </div>

@endsection
