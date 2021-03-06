@extends('layouts.app')
@section('title', $title = '6. Учеба по нескольким разделам.')
@section('content')

    <div class="container">
        <h2 class="b">{{ $title }}</h2>

        <div class="mt-4 help">
            <p>
            1. Для того, чтобы учить или читать сразу несколько разделов, Сайтом предусмотрены следующие опции:
            Давайте перерейдем в созданный родительский раздел "Часть 1" и создадим в нем еще один раздел и назовем его
            "Урок 02". Он находится в том же разделе, что и ранее созданный "Урок 01". И прямо из этого раздела мы можем
            сгененировать для обучения фразы сразу из двух разделов. Чтобы выделить их, нужно в форме выделить один раздел, а
            затем при нажатой клавише "Ctrl" выделить еще одни раздел и нажать кнопку "Учить!". Этот способ работает с любым количеством
            разделов и с помощью его можно тренироваться с повторением и чтением.
            <div class="img">
                <img class="image" src="/img/help/06_01.jpg">
            </div>

            </p>


            <p></p>
        </div>
    </div>

@endsection
