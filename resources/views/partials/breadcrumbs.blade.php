@if (count($breadcrumbs))
    <div class="container">
      <ol class="edoc-breadcrumb">
          @foreach ($breadcrumbs as $breadcrumb)
  
              @if ($breadcrumb->url && !$loop->last)
                  <li class="item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
              @else
                  <li class="item active">{{ $breadcrumb->title }}</li>
              @endif
  
          @endforeach
      </ol>

    </div>

@endif