<style>
    .search-item-design{
        padding-top: 30px;
        /* width: 60%; */
    }
   .design-li{
        list-style: none;
        padding: 0 20px;
        color: #000;
        margin: 0;
    }

    .design-li:hover{
        background: #F3F3F3;
        cursor: pointer;
    }

    .design-li a:hover{
       color: #333333;
    }
</style>

<div class="row">
    <div class="col-md-11 offset-md-3">
        <ul class="search-item-design">
            @forelse ($product as $item)
            <a href="{{ route('product.show', $item->slug) }}">
                <li class="design-li">
                    <img src="{{ asset($item->image) }}" alt="" height="40px;" width="40px;">
                    <strong >{{ $item->name }}</strong> <hr>
                </li>
            </a>
            @empty
                <li style="color: red; padding:0 20px;list-style:none;">Propduct Not Found</li>
            @endforelse
        </ul>
    </div>
    
</div>