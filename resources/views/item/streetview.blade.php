

<style>
.mapouter {
            position: relative;
            text-align: right;
            height: 100%;
            width: 100%;
        }
</style>
@foreach ($street as $s)
<div class="mapouter">
        <div class="gmap_canvas"><iframe
                src="{{$s->url_360}}"
                width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>
</div>
@endforeach