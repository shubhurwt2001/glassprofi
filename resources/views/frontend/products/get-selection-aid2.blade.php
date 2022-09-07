
@if(!empty($selectionCategoriesData))
@foreach($selectionCategoriesData as $rowData)
<div class="col-lg-4 mb-4 getAidThird" data-id="{{$rowData->id}}" data-title="{{$rowData->title}}">
<a href="javascript:void(0)">
    <div id="pccselect" class="pacc-content">
        <div class="img-hover-zoom">
            <img src="http://50.116.13.170/glasprofi/frontendassets/images/selection_img.jpg" class="img-fluid" alt="" />
            <h3>{{$rowData->title}}</h3>

            @if($rowData->is_last == 1)
            <p> {{$rowData->short_desc}} </p>
            <a href="{{$rowData->page_url}}" class="btn btn-info">{{$rowData->button_name}} </a>
            @endif
            
        </div>
    </div>
</a>
</div>

@endforeach
@endif