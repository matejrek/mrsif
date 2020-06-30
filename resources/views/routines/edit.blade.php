<style>
    .section{float:left; width:100%; padding:15px; border:1px dotted #ccc;}
    .exercises{float:left; width:100%; padding:15px; border:1px dotted #ccc;}
</style>
@extends('layouts.app')


@section('content')
    <div class="heading">
        <h1>Edit Routine</h1>
    </div>

<form action="/routines/{{$routine->id}}/edit/save" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">

    <input class="form-control" type="text" name="name" placeholder="Enter routine name" value="{{$routine['name']}}"><br/>
    <input class="form-control" type="text" name="description" placeholder="Enter a description for this routine" value="{{$routine['description']}}"><br/><br/>
    <div class="sections">

    @foreach( $routine['sections'] as $key=>$item )
        <div class="section" id="sections[section-{{$key}}]" data-section-id="{{$key}}">
            <div class="remove-section btn btn-danger">Remove section</div>
            <div class="exercises">
                <input class="form-control" type="text" name="sections[section-{{$key}}][name]" placeholder="Enter section name" value="{{$item['name']}}"><br/>
                <input class="form-control" type="text" name="sections[section-{{$key}}][description]" placeholder="Enter a description for this section" value="{{$item['description']}}"><br/>

                @foreach( $item['exercises'] as $key2=>$item2 )
                    <div class="exercise" data-exercise-id="{{$key2}}">
                        <div class="remove-exercise btn btn-danger">Remove exercise</div>
                        <input class="form-control" type="text" name="sections[section-{{$key}}][exercises][{{$key2}}][name]" placeholder="Enter exercise name" value="{{$item2['name']}}"><br/>
                        <input class="form-control" type="text" name="sections[section-{{$key}}][exercises][{{$key2}}][description]" placeholder="Enter exercise description" value="{{$item2['description']}}"><br/>
                    </div>
                @endforeach
            </div>
            <br/>
            <div class="add-exercise btn btn-success">Add exercise</div>
        </div>
    @endforeach

    </div>
    <div class="add-section btn btn-success">Add Section</div>

    <br/><br/>
    <input type="submit" name="submit" class="btn btn-primary">

</form>

@endsection

@section('scripts')
<script>
    //Add exercise
    //var exerciseCount = 1;
    $(document).on('click', '.add-exercise', function(){
        //console.log("adding...");
        //get section id and count
        var sectionId = $(this).parents('.section').attr('data-section-id');
        //console.log("Section id: " + sectionId);
        var exerciseCount = $(this).parent().find('.exercise').length + 1;
        //console.log("Exercise count: " + exerciseCount);
        var newExercise = '<div class="exercise"> \
                                <div class="remove-exercise btn btn-danger">Remove exercise</div> \
                                <input class="form-control" type="text" name="sections[section-'+sectionId+'][exercises]['+exerciseCount+'][name]" placeholder="Enter exercise name"><br/> \
                                <input class="form-control" type="text" name="sections[section-'+sectionId+'][exercises]['+exerciseCount+'][description]" placeholder="Enter exercise description"><br/> \
                            </div>';
        $(this).parent().find('.exercises').append(newExercise);
        //exerciseCount++;
    });
    //Add new section
    //var sectionCount=1;
    $(document).on('click', '.add-section', function(){
        var sectionCount = $('.sections .section').length + 1;
        //console.log("section count: " + sectionCount);
        //var sectionCount = $(this).siblings('.sections').find('.section:last').attr('data-section-id') + 1;
        var newSection = '  <div id="sections[section-'+sectionCount+']" data-section-id="'+sectionCount+'" class="section"><div class="remove-section btn btn-danger">Remove section</div> \
                                <div class="exercises"> \
                                    <input class="form-control" type="text" name="sections[section-'+sectionCount+'][name]" placeholder="Enter section name"><br/> \
                                    <input class="form-control" type="text" name="sections[section-'+sectionCount+'][description]" placeholder="Enter section description"><br/> \
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