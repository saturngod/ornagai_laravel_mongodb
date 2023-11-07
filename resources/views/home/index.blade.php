@extends('layouts.app')

@section('content')
    <aside id="default-sidebar"
        class="fixed top-0 left-0 z-40 w-80 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            
            @if (isset($word))
                <x-forms.search-bar word="{{ $word }}" />
            @else
                <x-forms.search-bar word="" />
            @endif
            
           

            <ul id="searchResult" class="space-y-2 py-2 font-medium">
                @isset($data->synonym)
                @if (count($data->synonym) > 0)
                    <div class="item-center p-2 font-bold ml-3">Synonym</div>
                @endif
            @endisset
                @isset($data->synonym)
                    @foreach ($data->synonym as $item)
                        <li>
                            <a href="{{ route('word.detail', $item) }}"
                                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

                                <span class="ml-3">{{ $item }}</span>
                            </a>
                        </li>
                    @endforeach
                @endisset

            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-80">
        <div class="ps-2 pe-2">
            
            @isset($word)
                <h1 class="text-lg font-bold">{{ $word }}</h1>    
            @endisset
            
            @isset($data->ornagai)
                <div id="ornagai" class="pt-2 ornagai_data">
                    @foreach ($data->ornagai as $item)
                        <div class="">
                            <div>
                                {{ $item['state'] }}
                            </div>
                            <div class="py-1">
                                {{ $item['def'] }}
                            </div>
                            <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
                        </div>
                    @endforeach
                </div>
            @endisset

            @isset($data->eng_mm)
                <div id="eng_mm" class="engmm">
                    @foreach ($data->eng_mm as $item)
                        <div class="">
                            {!! $item['definition'] !!}
                        </div>
                        <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
                    @endforeach
                </div>
            @endisset

            @isset($data->myen)
                <div id="myen" class="myen">
                    @foreach ($data->myen as $item)
                        <div class="mt-2">
                            <div>
                                {{ $item['phonetics'] }}
                            </div>
                            <div class="pt-1">
                                {{ $item['state'] }}
                            </div>
                            <div class="pt-1">
                                {!! str_replace("\\n","<br/><br/>",$item['meaning']) !!}
                            </div>
                            <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
                        </div>
                    @endforeach
                </div>
            @endisset

            @isset($data->oxford)
                <div id="oxford" class="">
                    @foreach ($data->oxford as $item)
                        <div class="">

                            <div class="py-1">
                                {!! $item !!}
                            </div>
                            <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
                        </div>
                    @endforeach
                </div>
            @endisset
        </div>
    </div>

@endsection

@section('script')
    <script>
        async function searchWord(e) {
            e.preventDefault();
            var result = await fetch("{{ route('search') }}?word=" + document.searchForm.word.value);
            var data = await result.json();
            resultBuilder(data);
            return false;
        }

        function resultBuilder(data) {
            var content = "";
            var route = "{{ route('word.detail', ':id') }}";

            for (var i = 0; i < data.length; i++) {
                const text = data[i];
                const url = route.replace(":id", text);
                content += `
            <li>
                <a href="${url}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                   
                   <span class="ml-3">${text}</span>
                </a>
             </li>
            `
            }
            console.log(content);
            document.getElementById("searchResult").innerHTML = content;
        }
    </script>
@endsection
