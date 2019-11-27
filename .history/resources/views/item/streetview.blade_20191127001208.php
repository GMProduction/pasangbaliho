

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
        <div class="gmap_canvas"><iframe src="https://www.google.com/maps/embed?pb=!4v1574788304449!6m8!1m7!1sVWDv2mKD-skdh9pW4FTA4Q!2m2!1d-7.587236829393555!2d110.8185851027607!3f117.35948267424939!4f0!5f0.7820865974627469" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>
</div>
@endforeach