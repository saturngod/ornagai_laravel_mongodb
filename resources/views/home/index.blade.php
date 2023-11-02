@extends('layouts.app')

@section('content')
<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-80 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
        <x-forms.search-bar />
        <ul id="searchResult" class="space-y-2 py-2 font-medium">
            
          
        </ul>
    </div>
</aside>

@endsection

@section('script')
<script>
    async function searchWord(e) {
        e.preventDefault();
        var result = await fetch("{{route('search')}}?word=" + document.searchForm.word.value);
        var data = await result.json();
        resultBuilder(data);
        return false;
    }

    function resultBuilder(data) {
        var content = "";
        for(var i=0 ; i < data.length; i++) {
            const text = data[i].word;
            content += `
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                   
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
