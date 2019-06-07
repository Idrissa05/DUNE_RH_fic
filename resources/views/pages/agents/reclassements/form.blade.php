{!! form_start($form) !!}
<div class="row">
    <div class="col-md-4 offset-md-2">
        {!!  form_row($form->agent_id) !!}
        {!!  form_row($form->classe_id) !!}
        {!!  form_row($form->ref_reclassement) !!}
    </div>
    <div class="col-md-4">
        {!!  form_row($form->category_id) !!}
        {!!  form_row($form->echelon_id) !!}
        {!!  form_row($form->date_reclassement) !!}
        {!!  form_row($form->indice) !!}
        {!!  form_row($form->salary) !!}
        {!! form_widget($form->indice_id) !!}
        <div class="form-group mt-5">
            <button class="btn btn-primary" type="submit"><i class="mdi mdi-content-save mdi-24px"></i>  Enregistrer</button>
            <a href="{{ route('reclassement.index') }}" class="btn btn-secondary"><i class="mdi mdi-cancel mdi-24px"></i> Annuler</a>
        </div>
    </div>

</div>

{!! form_end($form) !!}
