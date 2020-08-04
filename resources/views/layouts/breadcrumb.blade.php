<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    @foreach ($items as $item)
      @if ( isset($item['active']) )
        <li class="breadcrumb-item active"><a href="{{ $item['url'] }}">{{ $item['name'] }}</a></li>
          
      @else
        <li class="breadcrumb-item"><a href="{{ $item['url'] }}">{{ $item['name'] }}</a></li>
          
      @endif
    @endforeach
    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
  </ol>
</nav>