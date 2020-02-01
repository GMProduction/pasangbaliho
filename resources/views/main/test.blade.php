@extends('main.master')

@section('content')

<link rel="stylesheet" href="{{asset('css/dataAnimate.css')}}">

<style>

    .captionSLider {
        position: absolute;
        /* left: 15%;                            */
        /* right: 70%; */
        padding-left: 20px ;
        bottom: 30%;
        z-index: 10;
        /* padding-top: 20px; */
        padding-bottom: 50px;
        /* color: #fff; */
        text-align: left;
        /* text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6); */

    }

    .captionSLider .judul {
        font-size: 24px;
        font-weight: bolder;
        padding-left: 0px;
        /* margin-top: 60px; */
        text-transform: uppercase;

    }

    .captionSLider .des {
        font-size: 20px !important;
        font-weight: bolder !important;
        padding-left: 0px;
        /* margin-top: 60px; */
        line-height: 20px !important
    }



    @media screen and (max-width : 400px) {
        .slider {
            height: 50px !important;
        }

        .sliderup{
            height: 140px !important;
        }
    }


    @media screen and (max-width : 900px) {
        .captionSLider {
            position: unset !important;
            padding-top: 0px !important;
        }
        .sliderup{
            min-height: 180px !important;
            max-height: 200px !important;
        }
        .carousel-caption{
            margin-bottom: 0px !important;
            margin-top: 0px !important;
            text-shadow: unset !important;
        }

        .slider {
            min-height: 100px !important;
            max-height: 130px !important;
        }

        #portfolio {
            padding-left: 2% !important;
            padding-right: 2% !important;
        }

        .captionSLider .judul {
            font-size: 90% !important;
            margin-bottom: 0px;
        }

        .captionSLider .des {
            font-size: 80% !important;
            line-height: 15px !important;
            color: black !important;
        }
    }
 
}
</style>

<div id="myCarousel" class="carousel slide sliderup " style="">
    <!-- Indicators -->
    {{-- <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol> --}}

    <!-- Wrapper for slides -->
    <div class="carousel-inner " style="">
        @foreach ($slider as $s)
        @if ($loop->first)
        <div class="item active">
            @else
            <div class="item">
                @endif
                <div class="fill slider" style="background-image:url('{{asset('assets/img/slider/'.$s->url_fotoWeb)}}');">
                    
                </div>
                <div class="carousel-caption captionSLider " >
                    <h1 class="judul bounceInLeft"><span>{{$s->title}}</span></h1>
                    <p class="des bounceInRight">{{$s->deskripsi}}</p>
                   
                </div>
            </div>
            @endforeach
            
        </div>

        <!-- Left and right controls -->

        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <i class="fa fa-angle-left"
                aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <i
                class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
        </a>

    </div>
    @endsection