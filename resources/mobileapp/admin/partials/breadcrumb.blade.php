
<div class="container-fluid">

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb border border-info px-3 py-2 rounded">
      <li class="breadcrumb-item">
        <a href="#" class="text-info d-flex align-items-center"><i class="ti ti-home fs-4 mt-1"></i></a>
      </li>
      <li class="breadcrumb-item">
        <a href="#" class="text-info">@lang('Home')</a>
      </li>
      <li class="breadcrumb-item active text-info font-medium" aria-current="page">
        {{ __($pageTitle) }}
      </li>
        
    <div style="display: flex; justify-content: flex-end; margin-left: auto; margin-right: 0;" class="d-flex flex-wrap justify-content-end gap-2 align-items-center breadcrumb-plsugins">
      @stack('breadcrumb-plugins')
    </div>
  
    </ol>

  </nav> 
