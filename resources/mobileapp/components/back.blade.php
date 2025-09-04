@props([
    'route' => '',
])

<a href="{{ $route }}" class="btn btn-sm btn-outline-primary">
    <i class="ti ti-arrow-back"></i> @lang('Back')
</a>
