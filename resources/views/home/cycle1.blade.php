
<div class="row newString @if(date('d-m-Y', $item->status) ==  date('d-m-Y', time())) nowadays @endif">
    <div class="col-lg-10 " style="font-size: 1.1em;">
        <a class="link" href="{{ route('section.show', ['section' => $item->id]) }}"
           style="font-weight: bold;">
            {{ $item->title }}
        </a>

        @if(isset($item->parent))
            &nbsp;>&nbsp;
            <a class="link"
               href="{{ route('section.show', ['section' => $item->parent->id]) }}">
                {{ $item->parent->title }}
            </a>
        @endif

        @if(isset($item->parent->parent))
            &nbsp;>&nbsp;
            <a class="link"
               href="{{ route('section.show', ['section' => $item->parent->parent->id]) }}">
                {{ $item->parent->parent->title }}
            </a>
        @endif

        @if(isset($item->parent->parent->parent))
            &nbsp;>&nbsp;
            <a class="link"
               href="{{ route('section.show', ['section' => $item->parent->parent->parent->id]) }}">
                {{ $item->parent->parent->parent->title }}
            </a>
        @endif

        &nbsp;... &nbsp;
        <a class="link"
           href="{{ route('language.show', ['language' => $item->language->id]) }}">
            {{ $item->language->title }}
        </a>
    </div>
    <div class="col-lg-2 " style="font-size: 1em;">
        <span class="floatRight">
            @if(date('d-m-Y', $item->status) ==  date('d-m-Y', time())) <b style="color: blue">  @endif
            {{ date('d-m-Y || H:i', $item->status) }}
                @if(date('d-m-Y', $item->status) ==  date('d-m-Y', time())) </b>  @endif
        </span>
    </div>
</div>
{{--<hr style="margin-top:0.2em; margin-bottom: 0.2em;">--}}
