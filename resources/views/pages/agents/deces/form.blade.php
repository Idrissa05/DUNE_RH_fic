{!! form_start($form) !!}
<div class="row">
    <div class="col-md-4 offset-md-2">
        {!!  form_row($form->date) !!}
        {!!  form_row($form->ref_document) !!}
    </div>
    <div class="col-md-4">
        {!!  form_row($form->observation) !!}
        {!! form_row($form->agent_id) !!}
        <div class="form-group mt-5">
            <button class="btn btn-primary" type="submit"><i class="mdi mdi-content-save mdi-24px"></i>  Enregistrer</button>
            <a href="{{ route('deces.index') }}" class="btn btn-secondary"><i class="mdi mdi-cancel mdi-24px"></i> Annuler</a>
        </div>
    </div>

</div>

{!! form_end($form) !!}