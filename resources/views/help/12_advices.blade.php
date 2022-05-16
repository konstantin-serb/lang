@extends('layouts.app')
@section('title', $title = '12. Советы автора по пользованию сайтом.')
@section('content')

    <div class="container">
        <h2 class="b">{{ $title }}</h2>

        <div class="mt-4 help">
            <p>
                1. Здесь я собрал некоторые рекомендации из собственного опыта и хочу поделиться ими с вами.
                <br>
                Прежде всего, я рекомендую вам освоить так называемый "слепой 10-пальцевый набор" текста, для удобного
                изучения языков, потому что это очень ускорит и облегчит вам процесс запоминания новый слов и фраз.
                <br>
                Работать должен ваш мозг над изучение языка, а не над поиском на клавиатуре букв.
                <br>
                Скачать простой и очень  удобный клавиатурный тренажер "Stamina" можно <a href="https://stamina.ru/keyboard_trainer/download" target="_blank">здесь</a>.
            </p>
            <p>
                2. Регулярность занятий.
                <br>
                Это пожалуй самый важный пункт. Изучение языков процесс очень долгий, настраиваться нужно не на один год
                изучения, поэтому нужно ввести в свой распорядок время для каждодневного занятия. Пусть это будет небольшое время,
                главное, чтобы занятия были каждый день регулярно.
                <br>
                Наш мозг устроен таким образом, что он имеет определенный лимит на запоминание новой информации. Поэтому нельзя
                наверстать все за выходные, как  не возможно за выходные отоспаться. Делайте упражнения каждый день регулярно
                и успех вам гарантирован.
            </p>

            <p>
                3. Создавайте правильную иерархию разделов.
                <br>
                Пример создания иерархии я привел в разделе <a href="{{ route('help.part', ['part' => '03_language']) }}">3. Первые настройки. Добавление изучаемого языка и разделов</a>.
                <br>
                Иерархия разделов не должна быть ни слишком короткой, ни излишне глубокой, для удобной работы.
                <br>

            </p>

            <p>
                4. Оптимальное количество фраз в разделах.
                <br>
                По мнению автора, оптимальным количествов фраз в разделах является 35-50 фраз. На Сайте нет ограничений по
                минимальному или максимальному количеству фраз  в одном разделе, но слишком большое количество будет утомлять
                при выполнении упражнений.
            </p>

            <p>
                5. После добавления фраз в раздел, сделайте упражнение на повторение с 2 циклами повторения.
                <br>
                Это нужно для того, чтобы сразу же исправить неизбежные ошибки или опечатки.
                Повторив 2 раза фразы вы будете уверены, что они внесены правильно.
            </p>
            <p>6. Если вы хотите изучать английский язык, то я рекомендую брать уроки <a href="https://www.youtube.com/watch?v=Hp9wUEDasY4&list=PLD6SPjEPomaustGSgYNsn3V62BTQeH85X" target="_blank">здесь</a>. Их здесь нужное количество и
                они идут в нужном порядке.
            </p>
            <p></p>
            <p></p>

        </div>
    </div>

@endsection
