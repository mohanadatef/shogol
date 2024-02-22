<footer class="main-footer">
    <strong>Copyright &copy; {{date('Y')}} <a href="#">{{$setting[strtolower('name')]??""}}</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>{{$custom[strtolower('Version')]??"Version"}}</b> {{$setting[strtolower('Version')]??""}}
    </div>
    @if($languageActive)
        <div class="pull-right" style="margin-right: 24px">
            <form method="post" action="{{route('setLang')}}">
                @csrf
                <div class="form-group">
                    <select name='lang' onchange="this.form.submit();">
                        @foreach($languageActive as $lang)
                            <option value='{{$lang->code}}'
                                    @if( languageLocale() == $lang->code )selected @endif >{{$lang->name}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
    </div>
    @endif
</footer>
@yield('footer')
