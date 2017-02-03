@include('partial.form_macro')

<div class="form-body">
    {!! Form::myGroup("text", "Name", "name", ['required' => true], $errors) !!}
    
    <div class="form-group">
        <div class="col-md-offset-3 col-md-3">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn default">Cancel</button>
        </div>
    </div>
</div>
