<div class="page-header">
    <h4 class="page-title">{{ $title }}</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
        </li>
        {{ $slot }}
    </ol>
</div>