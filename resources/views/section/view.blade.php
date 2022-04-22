@extends('layouts.app')
@section('title', $title = $section->title)
@push('bottom')
    <script src="/js/jquery.js"></script>
    <script src="/js/changeComplexity.js"></script>
    <script src="/js/changeStatus.js"></script>
@endpush
@section('content')
    <div class="container">
        <nav
            style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('language.index') }}">Языки</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('language.show', ['language' => $section->language->id]) }}">{{ $section->language->title }}</a>
                </li>
                <?= $section->getBreadcrumb($section->id)?>

                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
            </ol>
        </nav>
        <hr>

        <form id="form" action="" method="post">
            @csrf
        </form>

        <h2 class="b">{{ $title }} ({{ $section->countPhrases() }})</h2>
        <p><?=$section->description?></p>

        <div class="">
            <div class="btn-group mt-3" style="margin-right: 1em;">
                <a href="{{ route('section.create.sec', ['section' => $section->id, 'language' => $section->language->id]) }}"
                   class="btn btn-outline-secondary" autofocus>
                    Добавить раздел</a>
                <a class="btn btn-outline-success" href="{{ route('section.edit', ['section' => $section->id]) }}">Редактировать</a>
            </div>
            @if($section->sections->isEmpty())
            <a href="{{ route('phrase.create.phrase', ['section' => $section->id]) }}" class="btn btn-success mt-3">Добавить
                / редактировать фразы</a>
            @endif
        </div>

        @if(!$section->sections->isEmpty())
            <div class="mt-3">
                <h3 class="b">Разделы:</h3>

                <div class="mt-2">
                    <?php
                    $sections = $section->sections;
                    $sections = $sections->sortBy('title');
                    ?>
                    @foreach($sections as $item)
                        <a href="{{ route('section.show', ['section' => $item->id]) }}"
                           class="h5 b no-effect">{{ $item->title }} </a>
                        @if($item->sections->isEmpty())
                            ({{ $item->countPhrases() }})
                            @endif
                            <br>

                    @endforeach
                </div>
            </div>
        @endif

        <hr>

        <form action="{{ route('learn.commutator') }}" method="post">
            @csrf
            <input type="hidden" name="section" value="{{ $section->id }}">
            <div class="row">
                <div class="col-lg-1">
                    <div class="">
                        <label class="mb-2">К-во циклов</label>
                        <select class="form-select" name="cycles" id="countCycles">
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="">
                        <label class="mb-2">Уровень сложности</label>
                        <select class="form-select" name="complexity" id="complexity">
                            <option value="1">Все</option>
                            <option value="2">Легкий</option>
                            <option value="3">Средний</option>
                            <option value="4">Сложный</option>
                            <option value="5">Сложный и средний</option>
                        </select>
                    </div>
                </div>

                <?php
                $sections = $section->sections;
                $sections = $sections->sortBy('title');

                ?>
                @if(!$sections->isEmpty())
                    <div class="col-lg-2">
                        <div class="">
                            <label class="mb-2">Разделы:</label>
                            <select class="form-select" multiple aria-label="multiple select example" name="sections[]" id="secs">
                                @foreach($sections as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                <div class="col-lg-2">
                    <div class="">
                        <label class="mb-2">Сортировка</label>
                        <select class="form-select" name="sort">
                            <option value="1">По порядку</option>
                            <option value="2" selected>Случайно</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-1">
                    <div class="">
                        <label class="mb-2">Задача</label>
                        <select class="form-select" name="task">
                            <option value="1" selected>Учить</option>
                            <option value="2">Читать</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-1">
                    <div class="">
                        <label class="mb-2">Лимит</label>
                        <input class="form-control" name="limit" value="200">
                    </div>
                </div>

                <div class="col-lg-2 " style="margin-top:2.2em;">
                    <button type="submit" class="btn btn-warning ">&nbsp;Учить!&nbsp;</button>
{{--                    <a id="readButton" href="#" class="btn btn-info">Читать!</a>--}}
                </div>

            </div>
        </form>

        <hr>

        @if(!$phrases->isEmpty())
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Снять/добавить выделение у всех
        </button>
        <span style="margin-left: 1em;">Снимает или добавляет выделение у всего раздела</span>
        <br><br>
        @endif
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Снять/добавить выделение</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4 class="b">Снять/добавить выделение для всего раздела</h4>
                        <div>
                            Фразы, у которых снято выделение (галочка в чекбоксе) не попадают в упраждения по написанию или по чтению
                            <br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <a href="{{ route('section.addCheck', ['section' => $section->id]) }}" class="btn btn-primary">Добавить выделение</a>
                        <a href="{{ route('section.deleteCheck', ['section' => $section->id]) }}" class="btn btn-danger">снять выделение у всех</a>
                    </div>
                </div>
            </div>
        </div>
        @if(!$phrases->isEmpty())
            <?php $num = 1?>
            @foreach($phrases as $phrase)
                <div class="" style="font-size: 1.15rem;">
                    <div class="row wordString @if(date('d-m-Y', strtotime($phrase->created_at)) ==  date('d-m-Y', time())) nowadaysPhrase @endif">
                        <div class="col-lg-1">
                            <span title="{{ $phrase->id }}">{{ $num }}</span>
                            <span style="float: right;"><input type="checkbox" class="check-status" data-id="{{ $phrase->id }}"
                                   @if($phrase->status == 1) checked @endif > </span>
                        </div>
                        <div class="col-lg-5">
                            <a class="myLink" href="{{ route('phrase.edit', ['phrase' => $phrase->id]) }}">
                            <span title="{{ $phrase->transcription }}">{{ $phrase->phrase }}</span>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            {{ $phrase->translate }}
                        </div>
                        <div class="col-lg-2">
                            <div style="text-align: right" >
                                    <span class=""
                                          style="vertical-align: 0.25em; margin-right: 1em; color:lightblue; font-size: 0.85em;" >{{ $phrase->count }} <span style="color: rgba(228,0,0,0.51);">({{$phrase->getCountReading()}})</span></span>
                                <div class="form-check form-check-inline"
                                     style="margin: 0.01em; padding-right: 0.1em; padding-left: 0.7em;">
                                    <input class="form-check-input" title="легкий" type="radio"
                                           data-id="{{ $phrase->id }}" data-type="1"
                                           name="inlineRadioOptions-{{ $phrase->id }}"
                                           id="inlineRadio-1-{{$phrase->id}}" value="option1"
                                           @if($phrase->complexity == 1) checked @endif>
                                </div>
                                <div class="form-check form-check-inline"
                                     style="margin: 0.01em; padding-right: 0.1em; padding-left: 0.7em;">
                                    <input class="form-check-input" title="средний" type="radio"
                                           data-id="{{ $phrase->id }}" data-type="2"
                                           name="inlineRadioOptions-{{ $phrase->id }}"
                                           id="inlineRadio-2-{{$phrase->id}}" value="option2"
                                           @if($phrase->complexity == 2) checked @endif>
                                </div>
                                <div class="form-check form-check-inline"
                                     style="margin: 0.01em; padding-right: 0.1em; padding-left: 0.7em;">
                                    <input class="form-check-input" title="сложный" type="radio"
                                           data-id="{{ $phrase->id }}" data-type="3"
                                           name="inlineRadioOptions-{{ $phrase->id }}"
                                           id="inlineRadio-3-{{$phrase->id}}" value="option3"
                                           @if($phrase->complexity == 3) checked @endif>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php $num++?>
            @endforeach

        @endif


    </div>
@endsection
