@if ($paginator->hasPages())
  <ul class="pager">
    <!-- Previous Link Page -->
    @if ($paginator->onFirstPage())
      <li class="disabled">
        <i class="icofont icofont-arrow-left"></i> Previews
      </li>
    @else
      <li>
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
        <i class="icofont icofont-arrow-left"></i> Previews </a>
      </li>
    @endif

    <!-- Pagination Elements -->
    @foreach ($elements as $element)
      @if (is_string($element))
        <li class="disabled">
          <span>{{ $element }}</span>
        </li>
      @endif
      <!-- Array Of Links -->
      @if(is_array($element))
        @foreach($element as $page => $url)
          @if ($page == $paginator->currentPage())
            <li clas="active my-active">
              <span>{{ $page }}</span>
            </li>
          @else
            <li>
              <a href="{{ $url }}">{{ $page }}</a>
            </li>
          @endif
        @endforeach
      @endif
    @endforeach
    <!-- Next Link Page -->
    @if($paginator->hasMorePages())
      <li>
        <a href="{{ $paginator->nextPageUrl() }}" rel="next">
        Next <i class="icofont icofont-arrow-right"></i></a>
      </li>
    @else
      <li class="disabled">
        Next <i class="icofont icofont-arrow-right"></i>
      </li>
    @endif
  </ul>
@endif