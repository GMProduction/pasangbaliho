@extends('main.master')

@section('content')
@foreach ($berita as $b)



<div id="portfolio" class="container" style="min-height: 600px">

</div>
<script>
    $(document).ready(function(){
    $('#portfolio').load('/news/details/{{$b->id_news}}');
})
</script>
@endforeach
@endsection