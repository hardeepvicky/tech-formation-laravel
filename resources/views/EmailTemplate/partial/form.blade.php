@include('partial.form_macro')

<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>

<div class="form-body">
    {!! Form::myGroup("text", "Code", "code", ['required' => true], $errors) !!}
    
    {!! Form::myGroup("text", "Subject", "subject", ['required' => true], $errors) !!}
    
    {!! Form::openGroup() !!}
    
        {!! Form::myLabel('Body', ['class' => 'col-md-3'], true) !!}
        <div class="col-md-9">
            {!! Form::myInput('textarea', 'body', ['required' => true, 'class' => 'ckeditor'], $errors) !!}
        </div>
        
    {!! Form::closeGroup() !!}
    
    {!! Form::myGroup("select", "Placeholders", "placeholder_ids[]", ['required' => true, 'options' => $placeholder_list, 'class' => 'select2me', 'multiple' => "true"], $errors) !!}
    
    <div class="form-group">
        <div class="col-md-offset-3 col-md-3">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn default">Cancel</button>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".ckeditor").ckeditor();
</script>