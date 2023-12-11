@section('page_css')
<link href="{{URL::asset('back/css/select2.min.css')}}" rel="stylesheet" type="text/css">
@endsection
<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    {{Form::label('title', 'Judul Cerita *')}}
    {{Form::text("title", null, array("class"=>"form-control","id"=>"title"))}}
    @if ($errors->has('title'))
    <span class="help-block">
        <strong>{{ $errors->first('title') }}</strong>
    </span>
    @endif
</div>

<div class="form-group{{ $errors->has('cerita_indo') ? ' has-error' : '' }}">
    {{Form::label('cerita_indo', 'Cerita Bahasa Indonesia *')}}

    {{Form::textarea("cerita_indo", null, array("class"=>"form-control","id"=>"cerita_indo"))}}
    @if ($errors->has('cerita_indo'))
    <span class="help-block">
        <strong>{{ $errors->first('cerita_indo') }}</strong>
    </span>
    @endif
</div>

<div class="form-group{{ $errors->has('cerita_swq') ? ' has-error' : '' }}">
    {{Form::label('cerita_swq', 'Cerita Bahasa Sumbawa *')}}

    {{Form::textarea("cerita_swq", null, array("class"=>"form-control","id"=>"cerita_swq"))}}
    @if ($errors->has('cerita_swq'))
    <span class="help-block">
        <strong>{{ $errors->first('cerita_swq') }}</strong>
    </span>
    @endif
</div>
<div class="form-group{{ $errors->has('featured_image') ? ' has-error ':''}}">
    {{Form::label('featured_image','Poster Cerita * ')}}
    {{Form::file('featured_image',null,array("class"=>"form-control","id"=>"featured_image"))}}
    <img id="preview_featured_image" class="inputImgPreview" src="@if(isset($post)){{$post->featured_image->thumb}} @endif" class="img-thumbnail" />
    @if ($errors->has('featured_image'))
    <span class="help-block">
        <strong>{{ $errors->first('featured_image') }}</strong>
    </span>
    @endif
</div>

<div class="form-group{{ $errors->has('background') ? ' has-error ':''}}">
    {{Form::label('background','Background Cerita * ')}}
    {{Form::file('background',null,array("class"=>"form-control","id"=>"background"))}}
    <img id="preview_background" class="inputImgPreview" src="@if(isset($post)){{$post->background}} @endif" class="img-thumbnail" />
    @if ($errors->has('background'))
    <span class="help-block">
        <strong>{{ $errors->first('background') }}</strong>
    </span>
    @endif
</div>

<div class="form-group{{ $errors->has('featured_audio') ? ' has-error ':''}}">
    {{Form::label('featured_audio','Featured Audio * ')}}
    {{Form::file('featured_audio',null,array("class"=>"form-control","id"=>"featured_audio"))}}
    @if ($errors->has('featured_audio'))
    <span class="help-block">
        <strong>{{ $errors->first('featured_audio') }}</strong>
    </span>
    @endif
</div>


<div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
    <label>Active : </label>
    <label class="radio-inline">
        {{Form::radio('active','1',true,['id'=>'yes'])}} Yes
    </label>
    <label class="radio-inline">
        {{Form::radio('active','0',null,['id'=>'yes'])}} No
    </label>
    @if ($errors->has('active'))
    <span class="help-block">
        <strong>{{ $errors->first('active') }}</strong>
    </span>
    @endif
</div>


@section('page_scripts')

<script type="text/javascript" src="{{URL::asset('back/js/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('back/js/select2.min.js')}}"></script>

<script type="text/javascript">
    CKEDITOR.replace('content');

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var targetPreview = 'preview_' + $(input).attr('id');
            reader.onload = function(e) {
                $('#' + targetPreview).attr('src', e.target.result).show();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#featured_image").change(function() {
        readURL(this);
    });

    $(document).ready(function() {

        $("#category_id").select2();

        $("#tags").select2({
            minimumInputLength: 2,
            multiple: true,
            quietMillis: 100,
            ajax: {
                url: '{{url('
                admin / tags - suggest ')}}',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                    }
                    return query;

                },
                processResults: function(data) {
                    return {
                        results: data.results
                    };
                }
            }
        });
    });
</script>
@endsection