@if(empty($id))
    <div class="breadcrumbs">
        {!! Breadcrumbs::render($breadcrumbName) !!}
    </div>
@else 
    <div class="breadcrumbs">
        {!! Breadcrumbs::render($breadcrumbName, $id) !!}
    </div>
@endif