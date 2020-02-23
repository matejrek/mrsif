<style>
    .section{float:left; width:100%; padding:15px; border:1px dotted #ccc;}
    .exercises{float:left; width:100%; padding:15px; border:1px dotted #ccc;}
</style>

@extends('layouts.app')


@section('content')

    <!--form method="POST" action="/data/submit"-->
    <form method="POST" action="/routines/store">
        {{ csrf_field() }}
        <input class="form-control" type="text" name="name" placeholder="Enter routine name"><br/>
        <input class="form-control" type="text" name="description" placeholder="Enter a description for this routine"><br/><br/>

        <div class="sections">
            <div class="section" id="sections[section-1]" data-section-id="1">
                <div class="remove-section btn btn-danger">Remove section</div>
                <div class="exercises">
                    <input class="form-control" type="text" name="sections[section-1][name]" placeholder="Enter section name"><br/>
                    <input class="form-control" type="text" name="sections[section-1][description]" placeholder="Enter a description for this section"><br/>
                </div>
                <br/>
                <div class="add-exercise btn btn-success">Add exercise</div>
            </div>

        </div>

        <div class="add-section btn btn-success">Add Section</div>

        <br/><br/>
        <input type="submit" name="submit" class="btn btn-primary">
    </form>

    <script>
        //Add exercise
        var exerciseCount = 1;
        $(document).on('click', '.add-exercise', function(){
            //get section id and count
            var sectionId = $(this).parent().attr('data-section-id');
            var newExercise = '<div class="exercise"> \
                                    <div class="remove-exercise btn btn-danger">Remove exercise</div> \
                                    <input class="form-control" type="text" name="sections[section-'+sectionId+'][exercises]['+exerciseCount+'][name]" placeholder="Enter exercise name"><br/> \
                                    <input class="form-control" type="text" name="sections[section-'+sectionId+'][exercises]['+exerciseCount+'][description]" placeholder="Enter exercise description"><br/> \
                                </div>';
            $(this).parent().find('.exercises').append(newExercise);
            exerciseCount++;
        });
        //Add new section
        var sectionCount=1;
        $(document).on('click', '.add-section', function(){
            sectionCount++;
            var newSection = '  <div class="section" id="sections[section-'+sectionCount+']" data-section-id="'+sectionCount+'"><div class="remove-section btn btn-danger">Remove section</div>\
                                    <div class="exercises"> \
                                        <div class="exercise"> \
                                            <input class="form-control" type="text" name="sections[section-'+sectionCount+'][name]" placeholder="Enter section name"><br/> \
                                            <input class="form-control" type="text" name="sections[section-'+sectionCount+'][description]" placeholder="Enter section description"><br/> \
                                        </div> \
                                    </div> \
                                    <br/> \
                                    <div class="add-exercise btn btn-success">Add exercise</div> \
                                </div>';
            $('.sections').append(newSection);
        });
        //remove a section
        $(document).on('click', '.remove-section', function(){
            $(this).parents('.section').empty().remove();
        });
        //remove a exercise
        $(document).on('click', '.remove-exercise', function(){
            $(this).parents('.exercise').empty().remove();
        });
    </script>

@endsection