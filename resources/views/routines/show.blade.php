@extends('layouts.app')


@section('content')
    <div class="heading">
        <h1>Routine</h1>
    </div>
    <ul>
        <li>
            {{ $routine['name'] }}
            |
            <a href="{{$routine['id']}}/edit">
                Edit
            </a>
            |
            <a href="delete/{{$routine['id']}}">
                Delete
            </a>
            <ul>
                @foreach( $routine['sections'] as $item )
                    <li>
                        <strong>Section:</strong> {{$item['name']}}
                        <ul>
                        @foreach( $item['exercises'] as $item2 )
                            <li>
                                <strong>Exercise:</strong> {{$item2['name']}}
                            </li>
                        @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>

    <hr/>


    <div class="routineProgramme">
        <div class="progressBar">
            <div class="progress"></div>
        </div>
        <ul class="sectionList">
            @foreach( $routine['sections'] as $item )
                <li @if (!$loop->first && !$loop->last) class="section" @endif @if ($loop->first) class="section first" @endif @if ($loop->last) class="section last" @endif>
                    <strong>Section:</strong> {{$item['name']}}
                    <ul class="exerciseList">
                    @foreach( $item['exercises'] as $item2 )
                        <li @if (!$loop->first && !$loop->last) class="exercise" @endif @if ($loop->first) class="exercise first" @endif @if ($loop->last) class="exercise last" @endif>
                            <div class="title">
                                {{$item2['name']}}
                            </div>
                            <div class="description">
                                {{$item2['description']}}
                            </div>
                        </li>
                    @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
        <div class="finish">
            Yaay, you finished the routine! :)
        </div>
        <div class="navigation">
            <div class="previous">
                < previous
            </div>
            <div class="next">
                next >
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script type="text/javascript">
        $(function(){
            //progress
            var section = 1;
            var exercise = 1;

            //get progress from db and set it


            function setActiveSectionAndExercise(s, e){
                $('.routineProgramme .sectionList .section:nth-child('+s+')').addClass('active');
                $('.routineProgramme .sectionList .section:nth-child('+s+') .exerciseList .exercise:nth-child('+e+')').addClass('active');
            }
            setActiveSectionAndExercise(section, exercise);

            function routineProgress(){
                var numOfSections = $('.routineProgramme .sectionList .section').length;
                var numOfExercises = $('.routineProgramme .sectionList .section .exerciseList .exercise').length;

                var numOfCompletedExercises = 0;
                for(var i = 1; i<section; i++){
                    numOfCompletedExercises += $('.routineProgramme .sectionList .section:nth-child('+i+') .exerciseList li').length;
                }
                numOfCompletedExercises += exercise;
                var percentage = (100 / numOfExercises) * numOfCompletedExercises;
                $('.progressBar .progress').css('width',percentage+'%');
                console.log(percentage + "%");
            }
            routineProgress();


            //set sizing
            function setSizings(){
                $('.routineProgramme .sectionList .section').each(function(){
                    //set section with to full size of list
                    $(this).width($('.routineProgramme .sectionList').width());
                    $('.routineProgramme .sectionList .section .exerciseList').width($('.routineProgramme .sectionList').width());

                    //set exercise width to full section width
                    $(this).find('.exercise').width($('.routineProgramme .sectionList').width());

                    //var exerciseCount = $(this).children().count();
                    
                });
            }
            setSizings();

            $('.previous').on('click', function(){
                if($('.section.active').hasClass('first') && $('.exercise.active').hasClass('first')){
                    //do nothing since its first section and first exercise
                   //console.log("Can't go back we are at start");
                }
                else{
                    //get current section and exercise set to previous one
                    if(exercise > 1){
                        $('.exercise.active').removeClass('active');
                        exercise--;
                        setActiveSectionAndExercise(section, exercise);
                    }
                    else{
                        $('.section.active').removeClass('active');
                        $('.exercise.active').removeClass('active');
                        section--;

                        //exercise count of new section
                        exercise = $('.routineProgramme .sectionList .section:nth-child('+section+') .exerciseList li').length;
                        setActiveSectionAndExercise(section, exercise);
                    }
                }
                //console.log("Section " + section + ", Exercis: " + exercise + "\n\n");
                routineProgress();
            });
                
            $('.next').on('click', function(){
                if($('.section.active').hasClass('last') && $('.exercise.active').hasClass('last')){
                    //if its last exercise in last section then call finish window
                    //console.log("Finished!");
                    $('.finish').fadeIn();
                }
                else{

                    if(exercise < $('.routineProgramme .sectionList .section:nth-child('+section+') .exerciseList li').length){
                        $('.exercise.active').removeClass('active');
                        exercise++;
                        setActiveSectionAndExercise(section, exercise);
                        //console.log("just move 1 exercise");
                    }
                    else{

                        
                        $('.section.active').removeClass('active');
                        $('.exercise.active').removeClass('active'); 
                        exercise=1;
                        section++;
                        setActiveSectionAndExercise(section, exercise);
                        //console.log("move to next section");
                    }
                }
                //console.log("Section " + section + ", Exercis: " + exercise + "\n\n");
                routineProgress();
            //var sectionCount = $('.routineProgramme .sectionList').chindren().length();
            });


        });
    </script>
@endsection

