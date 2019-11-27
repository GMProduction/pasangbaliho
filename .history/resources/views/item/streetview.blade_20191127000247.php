

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
        <div class="gmap_canvas">{{$s->url_360}}
        </div>
</div>
@endforeach