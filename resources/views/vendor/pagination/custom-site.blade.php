@if ($paginator->hasPages())
    <div class="row">
        <div class="col-sm-12">
            <div class="blog-pagination rev-page">
                <nav>
                    <ul class="pagination justify-content-center">
                        {{-- Previous Page Link --}}
                        @if ($paginator->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link page-prev" href="#" tabindex="-1"><i class="feather-chevrons-left me-1"></i> السابق</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link page-prev" href="{{ $paginator->previousPageUrl() }}"><i class="feather-chevrons-left me-1"></i> السابق</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <li class="page-item disabled">
                                    <a class="page-link" href="#">{{ $element }}</a>
                                </li>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li class="page-item active">
                                            <a class="page-link" href="#">{{ $page }}</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($paginator->hasMorePages())
                            <li class="page-item">
                                <a class="page-link page-next" href="{{ $paginator->nextPageUrl() }}">التالي <i class="feather-chevrons-right ms-1"></i></a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <a class="page-link page-next" href="#">التالي <i class="feather-chevrons-right ms-1"></i></a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endif
